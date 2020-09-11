<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include('includes/config.php');
 $nome  = $_SESSION['nome'];
if ($_SESSION['admin'] ='admin') { 

if(strlen($_SESSION['alogin'])==0){ 
    $path = ($setcoach) ? '/coach' : 'index';

    if (headers_sent()) 
         echo "<script type='text/javascript'> document.location = 'index'; </script>";
    else
        exit(header("Location: index"));
}else{

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
    
    <title>Manage Coach</title>

    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <link rel="stylesheet" href="css/style.css">
<style>
.errorWrap {
    padding: 10px;margin: 0 0 20px 0;background: #dd3d36;color:#fff;-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;margin: 0 0 20px 0;background: #5cb85c; color:#fff;-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
    color: white;background-color: #4285db;border: 1px solid #dfd7ca;border-bottom-color: transparent;cursor: default;
}
</style>
<?php 
       $array_perfil = ["Tubarao","Aguia","Lobo","Gato"];
       $array_perfilFull = [];
       $array_namelFull  = [];
       $array_meses     = [1,2,3,4,5,6,7,8,9,10,11,12];
        if ($_SESSION['tipo_user'] == 'admin'){  
             $whr = "";
        }else{
             $whr = " and coach_id=".$_SESSION['coach_id'];
        }

        foreach($array_perfil as $row)
        {   
              $sql = "SELECT COUNT(id) as qtd  FROM users  WHERE 1=1   {$whr} and score_num ='{$row}' and score is NOT NULL";
              $query = $dbh->prepare( $sql);
              $query->execute(); 
             
              $array_perfilFull[$row] = $query->fetch();
        }
 
 ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChartPie);
      function drawChartPie() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'DISC'],
          ['Gato',  <?=$array_perfilFull['Gato']['qtd']?>],
          ['Lobo',  <?=$array_perfilFull['Lobo']['qtd']?>],
          ['Tubarão',<?=$array_perfilFull['Tubarao']['qtd']?>],
          ['Aguia',  <?=$array_perfilFull['Aguia']['qtd']?>]
        ]);
        var options = {          
          title: "Olá <?=$nome?>, Pefil de Respostas para seu usuário",
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
</head>
<body>
    <?php include('includes/header.php');?>

    <div class="ts-main-content">
        <?php include('includes/leftbar.php');?>
        <div class="content-wrapper">
            <div class="container-fluid">

   <div class="row">
        <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  </div>
   <div class="row">
    <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active " data-toggle="tab" href="#home">Lobo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile1">Tubarão</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile2">Gato</a>
          </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#profile3">Águia</a>
           </li>
   </ul>
<?php 
      foreach($array_perfil as $row)
        {   
              $sql = "SELECT CONCAT('<b>Nome</b>: ',name, ' <b>data do teste:</b> ',played_on ) info  FROM users  
                         WHERE 1=1  {$whr} and score_num ='{$row}' and score is NOT NULL";
              $query = $dbh->prepare( $sql);
              $query->execute();  
              $array_namelFull[$row] = $query->fetchAll();
        }
 ?>
<div id="myTabContent" class="tab-content">
  <div class="tab-pane fade active" id="home" style="background-color: beige;">
    <p><?php 
        foreach ($array_namelFull['Lobo'] as $key => $value) {
          echo "<br>";
             if ($value['info']) {
                print_r($value['info']);  
             }else{
                $lobo[] = $value['info'];
             }
        }
        if (empty($lobo)) {
            echo " Nenhum perfil para Lobo!";
        }
     ?> </p>
  </div>
  <div class="tab-pane fade" id="profile1" style="background-color: beige;">
        <p><?php 
        foreach ($array_namelFull['Tubarao'] as $key => $value) {
           echo "<br>";
             if ($value['info']) {
                print_r($value['info']);  
             }else{
                $tub[] = $value['info'];
             }
        }
        if (empty($tub)) {
            echo " Nenhum perfil para Tubarão!";
        }
     ?> </p>
  </div>
  <div class="tab-pane fade" id="profile2" style="background-color: beige;">
        <p><?php 
        foreach ($array_namelFull['Gato'] as $key => $value) {
             echo "<br>";
             if ($value['info']) {
                print_r($value['info']);  
             }else{
                $gato[] = $value['info'];
             }
        }
        if (empty($gato)) {
            echo " Nenhum perfil para Gato!";
        }
     ?> </p>
  </div>
  <div class="tab-pane fade" id="profile3" style="background-color: beige;">
        <p><?php 
        foreach ($array_namelFull['Aguia'] as $key => $value) {
           echo "<br>";
             if ($value['info']) {
                print_r($value['info']);  
             }else{
                $aguia[] = $value['info'];
             }
        }
        if (empty($aguia)) {
            echo " Nenhum perfil para Águia!";
        }     ?> </p>
  </div>
</div>
<?php 
     foreach($array_meses as $key => $row){   
       foreach($array_perfil as $keys => $rowperfil ){ 
                $sql = "SELECT COUNT(id) as count FROM users  
                              WHERE EXTRACT(MONTH FROM played_on) = '{$row}'  {$whr}  and score_num ='{$rowperfil}' and  score is NOT NULL";
                    $query = $dbh->prepare( $sql);
                    $query->execute(); 
                    $array_meslFull[$row][$rowperfil] = $query->fetchAll(PDO::FETCH_COLUMN);
               }
       }
 ?>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mês', 'Gato', 'Lobo', 'Tubarão','Águia'],
          ['Jan', <?=$array_meslFull[1]['Gato'][0]?>, <?=$array_meslFull[1]['Lobo'][0]?>, <?=$array_meslFull[1]['Tubarao'][0]?>, <?=$array_meslFull[1]['Aguia'][0]?>],
          ['Fev', <?=$array_meslFull[2]['Gato'][0]?>, <?=$array_meslFull[2]['Lobo'][0]?>, <?=$array_meslFull[2]['Tubarao'][0]?>, <?=$array_meslFull[2]['Aguia'][0]?>],
          ['Mar', <?=$array_meslFull[3]['Gato'][0]?>, <?=$array_meslFull[3]['Lobo'][0]?>, <?=$array_meslFull[3]['Tubarao'][0]?>, <?=$array_meslFull[3]['Aguia'][0]?>],
          ['Abril', <?=$array_meslFull[4]['Gato'][0]?>, <?=$array_meslFull[4]['Lobo'][0]?>, <?=$array_meslFull[4]['Tubarao'][0]?>, <?=$array_meslFull[4]['Aguia'][0]?>],
          ['Maio', <?=$array_meslFull[5]['Gato'][0]?>, <?=$array_meslFull[5]['Lobo'][0]?>, <?=$array_meslFull[5]['Tubarao'][0]?>, <?=$array_meslFull[5]['Aguia'][0]?>],
          ['Jun', <?=$array_meslFull[6]['Gato'][0]?>, <?=$array_meslFull[6]['Lobo'][0]?>, <?=$array_meslFull[6]['Tubarao'][0]?>, <?=$array_meslFull[6]['Aguia'][0]?>],
          ['Jul', <?=$array_meslFull[7]['Gato'][0]?>, <?=$array_meslFull[7]['Lobo'][0]?>, <?=$array_meslFull[7]['Tubarao'][0]?>, <?=$array_meslFull[7]['Aguia'][0]?>],
          ['Ago', <?=$array_meslFull[8]['Gato'][0]?>, <?=$array_meslFull[8]['Lobo'][0]?>, <?=$array_meslFull[8]['Tubarao'][0]?>, <?=$array_meslFull[8]['Aguia'][0]?>],
          ['Set', <?=$array_meslFull[9]['Gato'][0]?>, <?=$array_meslFull[9]['Lobo'][0]?>, <?=$array_meslFull[9]['Tubarao'][0]?>, <?=$array_meslFull[9]['Aguia'][0]?>],
          ['Out', <?=$array_meslFull[10]['Gato'][0]?>, <?=$array_meslFull[10]['Lobo'][0]?>, <?=$array_meslFull[10]['Tubarao'][0]?>, <?=$array_meslFull[10]['Aguia'][0]?>],
          ['Nov', <?=$array_meslFull[11]['Gato'][0]?>, <?=$array_meslFull[11]['Lobo'][0]?>, <?=$array_meslFull[11]['Tubarao'][0]?>, <?=$array_meslFull[11]['Aguia'][0]?>],
          ['Dez', <?=$array_meslFull[12]['Gato'][0]?>, <?=$array_meslFull[12]['Lobo'][0]?>, <?=$array_meslFull[12]['Tubarao'][0]?>, <?=$array_meslFull[12]['Aguia'][0]?>],  
        ]);

        var options = {
          chart: {
            title: ' * Analise por Mês',
            subtitle: '* Número de Usuários ',
          },
          bars: 'horizontal'
        };

        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
 
    <div id="barchart_material" style="width: 810px; height: 620px;"></div>
    <br>
    <br>
   </div>
            </div>
        </div>
    </div>
    <?php include('includes/footer.php');?>
</body>
</html>
<?php } ?>
<?php }else{
    header('location:index');
} ?>
<script type="text/javascript">
    $('#myTabContent home').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>
