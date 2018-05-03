<?php
	class Notification extends CI_Controller{
		public function memberNotificationCount(){
			echo $this->clubsociety_model->memberNotificationCount();
		}

		public function getMemberNotifications(){
			$this->load->view('memberNotifications');
		}

		public function markAsViewedNotification($id){
			$this->clubsociety_model->markAsViewedNotification($id);
		}
	}
?>