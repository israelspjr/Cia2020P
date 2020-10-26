<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");
$busca = new Busca();

$email = $_POST['email'];
//$tabela = $_POST['tabela'];
$campo = 'nome'; //$_POST['campo'];
//$where = $_POST['where'];

$resposta = $busca->Buscar_nome_email($email); //tabela, $campo, $valor, $where);

foreach($resposta as $valor):
    $html .= html_entity_decode($valor[$campo]);
endforeach;

echo json_encode($html);    