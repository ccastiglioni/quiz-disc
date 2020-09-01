<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {	
	header('location:index');
} else{
if(isset($_POST['submit'])){
	$password   =md5($_POST['password']);
	$newpassword=md5($_POST['newpassword']);
	$username   =$_SESSION['alogin'];
	if ( $_SESSION['tipo_user']  == 'coach') {
		$con="UPDATE coach SET password=:newpassword WHERE email=:username";
	    $sql ="SELECT password FROM coach WHERE email=:username and password=:password";
	}else{
    	$sql ="SELECT Password FROM admin WHERE UserName=:username and Password=:password";
	    $con="UPDATE admin SET Password=:newpassword WHERE UserName=:username";
	}

	$query= $dbh -> prepare($sql);
	$query-> bindParam(':username', $username, PDO::PARAM_STR);
	$query-> bindParam(':password', $password, PDO::PARAM_STR);
	$query-> execute();
	$results = $query -> fetchAll(PDO::FETCH_OBJ);
	if($query -> rowCount() > 0)
	{   $user = $_SESSION['tipo_user'];
		$label = "Password changed nome:".$_SESSION['nome'];
		$sqlN = "INSERT INTO notification (notireciver ,notitype ) VALUES ('{$user}' , '{$label}' )";
		$queryN = $dbh->prepare($sqlN);
		$queryN->execute() or die($sqlN);

		$chngpwd1 = $dbh->prepare($con);
		$chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
		$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
		$chngpwd1->execute();
		$msg="Sua senha foi alterada com sucesso";
	}else {
		$error="Sua senha atual não é válida.";	
	}
}

//die;
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title> Admin Sesão para mudar senha</title>

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
<script type="text/javascript">
function valid()
{
if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
{
alert("Os campos Nova senha e Confirmar senha não coincidem !");
document.chngpwd.confirmpassword.focus();
return false;
}
return true;
}
</script>
  <style>
.errorWrap {
    padding: 10px;margin: 0 0 20px 0;	background: #dd3d36;	color:#fff;-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px; margin: 0 0 20px 0;	background: #5cb85c;color:#fff;-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
</style>
</head>
<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Mudar senha</h2>
						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Form fields</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
  	        	     <?php if($error){?>
  	        	  	<div class="errorWrap"><strong>ERRO </strong>:<?php echo htmlentities($error); ?> </div>
  	        	     <?php } 
						else if($msg){?>
					<div class="succWrap"><strong>SUCCESS </strong>:<?php echo htmlentities($msg); ?> </div>
				    <?php }?>
											<div class="form-group">
												<label class="col-sm-4 control-label">Senha Atual</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="password" id="password" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
											
											<div class="form-group">
												<label class="col-sm-4 control-label">Nova Senha</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="newpassword" id="newpassword" required>
												</div>
											</div>
											<div class="hr-dashed"></div>

											<div class="form-group">
												<label class="col-sm-4 control-label">Confirme a Senha</label>
												<div class="col-sm-8">
													<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
												</div>
											</div>
											<div class="hr-dashed"></div>
										
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
													<button class="btn btn-primary" name="submit" type="submit">Salvar</button>
												</div>
											</div>

										</form>

									</div>
								</div>
							</div>
							
						</div>
						
					

					</div>
				</div>
				
			
			</div>
		</div>
	</div>

	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main-admin.js"></script>
	<script type="text/javascript">
				 $(document).ready(function () {          
					setTimeout(function() {
						$('.succWrap').slideUp("slow");
					}, 3000);
					});
	</script>

</body>

</html>
<?php } ?>
