<?php
include "config.php"; 
include "Corretor.php"; 

$corretor = new Corretor($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = trim($_POST['cpf']);
    $creci = trim($_POST['creci']);
    $name = trim($_POST['name']);

    if ($corretor->cadastrar($cpf, $creci, $name)) {
        echo "Corretor cadastrado com sucesso!";
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao cadastrar corretor!";
    }
}

$conn->close();
?>


