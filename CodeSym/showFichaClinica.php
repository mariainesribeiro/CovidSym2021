


<div class="w3-card-4 w3-container w3-display-topmiddle w3-theme-l5" style="width:70%; height:100%; overflow:scroll;">
	
	<div class="w3-container">
		<h3 style="color:#003E63"><strong>Ficha Cl&iacute;­nica Nr: </strong> <?php echo $_GET['id_ficha']?></h3>
	</div>
	
	<div class="w3-container">
	<br>
	<button onclick="myFunction('Demo1')" class="w3-button w3-block w3-left-align w3-theme-d3 w3-hover-theme"><h4 style="vertical-align:middle"><i class='fas fa-address-card' style='font-size:36px'>&nbsp;&nbsp;&nbsp;&nbsp;</i>Dados do Utente</h4> </button>
		<div id="Demo1" class="w3-hide w3-container">
		<br>
    		
		
		<?php 
				$connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));
				$select_ficha = 'SELECT * FROM FICHAS_CLINICAS WHERE (ID = '.$_GET['id_ficha'].')';
				$result = mysqli_query($connect,$select_ficha) or die('The query failed: ' . mysqli_error($connect));
				$ficha = mysqli_fetch_array($result);
				$select_utente = 'SELECT * FROM utentes WHERE (ID = '.$ficha['ID_UTENTE'].')';
				$result_utente = mysqli_query($connect,$select_utente) or die('The query failed: ' . mysqli_error($connect));
				$utente = mysqli_fetch_array($result_utente);
				$select_user = 'SELECT * FROM utilizadores WHERE (ID = '.$utente['ID_UTILIZADOR'].')';
				$result_user = mysqli_query($connect,$select_user) or die('The query failed: ' . mysqli_error($connect));
				$user = mysqli_fetch_array($result_user);	
				    
   				$sql_distritos = 'SELECT NOME FROM DISTRITOS WHERE ID = '.$user['DISTRITO'];
    			$result_distritos = mysqli_query ($connect, $sql_distritos) or die ('The query failed: ' .mysqli_error($connect));
    			$distrito = mysqli_fetch_array($result_distritos)['NOME'];
    			$sql_localidades = 'SELECT NOME FROM LOCALIDADEs WHERE ID = '.$user['LOCALIDADE'];
    			$result_localidades = mysqli_query ($connect, $sql_localidades) or die ('The query failed: ' .mysqli_error($connect));
    			$localidade = mysqli_fetch_array($result_localidades)['NOME'];

    			
    
    			$sql_alergias = 'SELECT * FROM ALERGIAS_UTENTES WHERE UTENTE='.$ficha['ID_UTENTE'];
    			$result_alergias = mysqli_query ($connect, $sql_alergias) or die ('The query failed: ' .mysqli_error($connect)); 
    			

    			

						
		?>
		
		<?php
				$getname = $ficha['ID_UTENTE']; 
				$select_image="select * from fotografias where NAME ='$getname'";
				$var=mysqli_query($connect, $select_image);
				if($row=mysqli_fetch_array($var)){
					//header("content-type:image/png");
 					$image_name=$row["NAME"];
 					$image_content=$row["TMP"];
					}
				?>
				<img src='data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image_content);?>' style="width:230; height:200;" class="w3-border w3-padding" alt="Fotografia do Utente">

		<br><br>
    		<label class="w3-text-theme"><strong>Nome completo: </strong></label> <input class=" w3-input w3-border-0" type="text" placeholder="<?php echo $user['NOME'];?>" disabled >
		    <br>
		   	<div class="w3-row-padding">
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme"><strong>Email: </strong></label> <input class ="w3-input w3-border-0"  type="email" placeholder="<?php echo $user['EMAIL'];?>" disabled  >
 		    	</div>
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme"><strong>Telem&oacute;vel: </strong></label> <input class ="w3-input w3-border-0" type="text" placeholder="<?php echo $user['TELEMOVEL'];?>" disabled >
 		    	</div>
 		    </div>
			<br>

			<label class="w3-text-theme"><strong>Morada: </strong></label> <input class=" w3-input w3-border-0" type="text" placeholder="<?php echo $user['MORADA'];?>" disabled >
		    <br>
		    <div class="w3-row-padding">
 		    	<div class="w3-half">
 		    		<label class="w3-text-theme"><strong>Distrito</strong></label>
 		    	      <input  class="w3-input w3-border-0" placeholder="<?php echo $distrito;?>" disabled>
 		    	</div>
 		    	<div class="w3-half">
 		    			<label class="w3-text-theme"><strong>Localidade</strong></label>
  		    	       <input  class="w3-input w3-border-0" placeholder="<?php echo $localidade;?>" disabled >
       			 	</div>
 		    </div>
 		    <br>
 		    <div class="w3-row-padding">
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme" id="NIF"><strong>NIF: </strong></label> <input class ="w3-input w3-border-0" type="text" placeholder="<?php echo $utente['NIF'];?>" disabled >
 		    	</div>
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme"><strong>Nr. Utente: </strong></label> <input class ="w3-input w3-border-0" type="text" placeholder="<?php echo $utente['NR_UTENTE'];?>" disabled >
 		    	</div>
 		    </div>
 		    <br>
    		<label class="w3-text-theme"><strong>Sexo: </strong></label> 
    		<?php if($utente['SEXO']==0){
    			echo '<input class="w3-radio" type="radio" name="newSexo" value="0" checked> <label>Male</label>
			<input class="w3-radio" type="radio" name="newSexo" value="1" disabled> <label>Female</label>';
			} 
			else{
				echo '<input class="w3-radio" type="radio" name="newSexo" value="0" disabled> <label>Male</label>
			<input class="w3-radio" type="radio" name="newSexo" value="1" checked> <label>Female</label>';
		
			}
			?>
			<br><br>
			<label class="w3-text-theme"><strong>Data de Nascimento: </strong></label> <input class=" w3-input w3-border-0" type="date" value ="<?php echo $utente['DATA_NASCIMENTO'];?>" disabled>
 		    <br>
			<label class="w3-text-theme"><strong>Alergias: </strong></label> 
				<select class ="w3-select" name="newAlergias[ ]" multiple="multiple" disabled>
					                     	<?php
                                        while($rows = mysqli_fetch_array($result_alergias)):
                                        	$sql_nome = 'SELECT * FROM ALERGIAS WHERE ID='.$rows['ALERGIA'];
    										$result_nome = mysqli_query ($connect, $sql_nome) or die ('The query failed: ' .mysqli_error($connect)); 
    										$nome = mysqli_fetch_array($result_nome)['NOME'];
                                            ?>
                						<option> <?php echo $nome; ?></option>
                						<?php endwhile; ?>

				</select>
 		    <br><br>
					
		
		
	</div>	
	</div>
		<div class="w3-container">
		<br>
	    <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-left-align w3-theme-d3 w3-hover-theme"><h4><i class='fas fa-folder' style='font-size:36px'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fichas Cl&iacute;­nicas Anteriores</h4> </button>
		<div id="Demo2" class="w3-hide w3-container">
			<?Php     				$sql_fichas = 'SELECT * FROM FICHAS_CLINICAS WHERE (ID_UTENTE='.$ficha['ID_UTENTE'].') AND(data_diagnostico IS NOT NULL )';;
    				$result_fichas = mysqli_query ($connect, $sql_fichas) or die ('The query failed: ' .mysqli_error($connect)); 
					$n= mysqli_num_rows($result_fichas);
					if($n == 0){
						echo "<br>N&atilde;o foram encontradas fichas cl&iacute;­nicas anteriores.<br>";
					}
					else{?>
			<br>
			<table class="w3-table-all w3-hoverable">
    		<thead>
     			<tr class="w3-theme-d3">
     					<th></th>
        				<th>Data </th>
        				<th>Prescri&ccedil;&atilde;o<th>	
      			</tr>
    		</thead>
    			<?php
    			 		while($rows = mysqli_fetch_array($result_fichas)):?>
                                            
                			<tr class="w3-theme-l5"> 
                			<!--<td><?php echo '<a href="index.php?op=sFichaClinica&idUtente='.$rows['ID_UTENTE'].'><i class="far fa-file" style="font-size:24px"></i></a>';?></td>-->
                			<td><button class ="w3-theme-d3" style='font-size:24px'><?php echo "<a href='index.php?op=vFichaClinica&id_ficha=".$rows['ID']."'>";?> <i class="far fa-file" style="font-size:24px"></i><?php echo "</a>";?></button></td>
                			<td><?php echo $rows['DATA_DIAGNOSTICO'];  ?> </td>
                			<td><?php 
                				if($rows['DIAGNOSTICO']==0){
                				echo "N&atilde;o";}
                				else{echo "Sim";}                				
                				?>
                			</td>
                	</tr>
                	<?php endwhile;} ?>
      	</table>
		</div>
		</div>
	
	
