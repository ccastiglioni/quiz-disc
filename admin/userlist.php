<?php
session_start();
error_reporting(0);
$error =''; $msg ='';

include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	    
    $setcoach = isset( $_COOKIE['coach'] );
    $path = ($setcoach) ? '/coach' : 'index';

    if (headers_sent()) 
        echo "<script type='text/javascript'> document.location = '{$path}'; </script>";
    else
        exit(header("Location: {$path}"));
}else{
if(isset($_GET['del']) && isset($_GET['name']))
{
$id=$_GET['del'];
$name=$_GET['name'];

$sql = "DELETE FROM users WHERE id=:id";
$query = $dbh->prepare($sql);
$query -> bindParam(':id',$id, PDO::PARAM_STR);
$query -> execute();

$sql2 = "INSERT INTO deleteduser (email,coach_id) values (:name,:coach_id)";
$query2 = $dbh->prepare($sql2);
$query2 -> bindParam(':name',$name, PDO::PARAM_STR);
$query2 -> bindParam(':coach_id',$_SESSION['coach_id'], PDO::PARAM_STR);
$query2 -> execute();

$msg="Usuário deletado!";
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
	<title>Respostas dos Usuário</title>
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
    padding: 10px;margin: 0 0 20px 0;background: #dd3d36;	color:#fff;-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);  box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;margin: 0 0 20px 0;	background: #5cb85c;color:#fff;-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
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
						<h2 class="page-title">Manage Users</h2>
						<div class="panel panel-default">
							<div class="panel-heading">Lista Usuários</div>
							<div class="panel-body">
							<?php if($error){?>
                                <div class="errorWrap" id="msgshow"><?php echo htmlentities($error); ?> </div><?php } 
				                else if($msg){?>
                                    <div class="succWrap" id="msgshow"><?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Score</th>
                                        <th>Data/hora</th>                                                 
                                        <th>Ação</th>                                                 
										</tr>
									</thead>
									<tbody>
                                    <?php
                          			if ($_SESSION['tipo_user'] == 'admin'){  
                                     $sql = "SELECT * from  users " ;
                                    }else{
                                     $sql = "SELECT * from  users where coach_id=".$_SESSION['coach_id'] ;
                                    }
                                    
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                      foreach($results as $result)
                                    {	?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->name);?></td>
                                            <td><?php echo htmlentities($result->email);?></td>
                                             <td><?php echo htmlentities($result->score);?></td>
                                             <td><?php echo htmlentities(date('d/m/Y h:i', strtotime($result->played_on))) ;?> </td>
                                             <td>
										    	<a href="userlist?del=<?php echo $result->id;?>&name=<?php echo htmlentities($result->email);?>" onclick="return confirm('Deseja Realmente delete?');"><i class="fa fa-trash" style="color:red"></i></a>
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
