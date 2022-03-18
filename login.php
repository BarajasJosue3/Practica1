<?php

session_start();

require 'database.php';

if (!empty($_POST['Email']) && !empty($_POST['Password'])){

    $records = $conn->prepare('SELECT id, email, password FROM registro WHERE email=:email');
    $records->bindParam(':email',$_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if(count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];
        header('Location: /php.login');


    } else {
        $message = 'Lo sentimos estas credenciales no coinciden';
    }

}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/Style.css">
</head>

<body>

<?php require 'partials/header.php' ?>

<h1>Registro</h1> 

<span>or <a href="registro.php">Registro</a></span>

<?php if (!empty($message)) : ?>
     <p><?=$message ?></p>
<?php endif; ?>

<form action="login.php" method="post">
    <input type="text" name="nom" placeholder = "Nombre" requerid>
    <input type="text" name="Ap" placeholder = "Apellido Paterno" requerid>
    <input type="text" name="Am" placeholder = "Apellido Materno" requerid>
    <input type="Email" name="Email" placeholder = "Email" requerid>
    <input type="text" name="User" placeholder = "Usuario" requerid>
    <input type="Password" name="Pass" placeholdr = "Password" requerid>
    <input type="submit" name="registrar" value="registrar">
</form>


</body>
</html>