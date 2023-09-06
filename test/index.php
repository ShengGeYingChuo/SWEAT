<!DOCTYPE html>
<html>
	<head>
		<meta charset="utc-8" />
		<title>index</title>
		<link rel="stylesheet" href="css/login.css" />
		<style>
			* {
				margin: 0;
				padding: 0;
			}

			.main {
				width: 1280px;
				height: 100%;
				margin: 0 auto;
				position: relative;
			}

			.content {
				width: 1280px;
				margin: 0 auto;
			}

			.login-box {
				width: 100vw;
				height: 100vh;
				background: url(img/bg-login.jpg) no-repeat;
				background-size: cover;
			}

			.header {
				width: 100%;
				position: absolute;
				padding: 24px 0;
				background: rgba(255, 255, 255, 0.7);
			}

			.select {
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				display: flex;
			}

			.select .btn {
				width: 240px;
				height: 64px;
				line-height: 64px;
				font-size: 24px;
				text-align: center;
				background-image: linear-gradient(90deg, #0367a6 0%, #008997 74%);
				color: #fff;
				border-radius: 32px;
				cursor: pointer;
			}

			.select .btn+.btn {
				margin-left: 32px;
			}

			.body {
				width: 100%;
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				display: none;
			}
			.body .flex{
				display: flex;
				justify-content: space-between;
			}
			.body .title {
				font-size: 48px;
			}

			.body .title2 {
				font-size: 32px;
			}

			.body p {
				font-size: 24px;
			}

			.body .login {
				width: 300px;
				background-color: #fff;
				padding: 48px 32px;
			}

			.body .login .login-title {
				text-align: center;
				font-size: 32px;
				padding: 24px 0;
				color: #008997;
			}

			.body .login .input {
				margin-bottom: 32px;
			}

			.body .login input {
				width: 100%;
				height: 48px;
				padding: 0 12px;
				box-sizing: border-box;
				border-radius: 12px;
				border: 1px solid #008997;
			}

			.body .login input:focus {
				outline: none;
				border: 1px solid #0367a6
			}

			.body .login button {
				width: 100%;
				height: 48px;
				background-color: #0367a6;
				color: #fff;
				font-size: 18px;
				border-radius: 12px;
				border: 0;

			}

			.footer {
				position: absolute;
				bottom: 0;
				padding: 12px 0;
				color: #fff;
				font-size: 14px;
				width: 100%;
				text-align: center;
			}
		</style>
	</head>
	<body>
		<!-- header -->
		<!-- 		<header style="width: 100%; height: 100px; text-align: center;">
			<img src="img/full-colour.svg"
				style="max-height:100px;max-width:200px;display:flex;content-justify:left;margin-top:50px;margin-left:100px;">
		</header>

		<h2 style="width:100%;height:20px;background-color:#212b58;">
		</h2>

		<main style="display:flex;height:500px;">
			<button type="button" onclick="select('student')">i'm student</button>
			<button type="button" onclick="select('prof')">i'm professor</button>
		</main>

		<footer style="background-color:black; width:100%;height:100px;">
		</footer> -->

		<!-- import script -->
		<!-- 		<script language="javascript" src="jquery.js"></script>
		<script language="javascript">
			function select(target) {
				if (target == "student") {
					document.getElementsByTagName("main")[0].innerHTML =
						'<section name="student"><h2>student</h2><p>user name:<input type="text" style="width:200px;" name="user_name" /></p><p>password:<input type="password" style="width:200px;" name="user_psw" /></p>'
					document.getElementsByTagName("main")[0].innerHTML +=
						'<button style="background-color:white;border-bottom:1px solid #1E1E1E;" type="button" onclick="">Login</button></section>'
				} else {
					document.getElementsByTagName("main")[0].innerHTML =
						'<section name="prof"><h2>professor</h2><form style="margin-left:10px;"><p>user name:<input type="text" style="width:200px;" name="user_name" /></p><p>password:<input type="password" style="width:200px;" name="user_psw" /></p>'
					document.getElementsByTagName("main")[0].innerHTML +=
						'<button style="background-color:white;border-bottom:1px solid #1E1E1E;" type="button" onclick="">Login</button></form></section>'
				}
				document.getElementsByTagName("main")[0].innerHTML +=
					"<button type='button' onclick='document.location.reload()'>back</button>"
			}
		</script> -->
		<!-- set website title -->

		<!-- 登录 -->

		<div class="login-box">
			<div class="header">
				<div class="content">
					<img src="img/full-colour.svg" style="max-height:100px;max-width:200px;">
				</div>
			</div>
			<div class="main">
				<div class="select">
					<div class="btn" id="student">
						<!-- <div class="img"><img src="img/student.png" alt=""></div> -->
						<div class="name">student</div>
					</div>
					<div class="btn" id="professor">
						<!-- <div class="img"><img src="img/professor.png"/></div> -->
						<div class="name">professor</div>
					</div>
				</div>
				<div class="body" id="login-student">
					<div class="flex">
						<div class="text">
							<div class="title">Welcome to SWEAT!</div>
							<div class="title2">
								For students:
							</div>
							<p>View your Calendar, plan your work, leave feedback!</p>
							<div class="title2">
								For teacher:
							</div>
							<p>Manager your course, balance workload!</p>
						</div>
						<div class="login">
							<div class="login-title"><img src="img/SWEAT Black Logo.svg"  width="240" height="200" /></div>
							<form action="" method="post">
							<div class="input">
								<input name="username" type="text" placeholder="username">
							</div>
							<div class="input">
								<input name="password" type="password" placeholder="password">
							</div>
							<div class="input">
								<button>Sing in</button>
							</div>
							</form>
						</div>
					</div>
				</div>
				<div class="body" id="login-professor">
					<div class="flex">
						<div class="text">
							<div class="title">Welcome to sweat!</div>
							<div class="title2">
								For students:
							</div>
							<p>View your Calendar, plan your work, leave feedback!</p>
							<div class="title2">
								For teacher:
							</div>
							<p>Manager your course, balance workload!</p>
						</div>
						<div class="login">
							<div class="login-title">SWEAT</div>
							<div class="input">
								<input type="text" placeholder="username">
							</div>
							<div class="input">
								<input type="password" placeholder="password">
							</div>
							<div class="input">
								<button>Sing in</button>
							</div>
						</div>
					</div>
				</div>
				<div>
					<div class="footer">
						If you have any concerns feedbacks, please email sgcyin@liverpool.ac.uk or
						Markyin0322@gmail.com.
					</div>
				</div>
				<script language="javascript" src="jquery.js"></script>
				<script>
					$(document).ready(function() {
						$('.body').hide() //隐藏登录框
						$('#student').click(function() { //点击student 
							$('#login-student').show() //显示student登录框
							$('.select').hide() //隐藏所有按钮
						})
						$('#professor').click(function() { //点击professor 
							$('#login-professor').show() //显示professor登录框
							$('.select').hide() //隐藏所有按钮
						})
					})
				</script>
	</body>
</html>
