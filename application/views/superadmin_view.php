<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Super Admin</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.0.2 -->
    <link href="<?php echo base_url('css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="<?php echo base_url('css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url('css/ionicons.min.css');?>" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?php echo base_url('css/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url('css/AdminLTE.css');?>" rel="stylesheet" type="text/css" />
</head>
<body class="skin-black">
    <?php include 'superadmin_header.php';?>
        
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include 'superadmin_sidebar.php';?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Main content -->
                <section class="content">
                    <div id="SA_main_content">
                        
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
    <!-- jQuery 2.0.2 -->
    <script src="<?php echo base_url('js/jquery.min.js');?>"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('js/bootstrap.min.js');?>" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?php echo base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
    <script src="<?php echo base_url('js/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('js/AdminLTE/app.js');?>" type="text/javascript"></script>
    <script>
        $(function(){
            clubs();
        });

        function loadClubs(club){
            document.getElementById('SA_main_content').innerHTML = '<br><br><center><img src="<?php echo base_url("img/ajax-loader1.gif");?>"></center>';

            $.post("<?php echo base_url('superadmin/loadClub');?>",{
                club: club
            },function(data,status){
                document.getElementById('SA_main_content').innerHTML = data;

                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        }

        function clubs(){
            document.getElementById('SA_main_content').innerHTML = '<br><br><center><img src="<?php echo base_url("img/ajax-loader1.gif");?>"></center>';

            $.post("<?php echo base_url('superadmin/clubs');?>",{
            },function(data,status){
               document.getElementById('SA_main_content').innerHTML = data;
            });
        }

        function deleteAccount(memberID){
            $.post("<?php echo base_url('superadmin/deleteAccount');?>",{
                memberID: memberID
            },function(data,status){
               clubs();
            });
        }

        function loadCreateAdminForm(){
            document.getElementById('SA_main_content').innerHTML = '<br><br><center><img src="<?php echo base_url("img/ajax-loader1.gif");?>"></center>';
            
            $.post("<?php echo base_url('superadmin/loadCreateAdmin');?>",{
            },function(data,status){
               document.getElementById('SA_main_content').innerHTML = data;
            });
        }
    </script>
</body>
</html>