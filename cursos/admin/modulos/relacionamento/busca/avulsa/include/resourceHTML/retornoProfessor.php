<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();
$Pais = new Pais();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$DiasBuscaAvulsa = new DiasBuscaAvulsa();
$BuscaAvulsa = new BuscaAvulsa();
//$valorHoraGrupo = new ValorHoraGrupo();

$idDiasBuscaAvulsa = $_REQUEST['idDiasBuscaAvulsa'];
$idBuscaAvulsa = $_REQUEST['idBuscaAvulsa'];
$idIdioma = $_REQUEST['idIdioma'];
$menor5grupos = isset($_REQUEST['menor5grupos'])? $_REQUEST['menor5grupos']: 0;;
$where = "";

$nome = $_POST['nome'];
if($nome != '') $where .= " AND P.nome like '%".$nome."%'";

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
	
$idNivelLinguistico = implode(",", $_POST['idNivelLinguistico']);
if($idNivelLinguistico !="-") {
	if($idNivelLinguistico !="") {
	$where .= " AND n.idNivelLinguistico in ( ".$idNivelLinguistico.")";
	}
}

$idSotaqueIdiomaProfessor = $_POST['idSotaqueIdiomaProfessor'];
if($idSotaqueIdiomaProfessor != "") $where .= " AND I.sotaqueIdiomaProfessor_idSotaqueIdiomaProfessor = ".$idSotaqueIdiomaProfessor;

$otimaPerformance = $_POST['otimaPerformance'];
if($otimaPerformance == '1') 
$where .= " AND (P.otimaPerformance = 1) ";


$altaPerformance = $_POST['altaPerformance'];
if($altaPerformance == '1') 
$where .= " AND (P.altaPerformance = 1) ";


$indisponivel = $_POST['indisponivel'];
if($indisponivel == '1') 
$where .= " AND (P.indisponivel = 0) ";
elseif ($indisponivel =='2') {
	$where .= " AND (P.indisponivel = 1) ";
} elseif ($indisponivel == '3') {
	$where .= " ";
}

$tradutor = $_POST['tradutor'];
if($tradutor == '1') 
$where .= " AND (P.tradutor = 1) ";
  

$consultor = $_POST['consultor'];
if($consultor == '1') 
$where .= " AND (P.consultor = 1) ";


$imersao = $_POST['imersao'];
if($imersao == '1') 
$where .= " AND (P.imersao = 1) ";


$online = $_POST['online'];
if($online == '1') 
$where .= " AND (P.online = 1) ";

$presencial = $_POST['presencial'];
if($presencial == '1') 
$where .= " AND (P.presencial = 1) ";

$skype = $_REQUEST['skype'];
if ($skype == '1') {
	$where .= " AND P.skype = 1";
}

$terceiro = $_REQUEST['terceiro'];
if ($terceiro == '1') {
	$where .= " AND P.terceiro = 1";
}

$expSkype = $_REQUEST['expSkype'];
if ($expSkype == '1') {
	$where .= " AND P.expSkype = 1";	
}
	

$local = $_POST['local'];

if ($local == 1) {
	$idZona = $_POST['idZonaAtendimentoCidade'];
	$where .= " AND LA.zonaAtendimentoCidade_idZonaAtendimentoCidade = ".$idZona;

}

$dataContratacao1 = Uteis::gravarData($_POST['dataContratacao1']);
$dataContratacao2 = Uteis::gravarData($_POST['dataContratacao2']);
if (($dataContratacao1!="") && ($dataContratacao2 != "")) {
$where .= " AND P.dataContratacao between '".$dataContratacao1."'  AND '".$dataContratacao2."' ";	
}

$dias = $DiasBuscaAvulsa->selectDiasBuscaAvulsa("WHERE idDiasBuscaAvulsa = ".$idDiasBuscaAvulsa);

$data['semana'] = $dias[0]['diaSemanaAula'];
$data['tipo'] = $dias[0]['tipo'];
$data['horaInicio'] = $dias[0]['horaInicio'];
$data['horaFim'] = $dias[0]['horaFim'];

$busca = $BuscaAvulsa->selectBuscaAvulsa(" WHERE idBuscaAvulsa = ".$idBuscaAvulsa);

$vhg = $busca[0]['valorHoraAluno'];

 
$where_param = " AND P.idProfessor NOT IN (
    SELECT professor_idProfessor FROM diasBuscaAvulsaProfessor 
    WHERE diasBuscaAvulsa_idDiasBuscaAvulsa = $idDiasBuscaAvulsa 
) ".$where;


//echo $where_param;
//Uteis::pr($data);

// Moradia Professor

$bairro = $_REQUEST['bairro'];
if ($bairro != "-") {
$array = explode(",",$bairro);

$cidade = $array[0];
$bairro = $array[1];

$where_param .= " AND E.cidade_idCidade = ".$cidade." AND bairro like '%".$bairro."%'";

}

$where_param .= " group by P.idProfessor order by P.nome";


//$vhg = $valorHoraGrupo->selectValorHoraGrupo_periodo($idPlanoAcaoGrupo, $dataReferencia);


if($_POST['lucro']!=""){
    $valor = Uteis::exibirMoeda($vhg);
    $lucro_val = BuscaProfessor::margemLucroAulas();
    $maximo = round(($vhg*($lucro_val/100)),2);
    $ideal =  $lucro_val - 3;
    $desejavel = round(($vhg*($ideal/100)),2);
    $lucro = array(
            "lucro" => $lucro_val,
            "maximo" => $maximo,
            "desejavel" => $desejavel
    );
}

?>

<div class="lista">
 <?php if($_POST['lucro']!=""){ ?>
  <p>
      Valor hora/aula: <b>R$: <?=$valor;?></b><br />
      Margem Bruta máxima: <b>R$: <?=$maximo?></b><br />
      Margem Bruta desejável (<strong style="color:#FF0000;">não ultrapassar</strong>): <b>R$: <?=$desejavel?></b><br />
  </p>
  <?php } ?>
  <table id="tb_lista_professores" class="registros">
    <thead>
      <tr>
        <th>Nome</th>
        <th>Quantidade de grupos</th>
        <th>Disponibilidade</th>
        <th>Nível</th>
        <th>Valor Hora</th>        
        <th>Selecionar Professor</th>
        
      </tr>
    </thead>
    <tbody>
      <?php echo $Professor->selectProfessorContratadoTr_retornoBusca($where_param, $idIdioma, $idDiasBuscaAvulsa, CAMINHO_REL."busca/avulsa/include/acao/diasBuscaAvulsaProfessor.php", "&idBuscaAvulsa=$idBuscaAvulsa&idDiasBuscaAvulsa=$idDiasBuscaAvulsa&idIdioma=$idIdioma&ondeAtualizar=buscaProfessor&menor5grupos=$menor5grupos", $lucro, $data, $idPlanoAcaoGrupo);?>
    </tbody>
    <tfoot>
      <tr>
        <th>Nome</th>
        <th>Quantidade de grupos</th>
        <th>Disponibilidade</th>
        <th>Nível</th>
        <th>Valor Hora</th>        
        <th>Selecionar Professor</th>
                
      </tr>
    </tfoot>
  </table>
</div>

<script> tabelaDataTable('tb_lista_professores', 'simples');</script> 