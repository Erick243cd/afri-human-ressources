<?php

namespace App\Controllers;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Dompdf\Dompdf;
use Dompdf\Options;

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

        if ($this->request->getMethod() === 'post') {
            $year = $this->request->getVar('yearSearch');
            $month = $this->request->getVar('monthSearch');
            $wheres = ['employeId' => $employeeId, 'taillyYear' => $year, 'taillyMonth' => $month];

        } else {
            $year = date('Y');
            $month = date('m');
            $wheres = [
                'employeId' => $employeeId, 'taillyYear' => $year, 'taillyMonth' => $month, 'taillyPoint' => 1, 'taillyStatus' => 1
            ];
        }

        $data = [
            'employee' => $this->employeeModel->asObject()
                ->join('hrm_categories', 'hrm_categories.categoryId=hrm_employees.categoryId')
                ->join('hrm_smigs', 'hrm_smigs.category_id=hrm_categories.categoryId')
                ->join('hrm_services', 'hrm_services.serviceId=hrm_employees.serviceId')
                ->where('id', $employeeId)->first(),
            'title' => 'Bulletin de Paie',
            'month' => $month,
            'year' => $year,
            'point_data' => $this->pointageModel->asObject()
                ->where($wheres)->findAll()
        ];
        if (empty($data['employee'])) {
            return view('errors/error-404');
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

}
