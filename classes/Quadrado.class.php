<?php
require_once("../classes/Database.class.php");
require_once("../classes/UnidadeMedida.class.php");

class Quadrado{
    private $id; 
    private $lado; 
    private $cor;
    private $un; //objeto UnidadeMedida
    private $fundo;

     public function __construct($id = 0, $lado = "null", $cor = "null", UnidadeMedida $un = null, $fundo = "null"){
        $this->setId($id);
        $this->setLado($lado);
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

    public function setLado($lado){
        if ($lado < 0)
            throw new Exception("Erro: tamanho inválido!");
        else
            $this->lado = $lado;
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
    public function getLado():string { return $this->lado;}
    public function getCor() { return $this->cor;}
    public function getUn() { return $this->un;}
    public function getFundo() { return $this->fundo;}

    public function incluir(){
        $sql = 'INSERT INTO quadrado (lado, cor, id_un, fundo)   
                     VALUES (:lado, :cor, :un, :fundo)';
        $parametros = array(':lado'=>$this->getLado(),
                            ':cor'=>$this->getCor(),
                            ':un'=>$this->getUn()->getId(),
                            ':fundo'=>$this->getFundo());

        return Database::executar($sql, $parametros);      
    }    

    public function excluir(){
        $sql = 'DELETE 
                  FROM quadrado
                 WHERE id = :id';
        $parametros = array(':id'=> $this->getId());
        return Database::executar($sql, $parametros);
    }  

    public function alterar(){
        $sql = 'UPDATE quadrado 
                   SET lado = :lado, cor = :cor, id_un = :un, fundo = :fundo
                 WHERE id = :id';
        $parametros = array(':id'=>$this->getId(),
                        ':lado'=>$this->getLado(),
                        ':cor'=>$this->getCor(),
                        ':un'=>$this->getUn()->getId(),
                        ':fundo'=>$this->getFundo());
        Database::executar($sql, $parametros);
        return true;
    }    

    public static function listar($tipo = 0, $busca = "" ){
        $sql = "SELECT * FROM quadrado";        
        if ($tipo > 0 )
            switch($tipo){
                case 1: $sql .= " WHERE id = :busca"; break;
                case 2: $sql .= " WHERE lado = :busca"; break;
                case 3: $sql .= " WHERE cor like :busca";  $busca = "%{$busca}%";  break;
                case 4: $sql .= " , unidademedida WHERE un like :busca and quadrado.id_un = unidademedida.id" ;  $busca = "%{$busca}%";  break;
            }      
        $parametros = array();
        if ($tipo > 0 )
            $parametros = array(':busca'=>$busca); 
        $comando = Database::executar($sql, $parametros); 
        $formas = array();            
        while($registro = $comando->fetch(PDO::FETCH_ASSOC)){    
            $un = UnidadeMedida::listar(1,$registro['id_un'])[0];  
            $quadrado = new Quadrado($registro['id'],$registro['lado'],$registro['cor'] ,$un, $registro['fundo']);
            array_push($formas,$quadrado); 
        }
        return $formas; 
    }    

    public function desenhar(){
        return "<div class='quadrado' style='display:block; 
                width:{$this->getLado()}{$this->getUn()->getUn()};
                height:{$this->getLado()}{$this->getUn()->getUn()};
                background-color:{$this->getCor()};
                background-image:url(\"{$this->getFundo()}\")'></div>";
    }
}
