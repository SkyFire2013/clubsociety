<?php
	class Post extends CI_Controller{
		public function adminpost(){
			$data['dir'] = '../';
			$this->load->view('post_view',$data);
		}

		public function loadPost($post_id){
			$data['post_id'] = $post_id;
			$this->load->view('post',$data);
		}

		public function likePost(){
			$post_id = $this->input->post('post_id');

			$liked = $this->clubsociety_model->checkIfYouLiked($post_id);

			if($liked > 0)
			{
				$this->clubsociety_model->updateLike($post_id);
			}
			else
			{
				$data = array('post_id' => $post_id,
							  'liker_id' => $this->session->userdata('memberID'),
							  'like' => 1);
				$this->clubsociety_model->likePost($data);
			}
		}
		
		
		public function delete_post()
		{
			$id = $this->input->post('id');
			echo $this->clubsociety_model->delete_post($id);
		}		
	}
?>