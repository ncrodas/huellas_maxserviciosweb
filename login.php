<?php
// login.php: Maneja el inicio de sesión de usuarios

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        echo json_encode(["message" => "Autenticación satisfactoria"]);
    } else {
        echo json_encode(["error" => "Error en la autenticación"]);
    }
} else {
    echo json_encode(["error" => "Método de solicitud no permitido"]);
}
?>