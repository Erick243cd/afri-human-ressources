<?php

namespace App\Controllers;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Employees extends BaseController
{
    public function index()
    {
        if (!isLoggedIn()) return redirect()->to('/');

        $data = [
            'title' => 'Human Ressources Manager | Employés',
            'page' => 'dashboard',
            'sess_data' => session()->get('user_data'),
            'employees' => $this->employeeModel->asObject()
                ->join('hrm_categories', 'hrm_categories.categoryId=hrm_employees.categoryId')
                ->join('hrm_services', 'hrm_services.serviceId=hrm_employees.serviceId')
                ->orderBy('id', 'DESC')->findAll()
        ];
        return view('employees/index', $data);
    }

    public function add()
    {
        if (!isLoggedIn()) return redirect()->to('login');
        $data = [
            'title' => 'Ajouter',
            'categories' => $this->categoryModel->asObject()->orderBy('categoryId', 'DESC')->findAll(),
            'services' => $this->serviceModel->asObject()->orderBy('serviceId', 'DESC')->findAll(),
            'sess_data' => session()->get('user_data')
        ];

        if ($this->request->getMethod() === 'post') {
            $this->validation->setRules([
                'emp_matricule' => [
                    'label' => 'Matricule',
                    'rules' => 'is_unique[hrm_employees.matricule]',
                    'errors' => ['is_unique' => 'Ce %s est déjà porté par un autre employé.'],
                ],
                'emp_firstname' => [
                    'label' => 'Prénom',
                    'rules' => 'required',
                    'errors' => ['required' => 'Le champ {field} est requis.'],
                ],

                'emp_lastname' => [
                    'label' => 'Nom',
                    'rules' => 'required',
                    'errors' => ['required' => 'Le champ {field} est requis.'],
                ],
                'categoryId' => [
                    'label' => 'Catégories',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Le champ {field}  est requis'
                    ]
                ],
                'serviceId' => [
                    'label' => 'Service',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Le champ {field}  est requis'
                    ]
                ],
                'emp_gender' => [
                    'label' => 'Service',
                    'rules' => 'required|in_list[M,F]',
                    'errors' => [
                        'required' => 'Le champ {field}  est requis',
                    ]
                ],

                'amount_smig' => [
                    'label' => 'Salaire de base',
                    'rules' => 'required|is_numeric',
                    'errors' => [
                        'required' => 'Le champ {field} est requis.',
                        'is_numeric' => 'Le champ {field} doit contenir un nombre.'
                    ],
                ],
                'emp_phone' => [
                    'label' => 'Téléphone',
                    'rules' => 'required|is_unique[hrm_employees.phone]',
                    'errors' => [
                        'required' => 'Le champ {field} est requis.',
                        'is_unique' => 'Le numéro de téléphone saisi appartient déjà à un autre employé'
                    ],
                ],
                'emp_email' => [
                    'label' => 'Email adresse',
                    'rules' => 'valid_email|is_unique[hrm_employees.email]',
                    'errors' => [
                        'valid_email' => 'Le champ {field} doit contenir une adresse mail valide.',
                        'is_unique' => 'L\'adresse mail saisie appartient déjà à un autre employé'
                    ],
                ],
                'emp_type' => [
                    'label' => 'Type',
                    'rules' => 'required',
                    'errors' => ['required' => 'Le champ {field} est requis']
                ],
                'emp_location' => [
                    'label' => 'Adresse de résidence',
                    'rules' => 'required',
                    'errors' => ['required' => 'Le champ {field} est requis']
                ],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {

                $length = strlen($this->request->getVar("emp_lastname"));

                if ($this->request->getVar('emp_matricule') !== '') {
                    $matricule = htmlentities($this->request->getVar("emp_matricule"));
                } else {
                    $matricule = $this->generateMatricule($length);
                }

                $data = [
                    'matricule' => $matricule,
                    'firstName' => htmlentities($this->request->getVar("emp_firstname")),
                    'lastName' => htmlentities($this->request->getVar("emp_lastname")),
                    'gender' => htmlentities($this->request->getVar("emp_gender")),
                    'phone' => htmlentities($this->request->getVar("emp_phone")),
                    'address' => htmlentities($this->request->getVar("emp_location")),
                    'email' => htmlentities($this->request->getVar("emp_email")),
                    'categoryId' => htmlentities($this->request->getVar("categoryId")),
                    'serviceId' => htmlentities($this->request->getVar("serviceId")),
                    'amountSmig' => htmlentities($this->request->getVar("amount_smig")),
                    'employeeType' => htmlentities($this->request->getVar("emp_type")),
                ];

                $this->employeeModel->save($data);

                session()->setFlashdata('success', "L'employé a été enregistré ");
                return redirect()->to('employees-list');
            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        echo view('employees/add', $data);
    }

    public function edit($employeId)
    {
        if (!isLoggedIn()) return redirect()->to('login');
        $employee = $this->employeeModel->asObject()
            ->join('hrm_categories', 'hrm_categories.categoryId=hrm_employees.categoryId')
            ->join('hrm_services', 'hrm_services.serviceId=hrm_employees.serviceId')
            ->where('id', $employeId)->first();

        if (empty($employee)) {
            return view('errors/error-404');
        } else {
            $data = [
                'title' => 'Editer | ' . $employee->firstName . ' ' . $employee->lastName,
                'categories' => $this->categoryModel->asObject()->orderBy('categoryName', 'DESC')->findAll(),
                'services' => $this->serviceModel->asObject()->orderBy('serviceId', 'DESC')->findAll(),
                'employee' => $employee,
                'sess_data' => session()->get('user_data')
            ];

            if ($this->request->getMethod() === 'post') {
                $this->validation->setRules([
                    'emp_matricule' => [
                        'label' => 'Matricule',
                        'rules' => $employee->matricule == $this->request->getVar('emp_matricule') ? 'required' : 'required|is_unique[hrm_employees.matricule]',
                        'errors' => ['is_unique' => 'Ce {field} est déjà porté par un autre employé.'],
                    ],
                    'emp_firstname' => [
                        'label' => 'Prénom',
                        'rules' => 'required',
                        'errors' => ['required' => 'Le champ {field} est requis.'],
                    ],

                    'emp_lastname' => [
                        'label' => 'Nom',
                        'rules' => 'required',
                        'errors' => ['required' => 'Le champ {field} est requis.'],
                    ],

                    'categoryId' => [
                        'label' => 'Catégories',
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Le champ {field}  est requis'
                        ]
                    ],
                    'serviceId' => [
                        'label' => 'Service',
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Le champ {field}  est requis'
                        ]
                    ],
                    'amount_smig' => [
                        'label' => 'Salaire de base',
                        'rules' => 'required|is_numeric',
                        'errors' => [
                            'required' => 'Le champ {field} est requis.',
                            'is_numeric' => 'Le champ {field} doit contenir un nombre.'
                        ],
                    ],
                    'emp_gender' => [
                        'label' => 'Service',
                        'rules' => 'required|in_list[M,F]',
                        'errors' => [
                            'required' => 'Le champ {field}  est requis',
                        ]
                    ],
                    'emp_phone' => [
                        'label' => 'Téléphone',
                        'rules' => $employee->phone == $this->request->getVar('emp_phone') ? 'required' : 'required|is_unique[hrm_employees.phone]',
                        'errors' => ['is_unique' => 'Ce {field} est déjà porté par un autre employé.'],

                    ],
                    'emp_email' => [
                        'label' => 'Email adresse',
                        'rules' => $employee->email == $this->request->getVar('emp_email') ? 'valid_email' : 'valid_email|is_unique[hrm_employees.email]',
                        'errors' => [
                            'valid_email' => 'Le champ {field} doit contenir une adresse mail valide.',
                            'is_unique' => 'L\' {field} est déjà porté par un autre employé..',
                        ],
                    ],
                    'emp_type' => [
                        'label' => 'Type',
                        'rules' => 'required',
                        'errors' => ['required' => 'Le champ {field} est requis']
                    ],
                    'emp_location' => [
                        'label' => 'Adresse de résidence',
                        'rules' => 'required',
                        'errors' => ['required' => 'Le champ {field} est requis']
                    ],
                ]);

                if ($this->validation->withRequest($this->request)->run()) {
                    $data = [
                        'matricule' => htmlentities($this->request->getVar("emp_matricule")),
                        'firstName' => htmlentities($this->request->getVar("emp_firstname")),
                        'lastName' => htmlentities($this->request->getVar("emp_lastname")),
                        'gender' => htmlentities($this->request->getVar("emp_gender")),
                        'phone' => htmlentities($this->request->getVar("emp_phone")),
                        'address' => htmlentities($this->request->getVar("emp_location")),
                        'email' => htmlentities($this->request->getVar("emp_email")),
                        'categoryId' => htmlentities($this->request->getVar("categoryId")),
                        'serviceId' => htmlentities($this->request->getVar("serviceId")),
                        'amountSmig' => htmlentities($this->request->getVar("amount_smig")),
                        'employeeType' => htmlentities($this->request->getVar("emp_type"))
                    ];


                    $this->employeeModel->set($data)->where('id', $employeId)->update();
                    session()->setFlashdata('success', "Mises à jour effectuées avec succès !");

                    return redirect()->to('employees-list');

                } else {
                    $data['validation'] = $this->validation->getErrors();
                }
            }
            echo view('employees/edit', $data);
        }
    }

