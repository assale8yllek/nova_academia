<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost/nova_academia/');
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia Pro | Alta Performance</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <a href="index.php" class="logo">ACADEMIA <span>PRO</span></a>
        <nav>
            <a href="index.php">Início</a>
            <?php if (isset($_SESSION['usuario_id'])): ?>
                <a href="painel.php" class="active">Meu Painel</a>
                <a href="logout.php" style="color: var(--danger);">Sair</a>
            <?php else: ?>
                <a href="index.php#planos">Planos</a>
                <a href="login.php" class="btn-login">Entrar</a>
            <?php endif; ?>
        </nav>
    </header>