<?php
    session_start();
    $publicPages = array('homepage', 'sLogin','cLogin', 'logout', 'cRegistarUtentes', 'sRegistarUtentes');
    
    if(isset($_GET['op'])){
    	switch ($_GET['op']){
           case 'cLogin':
           	 	
            	//Autentica o utilizador
    		    $connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));
    		    $sql = 'SELECT * FROM UTILIZADORES WHERE (USERNAME = "'. $_POST['user'] .'" AND PASSWORD = "'. md5($_POST['pass']) .'") ';
    		    $result = mysqli_query( $connect, $sql) or die( 'The query has failed: ' . mysqli_error($connect));
    		    $number = mysqli_num_rows($result); 
    			if ($number==1){
                	$_SESSION['authuser'] = 1;
                    $_SESSION['username'] = $_POST['user'];
                    $dadosUser = mysqli_fetch_array($result);
                    $_SESSION['tipo']= $dadosUser['TIPO'];
                    $_SESSION['ID'] = $dadosUser['ID'];
                    if($_SESSION['tipo']==1){
                    $sql_idUtente = 'SELECT * FROM UTENTES WHERE (ID_UTILIZADOR = "'.$dadosUser['ID'].'") ';
    		    	$result_idUtente = mysqli_query( $connect, $sql_idUtente) or die( 'The query has failed: ' . mysqli_error($connect));
    		    	$id_row=mysqli_fetch_array($result_idUtente);
    		    	$_SESSION['id_utente'] = $id_row['ID'];
    		    	    		    	}

            	}
            	else {
            		$_SESSION['authuser'] = 0;
            	}

         		break;
         

           case 'logout':
           	    //elimina variaveis de sessao e redireciona para a pagina principal
				session_unset();
    			header("Location: index.php");
				break;

            default: 
                break;
        }
    	if(!in_array($_GET['op'], $publicPages) AND $_SESSION['authuser'] == 0){
    	//se a pagina em que o user nao utenticado estiver a tentar entrar for privada, redireciona-o para a pagina de login
			header("Location: index.php?op=sLogin");
    	}               
    }
?>

