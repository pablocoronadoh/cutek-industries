<?php 
  if(isset($_POST['email'])) { 
      $email_to = "antonio@disblu.com";
      $emailSubject = "Nuevo contacto Web Cutek Industries";
      
      function died($error) {
          die($error); 
      }
   
      if(empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['email'])) { 
          died('Por favor, llena todos los campos.'); 
      }     
   
      $name = $_POST['name'];
      $email_from = $_POST['email'];
      $phone = $_POST['phone'];
      $subject = $_POST['subject'];
      $message = $_POST['message'];
      $error_message = "";
      $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

   
      if(!preg_match($email_exp,$email_from)) { 
        $error_message .= 'El correo que pusiste no parece válido.'; 
      } 
      $string_exp = "/^[A-Za-z .'-]+$/"; 
      if(!preg_match($string_exp,$name)) {   
        $error_message .= 'El nombre que pusiste no parece válido.';   
      }      
   
      if(strlen($error_message) > 0) {   
        died($error_message);   
      }
   
    $email_message = "Información de contacto Web: \n\n";

    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }

    $email_message .= "Nombre: ".clean_string($name)."\n";
    $email_message .= "Correo electrónico: ".clean_string($email_from)."\n";
    $email_message .= "Teléfono: ".clean_string($phone)."\n";
    $email_message .= "Asunto: ".clean_string($subject)."\n";
    $email_message .= "Mensaje: ".clean_string($message)."\n";    
    
    $headers = 'From: '.$email_from."\r\n".
    'Reply-To: '.$email_from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $emailSubject, $email_message, $headers);
    echo "Contacto enviado exitosamente.";    
  } 
?>