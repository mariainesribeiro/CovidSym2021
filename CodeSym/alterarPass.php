<?php
				$connect = mysqli_connect('localhost', 'root','','COVIDSYM') or die('Error connecting to the server: '.mysqli_error($connect));	 
				    

    			
    			$select_user = 'SELECT * FROM UTILIZADORES WHERE ID='.$_SESSION['ID'];
    			$result_user = mysqli_query ($connect, $select_user) or die ('The query failed: ' .mysqli_error($connect));
				$user = mysqli_fetch_array($result_user);
				                                        	
                                        	                                            

?>
<SCRIPT type="text/javascript">
     
    //ValidaÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â§ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£o do Username
    
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
		<h3 style="color:#003E63"><strong>Alterar Dados de Sess&atilde;o</strong></h3>
						

	</div>

	<form name ="registo" method="POST" action="index.php?op=cPass<?php echo "&id=".$_SESSION['ID'];?>" onsubmit="return ValidaterRegisto()" class="w3-container"  enctype="multipart/form-data" >
			<br>
			<br>
			<input type=hidden id ="old_username" name ="old_username" value="<?php echo $user['USERNAME']; ?>">
			<label class="w3-text-theme"><strong>Username: </strong></label><input class=" w3-input w3-border-0"  onblur="checkNewUsername(this.value)" type="text" name="newUser" value="<?php echo $user['USERNAME'];?>" >
    		
    		<br>
    		<div class="w3-row-padding">
 		    	<div class="w3-half">
 		    	<input type=hidden id ="old_pass" name="old_pass" value="<?php echo $user['PASSWORD']; ?>">
 		    	<label class="w3-text-theme"><strong>Nova Password: </strong></label> <input class ="w3-input w3-border-0" type="password" name="newPass"  >
 		    	</div>
 		    	<div class="w3-half">
 		    	<label class="w3-text-theme"><strong>Confirme a password: </strong></label> <input class ="w3-input w3-border-0"  type="password"   name="newPass2" >
 		    	</div>
 		    </div>

    		<br>
    	<input class="w3-btn w3-hover-theme w3-theme-d3" style="float:right"type="submit" name="submit" id="submit" value="Registar Altera&ccedil;&atilde;o"> 


</form>
</div>

