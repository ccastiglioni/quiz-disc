<?php
session_start();
error_reporting(0);
include('includes/config.php');
if ($_SESSION['admin'] ='admin') { 
if(strlen($_SESSION['alogin'])==0){ 
    $path = ($setcoach) ? '/coach' : 'index';

    if (headers_sent()) 
         echo "<script type='text/javascript'> document.location = 'index'; </script>";
    else
        exit(header("Location: index"));
}else{
if(isset($_GET['del']) && isset($_GET['name'])){
$id=$_GET['del'];
$name=$_GET['name'];

$sql = "delete from coach WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();

$sql2 = "insert into deleteduser (email) values (:name)";
$query2 = $dbh->prepare($sql2);
$query2 -> bindParam(':name',$name, PDO::PARAM_STR);
$query2 -> execute();

$msg="Usuário deletado com Sucesso!";
}

if(isset($_REQUEST['unconfirm']))
    {
        $aeid=intval($_GET['unconfirm']);
        $memstatus=1;
        $sql = "UPDATE coach SET status={$memstatus} WHERE  id={$aeid}";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
        $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
        $query -> execute();
        $msg="Changes Sucessfully";
    }

    if(isset($_REQUEST['confirm']))
    {
        $aeid=intval($_GET['confirm']);
        $memstatus=0;
        $sql = "UPDATE coach SET status= {$memstatus} WHERE  id={$aeid}";
        $query = $dbh->prepare($sql);
        $query -> bindParam(':status',$memstatus, PDO::PARAM_STR);
        $query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
        $query -> execute();
        $msg="Changes Sucessfully";
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
                         <button class="btn btn-primary" onclick="window.location.href='add-coach-action'" name="" type="">Add Coach</button>
                      </div>
                        <h2 class="page-title">Gerência de Coach</h2>
                        <div class="panel panel-default">
                            <div class="panel-heading">Lista Coach</div>
           
                            <div class="panel-body">
                            <?php if($error){?><div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
                                <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                                <th>Image</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>Gênero</th>
                                                <th>Telefone</th>
                                                <th>Data Inserção</th>
                                                <th>Status</th>
                                            <th>Ação</th> 
                                        </tr>
                                    </thead> 
                                    <tbody>
                            <?php 
                            $sql = "SELECT * FROM coach";
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                            $cnt=1;
                            if($query->rowCount() > 0)
                            {
                            foreach($results as $result)
                            {               ?>  
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <?php 
                                                if (empty($result->imagem)) {
                                                  $imgDefault  = ($result->genero == 'masculino') ? '../images/user.png' : '../images/mulher.png' ;
                                                }else{
                                                    $imgDefault = "img/".htmlentities($result->imagem);
                                                }

                                             ?>
                                            <td><img src="<?=$imgDefault;?>" style="width:40px; border-radius:40%;"/></td>
                                            <td><?php echo htmlentities($result->nome);?></td>
                                            <td><?php echo htmlentities($result->email);?></td>
                                            <td><?php echo htmlentities($result->genero);?></td>
                                            <td><?php echo htmlentities($result->telefone);?></td>
                                            <td><?php echo htmlentities($result->created);?> 
                                            <td>
                                            
                                            <?php if($result->status == 1)
                                                    {?>
                                                    <a href="addcoach.php?confirm=<?php echo htmlentities($result->id);?>" onclick="return confirm(' Você realmente deseja cancelar esse Usuário? ')">Ativo <i class="fa fa-check-circle"></i></a> 
                                                    <?php } else {?>
                                                    <a href="addcoach.php?unconfirm=<?php echo htmlentities($result->id);?>" >Desativado <i class="fa fa-times-circle"></i></a>
                                                    <?php } ?>
                                            </td>
                                            </td>
                                            
                                                <td>
                                                <a href="edit-coach-action?edit=<?php echo $result->id;?>" >&nbsp; <i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                                <a href="addcoach?del=<?php echo $result->id;?>&name=<?php echo htmlentities($result->email);?>" onclick="return confirm('Deseja Realmente delete?');"><i class="fa fa-trash" style="color:red"></i></a>&nbsp;&nbsp;
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
<?php }else{
    header('location:index');
} ?>
