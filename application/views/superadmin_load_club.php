<div style="width:800px;" class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">
        <?php
            switch ($club) {
                case 'BC':
                    echo 'Business Club';
                break;

                case 'DC':
                    echo 'Dance Club';
                break;

                case 'GC':
                    echo 'Glee Club';
                break;

                case 'PC':
                    echo 'Pen Club';
                break;

                case 'YFC':
                    echo 'Youth For Christ Club';
                break;
                
                default:
                    echo 'Club';
                break;
            }
        ?>
        </h3>                                    
    </div><!-- /.box-header -->
    <div class="box-body table-responsive">
        <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid"><div class="row"><div class="col-xs-6"></div><div class="col-xs-6"></div></div>
        <table id="example2" class="table table-bordered table-hover dataTable" aria-describedby="example2_info">
            <thead>
                <tr role="row">
                    <th>Name</th>
                    <th width="50px">Role</th>
                    <th width="100px">Action</th>
                </tr>
            </thead>
             <tbody role="alert" aria-live="polite" aria-relevant="all">
                <?php
                    $row = $this->clubsociety_model->loadClub($club);

                    if(count($row) > 0)
                    {
                        foreach ($row as $r) {
                ?>
                <tr>
                    <td>
                        <?php
                            echo $r['firstname']." ".$r['lastname'];
                        ?>
                    </td>
                    <td>
                        <?php
                            if($r['type'] == 'Admin')
                            {
                                echo '<button class="btn btn-danger btn-sm" disabled>'.$r['type'].'</button>';
                            }
                            else
                            {
                                echo '<button class="btn btn-info btn-sm" disabled>Member</button>';
                            }
                        ?>
                    </td>
                    <td>
                        <button onclick="deleteAccount(<?php echo $r['member_id'];?>);" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div>