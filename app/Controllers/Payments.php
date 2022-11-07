<?php

namespace App\Controllers;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Dompdf\Dompdf;
use Dompdf\Options;
use org\bovigo\vfs\vfsStreamContainerIterator;

class Payments extends BaseController
{
    public function index()
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $data = [
            'title' => 'Liste de pointages par employé | Afrinewsoft',
            'sess_data' => session()->get('user_data'),
            'employees' => $this->employeeModel->asObject()
                ->join('hrm_categories', 'hrm_categories.categoryId=hrm_employees.categoryId')
                ->join('hrm_services', 'hrm_services.serviceId=hrm_employees.serviceId')
                ->orderBy('firstName', 'ASC')->findAll()
        ];
        return view('payments/index', $data);
    }

    public function presenceList($employeeId)
    {
        if (!isLoggedIn()) return redirect()->to('login');
        $emplData = $this->employeeModel->asObject()
            ->join('hrm_categories', 'hrm_categories.categoryId=hrm_employees.categoryId')
            ->join('hrm_services', 'hrm_services.serviceId=hrm_employees.serviceId')
            ->where('id', $employeeId)->first();

        if ($this->request->getMethod() === 'post') {
            $wheres = ['employeId' => $employeeId, 'taillyYear' => $this->request->getVar('yearSearch'), 'taillyMonth' => $this->request->getVar('monthSearch')];
        } else {
            $wheres = [
                'employeId' => $employeeId, 'taillyYear' => date('Y'), 'taillyMonth' => date('m'), 'taillyPoint' => 1, 'taillyStatus' => 1
            ];
        }

        if (!empty($emplData)) {
            $data = [
                'title' => 'Précences pour l\'employé ' . $emplData->firstName,
                'employee' => $emplData,
                'sess_data' => session()->get('user_data'),
                'periods' => $this->pointageModel->asObject()->distinct()->select('taillyMonth')->findAll(),
                'point_data' => $this->pointageModel->asObject()->where($wheres)->findAll()
            ];
            return view('payments/presences', $data);

        } else {
            return view('errors/error-404');
        }
    }

    /*
     *
     * Bulletin de pay --- Invoice
     */


    public function invoice($employeeId)
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $year = $this->request->getVar('year');
        $month = $this->request->getVar('month') ?? date('m');

        $data = [
            'employee' => $this->employeeModel->asObject()
                ->join('hrm_categories', 'hrm_categories.categoryId=hrm_employees.categoryId')
                ->join('hrm_services', 'hrm_services.serviceId=hrm_employees.serviceId')
                ->where('id', $employeeId)->first(),
            'title' => 'Bulletin de Paie',
            'payment' => $this->paymentModel->asObject()
                ->join('hrm_years', 'hrm_years.yearId=hrm_payments.paymentYear')
                ->where(['employeeId' => $employeeId, 'paymentYear' => $year, 'paymentMonth' => $month])->first()
        ];
        if (empty($data['employee']) || empty($data['payment'])) {
            $error_msg['msg'] = "Quelque chose s'est mal passé, veuillez reprendre le processus de paiement";
            return view('errors/error-404', $error_msg);
        }

        $filename = "./public/assets/images/invoices/{$data['employee']->id}.png";

        if (!file_exists(trim($filename))) {
            $this->generateQrCode($data['employee']->id);
        }

        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);

        $dompdf->setHttpContext(stream_context_create([
            'ssl' => [
                'allow_self_signed' => TRUE,
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
            ]
        ]));

        $dompdf->loadHtml(view('payments/invoice', $data));
// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
// Render the HTML as PDF
        $dompdf->render();
