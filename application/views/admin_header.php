<header class="header">
    <a href="<?php echo base_url('admin');?>" class="logo">
       Home
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
       <nav class="navbar navbar-static-top" role="navigation">
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a id="notification" href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-warning"></i>
                        <span id="notification_number" class="label label-warning"></span>
                    </a>
                    <ul id="notification_container" class="dropdown-menu">
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span><?php echo "(Admin) "; echo $this->session->userdata('fname')." ".$this->session->userdata('lname');?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-black">
                            <img style="width:90px;height:90px;" src="<?php echo base_url('uploads/'.$image.'')?>" class="img-circle"/>
                            <p>
                                <?php echo "(Admin)"; echo $this->session->userdata('fname')." ".$this->session->userdata('lname');?>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a id="loadAdminAccount" href="javascript:void(0)" class="btn btn-default btn-flat">Account</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url('home/logout')?>" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>