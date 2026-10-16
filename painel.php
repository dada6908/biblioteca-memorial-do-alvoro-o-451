@@ -0,0 +1,76 @@
<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit;
}

require_once 'config/conexao.php';

try {
    $sql = "SELECT id_emprestimo, id_livro, id_usuario, data_saida, data_retorno_prevista 
            FROM emprestimos 
            ORDER BY data_saida DESC LIMIT 5";
    $stmt = $pdo->query($sql);
    $emprestimos = $stmt->fetchAll();
} catch (\PDOException $e) {
    $emprestimos = [];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Sistema de Biblioteca</title>
    <!-- Vinculando o mesmo CSS Externo -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="painel-body">

    <nav class="navbar">
        <h1>Painel Biblioteca</h1>
        <a href="logout.php">Sair do Sistema</a>
    </nav>

    <div class="container">
        <p class="welcome-msg">Olá, você está autenticado como <strong>Operador #<?php echo htmlspecialchars($_SESSION['usuario_id']); ?></strong>.</p>
        
        <div class="main-card">
            <h3>🔄 Últimos Empréstimos Registrados no Banco</h3>
            
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>ID Livro</th>
                            <th>ID Usuário</th>
                            <th>Data de Saída</th>
                            <th>Retorno Previsto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($emprestimos)): ?>
                            <tr>
                                <td colspan="5" style="text-align: center; color: #999; padding: 30px;">Nenhum empréstimo encontrado no banco de dados.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($emprestimos as $emp): ?>
                            <tr>
                                <td><strong>#<?php echo $emp['id_emprestimo']; ?></strong></td>
                                <td>📚 Livro <?php echo $emp['id_livro']; ?></td>
                                <td><span class="badge badge-user">👤 ID <?php echo $emp['id_usuario']; ?></span></td>
                                <td><?php echo date('d/m/Y', strtotime($emp['data_saida'])); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($emp['data_retorno_prevista'])); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>