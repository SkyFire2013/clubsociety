<div id="postContent">
    <?php
        $row  = $this->clubsociety_model->getPost($post_id);
        if(count($row) >= 1)
        {
    ?>
    <div class="row">                        
    <div class="col-md-12">
        <ul class="timeline">
            <li>
                <i class="fa fa-users bg-red"></i>
                <div style="width:600px;" class="timeline-item">
                    <h3 class="timeline-header">
                        <a href="#">
                            <?php
                                $mem = $this->clubsociety_model->getMember($row[0]['posted_by']);
                                if(count($mem) > 0)
                                {
                                    echo $mem[0]['firstname']." ".$mem[0]['lastname'];
                                }
                            ?>
                        </a> 
                    posted</h3>

                    <?php
                    //$date = date_create($row[0]['date']);
                    //echo date_format($date, '\o\n l , F j , Y g:i A');
                    ?>
                    <div class="timeline-body">
                    <?php
                        echo nl2br($row[0]['description']).'<br><br>';

                        if($row[0]['image'] != ''){
                            echo '<a href="'.base_url('uploads/'.$row[0]['image'].'').'" target="_self">';
                            echo '<image src="'.base_url('uploads/thumbnails/'.$row[0]['image']).'"/>';
                            echo '</a>';
                        }
                    ?>
                    </div>
                    <div class='timeline-footer'>
                        <?php
                            $like = $this->clubsociety_model->checkIfYouLiked2($post_id);

                            if($like == 0)
                            {
                        ?>
                        <a id="like" href="javascript:void(0)"><font color="green">Like✔</a></font>
                        <?php                
                            }
                            else
                            {
                        ?>
                        <a id="like" href="javascript:void(0)"><font color="red">Unlike✘</a></font>
                        <?php        
                            }

                            echo $this->clubsociety_model->countLike($post_id);
                        ?>
                    </div>
                    <?php
                        $rows = $this->clubsociety_model->getPostComments($post_id);

                        foreach($rows as $r) {
                    ?>
                    <table style="position:relative;left:5px;" cellpadding="5">
                        <tr>
                            <td valign="top">
                                <div style="height:6px;"></div>
                                <?php
                                    $name = $this->clubsociety_model->getMember($r['comment_by_id']);
                                    $image = 'no_profile_pic.jpg';
                                    $id = 0;
                                    $full_name = '';

                                    if(count($name) > 0)
                                    {
                                        $id = $name[0]['member_id'];
                                        $image = $name[0]['image'];
                                        $full_name = $name[0]['firstname']." ".$name[0]['lastname'];
                                    }
                                ?>
                                <img style="width:50;height:50px;" src="<?php echo base_url('uploads/thumbnails/'.$image.'');?>" class="img-circle"/>
                            </td>
                            <td>
                                <p style="text-align:justify;" class="message">
                                    <?php
                                        if($this->session->userdata('type') == '')
                                        {
                                            $page = 'member';
                                        }
                                        else
                                        {
                                            $page = 'admin';
                                        }
                                    ?>
                                    <a href="<?php echo base_url(''.$page.'/profile/'.$id.'')?>"  target="_self" class="name">
                                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 
                                        <?php
                                        if($row[0]['date'] != "")
                                        {
                                            $date = date_create($row[0]['date']);
                                            echo date_format($date, 'g:i A');
                                        }
                                        ?>
                                        </small>
                                        <?php
                                            echo $full_name;
                                        ?>
                                        <br>
                                    </a>
                                    <?php echo $r['text'];?>
                                </p>
                            </td>
                        </tr>
                    </table>
                    <?php
                        }
                    ?>
                    <div style="padding:10px;" class="input-group">
                        <input id="comment" class="form-control" placeholder="Add comment">
                        <div class="input-group-btn">
                            <button id="btnAddComment"class="btn btn-primary"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <?php
        }
        else
        {
            echo "<h1>No Results found!</h1>";
        }
    ?>
</div>
</div>