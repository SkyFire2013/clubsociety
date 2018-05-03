<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Deactivated Account</title>
        <link href="<?php echo base_url('css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('css/ionicons.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('css/AdminLTE.css');?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div style="height:200px;">
        </div>
        <center>
            <div style="width:350px;">
                <?php
                    $disabled = "";
                    if($this->session->userdata('status') == 'D')
                    {
                        $disabled = "";
                ?>
                <div style="padding:10px;border-radius:3px;" class="alert-danger">
                    Your account has been deactivated.
                </div>
                <?php
                    }
                    
                    if($this->session->userdata('status') == 'F')
                    {
                        $disabled = "disabled";
                ?>
                <div style="padding:10px;border-radius:3px;" class="alert-success">
                    The Admin of your club has been notified to activated your account.
                </div>
                <?php
                    }
                ?>
            </div>
            <br>
            <div style="width:350px;">
                <form method="POST" action="<?php 
                    if($this->session->userdata('status') == 'D')
                    {
                        echo base_url('member/notifyToActivate');
                    }?>">
                <table style="width:100%;">
                    <tr>
                        <td style="width:50%;">
                                <button style="width:160px;" class="btn btn-success" <?php echo $disabled;?>>Request Activation</button>
                            </form>
                        </td>
                        <td style="width:50%;" align="right">
                            <form method="POST" action="<?php echo base_url('home/logout')?>">
                                <button style="width:160px;" class="btn btn-primary">Logout</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </center>
    </body>
</html>
