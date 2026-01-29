<?php
session_start();
require_once 'config/database.php';

if (!isset($_SESSION['usuario_id'])) { header("Location: login.php"); exit; }

$stmt = $pdo->prepare("SELECT nivel FROM alunos WHERE id = ?");
$stmt->execute([$_SESSION['usuario_id']]);
$user = $stmt->fetch();

if ($user['nivel'] !== 'admin') {
    die("Acesso Negado. Apenas professores podem acessar esta área.");
}

require_once 'includes/header.php';

$alunos = $pdo->query("SELECT * FROM alunos ORDER BY nome ASC")->fetchAll();
?>

<div class="container-small" style="max-width: 800px;">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <h2>Painel do <span style="color:var(--primary-color)">Professor</span></h2>
        <a href="painel.php" class="btn-cta" style="font-size:0.8rem; padding:10px;">Voltar</a>
    </div>
    
    <div class="card" style="margin-top:20px; text-align:left;">
        <h3 style="color:#fff; margin-bottom:20px;">Gerenciar Alunos</h3>
        <table class="table-treino">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Plano</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
<tbody>
    <?php foreach ($alunos as $aluno): ?>
                <tr>
                    <td><?php echo htmlspecialchars($aluno['nome']); ?></td>
                    <td>ID: <?php echo $aluno['plano_id']; ?></td> <td>
                        <span style="color: <?php echo $aluno['status'] == 'ativo' ? 'var(--primary-color)' : 'red'; ?>">
                            <?php echo ucfirst($aluno['status']); ?>
                        </span>
                    </td>
                    <td>
                        <a href="#" style="color:var(--primary-color); text-decoration:none;">Criar Treino</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>