<?php
/** Controle de Quadrado */
//session_start();
require_once("../classes/Quadrado.class.php");
require_once("../classes/UnidadeMedida.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id =  isset($_POST['id'])?$_POST['id']:0; 
    $lado =  isset($_POST['lado'])?$_POST['lado']:0; 
    $cor =  isset($_POST['cor'])?$_POST['cor']:0; 
    $un =  isset($_POST['un'])?$_POST['un']:0; 
    $arquivo =  isset($_FILES['fundo'])?$_FILES['fundo']:""; 
    $acao =  isset($_POST['acao'])?$_POST['acao']:0; 
    $destino = "../".IMG."/".$arquivo['name'];
    try{
        $un = UnidadeMedida::listar(1,$un)[0];
        $quadrado = new Quadrado($id,$lado,$cor,$un,$destino);

        $resultado = "";
        if($acao == 'salvar'){
            if($id > 0)
                $resultado = $quadrado->alterar();
            else                       
                $resultado = $quadrado->incluir();
        }elseif ($acao == 'excluir'){
            $resultado = $quadrado->excluir();
        }
        $_SESSION['MSG'] = "Dados inseridos/Alterados com sucesso!";
        move_uploaded_file($arquivo['tmp_name'],$destino);

    }catch(Exception $e){ 
        $_SESSION['MSG'] = $e->getMessage();

    }finally{
         header('location: index.php');
    }
}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){ 
    $id =  isset($_GET['id'])?$_GET['id']:0; 
    $msg = (isset($_SESSION['MSG'])?$_SESSION['MSG']:"");
    if ($msg != ""){
        echo "<h2>{$msg}</h2>";
        unset($_SESSION['MSG']);
    }

    if ($id > 0){
        $forma = Quadrado::listar(1,$id)[0];                                          
    }
    $busca =  isset($_GET['busca'])?$_GET['busca']:0;
    $tipo =  isset($_GET['tipo'])?$_GET['tipo']:0;   
    $lista = Quadrado::listar($tipo,$busca); 
}
    