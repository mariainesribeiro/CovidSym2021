         
         <?php
             if($_SESSION['authuser'] == 1){
                 echo '<div class="w3-display-topmiddle w3-container w3-panel w3-green"> <h3>O login foi efetuado com sucesso!</h3></div>';
                 
             }
             else{
                  echo "<div class = 'w3-display-topmiddle w3-container w3-panel w3-red'> <h3>Login sem sucesso!</h3><br>";
                  echo "<a href='index.php?op=sLogin'><center><button class='w3-button w3-small w3-round w3-theme-l5' style='color:#003E63'><strong><span style ='color:red'>Tentar de novo</span></strong></button><center></a><br></div>";

             }
         ?>
