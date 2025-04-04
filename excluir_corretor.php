<?php
include "config.php";
include "Corretor.php";

$corretor = new Corretor($conn);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($corretor->excluir($id)) {
        echo "Corretor excluído com sucesso!";
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao excluir corretor!";
    }
} else {
    echo "ID não informado!";
}

$conn->close();
?>
