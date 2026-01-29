<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

$base_path = 'http://localhost/nova_academia/'; 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia Pro</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<header>
    <a href="index.php" class="logo">ACADEMIA <span>PRO</span></a>
    
    <div class="menu-icon" onclick="toggleMenu()">
        <i class="fas fa-bars"></i>
    </div>

    <nav class="nav-menu" id="navMenu">
        <a href="index.php">Início</a>
        <a href="equipe.php">Professores</a>
        <a href="loja_contato.php">Loja</a>

        <?php if (isset($_SESSION['usuario_id'])): ?>
            <?php 
                if (!isset($pdo)) require_once __DIR__ . '/../config/database.php';
                
                try {
                    $stmt = $pdo->prepare("SELECT nivel FROM alunos WHERE id = ?");
                    $stmt->execute([$_SESSION['usuario_id']]);
                    $user = $stmt->fetch();
                    
                    if($user && $user['nivel'] == 'admin'): 
            ?>
                    <a href="admin_painel.php" style="color:#ffcc00;">Admin</a>
            <?php endif; } catch(Exception $e){} ?>

            <a href="painel.php" class="active">Painel</a>
            <a href="logout.php" style="color:var(--danger)">Sair</a>
        <?php else: ?>
            <a href="login.php" class="btn-cta" style="padding: 5px 20px; font-size: 0.9rem;">Entrar</a>
        <?php endif; ?>
    </nav>
</header>

<script>
    function toggleMenu() {
        var menu = document.getElementById("navMenu");
        menu.classList.toggle("active");
    }
</script>