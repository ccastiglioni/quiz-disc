<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0) {
    $path = ($setcoach) ? '/coach' : 'index';

    if (headers_sent()) 
                 echo "<script type='text/javascript'> document.location = 'index'; </script>";
    else
        exit(header("Location: index"));
}else{
if(isset($_GET['edit']))
    $editid=$_GET['edit'];
    
    if(isset($_POST['submit'])){
        
        $qno            =$_POST['qno'];
        $questions      =$_POST['questions'];
        $ans1           =$_POST['ans1'];
        $ans2           =$_POST['ans2'];
        $ans3           =$_POST['ans3'];
        $ans4           =$_POST['ans4'];
        $coach_id       =$_POST['coach_id']; /// PEGAR da sessao
        $status         =$_POST['status'];
             
     $sql="INSERT INTO questions (qno    ,questions    ,ans1      ,ans2,     ans3,     ans4 ,    coach_id,    status ) VALUES 
                     VALUES ( '{$qno}', '{$questions}', '{$ans1}', {$ans2}, '{$ans3}'' ,'{$ans4}','{$coach_id}' , '{$status}' )";
        $query = $dbh->prepare($sql);
     
        $query->execute() or die($sql);
        $msg="Information Updated Successfully";
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

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <!-- Admin Stye -->
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
                        <h3 class="page-title">Cadastro Coach : <?php echo htmlentities($result->name); ?></h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Cadastro Dados (Infomações com asterisco são Obrigatórias)</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<div class="panel-body">
<form method="post" action="addcoach-action" class="form-horizontal" enctype="multipart/form-data" name="imgform">
    <div class="form-group">
        <label class="col-sm-2 control-label">Nome<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="nome" class="form-control" required >
        </div>
        <label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="email" class="form-control" required >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Empresa<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="empresa" class="form-control" required  >
        </div>
        <label class="col-sm-2 control-label">CPF<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="cpf" class="form-control" required >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">RG<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="rg" class="form-control" required >
        </div>
        <label class="col-sm-2 control-label">Telefone<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="telefone" class="form-control" required  >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Escolaridade<span style="color:red">*</span></label>
        <div class="col-sm-4">
            <select name="escolaridade" class="form-control" required>
                <option value="">Selecione</option>
                <option value="fundamental_incompleto">Fundamental Incompleto</option>
                <option value="fundamental">Fundamental</option>
                <option value="ensino_medio">Ensino Médio</option>
                <option value="ensino_superior">Ensino Superior</option>
                <option value="especialização">Especialização</option>
                <option value="mestrado">Mestrado</option>
                <option value="pos_mestrado">Comercial</option>
                <option value="doutorado">Doutorado</option>
                 
            </select>
        </div>
        <label class="col-sm-2 control-label">Gênero</label>
        <div class="col-sm-4">
            <select name="gender" class="form-control" required>
                <option value="">Select</option>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
            </select>
         </div>
    </div>
        
    <div class="form-group">
            <label class="col-sm-2 control-label">Logradouro<span style="color:red">*</span></label>
        <div class="col-sm-4">
            <input type="text" name="logradouro" class="form-control" required  >
        </div>

        <label class="col-sm-2 control-label">Tipo Endereço</label>
        <div class="col-sm-4">
            <select name="tipo_endereco" class="form-control" required>
                <option value="">Select</option>
                <option value="Residencial">Residencial</option>
                <option value="Comercial">Comercial</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Complemento<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="complemento" class="form-control" required>
        </div>
        <label class="col-sm-2 control-label">Bairro<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="bairro" class="form-control" required >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Cep<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="cep" class="form-control" required>
        </div>
        <label class="col-sm-2 control-label">Cidade<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="cidade" class="form-control" required >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Uf<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="estado" class="form-control" required>
        </div>

            <label class="col-sm-2 control-label">Imagem <span style="color:red">*</span></label>
        <div class="col-sm-4">
            <input type="file" id="img" name="img" accept="image/*">
        </div>
      
    </div>

    <div class="form-group">
           <label class="col-sm-2 control-label">Rede Social (1)<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="redesocial1" class="form-control" required  >
        </div>
   <label class="col-sm-2 control-label">Rede Social (2)</label>
        <div class="col-sm-4">
                <input type="text" name="redesocial2" class="form-control"  >
        </div>
    
    </div>

    <div class="form-group">
         <label class="col-sm-2 control-label">Senha<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input class="form-control square" name="password" type="password">
        </div>
   <label class="col-sm-2 control-label">Confirmar senha</label>
        <div class="col-sm-4">
                <input class="form-control square" name="re_password" type="password">
        </div>
    
    </div>


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

    <?php include('includes/footer.php');?>
 
</body>
</html>
<?php } ?>
