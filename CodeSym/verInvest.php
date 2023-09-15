<?php
				$connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));	 
				    
   				$sql_distritos = 'SELECT * FROM DISTRITOS ORDER BY NOME ASC';
    			$result_distritos = mysqli_query ($connect, $sql_distritos) or die ('The query failed: ' .mysqli_error($connect));
    			

    			
    			$select_invest = 'SELECT * FROM UTILIZADORES WHERE ID='.$_GET['id'];
    			$result_invest = mysqli_query ($connect, $select_invest) or die ('The query failed: ' .mysqli_error($connect));
				$invest = mysqli_fetch_array($result_invest);
				
    
?>
<SCRIPT type="text/javascript">

    function localidadesSelecao(distrito) {
    	var xmlhttp = new XMLHttpRequest();
    	xmlhttp.onreadystatechange = function() {
      		if (this.readyState == 4 && this.status == 200) {
        		document.getElementById("localidade").innerHTML = this.responseText;
      		}
    	};
    	xmlhttp.open("GET", "localidadesSelecao.php?newDist=" + distrito, true);
    	xmlhttp.send();
    }
    
     
    //ValidaÃƒÆ’Ã‚Â§ÃƒÆ’Ã‚Â£o do Username
    
    function checkNewUsername(username) {
    var xmlhttp = new XMLHttpRequest();
    var old =document.getElementById("old_username").value;
    if(username==old){
    document.getElementById("submit").disabled = false
    return true
    }
    else{
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) { 
                if (this.responseText != "") {
                	alert("O Username ja existe".concat(this.responseText));
                    document.getElementById("submit").disabled = true;
                    return false;
                }
                else {
                    document.getElementById("submit").disabled = false;
                    return true;
                }
            }
    };
    xmlhttp.open("GET", "checkUsername.php?newUser=" + username, true);
    xmlhttp.send();
    }
    }

    
    
	function ValidateRegisto(){
		var name = document.forms["registo"]["newName"].value;
		var user = document.forms["registo"]["newUser"].value;
		var pass = document.forms["registo"]["newPass"].value;
		var pass2 = document.forms["registo"]["newPass2"].value;
  		if (pass != pass2){
  			alert("As passwords nao correspondem. Por favor, volte a inserir.")
  			return false;
  			}
    	else{
    		return true;
    	}
	}
	
	
	
</SCRIPT>

<div class="w3-card-4 w3-container w3-display-topmiddle w3-theme-l5" style="width:70%; height:100%; overflow:scroll;">
	
	<div class="w3-container">
		<h3 style="color:#003E63"><strong>Registo do Investigador</strong></h3>
						

	</div>
				

	<form name ="registo" method="POST" class="w3-container"  enctype="multipart/form-data" >
			<br>
			<h4 style="color:#003E63"><strong>Dados de Sess&atilde;o</strong></h4>
			<br>
			<input type=hidden id ="old_username" name ="old_username" value="<?php echo $invest['USERNAME']; ?>">
			<label class="w3-text-theme"><strong>Username: </strong></label><input class=" w3-input w3-border-0"  onblur="checkNewUsername(this.value)" type="text" name="newUser" value="<?php echo $invest['USERNAME'];?>" disabled>
    		
    		<br>
    		
    		<br>
 		    <h4 style="color:#003E63"><strong>Dados Pessoais</strong></h4>
 		    <br>
 		    <input type=hidden id ="old_nome" name="old_nome" value="<?php echo $invest['NOME']; ?>">

    		<label class="w3-text-theme"><strong>Nome completo: </strong></label> <input class=" w3-input w3-border-0" type="text" name="newName" value="<?php echo $invest['NOME'];?>" disabled>
		    <br>
		   	<div class="w3-row-padding">
 		    	<div class="w3-half">
 		    	<input type=hidden id ="old_email" name="old_email" value="<?php echo $invest['EMAIL']; ?>">

 		    	<label class="w3-text-theme"><strong>Email: </strong></label> <input class ="w3-input w3-border-0"  type="email" name="newEmail" value="<?php echo $invest['EMAIL'];?>"disabled >
 		    	</div>
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme"><strong>Telem&oacute;vel: </strong></label> <input class ="w3-input w3-border-0" type="text" name="newTel" value="<?php echo $invest['TELEMOVEL'];?>" disabled>
 		    	</div>
 		    </div>
			<br>

			<label class="w3-text-theme"><strong>Morada: </strong></label> <input class=" w3-input w3-border-0" type="text" name="newAddress" value="<?php echo $invest['MORADA'];?>" disabled>
		    <input type=hidden id ="old_morada" name="old_morada" value="<?php echo $invest['MORADA']; ?>">

		    <br>
		    <div class="w3-row-padding">
 		    	<div class="w3-half">
 		    		<label class="w3-text-theme"><strong>Distrito</strong></label>
 		    	      <select name="newDist" id ="newDist" class="w3-select"  onchange="localidadesSelecao(this.value)" selected ="<?php echo $invest['DISTRITO'];?>" disabled>
                         	<?php
                                        while($rows = mysqli_fetch_array($result_distritos)):
                                            ?>
                						<option value="<?php echo $rows['ID']; ?>"> <?php echo $rows['NOME']; ?></option>
                						<?php endwhile; ?>
           			  </select>
 		    	</div>
 		    	<div class="w3-half">
 		    			<label class="w3-text-theme"><strong>Localidade</strong></label>
  		    	      <select id ="localidade" name="newLocal" class="w3-select"  selected ="<?php echo $invest['LOCALIDADE'];?>" disabled>
								<?php
								$sql_localidades = 'SELECT * FROM LOCALIDADES WHERE DISTRITO = '.$invest['DISTRITO'].' ORDER BY NOME ASC';
    							$result_localidades = mysqli_query ($connect, $sql_localidades) or die ('The query failed: ' .mysqli_error($connect));
								while($rows = mysqli_fetch_array($result_localidades)):
                                            ?>
                						<option value="<?php echo $rows['ID']; ?>"> <?php echo $rows['NOME']; ?></option>
                						<?php endwhile; ?>


       			  </select>
 		    	</div>
 		    </div>
 		    <br>


    		

</form>
</div>
