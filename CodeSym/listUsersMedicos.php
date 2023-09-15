<?php
	$connect = mysqli_connect ('localhost', 'root', '', 'COVIDSYM') or die ('Error connecting to the server: '. mysqli_error($connect));
	$sql_medicos = 'SELECT * FROM UTILIZADORES WHERE (TIPO = 2) ORDER BY NOME';
	$result_medicos = mysqli_query ($connect, $sql_medicos) or die ('The query failed: ' .mysqli_error($connect));

?>
<script>
function myFunction() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
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
		<h3 style="color:#003E63"><strong>Lista de M&eacute;dicos</strong></h3>
	</div>

	<div class="w3-container">
		  <input class="w3-input w3-border w3-padding" type="text" placeholder="Procure pelo nome" id="myInput" onkeyup="myFunction()">
		  <br>
  		<table class="w3-table-all w3-hoverable" id="myTable">
    		<thead>
     			<tr class="w3-theme-d3">
     					<th></th>
        				<th>ID</th>
        				<th>Nome do M&eacute;dico</th>	
      			</tr>
    		</thead>
    			<?php
    			 while($rows = mysqli_fetch_array($result_medicos)):?>
                                            
                	<tr class="w3-theme-l5"> 
                			<td>
                				<button class ="w3-theme-d3" style='font-size:24px'><?php echo "<a href='index.php?op=vMedico&id=".$rows['ID']."'>";?> <i class="far fa-file" style="font-size:24px"></i><?php echo "</a>";?></button>
                				<button class ="w3-theme-d3" style='font-size:24px'><?php echo "<a href='index.php?op=aMedico&id=".$rows['ID']."'>";?> <i class="far fa-edit" style="font-size:24px"></i><?php echo "</a>";?></button>
                			</td>
                			<td><?php echo $rows['ID'];  ?> </td>
                			<td><?php echo $rows['NOME'];?>
                			</td>
                	</tr>
                	<?php endwhile; ?>
      	</table>
	</div>
	</DIV>	
	
