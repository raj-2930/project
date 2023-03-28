<?php include ( "inc/connect.inc.php" ); ?>

<?php
ob_start();
session_start();
error_reporting (E_ALL ^ E_NOTICE);
if (empty($_SESSION['token'])) {
	$_SESSION['token'] = md5(uniqid(mt_rand(), true));
}

if (!isset($_SESSION['user_login'])) {
}
else {
	header("location: index.php");
}
if(isset($_COOKIE['user'])){

	echo "<div style='color:white; padding:20px; font-size:2.5em; background:tomato;'><b>Block User</b> <br>".$_COOKIE['user']."</div>";

}else{

	$conn = mysqli_connect('localhost','localhost','','grocery');

	$emails = "";
	$passs = "";
	if (isset($_POST['login'])) {

		$token = filter_var($_POST['token'], FILTER_SANITIZE_STRING);

			if (isset($_POST['email']) && isset($_POST['password']) && $token && $token == $_SESSION['token'] ) {
				
				$user_login = mysqli_real_escape_string($conn,$_POST['email']);
				$user_login = mb_convert_case($user_login, MB_CASE_LOWER, "UTF-8");	
				$password_login = mysqli_real_escape_string($conn,$_POST['password']);	
				
				$num = 0;
				$password_login_sha256 = hash('sha256',$password_login);	
				$tmp_result="SELECT * FROM user WHERE (email='$user_login') AND password='$password_login_sha256'";
				$result = mysqli_query($conn,$tmp_result);
				$num = mysqli_num_rows($result);
				$get_user_email = mysqli_fetch_assoc($result);
					$get_user_uname_db = $get_user_email['id'];

						if ($num>0) {

							$_SESSION['user_login'] = $get_user_uname_db;
							setcookie('user_login', $user_login, time() + (10 * 60), "/");
							
							if (isset($_REQUEST['ono'])) {
								$ono = mysqli_real_escape_string($_REQUEST['ono']);
								header("location: orderform.php?poid=".$ono."");
							}else {
								header('location: index.php');
							}
							exit();
						}else {

							$tmp_result = "SELECT * FROM user WHERE (email='$user_login') AND password='$password_login_sha256'";
							$result = mysqli_query($conn,$tmp_result);
							$num = mysqli_num_rows($result);
							$get_user_email = mysqli_fetch_assoc($result);
							$get_user_uname_db = $get_user_email['id'];

							if ($num>0) {
								$emails = $user_login;
								$activacc ='';
							}else {
								$emails = $user_login;
								$passs = $password_login;
								$error_message = '<br><br>
									<div class="maincontent_text" style="text-align: center; font-size: 18px;">
									<font face="bookman">Email or Password incorrect.<br>
									</font></div>';
									$_SESSION['u']+=1;
									echo "You Enter ".$_SESSION['u']."Time Wrong  UID and Password";
									echo "<br><a href='login.php'>Try Again</a>";
									if($_SESSION['u']>2)
									{
										header('location:time.php');
									}
							}
						}
					
			}
		}
	}
	
$acemails = "";
$acccode = "";

if(isset($_POST['activate'])){

	if(isset($_POST['actcode'])){

		$user_login = mysqli_real_escape_string($conn,$_POST['acemail']);
		$user_login = mb_convert_case($user_login, MB_CASE_LOWER, "UTF-8");	
		$user_acccode = mysqli_real_escape_string($conn,$_POST['actcode']);
		$result2 = mysqli_query($conn,"SELECT * FROM user WHERE (email='$user_login') AND confirmCode='$user_acccode'");
		$num3 = mysqli_num_rows($conn,$result2);
		echo $user_login;
		if ($num3>0) {
			$get_user_email = mysqli_fetch_assoc($conn,$result2);
			$get_user_uname_db = $get_user_email['id'];
			$_SESSION['user_login'] = $get_user_uname_db;
			setcookie('user_login', $user_login, time() + (365 * 24 * 60 * 60), "/");
			mysqli_query($conn,"UPDATE user SET confirmCode='0', activation='yes' WHERE email='$user_login'");
			if (isset($_REQUEST['ono'])) {
				$ono = mysqli_real_escape_string($conn,$_REQUEST['ono']);
				header("location: orderform.php?poid=".$ono."");
			}else {
				header('location: index.php');
			}
			exit();
		}else {
			$emails = $user_login;
			$error_message = '<br><br>
				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
				<font face="bookman">Code not matched!<br>
				</font></div>';
		}
	}else {
		$error_message = '<br><br>
				<div class="maincontent_text" style="text-align: center; font-size: 18px;">
				<font face="bookman">Activation code not matched!<br>
				</font></div>';
	}

}
?>
	<meta http-equiv="refresh" content="20">
<!doctype html>
<html>
	<head>
		<title>Welcome to Project</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body class="home-welcome-text" style="background-image: url(image/homebackgrndimg1.jpg);">
		<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<a style="text-decoration: none; color: #fff;" href="signin.php">SIGN IN</a>
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<a style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 75px; width: 130px;" src="image/cart.png">
				</a>
			</div>
			
		</div>
		<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 110px;">
			<div class="container">
				<div>
					<div>
						<div class="signupform_content">
							<?php
							 	if (isset($activacc)){
							 		echo '<h2>Activation Form</h2>';
							 	}else {
							 		echo '<h2>Login Form</h2>';
							 	}
							?>
							<div class="signupform_text"></div>
							<div>
								<form action="" method="POST" class="registration">
								<input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
									<div class="signup_form">
										<?php
											if (isset($activacc)) {

												echo '
													<div class="signup_error_msg">
														<div class="maincontent_text" style="text-align: center; font-size: 18px;">
													<font face="bookman">Check your email!<br>
													</font></div>
													</div>
													<div>
														<td>
															<input name="acemail" placeholder="Enter Your Email" required="required" class="email signupbox" type="email" size="30" value="'.$emails.'">
														</td>
													</div>
													<div>
														<td>
															<input name="actcode" placeholder="Activation Code" required="required" class="email signupbox" type="text" size="30" value="'.$acccode.'">
														</td>
													</div>
													<div>
														<input name="activate" class="uisignupbutton signupbutton" type="submit" value="Active Account">
													</div>
													';
											}else{
												echo '
										<div>
											<td>
												<input name="email" placeholder="Enter Your Email" required="required" class="email signupbox" type="email" size="30">
											</td>
										</div>
										<div>
											<td>
												<input name="password" id="password-1" required="required"  placeholder="Enter Password" class="password signupbox " type="password" size="30">
											</td>
										</div>
										<div>
											<input name="login" class="uisignupbutton signupbutton" type="submit" value="Log In">
										</div>
										';
											}
										  ?>
										
										<div class="signup_error_msg">
											<?php 
												if (isset($error_message)) {echo $error_message;}
												
											?>
										</div>
									</div>
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
