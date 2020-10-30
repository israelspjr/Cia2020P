<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$FolhaFrequencia = new FolhaFrequencia();
$DiaAulaFF = new DiaAulaFF();
$BancoHoras = new BancoHoras();
$BancoHorasAulasRepostas = new BancoHorasAulasRepostas();
/*
$AulaPermanenteGrupo = new AulaPermanenteGrupo();
$AulaDataFixa = new AulaDataFixa();
$IntegranteGrupo = new IntegranteGrupo();
$DiaAulaFFIndividual = new DiaAulaFFIndividual();
$Aviso = new Aviso();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$Professor = new Professor();
$TextoEmailPadrao = new TextoEmailPadrao();
$ClientePf = new ClientePf();
$GerenteTem = new GerenteTem();
$Funcionario = new Funcionario();

$Relatorio = new Relatorio();
$ClientePj = new ClientePj();
$PeriodoAcompanhamentoCurso = new PeriodoAcompanhamentoCurso();
$AcompanhamentoCurso = new AcompanhamentoCurso();
$RelatorioDesempenho = new RelatorioDesempenho();
$OcorrenciaFF = new OcorrenciaFF();

$Idioma = new Idioma();*/


$arrayRetorno = array();

$ids = explode(",",$_REQUEST['ids']);

//Uteis::pr($ids);

//if ($ids != '') {
	foreach($ids as $valor) {
		$idFolhaFrequencia = $valor;

        $rsDiaAulaFF = $DiaAulaFF->selectDiaAulaFF(" WHERE folhaFrequencia_idFolhaFrequencia = " . $idFolhaFrequencia);

        $valorFolhaFrequencia = $FolhaFrequencia->selectFolhaFrequencia(" WHERE idFolhaFrequencia = " . $idFolhaFrequencia);
        $dataReferencia = $valorFolhaFrequencia2[0]['dataReferencia'];
        $idPlanoAcaoGrupo = $valorFolhaFrequencia[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];

        $dataReferenciaFinal2 = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia2))));

        foreach ($rsDiaAulaFF as $valorDiaAulaFF) {
            $idDiaAulaFF = $valorDiaAulaFF['idDiaAulaFF'];
            $BancoHoras->deleteBancoHoras(" OR diaAulaFF_idDiaAulaFF = " . $idDiaAulaFF . " AND (credDeb is null or credDeb = 0)");
            $BancoHorasAulasRepostas->deleteBancoHorasAulasRepostasPlanoAcaoGrupo($idDiaAulaFF . " or (dataReferenciaFinal >= '" . $dataReferenciaFinal2 . "' And planoAcaoGrupo_idPlanoAcaoGrupo = " . $idPlanoAcaoGrupo . ")");
        }

        $FolhaFrequencia->setIdFolhaFrequencia($idFolhaFrequencia);
        $FolhaFrequencia->updateFieldFolhaFrequencia("finalizadaPrincipal", 0);
	}
//}
        $arrayRetorno['mensagem'] = "Desfinalizado[financeiro] com sucesso";
        $arrayRetorno['pagina'] = CAMINHO_REL . "grupo/cadastro.php?id=" . $idPlanoAcaoGrupo;
		$arrayRetorno['atualizarNivelAtual'] = true;


echo json_encode($arrayRetorno);
?>