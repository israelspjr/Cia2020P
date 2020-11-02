<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Relatorio.class.php");

$grafico = array(
        'dados' => array(
            'cols' => array(
                array('type' => 'string', 'label' => $nome),
                array('type' => 'number', 'label' => 'Quantidade')
            ),  
            'rows' => array()
        ),
        'config' => array(
            'title' => 'Grafico de REspostas PSA',
            'width' => 400,
            'height' => 300
        )
    );

// Consultar dados no BD
$pdo = new PDO('mysql:host=mysql09.companhiadeidiomas.com.br;dbname=companhiadeidi21', 'companhiadeidi21', 'OficialADM@');
$sql = 'SELECT SELECT SQL_CACHE G.nome AS Grupo, COUNT(*) as Qtde FROM psaIntegranteGrupo AS PIG  
    LEFT JOIN integranteGrupo AS IG ON IG.idIntegranteGrupo = PIG.integranteGrupo_idIntegranteGrupo
    INNER JOIN planoAcaoGrupo AS PAG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
    INNER JOIN grupo AS G ON PAG.grupo_idGrupo = G.idGrupo
    INNER JOIN grupoClientePj AS GCNPJ ON GCNPJ.grupo_idGrupo = G.idGrupo
    INNER JOIN gerenteTem AS GER ON GER.clientePj_idClientePj = GCNPJ.clientePj_idClientePj 
    LEFT JOIN clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf groupy by Grupo';
$stmt = $pdo->query($sql);
while ($obj = $stmt->fetchObject()) {
    $grafico['dados']['rows'][] = array('c' => array(
        array('v' => $obj->Grupo),
        array('v' => (int)$obj->Qtde)
    ));
}

// Enviar dados na forma de JSON
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($grafico); 