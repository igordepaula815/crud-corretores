<?php
class Corretor {
    private $conn;

    // Construtor - Conexão com o banco de dados
    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Método para cadastrar corretor
    public function cadastrar($cpf, $creci, $name) {
        try {
            // Validação dos dados
            if (!$this->validarDados($cpf, $creci, $name)) {
                return false;
            }

            $sql = "INSERT INTO corretores (cpf, creci, name) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $cpf, $creci, $name);

            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erro ao cadastrar corretor: " . $e->getMessage());
            return false;
        }
    }

    // Método para editar corretor
    public function editar($id, $cpf, $creci, $name) {
        try {
            if (!$this->validarDados($cpf, $creci, $name)) {
                return false;
            }

            $sql = "UPDATE corretores SET cpf=?, creci=?, name=? WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssi", $cpf, $creci, $name, $id);

            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erro ao editar corretor: " . $e->getMessage());
            return false;
        }
    }

    // Método para excluir corretor
    public function excluir($id) {
        try {
            $sql = "DELETE FROM corretores WHERE id=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erro ao excluir corretor: " . $e->getMessage());
            return false;
        }
    }

    // Método para buscar todos os corretores
    public function listar() {
        $sql = "SELECT * FROM corretores";
        return $this->conn->query($sql);
    }

    // Método para buscar corretor pelo ID
    public function buscarPorId($id) {
        $sql = "SELECT * FROM corretores WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Método para validar os dados
    private function validarDados($cpf, $creci, $name) {
        if (!preg_match('/^[0-9]{11}$/', $cpf)) {
            echo "Erro: O CPF deve conter exatamente 11 números.";
            return false;
        }
        if (!preg_match('/^[0-9]{2,10}$/', $creci)) {
            echo "Erro: O CRECI deve conter entre 2 e 10 números.";
            return false;
        }
        if (strlen($name) < 3 || strlen($name) > 100) {
            echo "Erro: O nome deve ter entre 3 e 100 caracteres.";
            return false;
        }
        return true;
    }
}
?>
