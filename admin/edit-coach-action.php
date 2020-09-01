<?php
session_start();
error_reporting(0); 

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

if(isset($_REQUEST['edit']))
  $editid = $_REQUEST['edit'];
    
if(isset($_POST['submit'])){
    $file = $_FILES['image']['name'];
    $file_loc = $_FILES['image']['tmp_name'];
    $folder="img/";
    $new_file_name = strtolower($file);
    $final_file=str_replace(' ','-',$new_file_name);
    
    $name           =$_POST['nome'];
    $email          =$_POST['email'];
    $cpf            =$_POST['cpf'];
    $empresa        =$_POST['empresa'];
    $rg             =$_POST['rg'];
    $Escolaridade   =$_POST['escolaridade'];
    $Rede_Social1   =$_POST['redesocial1'];
    $Rede_Social2   =$_POST['redesocial2'];
    $logradouro     =$_POST['logradouro'];
    $bairro         =$_POST['bairro'];
    $Tipo_Endereco  =$_POST['tipo_endereco'];
    $Complemento    =$_POST['complemento'];
    $telefone       =$_POST['telefone'];
    $cep            =$_POST['cep'];
    $Cidade         =$_POST['cidade'];
    $UF             =$_POST['estado'];
    $genero         =$_POST['gender'];    
    $senha          =$_POST['password'];    
    $senhare        = $_POST['re_password'];    

    if(move_uploaded_file($file_loc,$folder.$final_file))   
       $imagem=$final_file;
 

   if ($senha == $senhare) {
        $senhamd5 = md5($senha);
    }else{
        $error= "verifique as Senhas! Elas devem ser Iguais..  ";
    }
        

   if ($error =='') {
      $sql="UPDATE coach SET nome= '{$name}', email='{$email}', cpf='{$cpf }', nome_empresa='{$empresa}',
       rg='{$rg}', Escolaridade='{$Escolaridade}', redes_sociais='{$Rede_Social1 }',
       redes_sociais2='{$Rede_Social2}',logradouro='{$logradouro}',bairro='{$bairro}',Tipo_Endereco='{$Tipo_Endereco}'
       ,Complemento='{$Complemento}' , telefone='{$telefone}',cep='{$cep}',municipio='{$Cidade}', password ='{$senhamd5}',uf='{$UF}',
       genero='{$genero}',imagem='{$imagem}' WHERE id= $editid ";

      $query = $dbh->prepare($sql);
      $query->execute() or die($sql);
  }
     
    $msg=" Cadastro Editado com Sucesso!!";
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
                        <h3 class="page-title">Edição Coach :</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Cadastro Dados (Infomações com asterisco são Obrigatórias)</div>
                <?php if($error){?>
                    <div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                else if($msg){?>
                    <div class="succWrap"><strong>SUCCESS </strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<div class="panel-body">

                           <?php 
                            $sql = "SELECT * FROM coach WHERE id =".$editid ;
                            $query = $dbh -> prepare($sql);
                            $query->execute();
                            $row = $query->fetchAll(PDO::FETCH_OBJ);
                        
                            ?>
<form method="post" action="edit-coach-action" class="form-horizontal" enctype="multipart/form-data" name="imgform" >
    <input type="hidden" value="<?=$row[0]->id?>" name="edit">
    <div class="form-group">
        <label class="col-sm-2 control-label">Nome<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="nome" value="<?=$row[0]->nome?>" class="form-control" required >
        </div>
        <label class="col-sm-2 control-label">Email<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="email" name="email" value="<?=$row[0]->email?>" class="form-control" required >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Empresa<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="empresa" value="<?=$row[0]->nome_empresa?>" class="form-control" required  >
        </div>
        <label class="col-sm-2 control-label">CPF<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="cpf" value="<?=$row[0]->cpf?>" class="form-control" required >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">RG<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="rg" value="<?=$row[0]->rg?>" class="form-control" required >
        </div>
        <label class="col-sm-2 control-label">Telefone<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="telefone" value="<?=$row[0]->telefone?>" class="form-control" required  >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Escolaridade<span style="color:red">*</span></label>
        <div class="col-sm-4">
            <select name="escolaridade"  class="form-control" required>
                <option value="">Selecione</option>

                <?php 
                $escolaridadeArr = array('fundamental_incompleto' , 'fundamental','ensino_medio','ensino_superior','especialização','mestrado','pos_mestrado','doutorado');
                foreach ($escolaridadeArr as $key => $value) { ?>
                    <option  <?=($value == $row[0]->escolaridade) ? 'selected=selected' : '' ?> value="<?=$value?>"><?= ucfirst(str_replace("_"," ", $value))?></option>
                <?php } ?>
                  
            </select>
        </div>
        <label class="col-sm-2 control-label">Gênero</label>
        <div class="col-sm-4">
                <select name="gender" class="form-control" required>
                <option value="">Select</option>
                <?php 
                $genero_Arr = array('masculino','feminino');
                foreach ($genero_Arr as $key => $values) { ?>
                    <option  <?=($values == $row[0]->genero) ? 'selected=selected' : '' ?> data="<?=$row[0]->genero ?>" value="<?=$values?>"><?= ucfirst(str_replace("_"," ", $values))?></option>
                <?php } ?>
            </select>
         </div>
    </div>
        
    <div class="form-group">
            <label class="col-sm-2 control-label">Logradouro<span style="color:red">*</span></label>
        <div class="col-sm-4">
            <input type="text" name="logradouro" value="<?=$row[0]->logradouro?>" class="form-control" required  >
        </div>

        <label class="col-sm-2 control-label">Tipo Endereço</label>
        <div class="col-sm-4">
            <select name="tipo_endereco" value="<?=$row[0]->nome?>" class="form-control" required>
                <option value="">Select</option>
                     <?php 
                $end_Arr = array('Residencial','Comercial');
                foreach ($end_Arr  as $key => $value) { ?>
                    <option  <?=($value == $row[0]->tipo_endereco ) ? 'selected=selected' : '' ?> value="<?=$value?>"><?= ucfirst(str_replace("_"," ", $value))?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Complemento<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="complemento" value="<?=$row[0]->complemento?>" class="form-control" required>
        </div>
        <label class="col-sm-2 control-label">Bairro<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="bairro" value="<?=$row[0]->bairro?>" class="form-control" required >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Cep<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="cep" value="<?=$row[0]->cep?>" class="form-control" required>
        </div>
        <label class="col-sm-2 control-label">Cidade<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="cidade" value="<?=$row[0]->municipio?>" class="form-control" required >
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Uf<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input type="text" name="estado" value="<?=$row[0]->uf?>" class="form-control" required>
        </div>

            <label class="col-sm-2 control-label">Imagem <span style="color:red">*</span></label>
        <div class="col-sm-4">
            <input type="file" id="image" name="image" accept="image/*">
        </div>
      
    </div>

    <div class="form-group">
           <label class="col-sm-2 control-label">Rede Social (1)<span style="color:red">*</span></label>
        <div class="col-sm-4">
                <input type="text" name="redesocial1" value="<?=$row[0]->redes_sociais?>" class="form-control" required  >
        </div>
   <label class="col-sm-2 control-label">Rede Social (2)</label>
        <div class="col-sm-4">
                <input type="text" name="redesocial2" value="<?=$row[0]->redes_sociais2?>" class="form-control"  >
        </div>
    
    </div>

    <div class="form-group">
         <label class="col-sm-2 control-label">Senha<span style="color:red">*</span></label>
        <div class="col-sm-4">
             <input class="form-control square" name="password" type="password" required>
        </div>
   <label class="col-sm-2 control-label">Confirmar senha</label>
        <div class="col-sm-4">
                <input  type="number" class="form-control square"  required>
                <input  name="re_password" type="password" value="50" min="50" max="98" area-label="Price from" class="input filter-form-input">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-8 col-sm-offset-2">
            <button class="btn btn-primary" name="submit" id="submit" type="submit">Salvar</button>
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
                           window.location.href = "addcoach"
                    }, 4800);
                    <?php } ?>
                     });
</script>
</body>
</html>
<?php } ?>
