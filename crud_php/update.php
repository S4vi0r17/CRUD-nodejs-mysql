<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="src/css/normalize.css">
    <link rel="stylesheet" href="src/css/styles.css">
</head>

<body>

    <?php
    require('./connection.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['Name'];
        $lastname = $_POST['LastName'];
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $confirmpassword = $_POST['ConfirmPassword'];

        if (!empty($name) && !empty($lastname) && !empty($email) && !empty($password) && !empty($confirmpassword)) {
            if ($password === $confirmpassword) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $pdo = Crud::Connect();
                if ($pdo) {

                    $id = $_POST['id'];

                    $stmt = $pdo->prepare("UPDATE crudtable SET username = :name, lastName = :lastname, email = :email, pass = :password WHERE id = :id");
                    $stmt->bindParam(':id', $id);
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':lastname', $lastname);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':password', $hashed_password);

                    if ($stmt->execute()) {
                        echo "Usuario actualizado correctamente";
                    } else {
                        $errorInfo = $stmt->errorInfo();
                        echo "Error al actualizar el usuario: " . $errorInfo[2];
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
        <form class="form" method="post" action="update.php">
            <label class="title" for="">Update User</label>
            <input type="text" name="Name" placeholder="Name">
            <input type="text" name="LastName" placeholder="Last name">
            <input type="email" name="Email" placeholder="Email">
            <input type="password" name="Password" placeholder="Password">
            <input type="password" name="ConfirmPassword" placeholder="Confirm password">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"> <!-- Campo oculto con el ID -->

            <input type="submit" value="Update" name="signup_button">
        </form>
    </div>

</body>

</html>