<div style="width:600px;" class="box box-primary">
   <div class="box-body">
   		<?php
   			$results = $this->clubsociety_model->getSearchResults($string);

   			if(count($results)) 
   			{
   		?>
        <table cellpadding="5">
        	<?php
        		foreach ($results as $r) 
        		{
        			if($r['image'] == '')
        			{
        				$r['image'] = 'no_profile_pic.jpg';
        			} 
        	?>
        	<tr>
        		<td>
        			<img style="width:50px;height:50px;"src="<?php echo base_url('uploads/thumbnails/'.$r['image'].'');?>" class="img-circle">
        		</td>
        		<td>
        			<label>
        				<a href="<?php echo base_url('member/profile/'.$r['member_id'].'');?>" target="_self">
        					<?php echo $r['firstname']." ".$r['lastname'];?>
        				</a>
        			</label>
        		</td>
        	</tr>
        <?php
        		}
        	}
        	else
        	{
        		echo "<h4>No results found!</h4>";
        	}
        ?>
        </table>
    </div>
</div>