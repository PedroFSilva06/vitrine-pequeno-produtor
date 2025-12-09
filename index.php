<?php
session_start(); 

require_once 'controllers/ProdutoController.php';
require_once 'controllers/AuthController.php';

$produtoCtrl = new ProdutoController();
$authCtrl = new AuthController();

$acao = isset($_GET['acao']) ? $_GET['acao'] : 'index';

switch ($acao) {
    case 'login':
        $authCtrl->login();
        break;
    case 'logar':
        $authCtrl->logar();
        break;
    case 'editar':        
        $produtoCtrl->editar();
        break;
    case 'cadastro':
        $authCtrl->cadastro();
        break;
    case 'salvar_usuario':
        $authCtrl->salvarUsuario();
        break;
    case 'logout':
        $authCtrl->logout();
        break;
    case 'dashboard':
        $produtoCtrl->dashboard();
        break;
    case 'salvar':
        $produtoCtrl->salvar();
        break;
    case 'excluir':
        $produtoCtrl->excluir();
        break;
    default:
        $produtoCtrl->index();
        break;
}
?>