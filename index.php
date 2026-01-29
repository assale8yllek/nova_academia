<?php
require_once 'config/database.php';
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM planos");
$planos = $stmt->fetchAll();
?>

<section class="hero">
    <h2>SUPERE SEUS<br><span>LIMITES</span></h2>
    <p style="color: #ccc; max-width: 600px; margin: 20px 0;">
        Estrutura completa, profissionais de elite e o ambiente perfeito para você alcançar sua melhor versão.
    </p>
    <a href="#planos" class="btn-cta">Começar Agora</a>
</section>

<section id="planos">
    <h2 style="text-align: center; margin-top: 50px; font-size: 2rem;">NOSSOS <span style="color:var(--primary-color)">PLANOS</span></h2>
    <div class="grid-container">
        <?php foreach ($planos as $plano): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($plano['nome']); ?></h3>
                <span class="price">R$ <?php echo number_format($plano['preco'], 2, ',', '.'); ?></span>
                <ul>
                    <?php 
                        $benefits = explode('+', $plano['beneficios']);
                        foreach($benefits as $b) { echo "<li>" . trim($b) . "</li>"; }
                    ?>
                </ul>
                <a href="cadastro.php?plano=<?php echo $plano['id']; ?>" class="btn-cta" style="width:100%; font-size: 0.9rem;">ESCOLHER</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>