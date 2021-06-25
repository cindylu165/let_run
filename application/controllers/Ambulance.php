<?php
class Ambulance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('AmbulanceModel');
    }
    public function ambulance_table()
    {
        $passport = $this->session->userdata('passport');
        $userTitle = $passport['userTitle'];
        $current_role = $passport['role'];
        $accept_role = array(6);
        if (in_array($current_role, $accept_role)) {
            $beSentDataset = array(
                'title' => '救護車資訊',
                'url' => '/ambulance/ambulance_table/',
                'role' => $current_role,
                'userTitle' => $userTitle,
                'current_role' => $current_role,
                'password' => $passport['password']
            );

            $this->load->view('/ambulance/ambulance_table', $beSentDataset);
        } else {
            redirect('user/login');
        }
    }
    


}