<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function login()
	{
		$this->load->library('form_validation');
		$this->load->model('Users_model');
		$this->form_validation->set_rules('password','Password','required');
		$this->form_validation->set_rules('username','username','required'); 
		if($this->form_validation->run())     
		{ 
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));

			$user_name_arr = $this->Users_model->get_usersbyclm_name('username', $username);

			if (isset($user_name_arr) && $user_name_arr != null) {
				if ($user_name_arr['password'] == $password) {
					$this->session->set_userdata(SESSION_ADMIN_NAME, $username);
					redirect('Dashboard/index');
				} else {
					$this->session->set_flashdata('login_msg', '<div class="alert alert-danger text-center">Login Failed!! Please check your password and try again.</div>');
					redirect('admin');
				}
			} else {
				$this->session->set_flashdata('alertDmessage', '');
				$this->session->set_flashdata('login_msg', '<div class="alert alert-danger text-center">Invalid Username! Please try again</div>');
				redirect('admin');
			} 
		}
		else
		{ 
			$data['logintype'] = 'admin';
			$this->load->view('admin_login',$data);
		}
	}

	public function logout()
	{
		?>
		<script>
			window.location.hash = "no-back-button";
			window.location.hash = "Again-No-back-button"; 
			window.onhashchange = function() {
				window.location.hash = "no-back-button";
			}
		</script>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="0" />
		<meta http-equiv="Expires" content="0" />
		<meta http-equiv="refresh" content="0; 
		<?php
		$this->session->unset_userdata(SESSION_ADMIN_NAME);
		$this->session->unset_userdata('menu_selection_header');
		$this->session->unset_userdata('menu_selection_link');
		redirect('admin');
	}
}
