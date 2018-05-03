<table class="table table-mailbox">
<?php
    $rows = $this->clubsociety_model->getSentMessages();
    if(count($rows) > 0)
    {
        foreach($rows as $r) 
        {
            $m = $this->clubsociety_model->getMember($r['recipient']);
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
?>
    <tr>
        <td class="name">
            <?php
                echo $from;
            ?>
        </td>
        <td class="subject">

            <a href="#">
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
    }    
?>
</table>