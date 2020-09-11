<?php 
session_start();
 

include 'connection.php';
if (isset($_SESSION['id'])) {
	$id_coach = $_SESSION['id'];
	//var_dump($_SESSION['coach_id']);
 
	//$_SESSION['coach_id'] =  $id_coach;
$query = "SELECT * FROM questions WHERE coach_id = ".$_SESSION['coach_id'];
$run = mysqli_query($dbh , $query) or die($query);
$total = mysqli_num_rows($run);
?> 

<!DOCTYPE html>
<html lang="en">
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
		<?php if ($total){
					$label_buton="Começar Agora";
					$action="question?n=1";
					$seta="right";
					$label_p="Em cada uma das {$total} questões a seguir, escolha uma alternativa (I, C, O ou A)";
				} else{
					$action="exit";
					$seta="left";
					$label_buton="Voltar";
					$label_p="Nenhuma pergunta foi cadastrada para esse Coach!";
				}?>

	<form method="POST" action="<?=$action?>" method="GET">
	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form">
				<span class="contact100-form-title">
				 	<h2> Bem-vindo ao Quiz !</h2>
				</span>
			
				<p><?=$label_p ?></p>
				<div class="wrap" >
					<span class="label-input">
						<li><strong> Número de questões: </strong><?php echo $total; ?></li></span>
					 
					<span class="focus-"></span>
				</div>

				<div class="wrap" >
				<p> O DISC é uma das ferramentas para uma gestão eficiente de Recursos Humanos, ajudando a prever reações dos colaboradores às situações e aos desafios. Essa informação auxilia nas tomadas de decisões para promover recrutamentos, seleções, capacitação e atividades para o desenvolvimento das equipes. Por isso, saber analisar o perfil DISC é fundamental.</p>				 
				</div>

			<div class="container-contact100-form-btn">
					<div class="wrap-contact100-form-btn">
						<div class="contact100-form-bgbtn"></div>
						<button class="contact100-form-btn" id="back">
							<span>
								<?=$label_buton ?>
								<i class="fa fa-long-arrow-<?=$seta?> m-l-7" aria-hidden="true"></i>
							</span>
						</button>
					</div>
				</div>
</form>
 
 
<?php unset($_SESSION['score']); ?>
<?php }
else {
	header("location: index");
}
?>
