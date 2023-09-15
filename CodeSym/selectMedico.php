<script>  
	function listaEsperax(medico) {
    	var xmlhttp = new XMLHttpRequest();
    	xmlhttp.onreadystatechange = function() {
      		if (this.readyState == 4 && this.status == 200) {
        		document.getElementById("espera").innerHTML = this.responseText;
      		}
    	};
    	xmlhttp.open("GET", "listaEspera.php?idMedico=" + medico, true);
    	xmlhttp.send();
    }

</script>  


<div class="w3-card-4 w3-container w3-display-topmiddle w3-theme-l5" style="width:50%">
	
	<div class="w3-container">
		<h3 style="color:#003E63"><strong>Selecione um M&eacute;dico para o acompanhar </strong></h3>
	</div>
				

	<form name ="selecionarMedico" method="POST"  class="w3-container" action="index.php?op=cFicha">
  
    	<select name="Medico" id ="Medico" class="w3-select"  onchange="listaEsperax(this.value)" placeholder="selecione um medico" required>
                         	<?php
                         				$connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));
										$listar_medicos = 'SELECT * FROM UTILIZADORES WHERE (TIPO = 2)';
										$result_medicos = mysqli_query($connect,$listar_medicos) or die('The query failed: ' . mysqli_error($connect));

                                        while($rows = mysqli_fetch_array($result_medicos)):
                                            ?>
                						<option value="<?php echo $rows['ID'];?>"> 
                						<?php 
                							$select_titulo = 'SELECT TITULO FROM MEDICOS WHERE (ID = "'.$rows['ID'].'")';
                							$result_titulo = mysqli_query($connect,$select_titulo) or die('The query failed: ' . mysqli_error($connect));
                							$titulo_row = mysqli_fetch_array($result_titulo);
                							$titulo = $titulo_row['TITULO'];
                							if ($titulo == 0){
                								echo 'Dr. '.$rows['NOME'];
                							}
                							else{
                								echo 'Dr&ordf;. '.$rows['NOME'];
                							}
                						?>
                						</option>	
                						<?php endwhile; ?>
       </select>
       
       <div  class="w3-container">
       		<br>N&uacute;mero de utentes em espera:
       		<span id="espera" class="w3-badge w3-red"></span>
       		<br><br>
       </div>
   <input class="w3-btn w3-hover-theme w3-theme-d3" type="submit" name="submit" id="submit" value="Passo seguinte">
   </form>	    
</div>



