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
        <!-- DATA TABLES -->
        <link href="<?php echo base_url('css/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('css/AdminLTE.css');?>" rel="stylesheet" type="text/css" />
    </head>
    <body class="skin-black">
        <?php
            include 'admin_header.php';
        ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php
                include 'admin_sidebar.php';
            ?>
            <aside class="right-side">
                <section class="content">
                    <div id="main_content">
                        <?php
                            $row = $this->clubsociety_model->getMember($memberID);

                            if(count($row) > 0)
                            {
                                if($row[0]['club'] == $this->session->userdata('club'))
                                {
                        ?>
                        <div style="width:600px;" class="box box-primary">
                            <div class="box-body">
                                <table cellpadding="5">
                                    <tr>
                                        <td valign="top">
                                            <img style="width:200px;height:200px;" src="<?php 
                                            if($row[0]['image'] != '')
                                            {
                                                echo base_url('uploads/'.$row[0]['image'].'');
                                            }
                                            else
                                            {
                                               echo base_url('uploads/no_profile_pic.jpg'); 
                                            }
                                            ?>">
                                        </td>
                                        <td valign="top">



                                            <h3><b>Name:</b> <?php echo $row[0]['firstname']." ".$row[0]['lastname'];?></h3>
                                            <h3><b>Club:</b> 
                                            
                                            <?php
                                                if($row[0]['club'] == 'BC')
                                                {
                                                    echo "Business Club";
                                                }

                                                if($row[0]['club'] == 'GC')
                                                {
                                                    echo "Glee Club";
                                                }

                                                if($row[0]['club'] == 'PC')
                                                {
                                                    echo "Pen Club";
                                                }

                                                if($row[0]['club'] == 'DC')
                                                {
                                                    echo "Dance Club";
                                                }

                                                if($row[0]['club'] == 'YFC')
                                                {
                                                    echo "Youth For Christ Club";
                                                }
                                            ?>
                                            </h3>
<h3><b>Course:</b>
<?php echo $row[0]['course'];?></h3>

                                           
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div style="width:600px;" class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Personal Information</h3>
                            </div>
                            <div class="box-body">
                                <table>
                                    <tr>
                                        <td valign="top">
                                            <label>Email: </label> 
                                            <span style="margin-left:10px;"></span>
                                            <?php echo $row[0]['email'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <label>Contact No.: </label>
                                            <span style="margin-left:10px;"></span>
                                            <?php
                                                if($row[0]['contact_no'] != '')
                                                {
                                                    echo $row[0]['contact_no'];
                                                }
                                                else
                                                {
                                                    echo 'N/A';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <label>Birthday: </label> 
                                            <span style="margin-left:10px;"></span>
                                            <?php
                                                if($row[0]['birthdate'] != '')
                                                {
                                                    echo $row[0]['birthdate'];
                                                }
                                                else
                                                {
                                                    echo 'N/A';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <label>Gender: </label>
                                            <span style="margin-left:10px;"></span>
                                            <?php
                                                if($row[0]['gender'] != '')
                                                {
                                                    echo $row[0]['gender'];
                                                }
                                                else
                                                {
                                                    echo 'N/A';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div style="width:600px;" class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Address</h3>
                            </div>
                            <div class="box-body">
                                <table>
                                    <tr>
                                        <td valign="top">
                                            <label>City Address: </label>
                                            <span style="margin-left:10px;"></span>
                                            <?php
                                                if($row[0]['address'] != '')
                                                {
                                                    echo $row[0]['address'];
                                                }
                                                else
                                                {
                                                    echo 'N/A';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <label>Provincial Address: </label>
                                            <span style="margin-left:10px;"></span>
                                            <?php
                                                if($row[0]['hometown'] != '')
                                                {
                                                    echo $row[0]['hometown'];
                                                }
                                                else
                                                {
                                                    echo 'N/A';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div style="width:600px;" class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Education</h3>
                            </div>
                            <div class="box-body">
                                <table>
                                    <tr>
                                        <td valign="top">
                                            <label>College: </label>
                                            <span style="margin-left:10px;"></span>
                                            <?php
                                                if($row[0]['college'] != '')
                                                {
                                                    echo $row[0]['college'];
                                                }
                                                else
                                                {
                                                    echo 'N/A';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <label>High School: </label>
                                            <span style="margin-left:10px;"></span>
                                            <?php
                                                if($row[0]['high_school'] != '')
                                                {
                                                    echo $row[0]['high_school'];
                                                }
                                                else
                                                {
                                                    echo 'N/A';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div style="width:600px;" class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">About</h3>
                            </div>
                            <div class="box-body">
                                <table>
                                    <tr>
                                        <td valign="top">
                                            <label>About Me: </label>
                                            <span style="margin-left:10px;"></span>
                                            <?php
                                                if($row[0]['aboutme'] != '')
                                                {
                                                    echo $row[0]['aboutme'];
                                                }
                                                else
                                                {
                                                    echo 'N/A';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top">
                                            <label>Interest: </label>
                                            <span style="margin-left:10px;"></span>
                                            <?php
                                                if($row[0]['interest'] != '')
                                                {
                                                    echo $row[0]['interest'];
                                                }
                                                else
                                                {
                                                    echo 'N/A';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <?php
                                }
                                else
                                {
                                    echo '<h1>This member doesn\'t belong to your club!</h1>';
                                }
                            }
                            else
                            {
                                echo '<h1>No Member Found!</h1>';
                            }
                        ?>
                    </div>
                    </div>
                </section>
            </aside>
        </div>

        <!-- jQuery 2.0.2 -->
        <script src="<?php echo base_url('js/jquery.min.js');?>"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url('js/bootstrap.min.js');?>" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="<?php echo base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
        <script src="<?php echo base_url('js/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url('js/AdminLTE/app.js');?>" type="text/javascript"></script>

        <?php
            include 'admin_scripts.php';
        ?>
    </body>
</html>





















