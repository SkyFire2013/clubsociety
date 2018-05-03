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
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
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
                <table>
                    <tr>
                        <td valign="top">
                            <section class="content">
                                <div id="main_content" style="width:500px;">
                                    <div style="width:500px;" class="box box-primary">
                                        <form method="POST" enctype="multipart/form-data" action="<?php echo base_url('admin/memberPost/admin');?>">
                                            <div class="box-body" >
                                                <div class="form-group">
                                                    <textarea name="desc" style="resize:none;" class="form-control" rows="2" placeholder="Write a post" required="required"></textarea>
                                                </div>
                                                <table style="width:100%;">
                                                    <tr>
                                                        <td align="left">
                                                            <input name="image" type="file">
                                                        </td>
                                                        <td align="right" width="70">
                                                            <button type="submit" class="btn btn-primary">Post</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                    <?php
                                    $rows = $this->clubsociety_model->getAllPost();

                                    foreach ($rows as $row) {
                                ?>
                                        <div style="width:500px;" class="box box-info">
                                            <div class="box-body" >
                                                <label>
                                                    <a href="<?php echo base_url('admin/profile/'.$row["posted_by"].'');?>" target="_SELF">
                                                        <?php
                                                            $mem = $this->clubsociety_model->getMember($row['posted_by']);
                                                            if(count($mem) > 0)
                                                            {
                                                                echo $mem[0]['firstname']." ".$mem[0]['lastname'];
                                                            }
                                                        ?>
                                                    </a> posted
                                                </label>
                                                <p>
                                                    <?php echo $row['description'];?>
                                                </p>
                                                <br>
                                                <?php
                                                    if($row['image'] != '')
                                                    {
                                                ?>
                                                <img src="<?php echo base_url('uploads/thumbnails/'.$row['image'].'')?>">
                                                <?php
                                                    }
                                                ?>
                                            <div align="right">
                                                <?php 
                                                    if($row['posted_by'] == $this->session->userdata('memberID'))
                                                    {
                                                ?>
                                                <a onclick="delete_post(<?php echo $row['id'];?>)" href="">Delete</a>
                                                <span style="margin-left:10px;"></span>
                                                <?php        
                                                    }
                                                ?>
                                                <a href="<?php echo base_url('admin/post/'.$row['id'].'');?>" target="_self">View post</a>
                                            </div>
                                            </div>
                                        </div>
                                <?php
                                    }
                                ?>
                                </div>
                            </section>
                        </td>
                        <td valign="top">
                            <div id="chatboxcon" style="padding:20px;width:400px;">
                                <div class="box box-success">
                                    <div class="box-header">
                                        <h3 class="box-title">Club Chat</h3>
                                        <input type="hidden" id="chat_count">
                                    </div>
                                    <div id="chatbox" class="box-body" style="height:350px;overflow:auto;">
                                        
                                    </div>
                                    <div class="box-footer">
                                        <div class="input-group">
                                            <input id="content" class="form-control" placeholder="Type message..."/>
                                            <div class="input-group-btn">
                                                <button id="btnChat" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                
            </aside>
        </div>

        <!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        <script>
            $(document).ready(function(){
                loadChats();
                countChat();
            });

            function loadChats(){
                $.post("<?php echo base_url('home/chat');?>",{

                },function(data,status){
                    document.getElementById('chatbox').innerHTML = data;
                    alwaysScrollDown();
                });
            }

            function alwaysScrollDown(){
                document.getElementById('chatbox').scrollTop = document.getElementById('chatbox').scrollHeight;
            }

            function countChat(){
                $.post("<?php echo base_url('home/countChats');?>",{

                },function(data,status){
                    document.getElementById('chat_count').value = data;
                });
            }

            function countChat2(){
                $.post("<?php echo base_url('home/countChats');?>",{

                },function(data,status){
                    if(parseInt(data) > document.getElementById('chat_count').value)
                    {
                        countChat();
                        loadChats();
                    }
                });
            }

            function ajax(){
                countChat2();
            }

            ajax();
            setInterval(ajax,3000);

            $(document).on('click','#btnChat',function(){
                insert_chat();
            });

            function insert_chat(){
                content = $('#content').val().trim();
                
                if(content != '')
                {
                    $.post("<?php echo base_url('home/insert_chat');?>",{
                        content: content
                    },function(data,status){
                        document.getElementById('content').value = '';
                        loadChats();
                    });    
                }
            }
        </script>        
        <?php
            include 'admin_scripts.php';
        ?>
    </body>
</html>