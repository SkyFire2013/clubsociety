<table class="table table-mailbox">
<?php
    $rows = $this->clubsociety_model->getMessages();
    if(count($rows) > 0)
    {
        foreach($rows as $r) 
        {
            $m = $this->clubsociety_model->getMember($r['sender']);
           
            $id = 0;
            $from = '';
            $content = '';
            if(count($m) > 0)
            {
                $from = $m[0]['firstname']." ".$m[0]['lastname'];
                $content = $r['content'];
                if($r['date'] != '0000-00-00 00:00:00')
                {
                    $timestamp = strtotime($r['date']);
                    $_date=date_create($r['date']);
                    $date = date("h:i", $timestamp)." ".date_format($_date,"m-d-Y");
                }
            }

            if($r['status'] == 'V')
            {
?>
            <tr>
                <td>
                    <span class="fa fa-envelope-o"></span>
                </td>
                <td class="name">
                    <?php
                        echo $from;
                    ?>
                </td>
                <td class="subject">
                    <a href="javascript:viewMessage(<?php echo $r['id'];?>)">
                        <div style="width:300px;overflow:hidden;text-overflow: ellipsis;">
                        <?php
                            echo $content;
                        ?>
                        </div>
                    </a>
                </td>
                <td class="time">
                    <?php
                        echo $date;
                    ?>
                </td>
            </tr>
<?php
            }
            else
            {
?>
            <tr class="unread">
                <td width="20">
                    <span class="fa fa-envelope"></span>
                </td>
                <td class="name">
                    <b>
                    <?php
                        echo $from;
                    ?>
                    </b>
                </td>
                <td class="subject">

                    <a href="javascript:viewMessage(<?php echo $r['id'];?>)">
                        <div style="width:300px;overflow:hidden;text-overflow: ellipsis;">
                        <b>
                        <?php
                            echo $content;
                        ?>
                        </div>
                        </b>
                    </a>
                </td>
                <td class="time">
                    <b>
                    <?php
                        echo $date;
                    ?>
                    </b>
                </td>
            </tr>
<?php                
            }
        }
    }
?>
</table>