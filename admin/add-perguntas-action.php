<?php
session_start();
error_reporting(0);
 include('includes/config.php');
 $msg=''; $error='';
if(strlen($_SESSION['alogin'])==0) {
    $path = ($setcoach) ? '/coach' : 'index';

    if (headers_sent()) 
        die("<div style='background-image: url(img/resized.jpg);  opacity: 0.8;'>A Sessão Expirou! Por favor, clique neste link para se logar: <a href='{$path}'> Admin</a> </div>");
    else
        exit(header("Location: index"));
}else{
if(isset($_GET['edit']))
    $editid=$_GET['edit'];
    
    if(isset($_POST['submit'])){
        
        $question      =$_POST['question'];
        $ans1           =$_POST['ans1'];
        $ans2           =$_POST['ans2'];
        $ans3           =$_POST['ans3'];
        $ans4           =$_POST['ans4'];
        $status         =$_POST['status'];
        $qno            =$_POST['qno'];

        if ($_SESSION['tipo_user'] == 'coach'){
              $coach_id  =$_SESSION['coach_id'];
            }else {
              $coach_id  =$_POST['coach_id'];
            }
             
     $sql="INSERT INTO questions (qno    ,question    ,ans1      ,ans2,     ans3,     ans4 ,    coach_id,    status )  
                     VALUES ( {$qno}  , '{$question}', '{$ans1}', '{$ans2}', '{$ans3}' ,'{$ans4}',{$coach_id}  , '{$status}' )";
        $query = $dbh->prepare($sql);
        if ($query->execute()) 
            $msg = "Pergunta Cadastrada com Sucesso! :) ";
        else
            $error="Erro ao Adicionar! :(";
}

        $sql  = "SELECT COUNT(qno)  FROM  questions WHERE status=1 and coach_id =".$_SESSION['coach_id'] ;
        $query = $dbh->prepare($sql);
        $query->execute(); 
        $ordem = $query->fetchColumn();
     
 ?>

<!doctype html>
<html lang="pt" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">
    <title>Cadastro Coach</title>
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
        padding: 10px;margin: 0 0 20px 0;background: #dd3d36;color:#fff;-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    }
    .succWrap{ 
        padding: 10px;margin: 0 0 20px 0;background: #5cb85c;color:#fff;-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
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
                        <h3 class="page-title">Cadastro Perguntas : <?php //echo htmlentities($result->name); ?></h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Cadastro Perguntas (Infomações com asterisco são Obrigatórias!)</div>
             <?php if($error){ ?>
                <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); echo $sql; ?>
                 </div>
            <?php  } else if($msg){?>
                <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> 
                </div>
            <?php }?>
<div class="panel-body">
    <form method="post" action="add-perguntas-action" class="form-horizontal"  name="imgform">
    <div class="form-group">
        <label class="col-sm-2 control-label">Pergunta<span style="color:red">*</span></label>
        <div class="col-sm-10">
             <input type="text" name="question" class="form-control" required >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"> C) Opção  <span style="color:red">*</span></label>
        <div class="col-sm-10">
             <input type="text" name="ans1" class="form-control" required >
        </div>
    </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"> I) Opção  <span style="color:red">*</span></label>
        <div class="col-sm-10">
             <input type="text" name="ans2" class="form-control" required >
        </div>
    </div>
        
    <div class="form-group">
        <label class="col-sm-2 control-label">A) Opção  <span style="color:red">*</span></label>
        <div class="col-sm-10">
             <input type="text" name="ans3" class="form-control" required >
        </div>
    </div>
       <div class="form-group">
        <label class="col-sm-2 control-label">O) Opção  <span style="color:red">*</span></label>
        <div class="col-sm-10">
             <input type="text" name="ans4" class="form-control" required >
        </div>
    </div>

  <div class="form-group"> 
        <label class="col-sm-2 control-label">Status</label>
        <div class="col-sm-10">
            <select name="status" class="form-control" required>
                <option value="">Select</option>
                <option value="1">Ativo</option>
                <option value="0">inativo</option>
            </select>
        </div>
    </div>
      <div class="form-group"> 
        <label class="col-sm-2 control-label">Ordem</label>
        <div class="col-sm-10">
            <?php      if ($_SESSION['tipo_user'] == 'coach'){  ?>
             <input type="text" name="qno" class="form-control" placeholder="valor sugerido : <?=($ordem) ? $ordem+1 : '1' ?>" required >
         <?php }else{  ?>
             <input type="text" name="qno" class="form-control" placeholder="Ordem Sequencial" required >
         <?php }  ?>
        </div>
    </div>
    <?php   if ($_SESSION['tipo_user'] == 'admin'){  ?>
      <div class="form-group"> 
        <label class="col-sm-2 control-label">Coach</label>
        <div class="col-sm-10">
           <select name="coach_id" class="form-control" required>
                <option value="">Select</option>
                <?php 
                       $sql = "SELECT * FROM coach";
                        $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                    
                        if($query->rowCount() > 0){
                            foreach($results as $row){     
                    ?>
                    <option  value="<?=$row->id ?>"><?= ucfirst(str_replace("_"," ", $row->nome))?></option>
                        <?php } ?>
                <?php } ?>
            </select>
        </div>
    </div>
<?php }  ?>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
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
     <!-- Loading Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/fileinput.js"></script>
    <script src="js/chartData.js"></script>
    <script src="js/main.js"></script>
 
    <script type="text/javascript">
                 $(document).ready(function () {          
                
                     setTimeout(function() {
                        $('.succWrap').slideUp("show");
                    }, 3000);
                    <?php if($msg) { ?>
                        setTimeout(function() {
                           window.location.href = "perguntas"
                    }, 4800);
                    <?php } ?>
                     });
</script>
  
</body>
</html>
<?php } ?>
