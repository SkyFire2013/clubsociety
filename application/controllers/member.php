<?php
	class Member extends CI_Controller{
		public function index(){
			if($this->session->userdata('memberID') == true AND $this->session->userdata('type') == '')
			{
				if($this->session->userdata('confirmation') == 2)
				{
					redirect(base_url('member/confirmaccount'));
				}
				else
				{
					$this->load->view('member_view');
				}	
			}
			else
			{
				redirect(base_url());
			}
		}

		public function loadMemberAccountProfile(){
			$this->load->view('loadMemberAccountProfile');
		}

		public function deactivateMemberAccount(){
			$this->clubsociety_model->deactivateMemberAccount();
		}

		public function post($post_id = 0)
		{
			$data['post_id'] = $post_id;
			if($this->session->userdata('memberID') == true AND $this->session->userdata('type') == '')
			{
				if($this->session->userdata('confirmation') == 2)
				{
					redirect(base_url('member/confirmaccount'));
				}
				else
				{
					$this->load->view('post_view',$data);
				}	
			}
			else
			{
				redirect(base_url());
			}
		}

		public function profile($id = 0){
			$data['memberID'] = $id;
			if($this->session->userdata('memberID') == true AND $this->session->userdata('type') == '')
			{
				if($this->session->userdata('confirmation') == 2)
				{
					redirect(base_url('member/confirmaccount'));
				}
				else
				{
					$this->load->view('memberprofile',$data);
				}	
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

		public function confirmaccount(){
			if($this->session->userdata('memberID') == true AND $this->session->userdata('type') == '')
			{
				if($this->session->userdata('confirmation') == 2)
				{
					$this->load->view('notactivated');
				}
			}
			else
			{
				redirect(base_url());
			}
		}

		public function activateAccount()
		{
			$code = $this->input->post('code');
			if($this->clubsociety_model->activateAccount($code) == 1)
			{
				redirect(base_url());
			}
			else
			{
				redirect(base_url('member/confirmaccount'));
			}
		}

		public function forgotpassword($message = ''){
			$data['message'] = $message;
			$this->load->view('forgot_password',$data);
		}

		public function checkUsernameAndEmail(){
			$uname = $this->input->post('uname');
			$email = $this->input->post('email');

			$arr = $this->clubsociety_model->checkUsernameAndEmail($uname,$email);

			if(count($arr) > 0)
			{
				include("phpmailer/class.phpmailer.php");

				$account="clubsociety@britechcs.com";
				$password="Ela_estrella1994";
				$from="clubsociety@britechcs.com";
				$from_name='Club Society';
				$to=$email;
				$msg="Your Club Society Password: ".$arr[0]['password']; // HTML message
				$subject="You forgot your Password";
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
				
				if(!$mail->send())
				{
				 redirect(base_url('member/forgotpassword/success'));
				 //echo "Mailer Error: " . $mail->ErrorInfo;
				}
				else{
				 //echo "E-Mail has been sent";
				 redirect(base_url('member/forgotpassword/success'));
				}

				redirect(base_url('member/forgotpassword/success'));
			}
			else
			{
				redirect(base_url('member/forgotpassword/fail'));
			}
			
			redirect(base_url('member/forgotpassword/success'));
		}

		public function mailbox(){
			$this->load->view('mailbox');
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
		
		public function allmembers(){
			$this->load->view('all_club_members');
		}

		public function deactivated(){
			if($this->session->userdata('memberID') == true AND $this->session->userdata('type') == '')
			{
				if($this->session->userdata('status') == 'D' || $this->session->userdata('status') == 'F')
				{
					$this->load->view('deactivated_account');
				}
			}
			else
			{
				redirect(base_url());
			}
		}

		public function notifyToActivate(){
			$this->clubsociety_model->notifyToActivate();
			redirect(base_url('member/deactivated'));
		}
	}
?>