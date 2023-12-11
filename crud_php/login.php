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
    session_start(); // Asegúrate de iniciar la sesión antes de usar $_SESSION

    require('./connection.php');

    if (isset($_POST['login_button'])) {

        $_SESSION['validate'] = false;

        $email = $_POST['Email'];
        $password = $_POST['Password'];

        $pdo = Crud::Connect()->prepare("SELECT * FROM crudtable WHERE email = :email");
        $pdo->bindParam(':email', $email);
        $pdo->execute();

        $selectData = $pdo->fetch(PDO::FETCH_ASSOC);

        if ($selectData && password_verify($password, $selectData['pass'])) {
            $_SESSION['validate'] = true;
            $_SESSION['email'] = $email; // Guarda el email en la sesión
            echo "Usuario logueado correctamente";
            header('Location: ./index.php');
        } else {
            echo "Usuario o contraseña incorrectos";
        }
    }
    ?>


    <div class="container">
        <form class="form" method="post"> <!-- Corregido el método de envío -->
            <label class="title" for="">Log In</label>
            <input type="email" name="Email" placeholder="Email">
            <input type="password" name="Password" placeholder="Password">
            <input type="submit" value="Login" name="login_button">
        </form>
    </div>

</body>

</html>