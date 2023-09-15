<?php
	$connect = mysqli_connect ('localhost', 'root', '', 'COVIDSYM') or die ('Error connecting to the server: '. mysqli_error($connect));
	$sql_pedidos = 'SELECT * FROM FICHAS_CLINICAS WHERE (ID_MEDICO = "'.$_SESSION['ID'].'") AND (data_diagnostico IS NULL ) ORDER BY DATA_CRIACAO';
	$result_pedidos = mysqli_query ($connect, $sql_pedidos) or die ('The query failed: ' .mysqli_error($connect));

?>


<div class="w3-card-4 w3-container w3-display-topmiddle w3-theme-l5" style="width:70%; height:100%; overflow:scroll;">
	
	<div class="w3-container">
		<h3 style="color:#003E63"><strong>Consultas por realizar</strong></h3>
	</div>
	
	<div class="w3-container">

  		<table class="w3-table-all w3-hoverable">
    		<thead>
     			<tr class="w3-theme-d3">
     					<th></th>
        				<th>Data de Pedido</th>
        				<th>Nome do Utente</th>	
      			</tr>
    		</thead>
    			<?php
    			 while($rows = mysqli_fetch_array($result_pedidos)):?>
                                            
                	<tr class="w3-theme-l5"> 
                			<!--<td><?php echo '<a href="index.php?op=sFichaClinica&idUtente='.$rows['ID_UTENTE'].'><i class="far fa-file" style="font-size:24px"></i></a>';?></td>-->
                			<td><button class ="w3-theme-d3" style='font-size:24px'><?php echo "<a href='index.php?op=sFichaClinica&id_ficha=".$rows['ID']."'>";?> <i class="far fa-file" style="font-size:24px"></i><?php echo "</a>";?></button></td>
                			<td><?php echo $rows['DATA_CRIACAO'];  ?> </td>
                			<td><?php 
                				$select_id = 'SELECT *FROM UTENTES WHERE (ID = "'.$rows['ID_UTENTE'].'")';
                				$result_id = mysqli_query($connect,$select_id) or die('The query failed: ' . mysqli_error($connect));
                				$id_row = mysqli_fetch_array($result_id);
                				$id_user = $id_row['ID_UTILIZADOR'];
                				$select_nome = 'SELECT NOME FROM UTILIZADORES WHERE (ID = "'.$id_user.'")';
                				$result_nome = mysqli_query($connect,$select_nome) or die('The query failed: ' . mysqli_error($connect));
                				$nome_row = mysqli_fetch_array($result_nome);
                				echo $nome_row['NOME'];
                				?>
                			</td>
                	</tr>
                	<?php endwhile; ?>
      	</table>
	</div>
	</DIV>	
	
