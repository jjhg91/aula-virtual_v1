<?php
try {

    $myPDO = new PDO("mysql:host=localhost;dbname=jmc;charset=UTF8","jmc_aula3");

    $myPDO2 = new PDO("mysql:host=localhost;dbname=aula;charset=UTF8","jmc_aula3");

    
} catch (PDOException $e) 
{
    echo $e->getMessage();
}

?>