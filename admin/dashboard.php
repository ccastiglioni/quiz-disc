<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0){	
    $path = ( isset( $_COOKIE['coach'] ) ) ? '/coach' : 'index';
    if (headers_sent()) 
         echo "<script type='text/javascript'> document.location = 'index'; </script>";
    else
        die("<div style='background-image: url(img/resized.jpg);  opacity: 0.8;'>A Sessão Expirou! Por favor, clique neste link para se logar: <a href='{$path}'> Admin</a> </div>");
}
else{
	$sexo = ($_SESSION['genero'] == 'feminino') ? 'a' : 'o' ;
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
	
	<title>Coach Dashboard: <?=$_SESSION['nome']?></title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include('includes/header.php');?>
	<div class="ts-main-content">
<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Dashboard </h2>
						 <h3>Bem-vind<?=$sexo;?> : <?=$_SESSION['nome']?></h3>
						
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-primary text-light">
												<div class="stat-panel text-center">
<?php 
 if ($_SESSION['tipo_user'] =="coach") {	
	$sql ="SELECT id from users where coach_id=".$_SESSION['coach_id'] ;
 }else{
	$sql ="SELECT id from users " ;
 }

$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$bg=$query->rowCount();
?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($bg);?></div>
													<div class="stat-panel-title text-uppercase">Total Users</div>
												</div>
											</div>
											<a href="userlist" class="block-anchor panel-footer">Mais detalhes <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-light">
												<div class="stat-panel text-center">

<?php 
 if ($_SESSION['tipo_user'] =="coach") {
   $sql1 ="SELECT  qid  from questions where coach_id =".$_SESSION['coach_id'] ;;
 }else{
   $sql1 ="SELECT  qid  from questions ";;
 }
 
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$regbd=$query1->rowCount();
?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($regbd);?></div>
													<div class="stat-panel-title text-uppercase">Perguntas cadastradas</div>
												</div>
											</div>
											<a href="perguntas" class="block-anchor panel-footer text-center">Mais detalhes &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>

										 <div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-danger text-light">
												<div class="stat-panel text-center">

<?php 
$reciver = 'Admin';
$sql12 ="SELECT id from notification ";
$query12 = $dbh -> prepare($sql12);;
$query12-> bindParam(':reciver', $reciver, PDO::PARAM_STR);
$query12->execute();
$results12=$query12->fetchAll(PDO::FETCH_OBJ);
$regbd2=$query12->rowCount();
?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($regbd2);?></div>
													<div class="stat-panel-title text-uppercase">Notifications</div>
												</div>
											</div>
											<a href="notification" class="block-anchor panel-footer text-center">Mais detalhes &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-3">
										<div class="panel panel-default">
											<div class="panel-body bk-info text-light">
												<div class="stat-panel text-center">
												<?php 
  if ($_SESSION['tipo_user'] =="coach") {
  	$sql6 ="SELECT id from deleteduser WHERE coach_id =".$_SESSION['coach_id'] ;;
 }else{
   $sql6 ="SELECT id from deleteduser ";
 }

$query6 = $dbh -> prepare($sql6);;
$query6->execute();
$results6=$query6->fetchAll(PDO::FETCH_OBJ);
$query=$query6->rowCount();
?>
													<div class="stat-panel-number h1 "><?php echo htmlentities($query);?></div>
													<div class="stat-panel-title text-uppercase">usuários Deletados</div>
												</div>
											</div>
											<a href="deleteduser" class="block-anchor panel-footer text-center">Mais detalhes &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
							
								</div>
							</div>
						</div>
					</div>
				</div>












			</div>
		</div>
	</div>

    <?php include('includes/footer.php');?>


	<script>
	window.onload = function(){
		// Line chart from swirlData for dashReport
		var ctx = document.getElementById("dashReport").getContext("2d");
		window.myLine = new Chart(ctx).Line(swirlData, {
			responsive: true,
			scaleShowVerticalLines: false,
			scaleBeginAtZero : true,
			multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
		}); 
		// Pie Chart from doughutData
		var doctx = document.getElementById("chart-area3").getContext("2d");
		window.myDoughnut = new Chart(doctx).Pie(doughnutData, {responsive : true});

		// Dougnut Chart from doughnutData
		var doctx = document.getElementById("chart-area4").getContext("2d");
		window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {responsive : true});

	}
	</script>
</body>
</html>
<?php } ?>
