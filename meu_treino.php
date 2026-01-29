<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'config/database.php';
require_once 'includes/header.php';

$aluno_id = $_SESSION['usuario_id'];

$stmt = $pdo->prepare("SELECT * FROM fichas WHERE aluno_id = ? ORDER BY id DESC");
$stmt->execute([$aluno_id]);
$fichas = $stmt->fetchAll();
?>

<div style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">
    
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:30px;">
        <h2>Meus <span style="color:var(--primary-color)">Treinos</span></h2>
        <a href="painel.php" style="color:#aaa; text-decoration:none;">&larr; Voltar ao Painel</a>
    </div>
    <?php if (count($fichas) > 0): ?>
        
        <?php foreach ($fichas as $ficha): ?>
            <?php 
                $stmt_itens = $pdo->prepare("SELECT * FROM itens_treino WHERE ficha_id = ?");
                $stmt_itens->execute([$ficha['id']]);
                $exercicios = $stmt_itens->fetchAll();
            ?>
            <div class="treino-container">
                <div class="treino-header">
                    <div>
                        <h3><?php echo htmlspecialchars($ficha['nome_treino']); ?></h3>
                        <span style="color:var(--primary-color)">Objetivo: <?php echo htmlspecialchars($ficha['objetivo']); ?></span>
                    </div>
                    <small style="color:#666">Atualizado em: <?php echo date('d/m/Y', strtotime($ficha['data_criacao'])); ?></small>
                </div>
                <div class="table-responsive">
                    <table class="table-treino">
                        <thead>
                            <tr>
                                <th width="40%">Exercício</th>
                                <th>Séries</th>
                                <th>Reps</th>
                                <th>Carga</th>
                                <th>Intervalo</th>
                            </tr>
                            </thead>
                        <tbody>
                            <?php foreach ($exercicios as $ex): ?>
                            <tr>
                                <td style="font-weight:bold;"><?php echo htmlspecialchars($ex['exercicio']); ?></td>
                                <td><?php echo htmlspecialchars($ex['series']); ?></td>
                                <td><?php echo htmlspecialchars($ex['repeticoes']); ?></td>
                                <td><span class="carga-tag"><?php echo htmlspecialchars($ex['carga']); ?></span></td>
                                <td style="color:#888"><?php echo htmlspecialchars($ex['descanso']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <div class="card" style="text-align: center; padding: 50px;">
            <h3 style="color: #666; margin-bottom: 10px;">Nenhum treino encontrado</h3>
            <p style="color: #888;">Seu professor ainda está montando sua ficha. Aguarde ou fale com a recepção.</p>
        </div>
    <?php endif; ?>

</div>

<?php require_once 'includes/footer.php'; ?>