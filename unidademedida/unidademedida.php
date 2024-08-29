<?php

require_once("../classes/UnidadeMedida.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id =  isset($_POST['id'])?$_POST['id']:0; 
    $un =  isset($_POST['un'])?$_POST['un']:0; 
    $acao =  isset($_POST['acao'])?$_POST['acao']:0; 
    try{
        $unidade = new UnidadeMedida($id,$un);
        if($acao == 'salvar'){
            if($id > 0)
                $unidade->alterar();
            else                     
                $unidade->incluir();
        }elseif ($acao == 'excluir'){
           $unidade->excluir();
        }
            header('location: index.php?MSG=Dados inseridos/Alterados com sucesso!');
    }catch(Exception $e){ 
        header('location: index.php?MSG='.$e->getMessage()); 
    }
}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){ 
    $id =  isset($_GET['id'])?$_GET['id']:0;
    $msg =  isset($_GET['MSG'])?$_GET['MSG']:"";
    if ($id > 0){
        $unidade = UnidadeMedida::listar(1,$id)[0]; 
    }
    $busca =  isset($_GET['busca'])?$_GET['busca']:0; 
    $tipo =  isset($_GET['tipo'])?$_GET['tipo']:0;
    $lista = UnidadeMedida::listar($tipo,$busca); 
}