<html>
	<head>
		<title>  COVIDSYM - FCT   </title>
		<meta name = "Author" content = "Maria Ines Ribeiro e Ricardo Marques">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<style>
			.w3-theme-l5 {color:#003E63 !important; background-color:#e9f5ff !important}
			.w3-theme-l4 {color:#003E63 !important; background-color:#b6ddff !important}
			.w3-theme-l3 {color:#000 !important; background-color:#6cbaff !important}
			.w3-theme-l2 {color:#fff !important; background-color:#2398ff !important}
			.w3-theme-l1 {color:#012136 !important; background-color:#01B9D5 !important}
			.w3-theme-d1 {color:#fff !important; background-color:#004581 !important}
			.w3-theme-d2 {color:#fff !important; background-color:#003d72 !important}
			.w3-theme-d3 {color:#fff !important; background-color:#003E63 !important}
			.w3-theme-d4 {color:#fff !important; background-color:#002e56 !important}
			.w3-theme-d5 {color:#01B9D5 !important; background-color:#012136 !important}

			.w3-theme-light {color:#000 !important; background-color:#e9f5ff !important}
			.w3-theme-dark {color:#fff !important; background-color:#002647 !important}
			.w3-theme-action {color:#fff !important; background-color:#002647 !important}

			.w3-theme {color:#fff !important; background-color:#004b8d !important}
			.w3-text-theme {color:#003E63 !important}
			.w3-border-theme {border-color:#004b8d !important}

			.w3-hover-theme:hover {color:#012136 !important; background-color:#01B9D5 !important}
			.w3-hover-text-theme:hover {color:#004b8d !important}
			.w3-hover-border-theme:hover {border-color:#004b8d !important}		
			
			body, h1, h2, h3, h4, h5, h6 {
  					font-family: Verdana, Arial, sans-serif;
			}
			
			/* Float 3 columns side by side */
			.column {
  				float: left;
  				width: 33%;
  				padding: 2% 2%;
			}

			/* Remove extra left and right margins, due to padding in columns */
			.row {
			margin: 0 -5px;
			
			}

			/* Clear floats after the columns */
			.row:after {
  				content: "";
 				display: table;
  				clear: both;
  				padding:0px 0px 1.5%;
			}

			/* Style the counter cards */
			.card {
  				box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); /* this adds the "card" effect */
  				padding: 1px;
  				text-align: center;
  				background-color: #f1f1f1;
  			}
		</style>
 	</head>
 	
	<body>
		<!--****************************************************************************************************************************-->		
		<!-- BARRA DE NAVEGACAO -->
		
		<!--sempre presente-->
		<header class="w3-bar w3-small w3-theme-d5">
		        <a href="index.php?operation=homepage" class="w3-bar-item w3-hover-theme w3-button"><h4><i style='color:#01B9D5'class='fas fa-hand-holding-medical'></i>&nbsp;<strong>CovidSym</strong></h4></a>
			
		<!--variavel com login-->
		<?php
			if(isset($_SESSION['authuser'])){
				switch($_SESSION['authuser']){
					case 0:
					//user nao autenticado
						echo "<a href='index.php?op=sLogin' class='w3-bar-item w3-button  w3-hover-theme'><h4>Login</h4></a>";
						echo "<a href='index.php?op=sRegistarUtentes' class='w3-bar-item w3-button  w3-hover-theme'><h4>Registar</h4></a>";
						break;
					case 1: 
					//user autenticado
						switch($_SESSION['tipo']){
							case 1: //utente
								echo "<a href='index.php?op=logout' class='w3-bar-item w3-hover-theme w3-button'><h4> Logout</h4> </a>";
								echo "<a href='index.php?op=sMedico' class='w3-bar-item w3-hover-theme w3-button'><h4> Marcar Consulta</h4> </a>";
								echo "<a href='index.php?op=pUtente' class='w3-bar-item w3-hover-theme w3-button'><h4>Editar Perfil</h4> </a>";
								echo "<a href='index.php?op=aPass' class='w3-bar-item w3-hover-theme w3-button'><h4>Editar dados de sessao</h4> </a>";

								break;
							case 2: //MÃ©dico
								echo "<a href='index.php?op=logout' class='w3-bar-item w3-hover-theme w3-button'><h4> Logout</h4> </a>";
								echo "<a href='index.php?op=cPedidos' class='w3-bar-item w3-hover-theme w3-button'><h4> Consultar Pedidos</h4> </a>";
								echo "<a href='index.php?op=pMedico' class='w3-bar-item w3-hover-theme w3-button'><h4> Editar Perfil</h4> </a>";
								echo "<a href='index.php?op=lFichasClinicas' class='w3-bar-item w3-hover-theme w3-button'><h4> Consultar Fichas Cl&iacute;­nicas </h4></a>";
								echo "<a href='index.php?op=aPass' class='w3-bar-item w3-hover-theme w3-button'><h4>Editar dados de sessao</h4> </a>";

								break;
							case 3: //Administrador
								echo "<a href='index.php?op=logout' class='w3-bar-item w3-hover-theme w3-button'><h4> Logout</h4> </a>";
								echo "<a href='index.php?op=sRegistarUtilizadores' class='w3-bar-item w3-hover-theme w3-button'><h4> Registar Utilizadores</h4> </a>";
								echo "<div class='w3-dropdown-hover'><button class='w3-button w3-hover-theme'><h4> Gest&atilde;o de Utilizadores</h4></button>";
									echo "<div class='w3-dropdown-content w3-bar-block w3-card-4'>";
									echo "<a href='index.php?op=lUsersAdmin' class='w3-bar-item w3-hover-theme w3-button'>Administradores</a>";
									echo "<a href='index.php?op=lUsersInvest' class='w3-bar-item w3-hover-theme w3-button'>Investigadores</a>";
									echo "<a href='index.php?op=lUsersMedicos' class='w3-bar-item w3-hover-theme w3-button'>M&eacute;dicos</a>";
									echo "<a href='index.php?op=lUsersUtente' class='w3-bar-item w3-hover-theme w3-button'>Utentes</a>";
								echo "</div></div>";
								echo "<a href='index.php?op=pAdmin' class='w3-bar-item w3-hover-theme w3-button'><h4> Editar Perfil</h4> </a>";
								echo "<a href='index.php?op=aPass' class='w3-bar-item w3-hover-theme w3-button'><h4>Editar dados de sessao</h4> </a>";
								
								break;
							case 4: //Investigador
								echo "<a href='index.php?op=logout' class='w3-bar-item w3-hover-theme w3-button'><h4> Logout</h4> </a>";
								echo "<a href='index.php?op=pInvest' class='w3-bar-item w3-hover-theme w3-button'><h4> Editar Perfil</h4> </a>";
								echo "<a href='index.php?op=aPass' class='w3-bar-item w3-hover-theme w3-button'><h4>Editar dados de sessao</h4> </a>";
								break;
							default:
								break;
						}
						break;
						
					default: 
						break;
				}
			}
			else{
			//user nao autenticado
					echo "<a href='index.php?op=sLogin' class='w3-bar-item w3-button w3-hover-theme'><h4>Login</h4></a>";
					echo "<a href='index.php?op=sRegistarUtentes' class='w3-bar-item w3-button  w3-hover-theme'><h4>Registar</h4></a>";
			}
		?>
		
		</header>	
		
	
		<!--****************************************************************************************************************************-->			
		<!-- CONTEUDO DE CORPO VARIAVEL -->
		<div class="w3-display-container w3-content" style="max-width:100%;">
  			<img class="w3-image" src="background-cut2.png" alt="CovidBackgroud" style="width:100%">
			
						<?php
						if (isset($_GET['op'])==0){
							include("homepage.php");
						}
						else{
							switch ($_GET['op']){
								case 'homepage':
									include('homepage.php');
									break;
								case 'sLogin':
									include('showLogin.php');
									break;
								case 'users':
									include('showUsers.php');
								    break;
								case 'sRegistarUtentes':
								    include('showRegistarUtentes.php');
								    break;
								case 'cLogin':
									include('checkLogin.php');
									break;
								case 'cRegistarUtentes':
									include('checkRegistarUtentes.php');
									break;
								case 'sRegistarUtilizadores':
									include('showRegistarUtilizadores.php');
									break;
								case 'sRegistarAdministradores':
									include('showRegistarAdministradores.php');
									break;
								case 'cRegistarAdministradores':
									include('checkRegistarAdministradores.php');
									break;
								case 'sRegistarMedicos':
									include('showRegistarMedicos.php');
									break;
								case 'cRegistarMedicos':
									include('checkRegistarMedicos.php');
									break;
								case 'sRegistarInvestigadores':
									include('showRegistarInvestigadores.php');
									break;
								case 'cRegistarInvestigadores':
									include('checkRegistarInvestigadores.php');
									break;
								case 'sMedico':
									include('selectMedico.php');
									break;
								case 'lEspera':
									include('listaEspera.php');
									break;
								case 'cFicha':
									include('checkFicha.php');
									break;
								case 'sFichaClinica':
									include('showFichaClinica.php');
									break;
								case 'cFichaClinica':
									include('checkFichaClinica.php');
									break;
								case 'cPedidos':
									include('checkPedidos.php');
									break;
								case 'lUsersAdmin':
									include('listUsersAdmin.php');
									break;
								case 'aAdmin':
									include('alterarAdmin.php');
									break;
								case 'cNewUsername':
									include('checkNewUsername.php');
									break;
								case 'cAlterarStaff':
									include('checkAlterarStaff.php');
									break;
								case 'lUsersInvest':
									include('listUsersInvest.php');
									break;
								case 'aInvest':
									include('alterarInvest.php');
									break;
								case 'lUsersMedicos':
									include('listUsersMedicos.php');
									break;
								case 'aMedico':
									include('alterarMedicos.php');
									break;
								case 'vMedico':
									include('verMedico.php');
									break;
								case 'vAdmin':
									include('verAdmin.php');
									break;
								case 'vInvest':
									include('verInvest.php');
									break;
								case 'pMedico':
									include('prefilMedico.php');
									break;
								case 'pAdmin':
									include('perfilAdmin.php');
									break;
								case 'pInvest':
									include('perfilInvest.php');
									break;
								case 'pUtente':
									include('perfilUtente.php');
									break;
								case 'cAlterarUtente':
									include('checkAlterarUtente.php');
									break;
								case 'aPass':
									include('alterarPass.php');
									break;
								case 'cPass':
									include('checkPass.php');
									break;
								case 'lUsersUtente':
									include('listUsersUtente.php');
									break;
								case 'vUtente':
									include('verUtente.php');
									break;
								case 'aUtente':
									include('alterarUtente.php');
									break;
								case 'lFichasClinicas':
									include('listFichasClinicas.php');
									break;
								case 'cDiagnostico':
									include('checkDiagnostico.php');
									break;
								case 'vFichaClinica':
									include('verFichaClinica.php');
									break;
								case 'cActivar':
									include('checkActivar.php');
									break;
								default:
									include('homepage.php');
									break;
								}
						}	
					?>
			
		</div>
		
		<!-- RODAPE -->
		<footer class="w3-container w3-theme-d5">
			  <h5 align="left">  <strong>Contactos</strong></h5>
			  <div class="w3-medium w3-padding-10">
    		  <h6 align = "left"> <i class ="fa fa-phone w3-hover-opacity"></i> 212 300 300 </h6>
   			  <h6 align="left">  <i class="fa fa-at w3-hover-opacity"></i> Fax: (+351) 212 300 301 </h6><br>
  			  </div>
  		</footer>



	</body>
</html>

