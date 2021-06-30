<?php
class Dashboard extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Employee_model');
    }

    function index()
    {

        $this->session->set_userdata('menu_selection_header', "dashboard_mgnt");
        $this->session->set_userdata('menu_selection_link', "dashboard_link_active");
        $data['employee_count'] = $this->Employee_model->get_all_employee_count();
        $user_count             = $this->Users_model->get_all_users_count();
        $data['user_count']     = $user_count - 1;
        $data['_view']          = 'dashboard';
        $this->load->view('layouts/main',$data);
    }
}
