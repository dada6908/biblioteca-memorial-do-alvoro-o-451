<?php
// Inicia a sessão para poder manipulá-la
session_start();

// Limpa todas as variáveis salvas na sessão
$_SESSION = array();

// Destrói a sessão no servidor
session_destroy();

// Redireciona o usuário para a tela de login externa
header("Location: login.php");
exit;