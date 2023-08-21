<?php

require_once __DIR__ . '/../models/Cliente.php';

class ClienteController
{
    public function addCliente()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $cliente = new Cliente();
                $cliente->setNome($_POST['nome']);
                $cliente->setEmail($_POST['email']);
                $cliente->setCelular($_POST['celular']);
                $cliente->setDataNascimento($_POST['data_nascimento']);
                $cliente->setEnderecoRua($_POST['endereco']);
                $cliente->setEnderecoNumero($_POST['endereco_numero']);
                $cliente->setEnderecoComplemento($_POST['endereco_complemento']);
                $cliente->setEnderecoBairro($_POST['bairro']);
                $cliente->setEnderecoCidade($_POST['cidade']);
                $cliente->setGenero($_POST['genero']);
                $clienteId = $cliente->add();
                
                header("Location: /app/views/dashboard.php");
                exit();
            } catch (Exception $e) {
                $errorMessage = $e->getMessage();
                $url = "/app/views/login.php?m=" . urlencode($errorMessage);
                header("Location: " . $url);
                exit();
            }
        }
    }
}

?>
