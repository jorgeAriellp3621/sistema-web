<?php
require_once "config/database.php";

$username = mysqli_real_escape_string($mysqli,stripslashes(strip_tags(htmlspecialchars(trim($_POST['username'])))));
$password = md5(mysqli_real_escape_string($mysqli,stripslashes(strip_tags(htmlspecialchars(trim($_POST['password']))))));

if(!ctype_alnum($username) OR !ctype_alnum($password)) {
header("location: index.php?alert=1");

}else{
    $query=mysqli_query($mysqli, "SELECT *FROM usuarios  WHERE username ='$username' AND password='$password' AND status='activo'")
    or die('error'.mysqli_error($mysqli));

    $rows=mysqli_num_rows($query);
    // Código previo a esta sección para conexión y consulta de base de datos
if ($rows > 0) {
    // Obtener los datos del usuario
    $data = mysqli_fetch_assoc($query);

    // Iniciar sesión
    session_start();
    
    // Almacenar datos en la sesión
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['password'] = $data['password']; // Aunque puedes evitar almacenar contraseñas en la sesión por seguridad
    $_SESSION['name_user'] = $data['name_user'];
    $_SESSION['permisos_acceso'] = $data['permisos_acceso'];

    // Redirigir a la página principal
    header("Location: main.php?module=start");
    exit(); // Asegúrate de usar exit después de header para detener la ejecución
} else {
    // Opcional: Redirigir a la página de inicio de sesión con un mensaje de error
    header("Location: index.php?alert=1");
    exit();
}

}

?>