<div style="width:500px;" class="box box-danger">
    <div class="box-header">
        <h3 class="box-title">
        Create Admin Account
        </h3>                                    
    </div>
     <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('superadmin/createAdminAccount');?>">
    <div class="box-body">
        <div class="form-group">
            <label>Club</label>
            <select name="a_club" style="width:150px;" class="form-control" required>
                <option value="BC">Business Club</option>
                <option value="DC">Dance Club</option>
                <option value="GC">Glee Club</option>
                <option value="PC">Pen Club</option>
                <option value="YFC">Youth For Christ Club</option>
            </select>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" name="a_username" placeholder="Username" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" name="a_password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <label>Firstname</label>
            <input type="text" class="form-control" name="a_firstname" placeholder="Firstname" required>
        </div>
        <div class="form-group">
            <label>Lastname</label>
            <input type="text" class="form-control" name="a_lastname" placeholder="Lastname" required>
        </div>
        <div class="form-group">
            <label>Profile Picture</label>
            <input type="file" name="a_pp"  required>
        </div>
    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
</div>