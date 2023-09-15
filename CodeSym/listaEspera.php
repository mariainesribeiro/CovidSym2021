<?php
				$connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));
				$lista_espera = 'SELECT * FROM fichas_clinicas WHERE (id_medico = '.$_GET['idMedico'].') AND (data_diagnostico IS NULL )';
				$result = mysqli_query($connect,$lista_espera) or die('The query failed: ' . mysqli_error($connect));
				$n = mysqli_num_rows($result);
			    echo $n;
?>