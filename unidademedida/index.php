<?php  
session_start();
include_once('unidademedida.php'); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Unidade Medido</title>
</head>
<body>
    <h1>Cadastro de Unidade de Medida</h1>
    <form action="unidademedida.php" method="POST">
        <label for="id">Id:</label>
        <input type="text" name="id" id="id" readonly value="<?=isset($unidade)?$unidade->getId():0 ?>">
        <label for="un">Un:</label>
        <input type="text" name="un" id="un" value="<?=isset($unidade)?$unidade->getUn():'' ?>">
        <button type='submit' name='acao' value='salvar'>Salvar</button>
        <button type='submit' name='acao' value='excluir'>Excluir</button>
        <button type='reset'>Cancelar</button>
    </form>

   <!-- Formulário de pesquisa -->
   <form action="" method="get">
        <fieldset>
            <legend>Pesquisa</legend>
            <label for="busca">Busca:</label>
            <input type="text" name="busca" id="busca" value="">
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="">Escolha</option>
                <option value="1">Id</option>
                <option value="2">Un</option>
            </select>
            <button type='submit'>Buscar</button>
   
        </fieldset>
    </form>
    <hr>
    <h1>Lista meus contatos</h1>
    <table>
        <tr>
            <th>Id</th>
            <th>Un</th>
        </tr>
        <?php  
            foreach($lista as $unidade){ 
                echo "<tr>
                          <td><a href='index.php?id=".$unidade->getId()."'>".$unidade->getId()."</a></td>
                          <td>{$unidade->getUn()}</td>
                      </tr>";
            }     
        ?>
    </table>
</body>
</html>