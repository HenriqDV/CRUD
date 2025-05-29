<?php
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$mysqli = new mysqli("localhost:3307", "root", "", "escola");

if ($mysqli->connect_errno) {
    die("Erro ao conectar: " . $mysqli->connect_error);
}

$id = intval($_GET['id']);
$mysqli->query("DELETE FROM alunos WHERE id = $id");

header("Location: index.php");
exit;
?>