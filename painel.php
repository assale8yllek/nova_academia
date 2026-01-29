<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

require_once 'config/database.php';

$id_aluno = $_SESSION['usuario_id'];

try {
    $sql = "SELECT a.*, p.nome as nome_plano, p.preco, p.beneficios 
            FROM alunos a 
            LEFT JOIN planos p ON a.plano_id = p.id 
            WHERE a.id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_aluno]);
    $aluno = $stmt->fetch();

    if (!$aluno) {
        session_destroy();
        header("Location: login.php");
        exit;
    }

} catch (PDOException $e) {
    die("Erro ao carregar painel: " . $e->getMessage());
}

require_once 'includes/header.php';
?>

<div style="min-height: 80vh; padding: 40px 5%; background: linear-gradient(to bottom, #0f0f0f, #000);">
    
    <div style="max-width: 1200px; margin: 0 auto; margin-bottom: 40px; border-bottom: 1px solid #333; padding-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
        <div>
            <h2 style="font-size: 2rem; color: #fff;">Olá, <span style="color:var(--primary)"><?php echo htmlspecialchars($aluno['nome']); ?></span></h2>
            <p style="color: #888;">Bem-vindo à sua área de performance.</p>
        </div>
        
        <a href="meu_treino.php" class="btn-cta" style="padding: 10px 25px; font-size: 0.9rem;">
            <i class="fas fa-dumbbell" style="margin-right: 8px;"></i> IR PARA O TREINO
        </a>
    </div>

    <div class="grid-container">
        
        <div class="card" style="align-items: flex-start; text-align: left;">
            <div style="display:flex; justify-content:space-between; width:100%; margin-bottom: 15px;">
                <h3 style="margin:0; font-size:0.9rem;">SITUAÇÃO</h3>
                <i class="fas fa-id-card" style="color: #444; font-size: 1.5rem;"></i>
            </div>
            
            <div style="font-size: 1.8rem; font-weight: bold; color: <?php echo ($aluno['status'] == 'ativo') ? 'var(--primary)' : 'var(--danger)'; ?>; margin-bottom: 10px;">
                <?php echo strtoupper($aluno['status']); ?>
            </div>
            
            <p style="color: #666; font-size: 0.8rem;">
                Membro desde: <?php echo date('d/m/Y', strtotime($aluno['created_at'])); ?>
            </p>
        </div>

        <div class="card" style="align-items: flex-start; text-align: left;">
            <div style="display:flex; justify-content:space-between; width:100%; margin-bottom: 15px;">
                <h3 style="margin:0; font-size:0.9rem;">PLANO ATUAL</h3>
                <i class="fas fa-crown" style="color: #ffcc00; font-size: 1.5rem;"></i>
            </div>

            <div style="font-size: 1.5rem; color: #fff; font-weight:bold; margin-bottom: 5px;">
                <?php echo htmlspecialchars($aluno['nome_plano'] ?? 'Plano não encontrado'); ?>
            </div>
            
            <div style="color: #aaa; font-size: 0.9rem;">
                Mensalidade: <span style="color:#fff;">R$ <?php echo number_format($aluno['preco'] ?? 0, 2, ',', '.'); ?></span>
            </div>
        </div>

        <div class="card" style="border-color: var(--primary); background: rgba(0, 255, 136, 0.05);">
            <i class="fas fa-running" style="font-size: 2.5rem; color: var(--primary); margin-bottom: 15px;"></i>
            <h3 style="color: #fff; margin-bottom: 10px;">HORA DO TREINO</h3>
            <p style="color: #aaa; margin-bottom: 20px; font-size: 0.9rem;">Acesse sua ficha completa e registre seu progresso de hoje.</p>
            
            <a href="meu_treino.php" class="btn-cta" style="width: 100%; background: transparent; border: 1px solid var(--primary); color: var(--primary);">
                VISUALIZAR FICHA
            </a>
        </div>

        <div class="card">
            <i class="fas fa-tshirt" style="font-size: 2.5rem; color: #666; margin-bottom: 15px;"></i>
            <h3>LOJA & SUPORTE</h3>
            <p style="color: #aaa; margin-bottom: 20px; font-size: 0.9rem;">Precisa renovar o uniforme ou tirar dúvidas?</p>
            <a href="loja_contato.php" style="color: var(--primary); text-decoration: none; font-weight: bold;">Acessar Loja &rarr;</a>
        </div>

    </div>
</div>

<?php require_once 'includes/footer.php'; ?>