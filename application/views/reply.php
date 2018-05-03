<div style="width:300px;" class="box box-primary">
    <div class="box-body">
        <table width="100%">
            <tr>
                <td colspan="2">
                    <?php
                        $row = $this->clubsociety_model->getMessage($id);
                        
                        $to = '';
                        $content = '';

                        if(count($row) > 0)
                        {
                            $this->clubsociety_model->markMessageAsViewed($id);

                            $m = $this->clubsociety_model->getMember($row[0]['sender']);
                            $to = $m[0]['firstname']." ".$m[0]['lastname'];
                            $toID = $m[0]['member_id'];
                            $content = $row[0]['content'];
                        }
                    ?>
                    <input type="hidden" id="to" value="<?php echo $toID;?>">
                    <label>
                    <?php
                        echo $to;
                    ?>
                    </label>
                    <div style="border-radius:3px;padding:5px;" class="alert-info">
                    <?php
                        echo $content;
                    ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <div class="form-group">
                        <textarea id="content" style="resize:none;" class="form-control" rows="3" placeholder="Enter your reply here..."></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button id="btnReply" class="btn btn-primary">Send</button>
                </td>
            </tr>
        </table>
    </div>
</div>