<script>
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}</script>
<br>
<br>
			
	
	<form name ="registo" method="POST" action="index.php?op=cFichaClinica<?php echo "&ficha=".$_GET['id_ficha']?>" class="w3-container" >
			<div class="w3-container w3-half">
 		    <br><br>
 		    <h3 style="color:#003E63"><strong>Registo dos Sintomas </strong></h3>
 		    <br>
 		    <label class="w3-text-theme"><strong>Tosse Seca: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</strong></label>     		
    		<input class="w3-radio" type="radio" name="newTosse" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newTosse" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme"><strong>Dor de Garganta: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</strong></label>     		
    		<input class="w3-radio" type="radio" name="newGarganta" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newGarganta" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme"><strong>Fraqueza: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</strong></label>     		
    		<input class="w3-radio" type="radio" name="newFraqueza" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newFraqueza" value="1"> <label>Sim</label>
			<br><br>
			 <label class="w3-text-theme"><strong>Sonol&ecirc;ncia: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;</strong></label>     		
    		<input class="w3-radio" type="radio" name="newSonolencia" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newSonolencia" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme"><strong>Dor de Peito: &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</strong></label>     		
    		<input class="w3-radio" type="radio" name="newPeito" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newPeito" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme"><strong>Perda de Apetite: </strong></label>     		
    		<input class="w3-radio" type="radio" name="newApetite" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newApetite" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme"><strong>Perda de Olfato: </strong></label>     		
    		<input class="w3-radio" type="radio" name="newOlfato" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newOlfato" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme"><strong>Progress&atilde;o dos Sintomas: </strong></label>     		
    		<input class="w3-radio" type="radio" name="newProgressao" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newProgressao" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme" id="NIF"><strong>Temperatura Corportal (&deg;C): </strong></label> <input class ="w3-input w3-border-0" style="width:70px"type="text" name="newTemp" required >
			<br>

			</div>
			<div class="w3-container w3-half">
			<br><br>
 		    <h3 style="color:#003E63"><strong>Registo dos Fatores de Risco </strong></h3>
 		    <br>
 		    <label class="w3-text-theme"><strong>Doen&ccedil;&atilde;a Renal: </strong></label>     		
    		<input class="w3-radio" type="radio" name="newRenal" value="0" checked ><label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newRenal" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme"><strong>Press&atilde;o Alta: </strong></label>     		
    		<input class="w3-radio" type="radio" name="newPressao" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newPressao" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme"><strong>AVC ou Imunidade Reduzida: &emsp;</strong></label>  		
    		<input class="w3-radio" type="radio" name="newAVC" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newAVC" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme"><strong>Doen&ccedil;as Pulmonares: </strong></label>     		
    		<input class="w3-radio" type="radio" name="newPulmonares" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newPulmonares" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme"><strong>Viagem a Pa&iacute;­s Infetado:&emsp;&emsp;&emsp; &nbsp;&nbsp;&nbsp;</strong></label>     		
    		<input class="w3-radio" type="radio" name="newPais" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newPais" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme"><strong>Diabetes: </strong></label>     		
    		<input class="w3-radio" type="radio" name="newDiabetes" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newDiabetes" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme"><strong>Doen&ccedil;as Card&iacute;­acas: </strong></label>     		
    		<input class="w3-radio" type="radio" name="newCardiacas" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newCardiacas" value="1"> <label>Sim</label>
			<br><br>
			<label class="w3-text-theme"><strong>Problemas Respirat&oacute;rios:&emsp;&emsp;&emsp;</strong></label>     		
    		<input class="w3-radio" type="radio" name="newRespiratorios" value="0" checked > <label>N&atilde;o</label>
			<input class="w3-radio" type="radio" name="newRespiratorios" value="1"> <label>Sim</label>
			<br><br><br><br><br><br>
			</div>
			<br>
    		<input class="w3-btn w3-hover-theme w3-theme-d3" style="float:right" type="submit" name="submit" id="submit" value="Passo Seguinte">


</form>
</div>
