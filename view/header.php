<html>
    <head>
        <title></title>
        <link href="<?php echo BASE_HTTP; ?>/files/styles.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="<?php echo BASE_HTTP; ?>/files/jquery.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                //jQuery('.loader').html("loading");
                
                //jQuery('#loginForm').submit(function(){
                    // catch the submit
                  //  jQuery('.loader').html("loading the request");
                  //  var datas = $("#loginForm").serialize();
                  //  $.post('<?php echo BASE_HTTP; ?>/login/submitJson', datas, function(data) {
                  //      jQuery('.loader').html(".." + data.hello);
                  //  }, 'json');
                  //  return false;
                //});

                jQuery('#mainForm').submit(function(){
                    // catch the submit
                    items = [];
                   
                    var datas = {'status' : $('#update').val()};
                    if($('#update').val() != "") {
                        jQuery('#statusUpdate').html("loading the request");
                        $.post('<?php echo BASE_HTTP; ?>/main/updateJson', datas, function(data) {
                            $.each(data.status, function(key, vals) {
                                items.push("<p>" + vals + "</p>");
                            });
                            var stats = items.join(" ");
                            jQuery('#statusUpdate').html(stats);
                            jQuery('#update').val("");
                        }, 'json');
                    } else {
                        jQuery('.loader').html("please write a status message");
                    }
                    return false;

                });
                
            });
        </script>
    </head>
    <body>
        <div class="loader"></div>