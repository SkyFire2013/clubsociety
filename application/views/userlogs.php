<div style="width:700px;" class="box box-primary">
    <div class="box-body">
        <table width="100%;">
            <?php
                $row = $this->clubsociety_model->getAllLogs();

                foreach($row as $r)
                {
            ?>
            <tr>
                <td width="550">
                    <div style="height:5px;"></div>
                    <label>
                        <?php
                            $mem = $this->clubsociety_model->getMember($r['memberID']);
                            $name = '';
                            
                            if(count($mem)>0)
                            {
                            $name =  $mem[0]['firstname']." ".$mem[0]['lastname'];
                            }
                            echo $name;
                        ?>
                    </label> 
                    <?php
                        echo $r['activity'];
                    ?>
                </td>
                <td>
                    <?php

                        $date = date_create($r['date']);
                            echo date_format($date,"F j, Y, g:i a");
                    ?>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
    </div>
</div>