<?php
require 'vendor/autoload.php'; // Incluir PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Configuración de la base de datos
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = ""; // Si tienes una contraseña, cámbiala
$dbName = "sistemaweb";

// Verificar si se ha recibido el correo
if (isset($_POST['email']) && !empty($_POST['email'])) {
    $email = trim($_POST['email']);

    try {
        // Conexión a la base de datos usando PDO
        $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consultar si el correo existe
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            header("Location: recuperar_contraseña.php?alert=1"); // Redirigir si no se encuentra
            exit();
        }

        // Obtener los datos del usuario
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Generar una nueva contraseña y encriptarla
        $nuevaClave = substr(md5(uniqid(mt_rand(), true)), 0, 8); // Clave aleatoria de 8 caracteres
        $claveEncriptada = md5($nuevaClave);

        // Actualizar la contraseña en la base de datos
        $updateSql = "UPDATE usuarios SET password = :password WHERE email = :email";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->bindParam(':password', $claveEncriptada, PDO::PARAM_STR);
        $updateStmt->bindParam(':email', $email, PDO::PARAM_STR);
        $updateStmt->execute();

        // Configurar y enviar el correo con PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'jorgearielbrizuela290@gmail.com'; // Cambia por tu correo
            $mail->Password = 'brbz bfwi xesy ehbo';  // Contraseña de aplicación
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configurar remitente y destinatario
            $mail->setFrom('jorgearielbrizuela290@gmail.com', 'Administrador');
            $mail->addAddress($email, $usuario['name_user']);

            // Configuración del mensaje
            $mail->CharSet = 'UTF-8'; // Establecer codificación UTF-8
            $mail->isHTML(true);
            $mail->Subject = "Recuperación de Contraseña";
            $mail->Body = "
            <h3>Hola, {$usuario['name_user']}</h3>
            <p>Se ha generado una nueva contraseña para tu cuenta.</p>
            <p><strong>Nueva Contraseña:</strong> {$nuevaClave}</p>
            <p>Por favor, inicia sesión y cambia tu contraseña lo antes posible.</p>";

            $mail->send();

            header("Location: index.php?alert=4"); // Éxito
            exit();
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    } catch (PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
} else {
    header("Location:formRecuperarClave.php?error=2"); // Error si no se recibe correo
    exit();
}
?>
