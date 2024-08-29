<?php
    require_once("../classes/Database.class.php");

class UnidadeMedida{
    private $id;
    private $un;
    
    public function __construct($id = 0, $un = "null"){
        $this->setId($id);
        $this->setUn($un);
    }

    public function setId($novoId){
        if ($novoId < 0)
            throw new Exception("Erro: id inválido!");
        else
            $this->id = $novoId;
    }

    public function setUn($un){
        if ($un == "")
            throw new Exception("Erro: descrição da unidade de medida inválida!");
        else
            $this->un = $un;
    }
     
    public function getId(){ return $this->id; }
    public function getUn() { return $this->un;}
    
    public function incluir(){
        $sql = 'INSERT INTO unidademedida (un)   
                        VALUES (:un)';
        $parametros = array(':un'=>$this->getUn());

        Database::executar($sql, $parametros);      
    }    
    
    public function excluir(){
        $sql = 'DELETE 
                    FROM unidademedida
                    WHERE id = :id';
        $parametros = array(':id'=> $this->getId());
        return Database::executar($sql, $parametros);
    }  
    
    public function alterar(){
        $sql = 'UPDATE unidademedida 
                    SET un = :un
                    WHERE id = :id';
        $parametros = array(':id'=>$this->getId(),
                            ':un'=>$this->getUn());
        Database::executar($sql, $parametros);
        return true;
    }    
    
    public static function listar($tipo = 0, $busca = "" ){
        $sql = "SELECT * FROM unidademedida";        
        if ($tipo > 0 )
            switch($tipo){
                case 1: $sql .= " WHERE id = :busca"; break;
                case 2: $sql .= " WHERE un like :busca";  $busca = "%{$busca}%";  break;
            }      
        $parametros = array();
        if ($tipo > 0 )
            $parametros = array(':busca'=>$busca); 
        $comando = Database::executar($sql, $parametros); 
        $unidades = array();            
        while($registro = $comando->fetch(PDO::FETCH_ASSOC)){      
            $un = new UnidadeMedida($registro['id'],$registro['un']);
            array_push($unidades,$un); 
        }
        return $unidades; 
    }    
    
}
    