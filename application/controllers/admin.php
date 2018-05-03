<?php
	class Admin extends CI_Controller{
		public function index(){
			if($this->session->userdata('memberID') == true AND $this->session->userdata('type') == 'Admin')
			{
				$this->load->view('admin_view');
			}
			else
			{
				redirect(base_url());
			}
		}

		public function memberPost($type){
			$desc = $this->input->post('desc');
			$image_name = '';
			$data = array();
			$date = date('Y-m-d H:i:s');

			if(isset($_FILES['image']))
			{
				if($_FILES['image']['name'] != '')
				{
					$image = $_FILES['image'];
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
						$config['width'] = 200;
						$config['height'] = 200;

						$this->image_lib->initialize($config); 

						if(!$this->image_lib->resize())
						{
						    echo $this->image_lib->display_errors();
						}

						$data = array('description' => $desc,
									  'image' => $image_name,
									  'club' => $this->session->userdata('club'),
									  'date' => $date,
									  'posted_by' => $this->session->userdata('memberID'),
									  'posted_by_type' => $type);

						$this->clubsociety_model->post($data,$type);
					}
				}
				else
				{
					$data = array('description' => $desc,
								  'image' => $image_name,
								  'club' => $this->session->userdata('club'),
								  'date' => $date,
								  'posted_by' => $this->session->userdata('memberID'),
								  'posted_by_type' => $type);

						$this->clubsociety_model->post($data,$type);
				}
				
				redirect(base_url($type));
			}
		}

		public function post($post_id)
		{
			$data['post_id'] = $post_id;
			if($this->session->userdata('memberID') == true AND $this->session->userdata('type') == 'Admin')
			{
				$this->load->view('admin_post_view',$data);
			}
			else
			{
				redirect(base_url());
			}
		}

		public function adminNotificationCount()
		{
			echo $this->clubsociety_model->adminNotificationCount();	
		}

		public function profile($id = 0){
			$data['memberID'] = $id;
			if($this->session->userdata('memberID') == true AND $this->session->userdata('type') == 'Admin')
			{
				$this->load->view('adminprofile',$data);
			}
			else
			{
				redirect(base_url());
			}
		}


                public function loadSearchResults($string = ''){
			$data['string'] = $string;
			$this->load->view('search_results',$data);
		}





		public function getAllPost(){
			$this->load->view('userlogs');
		}

		public function getAllMembersByStatus($status = 'P'){
			if($status == 1)
			{
				$status = 'P';
			}
			
			$data['status'] = $status;
			$this->load->view('wants_to_deactivate',$data);
		}

		public function deactivateMember($memberID){
			echo $this->clubsociety_model->deactivateMember($memberID);
		}

		public function activateMember($memberID){
			echo $member;
			$this->clubsociety_model->activateMember($memberID);
		}

		public function loadAdminProfile()
		{
			$this->load->view('load_admin_profile');
		}

		public function updateAdminProfile(){
			$fname = $this->input->post('firstname');
			$lname = $this->input->post('lastname');
                        $uname = $this->input->post('uname');
                        $pword = $this->input->post('pword');

			$data = array('firstname' => $fname,
				      'lastname' => $lname,
				      'username' => $uname, 
				      'password' => $pword);
			
			$this->clubsociety_model->updateAdminProfile($data);
		}

		public function sendConfirmation(){
			$memberID = $this->input->post('memberID');
			$code = $this->input->post('code');

			$mem = $this->clubsociety_model->getMember($memberID);
			$admin = $this->clubsociety_model->getMember($this->session->userdata('memberID'));

			$admin_name = 'Admin '.$admin[0]['firstname']; 
			
			include("phpmailer/class.phpmailer.php");
			$account="clubsociety@britechcs.com";
			$password="Ela_estrella1994";
			$from="clubsociety@britechcs.com";
			$from_name=$admin_name;
			$to=$mem[0]['email'];
			$msg="<strong>".$code."</strong>"; // HTML message
			$subject="Confirmation Code";
			echo $mem[0]['email'];
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->CharSet = 'UTF-8';
			$mail->Host = "box790.bluehost.com";
			$mail->SMTPAuth= true;
			$mail->Port = 465; // 465 Or 587
			$mail->Username= $account;
			$mail->Password= $password;
			$mail->SMTPSecure = 'ssl';
			$mail->From = $from;
			$mail->FromName= $from_name;
			$mail->isHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $msg;
			$mail->addAddress($to);
			if(!$mail->send()){
			 echo "Mailer Error: " . $mail->ErrorInfo;
			}else{
			 echo "E-Mail has been sent";
			}
			
			$this->clubsociety_model->updateVerification($memberID);
		}

		public function mailbox(){
			$this->load->view('admin_mailbox');
		}

		public function inbox(){
			$this->load->view('inbox');
		}

		public function sent(){
			$this->load->view('sent');
		}

		public function compose_message(){
			$this->load->view('compose_message');
		}

		public function send_message(){
			$to = $this->input->post('to');
			$content = $this->input->post('content');
			$date = date('Y-m-d H:i:s');

			$data = array('sender' => $this->session->userdata('memberID'),
						  'recipient' => $to,
						  'content' => $content,
						  'club' => $this->session->userdata('club'),
						  'date' => $date);

			$this->clubsociety_model->insertChat($data);
		}

		public function reply(){
			$data['id'] = $this->input->post('id');
			$this->load->view('reply',$data);
		}

		public function count_unread_messages(){
			if($this->clubsociety_model->countUnreadMessages() == 0)
			{
				echo "";
			}
			else
			{
				echo $this->clubsociety_model->countUnreadMessages();
			}
		}
	}
?>