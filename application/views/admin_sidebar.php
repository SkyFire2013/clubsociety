<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
               <img src="<?php echo base_url('uploads/thumbnails/'.$image.'');?>" class="img-circle"/>
            </div>
            <div class="pull-left info">
                <p>(Admin) <?php echo $this->session->userdata('fname')." ".$this->session->userdata('lname');?></p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="javascript:void(0)">
                    <i class="fa fa-users"></i> <span>Members</span>
                    <i class="fa pull-right fa-angle-left"></i>
                </a>
                </a>
                <ul class="treeview-menu" style="display:none;">
                    <li><a id="admin_all_members" href="javascript:void(0)" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> All Members</a></li>
                    <li><a id="admin_wants_to_join" href="javascript:void(0)" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Wants to join</a></li>
                    <li><a id="admin_wants_to_deactivate" href="javascript:void(0)" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Wants to Deactivate</a></li>
                </ul>
            </li>
            <li>
                <a id="memberLogs" href="javascript:void(0)">
                    <i class="fa fa-rss"></i> <span>Member Logs</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li>
                <a href="<?php echo base_url('admin/mailbox');?>">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <small id="unreadMessages" class="badge pull-right bg-yellow"></small>
                </a>
            </li>
        </ul>
    </section>
</aside>