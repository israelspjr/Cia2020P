<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$busca = new Busca();

$telefone = $_POST['telefone'];
$campo = 'nome'; 

$resposta = $busca->Buscar_aluno_telefone($telefone); //tabela, $campo, $valor, $where);

foreach($resposta as $valor):
    $html .= html_entity_decode($valor[$campo]);
endforeach;

echo json_encode($html);    