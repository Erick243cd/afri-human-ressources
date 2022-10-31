<?php

namespace App\Controllers;


class Categories extends BaseController
{
    public function index()
    {
        if (!isLoggedIn()) return redirect('login');
        $sess_data = session()->get('user_data');
        if ($sess_data->user_role === 'Admin') {
            $data = [
                'title' => 'Catégories d\'employés',
                'sess_data' => session()->get('user_data'),
                'categories' => $this->categoryModel->asObject()->orderBy('categoryId', 'DESC')->findAll()
            ];
            echo view('categories/index', $data);
        } else {
            return redirect()->to('login');
        }
    }


    public function add()
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $data = [
            'title' => 'Ajouter',
            'sess_data' => session()->get('user_data')
        ];

        if ($this->request->getMethod() === 'post') {
            $this->validation->setRules([
                'category_name' => [
                    'label' => 'Titre',
                    'rules' => 'required|is_unique[hrm_categories.categoryName]',
                    'errors' => [
                        'is_unique' => 'Le titre de la catégorie saisie existe déjà',
                        'required' => 'Le champ {field}  est requis'
                    ]
                ],
                'short_name' => [
                    'label' => 'Abréviation',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Le champ {field} est requis'
                    ]
                ]
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $data = [
                    'categoryName' => htmlentities($this->request->getVar('category_name')),
                    'shortName' => htmlentities($this->request->getVar('short_name')),
                ];

                $this->categoryModel->save($data);

                session()->setFlashdata('success', "La catégorie a été ajouté avec succès ");
                return redirect()->to('categories-list');
            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        echo view('categories/add', $data);
    }

    public function edit($categoryId)
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $categoryData = $this->categoryModel->asObject()->where('categoryId', $categoryId)->first();
        if (empty($categoryData)) {
            return view('errors/error-404');
        } else {
            $data = [
                'title' => 'Editer | ' . $categoryData->categoryName,
                'sess_data' => session()->get('user_data'),
                'category' => $categoryData
            ];
            if ($this->request->getMethod() === 'post') {
                $this->validation->setRules([
                    'category_name' => [
                        'label' => 'Titre',
                        'rules' => 'required',
                        'errors' => ['required' => 'Le champ {field} est requis']
                    ],
                    'short_name' => [
                        'label' => 'Abréviation',
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Le champ {field} est requis'
                        ]
                    ],
                ]);

                if ($this->validation->withRequest($this->request)->run()) {
                    $data = [
                        'categoryName' => htmlentities($this->request->getVar('category_name')),
                        'shortName' => htmlentities($this->request->getVar('short_name')),
                    ];

                    $this->categoryModel->set($data)->where('categoryId', $categoryId)->update();
                    session()->setFlashdata('success', "Mises à jour effectuées avec succès !");

                    return redirect()->to('categories-list');

                } else {
                    $data['validation'] = $this->validation->getErrors();
                }
            }
            echo view('categories/edit', $data);
        }
    }

    public function delete($categoryId)
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $categoryData = $this->categoryModel->asObject()->where('categoryId', $categoryId)->first();

        if (empty($categoryData)) {
            return view('errors/error-404');
        } else {

            $this->categoryModel->where('categoryId', $categoryId)->delete();
            session()->setFlashdata('success', "Suppression effectuée avec succès !");
            return redirect()->to('categories-list');
        }
    }
}


