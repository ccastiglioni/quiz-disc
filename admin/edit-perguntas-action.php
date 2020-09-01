<?php
session_start();
include('includes/config.php');
 $msg=''; $error='';
if(empty(($_SESSION['alogin']))) {
    $setcoach = isset( $_COOKIE['coach'] );
    $path = ($setcoach) ? '/coach' : 'index';

    if (headers_sent()) 
        echo "<script type='text/javascript'> document.location = 'index'; </script>";
    else
        exit(header("Location: index"));
}else{
    if(isset($_REQUEST['edit'])){
        $editid = $_REQUEST['edit'];
        $label  = 'Edição';
     }else{
        $label = 'Cadastro';
     }
    if(isset($_POST['submit'])){
        
        $question       =$_POST['question'];
        $ans1           =$_POST['ans1'];
        $ans2           =$_POST['ans2'];
        $ans3           =$_POST['ans3'];
        $ans4           =$_POST['ans4'];
        $coach_id       =$_SESSION['coach_id'];
        $status         =$_POST['status'];
        $qno            =$_POST['qno'];

    if ($_SESSION['tipo_user'] == 'coach'){
       $sql="UPDATE questions SET question=(:question),  ans1=(:ans1),ans2=(:ans2),  ans3=(:ans3),ans4=(:ans4), status=(:status), qno=(:qno),
        coach_id=(:coach_id)  WHERE qid=(:editid)";
    }else{
       $sql="UPDATE questions SET question=(:question),  ans1=(:ans1),ans2=(:ans2),  ans3=(:ans3),ans4=(:ans4), status=(:status), qno=(:qno)  WHERE qid=(:editid)";
    }

    $query = $dbh->prepare($sql);
    $query-> bindParam(':question', $question, PDO::PARAM_STR);
    $query-> bindParam(':ans1', $ans1, PDO::PARAM_STR);
    $query-> bindParam(':ans2', $ans2, PDO::PARAM_STR);
    $query-> bindParam(':ans3', $ans3, PDO::PARAM_STR);
    $query-> bindParam(':ans4', $ans4, PDO::PARAM_STR);
    $query-> bindParam(':status', $status, PDO::PARAM_INT);

    if ($_SESSION['tipo_user'] == 'coach'){
        $query-> bindParam(':coach_id', $coach_id, PDO::PARAM_INT);
     }
    $query-> bindParam(':qno', $qno, PDO::PARAM_INT);
    $query-> bindParam(':editid', $editid, PDO::PARAM_STR);  
    $query->execute();
/*    echo "<pre>";
    $query->debugDumpParams();*/
    
        if ($query->execute()) 
            $msg = "..Pergunta Editada com Sucesso!! ";
        else
            $error="Ops deu erro  :(".var_dump( $dbh->errorInfo());
}
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
                        <h3 class="page-title"><?=$label?> Perguntas : </h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                <div class="panel-heading"><?=$label?> Perguntas (Infomações com asterisco são Obrigatórias!)</div>
             <?php if($error){ ?>
                <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); echo $sql; ?>
                 </div>
            <?php  } else if($msg){?>
                <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> 
                </div>
            <?php } 
            
        $sql = "SELECT * from questions where qid = :editid";
        $query = $dbh -> prepare($sql);
        $query->bindParam(':editid',$editid,PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
 
?>
<div class="panel-body">
    <form method="post" action="edit-perguntas-action" id="edit-perguntas" class="form-horizontal"  name="imgform">
        <input type="hidden" value="<?=$editid?>" name="edit">
    <div class="form-group">
        <label class="col-sm-2 control-label">Pergunta <span style="color:red">*</span></label>
        <div class="col-sm-10">
             <input type="text" name="question" class="form-control"  value="<?=(isset($result->question)) ? $result->question : '' ;?>" required >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"> C) Opção  <span style="color:red">*</span></label>
        <div class="col-sm-10">
             <input type="text" name="ans1" value="<?=(isset($result->ans1)) ? $result->ans1 : '' ;?>" class="form-control" required >
        </div>
    </div>

      <div class="form-group">
        <label class="col-sm-2 control-label"> I) Opção  <span style="color:red">*</span></label>
        <div class="col-sm-10">
             <input type="text" name="ans2" value="<?=(isset($result->ans2)) ? $result->ans2 : '' ;?>" class="form-control" required >
        </div>
    </div>
        
    <div class="form-group">
        <label class="col-sm-2 control-label">A) Opção  <span style="color:red">*</span></label>
        <div class="col-sm-10">
             <input type="text" name="ans3" value="<?=(isset($result->ans3)) ? $result->ans3 : '' ;?>" class="form-control" required >
        </div>
    </div>
       <div class="form-group">
        <label class="col-sm-2 control-label">O) Opção  <span style="color:red">*</span></label>
        <div class="col-sm-10">
             <input type="text" name="ans4" value="<?=(isset($result->ans4)) ? $result->ans4 : '' ;?>" class="form-control" required >
        </div>
    </div>

  <div class="form-group"> 
        <label class="col-sm-2 control-label">Status</label>
        <div class="col-sm-10">
            <select name="status"  class="form-control" required>
                <option value="">Select</option>
            <?php 
                $Status_Arr = array('inativo','Ativo');
                foreach ($Status_Arr as $key => $value) { ?>
                <option <?=($key == @$result->status) ? 'selected=selected' : '' ?> value="<?=$key?>"><?= ucfirst($value)?></option>
                <?php } ?>
            </select>
                 
        </div>
    </div>
      <div class="form-group"> 
        <label class="col-sm-2 control-label">Ordem</label>
        <div class="col-sm-10">
             <input type="text" name="qno" value="<?=(isset($result->qno)) ? $result->qno : '' ;?>"class="form-control"  required >
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
            <button class="btn btn-primary" name="submit" id="editperguntas" type="submit">Salvar</button>
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
