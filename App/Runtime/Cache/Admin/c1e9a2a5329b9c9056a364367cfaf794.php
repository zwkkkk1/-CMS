<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登录</title>
</head>
<link rel="stylesheet" href="__PUBLIC__/Admin/css/login.css" />
<body>
	<div name="login" id="login">
		<div name="left" id="left" >
			<img src="__PUBLIC__/Admin/images/1.jpg" />
		</div>
		<div name="right" id="right">
			<div name="right_border" id="right_border">
				<h1>管理员登录</h1>
				<ul class="login_ul">
					<li>
						<label for="username">用户名:</label>
						<input type="text" id="username" name="username" class="input_style user" size="35"/>
					</li>
					<li>
						<label for="password">密码:</label>
						<input type="password" id="password" name="password" class="input_style user" size="35"/>
					</li>
					<li style="float:left;">
						<label for="verify">验证码：</label>
						<input type="text" id="verify" name="verify" class="input_style" size="15"/>
						<div style="margin:5px 0 0 6px;float:right;*margin-top: -40px;*margin-right:20px">
						<img src="__PUBLIC__/captcha.php" height="30" width="100" style="cursor:pointer; " onclick='this.src="__PUBLIC__/captcha.php?"+Math.random()' id="verify_img"/>
						</div>
					</li>
					<li>
						<input type="button" value="提交" class="btn btn-primary" />
					</li>
				</ul>
			</div>
		</div>
	</div>
</body>
<script src="__PUBLIC__/Home/js/jq1.8.js"></script>
<script>
$('.btn-primary').click(function() {
	var username = document.getElementById('username').value;
	var password = document.getElementById('password').value;
	var verify = document.getElementById('verify').value;
	var verify_img = $('#verify_img');
	$.ajax({
		url: "<?php echo U('login');?>",
		data: {
			username: username,
			password: password,
			verify: verify
		},
		dataType: 'json',
		type: 'post',
		success: function(data) {
			if(data==1)
			{
				location.href="<?php echo U('Message/lst?cid=1');?>";
			} else {
				alert(data);
				verify_img.attr('src','__PUBLIC__/captcha.php');
			}
		}
	})
})
</script>
</html>