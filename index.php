<?php

require_once 'config/database.php';

$sql = "SELECT * FROM planos";
$stmt = $pdo->query($sql);
$planos = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia Pro | Sua Melhor Versão</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header>
        <h1>ACADEMIA <span>PRO</span></h1>
        <nav>
            <a href="#inicio">Início</a>
            <a href="#beneficios">Benefícios</a>
            <a href="#planos">Planos</a>
            <a href="#contato">Contato</a>
        </nav>
    </header>

    <section id="inicio" class="hero">
        <h2>Transforme seu <span>Corpo</span>,<br>Transforme sua <span>Mente</span></h2>
        <p>Acompanhamento profissional, equipamentos de ponta e ambiente climatizado. Agende sua aula experimental gratuita hoje mesmo.</p>
        <p><strong>Horários:</strong> Seg-Sex: 06h às 23h | Sáb-Dom: 08h às 14h</p>
        <br>
        <a href="#planos" class="btn-cta">QUERO COMEÇAR AGORA</a>
    </section>

    <section id="planos" class="planos-section">
        <h2>Escolha seu Plano</h2>
        <p>Sem taxas escondidas. Cancele quando quiser.</p>

        <div class="planos-container">
            <?php foreach ($planos as $plano): ?>
                <div class="card-plano">
                    <h3><?php echo htmlspecialchars($plano['nome']); ?></h3>
                    <span class="price">R$ <?php echo number_format($plano['preco'], 2, ',', '.'); ?></span>
                    <p><?php echo htmlspecialchars($plano['beneficios']); ?></p>
                    <a href="cadastro.php?plano=<?php echo $plano['id']; ?>" class="btn-matricula">MATRICULE-SE</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

</body>
</html>