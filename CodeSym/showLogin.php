<?php session_unset(); ?>
		
		<div class="w3-card-4 w3-container w3-display-topmiddle w3-theme-l5" style="width:50%">
		
			<div class="w3-container">
				<h3 style="color:#003E63"><strong>Login</strong></h3>
			</div>
				
			<form method="POST" action ="index.php?op=cLogin" class="w3-container">
				    <br>
				    <label class="w3-text-theme"><strong>Utilizador:</strong></label> <input class=" w3-input w3-border-0" type="text" name="user">
					<br><br>
					<label class="w3-text-theme"><strong>Password:</strong></label> <input class=" w3-input w3-border-0" type="password" name="pass">
					<br><br>
					<input class="w3-btn w3-hover-theme w3-theme-d3" type="submit" name="submit" value="Submeter">
			</form>	
		</div>	

