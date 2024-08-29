<?php  
session_start();
include_once('quadrado.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formas</title>
</head>
<body>

<a href="./cadastro.php">Novo</a>
    <!-- Formulário de pesquisa -->
    <form action="" method="get">
        <fieldset>
            <legend>Pesquisa</legend>
            <label for="busca">Busca:</label>
            <input type="text" name="busca" id="busca" value="">
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="0">Escolha</option>
                <option value="1">Id</option>
                <option value="2">Lado</option>
                <option value="3">Cor</option>
                <option value="4">Un</option>
            </select>


            
            <button type='submit'>Buscar</button>
   
        </fieldset>
    </form>
    <hr>
    <h1>Lista meus contatos</h1>
    <table>
        <tr>
            <th>Id</th>
            <th>Tamanho</th>
            <th>Cor</th>
            <th>Un</th>
            <th>Alterar</th>
        </tr>
        <?php  
            foreach($lista as $forma){ // monta a tabela com base na variável lista, criada no pessoa.php
                echo "<tr><td>{$forma->getId()}</td>
                          <td>{$forma->getLado()}</td>
                          <td>{$forma->getCor()}</td>
                          <td>{$forma->getUn()->getUn()}</td>
                          <td><a href='consulta.php?id={$forma->getId()}'>Visualizar</a></td>
                          <td><a href='cadastro.php?id={$forma->getId()}'>Editar</a></td>
                      </tr>";
            }     
        ?>
    </table>
</body>
</html>
