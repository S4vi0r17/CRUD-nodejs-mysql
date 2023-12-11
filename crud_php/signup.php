<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="src/css/normalize.css">
    <link rel="stylesheet" href="src/css/styles.css">
</head>

<body>

<?php
// Para mostrar los errores de PHP
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require('./connection.php');

if (isset($_POST['signup_button'])) {
    $name = $_POST['Name'];
    $lastname = $_POST['LastName'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $confirmpassword = $_POST['ConfirmPassword'];

    if (!empty($name) && !empty($lastname) && !empty($email) && !empty($password) && !empty($confirmpassword)) {
        if ($password === $confirmpassword) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // El password_hash devuelve un string de 60 caracteres, ese fue el error

            $pdo = Crud::Connect();
            if ($pdo) {
                $stmt = $pdo->prepare("INSERT INTO crudtable (username, lastName, email, pass) VALUES (:name, :lastname, :email, :password)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':lastname', $lastname);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashed_password);
                
                if ($stmt->execute()) {
                    echo "Usuario registrado correctamente";
                } else {
                    $errorInfo = $stmt->errorInfo();
                    echo "Error al registrar el usuario: " . $errorInfo[2];
                }
            } else {
                echo "No se pudo conectar a la base de datos.";
            }
        } else {
            echo "Las contraseñas no coinciden";
        }
    } else {
        echo "Por favor, completa todos los campos";
    }
}
?>

    <div class="container">
        <form class="form" method="post">
            <label class="title" for="">Sign Up</label>
            <input type="text" name="Name" placeholder="Name">
            <input type="text" name="LastName" placeholder="Last name">
            <input type="email" name="Email" placeholder="Email">
            <input type="password" name="Password" placeholder="Password">
            <input type="password" name="ConfirmPassword" placeholder="Confirm password">

            <input type="submit" value="Sign Up" name="signup_button">
        </form>
    </div>

</body>

</html>