<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$idiomaProfessor = new IdiomaProfessor();

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];
$idProfessor = $_REQUEST['idProfessor'];
$idClientePj = $_REQUEST['clientePj_idClientePj'];
$idPais = $_REQUEST['pais_idPais'];
$idCertificadoCurso = $_REQUEST['idCertificadoCurso'];


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

//MONTA FILTROS
 /*
$comGrupo = $_POST['comGrupo'];

$agp = new AulaGrupoProfessor();  
  $ids = $agp->selectAulaGrupoProfessor(" WHERE dataFim >= CURDATE() OR dataFim IS NULL OR dataFim = ''");
  $cont = 1;
  foreach ($ids as $key => $value) {
      if($cont > 1)    
        $prof .= ",".$value['professor_idProfessor'];
      else
        $prof = $value['professor_idProfessor'];
     
     $cont++;     
  }
  */
  
$sql = " SELECT DISTINCT(P.idProfessor) FROM professor AS P ";

if ($idCertificadoCurso >0) {
					$sql .= " INNER JOIN formacaoPerfil AS FP on FP.professor_idProfessor = P.idProfessor";
					$sql .= " WHERE FP.curso = ".$idCertificadoCurso;
				} else {
		$sql .= "		INNER JOIN aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
				LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
				LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
				INNER JOIN planoAcaoGrupo AS PAG ON PAG.inativo = 0 AND 
					(PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo)";
				
					if ($idPais > 0) {
					$sql .= " INNER JOIN vivenciaProfessor AS VP on VP.professor_idProfessor = P.idProfessor";	
					
				} else {
					$sql .= " INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo AND G.inativo = 0 ";
				}
				
				
				
				if ($idClientePj > 0) {
					$sql .= " INNER JOIN grupoClientePj AS GCP on G.idGrupo = GCP.grupo_idGrupo";
				}
				
				
				
					$sql .= " WHERE ( AGP.dataFim >= CURDATE() OR AGP.dataFim IS NULL OR AGP.dataFim = '') ";
				}
				if ($idClientePj > 0) {
					
					$sql .= " AND GCP.clientePj_idClientePj = ".$idClientePj;
				}
				
				if ($idPais > 0) {
					$sql .= " AND VP.pais_idPais = ".$idPais;	
					
				}
				
				
				if( $idioma != '' ){
					
				$where .= " AND PR.idProfessor in (".$merge.")";		
					
				}
				
				if ($idProfessor > 0 ) {
//				$sql .= " AND P.idProfessor = ".$idProfessor;	
				$where .= " AND PR.idProfessor = ".$idProfessor;	
					
				}
		//		echo $sql;
				
	$rs = Uteis::executarQuery($sql);
	$prof = "0";
	for ($x=0;$x<count($rs);$x++) {
	
	$prof .= ",".$rs[$x]['idProfessor'];	
		
	}
	
	if ($idPais == '') {
 
 if($idProfessor == '')  {
  
$comGrupo = $_POST['comGrupo'];
if($comGrupo!=""){ 
if($comGrupo > 0){ 
  $where .= " AND PR.idProfessor in(".$prof.")";
}else{
  $where .= " AND PR.idProfessor not in(".$prof.")";  
}
}

$contratado = $_POST['contratado'];
$candidato = $_POST['candidato'];

if($contrado!="" && $candidato==""){
   $where .= " AND PR.candidato = 0"; 
}elseif($contrado=="" && $candidato!=""){
   $where .= " AND PR.candidato = 1";  
}

$naoReceberEmail = $_POST['naoReceberEmail'];
if($naoReceberEmail!=""){
         $where .= " AND PR.naoReceberEmail =".$naoReceberEmail;
}

$status = $_POST['status'];
if($status!=""){
    $where .= " AND PR.inativo = $status";
}

 }

$otima = $_POST['otima'];
if($otima)
$where .=" AND PR.otimaPerformance = 1";

$alta = $_POST['alta']; 
if($alta)
$where .=" AND PR.altaPerformance = 1";


//if($idIdioma!="")
//$where .= " AND IP.idioma_idIdioma =".$idIdioma;

$dataContratacao1 = Uteis::gravarData($_POST['dataContratacao1']);
$dataContratacao2 = Uteis::gravarData($_POST['dataContratacao2']);
if (($dataContratacao1!="") && ($dataContratacao2 != "")) {
$where .= " AND PR.dataContratacao between '".$dataContratacao1."'  AND '".$dataContratacao2."' ";	
}

$excluido = isset($_REQUEST['excluido'])? $_REQUEST['excluido']: 0;
if ($excluido == 1) {
	$where .= " AND PR.excluido = 1";
} else {
	$where .= " AND PR.excluido = 0";
}

$vetado = $_REQUEST['vetado'];
if ($vetado != '') {
	if ($vetado == '1') {
		$where .= " AND PR.vetado = 1";
	} else {
		$where .= " AND PR.vetado = 0";
	}
}


$terceiro = $_REQUEST['terceiro'];
if ($terceiro == '1') {
	$where .= " AND PR.terceiro = 1";
} else {
	$where .= " AND PR.terceiro = 0";
}

	} else {
		
	$where .= " AND PR.idProfessor in(".$prof.")";
		
	}
	
	if ($idCertificadoCurso > 0) {
		$where .= " AND PR.idProfessor in(".$prof.")";
	}
//echo $where;