// Output the generated PDF to Browser
        $dompdf->stream("mountain_group_invoice.pdf", array("Attachment" => false));
        exit(0);

    }

    public function elements($employeeId)
    {
        if (!isLoggedIn()) return redirect()->to('login');
        $employee = $this->employeeModel->asObject()->where('id', $employeeId)->first();
        if (!empty($employee)) {

            $data = [
                'employee' => $employee,
                'sess_data' => session()->get('user_data'),
                'years' => $this->yearModel->asObject()->orderBy('yearName', 'ASC')->findAll(),
                'months' => $this->pointageModel->asObject()->distinct()->select('taillyMonth')->where('employeId', $employeeId)->findAll(),
                'title' => 'Elements de paie',
            ];
            return view('payments/elements', $data);
        } else {
            return view('errors/error-404');
        }
    }

    public function saveSalary($employeeId)
    {
        if (!isLoggedIn()) return redirect()->to('login');
        $employee = $this->employeeModel->asObject()->where('id', $employeeId)->first();

        if (!empty($employee)) {

            $year = $this->request->getVar('year');
            $month = $this->request->getVar('month') ?? date('m');

            $wheres = [
                'employeId' => $employeeId, 'yearId' => $year, 'taillyMonth' => $month, 'taillyPoint' => 1, 'taillyStatus' => 1
            ];

            $daysWorked = count($this->pointageModel->asObject()->where($wheres)->findAll());

            if ($daysWorked >= 2) {
                $baseSalary = $employee->amountSmig * ((int)$daysWorked / 2);//Returne la partie entière après la division
            } else {
                $baseSalary = 0;
            }

            $primes = $this->request->getVar('prime_amount');
            $advantages = $this->request->getVar('advantage_amount');
            //Salaire de base imposable
            $baseSalaryRequired = $baseSalary + $primes + $advantages;

            $locationIndemnity = $baseSalary * 0.3; //3% fixés par le code du travail congolais

            //Transport Indemnity
            $transportIndemnity = 0;


            if (isset($month, $year)) {
                $transportData = $this->tauxTransportModel->asObject()
                    ->join('hrm_years', 'hrm_years.yearId=hrm_tauxtransports.yearId')
                    ->where(['hrm_tauxtransports.yearId' => $year, 'tauxMonth' => $month])
                    ->first();


                if (!empty($transportData)) {
                    if ($employee->employeeType === 'Manager') {
                        $transportIndemnity = ($transportData->amountManager * 4) * 26;
                        //26 nombre de jours prestés mensuellement
                    } else {
                        $transportIndemnity = ($transportData->amountSimpleEmployee * 4) * 26;
                    }
                } else {
                    $data['msg'] = "Aucun taux de transport n'a été trouvé pour l'année que vous avez sélectionnée! 
                    Veuillez fixer le taux de transport pour l'année sélectionnée puis reprenez l'opération !";
                    return view('errors/error-404', $data);
                }
            } else {
                $transportIndemnity = activeTransportIndemnity($employee->employeeType * 4) * 26;
            }


            $bruteRemuneration = $baseSalaryRequired + $locationIndemnity + $transportIndemnity;


            /*
             * Déduction
             */

            /*
             * CNSS
             */
            $qpo = $baseSalaryRequired * 0.05;
            $qpp = $baseSalaryRequired * 0.13;
            $cnss = $qpo + $qpp;


            /*
             * INPP & ONEM
             */

            $inpp = $baseSalaryRequired * 0.30;
            $onem = $baseSalaryRequired * 0.002;

            /*
             * IPR
             */
            $taux = 2000;
            $baseSalaryRequiredToCdf = $baseSalaryRequired * $taux; //Taux CDF Actuel

            $tranche1 = 162000 * 0.03;
            $departTranche2 = $baseSalaryRequiredToCdf - 162000;

            $tranche2 = 1800000 * 0.15;
            $departTranche3 = $departTranche2 - 1800000;

            $tranche3 = 3600000 * 0.30;
            $departTranche4 = $departTranche3 - 3600000;

            $tranche4 = 5138000 * 0.40;

            //IPR
            $ipr = $tranche1 + $tranche2 + $tranche3 + $tranche4;

            $iprToUSD = $ipr / $taux;

            /*
             * ========================================================
             */
            $netSalary = $bruteRemuneration - $cnss - $inpp - $onem;// - $iprToUSD;


            $payment = $this->paymentModel->asObject()->where(['employeeId' => $employeeId, 'paymentMonth' => $month, 'paymentYear' => $year])->first();

            $newPaymentData = [
                'employeeId' => $employeeId,
                'daysWorked' => (int)$daysWorked / 2,
                'paymentDate' => date('Y-m-d'),
                'updatedAt' => date('Y-m-d'),
                'paymentMonth' => $month,
                'paymentYear' => $year,
                'baseSalary' => $baseSalary,
                'primes' => $primes,
                'advantages' => $advantages,
                'baseSalaryRequired' => $baseSalaryRequired,
                'locationIndemnity' => $locationIndemnity,
                'transportIndemnity' => $transportIndemnity,
                'bruteRemuneration' => $bruteRemuneration,
                'cnssQpo' => $qpo,
                'cnssQpp' => $qpp,
                'inpp' => $inpp,
                'onem' => $onem,
                'ipr' => $iprToUSD,
                'netSalary' => $netSalary,
                'userId' => session()->get('user_data')->user_id
            ];

            if (empty($payment)) {
                $this->paymentModel->save($newPaymentData);
            } else {
                $wheres = ['paymentId' => $payment->paymentId];
                $this->paymentModel->set($newPaymentData)->where($wheres)->update();
            }
            $this->invoice($employeeId);

        } else {
            return view('errors/error-404');
        }
    }


    public function generateQrCode($employeId)
    {
        $data = site_url("qrcode-bulletin-invoice/{$employeId}");

        $options = new QROptions([
            'version' => 10,
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_H,
            'scale' => 2,
            'imageBase64' => false,
            'moduleValues' => [
                // finder
                1536 => [0, 63, 255], // dark (true)
                6 => [255, 255, 255], // light (false), white is the transparency color and is enabled by default
                5632 => [241, 28, 163], // finder dot, dark (true)
                // alignment
                2560 => [255, 0, 255],
                10 => [255, 255, 255],
                // timing
                3072 => [255, 0, 0],
                12 => [255, 255, 255],
                // format
                3584 => [67, 99, 84],
                14 => [255, 255, 255],
                // version
                4096 => [62, 174, 190],
                16 => [255, 255, 255],
                // data
                1024 => [0, 0, 0],
                4 => [255, 255, 255],
                //darkmodule
                512 => [0, 0, 0],
                // separator
                8 => [255, 255, 255],
                // quietzone
                18 => [255, 255, 255],
                // logo (requires a call to QRMatrix::setLogoSpace())
                20 => [255, 255, 255],
            ],
        ]);
        //header('Content-type: image/png');
        $qrcode = new Qrcode($options);
        $qrcode->render($data, "./public/assets/images/invoices/{$employeId}.png");
        return true;
    }


    /*
     * Payment Listing
     *
     */

    public function paymentListing()
    {
        if (!isLoggedIn()) return redirect()->to('login');

        if ($this->request->getMethod() === 'post') {
            $wheres = [
                'paymentMonth' => $this->request->getVar('month'),
                'paymentYear' => $this->request->getVar('year'),
            ];
        } else {

            $year = $this->yearModel->asObject()->where(['yearName' => date('Y')])->first()->yearId;
            $wheres = [
                'paymentMonth' => date('m'),
                'paymentYear' => $year
            ];
        }

        $payments = $this->paymentModel->asObject()
            ->orderBy('firstName', 'ASC')
            ->join('hrm_employees', 'hrm_employees.id=hrm_payments.employeeId')
            ->join('hrm_years', 'hrm_years.yearId=hrm_payments.paymentYear')
            ->join('hrm_categories', 'hrm_categories.categoryId=hrm_employees.categoryId')
            ->join('hrm_services', 'hrm_services.serviceId=hrm_employees.serviceId')
            ->where($wheres)->findAll();
        $massSalary = $this->paymentModel->asObject()->selectSum('netSalary')
            ->where($wheres)->findAll();

        $data = [
            'title' => 'Listing de paie',
            'sess_data' => session()->get('user_data'),
            'payments' => $payments,
            'massSalary' => $massSalary,
            'years' => $this->yearModel->asObject()->orderBy('yearName', 'ASC')->findAll()
        ];

        return view('payments/listing', $data);
    }
}
