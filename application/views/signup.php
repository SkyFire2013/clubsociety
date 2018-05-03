<!DOCTYPE html>
<html>
<head>
	<title>Online Club System</title>
	<!-- bootstrap 3.0.2 -->
	<link href="<?php echo base_url('css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo base_url('css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link type="text/css" rel="stylesheet" href="nilstyle/modal.css"/>

    <link href="<?php echo base_url('css/ionicons.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('css/AdminLTE.css');?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('css/clubsociety.css');?>" rel="stylesheet" type="text/css" />
</head>
<body id="signup">


	<div style="height:50px;"></div>
	<form method="POST" enctype="multipart/form-data" action="<?php echo base_url('signup/process_signup');?>">
	<div class="center" id="signup-form">
		<div style="width:500px;">
			<?php
				if($message == 'username_taken'){
			?>
            <div style="padding:10px;border-radius:3px;" class="alert-danger">
                <b>Username already taken</b> 
            </div>
            <?php
				}
				if($message == 'already_a_member')
				{
			?>
			<div style="padding:10px;border-radius:3px;" class="alert-danger">
                <b>You are already a member of that club.</b> 
            </div>
			<?php
				}

				if($message == 'maximum')
				{
			?>
			<div style="padding:10px;border-radius:3px;" class="alert-danger">
                <b>You are already a member of 2 different clubs, maximum of 2 clubs per student.</b> 
            </div>
			<?php
				}
			?>
        </div>
        <br>
		<div class="box box-primary">
		    <div class="box-header">
		        <h3 class="box-title">Account</h3>
		    </div>
	        <div class="box-body">
	        	<div class="form-group">
	        		<label>
	                	Club
	                <span style="color:#f00;">*</span>
	                </label>
	                <?php
	                	$admins = $this->clubsociety_model->getAllClubAdmins();
	                ?>

	        		<select name="club" class="form-control" required>
                        <option value="">Select Club</option>
                        <?php
                        	foreach ($admins as $a) {
                        		$name = $this->clubsociety_model->getMember($a['adminID']);
                        		
                        		$a_name = '';
                        		
                        		if(count($name) > 0)
                        		{
                        			$a_name = $name[0]['firstname'].' '.$name[0]['lastname'];
                        		}
                        		
                        		echo '<option value="'.$a['club'].'">'.$a['label'].' ('.$a_name.')</option>';
                        	}
                        ?>
                    </select>
	        	</div>
	        	
<div class="form-group">
	                <label>
	                	Course
	                <span style="color:#f00;">*</span>
	                </label>
	                <input name="course" type="text" class="form-control" placeholder="Course" required>
	            </div>




