<?php $baseurl= $_SERVER["SERVER_NAME"]; ?> 
	<nav class="ts-sidebar" style="
    background: url('http://<?=$baseurl?>/quiz-disc/admin/css/bg_indigo.59fa2f195ab873b8acfb030661aae6fb.svg') 50% no-repeat;
    background-size: cover;">
			<ul class="ts-sidebar-menu">
				<li class="ts-label">Main</li>
				<li>
					<a href="dashboard" title="Usuário : <?=$_SESSION['nome']?>" ><i class="fa fa-dashboard"></i> Dashboard <?=( $_SESSION['tipo_user'] == 'admin' ) ? ' - Admin' : '- Coach' ;?></a></li>
				<li>
					<a href="userlist"><i class="fa fa-users"></i> Lista de Usuário</a>
				</li>
				<li>
					<a href="profile"><i class="fa fa-user"></i> &nbsp;Perfil</a>
				</li>
				<li>
					<a href="notification"><i class="fa fa-bell"></i> &nbsp;Notificações <sup style="color:red">*</sup></a>
				</li>
				<?php if ($_SESSION['tipo_user'] == 'admin'){  ?>
				<li>
					<a href="addcoach"><i class="fa fa-user-times"></i> &nbsp;Gerenciar Coach</a>
				</li>
				<?php } ?>
				<li>
					<a href="perguntas"><i class="fa fa-download"></i> &nbsp;Gerenciar Perguntas</a>
				</li>
			</ul>
			<p class="text-center" style="color:#ffffff; margin-top: 100px;">© Questionário DISC</p>

		</nav>


		
