<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");
$frequencia = new Relatorio();

$ano_ref = $_REQUEST['ano'];
$idIntegrante = $_REQUEST['Integrante'];
$where ="WHERE YEAR(FF.dataReferencia) <= $ano_ref AND IG.idIntegranteGrupo = $idIntegrante";

$rows = array();
$table = array();
$table['cols'] = array(
        array('label' => 'Professor', 'type' => 'string'),
        array('label' => 'Data', 'type' => 'data'),
        array('label' => 'Horas Programadas', 'type' => 'string'),
        array('label' => 'Horas Realizadas pelo Grupo', 'type' => 'string'),
        array('label' => 'Horas Realizadas pelo Aluno', 'type' => 'string'),
        array('label' => 'Frequência', 'type' => 'number')
        );

 $result = $frequencia->relatorioFrequencia_mensal($where);
        /* Extract the information from $result */
        foreach($result as $r) {

         $temp = array();
         $temp[] = array('v' => (string) $r['nomeProfessor']);
         $temp[] = array('v' => (string) $r['mes']."/".$r['ano']);
         $temp[] = array('v' => (string) Uteis::exibirHoras($r['horasProgramadas']));
         $temp[] = array('v' => (string) Uteis::exibirHoras($r['horasRealizadasPeloGrupo']));
         $temp[] = array('v' => (string) Uteis::exibirHoras($r['horaRealizadaAluno']));
         $temp[] = array('v' => (int) (($r['horaRealizadaAluno']*100)/$r['horasProgramadas']));
         $rows[] = array('c' => $temp);
        }

    $table['rows'] = $rows;

    // convert data into JSON format
    $jsonTable = json_encode($table);
    echo $jsonTable;
