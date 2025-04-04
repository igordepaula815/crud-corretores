<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Corretor</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validarFormulario(event) {
            event.preventDefault();

            let cpf = document.querySelector("[name='cpf']").value.trim();
            let creci = document.querySelector("[name='creci']").value.trim();
            let name = document.querySelector("[name='name']").value.trim();
            let erroMsg = "";

            if (cpf.length !== 11 || isNaN(cpf)) {
                erroMsg += "O CPF deve ter exatamente 11 números.\n";
            }
            if (creci.length < 2) {
                erroMsg += "O CRECI deve ter pelo menos 2 caracteres.\n";
            }
            if (name.length < 2) {
                erroMsg += "O Nome deve ter pelo menos 2 caracteres.\n";
            }

            if (erroMsg !== "") {
                alert(erroMsg);
                return false;
            }

            document.querySelector("form").submit();
        }

        function carregarCorretores() {
            fetch('listar_corretores.php')
                .then(response => response.text())
                .then(data => {
                    document.getElementById("tabela-corretores").innerHTML = data;
                })
                .catch(error => console.error('Erro ao buscar os corretores:', error));
        }

        document.addEventListener("DOMContentLoaded", carregarCorretores);
    </script>
</head>
<body>
    <div class="container">
        <form action="cadastro.php" method="POST" onsubmit="return validarFormulario(event)">
            <h2>Cadastro de Corretor</h2>
            <div class="input-group">
                <input type="text" name="cpf" placeholder="Digite seu CPF" required>
                <input type="text" name="creci" placeholder="Digite seu Creci" required>
            </div>
            <input type="text" name="name" placeholder="Digite seu nome" required>
            <button type="submit">Enviar</button>
        </form>

        <h2>Lista de Corretores</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CPF</th>
                    <th>CRECI</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody id="tabela-corretores">
                <tr><td colspan="4">Carregando...</td></tr>
            </tbody>
        </table>
    </div>
</body>
</html>


       