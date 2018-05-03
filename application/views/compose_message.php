<div style="width:300px;" class="box box-primary">
    <div class="box-body">
        <?php
            $rows = $this->clubsociety_model->getAllClubMembers();
        ?>
        <table width="100%">
            <tr>
                <td align="center">
                    <label>
                        To:
                    </label>
                </td>
                <td>
                    <div style="height:9px;"></div>
                    <div class="form-group">
                        <select id="to" class="form-control">
                            <option value="">Select Recepient</option>
                            <?php
                                if(count($rows) > 0)
                                {
                                    foreach($rows as $r) 
                                    {
                                        echo '<option value="'.$r['member_id'].'">'.$r['firstname']." ".$r['lastname'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="form-group">
                        <textarea id="content" style="resize:none;" class="form-control" rows="3" placeholder="Enter your message here..."></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button id="btnSend" class="btn btn-primary">Send</button>
                </td>
            </tr>
        </table>
    </div>
</div>