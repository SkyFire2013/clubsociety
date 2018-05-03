<?php
	class Home extends CI_Controller{
		public function index(){
			$this->load->view('home');
		}

		public function login(){
			$uname = $this->input->post('uname');
			$pword = $this->input->post('pword');
			$result = $this->clubsociety_model->login($uname,$pword);

			if(count($result) >= 1)
			{

				$data = array('memberID' => $result[0]['member_id'],
							  'fname' => $result[0]['firstname'],
							  'lname' => $result[0]['lastname'],
							  'club' => $result[0]['club'],
							  'type' => $result[0]['type'],
							  'image' => $result[0]['image'],
							  'status' => $result[0]['status'],
							  'confirmation' => $result[0]['confirmation']);
				$this->session->set_userdata($data);
				$this->clubsociety_model->creatLog('logged in',$result[0]['member_id']);

				if($result[0]['type'] == 'Admin')
				{
					redirect(base_url('admin'));
				}

				if($result[0]['type'] == 'Super Admin')
				{
					redirect(base_url('superadmin'));
				}

				if($result[0]['type'] == '')
				{
					if($result[0]['confirmation'] == 2)
					{
						redirect(base_url('member/confirmaccount'));
					}
					else
					{
						if($result[0]['status'] == 'D' || $result[0]['status'] == 'F')
						{
							redirect(base_url('member/deactivated'));
						}
						else
						{
							redirect(base_url('member'));
						}
					}
				}
			}
			else
			{
				redirect(base_url());
			}
		}

		public function logout(){
			$this->clubsociety_model->creatLog('logged out',$this->session->userdata('memberID'));
			$this->session->sess_destroy();
			redirect(base_url());
		}

		public function chat(){
			$this->load->view('chats');
		}

		public function insert_chat(){
			$content = $this->input->post('content');
			$content = $this->db->escape_str($content);
			$date = date('Y-m-d H:i:s');
			$data = array('sender' => $this->session->userdata('memberID'),
						  'recipient' => 'All',
						  'content' => $content,
						  'club' => $this->session->userdata('club'),
						  'date' => $date);
			
			$this->clubsociety_model->insertChat($data);
		}

		public function countChats(){
			echo $this->clubsociety_model->countChats();
		}

		public function loadMailBox(){
			$this->load->view('mailbox');
		}
	}
?>