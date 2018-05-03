<?php
	class Signup extends CI_Controller{
		public function index($message = ''){
			$data['message'] = $message;
			$this->load->view('signup',$data);
		}

		public function process_signup(){
			$club = $this->input->post('club');
$course = $this->input->post('course');
			$id_no = $this->input->post('id_no');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$firstname = $this->input->post('firstname');
			$lastname = $this->input->post('lastname');
			$email = $this->input->post('email');
			$address = $this->input->post('address');
$contact_no = $this->input->post('contact_no');
			$month = $this->input->post('month');
			$day = $this->input->post('day');
			$year = $this->input->post('year');
			$gender = $this->input->post('gender');
			$birthday = $month."/".$day."/".$year;
			$squestion1 = $this->input->post('squestion1');
			$sanswer1 = $this->input->post('sanswer1');
			$squestion2 = $this->input->post('squestion2');
			$sanswer2 = $this->input->post('sanswer2');
			

			$u = $this->clubsociety_model->checkUsername($username);
			$n = $this->clubsociety_model->checkName($firstname,$lastname);
			$c = $this->clubsociety_model->checkClub($firstname,$lastname,$club);

			if(count($u) > 0)
			{
				redirect(base_url('signup/index/username_taken'));
			}
			else
			{
				if(count($c) > 0)
				{
					redirect(base_url('signup/index/already_a_member'));
				}
				else
				{
					if(count($n) == 2)
					{
						redirect(base_url('signup/index/maximum'));
					}
					else
					{
						if(isset($_FILES['profile_pic']))
						{
							if($_FILES['profile_pic']['name'] != '')
							{
								$image = $_FILES['profile_pic'];
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
									  'contact_no' => $contact_no,
                                                                          'course' => $course,
                                                                          'id_no' => $id_no,
									  'username' => $username,
									  'password' => $password,
									  'firstname' => $firstname,
									  'lastname' => $lastname,
									  'email' => $email,
									  'address' => $address,
									  'birthdate' => $birthday,
									  'gender' => $gender,
									  'image' => $image_name,
									  'confirmation' => 2);
								}
							}
							else
							{
								$data = array('club' => $club,
									  'contact_no' => $contact_no,
                                                                          'course' => $course,
                                                                          'id_no' => $id_no,
									  'username' => $username,
									  'password' => $password,
									  'firstname' => $firstname,
									  'lastname' => $lastname,
									  'email' => $email,
									  'address' => $address,
									  'birthdate' => $birthday,
									  'gender' => $gender,
									  'confirmation' => 2);
							}	
						}

						$this->clubsociety_model->add_member($data);
						redirect(base_url());
					}
				}
			}
		}
	}
?>