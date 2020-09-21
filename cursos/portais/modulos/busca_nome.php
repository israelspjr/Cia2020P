<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/portais.php");
$busca = new Busca();

$valor = $_POST['nome'];
$tabela = $_POST['tabela'];
$campo = $_POST['campo'];
$where = $_POST['where'];

$resposta = $busca->Buscar_nome($tabela, $campo, $valor, $where);

foreach($resposta as $valor):
    $html .= "<option value='".html_entity_decode($valor[$campo])."'>";
endforeach;

echo json_encode($html);    