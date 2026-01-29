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
$aluno = $stmt->fetch();

require_once 'includes/header.php';
?>

<div style="max-width: 1200px; margin: 40px auto; padding: 0 20px;">
    <h2 style="margin-bottom: 20px;">Bem-vindo, <span style="color:var(--primary-color)"><?php echo htmlspecialchars($aluno['nome']); ?></span></h2>
    <div class="grid-container" style="padding: 0;">
        <div class="card" style="text-align: left;">
            <h3 style="font-size: 0.9rem; color: #666; text-transform: uppercase;">Situação</h3>
            <div style="font-size: 1.5rem; font-weight: bold; color: <?php echo ($aluno['status'] == 'ativo') ? 'var(--primary-color)' : 'var(--danger)'; ?>">
                <?php echo strtoupper($aluno['status']); ?>
            </div>
            <p style="font-size: 0.8rem; color: #888; margin-top: 5px;">Membro desde <?php echo date('d/m/Y', strtotime($aluno['created_at'])); ?></p>
        </div>

        <div class="card" style="text-align: left;">
            <h3 style="font-size: 0.9rem; color: #666; text-transform: uppercase;">Seu Plano</h3>
            <div style="font-size: 1.5rem; color: #fff;"><?php echo htmlspecialchars($aluno['nome_plano']); ?></div>
            <p style="font-size: 0.8rem; color: #888; margin-top: 5px;">Mensalidade: R$ <?php echo number_format($aluno['preco'], 2, ',', '.'); ?></p>
        </div>

        <div class="card" style="text-align: left; border-color: var(--primary-color);">
            <h3 style="font-size: 0.9rem; color: #666; text-transform: uppercase;">Treino de Hoje</h3>
            <div style="font-size: 1.2rem; color: #fff;">Série A - Superiores</div>
            <a href="meu_treino.php" class="btn-cta" style="display:inline-block; margin-top: 15px; padding: 10px 20px; font-size: 0.8rem; border: none; cursor: pointer; color: #000;">Visualizar Ficha</a>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>