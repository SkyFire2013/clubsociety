<header class="header">
    <a href="<?php echo base_url('member');?>" class="logo">
        <?php
            switch ($this->session->userdata('club')) {
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
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <div style="position:absolute;padding:10px;">
            <div style="margin-left:5px;width:300px;" class="input-group input-group-sm">            
            <input id="searchBox" type="text" class="form-control" placeholder="Search....">
                <span class="input-group-btn">
                    <button id="btnSearch" class="btn btn-info btn-flat" type="button">Go!</button>
                </span>
            </div>
        </div>  
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <a id="memberNotificationsIcon" href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-warning"></i>
                        <span id="memberNotificationCount" class="label label-warning"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">
                        <?php
                            $notCount = $this->clubsociety_model->memberNotificationCount();
                            if($notCount == 0 || $notCount == '')
                            {
                                echo "You don't have any notification(s)";    
                            }

                            if($notCount > 0)
                            {
                                echo "You have ".$notCount." notification(s)";    
                            }
                        ?>
                        <li>
                            <div id="memberNotifications">
                                
                            </div>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span><?php echo $this->session->userdata('fname')." ".$this->session->userdata('lname');?> <i class="caret"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header bg-light-blue">
                            <img style="width:90px;height:90px;" src="<?php echo base_url('uploads/'.$image.'')?>" class="img-circle"/>
                            <p>
                                <?php echo $this->session->userdata('fname')." ".$this->session->userdata('lname');?>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a id="memberProfileAccount" href="javascript:void(0)" class="btn btn-default btn-flat">Account</a>
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