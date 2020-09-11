<?php
session_start();
  

include 'connection.php';
	   
if (isset($_SESSION['id'])) {
	header("location: home");
}
 
if (isset($_POST['email'])) {
	$id_coach             = $_POST['id_coach'];
	$_SESSION['coach_id'] = $id_coach;
	$name 				  = $_POST['name'];
    $email = mysqli_real_escape_string($dbh , $_POST['email']);
	$checkmail = "SELECT * from users WHERE email = '$email'";
	$runcheck = mysqli_query($dbh , $checkmail) or die(mysqli_error($dbh));
	if (mysqli_num_rows($runcheck) > 0) {
		$played_on = date('Y-m-d H:i:s');
		$update = "UPDATE users SET played_on = '$played_on' WHERE email = '$email' ";
		$runupdate = mysqli_query($dbh , $update) or die(mysqli_error($dbh));
		 //$id_inserido = mysqli_insert_id($dbh);
		$row = mysqli_fetch_array($runcheck);
			$id                   = $row['id'];
			$_SESSION['id']       = $id;
			$_SESSION['email']    = $row['email'];
			$_SESSION['last_id']  = $id;
		header("location: home");
	}else {
			$played_on = date('Y-m-d H:i:s');

			$query = "INSERT INTO users(name, email,played_on, coach_id) VALUES ('{$name}' ,'$email','$played_on', {$id_coach} )";
			$run = mysqli_query($dbh, $query) or die($query ) ;
			$id_inserido = mysqli_insert_id($dbh);
			if (mysqli_affected_rows($dbh) > 0) {
				$query2 = "SELECT * FROM users WHERE email = '$email' ";
				$run2 = mysqli_query($dbh , $query2) or die(mysqli_error($dbh));
				if (mysqli_num_rows($run2) > 0) {
					$row = mysqli_fetch_array($run2);
					$id                   = $row['id'];
					$_SESSION['id']       = $id;
					$_SESSION['email']    = $row['email'];
					$_SESSION['last_id']  = $id_inserido;
					header("location: home");
				}
		}else {
				echo "<script> alert('something is wrong'); </script>";
			}
		}
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<title>QUIZ DISC v0.1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

	<form method="POST" action="">
	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form">
				<span class="contact100-form-title">
					Questionário DISC
				</span>

				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<span class="label-input100">Your Name</span>
					<input class="input100" type="text" name="name" placeholder="Digite seu nome" required>
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate = "É necessário um email válido: ex@abc.xyz">
					<span class="label-input100">Email</span> 
					<input class="input100" type="email" name="email" placeholder="Digite seu endereço de e-mail" required>
					<!-- <input class="input100" placeholder="Digite seu endereço de e-mail" required name="email" id="contact_email" type="email"  title="Contact's email (format: xxx@xxx.xxx)"  pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*"> -->
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 input100-select">
					<span class="label-input100">Coach</span>
					<div>
						<select name="id_coach" class="selection-2" >
						<option>Selecione ...</option>
						<?php 
						$sql = "SELECT * from coach WHERE status =1";
						$runcheck = mysqli_query($dbh , $sql) or die(mysqli_error($dbh));
						if (mysqli_num_rows($runcheck) > 0) {
							foreach ( mysqli_query($dbh , $sql) as $key => $value) {
		 				?>
							<option value="<?=$value['id']?>" ><?=$value['email']?></option>
					 <?php } ?>
					 <?php } ?>
						</select>
					</div>
					<span class="focus-input100"></span>
				</div>

</form>
<!-- 
				<div class="wrap-input100 input100-select">
					<span class="label-input100">Needed Services</span>
					<div>
						<select class="selection-2" name="service">
							<option>Choose Services</option>
							<option>Online Store</option>
							<option>eCommerce Bussiness</option>
							<option>UI/UX Design</option>
							<option>Online Services</option>
						</select>
					</div>
					<span class="focus-input100"></span>
				</div> 

				<div class="wrap-input100 input100-select">
					<span class="label-input100">Budget</span>
					<div>
						<select class="selection-2" name="budget">
							<option>Select Budget</option>
							<option>1500 $</option>
							<option>2000 $</option>
							<option>2500 $</option>
						</select>
					</div>
					<span class="focus-input100"></span>
				</div>


				<div class="wrap-input100 validate-input" data-validate = "Message is required">
					<span class="label-input100">Message</span>
					<textarea class="input100" name="message" placeholder="Your message here..."></textarea>
					<span class="focus-input100"></span>
				</div>-->

				<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn">
							<span>
								Submit
								<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</div>
			</form>
		</div>
	</div>

	<div id="dropDownSelect1"></div>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});


	</script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<!-- <script src="vendor/countdowntime/countdowntime.js"></script> -->
	<script src="js/main.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
 
<script>
</script>

</body>
</html>
