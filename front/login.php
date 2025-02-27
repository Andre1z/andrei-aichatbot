<?php
session_start();
$conn = new mysqli("localhost", "chatbot", "Labapiciorului.1", "chatbot");

$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];

$stmt = $conn->prepare("SELECT contrasena FROM usuarios WHERE nombre_usuario=?");
$stmt->bind_param("s", $nombre_usuario);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($hash);
$stmt->fetch();

if (password_verify($contrasena, $hash)) {
    $_SESSION['usuario'] = $nombre_usuario;
    echo json_encode(["status" => "success", "usuario" => $nombre_usuario]);
} else {
    echo json_encode(["status" => "error", "mensaje" => "Acceso denegado"]);
}
?>