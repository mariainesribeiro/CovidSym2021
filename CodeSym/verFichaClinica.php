<div class="w3-card-4 w3-container w3-display-topmiddle w3-theme-l5" style="width:70%; height:100%; overflow:scroll;">
	
	<div class="w3-container">
		<h3 style="color:#003E63"><strong>Ficha Cl&iacute;­nica Nr: </strong> <?php echo $_GET['id_ficha']?></h3>
	</div>
	
	<div class="w3-container">
	<br>    		
		<?php 
				$connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));
				$select_ficha = 'SELECT * FROM FICHAS_CLINICAS WHERE (ID = '.$_GET['id_ficha'].')';
				$result = mysqli_query($connect,$select_ficha) or die('The query failed: ' . mysqli_error($connect));
				$ficha = mysqli_fetch_array($result);  						
		?>
		
					
	
	<form name ="registo" method="POST" action="index.php?op=sFichaClinica<?php echo "&id_ficha=".$_GET['id_ficha'];?>" class="w3-container" >
			<div class="w3-container w3-half">
 		    <br><br>
 		    <h3 style="color:#003E63"><strong>Registo dos Sintomas </strong></h3>
 		    <br>
 		    <label class="w3-text-theme"><strong>Tosse Seca: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</strong></label>
 		    <?PHP if($ficha['TOSSE_SECA']==0){     		
    			echo"<input class='w3-radio' type='radio' name='newTosse' value='0' checked > <label>N&atilde;o</label>";
			    echo"<input class='w3-radio' type='radio' name='newTosse' value='1' disabled> <label>Sim</label>";
			    }
			    else{
			    echo"<input class='w3-radio' type='radio' name='newTosse' value='0' disabled > <label>N&atilde;o</label>";
			    echo"<input class='w3-radio' type='radio' name='newTosse' value='1' checked> <label>Sim</label>";

			    }
			 ?>
			    
			<br><br>
			<label class="w3-text-theme"><strong>Dor de Garganta: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</strong></label>   
			 <?PHP if($ficha['DOR_GARGANTA']==0){   		
    			echo "<input class='w3-radio' type='radio' name='newGarganta' value='0' checked > <label>N&atilde;o</label>";
			    echo "<input class='w3-radio' type='radio' name='newGarganta' value='1' disabled> <label>Sim</label>";
			}
			else{
				echo "<input class='w3-radio' type='radio' name='newGarganta' value='0' disabled > <label>N&atilde;o</label>";
			    echo "<input class='w3-radio' type='radio' name='newGarganta' value='1' checked> <label>Sim</label>";
			    }
			    ?>

			
			<br><br>
			<label class="w3-text-theme"><strong>Fraqueza: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</strong></label>  
			<?PHP  if($ficha['FRAQUEZA']==0){ 		
    			echo "<input class='w3-radio' type='radio' name='newFraqueza' value='0' checked > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newFraqueza' value='1' disabled> <label>Sim</label>";
				}
				else{
    			echo "<input class='w3-radio' type='radio' name='newFraqueza' value='0' disabled > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newFraqueza' value='1' checked> <label>Sim</label>";
				
				}
				
			?>
			<br><br>
			 <label class="w3-text-theme"><strong>Sonol&ecirc;ncia: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;</strong></label>
			 <?PHP  if($ficha['SONOLENCIA']==0){ 
			 	echo "<input class='w3-radio' type='radio' name='newSonolencia' value='0' checked > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newSonolencia' value='1' disabled> <label>Sim</label>";
				}
				else{
				echo "<input class='w3-radio' type='radio' name='newSonolencia' value='0' disabled > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newSonolencia' value='1' checked > <label>Sim</label>";
				}
				?>
			<br><br>
			<label class="w3-text-theme"><strong>Dor de Peito: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</strong></label>  
			<?php if($ficha['DOR_PEITO']==0){ 
				echo "<input class='w3-radio' type='radio' name='newPeito' value='0' checked > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newPeito' value='1' disabled> <label>Sim</label>";
				}
				else{
				echo "<input class='w3-radio' type='radio' name='newPeito' value='0' disabled > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newPeito' value='1' checked> <label>Sim</label>";

				}
				?>
			<br><br>
			<label class="w3-text-theme"><strong>Perda de Apetite: </strong></label>  
			<?php if($ficha['PERDA_APETITE']==0){    		
    			echo "<input class='w3-radio' type='radio' name='newApetite' value='0' checked > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newApetite' value='1' disabled> <label>Sim</label>";
				}
				else{
    			echo "<input class='w3-radio' type='radio' name='newApetite' value='0' disabled > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newApetite' value='1' checked> <label>Sim</label>";	
				}
				?>
			<br><br>
			<label class="w3-text-theme"><strong>Perda de Olfato: </strong></label>
			<?php if($ficha['PERDA_OLFATO']==0){     		
    			echo "<input class='w3-radio' type='radio' name='newOlfato' value='0' checked > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newOlfato' value='1' disabled> <label>Sim</label>";
				}
				else{
				echo "<input class='w3-radio' type='radio' name='newOlfato' value='0' disabled > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newOlfato' value='1' checked> <label>Sim</label>";
				}
			?>
			<br><br>
			<label class="w3-text-theme"><strong>Progress&atilde;o dos Sintomas: </strong></label>
			<?php if($ficha['PROGRESSAO_SINTOMAS']==0){       		
    			echo "<input class='w3-radio' type='radio' name='newProgressao' value='0' checked > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newProgressao' value='1'disabled> <label>Sim</label>";
				}
				else{
				echo "<input class='w3-radio' type='radio' name='newProgressao' value='0' disabled> <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newProgressao' value='1'checked> <label>Sim</label>";
				}
				?>
			<br><br>
			<label class="w3-text-theme" id="NIF"><strong>Temperatura Corportal (&deg;C): </strong></label> <input class ="w3-input w3-border-0" style="width:70px"type="text" name="newTemp" value="<?php echo $ficha['TEMPERATURA_CORPORAL'];?>" disabled >
			<br>

			</div>
			<div class="w3-container w3-half">
			<br><br>
 		    <h3 style="color:#003E63"><strong>Registo dos Fatores de Risco </strong></h3>
 		    <br>
 		    <label class="w3-text-theme"><strong>Doen&ccedil;&atilde;a Renal: </strong></label> 
 		    <?php if($ficha['DOENCA_RENAL']==0){    		
    			echo "<input class='w3-radio' type='radio' name='newRenal' value='0' checked ><label>N&atilde;o</label>";
    			echo "<input class='w3-radio' type='radio' name='newRenal' value='1' disabled> <label>Sim</label>";
    			}
    			else{
    			echo "<input class='w3-radio' type='radio' name='newRenal' value='0' disabled ><label>N&atilde;o</label>";
    			echo "<input class='w3-radio' type='radio' name='newRenal' value='1' checked> <label>Sim</label>";
    			}
    			?>

			<br><br>
			<label class="w3-text-theme"><strong>Press&atilde;o Alta: </strong></label> 
			<?php if($ficha['PRESSAO_ALTA']==0){     		
    			echo "<input class='w3-radio' type='radio' name='newPressao' value='0' checked > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newPressao' value='1' disabled> <label>Sim</label>";
				}
				else{
    			echo "<input class='w3-radio' type='radio' name='newPressao' value='0' disabled > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newPressao' value='1' checked> <label>Sim</label>";
				}
				?>	
			<br><br>
			<label class="w3-text-theme"><strong>AVC ou Imunidade Reduzida: &emsp;</strong></label>
			<?php if($ficha['AVC_IMUNIDADE']==0){  		
    			echo "<input class='w3-radio' type='radio' name='newAVC' value='0' checked > <label>N&atilde;o</label>";
    			echo "<input class='w3-radio' type='radio' name='newAVC' value='1' disabled> <label>Sim</label>";
    			}
    			else{
    			echo "<input class='w3-radio' type='radio' name='newAVC' value='0' disabled > <label>N&atilde;o</label>";
    			echo "<input class='w3-radio' type='radio' name='newAVC' value='1' checked> <label>Sim</label>";
    			}
    			?>
			<br><br>
			<label class="w3-text-theme"><strong>Doen&ccedil;as Pulmonares: </strong></label>  
			<?php if($ficha['DOENCAS_PULMONARES']==0){ 
				echo "<input class='w3-radio' type='radio' name='newPulmonares' value='0' checked > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newPulmonares' value='1' disabled> <label>Sim</label>";
				}
				else{
				echo "<input class='w3-radio' type='radio' name='newPulmonares' value='0' disabled > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newPulmonares' value='1' checked> <label>Sim</label>";
				}
				?>
			<br><br>
			<label class="w3-text-theme"><strong>Viagem a Pa&iacute;­s Infetado:&emsp;&emsp;&emsp; &nbsp;&nbsp;&nbsp;</strong></label>
			<?php if($ficha['VIAGEM_PAIS_INFETADO']==0){      		
    			echo "<input class='w3-radio' type='radio' name='newPais' value='0' checked > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newPais' value='1' disabled> <label>Sim</label>";
				}
				else{
				echo "<input class='w3-radio' type='radio' name='newPais' value='0' disabled > <label>N&atilde;o</label>";
				echo "<input class='w3-radio' type='radio' name='newPais' value='1' checked> <label>Sim</label>";
				}
				?>
			<br><br>
			<label class="w3-text-theme"><strong>Diabetes: </strong></label>
			<?php if($ficha['DIABETES']==0){
			echo "<input class='w3-radio' type='radio' name='newDiabetes' value='0' checked > <label>N&atilde;o</label>";
			echo "<input class='w3-radio' type='radio' name='newDiabetes' value='1' disabled> <label>Sim</label>";
			}
			else{
			echo "<input class='w3-radio' type='radio' name='newDiabetes' value='0' disabled > <label>N&atilde;o</label>";
			echo "<input class='w3-radio' type='radio' name='newDiabetes' value='1' checked> <label>Sim</label>";
			}
			?>
			<br><br>
			<label class="w3-text-theme"><strong>Doen&ccedil;as Card&iacute;­acas: </strong></label>
			<?php if($ficha['DOENCAS_CARDIACAS']==0){     		
    		echo "<input class='w3-radio' type='radio' name='newCardiacas' value='0' checked > <label>N&atilde;o</label>";
			echo "<input class='w3-radio' type='radio' name='newCardiacas' value='1' disabled> <label>Sim</label>";
			}
			else{
    		echo "<input class='w3-radio' type='radio' name='newCardiacas' value='0' disabled> <label>N&atilde;o</label>";
			echo "<input class='w3-radio' type='radio' name='newCardiacas' value='1' checked> <label>Sim</label>";
			}
			?>			
			<br><br>
			<label class="w3-text-theme"><strong>Problemas Respirat&oacute;rios:&emsp;&emsp;&emsp;</strong></label>
			<?php if($ficha['PROBLEMAS_RESPIRATORIOS']==0){      		
    		echo "<input class='w3-radio' type='radio' name='newRespiratorios' value='0' checked > <label>N&atilde;o</label>";
			echo "<input class='w3-radio' type='radio' name='newRespiratorios' value='1' disabled> <label>Sim</label>";
			}
			else{
			echo "<input class='w3-radio' type='radio' name='newRespiratorios' value='0' disabled > <label>N&atilde;o</label>";
			echo "<input class='w3-radio' type='radio' name='newRespiratorios' value='1' checked> <label>Sim</label>";
			}
			?>
			<br><br><br><br><br><br>
			</div>
			<br>
			<input class="w3-btn w3-hover-theme w3-theme-d3" style="float:right" type="submit" name="submit" id="submit" value="Voltar Atrás">


</form>
</div>
</DIV>
