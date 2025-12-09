<?php
class Produto {
    private $conn;
    private $table = "produtos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function lerTodos($termo = "") {
        $query = "SELECT p.*, u.nome as vendedor, u.email as email_vendedor, u.foto_perfil as foto_vendedor 
                  FROM " . $this->table . " p 
                  LEFT JOIN usuarios u ON p.usuario_id = u.id";
        
        if(!empty($termo)){
            $query .= " WHERE p.nome LIKE :termo OR p.categoria LIKE :termo";
        }
        $query .= " ORDER BY p.id DESC";
        
        $stmt = $this->conn->prepare($query);
        if(!empty($termo)){
            $termo = "%{$termo}%";
            $stmt->bindParam(':termo', $termo);
        }
        $stmt->execute();
        return $stmt;
    }

    public function lerPorUsuario($usuario_id, $termo = "") {
        $query = "SELECT * FROM " . $this->table . " WHERE usuario_id = :uid";
        if(!empty($termo)){
            $query .= " AND (nome LIKE :termo OR categoria LIKE :termo)";
        }
        $query .= " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':uid', $usuario_id);
        if(!empty($termo)){
            $termo = "%{$termo}%";
            $stmt->bindParam(':termo', $termo);
        }
        $stmt->execute();
        return $stmt;
    }

    public function criar($nome, $desc, $preco, $contato, $cat, $img, $usuario_id) {
        $query = "INSERT INTO " . $this->table . " (nome, descricao, preco, contato, categoria, imagem_url, usuario_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nome, $desc, $preco, $contato, $cat, $img, $usuario_id]);
    }

    public function atualizar($id, $nome, $desc, $preco, $contato, $cat, $img) {
        $query = "UPDATE " . $this->table . " SET nome=?, descricao=?, preco=?, contato=?, categoria=?, imagem_url=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$nome, $desc, $preco, $contato, $cat, $img, $id]);
    }

    public function excluir($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>