<?php
	class Ajaxload extends CI_Controller{
		public function loadClubMembers($confirmation)
		{
			$data['confirmation'] = $confirmation;
            		$this->load->view('load_club_members',$data);
		}

		public function loadNotifications(){
			$result = $this->clubsociety_model->notification();

			if(count($result) > 0)
			{
				echo '<li class="header">You have '.count($result).' notification(s)</li>';
			}
			else
			{
				echo '<li class="header">You don\'t have notification(s)</li>';
			}
			
	            echo '<li>';
	            echo '<ul class="menu">';
	            echo '<li>';
	            

            if(count($result) > 0)
            {
                foreach($result as $row) {
                	$member = $this->clubsociety_model->getMember($row['id2']);
                	$firstname = '';
                	
                	if(count($member) > 0)
                	{
                		$firstname = $member[0]['firstname'];
                	}
                	
                	if($row['notificationType'] == 'newmember')
                	{
                		
                		
                		echo '<a id="'.$row['id'].'" class="new_member notification" href="javascript:loadClubMembers(2)">
                                <i class="glyphicon glyphicon-user info"></i> '.$firstname.' wants to join your club
                            </a>';
                	}

                	if($row['notificationType'] == 'deactivate')
                	{
                		echo '<a id="'.$row['id'].'" class="notification" href="javascript:getMembersByStatus(1)">
                                <i class="fa fa-warning danger"></i> '.$firstname.' wants to deactivate his/her account
                            </a>';
                	}

                    if($row['notificationType'] == 'member posted')
                    {
                        echo '<a id="'.$row['id'].'" class="notification" href="'.base_url('admin/post/'.$row['id3'].'').'" target="_BLANK">
                                <i class="glyphicon glyphicon-share danger"></i> '.$firstname.' posted
                            </a>';
                    }

                    if($row['notificationType'] == 'requestedtoactivate')
                    {
                        echo '<a id="'.$row['id'].'" class="notification" href="javascript:loadAllMembers()">
                                <i class="glyphicon glyphicon-user warning"></i> '.$firstname.' requested to activate
                            </a>';
                    }
                }
            }
             
            echo '</li>';  
            echo '</ul>';
            echo '</li>';
		}

		public function loadNotificationCount($notificationType){
			echo $this->clubsociety_model->notificationCount($notificationType);
		}

		public function loadAcountProfile(){
			echo '';
		}
	}
?>