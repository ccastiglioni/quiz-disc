<?php 
session_start();
include 'connection.php';
if (isset($_SESSION['id'] )) {
    ?>
    <?php if(!isset($_SESSION['score'])) {
        header("location: question.php?n=1");
    }
    ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <title>QUIZ DISC v0.1</title>
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
 <!-- <form action="www.google.com" name="fomlink"> -->
    <div class="container-contact100">
        <div class="wrap-contact100">
            <div class="contact100-form validate-form">
                <span class="contact100-form-title">
                 <h2>Parabéns!</h2> </span></div>
        <main>
            <div class= "container">
         
            <?php  
                   $score = $_SESSION['score'];
                    $keys = array('a','c','i','o' );
                    $values = array_fill(0, 4, 0);
                    $freq = array_combine($keys, $values);
                   
                     
                    $len = strlen($score );
                    for ($i=0; $i<$len; $i++) {
                       $letter = strtolower($score[$i]);
                      if (array_key_exists($letter, $freq)) {
                        $freq[$letter]++;
                      }
                    }            
                     asort($freq);
                     end( $freq );
                     // print_r( $freq ) ;
              
                      if (key ($freq) == 'c') {
                        $img = "<div class= 'current'>Seu perfil é como Gato</div><img src='images/gato.jpg' width='100%' height=''>";
                        $tipoPerfil="Gato";
                      }elseif (key ($freq) == 'i') {
                        $img = "<div class= 'current'>Seu perfil é como Águia</div><img src='images/aguia.jpg' width='100%' height=''>";
                        $tipoPerfil="Aguia";
                      }elseif (key ($freq) == 'o') {
                        $img = "<div class= 'current'>Seu perfil é como Lobo</div><img src='images/lobo.jpg' width='100%' height=' '>";
                        $tipoPerfil="Lobo";
                      }elseif (key ($freq) == 'a') {
                        $img = "<div class= 'current'>Seu perfil é como Tubarão</div><img src='images/tubarao.jpg' width='100%' height=' '>";
                        $tipoPerfil="Tubarao";
                      }

                     echo "<div class='container'>";
                       echo($img);
                     echo  "</div>";

                    $score    = $_SESSION['score'];
                    $email    = $_SESSION['email'];
                    $id       = $_SESSION['last_id'];
            
                    $query = "SELECT * FROM questions where status=1 and coach_id= ".$_SESSION['coach_id'];
                    $run   =  mysqli_query($dbh , $query) or die(mysqli_error($dbh));
                    $total = mysqli_num_rows($run);

                    $varMultiplica =  100/$total;

                    foreach ($freq as $key => $value) {
                         $resultado[] = strtoupper( $key ). " - ". $value *$varMultiplica . "%";
                    }
                    $resultadoString = implode($resultado,',' );
                    $resultadoStringNum = implode($freq,',' );
                    $queryporceto = "UPDATE users SET score  = '$resultadoString', score_num='{$tipoPerfil}' WHERE id = $id";
                    mysqli_query($dbh , $queryporceto) or die($queryporceto);

                  $sqlC ="SELECT link FROM coach WHERE id = ".$_SESSION['coach_id'];;
                  $runlink = mysqli_query($dbh , $sqlC) or die(mysqli_error($dbh));
                  $row = mysqli_fetch_array($runlink);
                ?><br>
                
             <div class="container">
                 <p>Você completou com sucesso o teste</p>
                 <br>
                 <?php if (isset($row['link'])) {?>
                  
                <div  class="wrap-contact100-form-btn">
                  <div class="contact100-form-bgbtn"></div>
              
                      <button onclick="location.href='<?=$row['link'];?>'" class="contact100-form-btn">
                          <span>
                          Acesse o Link <i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
                          </span>
                      </button>    
                </div>
                <br>
               <?php } ?>
                 <div class= "current">Percentual de cada habilidade :<br> <?= str_replace(',', ', ', $resultadoString )?></div>
                <p></p>
            </div>
        </div>
    </div>
  <!-- </form> -->
<?php unset($_SESSION['score']); ?>
<?php unset($_SESSION['time_up']); ?>
<?php unset($_SESSION['start_time']); ?> 
<?php unset($_SESSION['coach_id']); 
@session_start();
@session_destroy(); 
?>
<?php } else {
    header("location: home.php");
}
?>

