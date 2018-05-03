<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Club Members</h3>                                    
    </div>
    <div class="box-body table-responsive">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    
                    <th>ID Number </th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Verification Code</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $row = $this->clubsociety_model->loadClubMembers($confirmation);
                    
                    foreach ($row as $r){
                    
                ?>
                <tr>
                    
 <td>
                        <?php echo $r['id_no'];?>
                    </td>
                    <td>
                    	<a href="<?php echo base_url('admin/profile/'.$r['member_id'].'')?>" target="_self">
                    		<?php echo $r['firstname']." ".$r['lastname'];?>
                    	</a>
                        
                    </td>
                    <td>
                        <?php
                            $ver = $this->clubsociety_model->getCode($r['member_id']);
                            $code = '';
                            $verStatus = '';
                            if(count($ver) > 0)
                            {
                               $code = $ver[0]['code'];
                               $verStatus = $ver[0]['status'];
                            }

                            if($r['status'] == 'D')
                            {
                               echo '<button class="btn btn-danger btn-sm" disabled="">Deactivated</button>'; 
                            }

                            if($r['status'] == 'F')
                            {
                               echo '<button class="btn btn-warning btn-sm" disabled="">Requesting for Activation</button>'; 
                            }
                             
                            if($r['status'] == '')
                            {
                               echo '<button class="btn btn-warning btn-sm" disabled="">Activated</button>'; 
                            }

                           
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $code;
                        ?>
                    </td>
                    <td>
                        <?php 
                            if($r['status'] == 'D' || $r['status'] == 'F')
                            {
                               echo '<button id="'.$r['member_id'].'" class="btnActivate btn btn-success btn-sm">Activate</button>'; 
                            }

                            if($r['confirmation'] == '2')
                            {
                               if($verStatus != 'S')
                               {
                                    echo '<button onclick="sendConfirmationCode('.$r['member_id'].','.$code.')" class="btn btn-primary btn-sm">Approve</button>'; 
                               }
                            }
                        ?>
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>