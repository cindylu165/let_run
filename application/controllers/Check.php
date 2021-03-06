<?php
class Check extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('CheckModel');
    }
    public function staff_apply_table()
    {
        $passport = $this->session->userdata('passport');
        $userTitle = $passport['userTitle'];
        $current_role = $passport['role'];
        $accept_role = array(6);
        if (in_array($current_role, $accept_role)) {
            $beSentDataset = array(
                'title' => '工作人員申請活動',
                'url' => '/check/staff_apply_table/',
                'role' => $current_role,
                'userTitle' => $userTitle,
                'current_role' => $current_role,
                'password' => $passport['password']
            );

            $this->load->view('/check/staff_apply_table', $beSentDataset);
        } else {
            redirect('user/login');
        }
    }
    public function member_pay_status_table()
    {
        $passport = $this->session->userdata('passport');
        $userTitle = $passport['userTitle'];
        $current_role = $passport['role'];
        $accept_role = array(6);
        if (in_array($current_role, $accept_role)) {
            $beSentDataset = array(
                'title' => '繳費狀態',
                'url' => '/check/member_pay_status_table/',
                'role' => $current_role,
                'userTitle' => $userTitle,
                'current_role' => $current_role,
                'password' => $passport['password']
            );

            $this->load->view('/check/member_pay_status_table', $beSentDataset);
        } else {
            redirect('user/login');
        }
    }
    


}