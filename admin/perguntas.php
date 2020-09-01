<?php

session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {   
	$setcoach = isset( $_COOKIE['coach'] );
    $path = ($setcoach) ? '/coach' : 'index';

    if (headers_sent()) 
         echo "<script type='text/javascript'> document.location = 'index'; </script>";
    else
        exit(header("Location: index"));
 }else{
    if(isset($_GET['del'])) {
	   $id = $_GET['del'];

	$sql = "DELETE FROM questions WHERE qid=:id ";
	$query = $dbh->prepare($sql);
	$query -> bindParam(':id',$id, PDO::PARAM_STR);
	$query -> execute();

	$msg="Dados excluídos com sucesso!";
	}

if(isset($_REQUEST['unconfirm'])){
        $aeid      =intval($_GET['unconfirm']);
        $memstatus =1;
        $sql = "UPDATE questions SET status={$memstatus} WHERE  qid={$aeid}";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
        $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
        $query -> execute();
        $msg="Pergunta ativa! :) ";
    }

    if(isset($_REQUEST['confirm'])) {
        $aeid      = intval($_GET['confirm']);
        $memstatus =0;
        $sql = "UPDATE questions SET status= {$memstatus} WHERE  qid={$aeid}";
    
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
        $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
        $query -> execute();
        $msg="Ação realizada com Sucesso!";
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
    <title>Manage Perguntas</title>
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
    padding: 10px;margin: 0 0 20px 0;    background: #dd3d36;color:#fff;-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;margin: 0 0 20px 0;    background: #5cb85c;    color:#fff;-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
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
                      <div class="col-sm-1 col-sm-offset-10">
                         <button class="btn btn-primary" onclick="window.location.href='add-perguntas-action'" name="" type="">Add Pergunta</button>
                      </div>
                        <h2 class="page-title">Gerência de Perguntas</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Lista Perguntas ( Para o Sistema funcinar a Ordem <b>deve ter uma sequencia e não pode conter números repetidos! </b>) </div>
           
                            <div class="panel-body">
                            <?php if($error){ ?>
                            	<div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
                		   else if($msg){ ?>
                		  	<div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div>
                		   <?php } ?>
                                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                             <th>ID</th>
                                            <th>Ordem</th>
                                             <?php 
                                             if ($_SESSION['tipo_user'] == 'admin'){  
                                             ?>
                                            <th>Coach</th>
                                             <?php } ?>
                                            <th>Pergunta</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php 
                                    if ($_SESSION['tipo_user'] == 'admin'){  
                                     $sql = "SELECT q.qid, q.question,c.nome,q.status,q.qno 
                                                   FROM  questions q INNER JOIN coach c ON (q.coach_id = c.id ) ORDER BY c.nome " ;
                                    }else{
                                     $sql = "SELECT * FROM  questions WHERE coach_id =".$_SESSION['coach_id'] ;
                                    }
										
										$query = $dbh->prepare($sql);
										$query->execute();
										$results=$query->fetchAll(PDO::FETCH_OBJ);
										$cnt=1;
										if($query->rowCount() > 0) {
											foreach($results as $result){               
									?>  
                                        <tr>
                                            <td><?php echo htmlentities($result->qid);?></td>
                                            <td><?php echo htmlentities($result->question);?></td>
                                            <td><?php echo htmlentities($result->qno);?></td>
                                            <?php 
                                             if ($_SESSION['tipo_user'] == 'admin'){  
                                             ?>
                                            <td><?php echo htmlentities($result->nome);?></td>
                                             <?php } ?>
                                            <td>
                                            <?php if($result->status == 1)
                                                    {?>
                                                    <a href="perguntas?confirm=<?php echo htmlentities($result->qid);?>" onclick="return confirm('Você realmente deseja desativar essa pergunta?')">Ativo <i class="fa fa-check-circle"></i></a> 
                                                    <?php } else {?>
                                                    <a href="perguntas?unconfirm=<?php echo htmlentities($result->qid);?>" onclick="">Desativado <i class="fa fa-times-circle"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </td> 
                                            <td>
                                            <a href="edit-perguntas-action?edit=<?php echo $result->qid;?>" >&nbsp; <i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                            <a href="perguntas?del=<?php echo $result->qid;?>" onclick="return confirm('Deseja realmente deletar?');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
                                            </td>
                                        </tr>
                                        <?php $cnt=$cnt+1; }} ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
     <?php include('includes/footer.php');?>

        
</body>
</html>
<?php } ?>
