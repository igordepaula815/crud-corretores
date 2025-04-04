<?php
include "config.php"; // Arquivo de conexão com o banco

$sql = "SELECT * FROM corretores";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['cpf']}</td>
                    <td>{$row['creci']}</td>
                <td>{$row['name']}</td>
                <td>
                    <a href='editar_corretor.php?id={$row['id']}' class='btn btn-primary btn-sm'>Editar</a>
                    <a href='excluir_corretor.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>Nenhum corretor cadastrado.</td></tr>";
}

$conn->close();
?>


