<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'config/database.php';

$id = $_SESSION['usuario_id'];
$sql = "SELECT a.*, p.nome as nome_plano, p.preco 
        FROM alunos a 
        JOIN planos p ON a.plano_id = p.id 
        WHERE a.id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$dados_aluno = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Aluno</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>

        .dashboard { padding: 50px 20px; max-width: 1200px; margin: 0 auto; }
        .welcome-msg { font-size: 2rem; margin-bottom: 30px; }
        .grid-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        
        .card-info {
            background: #1e1e1e;
            padding: 30px;
            border-radius: 10px;
            border-left: 5px solid #00ff88;
            }
        .card-info h3 { color: #aaa; font-size: 0.9rem; text-transform: uppercase; margin-bottom: 10px; }
        .card-info .valor { font-size: 1.5rem; font-weight: bold; color: #fff; }
        .btn-logout { 
            background: transparent; border: 1px solid #ff4444; color: #ff4444; 
            padding: 5px 15px; text-decoration: none; border-radius: 5px; font-size: 0.9rem;
        }
        .btn-logout:hover { background: #ff4444; color: #fff; }
    </style>
</head>
<body>
    <header>
        <h1>ÁREA DO <span>ALUNO</span></h1>
        <a href="logout.php" class="btn-logout">Sair do Sistema</a>
    </header>

    <div class="dashboard">
        <h2 class="welcome-msg">Olá, <span style="color:#00ff88;"><?php echo $dados_aluno['nome']; ?></span>!</h2>
        
        <div class="grid-cards">
            <div class="card-info">
                <h3>Seu Plano Atual</h3>
                <div class="valor"><?php echo $dados_aluno['nome_plano']; ?></div>
                <small>Mensalidade: R$ <?php echo number_format($dados_aluno['preco'], 2, ',', '.'); ?></small>
            </div>

            <div class="card-info">
                <h3>Status da Matrícula</h3>
                <div class="valor" style="color: #00ff88;">ATIVO</div>
                <small>Desde <?php echo date('d/m/Y', strtotime($dados_aluno['data_cadastro'])); ?></small>
            </div>

            <div class="card-info" style="border-left-color: #fff;">
                <h3>Treino de Hoje</h3>
                <div class="valor">Peito e Tríceps</div>
                <button style="margin-top:10px; padding:5px 10px; background:#00ff88; border:none; cursor:pointer;">Ver Ficha</button>
            </div>
        </div>
    </div>
</body>
</html>
