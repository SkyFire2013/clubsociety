<?php
    $rows = $this->clubsociety_model->chats();

    if(count($rows) > 0)
    {
        foreach($rows as $r)
        {
            $m = $this->clubsociety_model->getMember($r['sender']);

            $name = '';
            $image = 'no_profile_pic.jpg';
            $content = '';
            $chat_date = '';

            if(count($m))
            {
                $name = $m[0]['firstname']." ".$m[0]['lastname'];
                $image = $m[0]['image'];
                $content = $r['content'];

                if($r['date'] != '0000-00-00 00:00:00')
                {
                    //$timestamp = strtotime($r['date']);
                    //$date=date_create($r['date']);
                    //$chat_date = date("h:i", $timestamp)."    ".date_format($date,"m-d-Y");
                    $date = date_create($r['date']);
                    $chat_date = date_format($date, 'l , F j , Y g:i A');
                }
            }

            if($r['sender'] == $this->session->userdata('memberID'))
            {
?>
            <div style="height:10px;"></div>
            <div align="right">
                <table>
                    <tr>
                        <td align="right" colspan="2">
                            <label style="margin-right:5px;">
                            <?php echo $name;?>
                            </label>
                            <div style="margin-right:5px;border-radius:3px;padding:5px;" class="alert-success">
                            <?php echo $content;?>
                            </div>
                            <span style="margin-right:5px">
                            <?php echo $chat_date;?>
                            </span>
                        </td>
                        <td width="52" headers="52" valign="top">
                            <div style="height:5px;"></div>
                            <img class="img-circle" style="width:50px;height:50px;" src="<?php echo base_url('uploads/'.$image.'');?>">
                        </td>
                    </tr>
                </table> 
            </div> 
<?php  
            }
            else
            {
?>
            <div style="height:10px;"></div>
            <div align="left">
                <table>
                    <tr>
                        <td width="52" headers="52" valign="top">
                            <div style="height:5px;"></div>
                            <img class="img-circle" style="width:50px;height:50px;" src="<?php echo base_url('uploads/'.$image.'');?>">
                        </td>
                        <td align="left" colspan="2">
                            <label style="margin-left:5px;">
                            <?php echo $name;?>
                            </label>
                            <div style="margin-left:5px;border-radius:3px;padding:5px;" class="alert-info">
                            <?php echo $content;?>
                            </div>
                            <span style="margin-left:5px">
                            <?php echo $chat_date;?>
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
<?php                
            } 
        }
    }
?>
