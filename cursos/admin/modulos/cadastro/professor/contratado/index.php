<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();
$idiomaProfessor= new IdiomaProfessor();

if( isset($_REQUEST["tr"]) ){
    
    $arrayRetorno = array();
    
    $idProfessor = $_REQUEST["idProfessor"];
	$ordem = $_REQUEST["ordem"];
    $saida = $Professor->selectProfessorContratadoTr(" AND P.idProfessor = $idProfessor", true, 1);
    $arrayRetorno["updateTr"] = $saida;
    $arrayRetorno["tabela"] = "#tb_lista_professor";
    $arrayRetorno["ordem"] = $ordem;
    
    echo json_encode($arrayRetorno);
    exit;       
}

//require ("include/acao/filtro.php");
//FILTROS
$where = "";

$nome = $_REQUEST['nome'];
if ($nome != '')   $where .= " AND p.nome like '%".$nome."%'";

$pais_idPais = $_POST['pais_idPais'];
if ($pais_idPais != '') $where .= " AND P.pais_idPais = ".$pais_idPais;

$cidadeOrigem = $_POST['cidadeOrigem'];
if ($cidadeOrigem != '') $where .= " AND P.cidadeOrigem = '".$cidadeOrigem."'";


$terceiro = $_POST['terceiro'];
if ($terceiro != '') $where .= " AND P.terceiro = ".$terceiro;

$status =  $_POST['status'];
if( $status != '' ) $where .= " AND P.inativo = ".$status;

$presencial =  $_POST['presencial'];
if( $presencial != '' ) $where .= " AND P.presencial = ".$presencial;

$online =  $_POST['online'];
if( $online != '' ) $where .= " AND P.online = ".$online;

$tradutor =  $_POST['tradutor'];
if( $tradutor != '' ) $where .= " AND P.tradutor = ".$tradutor;

$consultor =  $_POST['consultor'];
if( $consultor != '' ) $where .= " AND P.consultor = ".$consultor;

/*$skype =  $_POST['skype'];
if( $skype != '' ) {
	if ($skype != '-') {
		 $where .= " AND P.skype = ".$skype;
	}
}*/

$skype = $_REQUEST['skype'];
if ($skype == '1') { 
	$where .= " AND P.skype = 1";
}

$expSkype = $_REQUEST['expSkype'];
if ($expSkype == '1') {
	$where .= " AND P.expSkype = 1";	
}


$sexo = $_POST['sexo'];
if( $sexo != '' ) $where .= " AND P.sexo = '".$sexo."'";

$idioma = $_POST['idIdioma'];
$nivel = $_POST['idNivelLinguistico'];
$idSotaqueIdiomaProfessor = $_POST['idSotaqueIdiomaProfessor'];
if ($idSotaqueIdiomaProfessor != "-") {
	if ($idSotaqueIdiomaProfessor != "") {
		$whereSotaque = " AND sotaqueIdiomaProfessor_idSotaqueIdiomaProfessor  =". $idSotaqueIdiomaProfessor;
	}
}
$niveis = implode(",",$nivel);

$nivelF = $_POST['nivelF'];
if ($nivelF != "-") {
	if ($nivelF != "") {
		$andNivel = " AND nivelF  =". $nivelF;
	}
}

if ($nome == '') {

if( $idioma != '' ){

foreach($nivel as $conteudo){
if(strlen($conteudo)){
     $idsProfessor = $idiomaProfessor->getIdsProfessores("WHERE idioma_idIdioma =".$idioma." AND inativo = 0 AND nivelLinguistico_idNivelLinguistico in(".$niveis.")  ".$whereSotaque." ".$andNivel."");

}else{


 $idsProfessor = $idiomaProfessor->getIdsProfessores("WHERE idioma_idIdioma =".$idioma. " AND inativo = 0 ".$whereSotaque." ".$andNivel."");   
}
}
}else{

foreach($nivel as $conteudo){
if(strlen($conteudo)){
	 $idsProfessor = $idiomaProfessor->getIdsProfessores("WHERE nivelLinguistico_idNivelLinguistico in(".$niveis.") ".$whereSotaque." ".$andNivel."");
}else {
	 $idsProfessor = $idiomaProfessor->getIdsProfessores("WHERE 1" .$andNivel);
}
} 
}

//Uteis::pr($idsProfessor);

$merge = implode(",", $idsProfessor);
}

$otima = $_POST['otima'];
if( $otima != '' ) $where .= " AND P.otimaPerformance =".$otima;

$alta = $_POST['alta'];
if( $alta != '' ) $where .= " AND P.altaPerformance =".$alta;

$vet = $_POST['vet'];
if( $vet != '' ) $where .= " AND P.vetado =".$vet;

$disp =$_POST['disp'];
if( $disp != '' ) $where .= " AND P.indisponivel =".$disp;

//$nome = $_POST['nome'];
//if( $nome != '' ) $where .= " AND P.nome like '%".$nome."%'";

$comgrupos =  $_POST['comGrupo'];

  $dataContratacao1 = Uteis::gravarData($_POST['dataContratacao1']);
$dataContratacao2 = Uteis::gravarData($_POST['dataContratacao2']);
if (($dataContratacao1!="") && ($dataContratacao2 != "")) {
$where .= " AND P.dataContratacao between '".$dataContratacao1."'  AND '".$dataContratacao2."' ";
$whereG = " AND P.dataContratacao between '".$dataContratacao1."'  AND '".$dataContratacao2."' ";	
}

