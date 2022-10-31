<?php

namespace App\Controllers;

use DateTimeZone;

class Pointages extends BaseController
{
    private $dateTime;
    private $motif;

    public function __construct()
    {
        $this->dateTime = new \DateTime();

        $this->dateTime->setTimezone(new DateTimeZone('Africa/Lubumbashi'));
        $this->motif = $this->dateTime->format('H') >= 13 ? 'Avant-midi' : 'Après-midi';
    }

    public function index()
    {
        if (!isLoggedIn()) redirect('login');
        $data = [
            'title' => "Listes de pointages",
            'page' => 'taillies',
            'months' => $this->pointageModel->asObject()->distinct()->select('taillyMonth')->findAll(),
            'sess_data' => session()->get('user_data')
        ];
        echo view('pointages/index', $data);
    }

    public function tailly()
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $data = [
            'title' => "Pointages | Afrinewsoft",
            'page' => 'tailly',
            'sess_data' => session()->get('user_data')
        ];

        return view('employees/tailly', $data);
    }

    public function point($matricule)
    {
        if (!isLoggedIn()) return redirect()->to('login');

        $employee = $this->employeeModel->asObject()->where('matricule', $matricule)->first();

        if (!empty($employee)) {
            if (!$this->checkTailly($employee->id)) {
                session()->setFlashdata('error', "<b>Erreur !</b> L'employé séléctionné est déjà pointé pour cet {$this->motif}");
            } else {
                $sess_data = session()->get('user_data');
                $data = [
                    'employeId' => $employee->id,
                    'taillyYear' => date('Y'),//$this->dateTime->format('Y'),
                    'taillyMonth' => date('m'),//$this->dateTime->format('m'),
                    'taillyDate' => date('Y-m-d'),//$this->dateTime->format('Y-m-d'),
                    'taillyHour' => date('H:i:s'),//$this->dateTime->format('H:i:s'),
                    'taillyMotif' => $this->motif,
                    'userId' => $sess_data->user_id,
                ];

                if ($this->pointageModel->save($data)) {
                    session()->setFlashdata('success', "<b>{$employee->firstName} {$employee->lastName}</b> a été pointé présent cet {$this->motif} ");
                } else {
                    session()->setFlashdata('error', "<b>Erreur !</b> Impossible de pointer l'agent, erreur au serveur");
                }
            }
            return redirect()->to('add-appointment');
        } else {
            echo view('errors/error-404');
        }
    }

    function checkTailly($employeId)
    {
        if (!isLoggedIn()) redirect('login');

        $data = $this->pointageModel->asObject()->where(['employeId' => $employeId, 'taillyDate' => $this->dateTime->format('Y-m-d'), 'taillyMotif' => $this->motif, 'taillyStatus' => 1])->findAll();

        if (!empty($data)) {
            return false;
        } else {
            return true;
        }
    }

    public function fetchTaillies()
    {
        if (!isLoggedIn()) redirect()->to('login');

        $output = '';


        $month = $this->request->getVar('month');
        $motif = $this->request->getVar('motif');
        $request = $this->request->getVar('query');
        $wheres = [];
        if (!empty($motif)) {
            $realMotif = $motif == 'post-meridium' ? 'Avant-midi' : 'Après-midi';
            $wheres = ['taillyMotif' => $realMotif, 'taillyStatus' => 1];

            //$this->db->where('taillyMotif', $realMotif);
        }

        if (!empty($month)) {
            $wheres = ['taillyMonth' => $month, 'taillyStatus' => 1];
            // $this->db->where('taillyMonth', $month);
        }

        if (!empty($request)) {
            $this->pointageModel->like('matricule', $request);
            $this->pointageModel->orLike('firstName', $request);
            $this->pointageModel->orLike('lastName', $request);
            $this->pointageModel->orLike('serviceName', $request);
        }

        $taillies = $this->pointageModel->asObject()->join('hrm_employees', 'hrm_employees.id=hrm_pointages.employeId')
            ->join('hrm_services', 'hrm_employees.serviceId=hrm_services.serviceId')
            ->orderBy('id', 'DESC')
            ->where($wheres)->findAll(200);

        $output .= '
    	<table id="user-list-table" class="table nowrap">
            <thead>
            <tr>
                   <th>Employé</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Motif</th>
                    <th>Pointage</th>
                    <th></th>
                </tr>
            </thead>
        <tbody>	';

        if (!empty($taillies)) {
            foreach ($taillies as $row) {

                $strImage = base_url("public/assets/images/employees/$row->profilePicture");
                $link = base_url("cancel-tailly/$row->taillyId");
                $output .= '<tr class="text-center">';
                $output .= '
                    <td>
                        <div class="d-inline-block align-middle">
                            <img src="' . $strImage . '"
                                 alt="user image" class="img-radius align-top m-r-15"
                                 style="width:40px;">
                            <div class="d-inline-block">
                                <h6 class="m-b-0">' . $row->firstName . '</h6>
                                <p class="m-b-0">' . $row->lastName . '</p>
                            </div>
                        </div>
                    </td>
                ';
                $output .= '<td>' . $row->serviceName . '</td>';

                $output .= '<td>' . $row->taillyDate . '</td>';
                $output .= '<td>' . $row->taillyMotif . '</td>';
                $output .= '<td>' . $row->taillyPoint . '</td>';
                $output .= '
                     <td>
                        <span class="badge badge-light-success">Active</span>
                        <div class="overlay-edit">
                            <a title="Annuler" href="' . $link . '" class="btn btn-icon btn-danger"><i
                                        class="fas fa-trash-alt"></i></a>
                        </div>
                    </td>
                ';
                $output .= '</tr>';
            }
        } else {
            $output .= '
        		<tr class="text-center">
        			<td class="text-danger text-center">Aucune information</td>
        		</tr>
        	';
        }
        $output .= '</tbody>
                 <tfoot>
                 <tr>
                   <th>Employé</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Motif</th>
                    <th>Pointage</th>
                    <th></th>
                </tr>
            </tfoot>
         </table>
                            ';
        echo $output;
    }

    /*
     * Cancel Tailly
     */
    public function cancel($taillyId)
    {
        if (!isLoggedIn()) redirect()->to('login');

        $data = $this->pointageModel->where('taillyId', $taillyId);

        if (!empty($data)) {

            if ($this->pointageModel->where('taillyId', $taillyId)->delete()) {
                session()->setFlashdata('success', "Le pointage a été annulé avec succès !");
            } else {
                session()->setFlashdata('error', " <b>Erreur !</b> impossible d'annuler le pointage, erreur au serveur");
            }
            return redirect()->to("appointments-list");
        } else {
            echo view('errors/error-404');
        }
    }
}
