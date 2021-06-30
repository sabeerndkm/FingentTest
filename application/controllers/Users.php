<?php 
class Users extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
    } 
/*
* Listing of users
*/
public function index()
{
    try{
        $this->session->set_userdata('menu_selection_header', "user_mgnt");
        $this->session->set_userdata('menu_selection_link', "user_link_active");
        $data['noof_page'] = 0;
        $data['users'] = $this->Users_model->get_all_users();
        $data['_view'] = 'users/index';
        $this->load->view('layouts/main',$data);
    } catch (Exception $ex) {
        throw new Exception('Users Controller : Error in index function - ' . $ex);
    }  
}
/*
* Adding a new users
*/
function add()
{  
    try{
        $params = array(
            'username'=> $this->input->post('username'),
            'password'=> md5($this->input->post('password')),
            'addedDate'=>DATE_TIME,
            'addedBy'=>$this->session->userdata(SESSION_ADMIN_NAME),
            'userStatus'=> $this->input->post('userStatus')
        );
        $this->load->library('upload');
        $this->load->library('form_validation');

        $username_val = $this->input->post('username');
        $username_arr = $this->Users_model->get_usersbyclm_name('username',$username_val);
        $this->form_validation->set_rules('username','Username','required');
        if($username_arr != null){
            $this->form_validation->set_rules('username','Username','form_validation_titleexist');
        }

        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run())  
        {  
            $userId = $this->Users_model->add_users($params);
            $this->session->set_flashdata('alert_msg','<div class="alert alert-success text-center">Succesfully added.</div>');
            redirect('users/index');
        }
        else
        { 
            $data['_view'] = 'users/add';
            $this->load->view('layouts/main',$data);
        }
    } catch (Exception $ex) {
        throw new Exception('Users Controller : Error in add function - ' . $ex);
    }  
}  
/*
* Editing a users
*/
public function edit($userId)
{   
    try{
        $data['users'] = $this->Users_model->get_users($userId);
        $this->load->library('upload');
        $this->load->library('form_validation');
        if(isset($data['users']['userId']))
        {
            $params = array(
                'username'=> $this->input->post('username'),
                'userStatus'=> $this->input->post('userStatus')
            );

            $password = $this->input->post('password');
            if ($data['users']['password'] == $password) {
            } else {
                $params['password'] = md5($password);
            }

            $username_val = $this->input->post('username');
            $user_arr = $this->Users_model->get_usersbyclm_name_not_id('username',$username_val,$userId);
            $this->form_validation->set_rules('username','username','required');
            if($user_arr != null){
                $this->form_validation->set_rules('username','username','unique');
            }

            $this->form_validation->set_rules('password','password','required');
            if($this->form_validation->run())  
            {  
                $this->Users_model->update_users($userId,$params);
                $this->session->set_flashdata('alert_msg','<div class="alert alert-success text-center">Succesfully updated.</div>');
                redirect('users/index');
            }
            else
            {
                $data['_view'] = 'users/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The users you are trying to edit does not exist.');
    } catch (Exception $ex) {
        throw new Exception('Users Controller : Error in edit function - ' . $ex);
    }  
} 
/*
* Deleting users
*/
function remove($userId)
{
    try{
        $users = $this->Users_model->get_users($userId);
        if(isset($users['userId']))
        {
            $remove_param = array('userStatus'=>'removed');
            $this->Users_model->update_users($userId,$remove_param);
            $this->session->set_flashdata('alert_msg','<div class="alert alert-success text-center">Succesfully Removed.</div>');
            redirect('users/index');
        }
        else
            show_error('The users you are trying to delete does not exist.');
    } catch (Exception $ex) {
        throw new Exception('Users Controller : Error in remove function - ' . $ex);
    }  
}
/*
* View more a users
*/
public function view_more($userId)
{   
    try{
        $data['users'] = $this->Users_model->get_users($userId);
        if(isset($data['users']['userId']))
        {
            $data['_view'] = 'users/view_more';
            $this->load->view('layouts/main',$data);
        }
        else
            show_error('The users you are trying to view more does not exist.');
    } catch (Exception $ex) {
        throw new Exception('Users Controller : Error in View more function - ' . $ex);
    }  
} 

}
