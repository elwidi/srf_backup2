<div class="contact-profile">
    <img src="<?php echo base_url().'assets/chat/pict.png'; ?>" alt=""/>
    <p><?php echo $name; ?></p>
    <div class="social-media small">
        <?php //echo ($rec!=null) ? $rec[0]->email : ''; ?>
    </div>
</div>
<div class="messages">
    <ul>
        <?php
        if($rec!=null)
        {
            $i = 0;
            foreach($rec as $r)
            {
                ?>
                <li class="<?php echo ($r->created_by==$this->session->userdata('id')) ? 'replies' : 'sent'; ?>">
                    <img src="<?php echo base_url().'assets/chat/pict.png'; ?>"" alt="<?php echo $r->name; ?>"/>
                    <p>
                        <?php echo $r->message; ?>

                        <?php if($r->created_by==$this->session->userdata('id')) { ?>
                            <span id="statusread" class="fa <?php echo ($r->read) ? 'fa-check-square-o' : 'fa-check'; ?>"></span>
                        <?php } ?>
                    </p>
                </li>
                <?php
            }
        }
        ?>

    </ul>
</div>
<div class="message-input">
    <div class="wrap">
        <input id="message_text" type="text" placeholder="Write your message..." onkeydown="javascript: if(event.keyCode == 13) sendchat();" />

        <!-- <i class="fa fa-paperclip attachment" aria-hidden="true"></i> -->
        <button id="btnchat" class="submit buttonchat" onclick="sendchat()"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
    </div>
</div>


<input type="hidden" id="user_sales" name="user_sales" value="<?php echo ($this->session->userdata('leveluser_id')==3) ? $this->session->userdata('id') : $user_chat; ?>" />
<input type="hidden" id="user_supervisor" name="supervisor_sales" value="<?php echo ($this->session->userdata('leveluser_id')==2) ? $this->session->userdata('id') : $user_chat; ?>" />

