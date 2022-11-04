<?php

namespace App\Controllers;

use org\bovigo\vfs\vfsStreamContainerIterator;

class TauxTransports extends BaseController
{
    public function index()
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $data = [
            'title' => 'Fixation du taux de transport',
            'sess_data' => session()->get('user_data'),
            'taux' => $this->tauxTransportModel->asObject()
                ->orderBy('status', 'ASC')
                ->join('hrm_years', 'hrm_years.yearId=hrm_tauxtransports.yearId')->findAll(),
        ];
        return view('transports/index', $data);
    }

    public function add()
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $data = [
            'title' => 'Ajouter',
            'years' => $this->yearModel->asObject()->orderBy('yearName', 'ASC')->findAll(),
            'sess_data' => session()->get('user_data')
        ];

        if ($this->request->getMethod() === 'post') {

            $this->validation->setRules([
                'year_id' => [
                    'label' => 'Année',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Le champ {field} est requis '
                    ]
                ],
                'month_name' => [
                    'label' => 'Mois',
                    'rules' => 'required|check_month',
                    'errors' => [
                        'required' => 'Le champ {field} est requis',
                        'check_month' => 'Le taux de transport est déjà fixé pour le mois et l\'année sélectionnés  ',
                    ]
                ],
                'manager_amount' => [
                    'label' => 'Montant fixé pour le manager',
                    'rules' => 'required|is_numeric',
                    'errors' => [
                        'required' => 'Le champ {field} est requis',
                        'is_numeric' => 'Le champ {field} doit contenir un nombre',
                    ]
                ],
                'simple_amount' => [
                    'label' => 'Montant fixé pour les simples employés',
                    'rules' => 'required|is_numeric',
                    'errors' => [
                        'required' => 'Le champ {field} est requis',
                        'is_numeric' => 'Le champ {field} doit contenir un nombre',
                    ]
                ],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $data = [
                    'yearId' => htmlentities($this->request->getVar('year_id')),
                    'tauxMonth' => htmlentities($this->request->getVar('month_name')),
                    'amountManager' => htmlentities($this->request->getVar('manager_amount')),
                    'amountSimpleEmployee' => htmlentities($this->request->getVar('simple_amount')),
                    'createdAt' => date('Y-m-d'),
                    'status' => 0,
                    'userId' => session()->get('user_data')->user_id
                ];
                $this->tauxTransportModel->save($data);
                session()->setFlashdata('success', "Le taux de transport a été fixé avec succès ");
                return redirect()->to('taux-list');
            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        return view('transports/add', $data);
    }

    public function update($tauxId)
    {
        if (!isLoggedIn()) return redirect()->to('login');
        $taux = $this->tauxTransportModel->asObject()
            ->join('hrm_years', 'hrm_years.yearId=hrm_tauxtransports.yearId')
            ->where('tauxId', $tauxId)->first();

        if (!empty($taux)) {
            $data = [
                'title' => 'Editer taux de transport',
                'years' => $this->yearModel->asObject()->orderBy('yearName', 'ASC')->findAll(),
                'sess_data' => session()->get('user_data'),
                'taux' => $taux
            ];
            if ($this->request->getMethod() === 'post') {
                $this->validation->setRules([
                    'year_id' => [
                        'label' => 'Année',
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Le champ {field} est requis '
                        ]
                    ],
                    'month_name' => [
                        'label' => 'Mois',
                        'rules' => $taux->yearId == $this->request->getVar('year_id') && $taux->tauxMonth == $this->request->getVar('month_name') ? 'required' : 'required|check_month',
                        'errors' => [
                            'required' => 'Le champ {field} est requis',
                            'check_month' => 'Le taux de transport est déjà fixé pour le mois et l\'année sélectionnés  ',
                        ]
                    ],
                    'manager_amount' => [
                        'label' => 'Montant fixé pour le manager',
                        'rules' => 'required|is_numeric',
                        'errors' => [
                            'required' => 'Le champ {field} est requis',
                            'is_numeric' => 'Le champ {field} doit contenir un nombre',
                        ]
                    ],
                    'simple_amount' => [
                        'label' => 'Montant fixé pour les simples employés',
                        'rules' => 'required|is_numeric',
                        'errors' => [
                            'required' => 'Le champ {field} est requis',
                            'is_numeric' => 'Le champ {field} doit contenir un nombre',
                        ]
                    ],
                ]);
                if ($this->validation->withRequest($this->request)->run()) {
                    $data = [
                        'yearId' => htmlentities($this->request->getVar('year_id')),
                        'tauxMonth' => htmlentities($this->request->getVar('month_name')),
                        'amountManager' => htmlentities($this->request->getVar('manager_amount')),
                        'amountSimpleEmployee' => htmlentities($this->request->getVar('simple_amount')),
                    ];
                    $this->tauxTransportModel->set($data)->where('tauxId', $taux->tauxId)->update();
                    session()->setFlashdata('success', "Mises à jour effectué avec succès ");
                    return redirect()->to('taux-list');
                } else {
                    $data['validation'] = $this->validation->getErrors();
                }
            }
            return view('transports/edit', $data);

        } else {
            return view('errors/error-404');
        }

    }

    /*
     * Active and Inactive Taux
     */
    public function active($tauxId)
    {
        if (!isLoggedIn()) return redirect()->to('login');
        $taux = $this->tauxTransportModel->asObject()
            ->join('hrm_years', 'hrm_years.yearId=hrm_tauxtransports.yearId')
            ->where('tauxId', $tauxId)->first();

        if (!empty($taux)) {
            $this->tauxTransportModel->set('status', 0)->where('status', 1)->update();

            $this->tauxTransportModel->set('status', 1)->where('tauxId', $tauxId)->update();

            session()->setFlashdata('success', "Le taux a été considéré comme taux actuel ");
            return redirect()->to('taux-list');
        } else {
            return view('errors/error-404');
        }
    }
}
