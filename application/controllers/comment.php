<?php
	class Comment extends CI_Controller{
		public function addComment(){
			$post_id = $this->input->post('post_id');
			$comment = $this->input->post('comment');

			if($comment != "")
			{
				$date = date('Y-m-d H:i:s');
				$data = array('text' => $comment,
							  'post_id' => $post_id,
							  'comment_by_id' => $this->session->userdata('memberID'),
							  'club' => $this->session->userdata('club'),
							  'date' => $date);

				$this->clubsociety_model->addComment($data);
			}
		}
	}
?>