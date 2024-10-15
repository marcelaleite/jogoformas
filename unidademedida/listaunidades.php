<?php
session_start();
require_once("../classes/autoload.php");
require_once("../config/config.inc.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){ 
  
    $msg =  isset($_GET['MSG'])?$_GET['MSG']:"";
    $busca =  isset($_GET['busca'])?$_GET['busca']:0; 
    $tipo =  isset($_GET['tipo'])?$_GET['tipo']:0;
    $lista = UnidadeMedida::listar($tipo,$busca); 
    $itens = "";
    foreach($lista as $unidade){ 
        $item = file_get_contents('itens_unidade.html');
        $item = str_replace('{id}',$unidade->getId(),$item);
        $item = str_replace('{un}',$unidade->getUn(),$item);
        $itens .= $item; 
    }   
    $templatelista = file_get_contents('lista_un.html');
    $templatelista = str_replace('{itens}',$itens,$templatelista);
    
    print($templatelista);
    
    
}