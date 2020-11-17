<?php
session_start();
//error_reporting(0);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include('includes/config.php');
 $msg=''; $error='';
if(strlen($_SESSION['alogin'])==0) {
        $setcoach = isset( $_COOKIE['coach'] );
     $path = ($setcoach) ? '/coach' : 'index';

    if (headers_sent()) 
         echo "<script type='text/javascript'> document.location = 'index'; </script>";
    else
        exit(header("Location: index"));
}else{

if(isset($_GET['edit']))
  $editid=$_GET['edit'];
    
if(isset($_POST['submit']))
  {
    $file = $_FILES['image']['name'];
    $file_loc = $_FILES['image']['tmp_name'];
    $folder="img/";
    $new_file_name = strtolower($file);
    $final_file=str_replace(' ','-',$new_file_name);
    
    $name           =$_POST['nome'];
    $email          =$_POST['email'];
    $cpf            =$_POST['cpf'];
    $empresa        =$_POST['empresa'];
    $bairro         =$_POST['bairro'];
    $rg             =$_POST['rg'];
    $Escolaridade   =$_POST['escolaridade'];
    $Rede_Social1   =$_POST['redesocial1'];
    $Rede_Social2   =$_POST['redesocial2'];
    $Logradouro     =$_POST['logradouro'];
    $Tipo_Endereco  =$_POST['tipo_endereco'];
    $Complemento    =$_POST['complemento'];
    $telefone       =$_POST['telefone'];
    $cep            =$_POST['cep'];
    $Cidade         =$_POST['cidade'];
    $UF             =$_POST['estado'];
    $gender         =$_POST['gender'];    
    $senha          = $_POST['password'];    
    $senhare        = $_POST['re_password'];    
    $imagem         =$new_file_name;

    if ($senha == $senhare) {
        $senhamd5 = md5($senha);
    }else{
        $error= "verifique as Senhas! Elas devem ser Iguais..  ";
    }

    if(move_uploaded_file($file_loc,$folder.$final_file))       
       $image=$final_file;

   if ($error =='') {
            $sql="INSERT INTO coach (nome      ,email ,  cpf,    nome_empresa,   rg  ,telefone        ,escolaridade,      redes_sociais ,     redes_sociais2 , logradouro, bairro   , tipo_endereco,     complemento,       cep,     municipio,   uf,      genero,    password,   imagem) 
               VALUES ( '{$name}', '{$email}', '{$cpf}', '{$empresa}', {$rg}, '{$telefone}' ,'{$Escolaridade}','{$Rede_Social1}' , '{$Rede_Social2}' , '{$Logradouro}','{$bairro}','{$Tipo_Endereco}' ,'{$Complemento}' ,'{$cep}' ,'{$Cidade}','{$UF}', '{$gender}' ,'{$senhamd5}' ,'{$imagem}')";
    $query = $dbh->prepare($sql);
    $query->execute() or die($sql);
    $msg=" muito bem..Cadastro realizado!"; 
    }     

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
                        <h3 class="page-title">Cadastro Coach :</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Cadastro Dados (Infomações com asterisco são Obrigatórias)</div>
               <?php if($error){
                ?><div class="errorWrap"><strong> ERRO : </strong>:<?php echo htmlentities($error); ?> </div>
                    <?php } 
                else if($msg){
                    ?><div class="succWrap"><strong> SUCCESS : </strong>:<?php echo htmlentities($msg); ?> </div>
                <?php }?>
<div class="panel-body">
<form method="post" action="add-coach-action" class="form-horizontal" enctype="multipart/form-data" name="imgform">
    <div class="form-group">
        <label class="col-sm-2 control-label">Nome<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="nome" value="<?= (isset($name) && $error!='') ? $name : '' ?>" class="form-control" required >
        </div>
        <label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="email" value="<?= (isset($email) && $error!='') ? $email : '' ?>" class="form-control" required >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Empresa<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="empresa" value="<?= (isset($empresa) && $error!='') ? $empresa : '' ?>" class="form-control" required  >
        </div>
        <label class="col-sm-2 control-label">CPF<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="cpf" value="<?= (isset($cpf) && $error!='') ? $cpf : '' ?>" class="form-control" required >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">RG<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="rg" value="<?= (isset($rg) && $error!='') ? $rg : '' ?>" class="form-control" required >
        </div>
        <label class="col-sm-2 control-label">Telefone<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="telefone" value="<?= (isset($telefone) && $error!='') ? $telefone : '' ?>" class="form-control" required  >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Escolaridade<span style="color:red">*</span></label>
        <div class="col-sm-4">
            <select name="escolaridade" class="form-control" required>
                <option value="">Selecione</option>
                <?php 
                $escolaridadeArr = array('fundamental_incompleto' , 'fundamental','ensino_medio','ensino_superior','especialização','mestrado','pos_mestrado','doutorado');
                foreach ($escolaridadeArr as $key => $value) { ?>
                    <option  <?=($value== @$Escolaridade) ? 'selected=selected' : '' ?> value="<?=$value?>"><?= ucfirst(str_replace("_"," ", $value))?></option>
                <?php } ?>
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
            <input type="text" name="logradouro" value="<?= (isset($Logradouro) && $error!='') ? $Logradouro : '' ?>" class="form-control" required  >
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
             <input type="text" name="complemento" value="<?= (isset($Complemento) && $error!='') ? $Complemento : '' ?>" class="form-control" required>
        </div>
        <label class="col-sm-2 control-label">Bairro<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="bairro" value="<?= (isset($bairro) && $error!='') ? $bairro : '' ?>" class="form-control" required >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Cep<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="cep" value="<?= (isset($cep) && $error!='') ? $cep : '' ?>" class="form-control" required>
        </div>
        <label class="col-sm-2 control-label">Cidade<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="cidade" value="<?= (isset($Cidade) && $error!='') ? $Cidade : '' ?>" class="form-control" required >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Uf<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="estado" value="<?= (isset($UF) && $error!='') ? $UF : '' ?>" class="form-control" required>
        </div>

            <label class="col-sm-2 control-label">Imagem </label>
        <div class="col-sm-4">
            <input type="file" id="image" name="image" accept="image/*">
        </div>
      
    </div>

    <div class="form-group">
           <label class="col-sm-2 control-label">Rede Social (1)<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="redesocial1" value="<?= (isset($Rede_Social1) && $error!='') ? $Rede_Social1 : '' ?>" class="form-control" required  >
        </div>
   <label class="col-sm-2 control-label">Rede Social (2)</label>
        <div class="col-sm-4">
                <input type="text" name="redesocial2" value="<?= (isset($Rede_Social2) && $error!='') ? $Rede_Social2 : '' ?>" class="form-control"  >
        </div>
    
    </div>

    <div class="form-group">
         <label class="col-sm-2 control-label">Senha<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input class="form-control square" name="password" type="password">
        </div>
   <label class="col-sm-2 control-label">Confirmar senha<span style="color:red">*</span></label>
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
