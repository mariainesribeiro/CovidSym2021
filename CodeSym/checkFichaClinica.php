<?php
    $connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));
    //Sintomas
    $tosse =  $_POST['newTosse'];
	$garganta = $_POST['newGarganta'];
	$fraqueza = $_POST['newFraqueza'];
	$sonolencia = $_POST['newSonolencia'];
	$peito = $_POST['newPeito'];
	$apetite = $_POST['newApetite'];
	$olfato = $_POST['newOlfato'];
	$progressao = $_POST['newProgressao'];
	$temp= $_POST['newTemp'];
	//Fatores de Risco
	$renal =  $_POST['newRenal'];
	$pressao = $_POST['newPressao'];
	$avc = $_POST['newAVC'];
	$pulmonares = $_POST['newPulmonares'];
	$pais = $_POST['newPais'];
	$diabetes = $_POST['newDiabetes'];
	$cardiacas = $_POST['newCardiacas'];
	$respiratorios = $_POST['newRespiratorios'];
	
	
	$sql_insert = 'UPDATE FICHAS_CLINICAS SET 
				TEMPERATURA_CORPORAL ='.$temp.
				',TOSSE_SECA ='.$tosse.
				',DOR_GARGANTA='.$garganta.
				',FRAQUEZA='.$fraqueza.
				',PROBLEMAS_RESPIRATORIOS='.$respiratorios.
				',SONOLENCIA='.$sonolencia.
				',DOR_PEITO='.$peito.
				',VIAGEM_PAIS_INFETADO='.$pais.
				',DIABETES='.$diabetes.
				',DOENCAS_CARDIACAS='.$cardiacas.
				',DOENCAS_PULMONARES='.$pulmonares.
				',AVC_IMUNIDADE='.$avc.
				',PROGRESSAO_SINTOMAS='.$progressao.
				',PRESSAO_ALTA='.$pressao.
				',DOENCA_RENAL='.$renal.
				',PERDA_APETITE='.$apetite.
				',PERDA_OLFATO='.$olfato.
				' WHERE ID ='.$_GET['ficha'];
	$result_insert = mysqli_query($connect,$sql_insert) or die('The query failed: ' . mysqli_error($connect));
	
?>
<div class="w3-card-4 w3-container w3-display-topmiddle w3-theme-l5" style="width:70%; height:100%; overflow:scroll;">
	
	<div class="w3-container">
		<h3 style="color:#003E63"><strong>Ficha Cl&iacute;­nica Nr: </strong> <?php echo $_GET['ficha']?></h3>
	</div>

	<h1 style="color:red">Resultado do Classificador</h1>
	
	
	<form name ="registo" method="POST" action="index.php?op=cDiagnostico<?php echo "&ficha=".$_GET['ficha']?>" class="w3-container" >
			

	
			<label class="w3-text-theme" style='font-size:1vw; '><strong>Prescri&ccedil;&atilde;o do teste &agrave;  Covid-19:</strong></label>     		
    		<input class="w3-radio" type="radio" name="newDiag" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newDiag" value="1"> <label>Sim</label>
						<br><br>
			<label class="w3-text-theme"style='font-size:1vw; '><strong>Observa&ccedil;&otilde;es</strong></label><textarea class=" w3-input w3-border-0" name="newObs"></textarea>
			<input class="w3-btn w3-hover-theme w3-theme-d3" style="float:right" type="submit" name="submit" id="submit" value="Registar Consulta">

	</form>
</div>
				