    public function delete($employeeId)
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $employeeData = $this->employeeModel->asObject()
            ->where('id', $employeeId)->first();

        if (empty($employeeData)) {
            return view('errors/error-404');
        } else {

            $this->employeeModel->where('id', $employeeId)->delete();
            session()->setFlashdata('success', "Suppression effectuée avec succès !");
            return redirect()->to('employees-list');
        }
    }

    public function serviceCard($employeeId)
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $employeeData = $this->employeeModel->asObject()
            ->join('hrm_categories', 'hrm_categories.categoryId=hrm_employees.categoryId')
            ->join('hrm_services', 'hrm_services.serviceId=hrm_employees.serviceId')
            ->where('id', $employeeId)->first();

        if (empty($employeeData)) {
            return view('errors/error-404');
        } else {
            $filename = "./public/assets/images/employees/qrcodes/{$employeeData->id}.png";

            if (!file_exists(trim($filename))) {
                $this->generateQrCode($employeeData->id);
            }
            $data = [
                'employee' => $employeeData,
                'sess_data' => session()->get('user_data'),
                'title' => "Carte de service | Afrinewsoft"
            ];
            return view('employees/service_card', $data);
        }
    }

    private function generateMatricule($length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function generateQrCode($employeId)
    {

        $data = site_url("point-employee/{$employeId}");
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
        $qrcode->render($data, "./public/assets/images/employees/qrcodes/{$employeId}.png");
        return true;
    }

    public function export()
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $data = $this->employeeModel->asObject()
            ->join('hrm_categories', 'hrm_categories.categoryId=hrm_employees.categoryId')
            ->join('hrm_services', 'hrm_services.serviceId=hrm_employees.serviceId')->findAll();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'MATRICULE');
        $sheet->setCellValue('B1', 'PRENOM');
        $sheet->setCellValue('C1', 'NOM');
        $sheet->setCellValue('D1', 'GENRE');
        $sheet->setCellValue('E1', 'TELEPHONE');
        $sheet->setCellValue('F1', 'ADRESSE');
        $sheet->setCellValue('G1', 'EMAIL');
        $sheet->setCellValue('H1', 'SERVICE');
        $sheet->setCellValue('I1', 'CATEGORY');

        $rows = 2;

        foreach ($data as $val) {
            $sheet->setCellValue('A' . $rows, $val->matricule);
            $sheet->setCellValue('B' . $rows, $val->firstName);
            $sheet->setCellValue('C' . $rows, $val->lastName);
            $sheet->setCellValue('D' . $rows, $val->gender);
            $sheet->setCellValue('E' . $rows, $val->phone);
            $sheet->setCellValue('F' . $rows, $val->address);
            $sheet->setCellValue('G' . $rows, $val->email);
            $sheet->setCellValue('H' . $rows, $val->serviceName);
            $sheet->setCellValue('I' . $rows, $val->categoryName);
            $rows++;
        }

        $fileName = "LISTE-EMPLOYES-DU-" . date('Y-m-d-i-s');
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="' . $fileName . '.xlsx"');
        $writer->save('php://output');
    }

    public function addImage($employeeId)
    {

        if (!isLoggedIn()) return redirect()->to('login');

        $data = [
            'title' => 'Ajouter la signature',
            'sess_data' => session()->get('user_data'),
            'employee' => $this->employeeModel->asObject()->where('id', $employeeId)->first(),
            'validation' => null,
            'page' => 'add-employee-image'
        ];


        if ($this->request->getMethod() == 'post') {

            $this->validation->setRules([
                'employee_picture' => [
                    'label' => 'Image de profile',
                    'rules' => 'uploaded[employee_picture]|max_size[employee_picture, 9050]|is_image[employee_picture]'
                ]
            ]);
            if ($this->validation->withRequest($this->request)->run()) {

                $temp_path = './public/assets/images/employees/temp'; //Temporary Path before Fit image
                $real_path = './public/assets/images/employees'; //Real Path after Fit image

                $file = $this->request->getFile('employee_picture');
                $imageName = substr($file->getRandomName(), 0, -4) . '.png';

                if ($file->isValid() && !$file->hasMoved()) {
                    $file->move($temp_path, $imageName);
                    // resizing image
                    \Config\Services::image()->withFile($temp_path . '/' . $imageName)
                        ->fit(300, 300, 'center')
                        ->convert(IMAGETYPE_PNG)
                        ->save($real_path . '/' . $imageName);
                }
                $data = [
                    'profilePicture' => $imageName
                ];

                $this->employeeModel->set($data)->where('id', $employeeId)->update();
                session()->setFlashdata('success', "Image modifiée avec succès !");
                return redirect()->to('/employees-list');

            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        return view('employees/add_picture', $data);
    }

    public function fetchEmployees($request = null)
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $output = '';

        $request = $this->request->getVar('query');

        if ($request !== null) {
            $data = $this->employeeModel->asObject()
                ->join('hrm_categories', 'hrm_categories.categoryId=hrm_employees.categoryId')
                ->join('hrm_services', 'hrm_services.serviceId=hrm_employees.serviceId')
                ->like('matricule', $request)
                ->orLike('firstName', $request)
                ->orLike('lastName', $request)->findAll();
        } else {
            $data = $this->employeeModel->asObject()
                ->join('hrm_categories', 'hrm_categories.categoryId=hrm_employees.categoryId')
                ->join('hrm_services', 'hrm_services.serviceId=hrm_employees.serviceId')
                ->findAll();
        }

        if (!empty($data)) {
            foreach ($data as $row) {
                $link = base_url('point-employee/' . $row->matricule);
                $output .= '
                    <div class="col-md-3 mb-2">
                         <div class="card wow fadeIn p-0">
                            <div class="card-body text-center">
                            	 <img src="' . site_url('public/assets/images/employees/' . $row->profilePicture) . '" style="border-radius: 50%; height: 25px; width: 25px">

                           		 <strong class="text-muted">' . $row->firstName . " " . $row->lastName . '</strong><br>
								  <small class="text-danger">' . $row->matricule . '</small>
				
                                    <div class="p-1">
                                    ';
                $output .= '
                                         <a class="btn-sm btn-primary" title="Cliquer pour pointer l\'agent" href="' . $link . '">Pointer</a>
                                    </div>
                            </div>
                       </div>
                    </div>
                ';
            }
        } else {
            $output .= '
            <div class="col-md-4 mb-4">
             <div class="card wow fadeIn p-2">
                    <div class="card-body">
                        Aucun résultat trouvé.
                    </div>
             </div>
            </div>
            ';
        }
        echo $output;
    }

    public function point($employeId)
    {

    }
}
