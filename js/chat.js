$( document ).ready(function() {
    notifchat();
});

function notifchat()
{
    $.ajax({
        type:"POST",
        url:"<?php echo base_url().'home/notif'; ?>",
        dataType: 'json',
        success: function (data) {

            document.getElementById('jml_notif').innerHTML = data.jml_notif;

            $("#exist").html(data.exist);

            $("#menu_notif").append(data.notif_pesan);

        }
    });
}

var autoLoad = setInterval(
        function ()
        {
            $.ajax({
                type:"POST",
                url:"<?php echo base_url().'home/notif'; ?>",
                dataType: 'json',
                success: function (data) {


                }
            });
        }, 5000); // refresh page every 5 seconds

