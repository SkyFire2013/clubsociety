<?php
    $memberID = $this->session->userdata('memberID');
    $result = $this->clubsociety_model->getMember($memberID);
?>
<div style="width:500px;" class="box box-warning">
    <div class="box-header" style="cursor: move;">
        <h3 class="box-title">Account</h3>
    </div>
    <div class="box-body">
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="username" placeholder="Username" value="<?php echo $result[0]['username'];?>">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" value="<?php echo $result[0]['password'];?>">
        </div>
    </div>
    <div class="box-footer">
        <form action="<?php echo base_url('member/deactivateMemberAccount')?>">
            <table style="width:100%;">
                <tr>
                    <td>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </td>
                    <td align="right">
                        <?php 
                            if($this->session->userdata('status') == 'P')
                            {
                                echo '<button type="submit" class="btn btn-danger" disabled>Waiting for Admin</button>';
                            }
                            else
                            {
                                echo '<button type="submit" class="btn btn-danger">De - activate Account</button>';
                            }
                        ?>  
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>