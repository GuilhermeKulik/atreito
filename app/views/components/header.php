<?php 
session_start();

// Verifica se está logado para evitar acesso indesejado
if (!isset($_SESSION['user'])) {
  throw new Exception('Acesso restrito.');
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Cliente</title>
    <link rel="stylesheet" href="/public/css/dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="/public/js/cliente.js"></script>
</head>
