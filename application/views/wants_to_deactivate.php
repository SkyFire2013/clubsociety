<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Club Members</h3>                                    
    </div>
    <div class="box-body table-responsive">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $row = $this->clubsociety_model->getMembersByStatus($status);
                    if(count($row) > 0)
                    {
                    	foreach ($row as $r){
                    
                    
                ?>
                <tr>
                    <td>
                        <?php echo $r['member_id'];?>
                    </td>
                    <td>
                        <?php echo $r['firstname']." ".$r['lastname'];?>
                    </td>
                    <td>
                        <?php
                            if($r['status'] == 'P' )
                            {
                               echo '<button class="btn btn-warning btn-sm" disabled="">Pending</button>'; 
                            }
                        ?>
                    </td>
                    <td>
                        <button id="<?php echo $r['member_id'];?>" class="btnDeactivate btn btn-danger btn-sm">Deactivate</button>
                    </td>
                </tr>
                <?php
                    	}
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>