<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

            require('./connection.php');
            $p = Crud::SelectData();
            
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $pdo = Crud::DeleteData($id);
            }


            if (count($p) > 0) {
                for ($i = 0; $i < count($p); $i++) {
                    echo '<tr>';
                    foreach ($p[$i] as $key => $value) {
                        if ($key != 'id') {
                            echo '<td>' . $value . '</td>';
                        }
                    }

                    ?>
                    <td>
                        <a href="update.php?id=<?php echo $p[$i]['id'] ?>">🆙</a>
                        <a href="users.php?id=<?php echo $p[$i]['id'] ?>">Trash</a>
                    </td>
                    <?php

                    echo '</td>';
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>