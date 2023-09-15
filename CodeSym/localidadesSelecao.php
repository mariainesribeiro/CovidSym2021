<?php

$connect = mysqli_connect ('localhost', 'root', '', 'COVIDSYM') or die ('Error connecting to the server: '. mysqli_error($connect));

$sql_localidades = 'SELECT NOME, ID FROM LOCALIDADES WHERE DISTRITO = "'.$_GET['newDist'].'" ORDER BY NOME ASC';
$result_localidades = mysqli_query ($connect, $sql_localidades) or die ('The query failed: ' .mysqli_error($connect));
while($rows = mysqli_fetch_array($result_localidades)) {
    echo '<option value="'.$rows['ID'].'">';
    echo $rows['NOME'];
    echo '</option>';
}
    
?>