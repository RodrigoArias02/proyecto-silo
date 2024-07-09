<?php
if(isset($_POST['enviar'])){
    if(!empty('email')){
        $mensaje="usted se ha registrado en usuarios inicio seguro";
        $email=$_POST['form_email'];
        $header="From:norely@example.com"."\r\n";
        $header="Reply-To:$email"."\r\n";
        $mail=@mail($email,$mensaje,$header);
    }
if($email){
    echo "enviado";
}
}
?>