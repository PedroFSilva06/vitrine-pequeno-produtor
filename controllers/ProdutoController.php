<?php
require_once 'config/Database.php';
require_once 'models/Produto.php';

class ProdutoController {
    
    public function index() {
        $database = new Database();
        $produto = new Produto($database->getConnection());
        $termo = isset($_GET['busca']) ? $_GET['busca'] : "";
        $stmt = $produto->lerTodos($termo);
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include 'views/home.php';
    }

    public function dashboard() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?acao=login");
            exit;
        }

        $database = new Database();
        $produto = new Produto($database->getConnection());
        $termo = isset($_GET['busca']) ? $_GET['busca'] : "";
        $stmt = $produto->lerPorUsuario($_SESSION['usuario_id'], $termo);
        $meusProdutos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include 'views/dashboard.php';
    }

    public function salvar() {
        if ($_POST && isset($_SESSION['usuario_id'])) {
            $database = new Database();
            $produto = new Produto($database->getConnection());

            $whatsappAutomatico = isset($_SESSION['usuario_whatsapp']) ? $_SESSION['usuario_whatsapp'] : '';

            $produto->criar(
                $_POST['nome'], 
                $_POST['descricao'], 
                $_POST['preco'], 
                $whatsappAutomatico, 
                $_POST['categoria'], 
                $_POST['imagem_url'],
                $_SESSION['usuario_id']
            );
            header("Location: index.php?acao=dashboard&msg=sucesso");
        }
    }

    public function editar() {
        if ($_POST && isset($_SESSION['usuario_id'])) {
            $database = new Database();
            $produto = new Produto($database->getConnection());

            // PEGA O WHATSAPP AUTOMÁTICO DA SESSÃO (Caso o usuário tenha mudado no perfil)
            $whatsappAutomatico = isset($_SESSION['usuario_whatsapp']) ? $_SESSION['usuario_whatsapp'] : '';

            $produto->atualizar(
                $_POST['id'],
                $_POST['nome'], 
                $_POST['descricao'], 
                $_POST['preco'], 
                $whatsappAutomatico, 
                $_POST['categoria'], 
                $_POST['imagem_url']
            );
            header("Location: index.php?acao=dashboard&msg=sucesso");
        }
    }

    public function excluir() {
        if (isset($_GET['id'])) {
            $database = new Database();
            $produto = new Produto($database->getConnection());
            $produto->excluir($_GET['id']);
            header("Location: index.php?acao=dashboard&msg=deletado");
        }
    }
}
?>