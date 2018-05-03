<script>
    $(function() {
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });

    $(document).on('click','#admin_all_members',function(){
        loadAllMembers();
    });

    function loadAllMembers(){
        loadClubMembers(1);
        try
        {
        document.getElementById('chatboxcon').style.display = 'none';
        }
        catch(err)
        {
        }
    }

    $(document).on('click','#admin_wants_to_join',function(){
        loadClubMembers(2);
        try
    	{
    	document.getElementById('chatboxcon').style.display = 'none';
    	}
    	catch(err)
    	{
    	}
    });

    $(document).on('click','#notification',function(){
        loadNotification();
    });

    function loadClubMembers(confirmation){
        document.getElementById('main_content').innerHTML = '<br><br><br><center><img src="img/ajax-loader1.gif"></center>';

        $.post('<?php echo base_url("ajaxload/loadClubMembers/'+confirmation+'");?>',{

        },function(data,status){
            document.getElementById('main_content').innerHTML = data;
        });
    }

    function loadNotification(){  
        document.getElementById('notification_container').innerHTML = '<br><center><img src="img/ajax-loader1.gif"></center>';

        $.post('<?php echo base_url("ajaxload/loadNotifications");?>',{

        },function(data,status){
            document.getElementById('notification_container').innerHTML = data;
        });
    }

    function loadNotificationCount(){
        $.post('<?php echo base_url("admin/adminNotificationCount");?>',{

        },function(data,status){
            document.getElementById('notification_number').innerHTML = data;
        });
    }

    loadNotificationCount();
    setInterval(loadNotificationCount,3000); 

    $(document).on('click','.notification',function(){
        markAsViewedNotification(this.id);
    });

    function markAsViewedNotification(id){
        $.post("<?php echo base_url('notification/markAsViewedNotification/"+id+"')?>",{

        },function(data,status){

        });
    } 

    $(document).on('click','.new_member',function(){
        loadClubMembers(2);  
    });
   	
    $(document).on('click','#memberLogs',function(){
        try
    	{
    	document.getElementById('chatboxcon').style.display = 'none';
    	}
    	catch(err)
    	{
    	}
    	
        $.post('<?php echo base_url("admin/getAllPost");?>',{
        },function(data,status){
            document.getElementById('main_content').innerHTML = data;
        });
    }); 

    $(document).on('click','#admin_wants_to_deactivate',function(){
        getMembersByStatus('P');
        
        try
    	{
    	document.getElementById('chatboxcon').style.display = 'none';
    	}
    	catch(err)
    	{
    	}
    }); 

    function getMembersByStatus(status){
        document.getElementById('main_content').innerHTML = '<br><br><br><center><img src="http://britechcs.com/img/ajax-loader1.gif"></center>';

        $.post('<?php echo base_url("admin/getAllMembersByStatus/'+status+'");?>',{

        },function(data,status){
            document.getElementById('main_content').innerHTML = data;
            try
    		{
    		document.getElementById('chatboxcon').style.display = 'none';
    		}
    		catch(err)
    		{
    		}
        });
    }

    $(document).on('click','.btnDeactivate',function(){
        deactivateMember(this.id);
    });

    function deactivateMember(id){

        $.post('<?php echo base_url("admin/deactivateMember/'+id+'");?>',{

        },function(data,status){
            getMembersByStatus('P');
        });
    }

    $(document).on('click','.btnActivate',function(){
        $.post('<?php echo base_url("admin/activateMember/'+this.id+'");?>',{

        },function(data,status){
            loadClubMembers(1);
        });
    }); 

    $(document).on('click','#loadAdminAccount',function(){
        loadAdminProfile();
    }); 

    function loadAdminProfile(){
        $.post('<?php echo base_url("admin/loadAdminProfile");?>',{

        },function(data,status){
            document.getElementById('main_content').innerHTML = data;
        });
    }

    $(document).on('click','#btnUpdateAdmin',function(){
        updateAdminProfile();
    }); 
        
    function updateAdminProfile(){
        fname = $('#firstname').val().trim();
        lname = $('#lastname').val().trim();
        uname = $('#username').val().trim();
        pword = $('#password').val().trim();
        
        $.post('<?php echo base_url("admin/updateAdminProfile");?>',{
            lastname: lname,
            firstname: fname,
            uname: uname,
            pword: pword
        },function(data,status){
            loadAdminProfile();
        });
    } 

    function sendConfirmationCode(memberID,code){
        document.getElementById('main_content').innerHTML = '<br><br><br><center><img src="img/ajax-loader1.gif"></center>';
        
        $.post('<?php echo base_url("admin/sendConfirmation");?>',{
            memberID: memberID,
            code: code
        },function(data,status){
            loadClubMembers(2);
        });
    }




    function loadInbox(){
                document.getElementById("inbox").className = "active";
                document.getElementById("sent").className = "";
                document.getElementById('mailbox').innerHTML = '<center><br><br><img src="../img/ajax-loader1.gif"/></center>'; 

                $.post("<?php echo base_url('admin/inbox');?>",{

                },function(data,status){
                    document.getElementById('mailbox').innerHTML = data;                    
                });     
            }

            function loadSent(){
                document.getElementById("sent").className = "active";
                document.getElementById("inbox").className = "";
                document.getElementById('mailbox').innerHTML = '<center><br><br><img src="../img/ajax-loader1.gif"/></center>';

                $.post("<?php echo base_url('admin/sent');?>",{

                },function(data,status){
                    document.getElementById('mailbox').innerHTML = data;                    
                });      
            }

            $(document).on('click','#compose_message',function(){
                compose_message();
            });

            function compose_message(){
                document.getElementById('mailbox').innerHTML = '<center><br><br><img src="img/ajax-loader1.gif"/></center>';

                $.post("<?php echo base_url('admin/compose_message');?>",{

                },function(data,status){
                    document.getElementById('mailbox').innerHTML = data;                    
                }); 
            }

            $(document).on('click','#btnSend',function(){
                 sendMessage();                
            });

            function sendMessage(){
                to = $('#to').val().trim();
                content = $('#content').val().trim();

                $.post("<?php echo base_url('admin/send_message');?>",{
                    to: to,
                    content: content
                },function(data,status){
                    compose_message();              
                }); 
            }

            function viewMessage(id){
                document.getElementById('mailbox').innerHTML = '<center><br><br><img src="../img/ajax-loader1.gif"/></center>';

                $.post("<?php echo base_url('admin/reply');?>",{
                    id: id
                },function(data,status){
                    document.getElementById('mailbox').innerHTML = data;                    
                }); 
            }

            $(document).on('click','#btnReply',function(){
                to = $('#to').val().trim();
                content = $('#content').val().trim();

                $.post("<?php echo base_url('admin/send_message');?>",{
                    to: to,
                    content: content
                },function(data,status){
                     loadInbox();            
                });               
            });

            function countUnreadMessages(){

                $.post("<?php echo base_url('admin/count_unread_messages');?>",{
                },function(data,status){
                    document.getElementById('unreadMessages').innerHTML = data;

                    if(data != '')
                    {
                    	try
		    	{
		    		document.getElementById('countUnread').innerHTML = ' ('+data+')';
		    	}
		    	catch(err)
		    	{
		    	}
                        
                    }
                    else
                    {
                        try
		    	{
		    		document.getElementById('countUnread').innerHTML = '';
		    	}
		    	catch(err)
		    	{
		    	}
                    }          
                }); 
            }
            
            
            countUnreadMessages();
            setInterval(countUnreadMessages,3000);

            function delete_post(id){
                if(id != "")
                {
                    $.post("<?php echo base_url('post/delete_post');?>",{
                        id: id
                    },function(data,status){          
                    }); 
                }
            }
</script>>