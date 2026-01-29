<?php
require_once 'config/database.php';
require_once 'includes/header.php';

$profs = $pdo->query("SELECT * FROM professores")->fetchAll();
?>

<section style="padding: 50px 5%; max-width: 1200px; margin: 0 auto;">
    <h2 style="text-align:center; margin-bottom:40px;">Nossa Equipe <span style="color:var(--primary-color)">Online</span></h2>
    
    <div class="grid-container">
        <?php foreach ($profs as $prof): ?>
            <div class="card" style="display:flex; align-items:center; gap:20px; text-align:left; padding:20px;">
                <div style="width:80px; height:80px; border-radius:50%; background-image:url('<?php echo $prof['foto']; ?>'); background-size:cover; background-position:center; border: 2px solid var(--primary-color);"></div>
                
                <div>
                    <h3 style="margin:0; font-size:1.2rem;"><?php echo htmlspecialchars($prof['nome']); ?></h3>
                    <p style="color:#888; font-size:0.9rem;"><?php echo htmlspecialchars($prof['especialidade']); ?></p>
                    <p style="font-size:0.8rem; margin-top:5px;">Horário: <?php echo date('H:i', strtotime($prof['horario_inicio'])) . ' às ' . date('H:i', strtotime($prof['horario_fim'])); ?></p>
                    
                    <div style="margin-top:10px; display:flex; align-items:center; gap:8px;">
                        <?php 
                            $corStatus = 'gray';
                            $textoStatus = 'Ausente';
                            if($prof['status'] == 'disponivel') { $corStatus = '#00ff88'; $textoStatus = 'Disponível Agora'; }
                            if($prof['status'] == 'ocupado') { $corStatus = '#ffcc00'; $textoStatus = 'Em Aula (Ocupado)'; }
                        ?>
                        <div style="width:10px; height:10px; border-radius:50%; background-color:<?php echo $corStatus; ?>; box-shadow: 0 0 5px <?php echo $corStatus; ?>;"></div>
                        <span style="color:<?php echo $corStatus; ?>; font-size:0.8rem; font-weight:bold;"><?php echo $textoStatus; ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>