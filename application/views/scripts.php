<!-- DATA TABES SCRIPT -->
<script src="<?php echo base_url('js/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/plugins/datatables/dataTables.bootstrap.js');?>" type="text/javascript"></script>
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
    
    $(document).on('click','#memberProfileAccount',function(){
        document.getElementById('memberMainContent').innerHTML = '<br><br><center><img src="img/ajax-loader1.gif"></center>';
        $.post("<?php echo base_url('member/loadMemberAccountProfile');?>",{

        },function(data,status){
            document.getElementById('memberMainContent').innerHTML = data;
            document.getElementById('posts').innerHTML = '';
        });
    });

    function loadMemberNotificationCount(){
        $.post("<?php echo base_url('notification/memberNotificationCount');?>",{

        },function(data,status){
            document.getElementById('memberNotificationCount').innerHTML = data;
        });
    }

    function realTimeNotification(){
        loadMemberNotificationCount();
    }

    $(document).on('click','#memberNotificationsIcon',function(){
        loadMemberNotifications();
    });

    function loadMemberNotifications(){
        document.getElementById('memberNotifications').innerHTML = '<br><br><center><img src="img/ajax-loader1.gif"></center>';
        $.post("<?php echo base_url('notification/getMemberNotifications');?>",{

        },function(data,status){
            document.getElementById('memberNotifications').innerHTML = data;
        });
    }

    realTimeNotification();
    setInterval(realTimeNotification,3000);

    $(document).on('click','.notification',function(){
        markAsViewedNotification(this.id);
    });

    function markAsViewedNotification(id){
        $.post("<?php echo base_url('notification/markAsViewedNotification/"+id+"')?>",{

        },function(data,status){

        });
    }

    $(document).on('keyup','#searchBox',function(){
        loadSearchResults();
    });

    $(document).on('click','#btnSearch',function(){
        loadSearchResults();
    });
    
    function loadSearchResults(){
        string = $('#searchBox').val().trim();
        
        if(string != '')
        {
            $.post("<?php echo base_url('member/loadSearchResults/"+string+"')?>",{

            },function(data,status){
                document.getElementById('memberMainContent').innerHTML = data;
                document.getElementById('posts').innerHTML = '';
            });
        }
        else
        {
            document.getElementById('memberMainContent').innerHTML = '<h1>No results found!</h1>';
            document.getElementById('posts').innerHTML = '';
        }
    }

    function loadInbox(){
                document.getElementById("inbox").className = "active";
                document.getElementById("sent").className = "";
                document.getElementById('mailbox').innerHTML = '<center><br><br><img src="../img/ajax-loader1.gif"/></center>'; 

                $.post("<?php echo base_url('member/inbox');?>",{

                },function(data,status){
                    document.getElementById('mailbox').innerHTML = data;                    
                });     
            }

            function loadSent(){
                document.getElementById("sent").className = "active";
                document.getElementById("inbox").className = "";
                document.getElementById('mailbox').innerHTML = '<center><br><br><img src="../img/ajax-loader1.gif"/></center>';

                $.post("<?php echo base_url('member/sent');?>",{

                },function(data,status){
                    document.getElementById('mailbox').innerHTML = data;                    
                });      
            }

            $(document).on('click','#compose_message',function(){
                compose_message();
            });

            function compose_message(){
                document.getElementById('mailbox').innerHTML = '<center><br><br><img src="img/ajax-loader1.gif"/></center>';

                $.post("<?php echo base_url('member/compose_message');?>",{

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

                $.post("<?php echo base_url('member/send_message');?>",{
                    to: to,
                    content: content
                },function(data,status){
                    compose_message();              
                }); 
            }

            function viewMessage(id){
                document.getElementById('mailbox').innerHTML = '<center><br><br><img src="../img/ajax-loader1.gif"/></center>';

                $.post("<?php echo base_url('member/reply');?>",{
                    id: id
                },function(data,status){
                    document.getElementById('mailbox').innerHTML = data;                    
                }); 
            }

            $(document).on('click','#btnReply',function(){
                to = $('#to').val().trim();
                content = $('#content').val().trim();

                $.post("<?php echo base_url('member/send_message');?>",{
                    to: to,
                    content: content
                },function(data,status){
                     loadInbox();            
                });               
            });

            function countUnreadMessages(){
                $.post("<?php echo base_url('member/count_unread_messages');?>",{
                },function(data,status){
                    document.getElementById('unreadMessages').innerHTML = data;

                    if(data != '')
                    {
                        document.getElementById('countUnread').innerHTML = ' ('+data+')';
                    }
                    else
                    {
                        document.getElementById('countUnread').innerHTML = '';
                    }          
                }); 
            }

            countUnreadMessages();
            setInterval(countUnreadMessages,3000);
            
            function allMembers(){
            	document.getElementById('memberMainContent').innerHTML = '<center><br><br><img src="../img/ajax-loader1.gif"/></center>';
            	$.post("<?php echo base_url('member/allmembers');?>",{
                },function(data,status){
                    document.getElementById('memberMainContent').innerHTML = data; 
                    document.getElementById('chatboxcon').style.display = 'none'; 
                    document.getElementById('posts').innerHTML = '';      
                }); 
            }

            function delete_post(id){
                if(id != "")
                {
                    $.post("<?php echo base_url('post/delete_post');?>",{
                        id: id
                    },function(data,status){          
                    }); 
                }
            }
</script>