//  echo $where;
if ($nome == '') {
//if($comgrupos!=""){
	
	if ($comgrupos == 1) {
              
  $sql = "SELECT DISTINCT P.idProfessor FROM professor AS P INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor 
  LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
  LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
  INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND 
  (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
  INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo AND G.inativo = 0 
  WHERE ( AGP.dataFim >= CURDATE() OR AGP.dataFim IS NULL OR AGP.dataFim = '') AND P.idProfessor in (".$merge.") ".$whereG; // is not null"; 
//  echo $sql;  
  $resp = Uteis::executarQuery($sql);
  $ids="";
  foreach ($resp as $valor){
       foreach ($valor as $id){
                 $ids[]= $id;
       }
  }
  
  $merge = implode(",", $ids);
  
  $where .= " AND P.idProfessor in (".$merge.")";
	}
	
	elseif ($comgrupos == 2) { //sem grupos
//	$merge = implode(",",   $idsProfessor);
  
  //$where .= " AND P.idProfessor in (".$merge.")";
  	
	$sql = "SELECT DISTINCT P.idProfessor FROM  professor AS P    
    where P.idProfessor not in (SELECT DISTINCT P.idProfessor FROM professor AS P 
	    INNER JOIN
    aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
        LEFT JOIN
    aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
        LEFT JOIN
    aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
        INNER JOIN
    planoAcaoGrupo AS PAG ON PAG.inativo = 0
        AND (PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo
        OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)
        INNER JOIN
    grupo AS G ON G.idGrupo = PAG.grupo_idGrupo";
      //  AND G.inativo = 0
$sql .= " WHERE
    (AGP.dataFim >= CURDATE()
        OR AGP.dataFim IS NULL
        OR AGP.dataFim = ''))";
//        AND P.idProfessor not in (".$merge.") 
$sql .=   " and P.idProfessor in (".$merge.")";
	//	echo  $sql;
	 $resp = Uteis::executarQuery($sql);
  $ids="";
  foreach ($resp as $valor){
       foreach ($valor as $id){
                 $ids[]= $id;
       }
  }
  
   $merge2 = implode(",", $ids);
  
  $where .= " AND P.idProfessor in (".$merge2.")";
	
	}
	
	elseif ($comgrupos == 3) { //ambos
//	$merge = implode(",",   $idsProfessor);
  if( $nome == '' ) {
  $where .= " AND P.idProfessor in (".$merge.")";
  }
  


	
	}
	
}
/*$menor5grupos = isset($_REQUEST['menor5grupos'])? $_REQUEST['menor5grupos']: 0;
$excluido = isset($_REQUEST['excluido'])? $_REQUEST['excluido']: 0;
if ($excluido == 1) {
	$where .= " AND P.excluido = 1";
} else {
	$where .= " AND P.excluido = 0";
}*/

echo $where;
$menor5grupos = isset($_REQUEST['menor5grupos'])? $_REQUEST['menor5grupos']: 0;
$excluido = isset($_REQUEST['excluido'])? $_REQUEST['excluido']: 0;
if ($excluido == 1) {
	$where .= " AND P.excluido = 1";
} else {
	$where .= " AND P.excluido = 0";
}

$terceiro = isset($_REQUEST['terceiro'])? $_REQUEST['terceiro']: 0;

?>
<div class="linha-inteira">
  <button class="button gray" onclick="postForm('form_filtra_Grupos', '<?php echo CAMINHO_CAD."professor/contratado/include/acao/professor.php"?>')"> Exportar relatório</button>
</div>
  <div id="lista_professor" class="lista">
    <table id="tb_lista_professor" class="registros">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Idioma</th>
          <th>Nível</th>
          <th>Telefone</th>
          <th>Email</th>
          <th>Skype</th>
          <th>Grupos</th>
          <th>Status</th>
          <th>Obs</th>
        </tr>
      </thead>
      <tbody>
        <?php echo $Professor->selectProfessorContratadoTr($where, false, $comgrupos, $menor5grupos, false, $terceiro);?>

      </tbody>
      <tfoot>
        <tr>
          <th>Nome</th>
          <th>Idioma</th>
          <th>Nível</th>
          <th>Telefone</th>
          <th>Email</th>
          <th>Skype</th>
          <th>Grupos</th>
          <th>Status</th>
          <th>Obs</th>
        </tr>
      </tfoot>
    </table>
  </div>
</fieldset>
<script>
 //   tabelaDataTable('tb_lista_professor');
    eventDestacar(1);
	
	$(document).ready( function() {
  $('#tb_lista_professor').dataTable( {
	 	"aLengthMenu" : [[25, 50, 100, -1],[25, 50, 100, "Todos"]],
		"iDisplayLength": -1,
		 "oLanguage" : {
		
		"sSearch":       "Buscar:",
	    "sZeroRecords":  "Não foram encontrados resultados",
        "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ Registros",
		"sLengthMenu":   "_MENU_ Registros",
		 "sInfoFiltered": "(filtrado de _MAX_ Total de Registros)",
		 "sInfoEmpty":    "Mostrando de 0 até 0 de 0 Registros" ,
		 "oPaginate": {
        "sFirst":    "&lt;&lt;",
        "sPrevious": "&lt;",
        "sNext":     "&gt;",
        "sLast":     "&gt;&gt;"
    }},
        "sPaginationType" : "full_numbers", 
		"bInfo": true,
//		"order": [[1, "asc"]],
		"bJQueryUI" : true,
        "aoColumns" : [  null,  null, null, null, null, null, null, null, null ]
  } );
} );

	
</script> 
