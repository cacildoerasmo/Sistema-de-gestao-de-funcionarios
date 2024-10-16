<?php

    $hostname = "localhost";
    $user = "root";
    $password = "";
    $database = "tcc_sgfuncionarios";
    $conexao = mysqli_connect($hostname,$user,$password,$database);
 
    if(!$conexao){
        print "Falha na conex&atilde;o com o Banco de Dados.";
    }


?>