<div class="form-group">
	                <label>
	                	ID Number
	                <span style="color:#f00;">*</span>
	                </label>
	                <input name="id_no" type="text" class="form-control" placeholder="ID Number" required>
	            </div>


	            <div class="form-group">
	                <label>
	                	Username
	                <span style="color:#f00;">*</span>
	                </label>
	                <input name="username" type="text" class="form-control" placeholder="Username" required>
	            </div>
	            <div class="form-group">
	                <label>Password
	                <span style="color:#f00;">*</span>
	                </label>
	                <input name="password" type="password" class="form-control" placeholder="Password" required>
	            </div>
	        </div>
		</div>
		<div class="box box-primary">
		    <div class="box-header">
		        <h3 class="box-title">Personal</h3>
		    </div>
	        <div class="box-body">
	        	<div class="form-group">
	                <label>
	               	Profile Picture
	                <span style="color:#f00;">*</span>
	                </label>
	                <input name="profile_pic" type="file" placeholder="image" required>
	            </div>
	        	<div class="form-group">
	                <label>
	                Firstname
	                <span style="color:#f00;">*</span>
	                </label>
	                <input name="firstname" type="text" class="form-control" placeholder="Firstname" required>
	            </div>
	            <div class="form-group">
	                <label>
	                	Lastname
	                	<span style="color:#f00;">*</span>
	                </label>
	                <input name="lastname" type="text" class="form-control" placeholder="Lastname" required>
	            </div>
	            <div class="form-group">
	                <label>Email Address</label>
	                <span style="color:#f00;">*</span>
	                <input name="email" type="text" class="form-control" placeholder="Email Address" required>
	            </div>
	            <div class="form-group">
	                <label>Address</label>
               <span style="color:#f00;">*</span>
	                <input name="address" type="text" class="form-control" placeholder="Address/City" required>
	            </div>

 <div class="form-group">
	                <label>Contact Number</label>
               <span style="color:#f00;">*</span>
	                <input name="contact_no" type="text" class="form-control" placeholder="Contact Number" required>
	            </div>


	            <div class="form-group">
	            	<label>Birthday</label>
	            	<table>
	            		<tr>
	            			<td>
	            				<select name="month" class="form-control month">
			                        <option value="">Month</option>
			                        <option value="1">Jan</option>
			                        <option value="2">Feb</option>
			                        <option value="3">March</option>
			                        <option value="4">April</option>
			                        <option value="5">May</option>
			                        <option value="6">June</option>
			                        <option value="7">July</option>
			                        <option value="8">Aug</option>
			                        <option value="9">Sep</option>
			                        <option value="10">Oct</option>
			                        <option value="11">Nov</option>
			                        <option value="12">Dec</option>
			                    </select>
	            			</td>
	            			<td>
	            				<select name="day" class="form-control day">
			                        <option value="">Day</option>
			                        <?php
			                        	for($i=1; $i <= 31; $i++) { 
			                        		echo '<option value="'.$i.'">'.$i.'</option>';
			                        	}
			                        ?>
			                    </select>
	            			</td>
	            			<td>
	            				<select name="year" class="form-control year">
			                        <option value="">Year</option>
			                        <?php
			                        	for($i=1900; $i <= 2015; $i++) { 
			                        		echo '<option value="'.$i.'">'.$i.'</option>';
			                        	}
			                        ?>
			                    </select>
	            			</td>
	            		</tr>
	            	</table>
	            </div>
	            <div class="form-group"> 
                	<label>Gender</label>
                	<br>
                    <input type="radio" name="gender" value="Male" checked="true">
                    <label class="gender-label">Male</label>
                    <span style="margin-left:20px;"></span>
                    <input type="radio" name="gender" value="Female">
                    <label class="gender-label">Female</label>
                </div>
	        </div>
		</div>
		<div class="box box-primary">
	        <div class="box-footer">
	            <button type="submit" class="btn btn-primary">Submit</button>
	            <a class="btn btn-success" href="http://www.britechcs.com/">Back</a>
	        </div>
		</div>
		
		
				
	      
	        
	           
	      
		
	</div>
	</form>

  <script src="nilstyle/jquery.min.js"></script>
    <script src="nilstyle/bootstrap.min.js"></script>

	
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
       <span class="login_text">Login Form</span>
	  <br><br><br><br><br><br><br><br><br><br><br><br><br><br>

				            <form method="POST" action="<?php echo base_url('home/login');?>">
				                
				                	<div class="form-group" style="font-size:16px;margin-left:10px;" >
				                        <input type="radio" name="member" checked="">
				                        <span style="margin-left:5px;"></span>Member
				                        <span style="margin-left:20px;"></span>
				                        <input type="radio" name="member">
				                        <span style="margin-left:5px;"></span>Admin
				                    </div><br>
				                    	   <div class="input-group-index">
									          <div class="input-group-addon-index"></div>
									          <input name="uname" class="form-control-index" type="text" placeholder="Enter Username" required>
									        </div>
										<div class="form-group">
										        <label class="sr-only" ></label>
										        <input name="pword" type="password" class="form-control-index" placeholder="Password" required><br>
										      </div>

				                  

				     
				      

		<div align="center"><button type="submit" class="btn_lr btn-success" value="submit">Login</button></div><br>
		<p  align="center" style="font-size:14px; color:white; margin-left:20px; text-align:left;"> <a href="<?php echo base_url('member/forgotpassword');?>"><font color="white">Forgot password?</font></a></p><br>
    </div>
  </div>
</div>

		
</form>
<!-- -------- modal login form end---------------------------------------------------------------------->
</body>
</html>