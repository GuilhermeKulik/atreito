<?php

class Cliente
{
    private $id;
    private $nome;
    private $codigoUsuario;
    private $email;
    private $celular;
    private $dataNascimento;
    private $pontos;
    private $ultimoLogin;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCodigoUsuario()
    {
        return $this->codigoUsuario;
    }

    public function setCodigoUsuario($codigoUsuario)
    {
        $this->codigoUsuario = $codigoUsuario;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getPontos()
    {
        return $this->pontos;
    }

    public function setPontos($pontos)
    {
        $this->pontos = $pontos;
    }

    public function getUltimoLogin()
    {
        return $this->ultimoLogin;
    }

    public function setUltimoLogin($ultimoLogin)
    {
        $this->ultimoLogin = $ultimoLogin;
    }

    public function adicionarPontos($quantidade)
    {
    $this->pontos += $quantidade;
    }
}
