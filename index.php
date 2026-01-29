<?php
require_once 'config/database.php';
require_once 'includes/header.php';

$planos = $pdo->query("SELECT * FROM planos ORDER BY preco ASC")->fetchAll();
?>

<section class="hero-section">
    <div class="hero-content">
        <h1>Transforme suor em <br><span style="color:var(--primary)">CONQUISTA</span></h1>
        
        <p>A dor que você sente hoje é a força que você sentirá amanhã. Estrutura de elite, profissionais focados e o ambiente perfeito para a sua evolução.</p>
        
        <a href="#planos" class="btn-cta" style="padding: 15px 50px; font-size: 1.1rem;">COMEÇAR MINHA JORNADA</a>
    </div>
</section>

<div class="quote-strip">
    "O único treino ruim é aquele que não aconteceu."
</div>

<section class="features-section">
    <div style="text-align:center; margin-bottom: 50px;">
        <h2 style="font-size: 2.5rem; margin-bottom: 10px;">POR QUE <span style="color:var(--primary)">TREINAR AQUI?</span></h2>
        <p style="color:#888;">Não somos apenas uma academia. Somos o seu novo estilo de vida.</p>
    </div>

    <div class="grid-container">
        <div class="feature-card">
            <i class="fas fa-dumbbell"></i>
            <h3>Equipamentos de Ponta</h3>
            <p style="color:#aaa; margin-top:10px;">Maquinário importado e biomecânica perfeita para evitar lesões e maximizar resultados.</p>
        </div>

        <div class="feature-card">
            <i class="fas fa-temperature-low"></i>
            <h3>Ambiente Climatizado</h3>
            <p style="color:#aaa; margin-top:10px;">Conforto térmico total para você focar apenas no que importa: seu desempenho.</p>
        </div>

        <div class="feature-card">
            <i class="fas fa-users"></i>
            <h3>Acompanhamento Real</h3>
            <p style="color:#aaa; margin-top:10px;">Instrutores que realmente se importam com a sua execução e evolução diária.</p>
        </div>
    </div>
</section>

<section id="planos">
    <div style="text-align:center; margin-bottom: 80px;">
        <h2 style="font-size: 3rem; text-transform:uppercase;">Nossos <span style="color:var(--primary)">Planos</span></h2>
        <p style="color:#888; font-size: 1.1rem; margin-top: 10px;">Transparência total. Sem taxas de matrícula hoje.</p>
    </div>

    <div class="grid-container">
        <?php foreach($planos as $p): ?>
            <?php 
                $isGold = (stripos($p['nome'], 'Gold') !== false); 
                $classDestaque = $isGold ? 'featured' : '';
            ?>

            <div class="card <?php echo $classDestaque; ?>">
                
                <?php if($isGold): ?>
                    <div style="background:var(--primary); color:#000; font-weight:bold; font-size:0.8rem; padding:8px 20px; border-radius:20px; position:absolute; top:-15px; left:50%; transform:translateX(-50%); text-transform:uppercase; letter-spacing:1px; box-shadow: 0 5px 15px rgba(0,255,136,0.4);">
                        Recomendado
                    </div>
                <?php endif; ?>

                <h3><?php echo htmlspecialchars($p['nome']); ?></h3>
                
                <div class="price-container">
                    <span class="price">
                        <small>R$</small><?php echo number_format($p['preco'], 0, ',', '.'); ?><small>,90</small>
                    </span>
                </div>

                <ul>
                    <?php 
                        $beneficios = explode('+', $p['beneficios']);
                        foreach($beneficios as $ben):
                    ?>
                        <li>
                            <i class="fas fa-check"></i>
                            <?php echo trim($ben); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <a href="cadastro.php?plano=<?php echo $p['id']; ?>" class="btn-cta" style="width:100%; background: <?php echo $isGold ? 'var(--primary)' : 'transparent'; ?>; color: <?php echo $isGold ? '#000' : '#fff'; ?>; border: 1px solid var(--primary);">
                    <?php echo $isGold ? 'QUERO ESSE' : 'Começar Agora'; ?>
                </a>

            </div>
        <?php endforeach; ?>
    </div>
</section>

    <div class="grid-container">
        <?php foreach($planos as $p): ?>
            <?php 
                $destaque = (strpos(strtolower($p['nome']), 'gold') !== false); 
                $border = $destaque ? '2px solid var(--primary)' : '1px solid #333';
                $scale  = $destaque ? 'transform: scale(1.05);' : '';
            ?>

            <div class="card" style="border: <?php echo $border; ?>; <?php echo $scale; ?> position:relative;">
                
                <?php if($destaque): ?>
                    <div style="position:absolute; top:0; left:0; width:100%; background:var(--primary); color:#000; font-weight:bold; font-size:0.8rem; padding:5px;">MAIS VENDIDO</div>
                <?php endif; ?>

                <h3 style="margin-top: <?php echo $destaque ? '15px' : '0'; ?>"><?php echo htmlspecialchars($p['nome']); ?></h3>
                
                <div style="font-size: 3rem; font-weight: 800; margin: 20px 0; color: #fff;">
                    <small style="font-size:1rem; font-weight:400;">R$</small>
                    <?php echo number_format($p['preco'], 2, ',', '.'); ?>
                </div>

                <ul style="list-style:none; text-align:left; padding: 0 20px; margin-bottom:30px; color:#ccc;">
                    <?php 
                        $beneficios = explode('+', $p['beneficios']);
                        foreach($beneficios as $ben) {
                            echo "<li style='margin-bottom:10px; border-bottom:1px solid #222; padding-bottom:5px;'><i class='fas fa-check' style='color:var(--primary); margin-right:10px;'></i>" . trim($ben) . "</li>";
                        }
                    ?>
                </ul>

                <a href="cadastro.php?plano=<?php echo $p['id']; ?>" class="btn-cta" style="width:100%; background: <?php echo $destaque ? 'var(--primary)' : 'transparent'; ?>; color: <?php echo $destaque ? '#000' : 'var(--primary)'; ?>; border: 1px solid var(--primary);">
                    MATRICULAR AGORA
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section style="background: url('https://images.unsplash.com/photo-1571902943202-507ec2618e8f?q=80&w=1375&auto=format&fit=crop') fixed center; background-size: cover; padding: 100px 20px; text-align: center; position: relative;">
    <div style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.8);"></div> <div style="position:relative; z-index:2;">
        <h2 style="font-size: 2.5rem; margin-bottom: 20px;">AINDA COM DÚVIDAS?</h2>
        <p style="font-size: 1.2rem; margin-bottom: 30px; color:#ddd;">Venha fazer uma aula experimental gratuita e sinta a energia.</p>
        <a href="loja_contato.php" class="btn-cta" style="background:#fff; color:#000;">FALAR NO WHATSAPP</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>