<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Confirm Account</title>
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
                <div style="padding:10px;border-radius:3px;" class="alert-danger">
                    Your account is not yet activated, please check your <b>email</b> for the <b>activation code</b>, or ask the <b>Club Admin</b> for the <b>activation code</b>.  
                </div>
            </div>
            <br>
            <div style="width:350px;" class="box box-danger">
                <div class="box-body">
                    <form method="POST" action="<?php echo base_url('member/activateAccount')?>">
                    <input name="code" class="form-control input-lg" type="text" placeholder="Enter the code here">
                    <div style="height:10px;"></div>
                    <table style="width:100%;">
                        <tr>
                            <td style="width:50%;">
                                
                                    <button style="width:160px;" class="btn btn-success">Activate</button>
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
            </div>
        </center>
    </body>
</html>
