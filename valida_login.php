<?php
// Inicia a sessão para podermos lembrar que o usuário se logou
session_start();


// Importa a conexão PDO criada no Passo 1
require_once 'config/conexao.php';  


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura e limpa as entradas do formulário HTML
    $usuarioInput = trim($_POST['usuario']);
    $senhaInput   = trim($_POST['senha']);


    if (empty($usuarioInput) || empty($senhaInput)) {
        die("Preencha todos os campos.");
    }


    try {
        // Busca o usuário na tabela principal do banco de dados
        $sql = "SELECT id_usuario, senha FROM usuarios WHERE id_usuario = :usuario LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':usuario' => $usuarioInput]);
        $usuarioBD = $stmt->fetch();


        // Valida se encontrou o registro
        if ($usuarioBD) {
            // Se suas senhas já usam hash seguro, use: password_verify($senhaInput, $usuarioBD['senha'])
            // Se você criou contas direto no banco com texto puro para testar, use a comparação direta abaixo:
            if ($senhaInput === $usuarioBD['senha']) {
                
                // Sucesso: Salva o ID na sessão para proteger as próximas páginas
                $_SESSION['usuario_id'] = $usuarioBD['id_usuario'];
                $_SESSION['logado']     = true;


                // Redireciona o usuário para o painel principal do sistema
                header("Location: painel.php");
                exit;
            }
        }
        
        echo "Usuário ou senha incorretos. <a href='login.php'>Tentar novamente</a>";


    } catch (\PDOException $e) {
        die("Erro no sistema: " . $e->getMessage());
    }
} else {
    header("Location: login.php?erro=1");
    exit;
}