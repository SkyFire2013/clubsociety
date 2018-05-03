<header class="header">
    <a href="<?php echo base_url('superadmin');?>" class="logo">
        <!-- Add the class icon to your logo image or logo icon to add the margining -->
        Online Club System
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <div class="navbar-right">
            <ul class="nav navbar-nav"> 
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span><?php echo "(Admin) "; echo $this->session->userdata('fname')." ".$this->session->userdata('lname');?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header bg-light-blue">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                            <p>
                                <?php echo "(Admin)"; echo $this->session->userdata('fname')." ".$this->session->userdata('lname');?>
                            </p>
                        </li>
                        <li class="user-footer">
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