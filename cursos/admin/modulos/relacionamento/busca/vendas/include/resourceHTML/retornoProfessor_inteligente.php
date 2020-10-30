<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();
$EstadoCivil = new EstadoCivil();
$Pais = new Pais();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$DisponibilidadeProfessor = new DisponibilidadeProfessor();

$idBuscaProfessor = $_REQUEST['idBuscaProfessor'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

$where = "";

$zona = $_REQUEST['zona'];
if($zona){
	$where .= " AND LA.zonaAtendimentoCidade_idZonaAtendimentoCidade IN (
		SELECT DISTINCT(Z.idZonaAtendimentoCidade) FROM buscaProfessor AS B 
		LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = B.aulaPermanenteGrupo_idAulaPermanenteGrupo
		LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = B.aulaDataFixa_idAulaDataFixa
		INNER JOIN planoAcaoGrupo AS PAG 
			ON (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
		INNER JOIN endereco AS E ON E.idEndereco = COALESCE(AF.endereco_idEndereco, AP.endereco_idEndereco)
		INNER JOIN zonaAtendimentoCidade AS Z ON Z.idZonaAtendimentoCidade = E.zonaAtendimentoCidade_idZonaAtendimentoCidade
		WHERE B.iDbuscaProfessor = $idBuscaProfessor
	) ";
}

$cidade = $_REQUEST['cidade'];
if($cidade){
	$where .= " AND LA.zonaAtendimentoCidade_idZonaAtendimentoCidade IN (
		SELECT DISTINCT(Z.idZonaAtendimentoCidade) FROM buscaProfessor AS B 
		LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = B.aulaPermanenteGrupo_idAulaPermanenteGrupo
		LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = B.aulaDataFixa_idAulaDataFixa
		INNER JOIN planoAcaoGrupo AS PAG 
			ON (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
		INNER JOIN endereco AS E ON E.idEndereco = COALESCE(AF.endereco_idEndereco, AP.endereco_idEndereco)
		INNER JOIN cidade AS C ON C.idCidade = E.cidade_idCidade
		INNER JOIN zonaAtendimentoCidade AS Z ON Z.cidade_idCidade = C.idCidade
		WHERE B.iDbuscaProfessor = $idBuscaProfessor
	)";
}

$perfil = $_REQUEST['perfil'];
if($perfil){
	$where .= " AND AE.idAtividadeExtraProfessor IN(
		SELECT DISTINCT (OAEC.atividadeExtraProfessor_idAtividadeExtraProfessor)
		FROM integranteGrupo AS IG 
		INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo  = IG.planoAcaoGrupo_idPlanoAcaoGrupo 
		INNER JOIN opcaoAtividadeExtraProfessorClientePf AS OAEC ON OAEC.clientePf_idClientePf = IG.clientePf_idClientePf 
		WHERE PAG.idPlanoAcaoGrupo = $idPlanoAcaoGrupo	
	)";
}
	
$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);

$where_param = " AND P.idProfessor NOT IN (
	SELECT DISTINCT(professor_idProfessor) FROM opcaoBuscaProfessorSelecionada 
	WHERE buscaProfessor_idBuscaProfessor = $idBuscaProfessor
) ".$where;


$disponibilidade = $_REQUEST['disponibilidade'];
if($disponibilidade){
	
	$rs = Uteis::executarQuery(" SELECT COALESCE(AP.horaInicio, AF.horaInicio) AS horaInicio, COALESCE(AP.horaFim, AF.horaFim) AS horaFim 
	,COALESCE(AP.diaSemana, (DATE_FORMAT(AF.dataAula, '%w')+1)) AS diaSemana
	FROM buscaProfessor AS B 
	LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = B.aulaPermanenteGrupo_idAulaPermanenteGrupo
	LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = B.aulaDataFixa_idAulaDataFixa
	INNER JOIN planoAcaoGrupo AS PAG 
		ON (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
	WHERE B.iDbuscaProfessor = $idBuscaProfessor");
	$horaInicio = $rs[0]['horaInicio'];
	$horaFim = $rs[0]['horaFim'];
	$diaSemana = $rs[0]['diaSemana'];
	
	$idProfessor_s = $Professor->selectProfessorContratadoTr_retornoBusca($where_param, $idIdioma, "apenas ids");	
	$idProfessor = $DisponibilidadeProfessor->idDisponibilidade_professor($idProfessor_s, $horaInicio, $horaFim, $diaSemana);
	
	$where_param .= " AND P.idProfessor IN (".$idProfessor.")";
	
}

$lucro = $_REQUEST['lucro'];
if($lucro){
	
	$rs = Uteis::executarQuery("SELECT SQL_CACHE valorHora FROM valorHoraGrupo 
	WHERE planoAcaoGrupo_idPlanoAcaoGrupo = $idPlanoAcaoGrupo AND (dataFim IS NULL OR dataFim = '') LIMIT 1");
	$valorHora = $rs[0]['valorHora'] ? ($rs[0]['valorHora']*($lucro/100)): "0";
	
	$idProfessor_s = $Professor->selectProfessorContratadoTr_retornoBusca($where_param, $idIdioma, "apenas ids");
	$idProfessor = $Professor->getPlanoCarreira_profs(explode(",",$idProfessor_s), $idIdioma, $valorHora);	
	$where_param .= " AND P.idProfessor IN (".$idProfessor.")";

}
$presencial = $_REQUEST['presencial'];
if($presencial){
    
  $where = " AND P.presencial = $presencial";
  $idProfessor_s = $Professor->selectProfessorContratadoTr_retornoBusca($where, $idIdioma, "apenas ids");
  $idProfessor =  implode(",",$idProfessor_s);
  $where_param .= " AND P.idProfessor IN (".$idProfessor.")"; 
}

$distancia = $_REQUEST['distancia'];
if($distancia){
  $where = " AND P.online = $distancia";
  $idProfessor_s = $Professor->selectProfessorContratadoTr_retornoBusca($where, $idIdioma, "apenas ids");
  $idProfessor =  implode(",",$idProfessor_s);
  $where_param .= " AND P.idProfessor IN (".$idProfessor.")";  
}
//echo $where_param;
?>

<div class="lista">
<table id="tb_lista_professores_inteligente" class="registros">
  <thead>
    <tr>
      <th>Nome</th>
      <th>Valor Hora</th>
      <th>Selecionar Professor</th>
    </tr>
  </thead>
  <tbody>
    <?php echo $Professor->selectProfessorContratadoTr_retornoBusca($where_param, $idIdioma, CAMINHO_REL."busca/vendas/include/acao/opcaoBuscaProfessorSelecionada.php", "&idBuscaProfessor=$idBuscaProfessor&mudarAba=#bt_busca_inteligente");?>
  </tbody>
  <tfoot>
    <tr>
      <th>Nome</th>
      <th>Valor Hora</th>
      <th>Selecionar Professor</th>
    </tr>
  </tfoot>
</table>
</div>

<script> tabelaDataTable('tb_lista_professores_inteligente');</script> 
