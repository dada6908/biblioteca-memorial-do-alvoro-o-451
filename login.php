<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Biblioteca</title>
    <!-- Vinculando o CSS Externo -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">

<div class="login-container">
    <div class="login-header">
        <h2>Biblioteca</h2>
        <p>Acesse sua conta para gerenciar o sistema</p>
    </div>

    <?php if (isset($_GET['erro'])): ?>
        <div class="error-message">Usuário ou senha inválidos.</div>
    <?php endif; ?>
    
    <form action="valida_login.php" method="POST">
        <div class="input-group">
            <label for="usuario">ID do Usuário / E-mail</label>
            <input type="text" id="usuario" name="usuario" required placeholder="Digite seu usuário" autocomplete="username">
        </div>
        
        <div class="input-group">
            <label for="senha">Senha de Acesso</label>
            <input type="password" id="senha" name="senha" required placeholder="Digite sua senha" autocomplete="current-password">
        </div>
        
        <button type="submit" class="btn-login">Entrar no Sistema</button>
    </form>
</div>

</body>
</html>