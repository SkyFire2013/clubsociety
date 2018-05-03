<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Club Members</h3>                                    
    </div>
    <div class="box-body table-responsive">


<table style="width:400px;" id="example2" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID Number</th>
            <th>Name</th>
            <th>Course</th>
            <th>Contact No.</th>
            <th>Email Address</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $row = $this->clubsociety_model->loadClubMembers(1);
            
            foreach ($row as $r){
        ?>
        <tr>
 <td>
                        <?php echo $r['id_no'];?>
                    </td>
            <td>
            	<a href="<?php echo base_url('member/profile/'.$r['member_id'].'')?>" target="_self">
            		<?php echo $r['firstname']." ".$r['lastname'];?>
            	</a>
                
            </td>
           <td>
                        <?php echo $r['course'];?>
                    </td>
 <td>
                        <?php echo $r['contact_no'];?>
                    </td>
<td>
                        <?php echo $r['email'];?>
                    </td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
</div>
</div>