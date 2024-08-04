<?php 
	class User extends CI_Controller{

			public function __construct(){
				parent::__construct();
				$this->load->helper('url');
				$this->load->library('form_validation');
				$this->load->model('user_model');
				$this->load->database();
				$this->load->library('session');
			}
			

public function index()
	{
				$this->load->view('login');
	
	}

			public function signup(){
				
				
				$this->load->view('login_form');
			}

			public function submit(){
				$this->form_validation->set_rules('email','Email','required|is_unique[user.email]',array('is_unique'=>'Email already exists!'));
				$this->form_validation->set_rules('name','Name','required');
				$this->form_validation->set_rules('password','Password','required');
				if($this->form_validation->run()==FALSE){
					$this->load->view('login');
				}else{
					$data['name'] = $this->input->post('name');
					$data['email'] = $this->input->post('email');
					$data['password'] = $this->input->post('password');
				
				
					$response = $this->user_model->store($data);
					if($response==true){
						echo 'Succesfully registered';
					}else{
						echo 'Failed to register';	
					}
				}
				
			}


			public function login(){
				
				if($this->session->has_userdata('id')){
					redirect('user/home');
				}
				
			
				$this->load->view('login');
			}

			public function login_user(){
			
				
				$this->form_validation->set_rules('email','Email','required');
				$this->form_validation->set_rules('password','Password','required');

				if($this->form_validation->run()==FALSE){
					$this->load->view('login');
				}else{
					$email = $this->input->post('email');
					$password = $this->input->post('password');
					$this->load->database();
					$this->load->model('user_model');
					if($user = $this->user_model->getUser($email)){
						if($user->password==$password){
							
							$this->load->library('session');
							$this->session->set_userdata('id',$user->id);
							redirect('user/home');
							
						}else{
							echo "Login Error!";
						}
					}else{
						echo "No account exists with this email!";
					}
				}

			
			}

			public function home(){
				$this->load->view('header');
				$this->load->view('dashboard');
				$this->load->view('footer');

			}

			public function logout(){
				
			
				$this->session->unset_userdata('id');
				redirect('user/login');
			}

				public function production(){
				$this->load->view('header');
				$this->load->view('production');
				$this->load->view('footer');

			}

				public function booking(){
				$this->load->view('header');
				$this->load->view('booking');
				$this->load->view('footer');

			}
				public function payment(){
				$this->load->view('header');
				$this->load->view('payment');
				$this->load->view('footer');

			}
				public function delivery(){
				$this->load->view('header');
				$this->load->view('delivery');
				$this->load->view('footer');

			}


	}


?>
