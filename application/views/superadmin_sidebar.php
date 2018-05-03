<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="img/avatar3.png" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>(Admin) <?php echo $this->session->userdata('fname')." ".$this->session->userdata('lname');?></p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="active">
                <a href="javascript:clubs()">
                    <i class="fa fa-users"></i> <span>Clubs</span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="active">
                <a href="javascript:loadCreateAdminForm()">
                    <i class="fa fa-plus"></i> <span>Create Admin Account</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>