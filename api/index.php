<?php
session_start();
include '../system/config.php';
include '../system/head.php';
mysql_query("CREATE TABLE IF NOT EXISTS `chat` (
`id` int(10) NOT NULL AUTO_INCREMENT,
`idfb` varchar(32) NOT NULL,
`name` varchar(32) NOT NULL,
`text` varchar(255) NOT NULL,
`time` int(10) NOT NULL
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
");
?>
<script src='//ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js'>
</script>
<script>
$(document).ready(function(){
$("#data").load("chat.php");
var refreshId = setInterval(function(){
$("#data").load('chat.php');
$("#data").slideDown("slow");
}, 1000);
$("#chatbox").validate({
debug: false,
submitHandler: function(form){
$.post('chat.php',
$("#chatbox").serialize(),function(chatoutput){
$("#data").html(chatoutput);
});
$("#msg").val("");
}
});
});
</script>
<div class='col-lg-8 col-lg-offset-2'>
  <div class='panel-group'>
    <div class='panel panel-primary'>
      <div class='panel-heading'>
        <center>Chém gió
        </center>
      </div>
      <div class="panel-body">
        <div class='form-group'>
          <form name='chatbox' id='chatbox' method='post'>
            <input id='name' type='text' name='name' placeholder='Nhập tên của bạn...' value='<?= $_SESSION['name'] ?>' class='form-control' required>
            <div class='input-group' style='margin-top:20px'>
              <div class='input-icon'>
                <input id='msg' type='text' name='msg' placeholder='Nhập nội dung...' class='form-control' required>
              </div>
              <span class='input-group-btn'>
                <button class='btn btn-danger' type='submit'> Gửi 
                  <i class='fa fa-arrow-right'>
                  </i>
                </button>
              </span>
            </div>
          </form>
        </div>
        <div id='data'>
        </div>
      </div>
    </div>
  </div>
<div class='panel-group'>
  <div class='panel panel-primary'>
    <div class='panel-heading'>
      <h3 class='panel-title' style='text-align:center'>Chat Với Bé Sim
      </h3>
    </div>
    <div class='panel-body' id='chat'>
      <form id='fchat' name='fchat' class='form-horizontal' action='http://api.vina4u.pro/api_se.php?type=ajax' method='POST'>
        <div class='form-group'>
          <input type='text' name='msg' id='msg' class='form-control' placeholder='Chat với bé SimSimi'>
        </div>
        <div style='text-align:center'>
          <input type='submit' name='btn-day' id='btn-day' class='btn btn-danger' value='Chat'>
          <div id='loadchat'>
          </div>
        </div>
      </form>
      <ul class='list-group' id='listchat' style='padding-top:15px'>
      </ul>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function () {
    	$('form#fchat').submit(function (event) {
    		var formData = {
    			'msg': $('#fchat input[name=msg]').val()
    		};
    		$('ul#listchat').prepend('<li class="list-group-item"><b>Bạn</b>: ' + $('#fchat input[name=msg]').val() + '</li>');
    		$.ajax({
    			type: 'POST',
    			url: 'http://api.vina4u.pro/api.php?type=ajax',
    			data: formData,
    			dataType: "jsonp",
    			crossDomain: true,
    			encode: true
    		}).done(function (data) {
    			if (data == "error") {
    				$('ul#listchat').prepend('<li class="list-group-item"><font color="red"><b>Bé Sim</b></font>: Câu này mình không biết trả lời, hãy dạy cho mình cách trả lời nhé. <a href="#day">Click here</a></li>');
    				$('#fday input[name=msg]').val($('#fchat input[name=msg]').val());
    				$('#loadchat').html('');
    			} else {
    				$('ul#listchat').prepend('<li class="list-group-item"><font color="red"><b>Bé Sim</b></font>: ' + data + '</li>');
    				$('#fchat input[name=msg]').val('');
    				$('#loadchat').html('');
    			}
    		});
    		event.preventDefault();
    	});
    });
  </script>
</div>
</div>
<?php
include '../system/foot.php';