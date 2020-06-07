<?php 

   require_once('../../src/php/conn.php');
   $prof = (int)$_GET['mat'];




   $select = $myPDO2->prepare("
    SELECT 
    id_plan_evaluacion,
    id_profesorcursogrupo,
    tipo_evaluacion.descripcion, 
    valor.descripcion, 
    semana.descripcion, 
    plan_evaluacion.descripcion,
    tipo_evaluacion.id_tipo_evaluacion,
    plan_evaluacion.otros
    FROM plan_evaluacion
    inner join tipo_evaluacion on plan_evaluacion.tipo_evaluacion = tipo_evaluacion.id_tipo_evaluacion
    inner join valor on plan_evaluacion.valor = valor.id_valor 
    inner join semana on semana.id_semana = plan_evaluacion.semana
    where  id_profesorcursogrupo = $prof
    ORDER BY semana.descripcion ASC
    ");
   $select->execute();
   $planes = $select->fetchAll();









?>