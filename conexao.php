<?php
// config/conexao.php

$host    = 'localhost';
$db      = 'biblioteca_alvoroco'; // Certifique-se de que o nome do seu banco está certo aqui
$user    = 'root';
$pass    = '12345678'; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // ⚠️ O ERRO ESTÁ AQUI: Esta variável PRECISA se chamar exatamente $pdo
    // Se no seu arquivo estiver $conn, $conexao ou qualquer outro nome, o valida_login vai quebrar!
    $pdo = new PDO($dsn, $user, $pass, $options);

} catch (\PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}