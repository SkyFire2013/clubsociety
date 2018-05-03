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
                    <input id="post_id" type="hidden" value="<?php echo $post_id;?>">
                    <div id="main_content">
                        
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

        <script type="text/javascript">
            $(document).on('click','#btnAddComment',function(){
                post_id = $('#post_id').val().trim();
                comment = $('#comment').val().trim();

                $.post("<?php echo base_url('comment/addComment')?>",{
                    post_id: post_id,
                    comment: comment
                },function(data,status){
                    loadPost(<?php echo $post_id;?>);
                });
            });

           $(document).ready(function(){
                loadPost(<?php echo $post_id;?>);
           })

           function loadPost(post_id){ 
                $.post("<?php echo base_url('post/loadPost/"+post_id+"')?>",{

                },function(data,status){
                    document.getElementById('main_content').innerHTML = data;
                });
           }

           $(document).on('click','#like',function(){
                post_id = $('#post_id').val().trim();
                $.post("<?php echo base_url('post/likePost');?>",{
                    post_id: post_id
                },function(data,status){
                    loadPost(<?php echo $post_id;?>);
                });    
           });          
        </script>  

        <?php
            include 'admin_scripts.php';
        ?>      
    </body>
</html>