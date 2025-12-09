<?php
class Usuario {
    private $conn;
    private $table = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function cadastrar($nome, $email, $senha, $foto, $whatsapp) {
        $query = "INSERT INTO " . $this->table . " (nome, email, senha, foto_perfil, whatsapp) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        return $stmt->execute([$nome, $email, $senhaHash, $foto, $whatsapp]);
    }

    public function login($email, $senha) {
        $query = "SELECT * FROM " . $this->table . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            return $user;
        }
        return false;
    }
}
?>