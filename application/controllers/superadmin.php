<?php
	class Superadmin extends CI_Controller{
		public function index(){
			if($this->session->userdata('memberID') == true AND $this->session->userdata('type') == 'Super Admin')
			{
				$this->load->view('superadmin_view');
			}
			else
			{
				redirect(base_url());
			}
		}

		public function clubs(){
			$this->load->view('superadmin_clubs');
		}

		public function loadClub(){
			$club = $this->input->post('club');

			$data['club'] = $club;

			$this->load->view('superadmin_load_club',$data);
		}

		public function deleteAccount(){
			$id = $this->input->post('memberID');
			$this->clubsociety_model->deleteAccount($id);
		}

		public function loadCreateAdmin(){
			$this->load->view('superadmin_create_admin_acount');
		}

		public function createAdminAccount(){
			$club = $this->input->post('a_club');
			$username = $this->input->post('a_username');
			$password = $this->input->post('a_password');
			$firstname = $this->input->post('a_firstname');
			$lastname = $this->input->post('a_lastname');
			
			if(isset($_FILES['a_pp']))
			{
				if($_FILES['a_pp']['name'] != '')
				{
					$image = $_FILES['a_pp'];
					$image_name = $image['name'];
					$image_path = $image['tmp_name'];
					$destination = 'uploads/'.$image_name;

					if(move_uploaded_file($image_path, $destination))
					{	
						$config['image_library'] = 'gd2';
						$config['source_image']	= 'uploads/'.$image_name;
						$config['create_thumb'] = TRUE;
						$config['thumb_marker'] = '';
						$config['new_image'] = 'uploads/thumbnails/'.$image_name;
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 50;
						$config['height'] = 50;

						$this->image_lib->initialize($config); 

						if(!$this->image_lib->resize())
						{
						    echo $this->image_lib->display_errors();
						}

						$data = array('club' => $club,
									  'username' => $username,
									  'password' => $password,
									  'firstname' => $firstname,
									  'lastname' => $lastname,
									  'image' => $image_name,
									  'type' => 'Admin',
									  'confirmation' => 1);
					}
				}
				else
				{
					$data = array('club' => $club,
								  'username' => $username,
								  'password' => $password,
								  'firstname' => $firstname,
								  'lastname' => $lastname,
								  'type' => 'Admin',
								  'confirmation' => 1);
				}	
			}

			$this->clubsociety_model->add_member($data);
			redirect(base_url('superadmin'));
		}
	}
?>