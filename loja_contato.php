<?php
require_once 'config/database.php';
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM produtos LIMIT 1");
$produto = $stmt->fetch();
?>

<section style="background: linear-gradient(90deg, #000 50%, #111 50%); padding: 80px 5%;">
    <div style="max-width:1200px; margin:0 auto; display:flex; flex-wrap:wrap; align-items:center; gap:50px;">
        
        <div style="flex:1; min-width:300px;">
            <div style="border: 2px solid var(--primary-color); padding:10px; border-radius:10px; transform: rotate(-2deg);">
                <img src="<?php echo $produto['imagem']; ?>" style="width:100%; border-radius:5px;" alt="Uniforme">
            </div>
        </div>
        <div style="flex:1; min-width:300px;">
            <span style="background:var(--primary-color); color:#000; padding:5px 10px; font-weight:bold; border-radius:4px;">LOJA OFICIAL</span>
            <h2 style="font-size:3rem; margin:20px 0; line-height:1.1;">Vista a nossa<br><span style="color:var(--primary-color);">FORÇA</span></h2>
            <p style="font-size:1.1rem; color:#ccc; margin-bottom:30px;">
                <?php echo htmlspecialchars($produto['descricao']); ?>
                <br><br>
                Disponível em todos os tamanhos. Garanta a sua e treine com estilo e conforto máximo.
            </p>
            <div style="display:flex; align-items:center; gap:20px;">
                <span style="font-size:2.5rem; font-weight:bold;">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
                <a href="https://wa.me/5500000000000?text=Olá, quero encomendar a blusa da academia!" target="_blank" class="btn-cta" style="background:#25D366; color:#fff;">COMPRAR NO WHATSAPP</a>
            </div>
        </div>
    </div>
</section>

<section style="padding: 60px 5%; text-align:center; background: #0a0a0a;">
    <h2 style="margin-bottom:40px;">Fale <span style="color:var(--primary-color)">Conosco</span></h2>
    
    <div class="grid-container">
        <div class="card">
            <h3 style="color:#fff;">📍 Localização</h3>
            <p>Rua dos Fortes, 100<br>Centro - Cidade/UF</p>
        </div>
        <div class="card">
            <h3 style="color:#fff;">📞 Contato</h3>
            <p>(00) 99999-9999<br>contato@academiapro.com</p>
        </div>
        <div class="card">
            <h3 style="color:#fff;">📱 Redes Sociais</h3>
            <div style="display:flex; justify-content:center; gap:15px; margin-top:15px;">
                <a href="#" style="color:#fff; font-size:1.5rem;">Instagram</a>
                <a href="#" style="color:#fff; font-size:1.5rem;">Facebook</a>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>