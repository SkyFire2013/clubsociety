<?php
	class Clubsociety_model extends CI_Model{
		public function add_member($data){
			$this->db->insert('members', $data);
			$lastInsertID = $this->db->insert_id();
			$row = $this->getMember($lastInsertID);

			$data2 = array('memberID' => $lastInsertID,
						   'squestion1' => $this->input->post('squestion1'),
						   'sanswer1' => $this->input->post('sanswer1'),
						   'squestion2' => $this->input->post('squestion2'),
						   'sanswer2' => $this->input->post('sanswer2'));

			$this->db->insert('squestions', $data2);
			$this->addNotification('newmember',$row[0]['member_id'],'',$row[0]['club']);
			$this->creatLog('signed up as member',$lastInsertID);

			$code = rand(1111111111,999999999);
			$this->insertCode($lastInsertID,$code);
		}

		public function login($uname,$pword){
			$result = array();
			$query = $this->db->query("SELECT * FROM `members` WHERE `username` = '$uname' AND `password` = '$pword'");

			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function notification(){
			$club = $this->session->userdata('club');
			$type = $this->session->userdata('type');
			
			$result = array();

			$query = $this->db->query("SELECT * FROM `notification` WHERE `status` = '' AND `club` = '$club' AND `type` != '$type' ORDER BY `id` DESC");
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function notificationCount($notificationType){
			$query = $this->db->query("SELECT * FROM `notification` WHERE `status` = '' AND `notificationType` = '$notificationType'");
			return $query->num_rows();
		}

		public function adminNotificationCount(){
			$query = $this->db->query("SELECT * FROM `notification` WHERE `status` = '' AND `type` != 'Admin' AND `club` = '".$this->session->userdata('club')."'");
			
			$result = '';

			if($query->num_rows() > 0)
			{
				$result = $query->num_rows();
			}

			return $result;
		}

		public function getMember($id){
			$array = array('member_id' => $id);
			$result = array();

			$query = $this->db->get_where('members',$array);
			
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function deactivateMemberAccount(){
			$data = array('status' => 'P');
			$this->db->where('member_id', $this->session->userdata('memberID'));
			$this->db->update('members', $data);

			$row = $this->getMember($this->session->userdata('memberID'));
			$this->session->set_userdata('status',$row[0]['status']);

			$this->addNotification('deactivate',$this->session->userdata('memberID'),'',$this->session->userdata('club'));
			$this->creatLog('sent a notification to deactivate',$this->session->userdata('memberID'));
			redirect(base_url('member'));
		}

		public function addNotification($notificationType,$id,$id3,$club){
			$data = array('notificationType' => $notificationType,
						   'id2' => $id,
						   'id3' => $id3,
						   'club' => $club,
						   'type' => $this->session->userdata('type'));

			$this->db->insert('notification', $data);
		}

		public function post($data,$type){
			$this->db->insert('post', $data);

			$notType = $type.' posted';

			$this->clubsociety_model->addNotification($notType,$this->session->userdata('memberID'),$this->db->insert_id(),$this->session->userdata('club'));
			$this->creatLog('posted',$this->session->userdata('memberID'));
		}

		public function getAllPost(){
			$query = $query = $this->db->query("SELECT * FROM `post` WHERE `club` = '".$this->session->userdata('club')."' ORDER BY `id` DESC");

			$result = array();
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function getPost($post_id){
			$query = $this->db->get_where('post', array('id' => $post_id));
			$result = array();
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function addComment($data){
			$this->db->insert('comments', $data);
			$this->creatLog('commented on a post',$this->session->userdata('memberID'));
		}

		public function getPostComments($post_id){
			$query = $this->db->get_where('comments', array('post_id' => $post_id));
			$result = array();
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function checkIfYouLiked($post_id){
			$query = $this->db->query("SELECT * FROM `like` WHERE `post_id` = '$post_id' AND `liker_id` = '".$this->session->userdata('memberID')."'");	
			return $query->num_rows();
		}

		public function checkIfYouLiked2($post_id){
			$query = $this->db->query("SELECT * FROM `like` WHERE `post_id` = '$post_id' AND `liker_id` = '".$this->session->userdata('memberID')."'");	
			$like = '';
			
			if($query->num_rows() > 0)
			{
				$row = $query->result_array();
				$like = $row[0]['like'];
			}
			else
			{
				$like = 0;
			}			
			return $like;
		}

		public function likePost($data){
			$this->db->insert('like', $data);
			$this->creatLog('liked a post',$this->session->userdata('memberID'));
		}

		public function updateLike($post_id){
			$query = $this->db->query("SELECT * FROM `like` WHERE `post_id` = '$post_id' AND `liker_id` = '".$this->session->userdata('memberID')."'");
			
			if($query->num_rows() > 0){
				$row = $query->result_array(); 

				if($row[0]['like'] == 1){
					$this->db->query("UPDATE `like` SET `like` = 0 WHERE `post_id` = '$post_id' AND `liker_id` = '".$this->session->userdata('memberID')."'");
					$this->creatLog('liked a post',$this->session->userdata('memberID'));
				}

				if($row[0]['like'] == 0){
					$this->db->query("UPDATE `like` SET `like` = 1 WHERE `post_id` = '$post_id' AND `liker_id` = '".$this->session->userdata('memberID')."'");
					$this->creatLog('unliked a post',$this->session->userdata('memberID'));
				}
			}
		}

		public function countLike($post_id){
			$query = $this->db->query("SELECT * FROM `like` WHERE `post_id` = '$post_id' AND `like` = 1");
			return $query->num_rows();
		}

		public function memberNotificationCount(){
			$club = $this->session->userdata('club');
			$num = '';
			$query = $this->db->query("SELECT * FROM `notification` WHERE `status` = '' AND `club` = '$club' AND `type` = 'Admin'");
			
			if($query->num_rows() > 0){
				$num = $query->num_rows();
			}

			return $num;
		}

		public function getMemberNotifications(){
			$club = $this->session->userdata('club');
			$result = array();
			$query = $this->db->query("SELECT * FROM `notification` WHERE `status` = '' AND `club` = '$club' AND `type` = 'Admin'");
			
			if($query->num_rows() > 0){
				$result = $query->result_array();
			}

			return $result;
		}

		public function markAsViewedNotification($id){
			$data = array(
               'status' => 'V'
            );

			$this->db->where('id', $id);
			$this->db->update('notification', $data); 
		}

		public function creatLog($activity,$memberID){
			$data = array('memberID' => $memberID,
						  'activity' => $activity,
						  'club' => $this->session->userdata('club'),
						  'date' => date('Y-m-d H:i:s'));

			$this->db->insert('user_logs',$data);
		}

		public function getAllLogs(){
			$array = array('club' => $this->session->userdata('club'));
			$result = array();

			$query = $this->db->get_where('user_logs',$array);
			
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function getMembersByStatus($status){
			$result = array();
			$club = $this->session->userdata('club');
			$query = $this->db->query("SELECT * FROM `members` WHERE `status` = '$status' AND `club` = '$club'");
			
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function deactivateMember($memberID){
			$data = array('status' => 'D');
			$this->db->where('member_id', $memberID);
			$this->db->update('members', $data);
			$this->creatLog('deactivated an account',$this->session->userdata('memberID'));
		}

		public function activateMember($memberID){
			$data = array('status' => '');
			$this->db->where('member_id', $memberID);
			$this->db->update('members', $data);
			$this->creatLog('activated an account',$this->session->userdata('memberID'));
		}

		public function loadClubMembers($confirmation){
			$club = $this->session->userdata('club');
			$query = $this->db->query("SELECT * FROM `members` WHERE `type` != 'Admin' AND `club` = '$club' AND `confirmation` = '$confirmation'");

			$result = array();

			if($query->num_rows > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function updateAdminProfile($data){
			$this->db->where('member_id', $this->session->userdata('memberID'));
			$this->db->update('members', $data);
			$this->creatLog('updated his/her profile',$this->session->userdata('memberID'));
		}

		public function getAllClubAdmins(){
			$query = $this->db->get('club_admins');

			$result = array();

			if($query->num_rows > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function getSearchResults($string){
			$club = $this->session->userdata('club');
			$query = $this->db->query("SELECT * FROM `members` WHERE `club` = '$club' AND `type` != 'Admin' AND `type` != 'Super Admin' AND `firstname` LIKE '%".$string."%' OR `lastname` LIKE '%".$string."%'");

			$result = array();

			if($query->num_rows > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function insertCode($memberID,$code){
			$data = array('member_ID' => $memberID,
						  'code' => $code);

			$this->db->insert('verification', $data);
		}

		public function getCode($memberID){
			$array = array('member_ID' => $memberID);
			
			$result = array();

			$query = $this->db->get_where('verification',$array);
			
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function updateVerification($memberID){
			$data = array('status' => 'S');
			$this->db->where('member_id', $memberID);
			$this->db->update('verification', $data);
		}

		public function activateAccount($code){
			$query = $this->db->query("SELECT * FROM `verification` WHERE `code` = '$code' AND `member_ID` = ".$this->session->userdata('memberID')."");
			$result = 0;

			if($query->num_rows() > 0)
			{
				$result = $query->num_rows() > 0;
			}

			$data = array('confirmation' => 1);
			$this->db->where('member_id', $this->session->userdata('memberID'));
			$this->db->update('members', $data);

			return $result;
		}

		public function checkUsernameAndEmail($uname,$email){
			$query = $this->db->query("SELECT * FROM `members` WHERE `username` = '$uname' AND `email` = '$email'");
			$result = array();

			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function chats(){
			$club = $this->session->userdata('club');
			$query = $this->db->query("SELECT * FROM `messages` WHERE `status` != 'V' AND `recipient` = 'All' AND `club` = '$club'");
			$result = array();

			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function insertChat($data){
			$this->db->insert('messages', $data);
		}

		public function countChats(){
			$club = $this->session->userdata('club');
			$query = $this->db->query("SELECT * FROM `messages` WHERE `status` != 'V' AND `recipient` = 'All' AND `club` = '$club'");

			return $query->num_rows();
		}

		public function getMessages(){
			$memberID = $this->session->userdata('memberID');
			$club = $this->session->userdata('club');

			$result = array();

			$query = $this->db->query("SELECT * FROM `messages` WHERE `recipient` = '$memberID' AND `club` = '$club' ORDER BY `id` DESC");
			
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function getSentMessages(){
			$memberID = $this->session->userdata('memberID');
			$club = $this->session->userdata('club');

			$result = array();

			$query = $this->db->query("SELECT * FROM `messages` WHERE `sender` = '$memberID' AND `recipient` != 'All' AND `club` = '$club' ORDER BY `id` DESC");
			
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function getAllClubMembers(){
			$club = $this->session->userdata('club');
			$memberID = $this->session->userdata('memberID');

			$result = array();
			$query = $this->db->query("SELECT * FROM `members` WHERE `club` = '$club' AND `member_id` != ".$memberID."");
			
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function getMessage($id){
			$array = array('id' => $id);
			
			$result = array();

			$query = $this->db->get_where('messages',$array);
			
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function markMessageAsViewed($id){
			$data = array('status' => 'V');
			$this->db->where('id', $id);
			$this->db->update('messages', $data);
		}

		public function countUnreadMessages(){
			$memberID = $this->session->userdata('memberID');
			$club = $this->session->userdata('club');
			$query = $this->db->query("SELECT * FROM `messages` WHERE `recipient` = '$memberID' AND `club` = '$club' AND `status` = ''");
			return $query->num_rows();
		}

		public function loadClub($club){
			$result = array();
			$query = $this->db->query("SELECT * FROM `members` WHERE `club` = '$club' AND `confirmation` != 3 AND `status` = ''");

			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function deleteAccount($id){
			$this->db->delete('members', array('member_id' => $id));
		} 

		// Function to Delete selected record from table name students.
		public function delete_post($id){
			$this->db->where('id', $id);
			$this->db->delete('post');
		}

		public function checkUsername($username){
			$array = array('username' => $username);
			
			$result = array();

			$query = $this->db->get_where('members',$array);
			
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}

			return $result;
		}

		public function checkName($firstname,$lastname){
			$result = array();
			$query = $this->db->query("SELECT * FROM `members` WHERE `firstname` = '$firstname' AND `lastname` = '$lastname'");
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}
			return $result;
		}

		public function checkClub($firstname,$lastname,$club){
			$result = array();
			$query = $this->db->query("SELECT * FROM `members` WHERE `firstname` = '$firstname' AND `lastname` = '$lastname' AND `club` = '$club'");
			if($query->num_rows() > 0)
			{
				$result = $query->result_array();
			}
			return $result;
		}

		public function notifyToActivate(){
			$data = array('status' => 'F');
			$this->db->where('member_id', $this->session->userdata('memberID'));
			$this->db->update('members', $data);

			$row = $this->getMember($this->session->userdata('memberID'));
			$this->session->set_userdata('status',$row[0]['status']);

			$this->addNotification('requestedtoactivate',$this->session->userdata('memberID'),'',$this->session->userdata('club'));
			$this->creatLog('requested to activate',$this->session->userdata('memberID'));
		}
		
		
		
public function row_delete($id){}
	}
?>