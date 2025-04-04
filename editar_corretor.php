<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM corretores WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Corretor não encontrado!";
        exit;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cpf = $_POST['cpf'];
    $creci = $_POST['creci'];
    $name = $_POST['name'];

    $sql = "UPDATE corretores SET cpf='$cpf', creci='$creci', name='$name' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Corretor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Editar Corretor</h2>
        <form method="POST">
            <div class="input-group">
                <label>CPF:</label>
                <input type="text" name="cpf" value="<?= isset($row['cpf']) ? $row['cpf'] : '' ?>" required>
            </div>

            <div class="input-group">
                <label>CRECI:</label>
                <input type="text" name="creci" value="<?= isset($row['creci']) ? $row['creci'] : '' ?>" required>
            </div>

            <div class="input-group">
                <label>Nome:</label>
                <input type="text" name="name" value="<?= isset($row['name']) ? $row['name'] : '' ?>" required>
            </div>

            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>

