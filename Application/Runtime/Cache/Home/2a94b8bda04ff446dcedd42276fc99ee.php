<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no,email=no,date=no,address=no">
    <title></title>
  	<link rel="stylesheet" type="text/css" href="/Public/chat/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="/Public/chat/css/default.css">
	<link rel="stylesheet" type="text/css" href="/Public/chat/css/styles.css">
</head>
<body>
     <script type="text/javascript" src="/Public/jquery-3.2.1.js"></script>

     <!doctype html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>chat</title>
</head>
<body>
	<div class="jq22-container">
		<div class="jq22-content bgcolor-3">
			<div id="chatbox" style="top:10px !important">
				<div id="friendslist">
			    	<div id="topmenu">
			        	<span class="friends"></span>
			            <span class="chats"></span>
			            <span class="history"></span>
			        </div>
			       
			        <div id="friends" >

				        <?php if(is_array($user)): foreach($user as $key=>$user): if($_SESSION['user']['user']!= $user["user"] ): ?><div class="friend" >
				            	<img src="/Public/chat/<?php echo ($user['img']); ?>" />
				                <p>
				                	<strong><?php echo ($user["user"]); ?></strong><br/>
					                <span><?php echo ($user["mail"]); ?></span>
				                </p>
				                <div class="status available"></div>
				            </div><?php endif; endforeach; endif; ?>

			            <div id="search">
				            <input type="text" id="searchfield" value="Search contacts..." />
			            </div>  
			        </div>                
			    </div>	
			     
			    <div id="chatview" class="p1">    	
			        <div id="profile">
			            <div id="close"> 
			                <div class="cy"></div>
			                <div class="cx"></div>
			            </div>
			            <p><?php echo ($_SESSION['user']['user']); ?></p>
			            <span><?php echo ($_SESSION['user']['mail']); ?></span>
			        </div>
			        <div id="chat-messages" >
			        	<label>Thursday 02</label>
			            
			        </div>
			        <div id="sendmessage">
			        	<input type="text" id="send_msg" value="Send message..." />
			        </div>
			    </div>        
			</div>	
		</div>
	</div>
 <script type="text/javascript" src="/Public/jquery-3.2.1.js"></script>
<script>
	ws = new WebSocket("ws://127.0.0.1:7272");
		ws.onopen = function() {
		console.log("连接成功");
	};

	ws.onmessage = function(e){
	    var data = eval("("+e.data+")");
	    var type = data.type || '';
	    switch(type){
	        case 'init':
	            $.post('<?php echo U("Index/bind");?>', {client_id: data.client_id}, function(data){}, 'json');
	            break;
	        default :
	        $message=data.sendUserMsg;
	        $img=data.sendUserImg;
	        var template=getTemplate();
	        	template=template.replace(/{img}/g,$img);
	        	template=template.replace(/{msg}/g,$message);
	        	$('#chat-messages').append(template);
	            console.log(data.sendUserMsg);
	    }
	};

	function scrollWindow(){
	var t = document.getElementById('chat-messages');
		t.scrollTop = t.scrollHeight;
		setTimeout('scrollWindow()', 200);
	}

	window.onload = function() { scrollWindow(); }
	$(document).keydown(function(event){ 
		if(event.keyCode==13){ 
			$message=$('#send_msg').val();
			$uid=$('.animate').find('p.animate').html();
			var template=getRightTemplate();
			    template=template.replace(/{msg}/g,$message);
			    $('#chat-messages').append(template);
			$.post('<?php echo U("Index/send_message");?>', {uid:$uid,msg:$message},function(data){});
			$('#send_msg').val('');
		}

	});

	function getRightTemplate(){
		return  '<div class="message right">'
				+'<img src="/Public/chat/<?php echo ($_SESSION['user']['img']); ?>" />'
				+'<div class="bubble">'
				+'{msg}'
				+'<div class="corner"></div>'
				+'<span>1 min</span>'
				+'</div>'
				+'</div>'
	}

	function getTemplate(){
		return  '<div class="message">'
				+'<img src="/Public/chat/{img}" />'
			    +'<div class="bubble">'
			    +'{msg}'
			    +'<div class="corner"></div>'
			    +'<span>1 min</span>'
			    +'</div>'
			    +'</div>'
	}
	
	$(document).ready(function () {
	    var preloadbg = document.createElement('img');
	    preloadbg.src = '/Public/chat/img/timeline1.png';
	   //console.log(preloadbg);
	    $('#searchfield').focus(function () {
	        if ($(this).val() == 'Search contacts...') {
	            $(this).val('');
	        }
	    });
	    $('#searchfield').focusout(function () {
	        if ($(this).val() == '') {
	            $(this).val('Search contacts...');
	        }
	    });
	    $('#sendmessage input').focus(function () {
	        if ($(this).val() == 'Send message...') {
	            $(this).val('');
	        }
	    });
	    $('#sendmessage input').focusout(function () {
	        if ($(this).val() == '') {
	            $(this).val('Send message...');
	        }
	    });
	    $('.friend').each(function () {
	        $(this).click(function () {
	    	
	            var childOffset = $(this).offset();

	            var parentOffset = $(this).parent().parent().offset();
	            var childTop = childOffset.top - parentOffset.top;
	            var clone = $(this).find('img').eq(0).clone();
	            var top = childTop + 12 + 'px';
	           

	            $(clone).css({ 'top': top }).addClass('floatingImg').appendTo('#chatbox');
	            setTimeout(function () {
	                $('#profile p').addClass('animate');
	                $('#profile').addClass('animate');
	            }, 100);
	            setTimeout(function () {
	                $('#chat-messages').addClass('animate');
	                $('.cx, .cy').addClass('s1');
	                setTimeout(function () {
	                    $('.cx, .cy').addClass('s2');
	                }, 100);
	                setTimeout(function () {
	                    $('.cx, .cy').addClass('s3');
	                }, 200);
	            }, 150);
	            $('.floatingImg').animate({
	                'width': '68px',
	                'left': '108px',
	                'top': '20px'
	            }, 200);
	            var name = $(this).find('p strong').html();
	            var email = $(this).find('p span').html();
	            $('#profile p').html(name);
	            $('#profile span').html(email);
	            $('.message').not('.right').find('img').attr('src', $(clone).attr('src'));
	            $('#friendslist').fadeOut();
	            $('#chatview').fadeIn();
	            $('#close').unbind('click').click(function () {
	                $('#chat-messages, #profile, #profile p').removeClass('animate');
	                $('.cx, .cy').removeClass('s1 s2 s3');
	                $('.floatingImg').animate({
	                    'width': '40px',
	                    'top': top,
	                    'left': '12px'
	                }, 200, function () {
	                    $('.floatingImg').remove();
	                });
	                setTimeout(function () {
	                    $('#chatview').fadeOut();
	                    $('#friendslist').fadeIn();
	                }, 50);
	            });
	        });
	    });
	});
</script>
</body>
</html>
</body>

</html>