<?php  echo validation_errors();
      
      echo "ახალი პაროლი :".form_password('password', '');
      echo "გაიმეორეთ პაროლი :".form_password('passconf', '');
      echo form_submit('submit', 'გაგზავნა');    
?>