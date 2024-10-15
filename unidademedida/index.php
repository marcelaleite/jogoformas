<?php
session_start();
require_once("../classes/autoload.php");
require_once("../config/config.inc.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
    $id =  isset($_GET['id'])?$_GET['id']:0;
    $msg =  isset($_GET['MSG'])?$_GET['MSG']:"";

    // pegar o formulário e preencher, após apresentar para o usuário
    $formulario = file_get_contents('form_cadastro_un.html');

    if ($id > 0){
        $unidade = UnidadeMedida::listar(1,$id)[0];
        $formulario = str_replace('{id}',$unidade->getId(),$formulario); 
        $formulario = str_replace('{un}',$unidade->getUn(),$formulario); 
    }else{
        $formulario = str_replace('{id}','0',$formulario); 
        $formulario = str_replace('{un}','',$formulario); 
    }
    
    print($formulario);
    include "listaunidades.php";
    
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id =  isset($_POST['id'])?$_POST['id']:0; 
    var_dump($id);
    $un =  isset($_POST['un'])?$_POST['un']:""; 
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
        $_SESSION['MSG'] = "Dados inseridos/Alterados com sucesso!";
    }catch(Exception $e){ 
        $_SESSION['MSG'] = 'ERRO: '.$e->getMessage();
    }finally{
        header('location: index.php'); 
    }
}