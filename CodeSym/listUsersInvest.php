<?php
	$connect = mysqli_connect ('localhost', 'root', '', 'COVIDSYM') or die ('Error connecting to the server: '. mysqli_error($connect));
	$sql_investigadores = 'SELECT * FROM UTILIZADORES WHERE (TIPO = 4) ORDER BY NOME';
	$result_investigadores = mysqli_query ($connect, $sql_investigadores) or die ('The query failed: ' .mysqli_error($connect));

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


    function ativar(id, estado){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) { 
                if (this.responseText == "red") {
              
                    document.getElementById("b").style.color = 'red';
                    document.getElementById("e").innerHTML = "Ativo";
                    return true;
                }
                else {
                    document.getElementById("b").style.color = 'green';
					document.getElementById("e").innerHTML = "Desativo" ;
                    return true;
                }
           } 
    };
    xmlhttp.open("GET", "checkActivar.php?id=" + id + "&estado=" + estado , true);
    xmlhttp.send();
    }

</script>


<div class="w3-card-4 w3-container w3-display-topmiddle w3-theme-l5" style="width:70%; height:100%; overflow:scroll;">
	
	<div class="w3-container">
		<h3 style="color:#003E63"><strong>Lista de Investigadores</strong></h3>
	</div>

	<div class="w3-container">
		<input class="w3-input w3-border w3-padding" type="text" placeholder="Procure pelo nome" id="myInput" onkeyup="myFunction()">
		<br>
  		<table class="w3-table-all w3-hoverable" id="myTable">
    		<thead>
     			<tr class="w3-theme-d3">
     					<th></th>
        				<th>ID</th>
        				<th>Nome do Investigador</th>
        				<th>Estado</th>	
      			</tr>
    		</thead>
    			<?php
    			 while($rows = mysqli_fetch_array($result_investigadores)):?>
                                            
                	<tr class="w3-theme-l5"> 
                			<td>
                				<button class ="w3-theme-d3" style='font-size:24px'><?php echo "<a href='index.php?op=vInvest&id=".$rows['ID']."'>";?> <i class="far fa-file" style="font-size:24px"></i><?php echo "</a>";?></button>
                				<button class ="w3-theme-d3" style='font-size:24px'><?php echo "<a href='index.php?op=aInvest&id=".$rows['ID']."'>";?> <i class="far fa-edit" style="font-size:24px"></i><?php echo "</a>";?></button>
								<button class ='w3-theme-d3' style='font-size:24px' onclick='ativar("<?php echo $rows["ID"];?>" , "<?php echo $rows["ESTADO"];?>")'><?Php if($rows['ESTADO']==0){echo '<i id = "b" class="fas fa-power-off" style="font-size:24px; color:green"></i>';} else{echo '<i id = "b" class="fas fa-power-off" style="font-size:24px; color:red"></i>';} ?><?php echo "</a>";?></button>
                				</td>
                			
                			<td><?php echo $rows['ID'];  ?> </td>
                			<td><?php echo $rows['NOME'];?>
                			</td>
                			<td id="e"><?php if ($rows['ESTADO']==0){echo "Desativo";}else{echo "Ativo";} ?></td>
                	</tr>
                	<?php endwhile; ?>
      	</table>
	</div>
	</DIV>	
	
