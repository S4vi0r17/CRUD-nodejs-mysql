<?php

class Crud
{
    public static function Connect()
    {
        try {
            $connection = new PDO("mysql:host=localhost;dbname=crud_php", "root", "benites1234");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        } catch (PDOException $e) {
            echo "No se pudo conectar " . $e->getMessage();
            return null;
        }
    }

    public static function SelectData()
    {
        $query = "SELECT * FROM crudtable";
        try {
            $connection = Crud::Connect();
            $result = $connection->prepare($query);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "No se pudo obtener los datos " . $e->getMessage();
            return null;
        }
    }

    public static function DeleteData($id)
    {
        $query = "DELETE FROM crudtable WHERE id = :id";
        try {
            $connection = Crud::Connect();
            $result = $connection->prepare($query);
            $result->bindParam(':id', $id);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "No se pudo obtener los datos " . $e->getMessage();
            return null;
        }
    }

    public static function UpdateData($id, $name, $lastname, $email, $password) {
        $query = "UPDATE crudtable SET username = :username, lastName = :lastName, email = :email, pass = :pass WHERE id = :id";
        try {
            $connection = Crud::Connect();
            $result = $connection->prepare($query);
            $result->bindParam(':id', $id);
            $result->bindParam(':username', $name);
            $result->bindParam(':lastName', $lastname);
            $result->bindParam(':email', $email);
            $result->bindParam(':pass', $password);
            $result->execute();
            return true;
        } catch (PDOException $e) {
            echo "No se pudo actualizar los datos " . $e->getMessage();
            return false;
        }
    }
}

// Verificar si se conectó a la base de datos
// $pdo = Crud::Connect();
// if ($pdo) {
//     echo "Conectado a la base de datos";
// } else {
//     echo "No se pudo conectar a la base de datos";
// }