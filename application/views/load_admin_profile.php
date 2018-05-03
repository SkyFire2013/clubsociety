<?php
    $admin = $this->clubsociety_model->getMember($this->session->userdata('memberID'));

?>
<div style="width:500px;" class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Admin Account</h3>                                    
    </div>
    <div class="box-body">
    	<div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="username" value="<?php echo $admin[0]['username'];?>">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="password" value="<?php echo $admin[0]['password'];?>">
        </div>
        <div class="form-group">
            <label>Firstname</label>
            <input type="text" class="form-control" id="firstname" value="<?php echo $admin[0]['firstname'];?>">
        </div>
        <div class="form-group">
            <label>Lastname</label>
            <input type="text" class="form-control" id="lastname" value="<?php echo $admin[0]['lastname'];?>">
        </div> 
    </div>

    </div>
    <div class="box-footer">
        <div class="form-group">
            <button class="btn btn-primary" id="btnUpdateAdmin">Update</button>
        </div>
    </div>
</div>