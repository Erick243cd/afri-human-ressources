<?php

namespace App\Controllers;

class Smigs extends BaseController
{
    public function index()
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $sess_data = session()->get('user_data');
        if ($sess_data->user_role === 'Admin') {
            $data = [
                'title' => 'SMIG Par Catégorie d\'employés',
                'sess_data' => session()->get('user_data'),
                'smigs' => $this->smigModel->asObject()
                    ->join('hrm_categories', 'hrm_categories.categoryId=hrm_smigs.category_id')
                    ->orderBy('smigId', 'DESC')->findAll()
            ];
            echo view('smigs/index', $data);
        } else {
            return redirect()->to('login');
        }
    }

    public function add()
    {
        if (!isLoggedIn()) return redirect()->to('login');
        $data = [
            'title' => 'Ajouter',
            'categories' => $this->categoryModel->asObject()->orderBy('categoryId', 'DESC')->findAll(),
            'sess_data' => session()->get('user_data')
        ];

        if ($this->request->getMethod() === 'post') {
            $this->validation->setRules([
                'categoryId' => [
                    'label' => 'Catégories',
                    'rules' => 'required|is_unique[hrm_smigs.category_id]',
                    'errors' => [
                        'is_unique' => 'La catégorie choisie contient déjà un SMIG',
                        'required' => 'Le champ {field}  est requis'
                    ]
                ],

                'smig_amount' => [
                    'label' => 'Montant fixé',
                    'rules' => 'required|is_numeric',
                    'errors' => [
                        'required' => 'Le champ {field} est requis',
                        'is_numeric' => 'Le champ {field}  doit contenir un nombre'
                    ]
                ],
                'currency' => [
                    'label' => 'Devise',
                    'rules' => 'required',
                    'errors' => ['required' => 'Le champ {field} est requis']
                ],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $data = [
                    'category_id' => htmlentities($this->request->getVar('categoryId')),
                    'smig_amount' => htmlentities($this->request->getVar('smig_amount')),
                    'currency' => htmlentities($this->request->getVar('currency')),
                ];

                $this->smigModel->save($data);

                session()->setFlashdata('success', "Le smig a été fixé avec succès ");
                return redirect()->to('smigs-list');
            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        echo view('smigs/add', $data);
    }


    public function edit($smigId)
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $smigData = $this->smigModel->asObject()
            ->join('hrm_categories', 'hrm_categories.categoryId=hrm_smigs.category_id')
            ->where('smigId', $smigId)->first();
        if (empty($smigData)) {
            return view('errors/error-404');
        } else {
            $data = [
                'title' => 'Editer SMIG | ' . $smigData->categoryName,
                'sess_data' => session()->get('user_data'),
                'smig' => $smigData,
                'categories' => $this->categoryModel->asObject()->orderBy('categoryId', 'DESC')->findAll(),
            ];
            if ($this->request->getMethod() === 'post') {
                $this->validation->setRules([
                    'categoryId' => [
                        'label' => 'Catégorie',
                        'rules' => 'required',
                        'errors' => ['required' => 'Le champ {field} est requis']
                    ],
                    'currency' => [
                        'label' => 'Devise',
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Le champ {field} est requis'
                        ]
                    ],
                    'smig_amount' => [
                        'label' => 'Montant fixé',
                        'rules' => 'required|is_numeric',
                        'errors' => [
                            'required' => 'Le champ {field} est requis',
                            'is_numeric' => 'Le champ {field}  doit contenir un nombre'
                        ]
                    ],
                ]);

                if ($this->validation->withRequest($this->request)->run()) {
                    $data = [
                        'category_id' => htmlentities($this->request->getVar('categoryId')),
                        'smig_amount' => htmlentities($this->request->getVar('smig_amount')),
                        'currency' => htmlentities($this->request->getVar('currency')),
                    ];

                    $this->smigModel->set($data)->where('smigId', $smigId)->update();
                    session()->setFlashdata('success', "Mises à jour effectuées avec succès !");

                    return redirect()->to('smigs-list');

                } else {
                    $data['validation'] = $this->validation->getErrors();
                }
            }
            echo view('smigs/edit', $data);
        }
    }

    public function delete($smigId)
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $smigData = $this->smigModel->asObject()
            ->where('smigId', $smigId)->first();

        if (empty($smigData)) {
            return view('errors/error-404');
        } else {

            $this->smigModel->where('smigId', $smigId)->delete();
            session()->setFlashdata('success', "Suppression effectuée avec succès !");
            return redirect()->to('smigs-list');
        }
    }
}
