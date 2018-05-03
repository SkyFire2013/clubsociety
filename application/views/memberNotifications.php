<ul class="menu">
	<?php
		$rows = $this->clubsociety_model->getMemberNotifications();

		foreach ($rows as $r) {
	?>
	<li>
		<a class="notification" id="<?php echo $r['id'];?>" href="<?php echo base_url('member/post/'.$r['id3'].'');?>" target="_self">
			<i class="glyphicon glyphicon-user danger"></i>
			<?php
				$member = $this->clubsociety_model->getMember($r['id2']);

				echo $member[0]['firstname']." ".$member[0]['lastname'];
			?> Posted
		</a>
	</li>
	<?php
		}
	?>
</ul>