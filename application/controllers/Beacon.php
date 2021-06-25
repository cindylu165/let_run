<?php
class Beacon extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('BeaconModel');
    }
    public function beacon_table()
    {
        $passport = $this->session->userdata('passport');
        $userTitle = $passport['userTitle'];
        $current_role = $passport['role'];
        $accept_role = array(6);
        if (in_array($current_role, $accept_role)) {
            $beSentDataset = array(
                'title' => '新增Beacon',
                'url' => '/beacon/beacon_table/',
                'role' => $current_role,
                'userTitle' => $userTitle,
                'current_role' => $current_role,
                'password' => $passport['password']
            );

            $this->load->view('/beacon/beacon_table', $beSentDataset);
        } else {
            redirect('user/login');
        }
    }
    public function beacon_place_table()
    {
        $passport = $this->session->userdata('passport');
        $userTitle = $passport['userTitle'];
        $current_role = $passport['role'];
        $accept_role = array(6);
        if (in_array($current_role, $accept_role)) {
            $beSentDataset = array(
                'title' => '查看Beacon放置點',
                'url' => '/beacon/beacon_place_table/',
                'role' => $current_role,
                'userTitle' => $userTitle,
                'current_role' => $current_role,
                'password' => $passport['password']
            );

            $this->load->view('/beacon/beacon_place_table', $beSentDataset);
        } else {
            redirect('user/login');
        }
    }
    


}