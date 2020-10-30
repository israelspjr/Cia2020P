<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();
$EstadoCivil = new EstadoCivil();
$Pais = new Pais();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$buscaProfessor = new BuscaProfessor();
$AulaDataFixa = new AulaDataFixa();
$AulaPermanente = new AulaPermanenteGrupo();

$idBuscaProfessor = $_REQUEST['idBuscaProfessor'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];

$where = "";

$nome = $_POST['nome'];
if($nome != '')$where .= " AND P.nome like '%".$nome."%'";

$sexo = $_POST['sexo'];
if($sexo != '')$where .= " AND P.sexo like '%".$sexo."%'";

$pais_idPais = $_POST['pais_idPais'];
if($pais_idPais != '')$where .= " AND (P.pais_idPais like '%".$pais_idPais."%') ";

$dataContratacao = $_POST['dataContratacao'];
$dataContratacao2 = $_POST['dataContratacao2'];
if($dataContratacao && $dataContratacao2) $where .= " AND DATE(P.dataContratacao) BETWEEN '".Uteis::gravarData($dataContratacao)."' AND '".Uteis::gravarData($dataContratacao2)."' ";

$otimaPerformance = $_POST['otimaPerformance'];
if($otimaPerformance == '1')$where .= " AND P.otimaPerformance = 1";

$altaPerformance = $_POST['altaPerformance'];
if($altaPerformance == '1')$where .= " AND P.altaPerformance = 1";
	
$idNivelLinguistico = $_POST['idNivelLinguistico'];
if($idNivelLinguistico !="")$where .= " AND n.idNivelLinguistico = ".$idNivelLinguistico;

$skype = $_REQUEST['skype'];
if ($skype == '1') { 
	$where .= " AND P.skype = 1";
}

$expSkype = $_REQUEST['expSkype'];
if ($expSkype == '1') {
	$where .= " AND P.expSkype = 1";	
}
	
$idIdioma = $PlanoAcaoGrupo->getIdIdioma($idPlanoAcaoGrupo);

$local = $_POST['local'];
if ($local == 1) {

$idzona = $_REQUEST['idZonaAtendimentoCidade'];
if($idzona){
    $where .= " AND LA.zonaAtendimentoCidade_idZonaAtendimentoCidade IN ( ".$idzona.")";

}
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

$presencial = $_REQUEST['presencial'];
if($presencial){    
  $where = " AND P.presencial = $presencial";
}
$distancia = $_REQUEST['distancia'];
if($distancia){
  $where = " AND P.online = $distancia"; 
}

//echo $where;

$bairro = $_REQUEST['bairro'];
if ($bairro != "-") {
$array = explode(",",$bairro);

$cidade = $array[0];
$bairro = $array[1];

$where_param .= " AND E.cidade_idCidade = ".$cidade." AND bairro like '%".$bairro."%'";

}
$where_param .= " AND P.idProfessor NOT IN (
	SELECT professor_idProfessor FROM opcaoBuscaProfessorSelecionada 
	WHERE buscaProfessor_idBuscaProfessor = $idBuscaProfessor
) ".$where;

$datas = $buscaProfessor->selectBuscaProfessor("WHERE idBuscaProfessor = ".$idBuscaProfessor);
$dataReferencia = $datas[0]['dataApartir'];

$valorHoraGrupo = new ValorHoraGrupo();
$vhg = $valorHoraGrupo->selectValorHoraGrupo_periodo($idPlanoAcaoGrupo, $dataReferencia);

if($_POST['lucro']!=""){
    $valor = Uteis::exibirMoeda($vhg[0]['valorHora']);
    $lucro_val = BuscaProfessor::margemLucroAulas();
    $maximo = round(($vhg[0]['valorHora']*($lucro_val/100)),2);
    $ideal =  $lucro_val - 3;
    $desejavel = round(($vhg[0]['valorHora']*($ideal/100)),2);
    $lucro = array(
            "lucro" => $lucro_val,
            "maximo" => $maximo,
            "desejavel" => $desejavel
    );
}
//echo $where_param;
$menor5grupos = isset($_REQUEST['menor5grupos'])? $_REQUEST['menor5grupos']: 0;
?>

<div class="lista">
  <?php if($_POST['lucro']!=""){ ?>
  <p>
      Valor hora/aula: <b>R$: <?=$valor;?></b><br />
      Margem Bruta máxima: <b>R$: <?=$maximo?></b><br />
      Margem Bruta desejável (<strong style="color:#FF0000;">não ultrapassar</strong>): <b>R$: <?=$desejavel?></b><br />
  </p>
  <?php } ?>
  <table id="tb_lista_professores2" class="registros">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Quantidade de grupos</th>
        <th>Disponibilidade</th>
        <th> Nível </th>
        <th>Valor Hora</th>        
        <th>Selecionar Professor</th>
      </tr>
    </thead>
    <tbody>
      <?php echo $Professor->selectProfessorContratadoTr_retornoBusca($where_param, $idIdioma, $idBuscaProfessor, CAMINHO_REL."busca/vendas/include/acao/opcaoBuscaProfessorSelecionada.php", "&idBuscaProfessor=$idBuscaProfessor&mudarAba=#bt_busca&menor5grupos=$menor5grupos", $lucro, $data, $idPlanoAcaoGrupo);?>
    </tbody>
    <tfoot>
      <tr>
        <th>Nome</th>        
        <th>Quantidade de grupos</th>
        <th>Disponibilidade</th>
         <th> Nível </th>
        <th>Valor Hora</th>
        <th>Selecionar Professor</th>
      </tr>
    </tfoot>
  </table>
</div>

<script> tabelaDataTable('tb_lista_professores2');</script> 
