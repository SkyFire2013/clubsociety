<?php
    if($this->session->userdata('image') == '')
    {
        $image = 'no_profile_pic.jpg';
    }
    else
    {
        $image = $this->session->userdata('image');
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $this->session->userdata('fname')." ".$this->session->userdata('lname');?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo base_url('css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo base_url('css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('css/ionicons.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('css/AdminLTE.css');?>" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url('css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="<?php echo base_url('css/iCheck/minimal/blue.css');?>" rel="stylesheet" type="text/css" />

    </head>
    <body class="skin-blue">
        <?php
            include 'header.php';
        ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php
                include 'sidebar.php';
            ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Main content -->
                <section class="content">
                    <div id="memberMainContent">
                        <div style="height:500px;" class="box box-solid">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-3 col-sm-4">
                                        <!-- BOXES are complex enough to move the .box-header around.
                                             This is an example of having the box header within the box body -->
                                        <div class="box-header">
                                            <i class="fa fa-envelope"></i>
                                            <h3 class="box-title">Private Message</h3>
                                        </div>
                                        <!-- compose message btn -->
                                        <a id="compose_message" class="btn btn-block btn-primary"><i class="fa fa-pencil"></i> Compose Message</a>
                                        <!-- Navigation - folders-->
                                        <div style="margin-top: 15px;">
                                            <ul class="nav nav-pills nav-stacked">
                                                <li id="inbox" class="active"><a href="javascript:loadInbox()"><i class="fa fa-inbox"></i> Inbox 
                                                
                                                <span id="countUnread">
                                                    
                                                </span>
                                                </a></li>
                                                <li id="sent"><a href="javascript:loadSent()"><i class="fa fa-mail-forward"></i> Sent</a></li>
                                            </ul>
                                        </div>
                                    </div><!-- /.col (LEFT) -->
                                    <div class="col-md-9 col-sm-8">
                                        <div class="row pad">
                                            
                                        </div>
                                        <div id="mailbox" style="height:445px;overflow:auto;" class="table-responsive">
                                            
                                        </div><!-- /.table-responsive -->
                                    </div><!-- /.col (RIGHT) -->
                                </div><!-- /.row -->
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                </section>
            </aside>
        </div>
        <!-- jQuery 2.0.2 -->
        <script src="<?php echo base_url('js/jquery.min.js');?>"></script>
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>-->
        <!-- Bootstrap -->
        <script src="<?php echo base_url('js/bootstrap.min.js');?>" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('js/AdminLTE/app.js');?>" type="text/javascript"></script>

        <script src="<?php echo base_url('js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('js/plugins/iCheck/icheck.min.js');?>" type="text/javascript"></script>

        <script>
            $(function() {
                loadInbox();
                countUnreadMessages();
            });
        </script>
        <?php
            include 'scripts.php';
        ?>
    </body>
</html>