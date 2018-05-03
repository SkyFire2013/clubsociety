<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Forgot password</title>
        <link href="<?php echo base_url('css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url('css/ionicons.min.css');?>" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('css/AdminLTE.css');?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('css/clubsociety.css');?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div style="height:100px;">
        </div>
            <?php
                if($message == '')
                {
            ?>
            <div class="center" style="width:350px;">
                <div style="padding:10px;border-radius:3px;" class="alert-danger">
                    Enter your Username and Email to recover your Password.  
                </div>
            </div>
            <br>
            <div style="width:350px;" class="center box box-danger">
                <form method="POST" action="<?php echo base_url('member/checkUsernameAndEmail')?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input name="uname" class="form-control" type="text" placeholder="Enter your username here" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" class="form-control" type="email" placeholder="Enter your email here" required>
                        </div>
                        
                        <table style="width:100%;">
                            <tr>
                                <td align="right">
                                    <button style="" class="btn btn-primary btn-block btn-danger">Recover Password</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
            <?php
                }
            ?>

            <?php
                if($message == 'fail')
                {
            ?>
            <div class="center" style="width:350px;">
                <div style="padding:10px;border-radius:3px;" class="alert-danger">
                    The Username or Email you entered is incorrect. Please try again.  
                </div>
            </div>
            <br>
            <div style="width:350px;" class="center box box-danger">
                <form method="POST" action="<?php echo base_url('member/checkUsernameAndEmail')?>">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Username</label>
                            <input name="uname" class="form-control" type="text" placeholder="Enter your Username here" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" class="form-control" type="email" placeholder="Enter your Email here" required>
                        </div>
                        
                        <table style="width:100%;">
                            <tr>
                                <td align="right">
                                    <button style="" class="btn btn-primary btn-block btn-danger">Recover Password</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
            <?php
                }
            ?>

            <?php
                if($message == 'success')
                {
            ?>
            <div class="center" style="width:350px;">
                <div style="padding:10px;border-radius:3px;" class="alert-success">
                    Your password has been sent to your email.
                </div>
            </div>
            <?php
                }
            ?>
    </body>
</html>
