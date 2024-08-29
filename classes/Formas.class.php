<?php

abstract class Formas{
    private $id; 
    private $cor;
    private $un; //objeto UnidadeMedida
    private $fundo;

    public function __construct($id = 0, $cor = "null", UnidadeMedida $un = null, $fundo = "null"){
        $this->setId($id);
        $this->setCor($cor);
        $this->setUn($un);
        $this->setFundo($fundo);
    }

    public function setId($novoId){
        if ($novoId < 0)
            throw new Exception("Erro: id inválido!");
        else
            $this->id = $novoId;
    }
    public function setCor($cor){
        $this->cor = $cor;
    }

    public function setFundo($fundo){
        $this->fundo = $fundo;
    }

    public function setUn(UnidadeMedida $un = null){
        if ($un)
            $this->un = $un;
        else
            throw new Exception("Erro: Deve ser informada uma unidade de medida!");
    }
 
    public function getId(){ return $this->id; }
    public function getCor() { return $this->cor;}
    public function getUn() { return $this->un;}
    public function getFundo() { return $this->fundo;}

    abstract public function incluir();
    abstract public function excluir();
    abstract public function alterar();
    abstract public static function listar($tipo = 0, $busca = "" ):array;
    abstract public function desenhar();
    abstract public function calcularArea();
    abstract public function calcularPerimetro();
}

