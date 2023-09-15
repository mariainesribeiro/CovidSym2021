<?php
	$connect = mysqli_connect ('localhost', 'root', '', 'COVIDSYM') or die ('Error connecting to the server: '. mysqli_error($connect));
	$sql_fichas = 'SELECT * FROM FICHAS_CLINICAS WHERE (ID_MEDICO='.$_SESSION['ID'].') AND (DATA_DIAGNOSTICO IS NOT NULL) ORDER BY DATA_DIAGNOSTICO';
	$result_fichas = mysqli_query ($connect, $sql_fichas) or die ('The query failed: ' .mysqli_error($connect));
?>
<script >
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

<div class="w3-card-4 w3-container w3-display-topmiddle w3-theme-l5" style="width:70%; height:100%; overflow:scroll;">
	
	<div class="w3-container">
		<h3 style="color:#003E63"><strong>Lista de Utentes</strong></h3>
	</div>

	<div class="w3-container">
		  <input class="w3-input w3-border w3-padding" type="text" placeholder="Procure pelo nome" id="myInput" onkeyup="myFunction()">
		  <br>
  		<table class="w3-table-all w3-hoverable" id="myTable">
    		<thead>
     			<tr class="w3-theme-d3">
     					<th></th>
        				<th>Nr. Ficha</th>
        				<th>Data da Consulta</th>
        				<th>ID do Utente</th>
        				<th>Nome do Utente</th>
        				<th>Prescri&ccedil;&atilde;o</th>	
        				
      			</tr>
    		</thead>
    			<?php
    			 while($rows = mysqli_fetch_array($result_fichas)):?>
                             <?php 
                				$sql_utente = 'SELECT * FROM UTENTES WHERE ID='.$rows['ID_UTENTE'];
								$result_utente = mysqli_query ($connect, $sql_utente) or die ('The query failed: ' .mysqli_error($connect));
								$utente = mysqli_fetch_array($result_utente);
								$sql_user = 'SELECT * FROM UTILIZADORES WHERE ID='.$utente['ID_UTILIZADOR'];
								$result_user = mysqli_query ($connect, $sql_user) or die ('The query failed: ' .mysqli_error($connect));
								$user = mysqli_fetch_array($result_user);
								?>
               
                	<tr class="w3-theme-l5"> 
                			<td>
                				<button class ="w3-theme-d3" style='font-size:24px'><?php echo "<a href='index.php?op=vFichaClinica&id_ficha=".$rows['ID']."'>";?> <i class="far fa-file" style="font-size:24px"></i><?php echo "</a>";?></button>
                   				<button class ="w3-theme-d3" style='font-size:24px'><?php echo "<a href='index.php?op=vUtente&id=".$user['ID']."'>";?> <i class="fas fa-address-card" style="font-size:24px"></i><?php echo "</a>";?></button>

                   			</td>
                   			<td><?pHP echo $rows['ID']; ?></td>
                			<td><?php echo $rows['DATA_DIAGNOSTICO'];  ?> </td>
                			<td><?php echo $utente['ID'];?></td>
                			<td><?Php echo $user['NOME'];?></td>
                			<td><?pHP if ($rows['DIAGNOSTICO']==0){
                					echo "N&atilde;o";
                					}
                					else{
                					echo "Sim";
                					}
                					?></td>
                	</tr>
                	<?php endwhile; ?>
                	
                	      	</table>
	</div>
	</DIV>	

