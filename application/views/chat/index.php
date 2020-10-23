<div class="page-title">
    <div class="title_left">
        <h3><?php echo $title; ?></h3>
    </div>
    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      
        <div class="x_panel">
            <div class="x_title">
                <h2></h2>
                <div class="pull-right">

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" id="x_content">

                <div id="frame">
                    <div id="sidepanel">
                        <div id="profile">
                            <div class="wrap">
                                <img id="profile-img" src="<?php echo base_url().'assets/chat/pict.png'; ?>" class="online" alt="" />
                                <p><?php echo $this->session->userdata('user_name'); ?></p>
                                <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
                                <div id="status-options">
<!--                                    <ul>-->
<!--                                        <li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>-->
<!--                                        <li id="status-away"><span class="status-circle"></span> <p>Away</p></li>-->
<!--                                        <li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>-->
<!--                                        <li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>-->
<!--                                    </ul>-->
                                </div>
                                <div id="expanded">
<!--                                    <label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>-->
<!--                                    <input name="twitter" type="text" value="mikeross" />-->
<!--                                    <label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>-->
<!--                                    <input name="twitter" type="text" value="ross81" />-->
<!--                                    <label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>-->
<!--                                    <input name="twitter" type="text" value="mike.ross" />-->
                                </div>
                            </div>
                        </div>
                        <div id="search">
<!--                            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>-->
<!--                            <input type="text" placeholder="Search contacts..." />-->
                        </div>
                        <div id="contacts">
                            <ul>
                                <?php
                                if($rec!=null)
                                {
                                    $i = 0;
                                    foreach($rec as $r)
                                    {
                                ?>
                                        <li id="<?php echo 'list'.$r->id; ?>" class="contact <?php echo ($i==0) ? 'active' : ''; $i=1; ?>">
                                            <a id="onchat" onclick="view(<?php echo $r->id; ?>,'<?php echo $r->name; ?>')">

                                            <div class="wrap">
                                                <span id="<?php echo 'online'.$r->id; ?>" class="contact-status <?php echo ($r->online) ? 'online' : 'busy'; ?>"></span>
                                                <img src="<?php echo base_url().'assets/chat/pict.png'; ?>" alt="<?php echo $r->name; ?>"/>
                                                <div class="meta">
                                                    <p class="name"><?php echo $r->name; ?></p>
                                                    <p class="preview"><?php echo $r->email; ?></p>
                                                </div>
                                            </div>
                                            </a>
                                        </li>
                                <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div id="bottom-bar">
<!--                            <button id="addcontact" class="buttonchat"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Add contact</span></button>-->
<!--                            <button id="settings" class="buttonchat"><i class="fa fa-cog fa-fw" aria-hidden="true"></i> <span>Settings</span></button>-->
                        </div>
                    </div>
                    <div class="content" id="content-chat">


                    </div>

                </div>

            </div>
        </div>
            
    </div>
</div>

<input type="hidden" id="active_user" />
<input type="hidden" id="active_name" />
<input type="hidden" id="new_chat" value="" />

<script>

    function view(id, name)
    {
        $.ajax({
            type:"POST",
            url:"<?php echo base_url().'chat/view'; ?>",
            data: { user_chat : id, name : name  } ,
            success: function (data) {

                $('#content-chat').html(data);
                scrollDown();

                // choose active chat
                $('#contacts ul li').removeClass('active');
                $('#list' + id).addClass('active');

                document.getElementById('active_user').value = id;
                document.getElementById('active_name').value = name;
            }
        });
    }

    function sendchat()
    {
        message = $(".message-input input").val();
        if($.trim(message) == '') {
            return false;
        }

        $.ajax({
            type:"POST",
            url:"<?php echo base_url().'chat/insert'; ?>",
            data: { msg : message, 'user_sales' : document.getElementById('user_sales').value, 'user_supervisor' : document.getElementById('user_supervisor').value} ,
            dataType: 'json',
            beforeSend: function() {

                document.getElementById('btnchat').disabled = true;

            },
            success: function (data) {

                if(data.success)
                {
                    newMessage();
                }

                document.getElementById('btnchat').disabled = false;
            }
        });
    }

    var autoLoad = setInterval(
        function ()
        {
            loadchat();

            // harus ada kondisi apakah user lawan chat sedang aktif lihat juga
            // PENDING PROCESS
            //readchat();

        }, 1000);

    function loadchat()
    {
        active_user = document.getElementById('active_user').value;
        active_name = document.getElementById('active_name').value;

        if(active_user!='')
        {
            $.ajax({
                type:"POST",
                url:"<?php echo base_url().'chat/view_reload'; ?>",
                data: { user_chat : active_user, name : active_name } ,
                dataType: 'json',
                success: function (data) {

                    if(data.success && data.new_chat!=$('#new_chat').val())
                    {
                        $('#content-chat .messages ul').append(data.message);
                        scrollDown();

                        // choose active chat
                        $('#contacts ul li').removeClass('active');
                        $('#list' + active_user).addClass('active');

                        // set count of chat notification
                        document.getElementById('new_chat').value = data.new_chat;
                    }
                }
            });
        }
    }

    //function readchat()
    //{
    //    active_user = document.getElementById('active_user').value;
    //
    //    if(active_user!='')
    //    {
    //        $.ajax({
    //            type:"POST",
    //            url:"<?php //echo base_url().'chat/read_chat'; ?>//",
    //            data: { user_chat : active_user } ,
    //            dataType: 'json',
    //            success: function (data) {
    //
    //                if(data.success)
    //                {
    //                    $('#content-chat .messages ul li p span').removeClass('fa-check');
    //                    $('#content-chat .messages ul li p span').addClass('fa-check-square-o');
    //                }
    //            }
    //        });
    //    }
    //}

</script>
