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
                <p>Hello! <?php echo $this->session->userdata('fname')." ".$this->session->userdata('lname');?></p>
            </div>
        </div>
       <ul class="sidebar-menu">
            <li>
                <a href="<?php echo base_url('member/mailbox');?>">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <small id="unreadMessages" class="badge pull-right bg-yellow"></small>
                </a>
            </li>
            <li>
                <a href="javascript:allMembers()">
                    <i class="fa fa-users"></i> <span>All Members</span>
                </a>
            </li>
        </ul>
    </section>
</aside>