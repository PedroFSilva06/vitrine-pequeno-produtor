<?php
require_once 'config/Database.php';
require_once 'models/Usuario.php';

class AuthController {
    
    public function login() { include 'views/login.php'; }
    public function cadastro() { include 'views/cadastro.php'; }

    public function logar() {
        $database = new Database();
        $userModel = new Usuario($database->getConnection());
        
        $usuario = $userModel->login($_POST['email'], $_POST['senha']);
        
        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_foto'] = $usuario['foto_perfil'];
            $_SESSION['usuario_whatsapp'] = $usuario['whatsapp']; // Guardamos na sessão também
            
            header("Location: index.php?acao=dashboard&msg=login_sucesso");
        } else {
            header("Location: index.php?acao=login&msg=erro_login");
        }
    }

    public function salvarUsuario() {
        $database = new Database();
        $userModel = new Usuario($database->getConnection());
        
        $foto = !empty($_POST['foto']) ? $_POST['foto'] : "https://ui-avatars.com/api/?name=".$_POST['nome']."&background=random";
        
        if($userModel->cadastrar($_POST['nome'], $_POST['email'], $_POST['senha'], $foto, $_POST['whatsapp'])){
            header("Location: index.php?acao=login&msg=cadastro_sucesso");
        } else {
            header("Location: index.php?acao=cadastro&msg=erro_cadastro");
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?msg=logout_sucesso");
    }
}
?>