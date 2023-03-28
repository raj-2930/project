<?php include ( "inc/connect.inc.php" ); ?>
<?php 
$conn = mysqli_connect('localhost','localhost','','grocery');
if (isset($_REQUEST['poid'])) {
	
	$poid = mysqli_real_escape_string($conn,$_REQUEST['poid']);
	
}else {
	header('location: index.php');
}

ob_start();
session_start();



if (!isset($_SESSION['user_login'])) {
	$user = "";
	header("location: login.php?ono=".$poid."");
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($conn,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);

			$uname_db = $get_user_email['firstName'];
			$ulast_db=$get_user_email['lastName'];
			$uemail_db = $get_user_email['email'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}
function sanitize_number_int($value="") {
    return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
  }
  $poid=sanitize_number_int($poid);
$is_error = false;

$getposts = mysqli_query($conn,"SELECT * FROM products WHERE id ='$poid'") or die(mysql_error());

					if (mysqli_num_rows($getposts)) {
						$row = mysqli_fetch_assoc($getposts);
						
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						//$category = $row['category'];
						$available =$row['available'];
					}else{
						$is_error = true;
					}

//order

if (isset($_POST['order'])) {
//declere veriable
$mbl = $_POST['mobile'];
$addr = $_POST['address'];
$quan = $_POST['Quantity'];
$del = $_POST['Delivery'];
//triming name
	try {
		if(empty($_POST['mobile'])) {
			throw new Exception('Mobile can not be empty');
			
		}
		if(empty($_POST['address'])) {
			throw new Exception('Address can not be empty');
			
		}
		if(empty($_POST['Quantity'])) {
			throw new Exception('Quantity can not be empty');
			
		}
		if(empty($_POST['Delivery'])) {
			throw new Exception('Type of Delivery can not be empty');
			
		}

		
		// Check if email already exists
		
		
						$d = date("Y-m-d"); //Year - Month - Day
						
						// send email
						$msg = "
					
						Your Order suc

						
						";
						//if (@mail($uemail_db,"eBuyBD Product Order",$msg, "From:eBuyBD <no-reply@ebuybd.xyz>")) {
							
						if(mysqli_query($conn,"INSERT INTO orders (uid,pid,quantity,oplace,mobile,odate,delivery) VALUES ('$user','$poid',$quan,'$_POST[address]','$_POST[mobile]','$d','$del')")){

							//success message
							

							
						$success_message = '
						<div class="signupform_content">
						<h2><font face="bookman"></font></h2>
						<script>
						alert("Order placed successfully");
						</script>
						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman">

						</font></div></div>
						';
						

						

							
						}
						//}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Project</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="background-image: url(image/homebackgrndimg1.jpg);">
	<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="logout.php">LOG OUT</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="signin.php">SIGN IN</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 75px; width: 130px;" src="image/cart.png">
				</a>
			</div>
			
		</div>
	<div class="categolis">
		<table>
			<tr>
				<th>
					<a href="OurProducts/NoodlesCanned.php" style="text-decoration: none;color:#040403 ;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Noodles&Canned</a>
				</th>
				<th><a href="OurProducts/Seasonings.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Seasonings</a></th>
				<th><a href="OurProducts/Drinks.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Drinks</a></th>
				<th><a href="OurProducts/Snacks.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Snacks</a></th>
				<th><a href="OurProducts/Sweets.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Sweets</a></th>
				<th><a href="OurProducts/Soap&Detergent.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Soap&Detergent</a></th>
				<th><a href="OurProducts/Shampoo.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Shampoo</a></th>
				<th><a href="OurProducts/Hygene.php" style="text-decoration: none;color: #040403;padding: 4px 12px;background-color: #e6b7b8;border-radius: 12px;">Hygiene</a></th>
			</tr>
		</table>
	</div>
	<div class="holecontainer" style="padding: 20px 15%">
		<div class="container signupform_content ">
			<div>
				<?php 
				if($is_error){	
					?>

						<h3 style="color:red;font-size:18px; padding: 5px;">Invalid ID </h3> 
				
					<?php
					die;
				}
				?>
<?php
  $course = 'web security';
  $query = 'URL encode & decode';
  $label = 'Link label with < and >';

  $url = rawurlencode('/courses/' . $course . '/content');
  $url .= '?search=' . urlencode($query);
?>

 <!-- <a href="<?php echo htmlspecialchars($url); ?>">
  <?php echo htmlspecialchars($label); ?>
</a>  -->

				<div style="float: right;">

				<?php 
					if(isset($success_message)) {echo $success_message;

									echo '<h3 style="color:#169E8F;font-size:45px;"> Payment&Delivery </h3>';


						$user = $_SESSION['user_login'];
	$result = mysqli_query($conn,"SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$ulast_db=$get_user_email['lastName'];
			$uemail_db = $get_user_email['email'];
			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
			echo '<h3 style="color:black;font-size:25px;"> First Name: </h3>';
			echo'<span style="color:#34ce6c;font-size:25px;">'. $uname_db.'</span>';
			echo '<h3 style="color:black;font-size:25px;"> Last Name: </h3>';
			echo'<span style="color:#34ce6c;font-size:25px;">' .$ulast_db.'</span>';
			echo '<h3 style="color:black;font-size:25px;"> Email: </h3>'; 
			echo '<span style="color:#34ce6c;font-size:25px;">' .$uemail_db.'</span>';
			echo '<h3 style="color:black;font-size:25px;"> Contact Number: </h3>';
			echo '<span style="color:#34ce6c;font-size:25px;">' .$umob_db.'</span>';
			echo '<h3 style="color:black;font-size:25px;"> Home Address: </h3>';
			echo '<span style="color:#34ce6c;font-size:25px;">'.$uadd_db.'</span>';
			
			$del = $_POST['Delivery'] ;
			echo '<h3 style="color:black;font-size:25px;">Types of Delivery:</h3>';
			echo'<span style="color:#34ce6c;font-size:25px;">' .$del.'</span>';
			$quan = $_POST['Quantity'];
			echo '<h3 style="color:black;font-size:25px;"> Quantity: </h3>';
			echo'<span style="color:#34ce6c;font-size:25px;">' .$quan.'</span>';
			
			echo '<h3 style="color:#169E8F;font-size:45px;"> Total: Rs. '.$quan * $price.' </h2>';
			

	

			

					}
					else {
					echo '
						<div class="">
						<div class="signupform_text"></div>
						<div>
							<form action="" method="POST" class="registration">
								<div class="signup_form">
								<h3 style="color:red;font-size:18px; padding: 5px;">Accepting COD Only</h3>
									<div>
										<td>
											<input name="fullname" placeholder="your name" required="required" class="email signupbox" type="text" size="30" value="'.$uname_db.'">
										</td>
									</div>

									<div>
										<td>
											<input name="lastname" placeholder="Your last name" required="required" class="email signupbox" type="text" size="30" value="'.$ulast_db.'">
										</td>
									</div>



									<div>
									<td>
											<input name="mobile" placeholder="Your mobile number" required="required" class="email signupbox" type="text" size="30" value="'.$umob_db.'">
										</td>
									</div>
									<div>
										<td>
											<input name="address" id="password-1" required="required"  placeholder="Write your full address" class="password signupbox " type="text" size="30" value="'.$uadd_db.'">
										</td>
									</div>

									<div>
									<td>

									<font style="italic" family="arial" size="5px" color="#169e">
									Types of Delivery <br>
									

									 <input name="Delivery" required="required" value="Express Delivery + Rs. 100 upon cash on delivery" type="radio"  placeholder="Mode Of Payment"> Express Delivery </br>
									 <input name="Delivery" type="radio" value="Standard Delivery" required="required" placeholder="Mode Of Payment"> Standard Delivery </br>
									 </font>


									</td>
									</div>


									<div>
									<td>

									 <input name="Quantity" required="required" type="number" min="1" class="password signupbox" placeholder="Quantity">

									</td>
									</div>
									


									



									
									<div>
										<input name="order" class="uisignupbutton signupbutton" type="submit" value="Confirm Order">
									</div>
									<div class="signup_error_msg"> '; ?>
										<?php 
											if (isset($error_message)) {echo $error_message;}
											
										?>
									<?php echo '</div>
								</div>
							</form>
							
						</div>
					</div>

					';

					}

				 ?>
					</h3>
				</div>

			</div>
		</div>
		<div style="float: left; font-size: 23px;">
			<div>
				<?php
					echo '
						<ul style="float: left;">
							<li style="float: left; padding: 0px 25px 25px 25px;">
								<div class="home-prodlist-img">
									<img src="image/product/'.$item.'/'.$picture.'" class="home-prodlist-imgi">
									</a>
									<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: Rs. '.$price.'</div>
								</div>
								
							</li>
						</ul>
					';
				?>
			</div>

		</div>
	</div>
</body>
</html>
