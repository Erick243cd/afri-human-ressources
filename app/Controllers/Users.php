<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
        if (!isLoggedIn()) return redirect('login');
        $sess_data = session()->get('user_data');
        if ($sess_data->user_role === 'Admin') {
            $data = [
                'title' => 'Utilisateurs',
                'sess_data' => session()->get('user_data'),
                'users' => $this->userModel->asObject()->orderBy('user_id', 'DESC')->findAll()
            ];
            echo view('users/index', $data);
        } else {
            return redirect()->to('login');
        }
    }

    public function add()
    {
        if (!isLoggedIn()) return redirect()->to('login');
        $data = [];
        $data = [
            'title' => 'Ajouter',
            'sess_data' => session()->get('user_data')
        ];

        if ($this->request->getMethod() === 'post') {
            $this->validation->setRules([
                'username' => [
                    'label' => 'Nom d\'utilisateur',
                    'rules' => 'required|is_unique[hrm_users.user_name]',
                    'errors' => [
                        'is_unique' => 'Le {field} est déjà porté par un autre utilisateur',
                        'required' => 'Le champ {field}  est requis'
                    ]
                ],

                'email_adress' => [
                    'label' => 'Adresse mail',
                    'rules' => 'required|valid_email|is_unique[hrm_users.user_email]',
                    'errors' => [
                        'required' => 'Le champ {field} est requis',
                        'valid_email' => 'Le champ {field} doit être valide',
                        'is_unique' => 'L\' {field}  que vous avez saisie est déjà portée par un autre utilisateur'
                    ]
                ],
                'user_role' => [
                    'label' => 'Rôle utilisateur',
                    'rules' => 'required',
                    'errors' => ['required' => 'Le champ {field} est requis']
                ],
            ]);

            if ($this->validation->withRequest($this->request)->run()) {
                $data = [
                    'user_name' => htmlentities($this->request->getVar('username')),
                    'user_email' => htmlentities($this->request->getVar('email_adress')),
                    'user_role' => htmlentities($this->request->getVar('user_role')),
                    'user_password' => password_hash('@12345', PASSWORD_BCRYPT),
                    'user_status' => 1,
                    'user_image' => 'user-default-avatar.png'
                ];

                $this->userModel->save($data);

                session()->setFlashdata('success', "L'utilisateur a été ajouté avec succès ");
                return redirect()->to('users-list');
            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        echo view('users/add', $data);
    }

    public function profile()
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $data = [
            'title' => 'Utilisateur',
            'subtitle' => 'Mon Compte',
            'sess_data' => session()->get('user_data')
        ];
        return view('users/profile', $data);
    }

    public function update()
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $data = [];
        $data = [
            'title' => 'Modifier utilisateur',
            'sess_data' => session()->get('user_data')
        ];

        if ($this->request->getMethod() === 'post') {
            $this->validation->setRules([
                'userName' => [
                    'label' => 'Nom d\'utilisateur',
                    'rules' => 'required', 'Le nom d\'utilisateur est requis'
                ],
                'emailAdress' => [
                    'label' => 'Adresse email',
                    'rules' => 'required|valid_email',
                ],
                'userPassword' => [
                    'label' => 'Nouveau Mot de passe',
                    'rules' => 'required|min_length[6]'
                ],

                'passwordConfirm' => [
                    'label' => 'Confirmer Mot de passe',
                    'rules' => 'required|matches[userPassword]',
                ]
            ]);
            if ($this->validation->withRequest($this->request)->run()) {
                $data = [
                    'user_name' => htmlentities($this->request->getVar('userName')),
                    'user_email' => htmlentities($this->request->getVar('emailAdress')),
                    'user_password' => password_hash($this->request->getVar('userPassword'), PASSWORD_BCRYPT),
                ];

                $this->userModel->set($data)->where('user_id', $this->request->getVar('userID'))->update();

                $userData = $this->userModel->asObject()->where('user_id', $this->request->getVar('userID'))
                    ->first();

                session()->set('user_data', $userData);
                session()->setFlashdata('success', "Mises à jour effectuées avec succès !");
                return redirect()->to('user-profile');

            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        echo view('users/profile', $data);
    }

    /**
     * Updates necessity
     */
    public function systemDelay()
    {
        return view('errors/delay_updates');
    }

    public function edit($userID)
    {
        if (!isLoggedIn()) return redirect()->to('login');
        $data = [];
        $userData = $this->userModel->asObject()->where('user_id', $userID)->first();
        if (empty($userData)) {
            return view('errors/error-404');
        } else {

            $data = [
                'title' => 'Editer | ' . $userData->user_name,
                'sess_data' => session()->get('user_data'),
                'user' => $userData
            ];
            if ($this->request->getMethod() === 'post') {
                $this->validation->setRules([
                    'userName' => [
                        'label' => 'Nom d\'utilisateur',
                        'rules' => 'required',
                        'errors' => ['required' => 'Le nom d\'utilisateur est requis']
                    ],
                    'emailAdress' => [
                        'label' => 'Adresse mail',
                        'rules' => 'valid_email',
                        'errors' => [
                            'valid_email' => 'L\'adresse email doit être valide'
                        ]
                    ],
                    'userRole' => [
                        'label' => 'Rôle utilisateur',
                        'rules' => 'required',
                        'errors' => ['required' => 'Le rôle utilisateur est requis']
                    ],
                ]);

                if ($this->validation->withRequest($this->request)->run()) {
                    $data = [
                        'user_name' => htmlentities($this->request->getVar('userName')),
                        'user_email' => htmlentities($this->request->getVar('emailAdress')),
                        'user_role' => $this->request->getVar('userRole')
                    ];

                    $this->userModel->set($data)->where('user_id', $userID)->update();
                    session()->setFlashdata('success', "Mises à jour effectuées avec succès !");
                    return redirect()->to('users-list');

                } else {
                    $data['validation'] = $this->validation->getErrors();
                }

            }
            echo view('users/edit', $data);
        }

    }

    public function delete($userID)
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $userData = $this->userModel->asObject()->where('user_id', $userID)->first();
        if (empty($userData)) {
            return view('errors/error-404');
        } else {
            $this->userModel->where('user_id', $userID)->delete();

            session()->setFlashdata('success', "Suppression effectuée avec succès !");
            return redirect()->to('users-list');
        }
    }

    public function login()
    {
        $data = [];
        $data['validation'] = null;
        $data['title'] = 'Human Ressources Manager  | Login';
        if ($this->request->getMethod() == 'post') {
            $this->validation->setRules([
                'email_adress' => [
                    'label' => 'Adresse mail',
                    'rules' => 'required|valid_email',
                    'errors' => ['required' => 'Le champ {field} est requis']
                ],
                'password' => [
                    'label' => 'Mot de passe',
                    'rules' => 'required|check_pwd',
                    'errors' => [
                        'required' => 'Le champ {field} est requis',
                        'check_pwd' => 'Email ou mot de passe incorrect'
                    ]
                ]
            ]);
            if ($this->validation->withRequest($this->request)->run()) {
                $data = $this->userModel->asObject()->where(['user_email' => $this->request->getVar('email_adress'), 'user_status' => 1])
                    ->first();

                session()->set('user_data', $data);

                return redirect()->to('/dashboard');

            } else {
                $data['validation'] = $this->validation->getErrors();
            }
        }
        return view('pages/login', $data);
    }

    public function addSignature()
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $sess_data = session()->get('user_data');
        if ($sess_data->user_role === 'Médecin Vérificateur' || $sess_data->user_role === 'Médecin Examinateur') {

            $data = [
                'title' => 'Ajouter la signature',
                'sess_data' => session()->get('user_data'),
                'validation' => null
            ];

            if ($this->request->getMethod() == 'post') {
                $this->validation->setRules([
                    'user_signature' => [
                        'label' => 'Image de la signature',
                        'rules' => 'uploaded[user_signature]|max_size[user_signature, 9050]|is_image[user_signature]'
                    ]
                ]);
                if ($this->validation->withRequest($this->request)->run()) {

                    $temp_path = './public/assets/images/signatures/temp'; //Temporary Path before Fit image
                    $real_path = './public/assets/images/signatures'; //Real Path after Fit image

                    $file = $this->request->getFile('user_signature');
                    $imageName = substr($file->getRandomName(), 0, -4) . '.png';

                    if ($file->isValid() && !$file->hasMoved()) {
                        $file->move($temp_path, $imageName);
                        // resizing image
                        \Config\Services::image()->withFile($temp_path . '/' . $imageName)
                            ->fit(220, 190, 'center')
                            ->convert(IMAGETYPE_PNG)
                            ->save($real_path . '/' . $imageName);
                    }
                    $data = [
                        'user_signature' => $imageName
                    ];

                    $this->userModel->set($data)->where('user_id', $sess_data->user_id)->update();

                    $userData = $this->userModel->asObject()->where('user_id', $sess_data->user_id)
                        ->first();
                    session()->set('user_data', $userData);

                    return redirect()->to('/user-profile');

                } else {
                    $data['validation'] = $this->validation->getErrors();
                }
            }
            return view('users/signature', $data);
        } else {
            $errMsg = ['msg' => "Vous n'avez pas l'autorisation à cette fonctionnalité, veuillez consulter l'administrateur pour vous changer de rôle"];
            return view('errors/error501', $errMsg);
        }
    }

    public function resetPassword(){
        if (isLoggedIn()) return redirect()->to('dashboard');

        $data = ['title' => 'Human Ressources Manager  | Reset password'];

        return view('pages/reset-password', $data);
    }

    public function signUp(){
        if (isLoggedIn()) return redirect()->to('dashboard');

        $data = ['title' => 'Human Ressources Manager  | S\'inscrire'];

        return view('pages/sign-up', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
