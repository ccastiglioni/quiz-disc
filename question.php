<?php 
include 'connection.php';

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
session_start();
if (isset($_SESSION['id'])) {
	
	if (isset($_GET['n'] )) {
	        $qno = $_GET['n'];
	        if ($qno == 1) 
	        	$_SESSION['quiz'] = 1;
	        
	  }else {
	        	header('location: question?n='.$_SESSION['quiz']);
	        } 
	        if (isset($_SESSION['quiz']) && $_SESSION['quiz'] == $qno) { 
				$query = "SELECT * FROM questions WHERE qno = '{$qno}' AND status=1 AND coach_id=".$_SESSION['coach_id'] ;
			 
				$run = mysqli_query($dbh , $query) or die(mysqli_error($dbh));
				if (mysqli_num_rows($run) > 0) {
					$row = mysqli_fetch_array($run);
			
                 $question          = $row['question'];
                 $_SESSION['quiz'] = $qno;
                 $checkqsn = "SELECT * FROM questions WHERE  status=1 and coach_id=".$_SESSION['coach_id'] ;
                 $runcheck = mysqli_query($dbh , $checkqsn) or die(mysqli_error($dbh));
                 $countqsn = mysqli_num_rows($runcheck);
   
				}else {
					echo "<script> alert('something went wrong');window.location.href = 'home'; </script> " ;
				}
		   }else {
		echo "<script> alert('error '); </script> " ;
	}
?>
<?php 
$total = "SELECT * FROM questions  WHERE status=1 and coach_id=".$_SESSION['coach_id'] ;
$run = mysqli_query($dbh , $total) or die(mysqli_error($dbh));
$totalqn = mysqli_num_rows($run);

?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
	<title>QUIZ DISC v0.1</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
	<div class="container-contact100">
		<div class="wrap-contact100">
			<div class="contact100-form validate-form">
				<span class="contact100-form-title">
					Avaliação de Preferência Cerebral
				</span>
				<div class="container">
					 <div class= "current">Question <?php echo $qno; ?> of <?php echo $totalqn; ?></div>
					<h3  class="select2-search__field"><?=utf8_encode($question); ?></h3>
					<span class="focus-input100"></span>
				</div>
				</div>
				<br>

		<form method="post" action="process.php" id="form_id">
		<ul class="choices">
			<?php  
			$input = array("ans1", "ans2", "ans3", "ans4");

			if($qno % 2 == 0){
			    rsort($input); 
			} else {
			    ksort($input); 
			}
			 $comma_separated = implode(",", $input);
			
			$query = "SELECT $comma_separated  FROM questions WHERE status=1 AND  qno = '$qno' AND coach_id=".$_SESSION['coach_id']." ORDER BY RAND() LIMIT 1 " ;  
			 $var = mysqli_query($dbh , $query);	
			 $row = mysqli_fetch_assoc($var);
			foreach ($row as $key => $value) { 
			 ?>
		<li><input name="choice" type="radio" value="<?=$key?>" required=""> <?=utf8_encode( $value); ?> </li>
	<?php } ?>
		</ul>

<div class="container-contact100-form-btn">
	<div class="wrap-contact100-form-btn">
		<div class="contact100-form-bgbtn"></div>
 
		<button class="contact100-form-btn"  id="button_id" >
			<span>
				Next
				<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
			</span>
		</button>
       <input type="hidden" name="number" value="<?php echo $qno;?>">
	</div>
</div>
<br>
<br>
<br>
</form>
<script>
$(document).ready(function(){
	$('#button_id').on('click',function(){
	     ('#form_id').submit();
	 });

	 if (window.history && window.history.pushState) {
		    window.history.pushState('forward', null, './#forward');
		    $(window).on('popstate', function() {
		    	if (confirm("Click em OK para encerrar ..\n Suas respostas serão excluidas!")) {
		      		window.location.href = 'exit';
		    	}
		    });
     }
 });
</script>
		</div>
	</div>

<?php } else {
	header("location: home.php");
}
?>
