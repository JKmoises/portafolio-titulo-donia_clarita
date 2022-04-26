<?php 
namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
  public $email;
  public $nombre;
  public $token;
  
  public function __construct( $email,$nombre,$token){
    $this->email = $email;
    $this->nombre = $nombre;
    $this->token = $token;
  }

  //? Envía la confirmación del email 
  public function enviarConfirmacion(){
    //* Crear Objeto de email
    $mail = new PHPMailer();

    //? Configurando SMTP que es el protocolo para envio de emails
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io'; # Como host se utilizar mailtrap
    $mail->SMTPAuth = true; # Con true estamos diciendo que nos autenticaremos con mailtrap
    $mail->Username = '3ea932d38da0c2'; # Usando usuario que proporciona mailtrap
    $mail->Password = '12a5cc3a3a9f83'; # Usando password que proporciona mailtrap
    //* tls(Transport Layer Security) que se traduce como seguridad de la capa de transporte 
    $mail->SMTPSecure = 'tls'; # Permite que los emails se envíen por un tunel seguro en la red
    $mail->Port = 2525; # Definiendo puerto del host

    //? Configurando el contenido del email

    # Establece el email que nos contactará en el formulario de contacto
    $mail->setFrom('cuentas@donaclarita.com'); 
    # Establece el mail en donde se enviará el formulario de contacto y el nombre del email
    $mail->addAddress('moi.prado20@gmail.com','DonaClarita.com');
    # Establece la cabecera del email que se enviará  
    $mail->Subject = 'Confirma tu cuenta';

    //? Habilitando HTML
    $mail->isHTML(true); # Activa código HTML para que se pueda escribir en un email 
    $mail->CharSet = 'UTF-8'; # Activa los caracteres de codificación UTF-8 para escribir simbolos

    //? Definiendo contenido HTML para el cuerpo principal del email
    $contenido = "
      <html>
        <p>
          <strong>Hola {$this->nombre}</strong>
          Has creado tu cuenta en DoñaClarita, solo debes confirmarla presionando el siguiente enlace
        </p>
        
        <p>
          Presiona aquí 
          <a href='http://localhost:3000/confirmar-cuenta?token={$this->token}'>Confirmar Cuenta</a>
        </p>

        <p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje</p>
      </html>
    ";
    $mail->Body = $contenido; # Establece el cuerpo del email que se enviará

    //? Enviando email
    $mail->send();
  }
}