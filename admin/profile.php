<?php
session_start();
 error_reporting(0);
$error='';$msg=''; 
include('includes/config.php');

if(strlen($_SESSION['alogin']) ==0 ){	
	 $setcoach  = htmlspecialchars($_COOKIE['coach']);
     $path      = ($setcoach) ? '/coach' : 'index';

    if (headers_sent()) 
                echo "<script type='text/javascript'> document.location = 'index'; </script>";
    else
        exit(header("Location: index"));
}else{	
if(isset($_POST['submit']))
  {	
  	$file       = $_FILES['imagem']['name'];
    $file_loc   = $_FILES['imagem']['tmp_name'];
    $folder   	="img/";
    $final_file =str_replace(' ','-',$file);
    if(move_uploaded_file($file_loc,$folder.$final_file))       
  		 $image = $final_file;

	$name  =$_POST['name'];
	$email =$_POST['email'];
	$link  =$_POST['link'];
	$id  =$_POST['id'];
	
	if ($_SESSION['tipo_user'] =='coach'){
		$sql  ="UPDATE coach SET nome=(:name), email=(:email), link=(:link) WHERE id = (:id)";
	}else{
		$sql  ="UPDATE admin SET username=(:name), email=(:email),link=(:link) WHERE id= (:id)";
	}
 
	$query = $dbh->prepare($sql);
	$query-> bindParam(':name', $name, PDO::PARAM_STR);
	$query-> bindParam(':email', $email, PDO::PARAM_STR);
	$query-> bindParam(':link', $link, PDO::PARAM_STR);
	$query-> bindParam(':id', $id, PDO::PARAM_INT);
	$query->execute();
	/*$query->debugDumpParams();
	die;*/
	$msg="Você Atualizou seu Perfil! ";
}    
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
	
	<title>Edit Admin</title>

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">

	<script type= "text/javascript" src="../vendor/countries.js"></script>
<style>
.errorWrap {
    padding: 10px;margin: 0 0 20px 0;background: #dd3d36;color:#fff;-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;  margin: 0 0 20px 0;	background: #5cb85c;color:#fff; -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.labelLink{
	  font-size: 10px;,color: #B0ABB2;font-style: italic;
}
</style>
</head>
<body>
<?php

		if ($_SESSION['tipo_user'] =='coach') {
			$sqls = "SELECT id, nome as username, email , link FROM coach WHERE id=".$_SESSION['coach_id'];
		}else{
			$sqls = "SELECT * FROM admin;";
		}
		$query = $dbh->prepare($sqls);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_OBJ);
		$cnt=1;	
?>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h3 class="page-title">Perfil Admin</h3>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

	<div class="panel-body">
<form method="post" name="fomperfil" action="profile" class="form-horizontal" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?php echo htmlentities($result->id);?>">
<div class="form-group">
<label class="col-sm-2 control-label">Username<span style="color:red">*</span></label>
<div class="col-sm-4">
	<input type="text" name="name" class="form-control" required value="<?php echo htmlentities($result->username);?>">
</div>
<label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
<div class="col-sm-4">
	<input type="email" name="email" class="form-control" required value="<?php echo htmlentities($result->email);?>">
</div>

</div>
<div class="form-group">

<label class="col-sm-2 control-label">Imagem<span style="color:red">*</span></label>
<div class="col-sm-4">
	    <input type="file" id="imagem" name="imagem" >
</div>

<label class="col-sm-2 control-label">Link  <span class="labelLink"> (Aparecerá ao final das perguntas)</span></label>
<div class="col-sm-4">
	<input type="text" name="link" class="form-control" value="<?php echo htmlentities($result->link);?>">
</div>
</div>




<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<button class="btn btn-primary" name="submit" type="submit">Save Changes</button>
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

	<!-- Loading Scripts -->
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
