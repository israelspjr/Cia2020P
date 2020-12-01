<?php
class Relatorio extends Database {
  // constructor
  function __construct() {
    parent::__construct();
  }

  function __destruct() {
    parent::__destruct();
  }

  function montaTb_avancado($colunas = array(), $colunasNome = array(), $excel = false, $colspan = array(), $head = "", $numero) {
    $html_colunas = "";
	
	 if ($excel) {
            $html .= "<table border=\"1\">";
    } else {
		if ($numero != '') {
	        $html .= "<table id=\"tb_lista_res".$numero."\" class=\"registros\" >";
		} else {
	        $html .= "<table id=\"tb_lista_res\" class=\"registros\" >";			
		}
    }    
	
    for ($i = 0; $i < count($colunas); $i++) {
      if (array_key_exists($colunas[$i], $colspan)) {
        for ($x = 0; $x < $colspan[$colunas[$i]]; $x++)
          $html_colunas .= "<th>" . $colunasNome[$i] . "</th>";
      } else {
        $html_colunas .= "<th>" . $colunasNome[$i] . "</th>";
      }
    }

    if ($excel) {
      $html .= "<thead><tr>" . $html_colunas . "</tr></thead>";
            
    } else {
   	  if($head==1){
   	  	$html .= "<thead><tr>" . $html_colunas . "</tr></thead>";
   	  }else if($head==2){
   	  	$html .= "<tfoot><tr>" . $html_colunas . "</tr></tfoot></table>";
   	  } else{
   	  	$html .= "<thead><tr>" . $html_colunas . "</tr></thead>
   	  			  <tfoot><tr>" . $html_colunas . "</tr></tfoot>";
   	  }	
    }    
    return $html;
}

function montaTb($colunas = array(), $excel = false, $colspan = array(),$numero) {

    $html_colunas = "";
    
    foreach ($colunas as $col)
      $html_colunas .= "<td>" . $col . "</td>";

    if ($excel) {
      $html .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />";
      $html .= "<table border=\"1\"><tr>" . $html_colunas . "</tr>";
    } else {
		if  ($numero >= 1) {
			  $html .= "<table id=\"tb_lista_res".$numero."\" class=\"registros\">";
		} else {
      $html .= "<table id=\"tb_lista_res\" class=\"registros\">";
		}
      $html .= " <thead><tr>" . $html_colunas . "</tr></thead>
      <tfoot><tr>" . $html_colunas . "</tr></tfoot>";
    }
    
    return $html;

  }
  
function montaTbPdf($colunas = array(), $excel = false, $colspan = array(),$numero) {

    $html_colunas = "";
    
    foreach ($colunas as $col)
      $html_colunas .= "<td>" . $col . "</td>";
	  $html .= "<table border=\"1\"><tr>" . $html_colunas . "</tr>";
    
    return $html;
}
  
  
function relatorioFrequencia_porAula($where="", $soFinalizadasPri = true){
        
    $sql = "SELECT SQL_CACHE COALESCE(PJ.razaoSocial, 'Particular') AS empresa, CPF.idClientePf, G.nome AS grupo, CPF.nome AS aluno, PRF.nome AS nomeProfessor, IG.dataEntrada,
    MONTH(FF.dataReferencia) AS mes, YEAR(FF.dataReferencia) AS ano, DAY(DAF.dataAula) AS diaAula, 
    COALESCE((AP.horaFim-AP.horaInicio), (AF.horaFim-AF.horaInicio), 'Reposição') AS horasProgramadas, 
    DAF.horaRealizada AS horasRealizadasPeloGrupo, 
    COALESCE(( 
      SELECT SUM(COALESCE((AP2.horaFim-AP2.horaInicio), (AF2.horaFim-AF2.horaInicio), 0)) - COALESCE(SUM(DAF2.horaRealizada),0)
      FROM diaAulaFF AS DAF2 
      INNER JOIN ocorrenciaFF AS OC2 ON OC2.idOcorrenciaFF = DAF2.ocorrenciaFF_idOcorrenciaFF AND OC2.reporAula = 0 
      LEFT JOIN aulaPermanenteGrupo AS AP2 ON AP2.idAulaPermanenteGrupo = DAF2.aulaPermanenteGrupo_idAulaPermanenteGrupo 
      LEFT JOIN aulaDataFixa AS AF2 ON AF2.idAulaDataFixa = DAF2.aulaDataFixa_idAulaDataFixa 
      WHERE DAF2.idDiaAulaFF = DAF.idDiaAulaFF
      AND (DAF2.aulaPermanenteGrupo_idAulaPermanenteGrupo IS NOT NULL OR DAF2.aulaDataFixa_idAulaDataFixa IS NOT NULL)  
    ), 0) AS somarCom_horasRealizadasPeloGrupo, 
    OC.sigla, DAFI.horaRealizadaAluno, DAFI.obsFaltaJustificada, DAFI.idDiaAulaFFIndividual, DAFI.obs
    FROM grupo AS G 
    INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo
    INNER JOIN integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
		AND IG.dataSaida is null  
    INNER JOIN clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf
    INNER JOIN folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo ";
    
    if( $soFinalizadasPri ){
      $sql .= " AND FF.finalizadaPrincipal = 1 ";
    }else{
      $sql .= " AND FF.finalizadaParcial = 1 ";
    }
    
    $sql .= " INNER JOIN diaAulaFF AS DAF ON DAF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia AND DAF.aulaInexistente = 0 
    LEFT JOIN ocorrenciaFF AS OC ON OC.idOcorrenciaFF = DAF.ocorrenciaFF_idOcorrenciaFF
    LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = DAF.aulaPermanenteGrupo_idAulaPermanenteGrupo
    LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = DAF.aulaDataFixa_idAulaDataFixa
    INNER JOIN professor AS PRF ON PRF.idProfessor = FF.professor_idProfessor
    LEFT JOIN diaAulaFFIndividual AS DAFI ON 
      DAFI.diaAulaFF_idDiaAulaFF = DAF.idDiaAulaFF AND DAFI.integranteGrupo_idIntegranteGrupo = IG.idIntegranteGrupo
    LEFT JOIN grupoClientePj AS GPJ ON GPJ.grupo_idGrupo = G.idGrupo
    LEFT JOIN clientePj AS PJ ON PJ.idClientePj = GPJ.clientePj_idClientePj 
	LEFT JOIN bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DAF.idDiaAulaFF " . $where.
    " AND (IG.dataSaida IS NULL OR IG.dataSaida = '') ORDER BY diaAula "; //AND PJ.idClientePj = CPF.clientePj_idClientePj ORDER BY DAF.dataAula ";
//  echo $sql;
    return Uteis::executarQuery($sql);
         
}
  
function relatorioFrequencia_mensal($where="", $soFinalizadasPri = false, $dem = false, $dataReferenciaFinal, $tipoR){
    
    $sql = "SELECT SQL_CACHE 
    COALESCE(PJ.razaoSocial, 'Particular') AS empresa, G.nome AS grupo, G.idGrupo, CPF.nome AS aluno, CPF.idClientePf, PRF.nome AS nomeProfessor, 
    FF.idFolhaFrequencia, PRF.idProfessor, PJ.idClientePj, IG.idIntegranteGrupo, PAG.idPlanoAcaoGrupo, MONTH(FF.dataReferencia) AS mes, YEAR(FF.dataReferencia) AS ano,   
    SUM(COALESCE((AP.horaFim-AP.horaInicio), (AF.horaFim-AF.horaInicio), 0)) AS horasProgramadas,
    SUM(DAF.horaRealizada) AS horasRealizadasPeloGrupo, 
    (
      SELECT SUM(COALESCE((AP2.horaFim-AP2.horaInicio), (AF2.horaFim-AF2.horaInicio), 0)) - COALESCE(SUM(DAF2.horaRealizada),0)
      FROM diaAulaFF AS DAF2 
      INNER JOIN ocorrenciaFF AS OC2 ON OC2.idOcorrenciaFF = DAF2.ocorrenciaFF_idOcorrenciaFF AND ((OC2.reporAula = 1 AND OC2.pagarProfessor = 1) or OC2.reporAula = 0) AND OC2.excluido = 0 
      LEFT JOIN aulaPermanenteGrupo AS AP2 ON AP2.idAulaPermanenteGrupo = DAF2.aulaPermanenteGrupo_idAulaPermanenteGrupo 
      LEFT JOIN aulaDataFixa AS AF2 ON AF2.idAulaDataFixa = DAF2.aulaDataFixa_idAulaDataFixa 
      WHERE DAF2.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
      AND (DAF2.aulaPermanenteGrupo_idAulaPermanenteGrupo IS NOT NULL OR DAF2.aulaDataFixa_idAulaDataFixa IS NOT NULL) 
    ) AS somarCom_horasRealizadasPeloGrupo,
    SUM(DAFI.horaRealizadaAluno) AS horaRealizadaAluno,
    (
      SELECT sum(CASE
                    WHEN
                        DAF4.ocorrenciaFF_idOcorrenciaFF  IN ( 2, 10, 15)
                    THEN
                        COALESCE((AP4.horaFim - AP4.horaInicio),
                                (AF4.horaFim - AF4.horaInicio),
                                0) - COALESCE(DAF4.horaRealizada, 0)
                    ELSE ( DAF4.horaRealizada - DAFI4.horaRealizadaAluno)
                END)  FROM diaAulaFF AS DAF4        
      INNER JOIN diaAulaFFIndividual AS DAFI4 ON DAFI4.diaAulaFF_idDiaAulaFF = DAF4.idDiaAulaFF
	  LEFT JOIN
			integranteGrupo as IG4 on IG4.idIntegranteGrupo = DAFI4.integranteGrupo_idIntegranteGrupo
	  LEFT JOIN
			clientePf as CPF4 on IG4.clientePf_idClientePf = CPF4.idClientePf
	  LEFT JOIN
            aulaPermanenteGrupo AS AP4 ON AP4.idAulaPermanenteGrupo = DAF4.aulaPermanenteGrupo_idAulaPermanenteGrupo
                LEFT JOIN
            aulaDataFixa AS AF4 ON AF4.idAulaDataFixa = DAF4.aulaDataFixa_idAulaDataFixa
      WHERE DAF4.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia 
	  AND CPF4.idClientePf = CPF.idClientePf
	  AND DAFI4.faltaJustificada = 1 
    ) AS aulasJustificadas_aluno,
    SUM(COALESCE(BH.horas,0)) AS bancoHoras, 
    (
      SELECT SUM(horaRealizada) FROM diaAulaFF AS DAF3        
      WHERE DAF3.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia 
      AND DAF3.reposicao = 1
    ) AS reposicao ,
    ";
    if($dem){
        $sql.="(SELECT 
            SUM(COALESCE((AP2.horaFim - AP2.horaInicio),
                        (AF2.horaFim - AF2.horaInicio),
                        0)) - COALESCE(SUM(DAF2.horaRealizada), 0)
        FROM
            diaAulaFF AS DAF2
                INNER JOIN
            ocorrenciaFF AS OC2 ON OC2.idOcorrenciaFF = DAF2.ocorrenciaFF_idOcorrenciaFF
                AND OC2.idOcorrenciaFF = 9
                LEFT JOIN
            aulaPermanenteGrupo AS AP2 ON AP2.idAulaPermanenteGrupo = DAF2.aulaPermanenteGrupo_idAulaPermanenteGrupo
                LEFT JOIN
            aulaDataFixa AS AF2 ON AF2.idAulaDataFixa = DAF2.aulaDataFixa_idAulaDataFixa
        WHERE
            DAF2.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                AND (DAF2.aulaPermanenteGrupo_idAulaPermanenteGrupo IS NOT NULL
                OR DAF2.aulaDataFixa_idAulaDataFixa IS NOT NULL)) AS CSAesp ,";
    }
    $sql.="
    (
      SELECT COALESCE(SUM(PAC.valor), 0)
      FROM planoAcaoGrupoAjudaCusto AS PAC
      WHERE PAC.excluido = 0 AND PAC.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo AND PAC.professor_idProfessor = PRF.idProfessor
      AND FF.dataReferencia >= CAST(CONCAT(PAC.anoIni, '-', PAC.mesIni, '-01') AS DATE)
      AND ( 
        FF.dataReferencia <= CAST(CONCAT(PAC.anoFim,'-', PAC.mesFim, '-01') AS DATE) 
        OR 
        (PAC.anoFim IS NULL AND PAC.mesFim IS NULL)
      ) AND PAC.porDia = 1 
    ) AS ajudaCustoDia,
    (
      SELECT COALESCE(SUM(PAC.valor), 0)
      FROM planoAcaoGrupoAjudaCusto AS PAC
      WHERE PAC.excluido = 0 AND PAC.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo AND PAC.professor_idProfessor = PRF.idProfessor
      AND FF.dataReferencia >= CAST(CONCAT(PAC.anoIni, '-', PAC.mesIni, '-01') AS DATE)
      AND ( 
        FF.dataReferencia <= CAST(CONCAT(PAC.anoFim,'-', PAC.mesFim, '-01') AS DATE) 
        OR 
        (PAC.anoFim IS NULL AND PAC.mesFim IS NULL)
      ) AND PAC.porDia = 0 
    ) AS ajudaCustoHora,
    (
      SELECT COUNT(DISTINCT(DFF2.dataAula)) 
      FROM diaAulaFF AS DFF2 
      INNER JOIN folhaFrequencia AS FF2 ON FF2.idFolhaFrequencia = DFF2.folhaFrequencia_idFolhaFrequencia
      WHERE DFF2.aulaInexistente = 0 AND FF2.idFolhaFrequencia = FF.idFolhaFrequencia 
      AND DFF2.horaRealizada > 0  
    ) AS diasAula_pagarProf,
    (
      SELECT COUNT(DISTINCT(DFF2.dataAula)) 
      FROM diaAulaFF AS DFF2 
      INNER JOIN folhaFrequencia AS FF2 ON FF2.idFolhaFrequencia = DFF2.folhaFrequencia_idFolhaFrequencia
      WHERE DFF2.aulaInexistente = 0 AND FF2.idFolhaFrequencia = FF.idFolhaFrequencia 
      AND (
        DFF2.ocorrenciaFF_idOcorrenciaFF IN (
          SELECT OC2.idOcorrenciaFF FROM ocorrenciaFF AS OC2 WHERE OC2.reporAula = 0 AND OC2.excluido = 0
        )
        OR 
        DFF2.ocorrenciaFF_idOcorrenciaFF IS NULL
      )
    ) AS diasAula_ocorridos,
    (
      SELECT COUNT(DISTINCT(DFF2.dataAula)) 
      FROM diaAulaFF AS DFF2 
      INNER JOIN folhaFrequencia AS FF2 ON FF2.idFolhaFrequencia = DFF2.folhaFrequencia_idFolhaFrequencia
      WHERE DFF2.aulaInexistente = 0 AND FF2.idFolhaFrequencia = FF.idFolhaFrequencia        
    ) AS diasAula_total,
	(SELECT 
            COUNT(DISTINCT (DFF2.dataAula))
        FROM
            diaAulaFF AS DFF2
                INNER JOIN
            folhaFrequencia AS FF2 ON FF2.idFolhaFrequencia = DFF2.folhaFrequencia_idFolhaFrequencia
        WHERE
            DFF2.aulaInexistente = 0
                AND FF2.idFolhaFrequencia = FF.idFolhaFrequencia
                AND (DFF2.ocorrenciaFF_idOcorrenciaFF IN (SELECT 
                    OC2.idOcorrenciaFF
                FROM
                    ocorrenciaFF AS OC2
                WHERE
                    OC2.reporAula = 0 AND OC2.excluido = 0)
                OR DFF2.ocorrenciaFF_idOcorrenciaFF IS NULL)) AS diasAula_ocorridos,
	 (SELECT sum(COALESCE((AP4.horaFim - AP4.horaInicio),
                                (AF4.horaFim - AF4.horaInicio),
                                0) - COALESCE(DAF4.horaRealizada)
                )  FROM diaAulaFF AS DAF4        
     
	  LEFT JOIN
            aulaPermanenteGrupo AS AP4 ON AP4.idAulaPermanenteGrupo = DAF4.aulaPermanenteGrupo_idAulaPermanenteGrupo
                LEFT JOIN
            aulaDataFixa AS AF4 ON AF4.idAulaDataFixa = DAF4.aulaDataFixa_idAulaDataFixa
      WHERE DAF4.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia  AND DAF4.ocorrenciaFF_idOcorrenciaFF  IN ( 2, 10, 15) 
    ) AS horasPerdidas,
	(SELECT GROUP_CONCAT(DAFI5.obsFaltaJustificada SEPARATOR '\n')  FROM
            diaAulaFF AS DAF5
                INNER JOIN
            diaAulaFFIndividual AS DAFI5 ON DAFI5.diaAulaFF_idDiaAulaFF = DAF5.idDiaAulaFF
                LEFT JOIN
            aulaPermanenteGrupo AS AP5 ON AP5.idAulaPermanenteGrupo = DAF5.aulaPermanenteGrupo_idAulaPermanenteGrupo
                LEFT JOIN
            aulaDataFixa AS AF5 ON AF5.idAulaDataFixa = DAF5.aulaDataFixa_idAulaDataFixa
        WHERE
            DAF5.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                AND DAFI5.integranteGrupo_idIntegranteGrupo = IG.idIntegranteGrupo
                AND DAFI5.faltaJustificada = 1 AND (DAF5.ocorrenciaFF_idOcorrenciaFF is null OR DAF5.ocorrenciaFF_idOcorrenciaFF not in (3,4))) AS obsAulasJustificadas_aluno,
	(SELECT VHG.cargaHorariaFixaMensal from valorHoraGrupo as VHG
	    WHERE VHG.dataInicio <= FF.dataReferencia AND (VHG.dataFim is null or VHG.dataFim > FF.dataReferencia) 
            AND VHG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
            limit 0,1) AS cargaHorariaFixa,
		(SELECT SUM(DAFF3.horaRealizada) FROM diaAulaFF as DAFF3 
        WHERE DAFF3.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
        AND  DAFF3.dataAula >= IG.dataEntrada) AS horasPossivel	
    FROM grupo AS G 
    INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo
    INNER JOIN integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo";

     $sql .=  " LEFT JOIN clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf
    INNER JOIN folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo"; 
      if( $soFinalizadasPri ){
      $sql .= " AND FF.finalizadaPrincipal = 1 ";
    }else{
 //     $sql .= " AND FF.finalizadaParcial = 1 ";
    }
    $sql .= " INNER JOIN diaAulaFF AS DAF ON DAF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia AND DAF.aulaInexistente = 0 AND DAF.banco = 0 
    LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = DAF.aulaPermanenteGrupo_idAulaPermanenteGrupo
    LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = DAF.aulaDataFixa_idAulaDataFixa
    INNER JOIN professor AS PRF ON PRF.idProfessor = FF.professor_idProfessor
    LEFT JOIN diaAulaFFIndividual AS DAFI ON 
      DAFI.diaAulaFF_idDiaAulaFF = DAF.idDiaAulaFF AND DAFI.integranteGrupo_idIntegranteGrupo = IG.idIntegranteGrupo
    LEFT JOIN grupoClientePj AS GPJ ON GPJ.grupo_idGrupo = G.idGrupo
    LEFT JOIN clientePj AS PJ ON PJ.idClientePj = GPJ.clientePj_idClientePj 
    LEFT JOIN bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DAF.idDiaAulaFF " . $where;    

	if ($tipoR != 1) {
		$sql .= " GROUP BY FF.idFolhaFrequencia, IG.idIntegranteGrupo";
	   	$sql .= " ORDER BY PAG.idPlanoAcaoGrupo, FF.dataReferencia ";
	} else {
		$sql .= " GROUP BY G.IdGrupo,CPF.idClientePf";
	}
	//echo $sql;
    return Uteis::executarQuery($sql);
}
  
function obsJustificativa($d1, $d2, $idClientePf) {
	$sql5 .= "SELECT (SELECT 
            GROUP_CONCAT(DAFI5.obsFaltaJustificada
                    SEPARATOR ' 
                    ')
        FROM
            diaAulaFF AS DAF5
                INNER JOIN
            diaAulaFFIndividual AS DAFI5 ON DAFI5.diaAulaFF_idDiaAulaFF = DAF5.idDiaAulaFF
                LEFT JOIN
            aulaPermanenteGrupo AS AP5 ON AP5.idAulaPermanenteGrupo = DAF5.aulaPermanenteGrupo_idAulaPermanenteGrupo
                LEFT JOIN
            aulaDataFixa AS AF5 ON AF5.idAulaDataFixa = DAF5.aulaDataFixa_idAulaDataFixa
        WHERE
            DAF5.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                AND DAFI5.integranteGrupo_idIntegranteGrupo = IG.idIntegranteGrupo
                AND DAFI5.faltaJustificada = 1
                AND (DAF5.ocorrenciaFF_idOcorrenciaFF IS NULL
                OR DAF5.ocorrenciaFF_idOcorrenciaFF NOT IN (3 , 4))) AS obsAulasJustificadas_aluno		
FROM
    diaAulaFFIndividual AS diaFF
        INNER JOIN
    diaAulaFF AS diaF ON diaFF.diaAulaFF_idDiaAulaFF = diaF.idDiaAulaFF
        INNER JOIN
    folhaFrequencia AS FF ON diaF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
        INNER JOIN
    integranteGrupo AS IG ON IG.idIntegranteGrupo = diaFF.integranteGrupo_idIntegranteGrupo
        left JOIN
    aulaPermanenteGrupo AS AP5 ON AP5.idAulaPermanenteGrupo = diaF.aulaPermanenteGrupo_idAulaPermanenteGrupo
        left JOIN
    aulaDataFixa AS AF5 ON AF5.idAulaDataFixa = diaF.aulaDataFixa_idAulaDataFixa
WHERE 1
		AND diaFF.faltaJustificada = 1
        AND IG.clientePf_idClientePf = ".$idClientePf."
        AND FF.dataReferencia >= '".$d1."'
        AND FF.dataReferencia <= '".$d2."'
		 GROUP BY FF.idFolhaFrequencia";
		
		$resultado5 = Uteis::executarQuery($sql5);
		
		foreach ($resultado5 AS $valor5) {
	
			$html .= $valor5['obsAulasJustificadas_aluno']."\n";
		
		}
		
		return  $html;
  }
  
function relatorioFrequenciaPdf($where = "", $tipo, $excel = false, $FME, $frequencia, $tipoR, $d1, $d2, $alunoN,$rh,$freqReal, $portalA, $PDF, $d1, $d2) {
	  
	$ClientePf = new ClientePf();
	$ClientePj = new ClientePj();
	$IntegranteGrupo = new IntegranteGrupo();
	$PlanoAcaoGrupoStatusCobranca = new PlanoAcaoGrupoStatusCobranca();
	$StatusCobranca = new StatusCobranca();
	$PlanoAcaoGrupo = new PlanoAcaoGrupo(); 
	$imgObs = "";
	
	
	  $colunas = array("coluna","coluna2");	
	
	  $html = "teste teste teste";
	  $html .= "<tr><td>fefeeffe</td><td>fefeeffe</td></tr></table>";
	
	  $topo = Uteis::topo();
	
	$html_base = $this -> montaTbPdf($colunas, true);

	return $topo. $html_base.$html;  
  }
  
  function relatorioFrequencia($where = "", $tipo, $excel = false, $FME, $frequencia, $tipoR, $d1, $d2, $alunoN,$rh,$freqReal, $portalA, $PDF = false, $d1, $d2, $portalP) {
	  
    $ClientePf = new ClientePf();
	$ClientePj = new ClientePj();
	$IntegranteGrupo = new IntegranteGrupo();
	$PlanoAcaoGrupoStatusCobranca = new PlanoAcaoGrupoStatusCobranca();
	$StatusCobranca = new StatusCobranca(); 
	$PlanoAcaoGrupo = new PlanoAcaoGrupo();
	$imgObs = "";

    if ($tipo == "porAula") {
		
		if ($portalA == 1) {
		
		$colunas = array("Grupo", "Professor", "Ano", "Mês", "Dia", "Horas programadas", "Horas realizadas grupo", "Ocorrência", "Horas assistidas aluno", "Justificativa falta");
		} else {
		
      $colunas = array("Empresa", "Grupo", "Professor", "Aluno", "Ano", "Mês", "Dia", "Horas programadas", "Horas realizadas grupo", "Ocorrência", "Horas assistidas aluno", "Justificativa falta");
		}
      
      $result = $this->relatorioFrequencia_porAula($where);

      if ($result) {
    
  //      $html .= "<tbody>";
    
        foreach($result as $valor){
 
          $horasProgramadas = is_numeric($valor['horasProgramadas']) ? Uteis::exibirHoras($valor['horasProgramadas'], true) : $valor['horasProgramadas'];
		  
		  $idClientepf = $valor['idClientePf'];
		  
		  $email = $ClientePf->getEmail($idClientepf);
	
	      $html .= "<tr>";
		  if ($portalA != 1) {
          $html .= "<td >" . $valor['empresa'] . "</td>";
          
		  }
		  $html .= "<td >" . $valor['grupo'] ."</td>"; 
          $html .= "<td >" . $valor['nomeProfessor'] . "</td>";
		  if ($portalA != 1) {
          $html .= "<td >" .$onclick. $valor['aluno'] .  "<br>.".$email."</td>";
		  }
          $html .= "<td >" . $valor['ano'] . "</td>";
          $html .= "<td >" . $valor['mes'] . "</td>";
          $html .= "<td >" . $valor['diaAula'] . "</td>";
          $html .= "<td >" . $horasProgramadas . "</td>";
          $html .= "<td >" . Uteis::exibirHoras(($valor['horasRealizadasPeloGrupo'] + $valor['somarCom_horasRealizadasPeloGrupo'])) . "</td>";
          $html .= "<td >" . $valor['sigla'] . "</td>";
          $html .= "<td >" . Uteis::exibirHoras($valor['horaRealizadaAluno'], true) . "</td>";
          $html .= "<td >" . $valor['obsFaltaJustificada'] . "</td>";
          $html .= "</tr>";
        }
//        $html .= "</tbody>";
      }

    } elseif ($tipo == "mensal") {
     
      $result = $this->relatorioFrequencia_mensal($where,"","","", $tipoR); 
	  
//	  Uteis::pr($result);
	  	  
      if ($result) {
      
     //   $html .= "<tbody>";
		$x = 0;
		$totalFrequencia = 0;
		$totalGeralHP = 0;
		
        foreach($result as $valor){
			$imgObs = "";
			
			$nivelAluno = $PlanoAcaoGrupo->getIdNivel($valor['idPlanoAcaoGrupo'], true);
	
		  $idClientepf = $valor['idClientePf'];
		  $idIntegranteGrupo = $valor['idIntegranteGrupo'];
		  $ResultadoIntegrante = $IntegranteGrupo->selectIntegranteGrupo(" WHERE idIntegranteGrupo = ".$idIntegranteGrupo);
		  $valorFinanceiro = $PlanoAcaoGrupoStatusCobranca->selectPlanoAcaoGrupoStatusCobranca(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$valor['idPlanoAcaoGrupo']." ORDER BY idPlanoAcaoGrupoStatusCobranca DESC"); 
		  $idCobranca = $valorFinanceiro[0]['statusCobranca_idStatusCobranca'];
		  
		  $ValorCobranca = $StatusCobranca->selectStatusCobranca(" WHERE idStatusCobranca = ".$idCobranca);
		  $statusC = $ValorCobranca[0]['status'];
		  $corStatus = $ValorCobranca[0]['cor'];
		  
		   $imgCobranca =  "<div class=\"legenda_box\" title=\"".$statusC."\" style=\"background-color:$corStatus\"></div>";
		   
		  $dataEntrada = Uteis::exibirData($ResultadoIntegrante[0]['dataEntrada']);
		  $dataSaida = Uteis::exibirData($ResultadoIntegrante[0]['dataSaida']);

		  $dataEntradaBruta = $ResultadoIntegrante[0]['dataEntrada'];		  
		  $horasPossiveis = $valor['horasPossivel'];
    
			if ($tipoR != 1) {
			    $obsJustificativa = $valor['obsAulasJustificadas_aluno'];
			} else {
		  		$obsJustificativa = self::obsJustificativa($d1, $d2, $idClientepf);
			}
		  
		  if (!$excel) {
		  if ($obsJustificativa != '') {
			$imgObs =  "<img title=\"".$obsJustificativa."\" src=\"".CAMINHO_IMG ."\pendente.png\">"; 
			  
		  		}
		  }
  	
		  $email = $ClientePf->getEmail($idClientepf);
		  $idClientePj = $valor['idClientePj'];
          $horasProgramadas = $valor['horasProgramadas'];
		  $cargaFixa = $valor['cargaHorariaFixa'];
		  $ano = $valor['ano'];
		  $idGrupo = $valor['idGrupo'];
		  
		  $totalBH += $valor['bancoHoras'];
		  $totalR += $valor['reposicao'];
		  
		  
		  $FME = $ClientePj->getFME($idClientePj);
		  
		  if (($cargaFixa >0) || (($cargaFixa == '' || $horasProgramadas <= $cargaFixa))) {
		  	  $totalHP += $horasProgramadas;
		  }
		  // Relatorio Resumido
		  if ($tipoR == 1) {
			$sql = "SELECT FF.idFolhaFrequencia, MONTH(FF.dataReferencia) AS mes, (year(FF.dataReferencia)) as ano,
					(SELECT 
            SUM(COALESCE((AP2.horaFim - AP2.horaInicio),
                        (AF2.horaFim - AF2.horaInicio),
                        0)) - COALESCE(SUM(DAF2.horaRealizada), 0) as Total
        FROM
            diaAulaFF AS DAF2
                INNER JOIN
            ocorrenciaFF AS OC2 ON OC2.idOcorrenciaFF = DAF2.ocorrenciaFF_idOcorrenciaFF
                AND ((OC2.reporAula = 1
                AND OC2.pagarProfessor = 1)
                OR OC2.reporAula = 0)
                AND OC2.excluido = 0
                LEFT JOIN
            aulaPermanenteGrupo AS AP2 ON AP2.idAulaPermanenteGrupo = DAF2.aulaPermanenteGrupo_idAulaPermanenteGrupo
                LEFT JOIN
            aulaDataFixa AS AF2 ON AF2.idAulaDataFixa = DAF2.aulaDataFixa_idAulaDataFixa
        WHERE
            DAF2.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                AND (DAF2.aulaPermanenteGrupo_idAulaPermanenteGrupo IS NOT NULL
                OR DAF2.aulaDataFixa_idAulaDataFixa IS NOT NULL)) AS Total
FROM folhaFrequencia AS FF
LEFT JOIN planoAcaoGrupo AS P on FF.planoAcaoGrupo_idPlanoAcaoGrupo = P.idPlanoAcaoGrupo
INNER JOIN integranteGrupo as IG on IG.planoAcaoGrupo_idPlanoAcaoGrupo = P.idPlanoAcaoGrupo
WHERE 1
        AND P.grupo_idGrupo = ".$idGrupo."
		AND IG.clientePf_idClientePf = ".$idClientepf."
        AND FF.dataReferencia >= '".$d1."'
        AND FF.dataReferencia <= '".$d2."'"; 
		
	//	echo $sql;
		
		$resultado = Uteis::executarQuery($sql);
		
		$totalSomarComHoras = 0;
		$mesAtual = $resultado[0]['mes']; 
		$meses = "";
		$xy = 0;
		$ano = "";
		foreach ($resultado AS $valor2) {
		$totalSomarComHoras += $valor2['Total'];
		$meses .= "  ".$valor2['mes'];
		}
		
		$sql3 =  "SELECT distinct(year(FF.dataReferencia)) as ano,
		IG.clientePf_idClientePf
FROM folhaFrequencia AS FF
LEFT JOIN planoAcaoGrupo AS P on FF.planoAcaoGrupo_idPlanoAcaoGrupo = P.idPlanoAcaoGrupo
INNER JOIN integranteGrupo as IG on IG.planoAcaoGrupo_idPlanoAcaoGrupo = P.idPlanoAcaoGrupo
WHERE 1
		AND P.grupo_idGrupo = ".$idGrupo."
        AND IG.clientePf_idClientePf = ".$idClientepf."
        AND FF.dataReferencia >= '".$d1."'
        AND FF.dataReferencia <= '".$d2."'
		group BY  IG.clientePf_idClientePf,ano "; 	
		$resultado3 = Uteis::executarQuery($sql3);
		
	//	echo $sql3;
		
		foreach ($resultado3 AS $valor3) {
		$ano .= " ".$valor3['ano'];
		}
		
		$sql4 = "    SELECT SUM(CASE
                    WHEN
                        diaF.ocorrenciaFF_idOcorrenciaFF IN (2 , 10, 15)
                    THEN
                        COALESCE((AP5.horaFim - AP5.horaInicio),
                                (AF5.horaFim - AF5.horaInicio),
                                0) - COALESCE(diaF.horaRealizada, 0)
                    ELSE (diaF.horaRealizada - diaFF.horaRealizadaAluno)
                END ) as aulaJustifica,
		(SELECT 
            GROUP_CONCAT(DAFI5.obsFaltaJustificada
                    SEPARATOR ' \n')
        FROM
            diaAulaFF AS DAF5
                INNER JOIN
            diaAulaFFIndividual AS DAFI5 ON DAFI5.diaAulaFF_idDiaAulaFF = DAF5.idDiaAulaFF
                LEFT JOIN
            aulaPermanenteGrupo AS AP5 ON AP5.idAulaPermanenteGrupo = DAF5.aulaPermanenteGrupo_idAulaPermanenteGrupo
                LEFT JOIN
            aulaDataFixa AS AF5 ON AF5.idAulaDataFixa = DAF5.aulaDataFixa_idAulaDataFixa
        WHERE
            DAF5.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                AND DAFI5.integranteGrupo_idIntegranteGrupo = IG.idIntegranteGrupo
                AND DAFI5.faltaJustificada = 1
                AND (DAF5.ocorrenciaFF_idOcorrenciaFF IS NULL
                OR DAF5.ocorrenciaFF_idOcorrenciaFF NOT IN (3 , 4))) AS obsAulasJustificadas_aluno
FROM
    diaAulaFFIndividual AS diaFF
        INNER JOIN
    diaAulaFF AS diaF ON diaFF.diaAulaFF_idDiaAulaFF = diaF.idDiaAulaFF
        INNER JOIN
    folhaFrequencia AS FF ON diaF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
        INNER JOIN
    integranteGrupo AS IG ON IG.idIntegranteGrupo = diaFF.integranteGrupo_idIntegranteGrupo
        left JOIN
    aulaPermanenteGrupo AS AP5 ON AP5.idAulaPermanenteGrupo = diaF.aulaPermanenteGrupo_idAulaPermanenteGrupo
        left JOIN
    aulaDataFixa AS AF5 ON AF5.idAulaDataFixa = diaF.aulaDataFixa_idAulaDataFixa
WHERE 1
		AND diaFF.faltaJustificada = 1
        AND IG.clientePf_idClientePf = ".$idClientepf."
        AND FF.dataReferencia >= '".$d1."'
        AND FF.dataReferencia <= '".$d2."'";
//		echo $sql4;
		
		$resultado4 = Uteis::executarQuery($sql4);
		
		$aulasJustificadas_alunoR = $resultado4[0]['aulaJustifica'];
		
        $horasRealizadasPeloGrupo = $valor['horasRealizadasPeloGrupo'] + $totalSomarComHoras;
			  
		  } else {
			   
          $horasRealizadasPeloGrupo = $valor['horasRealizadasPeloGrupo'] + $valor['somarCom_horasRealizadasPeloGrupo'];
		
		  } // Fim IF TipoR
		  
		  $totalRPG += $horasRealizadasPeloGrupo;

		  if ($horasRealizadasPeloGrupo == '') {
			  $horaRealizadaAluno = "Não houve frequência";
			   $aulasJustificadas_aluno = "Não houve frequência";
			   $frequenciaReal  = "Não houve frequência";
			   $percentPresencaAluo = "Não houve frequência";
			   $horasPossiveis = "Não houve frequência";
  
		  } else {
				  if ($valor['mes'] < 10) {
					  $mesI = "0".$valor['mes'];
				  }
			  if ($dataEntradaBruta >= $valor['ano']."-".$mesI."-01") {
				  if ($horasPossiveis != '') {
				$horasRealizadasPeloGrupo = $horasPossiveis; 
			  }
				$cor = "blue";
			  } else {
				  
				$cor = "";  
			  }
			 
          $horaRealizadaAlunoSem = $valor['horaRealizadaAluno'];
		  
		  $horaRealizadaAluno = Uteis::exibirHoras($valor['horaRealizadaAluno']);
		  $totalHRA += $horaRealizadaAlunoSem;
		 
		 	 if ($tipoR != 1) {
			  $aulasJustificadas_aluno =  $valor['aulasJustificadas_aluno']; 
			  
			 } else {
			  $aulasJustificadas_aluno = $aulasJustificadas_alunoR;
		
		  if ($obsJustificativaR != '') {
              $imgObs =  "<img title=\"".$obsJustificativaR."\" src=\"".CAMINHO_IMG ."\pendente.png\">"; 
		  	}
		  
			 }
			 
			  if ($excel) {
			//if ($obsJustificativaR != '') {
              $imgObs =  "<div>".$obsJustificativa."</div>"; 
		  	//}  
			  }
		  
		  $totalAJA += $aulasJustificadas_aluno;
		           
          $percentPresencaAluo = ($ClientePj->get_faltaJustificadaPresenca($valor['idClientePj'])) ? ($horaRealizadaAlunoSem+$aulasJustificadas_aluno) : $horaRealizadaAlunoSem;  
		 		  
          $percentPresencaAluo = ($percentPresencaAluo  / $horasRealizadasPeloGrupo)*100 ;
			  
		  if ($percentPresencaAluo > 100) {
			  $percentPresencaAluo =100;
		  }
	
		  $totalPPA += $percentPresencaAluo;
	 
		  $frequenciaReal = ($horaRealizadaAlunoSem  /$horasRealizadasPeloGrupo)*100;

		 // calculando a média
		  $x++;
		  $totalFrequencia += $frequenciaReal;
		  $frequenciaRealSem = $frequenciaReal;
		  $frequenciaReal = round($frequenciaReal,2)."%";
		  $aulasJustificadas_aluno = Uteis::exibirHoras( $aulasJustificadas_aluno);
		  $percentPresencaAluoSem = $percentPresencaAluo;
		  $percentPresencaAluo = round($percentPresencaAluo,2)."%";
		  
		  
		  if ($FME == ' ') {
			$FME = 0;  
		  }
		 
	 }
		  if (!$excel) {
		  $onclick = " <img src=\"".CAMINHO_IMG ."\cad.png\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=" . $valor['idPlanoAcaoGrupo'] . "', '', '')\" >";
		  
		   $onclick2 = " <img src=\"".CAMINHO_IMG ."\cad.png\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "clientePf/cadastro.php?id=" . $valor['idClientePf'] . "', '', '')\" >";
		  }

		if (($frequencia == 3) && ($frequenciaRealSem < $FME)) {
		
				  
          $html .= "<tr>";
		  if (($rh != 1) || ($tipoR == 0) || ($portalA == 0)) {
          $html .= "<td >" . $valor['empresa'] . "</td>";
		  }
          $html .= "<td >" . $onclick.$valor['grupo'] . $imgCobranca. "<br>.".$email."</td>";
		  $html .= "<td>" . $nivelAluno . "</td>";
          $html .= "<td >" . $valor['nomeProfessor'] . "</td>";
          $html .= "<td >" . $onclick2.$valor['aluno'] . "</td>";
		  $html .= "<td>" . $dataEntrada."</td>";
		  $html .= "<td>" . $dataSaida."</td>";
          $html .= "<td>" . $ano."</td>";
		  
          $html .= "<td >";
		  if ($tipoR != 1) {
		  $html .= $valor['mes'];
		  } else {
		  $html .=  $meses;
		  }
		  $html .= "</td>";
		  if ($cargaFixa > 0) {
			$html .= "<td >" . Uteis::exibirHoras($cargaFixa) . "</td>";  
		  } else {
          $html .= "<td >" . Uteis::exibirHoras($horasProgramadas) . "</td>";
		  }
          $html .= "<td ><font color=\"".$cor."\">" . Uteis::exibirHoras($horasRealizadasPeloGrupo) . "</font></td>";
          $html .= "<td >" . $horaRealizadaAluno . "</td>";
          $html .= "<td >" . $aulasJustificadas_aluno . $imgObs. "</td>";
          
          $html .= "<td>";
		  
		  if ($percentPresencaAluoSem >= $FME) {
			  
		  	$html .= ($percentPresencaAluo);
			
		  } else {
			  
			$html .= "<font color=\"red\">".$percentPresencaAluo."</font>";  
			
		  }
		  
	     if ($frequenciaRealSem >= $FME) {
			 
			  
			$r = $frequenciaReal;
			
		  } else {
			  
			$r = "<font color=\"red\">".$frequenciaReal."</font>";  
			
		  }
		  
		  $html .= "</td>";
          $html .= "<td >" . $r . "</td>";
		  if ($tipoR != 1) {
		  $html .= "<td >" . Uteis::exibirHoras($valor['bancoHoras']) . "</td>";
          $html .= "<td >" . Uteis::exibirHoras($valor['reposicao']) . "</td>";
		  $html .= "<td >" . Uteis::exibirHoras($valor['horasPerdidas'])."</td>";
		  
		  $saldoHoras = $valor['bancoHoras'] - $valor['reposicao'];
		  
   if($saldoHoras == 0){

         $obs = "";
 	     }else if($saldoHoras > 0){
	
		 $obs = " a compensar";
	     }else{

		$saldoHoras *= -1;
		$obs = " realizadas a mais";
	}
		  
          $html .= "<td >" . Uteis::exibirHoras($saldoHoras) .$obs. "</td>";
		  }
          $html .= "</tr>";

        } elseif (($frequencia == 1) && ($percentPresencaAluoSem < $FME)) {
			
				  
          $html .= "<tr>";
		  if  (($rh != 1) || ($portalA != 1)) {
          $html .= "<td >" . $valor['empresa'] . "</td>";
		  }
          $html .= "<td >" . $onclick.$valor['grupo'] . $imgCobranca. "<br>.".$email."</td>";
		  $html .= "<td>" . $nivelAluno . "</td>";
          $html .= "<td >" . $valor['nomeProfessor'] . "</td>";
          $html .= "<td >" . $onclick2.$valor['aluno'] . "</td>";
		  $html .= "<td>" . $dataEntrada."</td>";
		  $html .= "<td>" . $dataSaida."</td>";
          $html .= "<td>" . $ano. "</td>";
		  
          $html .= "<td >";
		  if ($tipoR != 1) {
		  $html .= $valor['mes'];
		  } else {
		  $html .=  $meses;
		  }
		  $html .= "</td>";
		  if ($cargaFixa > 0) {
			$html .= "<td >" . Uteis::exibirHoras($cargaFixa) . "</td>";  
		  } else {
          $html .= "<td >" . Uteis::exibirHoras($horasProgramadas) . "</td>";
		  }
          $html .= "<td ><font color=\"".$cor."\">" . Uteis::exibirHoras($horasRealizadasPeloGrupo) . "</font></td>";
          $html .= "<td >" . $horaRealizadaAluno . "</td>";
          $html .= "<td >" . $aulasJustificadas_aluno . $imgObs. "</td>";
          
          $html .= "<td>";
		  
		  if ($percentPresencaAluoSem >= $FME) {
			  
		  	$html .= ($percentPresencaAluo);
			
		  } else {
			  
			$html .= "<font color=\"red\">".$percentPresencaAluo."</font>";  
			
		  }
		  
	     if ($frequenciaRealSem >= $FME) {
			  
			$r = $frequenciaReal;
			
		  } else {
			  
			$r = "<font color=\"red\">".$frequenciaReal."</font>";  
			
		  }
		  
		  $html .= "</td>";
          $html .= "<td >" . $r . "</td>";
		  if ($tipoR != 1) {
		  $html .= "<td >" . Uteis::exibirHoras($valor['bancoHoras']) . "</td>";
          $html .= "<td >" . Uteis::exibirHoras($valor['reposicao']) . "</td>";
		  $html .= "<td >" . Uteis::exibirHoras($valor['horasPerdidas'])."</td>";
		  
		  $saldoHoras = $valor['bancoHoras'] - $valor['reposicao'];
		  
   if($saldoHoras == 0){

         $obs = "";
 	     }else if($saldoHoras > 0){
	
		 $obs = " a compensar";
	     }else{

		$saldoHoras *= -1;
		$obs = " realizadas a mais";
	}
		  
          $html .= "<td >" . Uteis::exibirHoras($saldoHoras) .$obs. "</td>";
		  }
          $html .= "</tr>";

        }elseif  (($frequencia == 2) and ($frequenciaRealSem == 100)) {
			
		
		   $html .= "<tr>";
		   
		if  (($rh != 1) || ($portalA != 1)) {
          $html .= "<td >" . $valor['empresa'] . "</td>";
		  }
          $html .= "<td >" . $onclick.$valor['grupo'] . $imgCobranca."</td>";
		  $html .= "<td>" . $nivelAluno . "</td>";
          $html .= "<td >" . $valor['nomeProfessor'] . "</td>";
          $html .= "<td >" . $onclick2. $valor['aluno'] . "<br>.".$email."</td>";
		  $html .= "<td>" . $dataEntrada."</td>";
		  $html .= "<td>" . $dataSaida."</td>";
          $html .= "<td >" .  $ano. "</td>";
         $html .= "<td >";
		  if ($tipoR != 1) {
		  $html .= $valor['mes'];
		  } else {
		  $html .=  $meses;
		  }
		  $html .= "</td>";
          $html .= "<td >" . Uteis::exibirHoras($horasProgramadas) . "</td>";
          $html .= "<td ><font color=\"".$cor."\">" . Uteis::exibirHoras($horasRealizadasPeloGrupo) . "</font></td>";
          $html .= "<td >" . $horaRealizadaAluno . "</td>";
          $html .= "<td >" . $aulasJustificadas_aluno . $imgObs. "</td>";
          
          $html .= "<td>";
		  
		  if ($percentPresencaAluoSem >= $FME) {
			  
		  	$html .= $percentPresencaAluo;
			
		  } else {
			  
			$html .= "<font color=\"red\">".$percentPresencaAluo."</font>";  
			
		  }
		  
	     if ($frequenciaRealSem >= $FME) {
			  
			$r = $frequenciaReal;
			
		  } else {
			  
			$r = "<font color=\"red\">".$frequenciaReal."</font>";  
			
		  }
		  
		  $html .= "</td>";
          $html .= "<td >" . $r . "</td>";
		  if ($tipoR != 1) {
		  $html .= "<td >" . Uteis::exibirHoras($valor['bancoHoras']) . "</td>";
          $html .= "<td >" . Uteis::exibirHoras($valor['reposicao']) . "</td>";
		  $html .= "<td >" . Uteis::exibirHoras($valor['horasPerdidas'])."</td>";
		  
		  $saldoHoras = $valor['bancoHoras'] - $valor['reposicao'];
		  
   if($saldoHoras == 0){

         $obs = "";
 	     }else if($saldoHoras > 0){
	
		 $obs = " a compensar";
	     }else{

		$saldoHoras *= -1;
		$obs = " realizadas a mais";
	}
		  
          $html .= "<td >" . Uteis::exibirHoras($saldoHoras) .$obs. "</td>";
		  }
          $html .= "</tr>";
			
			
		} elseif ($frequencia == "-") {
			
	
	      $html .= "<tr>";
           if  ($rh != 1)  {
		     if ($portalA != 1) {
         		 $html .= "<td >" . $valor['empresa'] . "</td>";
		  
				}
		  }
          $html .= "<td >" .$onclick. $valor['grupo'] .$imgCobranca. "</td>";
		  $html .= "<td>" . $nivelAluno . "</td>";
		    if  ($portalP != 1) {
		  //   if ($portalA != 1) {
        
		  $html .= "<td >" . $valor['nomeProfessor'] . "</td>";
		//	 }
		  }
		  if (($alunoN != 1) && ($portalA != 1)) {
          
          $html .= "<td >" .$onclick2. $valor['aluno'] . "<br>.".$email."</td>";
	}
		  $html .= "<td>" . $dataEntrada."</td>";
		  $html .= "<td>" . $dataSaida."</td>";
	//	  }
		  
          $html .= "<td >" . $ano. "</td>";
         $html .= "<td >";
		  if ($tipoR != 1) {
		  $html .= $valor['mes'];
		  } else {
		  $html .=  $meses;
		  }
		  $html .= "</td>";
          $html .= "<td >" . Uteis::exibirHoras($horasProgramadas) . "</td>";
          $html .= "<td > <font color=\"".$cor."\">" . Uteis::exibirHoras($horasRealizadasPeloGrupo) . "</font></td>";
		  
	//	  if ($alunoN != 1) {
          $html .= "<td >" . $horaRealizadaAluno . "</td>";
          $html .= "<td >" . $aulasJustificadas_aluno . $imgObs. "</td>";
		 
          $html .= "<td>";
		  
		  if ($percentPresencaAluoSem >= $FME) {
			  
		  	$html .= $percentPresencaAluo;
			
		  } else {
			  
			$html .= "<font color=\"red\">".$percentPresencaAluo."</font>";  
			
		  }
		  
	     if ($frequenciaRealSem >= $FME) {
			  
			$r = $frequenciaReal;
			
		  } else {
			  
			$r = "<font color=\"red\">".$frequenciaReal."</font>";  
			
		  }
		  
		  $html .= "</td>";
          $html .= "<td >" . $r . "</td>";
		//  }
		  if ($tipoR != 1) {
		  $html .= "<td >" . Uteis::exibirHoras($valor['bancoHoras']) . "</td>";
          $html .= "<td >" . Uteis::exibirHoras($valor['reposicao']) . "</td>";
		  
		  $saldoHoras = $valor['bancoHoras'] - $valor['reposicao'];
		  
   if($saldoHoras == 0){

         $obs = "";
 	     }else if($saldoHoras > 0){
	
		 $obs = " a compensar";
	     }else{

		$saldoHoras *= -1;
		$obs = " realizadas a mais";
	}
		   $html .= "<td >" . Uteis::exibirHoras($valor['horasPerdidas'])."</td>";
          $html .= "<td >" . Uteis::exibirHoras($saldoHoras) .$obs. "</td>";
		 
		  }
          $html .= "</tr>";
		}
	}
   //     $html .= "</tbody>";
      }
    }

	if ($x > 0) {
		$totalF = " / Média Geral: ".Uteis::formatarMoeda($totalFrequencia/$x)." %";
		$totalPPA = " / Média Geral: ".Uteis::formatarMoeda($totalPPA/$x)." %";
	}
	
	  if ($tipo != "porAula") {
		  if ($tipoR != 1) {
			  
			  if ($rh != 1) {
				  
				  if ($portalA == 1) {
					  
					  $colunas = array("Grupo", "Nível", "Professor", "Data Entrada","Data Saída","Ano", "Mês", "Horas cobradas", "Horas realizadas ", "Horas assistidas aluno ", "Faltas justificadas pelo aluno ", "Presença com justificativa do aluno ", "Frequência Real ", "Banco de horas ", "Reposições ", "Horas Perdidas (CSA, GA, CEX)", "Saldo no mês"); 
				  } else {
					
	 $colunas = array("Empresa3", "Grupo", "Nível", "Professor", "Aluno", "Data Entrada", "Data Saída", "Ano", "Mês", "Horas cobradas ", "Horas realizadas ", "Horas assistidas aluno ", "Faltas justificadas pelo aluno ", "Presença com justificativa do aluno ", "Frequência Real ", "Banco de horas ", "Reposições ", "Horas Perdidas (CSA, GA, CEX)", "Saldo no mês");
			//}
				  }
	 
			  } else {
	 $colunas = array("Grupo", "Nível", "Professor", "Aluno", "Data Entrada", "Data Saída", "Ano", "Mês", "Horas cobradas ", "Horas realizadas ","Horas assistidas aluno ", "Faltas justificadas pelo aluno ", "Presença com justificativa do aluno ", "Frequência Real ", "Banco de horas ", "Reposições ", "Horas Perdidas (CSA, GA, CEX)", "Saldo no mês");			  
				  
				  
			  }
		  } elseif($tipoR == 1) {
			   
			  if (($alunoN == 1) || ($portalA != 1)) {
				
		$colunas = array("Empresa2", "Grupo", "Nível","Professor", "Aluno","Data Entrada", "Data Saída", "Ano", "Mês", "Horas cobradas ", "Horas realizadas ", "Horas assistidas aluno ", "Faltas justificadas pelo aluno ", "Presença com justificativa do aluno ", "Frequência Real ");			  
			  } else {
			 if (($rh != 1) || ($portalA != 1)) {
	$colunas = array("Empresa1", "Grupo", "Nível", "Professor", "Aluno", "Data Entrada", "Data Saída", "Ano", "Mês", "Horas cobradas ", "Horas realizadas ", "Horas assistidas aluno ", "Faltas justificadas pelo aluno ", "Presença com justificativa do aluno ", "Frequência Real ");	
			 }  else {
				 if ($portalA == 1) {
	$colunas = array("Grupo", "Nível","Professor", "Data Entrada", "Data Saída", "Ano", "Mês", "Horas cobradas ", "Horas realizadas ", "Horas assistidas aluno ", "Faltas justificadas pelo aluno ", "Presença com justificativa do aluno ", "Frequência Real ");	
					 
				 } else {
				 
	$colunas = array("Grupo", "Nível","Professor", "Aluno", "Data Entrada", "Data Saída", "Ano", "Mês", "Horas cobradas ", "Horas realizadas ", "Horas assistidas aluno ", "Faltas justificadas pelo aluno ", "Presença com justificativa do aluno ", "Frequência Real ");	
				 }
			 }
			  } 
		  }
	  } else {
		    
		  
	  }
	  
	  $topo = Uteis::topo();
	  
	  if ($PDF == false) {
	
	$html_base = $this -> montaTb($colunas, $excel,"",1);
	if (!$excel )  {
       return $html_base . $html;
	} else {
		
	   return $topo. $html_base . $html;	
	}
	
	  } else {
		  
		  
		  $html_base = $this -> montaTbPdf($colunas, $excel);
		return $topo. $html_base.$html;  
	  }

  }
  
  
function GraficoFrequencia($where = "", $tipo) {

    if ($tipo == "porAula") {
           
      $result = $this->relatorioFrequencia_porAula($where);
      $grafico =array(
                 'dados' => array(
                        'cols' =>array(
                                        array('type'=>'string','label'=>'Empresa'), 
                                        array('type'=>'string','label'=>'Grupo'), 
                                        array('type'=>'string','Professor'), 
                                        array('type'=>'string','Aluno'), 
                                        array('type'=>'number','Ano'), 
                                        array('type'=>'number','Mês'), 
                                        array('type'=>'number','Dia'), 
                                        array('type'=>'','Horas programadas'), 
                                        array('type'=>'','Horas realizadas grupo'), 
                                        array('type'=>'string','Ocorrência'), 
                                        array('type'=>'','Horas assistidas aluno'), 
                                        array('type'=>'string','Justificativa falta')),
                         'rows' => array()));
       if ($result) {    
    
    
        foreach($result as $valor){
       
          $horasProgramadas = is_numeric($valor['horasProgramadas']) ? Uteis::exibirHoras($valor['horasProgramadas'], true) : $valor['horasProgramadas'];          
          $grafico['dados']['rows'][] = array(
                                        'c'=>array(
                                                array('v'=>$valor['empresa']),
                                                array('v'=>$valor['grupo']),
                                                array('v'=>$valor['nomeProfessor']),
                                                array('v'=>$valor['aluno']),
                                                array('v'=>$valor['ano']),
                                                array('v'=>$valor['mes']),
                                                array('v'=>$valor['diaAula']),
                                                array('v'=>$horasProgramadas),
                                                array('v'=>Uteis::exibirHoras(($valor['horasRealizadasPeloGrupo'] + $valor['somarCom_horasRealizadasPeloGrupo']))),
                                                array('v'=>$valor['sigla']),
                                                array('v'=>Uteis::exibirHoras($valor['horaRealizadaAluno'], true)),
                                                array('v'=>$valor['obsFaltaJustificada'])));
                               }
      }

    } elseif ($tipo == "mensal") {

     
      
      $result = $this->relatorioFrequencia_mensal($where);      

      if ($result) {
      
        $ClientePj = new ClientePj();
        
        foreach($result as $valor){

          $horasProgramadas = $valor['horasProgramadas'];
          $horasRealizadasPeloGrupo = $valor['horasRealizadasPeloGrupo'] + $valor['somarCom_horasRealizadasPeloGrupo'];
          $horaRealizadaAluno = $valor['horaRealizadaAluno'];
          $aulasJustificadas_aluno =  $valor['aulasJustificadas_aluno'];          
          $percentPresencaAluo = ($ClientePj->get_faltaJustificadaPresenca($valor['idClientePj'])) ? ($horaRealizadaAluno+$aulasJustificadas_aluno) : $horaRealizadaAluno;  
          $percentPresencaAluo = ($percentPresencaAluo * 100) / $horasRealizadasPeloGrupo ;
          
          $json = "
          ['Empresa', 'Grupo', 'Professor', 'Aluno', 'Ano', 'Mês', 'Horas programadas', 'Horas realizadas', 'Horas assistidas aluno', 'Faltas justificadas pelo aluno', 'Presença do aluno(%)', 'Banco de horas', 'Reposições', 'Saldo no mês']
          [".$valor['empresa'].",".$valor['grupo'].",".$valor['nomeProfessor'].",".$valor['aluno'].",".$valor['ano'].",".$valor['mes'].",".Uteis::exibirHoras($horasProgramadas).",".Uteis::exibirHoras($horasRealizadasPeloGrupo).",".Uteis::exibirHoras($horaRealizadaAluno).",".Uteis::exibirHoras($aulasJustificadas_aluno).",".Uteis::formatarMoeda($percentPresencaAluo).",".Uteis::exibirHoras($valor['bancoHoras']).",".Uteis::exibirHoras($valor['reposicao']).",".Uteis::exibirHoras($valor['bancoHoras'] - $valor['reposicao'])."]";
        }
        
      }

    }

      return $json;

  }
  function relatorioProvaAplicadas($where = "", $tipo, $excel = false, $status, $soMedia,$mobile, $portalA, $campos, $camposNome) {
	  
	  $AulaGrupoProfessor = new AulaGrupoProfessor();
	  $Professor = new Professor();

      $AcompanhamentoMaterial = new AcompanhamentoMaterial();
      $AcompanhamentoCurso = new AcompanhamentoCurso();
      $PeriodoAcompanhamento = new PeriodoAcompanhamentoCurso();
      $RelatorioDesempenho = new RelatorioDesempenho();
   //   $KitMaterial = new KitMaterial();
      $Montado = new MaterialMontadoPlanoAcao();
      $MaterialPlano = new MaterialDidaticPlanoAcao();
      $FolhaFrequencia = new FolhaFrequencia();
      $PlanoAcaoGrupo = new PlanoAcaoGrupo();
      $PlanoAcao = new PlanoAcao();
	  $Idioma = new Idioma();
	  $IntegranteGrupo = new IntegranteGrupo();
	  
  //  if ($tipo == "item") {

      $sql = "Select COALESCE(PJ.razaoSocial, 'Particular') AS empresa,    G.nome AS grupo,	PAG.idPlanoAcaoGrupo,    CPF.nome AS aluno,	CPF.idClientePf,     ICP.nota AS notaProva,    ICP.anexo,	P.nome AS nomeProva,    IP.nome AS itemProva,    C.dataPrevistaNova,    C.dataPrevistaInicial,    C.dataAplicacao,    NE.nivel,    ICP.professor_idProfessor,    C.obs AS obsProva , PAG.dataInicioEstagio     
	    FROM
    grupo AS G
        INNER JOIN
    planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo
	 INNER join
    nivelEstudo AS NE on NE.idNivelEstudo = PAG.nivelEstudo_idNivelEstudo
        inner JOIN
    integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        INNER JOIN
    clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf
        Left JOIN
    itemCalendarioProva AS ICP ON ICP.integranteGrupo_idIntegranteGrupo = IG.idIntegranteGrupo
	 INNER JOIN
    itenProva AS IP ON IP.idItenProva = ICP.itenProva_idItenProva
	 INNER JOIN
    prova AS P ON P.idProva = IP.prova_idProva
	 inner JOIN
    calendarioProva AS C ON C.idCalendarioProva = ICP.calendarioProva_idCalendarioProva
		AND C.prova_idProva = P.idProva
       LEFT JOIN
    grupoClientePj AS GPJ ON GPJ.grupo_idGrupo = G.idGrupo
       LEFT JOIN
    clientePj AS PJ ON PJ.idClientePj = GPJ.clientePj_idClientePj
		LEFT JOIN
	gerenteTem AS GER on GER.clientePj_idClientePj = PJ.idClientePj
	" . $where;
$sql .=	" AND C.dataAplicacao is not null ";
	if ($portalA != 1) {
	$sql .= "GROUP BY aluno, itemProva ORDER BY G.nome ASC";
	} else {
	$sql .= "GROUP BY NE.nivel, itemProva
			 ORDER BY NE.nivel ASC";	
	}

//echo $sql;

      $result = $this -> query($sql);
		if ($portalA == 1) {
	 $colunas = array("Idioma", "Nível", "Prova", "Item da prova", "Nota", "Nome Professor ", "Material", "Unidade Final", "Unidade Atual",  "ObsMaterial",  "Data de aplicação", "ObsProva");
	
	    if (!$excel)
        $colunas[] = "Anexo";
			
		} 
		
  
      if (mysqli_num_rows($result) > 0) {

        $html .= "<fieldset><legend>Provas Aplicadas</legend></fieldset>";
		$valorTotal = 0;
		$yt = 0;

        while ($valor = mysqli_fetch_array($result)) {
			
			$idIdioma = $PlanoAcaoGrupo->getIdIdioma($valor['idPlanoAcaoGrupo']);
			$nomeIdioma = $Idioma->getNome($idIdioma);
			
			$todosPAG = $PlanoAcaoGrupo->getTodosPAG($valor['idPlanoAcaoGrupo']);
			
			$where2 = " WHERE clientePf_idClientePf = ".$valor['idClientePf']. " AND planoAcaoGrupo_idPlanoAcaoGrupo in (".$todosPAG.") AND dataSaida IS NOT NULL";
			
//			echo $where2;
			
			$valorSaida = $IntegranteGrupo->selectIntegranteGrupo($where2);
			
			if ($valorSaida != '') {
				$dadosSaida = Uteis::exibirData($valorSaida[0]['dataSaida']). "Obs:".$valorSaida[0]['obs'];
				
			} else {
				$dadosSaida = "";	
			}
			
			if ($campos) {

          $html .= "<tr>";
	
		  		foreach ($campos as $campo) {
					
					if ($campo == 'empresa') {
         $html .= "<td >" . $valor['empresa'] . "</td>";
		  	} else if ($campo == 'grupo') {
		//	if (!$excel)	  
		//  $onlick = "<img src=\"/cursos/images/cad.png\" title=\"Ver grupo\" onclick=\"abrirNivelPagina(this, '/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$valor['idPlanoAcaoGrupo']."', '', '')/>";
			  
		   $html .= "<td >".$onlick. $valor['grupo']."</td>";

			} else if ($campo == 'aluno') {
	//	  	if ($dadosSaida != '') {
	//	  $html .= "<td style=\"color:gray\" title=\"".$obs."\">" . $valor['aluno'] . "</td>";		
	//		} else {
          $html .= "<td >" . $valor['aluno'] . "</td>";
	//			}
		  } else if ($campo == 'idioma') {
		  	  $html .= "<td >" . $nomeIdioma . "</td>";
		  } else if ($campo == 'nivel') {
		  $html .= "<td>". $valor['nivel']. "</td>";
		  } else if ($campo == 'inicioEstagio') {
		  $html .= "<td>". Uteis::exibirData($valor['dataInicioEstagio']). "</td>";
		  } else if ($campo == 'prova') {
          $html .= "<td >" . $valor['nomeProva'] . "</td>";
		  } else if ($campo == 'itemProva') {
          $html .= "<td >" . $valor['itemProva'] . "</td>";
		  } else if ($campo == 'nota') {
		  if ($valor['notaProva']!="") {
				$html .= "<td>".Uteis::exibirMoeda($valor['notaProva'])."</td>";  
		 		$valorTotal += $valor['notaProva'];
		        $yt++;
		  } else {
				$html .= "<td style=\"color:red;\">Nota pendente</td>";  
			  }
		  } else if ($campo == 'nomeProfessor') {
 
		  $nomeProfessor = $Professor->getNome($valor['professor_idProfessor']);
		  	  
          $html .= "<td >" . $nomeProfessor . "</td>";
		  } else if ($campo == 'material') {


            $valorFF = $FolhaFrequencia->selectFolhaFrequencia(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$valor['idPlanoAcaoGrupo']." AND finalizadaParcial = 1 order BY idFolhaFrequencia DESC");

            $idFolhaFrequencia = $valorFF[0]['idFolhaFrequencia'];

   		//    $kit = $KitMaterial->AcompanhamentoPorKit($valor['idPlanoAcaoGrupo'], $idFolhaFrequencia, $abrir, $atualizar,$relatorio,1,0,1);
            $mont = $Montado->AcompanhamentoMaterialMontado($valor['idPlanoAcaoGrupo'], $idFolhaFrequencia, $abrir, $atualizar,$relatorio,1,0,1);
            $plan = $MaterialPlano->AcompanhamentoMaterialPlano($valor['idPlanoAcaoGrupo'], $idFolhaFrequencia, $abrir, $atualizar,$relatorio,1,1);
            if($kit!="") {
                $html2 = $kit;
            }elseif($mont!="") {
                $html2 = $mont;
            }elseif($plan!="") {
                $html2 = $plan;
            }else {
                $html2 = "<td>".$nomeM."</td><td>".$unidadeFinal."</td><td>".$unidadeAtual."</td><td>".$obs."</td>";
            }
          $html .= $html2;
		  } else if ($campo == 'dataAplicacao') {
          $html .= "<td >" . Uteis::exibirData($valor['dataAplicacao']) . "</td>";
		  } else if ($campo == 'obsProva') {
		  $html .= "<td>".$valor['obsProva']."</td>";
		  } else if ($campo == 'anexo'){

          if (!$excel) {
            $html .= "<td >";
            if ($valor['anexo']) {
              $html .= "<a href=\"" . CAMINHO_UP . "/anexonota/" . $valor['anexo'] . "\" target=\"_blank\">
                <center><img src=\"" . CAMINHO_IMG . "contrato.png\" ><center>
              </a></td>";
	            }
		  	}
			
          } else if ($campo == 'novaData') {
					 $html .= "<td ></td>";
				} else if ($campo == 'dataPrevista') {
					 $html .= "<td ></td>";		
				}
	    
			}
			$html .= "</tr>";
	 		}
        }

      }
	  
	  if ($yt > 0) {
		  $valorMedio = ($valorTotal/$yt);
    }

 	 $html_base = $this-> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);
 
	if ($soMedia != 1) {
    return $html_base . $html;
	} else {
	return $valorMedio;
	}

  }
  
   function relatorioProvaAgendadas($where = "", $tipo, $excel = false, $status, $where2 = "", $extra=0, $campos, $camposNome, $numero) {
	   
	   $AcompanhamentoMaterial = new AcompanhamentoMaterial();
	   $AcompanhamentoCurso = new AcompanhamentoCurso();
	   $PeriodoAcompanhamento = new PeriodoAcompanhamentoCurso();
	   $RelatorioDesempenho = new RelatorioDesempenho();
	//   $KitMaterial = new KitMaterial();
	   $Montado = new MaterialMontadoPlanoAcao();
	   $MaterialPlano = new MaterialDidaticPlanoAcao();
	   $FolhaFrequencia = new FolhaFrequencia();
	   $PlanoAcaoGrupo = new PlanoAcaoGrupo();
	   $PlanoAcao = new PlanoAcao();
	   $AulaGrupoProfessor = new AulaGrupoProfessor();
	   $Professor = new Professor();
	   $Idioma = new Idioma();
	   $PlanoAcaoGrupoStatusCobranca = new PlanoAcaoGrupoStatusCobranca();
	   $StatusCobranca = new StatusCobranca();

  $sql = "SELECT COALESCE(PJ.razaoSocial, 'Particular') AS empresa, G.nome AS grupo, PAG.idPlanoAcaoGrupo, CPF.nome AS aluno, P.nome AS nomeProva,   C.dataPrevistaNova, C.dataPrevistaInicial, NE.nivel, PAG.dataInicioEstagio 
        FROM
    grupo AS G
        INNER JOIN
    planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo
        INNER JOIN
    nivelEstudo AS NE ON NE.idNivelEstudo = PAG.nivelEstudo_idNivelEstudo
        INNER JOIN
    integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        INNER JOIN
    clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf
        INNER JOIN
    calendarioProva AS C ON C.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        INNER JOIN
    prova AS P ON P.idProva = C.prova_idProva
        LEFT JOIN
    grupoClientePj AS GPJ ON GPJ.grupo_idGrupo = G.idGrupo
        INNER JOIN
    gerenteTem AS GER ON GPJ.clientePj_idClientePj = GER.clientePj_idClientePj
        LEFT JOIN
    clientePj AS PJ ON PJ.idClientePj = GPJ.clientePj_idClientePj" . $where;
//	echo $sql;

$sqlextra = ($extra===1)? ' Group by G.nome ' : '';
$sql .=	" AND C.dataAplicacao is null $sqlextra ORDER BY G.nome ASC";

  $result = $this -> query($sql);
 
      if (mysqli_num_rows($result) > 0) {

               $html .= "<fieldset><legend>Provas Agendadas</legend></fieldset>";

        while ($valor = mysqli_fetch_array($result)) {
			
			$idIdioma = $PlanoAcaoGrupo->getIdIdioma($valor['idPlanoAcaoGrupo']);
			$nomeIdioma = $Idioma->getNome($idIdioma);
			
		  $valorFinanceiro = $PlanoAcaoGrupoStatusCobranca->selectPlanoAcaoGrupoStatusCobranca(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$valor['idPlanoAcaoGrupo']." ORDER BY idPlanoAcaoGrupoStatusCobranca DESC"); 
		  $idCobranca = $valorFinanceiro[0]['statusCobranca_idStatusCobranca'];
		  
		  $ValorCobranca = $StatusCobranca->selectStatusCobranca(" WHERE idStatusCobranca = ".$idCobranca);
		  $statusC = $ValorCobranca[0]['status'];
		  $corStatus = $ValorCobranca[0]['cor'];
		  
		  $imgCobranca =  "<div class=\"legenda_box\" title=\"".$statusC."\" style=\"background-color:$corStatus\"></div>";
			
			if ($campos) {
          $html .= "<tr>";
		  	foreach ($campos as $campo) {
				if ($campo == 'empresa') {
          $html .= "<td >" . $valor['empresa'] . "</td>";
				} else if ($campo == 'grupo') {
		  
		  if (!$excel) {
		  
		   $html .= "<td><img src=\"/cursos/images/cad.png\" title=\"Ver grupo\" onclick=\"abrirNivelPagina(this, '/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$valor['idPlanoAcaoGrupo']."', '', '')\">".$valor['grupo'].$imgCobranca."</td>";
		  } else {
			  
			$html .= "<td>".$valor['grupo']."</td>";
		  }
				} else if ($campo == 'aluno') {
                $html .= "<td >" . $valor['aluno'] . "</td>";
				} else if ($campo == 'idioma') {
					$html .= "<td >" . $nomeIdioma . "</td>";
				} else if ($campo == 'nivel') {
					$html .= "<td >" . $valor['nivel'] . "</td>";
				} else if ($campo == 'inicioEstagio') {
					$html .= "<td >" . $valor['dataInicioEstagio'] . "</td>";  	
				} else if ($campo == 'prova') {
					$html .= "<td >" . $valor['nomeProva'] . "</td>";	
				}  else if ($campo == 'itemProva') {
          			$html .= "<td ></td>";
		  		} else if ($campo == 'nota') {
		  			$html .= "<td style=\"color:red;\">Nota pendente</td>";  
			    } else if ($campo == 'nomeProfessor') {
			
		$dataAtual = date("Y-m-01");
		$valorProfessor = $AulaGrupoProfessor->selectAulaGrupoProfessor_periodo($valor['idPlanoAcaoGrupo'],$dataAtual);
	
		$nomeProfessor = "";
		foreach ($valorProfessor as $VP) {							
										
		$nomeProfessor .= $Professor->getNome($VP)."<br>";
		}
			
			
          $html .= "<td > º " . $nomeProfessor . "</td>";
				} else if ($campo == 'material') {
					$valorFF = $FolhaFrequencia->selectFolhaFrequencia(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$valor['idPlanoAcaoGrupo']." AND finalizadaParcial = 1 order BY idFolhaFrequencia DESC");

		$idFolhaFrequencia = $valorFF[0]['idFolhaFrequencia'];
		 
    	//	$kit = $KitMaterial->AcompanhamentoPorKit($valor['idPlanoAcaoGrupo'], $idFolhaFrequencia, $abrir, $atualizar,$relatorio,1,0,1);
            $mont = $Montado->AcompanhamentoMaterialMontado($valor['idPlanoAcaoGrupo'], $idFolhaFrequencia, $abrir, $atualizar,$relatorio,1,0,1);
            $plan = $MaterialPlano->AcompanhamentoMaterialPlano($valor['idPlanoAcaoGrupo'], $idFolhaFrequencia, $abrir, $atualizar,$relatorio,1,1);
            if($kit!="") {
                $html2 = $kit;
            }elseif($mont!="") {
                $html2 = $mont;
            }elseif($plan!="") {
                $html2 = $plan;
            }else {
                $html2 = "<td>".$nomeM."</td><td>".$unidadeFinal."</td><td>".$unidadeAtual."</td><td>".$obs."</td>";
            }
          $html .= $html2;			
				} else if ($campo == 'dataAplicacao') {
		            $html .= "<td ></td>";
		        } else if ($campo == 'obsProva') {
		  			$html .= "<td></td>";
		 		} else if ($campo == 'anexo'){
					$html .= "<td></td>";
				} else if ($campo == 'novaData') {
					 $html .= "<td ><font color=\"red\">" . Uteis::exibirData($valor['dataPrevistaNova']) . "</font></td>";
				} else if ($campo == 'dataPrevista') {
					 $html .= "<td >" . Uteis::exibirData($valor['dataPrevistaInicial']) . "</td>";		
				}
          $html2 = "";
			}
          $html .= "</tr>";
			}
        }

        $html .= "</tbody>";

      }

    $html_base = $this-> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head, $numero);
    return $html_base . $html;
   }
   

  function relatorioRecebiveis($where = "", $tipo, $excel = false, $campos, $camposNome) {

    $sql = "SELECT SQL_CACHE DISTINCT(D.idDemonstrativoCobranca), G.nome, CPJ.razaoSocial, D.valCurso, D.valMaterial, D.valCredito, D.valDebito, D.totalHoras,
    (COALESCE(D.valCurso,0) + COALESCE(D.valMaterial,0) + COALESCE(D.valCredito,0) - COALESCE(D.valDebito,0)) AS totalCusto, D.dataVencimento , D.mes,
    D.ano
    FROM demonstrativoCobranca AS D   
    LEFT JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = D.planoAcaoGrupo_idPlanoAcaoGrupo
    LEFT JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
    LEFT JOIN clientePj AS CPJ ON CPJ.idClientePj = D.clientePj_idClientePj
    LEFT JOIN gerenteTem as GER ON GER.clientePj_idClientePj = CPJ.idClientePj    
    " . $where;
	
 //  echo $sql;
    $result = $this -> query($sql);

    $total = 0;

    if (mysqli_num_rows($result) > 0) {
      $html .= "<tbody>";
      while ($valor = mysqli_fetch_array($result)) {
			if ($campos) {
        $html .= "<tr>";
			foreach ($campos as $campo) {
				if ($campo == 'grupo') {
        $html .= "<td >" . $valor['nome'] . "</td>";
    		} else if ($campo == 'empresa') {
        $html .= "<td >" . $valor['razaoSocial'] . "</td>";
			} else if ($campo == 'curso') {
        $html .= "<td >" . Uteis::formatarMoeda($valor['valCurso']) . "</td>";
			} else if ($campo == 'material') {
        $html .= "<td >" . Uteis::formatarMoeda($valor['valMaterial']) . "</td>";
			} else if ($campo == 'credito') {
        $html .= "<td >" . Uteis::formatarMoeda($valor['valCredito']) . "</td>";
			} else if ($campo == 'debito') {				
        $html .= "<td >" . Uteis::formatarMoeda($valor['valDebito']) . "</td>";
			} else if ($campo == 'horasAula') {
        $html .= "<td >" . Uteis::exibirHoras($valor['totalHoras']) . "</td>";
			} else if ($campo == 'total') {
        $html .= "<td >" . Uteis::formatarMoeda($valor['totalCusto']) . "</td>"; 
			} else if ($campo == 'vencimento') {
        $html .= "<td >" . $valor['mes']."/".$valor['ano']."</td>";
		
			}
				}
        $html .= "</tr>";
			}
        $total += $valor['totalCusto'];
		$totalHoras += $valor['totalHoras'];
		$totalD += $valor['valDebito'];
		$totalC += $valor['valCredito'];
		$totalM += $valor['valMaterial'];
		$totalCurso += $valor['valCurso'];
      }
	  $camposNome[2] = "Total Curso: ".Uteis::formatarMoeda($totalCurso);
      $camposNome[3] = "Total Material: ".Uteis::formatarMoeda($totalM);
	  $camposNome[4] = "Total Crédito: ".Uteis::formatarMoeda($totalC);
	  $camposNome[5] = "Total Débito: ".Uteis::formatarMoeda($totalD);
	  $camposNome[6] = "Total Horas:".Uteis::exibirHoras($totalHoras);
	  $camposNome[7] = "Total Geral:".Uteis::formatarMoeda($total);
    }

    $html_base = $this -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);
    return $html_base . $html;

  }
  
  function relatorioReajuste($where = "", $excel = false, $campos, $camposNome){
	  
	  $Relatorio = new Relatorio();
      $sql = "SELECT PAG.idPlanoAcaoGrupo , VH.valorHora, VH.cargaHorariaFixaMensal, VH.valorDescontoHora, VH.previsaoReajuste, VH.validadeDesconto, MONTH(VH.previsaoReajuste) as mes, YEAR(VH.previsaoReajuste) as ano, VH.dataInicio, 
      VH.dataFim, G.nome, GPJ.clientePj_idClientePj FROM valorHoraGrupo AS VH
      INNER JOIN planoAcaoGrupo AS PAG ON VH.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 
	  AND PAG.inativo = 0
      INNER JOIN grupo AS G ON PAG.grupo_idGrupo = G.idGrupo
	  AND G.inativo = 0
      INNER JOIN grupoClientePj AS GPJ ON G.idGrupo = GPJ.grupo_idGrupo 
      INNER JOIN gerenteTem as GER ON GER.clientePj_idClientePj = GPJ.clientePj_idClientePj WHERE 1  ".$where;
      $where;
 //   echo $sql;
        $result = $this -> query($sql);
        $total = 0;
    
        if (mysqli_num_rows($result) > 0) {
          $html .= "<tbody>";
          while ($valor = mysqli_fetch_array($result)) {
    			if ($campos) {
            $html .= "<tr>";
			foreach ($campos as $campo) {
				if ($campo == 'grupo') {
             $html .= "<td>";
			 $onclick = "onclick='abrirNivelPagina(this,\"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$valor['idPlanoAcaoGrupo']."\", \"\", \"\")'";
			 if (!$excel) {
			 $html .= "<img src='/cursos/images/cad.png' title='Ver grupo' $onclick>";
			 } 
			 $html .= $valor['nome']."</td>";
				} else if ($campo == 'valorHora') {
					$html .= "<td >" . Uteis::formatarMoeda($valor['valorHora']) . "</td>";
				} else if ($campo == 'cargaFixa') {
            		$html .= "<td >" . Uteis::exibirHoras($valor['cargaHorariaFixaMensal']) . "</td>";
				} else if ($campo == 'desconto') {
            		$html .= "<td >" . Uteis::formatarMoeda($valor['valorDescontoHora']) . "</td>";
				} else if ($campo == 'validade') {
            		$html .= "<td >" . Uteis::exibirData($valor['validadeDesconto']) . "</td>";
				} else if ($campo == 'previsao') {
            		$html .= "<td >" . Uteis::exibirData($valor['previsaoReajuste']) . "</td>";
				}
					}
            $html .= "</tr>"; 
				}
          }
          $html .= "</tbody>";
        }

	   $html_base = $Relatorio -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);
       return $html_base . $html;
  }
  
  
  function relatorioNF($where, $total = true, $excel = false){
       
  $sql ="";    
  $result = $this -> query($sql);
    
        $total = 0;
    
        if (mysqli_num_rows($result) > 0) {
          $html .= "<tbody>";
          while ($valor = mysqli_fetch_array($result)) {
    
            $html .= "<tr>";
            $html .= "<td >" .$Grupo."</td>";
            $html .= "<td >" .$Empresa. "</td>";
            $html .= "<td >" .$CNPJ. "</td>";
            $html .= "<td >" .$Aluno. "</td>";
            $html .= "<td >" .$Email. "</td>";
            $html .= "<td >".$parteEmpresa."</td>";
            $html .= "<td >".$parteAluno."</td>";
            $html .= "<td $onclick>".$nfe."</td>";
            $html .= "<td >".$vencimento."</td>";
            $html .= "</tr>";    
          }
          $html .= "</tbody>";
        }
    $colunas = array("Grupo", "Empresa", "CNPJ", "Aluno", "CPF", "Email", "Parte Total Empresa(R$)", "Parte Total Aluno(R$)", "NFE", "Vencimento");   
    $html_base = $this -> montaTb($colunas, $excel);
    return $html_base . $html;
  }
    
 
  function relatorioAcompanhamento($where = "", $tipo, $excel = false,$mes_ini, $ano_ini, $mes_fim, $ano_fim, $relatorio,$unicoAluno, $trazerFrequencia, $campos, $camposNome) {

	$Grupo = new Grupo();
	$Idioma = new Idioma();
	$NivelEstudo = new NivelEstudo();
	$Professor = new Professor();
	$IntegranteGrupo = new IntegranteGrupo();
	$AulaPermanenteGrupo = new AulaPermanenteGrupo();
	$ClientePj = new ClientePj();
	$RelatorioDesempenho = new RelatorioDesempenho();
	$PeriodoAcompanhamentoCurso = new PeriodoAcompanhamentoCurso();
	$PlanoAcaoGrupo = new PlanoAcaoGrupo();

		
		$sql3 = "SELECT SQL_CACHE idTipoItenRelatorioDesempenho, nome, avaliacao, reavaliacao 
			FROM tipoItenRelatorioDesempenho 
			WHERE inativo = 0 
			AND  ((avaliacao between ".$mes_ini." and ".$mes_fim.")
			OR (reavaliacao between ".$mes_ini." AND ".$mes_fim."))";
		
	  $result2 = $this -> query($sql3);
	 
	  $colunas = array("Grupo", "Idioma/Nível", "Dias e Horários", "Inicio do Nivel", "Termino do Nivel", "Professor", "Aluno(s)", "Data entrada", "Data saída");

	  $meses = array();
  
	 // $xy = 0;
	  		
	  for ($x=$mes_ini;$x<($mes_fim+1);$x++) {	
//	  $mesAtual = $x;
	  
	  if  (($x == 1) || ($x == 7)) {
		  $habilidade = "Produção Oral";
	  } else if (($x == 2) || ($x == 8)) {
		  $habilidade = "Compreensão Oral";
	  } else if (($x == 3) || ($x == 9)) {
		  $habilidade = "Escrita";
	  } else if (($x == 4) || ($x == 10)) {
		  $habilidade = "Leitura";
	  } else if (($x == 5) || ($x == 11)) {
		  $habilidade = "Pronúncia";
	  } else if (($x == 6) || ($x == 12)) {
		  $habilidade = "Vocabulário";
	  }
	  

    	if ($x > 6) {
		$colunas[] = $habilidade."<br>Reavaliado em: ".Uteis::retornaNomeMes($x);	
		$colunas[] = "Atitude:".$habilidade."<br>Reavaliado em: ".Uteis::retornaNomeMes($x);	
		if ($trazerFrequencia == 1) {
		$colunas[] = "Frequência com Justificativa";	
		}
		} else {
		$colunas[] = $habilidade."<br>Avaliado em: ".Uteis::retornaNomeMes($x);
		$colunas[] = "Atitude:".$habilidade."<br>Avaliado em: ".Uteis::retornaNomeMes($x);
		if ($trazerFrequencia == 1) {
		$colunas[] = "Frequência com Justificativa";	
			}
		}
		$meses[] = $x;
		}
		
		$colunas[] = "Nota 1º Prova";
		$colunas[] = "Nota 2º Prova";
		
	if ($mes_ini < 10) {
			$mesIni = "0".$mes_ini;
		} else  {
			$mesIni = $mes_ini;
		}
		
		$where .= " AND ((IG.dataSaida IS NULL) OR (IG.dataSaida >= '2018-06-01'))";

	$sql = "SELECT  distinct(G.idGrupo), G.nome as grupo, PA.nivelEstudo_IdNivelEstudo, PAG.idPlanoAcaoGrupo, NE.nivel,PA.idPlanoAcao ,idIntegranteGrupo, PAG.dataPrevisaoTerminoEstagio , PAG.dataInicioEstagio, IG.dataEntrada, IG.dataSaida, P.idProposta, P.idioma_idIdioma,CPF.nome, CPF.idClientePf	
	FROM grupo as G
	INNER JOIN grupoClientePj as GPJ on G.idGrupo = GPJ.grupo_idGrupo
	INNER JOIN gerenteTem as GER on GPJ.clientePj_idClientePj = GER.clientePj_idClientePj
	AND GER.dataExclusao is null
	INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo 
	INNER JOIN integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
	INNER JOIN clientePf as CPF on CPF.idClientePf = IG.clientePf_idClientePf
	INNER JOIN planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao
	INNER JOIN nivelEstudo AS NE on NE.idNivelEstudo = PA.nivelEstudo_IdNivelEstudo
	INNER JOIN proposta AS P on  PA.proposta_idProposta = P.idProposta
	 " .$where;
//	 echo $sql;
   $result = $this -> query($sql);
	
	 if (mysqli_num_rows($result) > 0) {
      $html .= "<tbody>";
	  $dia = "";

      while ($valor = mysqli_fetch_array($result)) { // Inicio loop geral
//		echo "teste";  
		  $mesFim = date($ano_fim."-".$mes_fim."-t");
		  
		  $idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
		  $nomeIdioma = $Idioma->getNome($valor['idioma_idIdioma']);
		  $idGrupo2 = $valor['idGrupo'];
		  $valorx2 = $PlanoAcaoGrupo->getTodosPAG($idPlanoAcaoGrupo);
		  $idIntegranteGrupo = $IntegranteGrupo->getidIntegranteGrupo("",$valorx2,$mesFim);
		  $nomeAluno = $valor['nome'];
		  $idClientePf = $valor['idClientePf'];
		  $ids = explode(",", $idIntegranteGrupo);
		  
		$html .= "<tr>";
		if (!$excel) {
		$img = 	"<img src='/cursos/images/cad.png' title='Ver grupo' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$idPlanoAcaoGrupo."\",\"\" ,\"\" )'>";
		}
		
		$html .= "<td>".$img.$valor['grupo']."</td>";	
		$html .="<td>".$nomeIdioma. " <br> ".$valor['nivel']."</td>";  
		
		//Dias e Horarios
		$sql2 = "SELECT distinct(idAulaPermanenteGrupo) 
			FROM aulaGrupoProfessor AS AGP
			LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa AND AF.excluido = 0
			LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
			INNER JOIN planoAcaoGrupo AS PAG ON
			PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo 
			WHERE PAG.idPlanoAcaoGrupo =" . $idPlanoAcaoGrupo ." AND AP.dataFim is null";
			
			$rs = $this -> query($sql2);
			
	//		Uteis::pr( $sql2);
			
			if (mysqli_num_rows($rs) > 0) { //Loop dias e horarios
			while ($valors = mysqli_fetch_array($rs)) { 
				
		$dia .= $AulaPermanenteGrupo->montaDias($valors['idAulaPermanenteGrupo'])."<br>";
		
		$valorProfessor = $AulaPermanenteGrupo->professorDoDia($valors['idAulaPermanenteGrupo']);
		$idProfessor = $valorProfessor[0]['professor_idProfessor'];
	
		  
		if ($idProfessor >0) {
		if (!$excel) {
		$onclickP = "<img src='/cursos/images/cad.png' title='Ver Professor' onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $idProfessor . "', '', '$onde')\"> ";
		}
		$NomePro .= $onclickP." ".$Professor->getNome($idProfessor)."<br>";
		}
			}
			} // fechamento Loop dias e horarios
	
		$html .= "<td >" .$dia . "</td>";
		$html .= "<td >" .Uteis::exibirData($valor['dataInicioEstagio']) . "</td>";
		$html .= "<td >" .Uteis::exibirData($valor['dataPrevisaoTerminoEstagio']) . "</td>";
		
		$dia = "";
		$html .= "<td> " .$NomePro . "</td>";
			if (!$excel) {
					$onclickC = "<img src='/cursos/images/cad.png' title='Ver Aluno' onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD ."clientePf/cadastro.php?id=".$valor['idClientePf']."', '', '$onde')\" >";
				} else {
					$onclickC = '';
				}
		$html .= "<td >".$onclickC.$valor['nome']."</td>";
		$html .= "<td >" .Uteis::exibirData($valor['dataEntrada']) . "</td>";
		$html .= "<td ><strong>" .Uteis::exibirData($valor['dataSaida']) . "<strong></td>";

		$NomePro = "";
	
		// Alunos

		$linhaProva = array();
		$html1 = "";
		$html3 = "";
		$html4 = "";

		foreach ($ids as $value) { //Verificação notas (integrantegrupo)
		
		$sql3 = "SELECT SQL_CACHE IG.idIntegranteGrupo, P.nome AS nomeProva, C.dataAplicacao, AVG(ICP.nota) AS notaProva, PAG.idPlanoAcaoGrupo, CPF.idClientePf FROM
    grupo AS G
        INNER JOIN
    planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo
        INNER JOIN
    integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        INNER JOIN
    clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf
        INNER JOIN
    calendarioProva AS C ON C.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        INNER JOIN
    prova AS P ON P.idProva = C.prova_idProva
        INNER JOIN
    itenProva AS IP ON IP.prova_idProva = P.idProva
        INNER JOIN
    itemCalendarioProva AS ICP ON ICP.calendarioProva_idCalendarioProva = C.idCalendarioProva
        AND ICP.itenProva_idItenProva = IP.idItenProva
        AND ICP.integranteGrupo_idIntegranteGrupo = IG.idIntegranteGrupo
        INNER JOIN
    professor AS PRF ON PRF.idProfessor = ICP.professor_idProfessor
        LEFT JOIN
    grupoClientePj AS GPJ ON GPJ.grupo_idGrupo = G.idGrupo
        INNER JOIN
    gerenteTem AS GER ON GPJ.clientePj_idClientePj = GER.clientePj_idClientePj
        LEFT JOIN
    clientePj AS PJ ON PJ.idClientePj = GPJ.clientePj_idClientePj
		WHERE
 	IG.idIntegranteGrupo = ".$value."
 	GROUP BY IG.idIntegranteGrupo , P.nome
 	ORDER BY C.idCalendarioProva ASC";
 //echo $sql3;
 
  $result3 = $this -> query($sql3);
 	 while ($valors = mysqli_fetch_array($result3)) {
		 	 
     	 $html2 = "<div>";
		 $html2 .= $valors['nomeProva']." <center>". Uteis::formatarMoeda($valors['notaProva'])."</center></div>";

		 $linhaProva[$value][] = $html2;	
		
		 }
		 
		 // Nota 1º Prova
		 if ($linhaProva[$value][0] != '') {
		 $html1 .= "<div > ".$linhaProva[$value][0]."</div>";
		 }

		 // Nota 2º Prova
		 if ($linhaProva[$value][1]) {
	     $html3 .= "<span> ".$linhaPova[$value][1]."</span>";
		 }
		 
		
		} //FIM Verificação notas e frequencias(integrantegrupo)
		
	
	foreach ($meses AS $mes) {
		//Frequencia
		
		$valorPeriodo = $PeriodoAcompanhamentoCurso->selectPeriodoAcompanhamentoCurso(" WHERE mes = ".$mes." AND ano = ".$ano_ini);
			
			$idPeriodoAcompanhamentoCurso = $valorPeriodo[0]['idPeriodoAcompanhamentoCurso'];

			//Buscar se já existe
			$sql4 = "SELECT SQL_CACHE idAcompanhamentoCurso, professor_idProfessor, periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso, planoAcaoGrupo_idPlanoAcaoGrupo, obs, finalizadoParcial, finalizadoGeral, arquivado FROM acompanhamentoCurso WHERE planoAcaoGrupo_idPlanoAcaoGrupo in (".$valorx2.")  AND periodoAcompanhamentoCurso_idPeriodoAcompanhamentoCurso = ".$idPeriodoAcompanhamentoCurso. " AND (arquivado = 0 OR arquivado is null) ";
			$rsAcomapanhamentoCurso = $this -> executeQuery($sql4); 
			
			if ($trazerFrequencia == 1) {
			$Freq = $this->relatorioFrequencia_mensal(" WHERE CPF.idClientePf = " . $idClientePf . " AND MONTH(FF.dataReferencia) = ".$mes." AND YEAR(FF.dataReferencia) = ".$ano_ini." AND FF.finalizadaPrincipal = 1 AND BH.credDeb is null");
			
			$frequenciaAlunos = "";
			
			foreach($Freq as $valorFreq) {
					
					 $horasRealizadasPeloGrupo = $valorFreq['horasRealizadasPeloGrupo'] + $valorFreq['somarCom_horasRealizadasPeloGrupo'];
	
					 $horaRealizadaAlunoSem = $valorFreq['horaRealizadaAluno'];
					 $aulasJustificadas_aluno =  $valorFreq['aulasJustificadas_aluno'];
					 
		             $percentPresencaAluo = ($ClientePj->get_faltaJustificadaPresenca($valorFreq['idClientePj'])) ? ($horaRealizadaAlunoSem+$aulasJustificadas_aluno) : $horaRealizadaAlunoSem;  
		 		  
           			 $AlunoPer = ($percentPresencaAluo  / $horasRealizadasPeloGrupo  )*100;
		   
		   			 if ($AlunoPer > 100) {
			  			 $AlunoPer = 100;
		   			 }

					$duasFolhas++;
				}
				
				if ($duasFolhas > 1) {
					if (!$excel)
					$imagem = "<img	title=\"Mais de uma FF\" src=\"".CAMINHO_IMG."pendente.png\">"; 
		
				} else {
					$imagem = "";	
				}
				if ($AlunoPer < 75) { 
					$style2 = "color:red";
				} else {
					$style2 = "";
				}
				
                $frequenciaAlunos .= "<div> " . round($AlunoPer, 2) . "%".$imagem."</div>";
			}

		// notas de desempenho
		for ($y=0;$y<count($rsAcomapanhamentoCurso);$y++) {
	$idAcompanhamentoCurso = $rsAcomapanhamentoCurso[$y]['idAcompanhamentoCurso'];
	$idProfessor2 = $rsAcomapanhamentoCurso[$y]['professor_idProfessor'];
	$nomeProf2 = $Professor->getNome($idProfessor2);
	
$nota1 = $RelatorioDesempenho->selectRelatorioDesempenhoTrRel(" AND acompanhamentoCurso_idAcompanhamentoCurso = ".$idAcompanhamentoCurso, $idAcompanhamentoCurso, $value, $mes, 1, 1, "","",$idClientePf);

$valor = $RelatorioDesempenho->selectRelatorioDesempenho(" WHERE acompanhamentoCurso_idAcompanhamentoCurso =".$idAcompanhamentoCurso. " AND integranteGrupo_idIntegranteGrupo in (".$idIntegranteGrupo.")");

	$obs = $valor[0]['obs'];
	if ($obs != '') {
		if (!$excel) {
	$imagem = "<img	title=\"".$obs."\" src=\"".CAMINHO_IMG."pendente.png\">"; 
		}
		
	} else {
	$imagem = "";
	}

			$style="";
		if ($nota1 != '') {
			
 	// Nota de desempenho mensal
	if (($nota1[0] < 7) && ($nota1[0] != '')){
			$style = "color:red";	
		} else {
			$style = "";
		}
		
		$style="";
	if (($nota1[1] < 7) && ($nota1[1] != '')) {
			$style = "color:red";	
		} else {
			$style = "";
			}	
		}

		}
		
		$html .= "<td>".$imagem."<span title=\"".$obs."\" style='$style';> ".$nota1[0]."</span></td>";
		$html .= "<td>".$imagem."<span title=\"".$obs."\" style='$style';> ".$nota1[1]."</span></td>";

		if ($trazerFrequencia == 1) {
			$html .= "<td>".$frequenciaAlunos."</td>";
		} 
		
	}

		//Notas de provas
		$html .= "<td>".$html1."</td>";
    	$html .= "<td>".$html3."</td>";  
		
		$html .= "</tr>";
	  }
	 }
	 
	   $topo = Uteis::topo();
	  
    $html_base = $this -> montaTb($colunas, $excel);
	if (!$excel )  {
       return $html_base . $html;
	} else {
		
	   return $topo. $html_base . $html;	
	}
  }
 
 
   function relatorioInformacoes($where = "", $tipo, $excel = false,$mesIni, $mesFim) {

	$Grupo = new Grupo();
	$Idioma = new Idioma();
	$NivelEstudo = new NivelEstudo();
	$Professor = new Professor();
	$IntegranteGrupo = new IntegranteGrupo();
	$AulaPermanenteGrupo = new AulaPermanenteGrupo();
	$PlanoAcaoGrupo = new PlanoAcaoGrupo();
	$PlanoAcao = new PlanoAcao();
	$CalendarioProva = new CalendarioProva();
	$Prova = new Prova();
	$FolhaFrequencia = new FolhaFrequencia();
	$KitMaterial = new KitMaterial();
	$Montado = new MaterialMontadoPlanoAcao();
	$MaterialPlano = new MaterialDidaticPlanoAcao();
	
	$sql = "SELECT distinct(G.idGrupo), G.nome as grupo
   	FROM grupo as G
	INNER JOIN grupoClientePj as GPJ on G.idGrupo = GPJ.grupo_idGrupo
	INNER JOIN gerenteTem AS GER ON GPJ.clientePj_idClientePj = GER.clientePj_idClientePj AND dataExclusao IS NULL
	INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo AND PAG.inativo = 0
	INNER JOIN planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao 
	 " .$where;
	
 //   echo $sql;
    $result = $this -> query($sql);

    $colunas = array("Grupo", "Idioma/Nível", "Dias e Horários", "Professor", "Aluno(s)", "Emails", "Carga horária do estágio (previsão)", "Data de início", "Calendário de Provas", "Plano de curso", "Previsão do término de estágio" );
		

    if (mysqli_num_rows($result) > 0) {
      $html .= "<tbody>";
      while ($valor = mysqli_fetch_array($result)) {

    	$idIdioma = $Grupo->getIdIdioma($valor['idGrupo']);
		$nomeIdioma = $Idioma->getNome($idIdioma);
		$idPlanoAcaoGrupo = $PlanoAcaoGrupo->getPAG_atual($valor['idGrupo']);

		$idNivel = $PlanoAcaoGrupo->getIdNivel($idPlanoAcaoGrupo); 
		$nomeNivel = $NivelEstudo->getNome($idNivel); 	
		
		$sql2 = "SELECT distinct(idAulaPermanenteGrupo) 
			FROM aulaGrupoProfessor AS AGP
			LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa AND AF.excluido = 0
			LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
			INNER JOIN planoAcaoGrupo AS PAG ON
			PAG.idPlanoAcaoGrupo = AF.planoAcaoGrupo_idPlanoAcaoGrupo OR PAG.idPlanoAcaoGrupo = AP.planoAcaoGrupo_idPlanoAcaoGrupo
			WHERE PAG.idPlanoAcaoGrupo =" . $idPlanoAcaoGrupo ." AND AP.dataFim is null";
	
		$rs = $this -> query($sql2);	
		 if (mysqli_num_rows($rs) > 0) {
			while ($valors = mysqli_fetch_array($rs)) {
		$dia .= $AulaPermanenteGrupo->montaDias($valors['idAulaPermanenteGrupo'])."<br>";
		$diaTmp = $AulaPermanenteGrupo->montaDias($valors['idAulaPermanenteGrupo'])."<br>";
		
		$valorProfessor = $AulaPermanenteGrupo->professorDoDia($valors['idAulaPermanenteGrupo']);
		$idProfessor = $valorProfessor[0]['professor_idProfessor'];
	
		if ($idProfessor >0) {
		$NomePro = $Professor->getNome($idProfessor)."<br>";
		}
		 	}

		 } else {
		$dia = $diaTmp;

		}
	    $html .= "<tr>";
        $html .= "<td >" . $valor['grupo'] . "</td>";
		$html .= "<td >" . $nomeIdioma . "<br>". $nomeNivel. "</td>";	
		$html .= "<td >" .$dia . "</td>";	
		$dia = "";
        $html .= "<td >".$NomePro . "</td>"; 
		$html .= "<td >";
		
		$Emails = "";
		
		if ($mesFim == "") { $mesFim = date("Y-m-30"); } else {$mesFim = date("Y-".$mesFim."-30"); }

		$rs2 = $IntegranteGrupo->getidIntegranteGrupo("",$idPlanoAcaoGrupo,$mesFim);
    	$ids = explode(",",$rs2);
	
		
			foreach ($ids as &$value) {
		$nome = $IntegranteGrupo->getNomePF($value)."<br>";
		$html .= $nome;
		
		$Emails .= $IntegranteGrupo->getEmail($value)."<br>";
		
			 }
	$valorEstagio = $PlanoAcaoGrupo->selectPlanoAcaoGrupo("WHERE idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
	
	if ($valorEstagio != '') {
		$dataInicio = $valorEstagio[0]['dataInicioEstagio'];
		$dataTermino = $valorEstagio[0]['dataPrevisaoTerminoEstagio'];
		
		$horasPrograma = $PlanoAcao->getHorasPrograma($valorEstagio[0]['planoAcao_idPlanoAcao']);
		
		$valorProvas = $CalendarioProva->selectCalendarioProva("WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
	
		$html2 = "";
		 foreach ($valorProvas as $valor) {
			  
			$dataAplicacao =  $valor['dataAplicacao'];
			
			$dataPrevistaNova = $valor['dataPrevistaNova'];
			
			$dataPrevistaInicia = $valor['dataPrevistaInicial'];
			
				$valorFrequencia = $FolhaFrequencia->selectFolhaFrequencia("WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo. " order by idFolhaFrequencia DESC");
		
		$idFolhaFrequencia = $valorFrequencia[0]['idFolhaFrequencia'];
		
	$kit = $KitMaterial->AcompanhamentoPorKit($idPlanoAcaoGrupo, $idFolhaFrequencia, "", "",1);
    $mont = $Montado->AcompanhamentoMaterialMontado($idPlanoAcaoGrupo, $idFolhaFrequencia, "", "",1);
    $plan = $MaterialPlano->AcompanhamentoMaterialPlano($idPlanoAcaoGrupo, $idFolhaFrequencia, "", "",1);
    

    if($kit!="") {
       $nivelAtual = $kit;
	} elseif($mont!="") {
        $nivelAtual = $mont;
	} elseif($plan!="") {
		$nivelAtual = $plan;
	}
			
			$valorProva = $Prova->selectProva("WHERE idProva = ".$valor['prova_idProva']);
    		$nomeProva = $valorProva[0]['nome'];
			
			$html2 .= "Prova: ".$nomeProva."<br>";
			
			if ($dataAplicacao > 0) {
				
				$html2 .= "Prova aplicada em ".Uteis::exibirData($dataAplicacao)."<br><br>";
				
			} elseif ($dataPrevistaNova >0) {
				
				$html2 .= "Nova data prevista:  ".Uteis::exibirData($dataPrevistaNova)."<br><br>";
				$html2 .= "Data prevista:  ".Uteis::exibirData($dataPrevistaInicia)."<br><br>";
				
			} else {
				$html2 .= "Data prevista:  ".Uteis::exibirData($dataPrevistaInicia)."<br><br>";
			}
			
		  }
	}
    	$html .= "</td>";
		$html .= "<td>".$Emails."</td>";
        $html .= "<td >" . Uteis::exibirHoras($horasPrograma) . "</td>";
		$html .= "<td >" . Uteis::exibirData($dataInicio) . "</td>";
		$html .= "<td >" . $html2 . "</td>";
		$html .= "<td >";
		if ($nivelAtual >0 ) {
		$html .= " Grupo está na unidade " . $nivelAtual . " do livro";
		} else { 
		$html .= " Informação pendente ";
		}
		$html .=  "</td>";
		$html .= "<td >" . Uteis::exibirData($dataTermino) . "</td>";
        $html .= "</tr>";
      }
      $html .= "</tbody>";
    }

    $html_base = $this -> montaTb($colunas, $excel);

    return $html_base . $html;

  }
  
 
  
  function relatorioPsa($gerente = "", $where = "", $campos, $camposNome, $excel = false, $mostrarComentarios, $idProfessor, $tipo, $idNotasTipoNota, $quesito, $soRetorno =0, $idIdioma) {
	  	  
	  $AulaGrupoProfessor = new AulaGrupoProfessor();
	  $Professor = new Professor();
	  $ClientePf = new ClientePf();
	  
	$idProfessor = (int) $idProfessor;
	$where = " WHERE PIG.finalizado = 1 " . $where;
    $sql_id = "SELECT PIG.idPsaIntegranteGrupo FROM psaIntegranteGrupo AS PIG " . $where;

    $sql_corpo = " FROM psaIntegranteGrupo AS PIG  
    LEFT JOIN integranteGrupo AS IG ON IG.idIntegranteGrupo = PIG.integranteGrupo_idIntegranteGrupo
    INNER JOIN planoAcaoGrupo AS PAG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
	INNER JOIN planoAcao AS PA ON PAG.planoAcao_idPlanoAcao = PA.idPlanoAcao
	INNER JOIN proposta AS PR ON PA.proposta_idProposta = PR.idProposta
    INNER JOIN grupo AS G ON PAG.grupo_idGrupo = G.idGrupo
    INNER JOIN grupoClientePj AS GCNPJ ON GCNPJ.grupo_idGrupo = G.idGrupo
    INNER JOIN gerenteTem AS GER ON GER.clientePj_idClientePj = GCNPJ.clientePj_idClientePj  AND GER.dataExclusao IS NULL
    LEFT JOIN clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf 
	LEFT JOIN professor AS P on P.idProfessor = IG.professor_idProfessor";
	
	  $sql = "SELECT SQL_CACHE PIG.idPsaIntegranteGrupo, PAG.idPlanoAcaoGrupo, G.nome AS Grupo, CPF.nome AS nomeAluno, PIG.dataReferencia, CPF.idClientePf, P.nome AS nomeProfessor, P.idProfessor";
	
	if ($idProfessor > 0) {
	
	$sql_corpo .= " INNER JOIN respostaPsaProfessor AS RPP on RPP.psaIntegranteGrupo_idPsaIntegranteGrupo = PIG.idPsaIntegranteGrupo AND RPP.professor_idProfessor = ".$idProfessor;
	
	$sql .= " ,RPP.professor_idProfessor";
	}
	
	if ($idIdioma != '') {
		
	$where .= " AND PR.idioma_idIdioma = ".$idIdioma;
		
	}
	
	$sql .=  $sql_corpo . $where.$gerente;
	
//	echo $sql;
	
    $result = $this -> query($sql);

    //CARREGA DADOS DE TABELAS RELACIONADAS DE FORMA DINAMICA (de acordo com a parametrização do sistema)
    $PsaProfessor = new PsaProfessor();
    $rsPsaProfessor = $PsaProfessor -> selectPsaProfessor(" WHERE excluido = 0 AND inativo = 0 AND tipo = ".$tipo);

	$totalNotas = 0;
	$totalProfessor = 0;
    foreach ($rsPsaProfessor as $valorPsaProfessor) {
        $sql = "SELECT MAX(total) AS total FROM (
          SELECT COUNT(R.idRespostaPsaProfessor) AS total 
          FROM psaIntegranteGrupo AS PIG 
          INNER JOIN respostaPsaProfessor AS R ON R.psaIntegranteGrupo_idPsaIntegranteGrupo = PIG.idPsaIntegranteGrupo
		  WHERE ";
		  
		  if ($idNotasTipoNota != '') {
						$sql .= " R.notasTipoNota_idNotasTipoNota = ".$idNotasTipoNota." AND ";
					}
		  
		  $sql .= " PIG.idPsaIntegranteGrupo IN ( $sql_id ) AND R.psaProfessor_idPsaProfessor = " . $valorPsaProfessor['idPsaProfessor'] . " 
          GROUP BY PIG.idPsaIntegranteGrupo
        ) AS total";
//		echo $sql;
       $rs = Uteis::executarQuery($sql);
        $colspan[$valorPsaProfessor['titulo']] = $rs[0]['total'];
      }
 
    $PsaRegular = new PsaRegular();
    $rsPsaRegular = $PsaRegular -> selectPsaRegular(" WHERE (excluido = 0 AND inativo = 0 AND tipo = ".$tipo.") OR (idPsa = 7) ORDER BY ordem ");
		
	$valorPsa = array();
    foreach ($rsPsaRegular as $valorPsaRegular) {
		
		$valorPsa[] = $valorPsaRegular['idPsa'];
		
        $sql = "SELECT MAX(total) AS total FROM (
          SELECT COUNT(R.idRespostaPsaRegular) AS total 
          FROM psaIntegranteGrupo AS PIG 
          INNER JOIN respostaPsaRegular AS R ON R.psaIntegranteGrupo_idPsaIntegranteGrupo = PIG.idPsaIntegranteGrupo
          WHERE PIG.idPsaIntegranteGrupo IN ( $sql_id ) AND R.psaRegular_idPsa = " . $valorPsaRegular['idPsa'] . " 
          GROUP BY PIG.idPsaIntegranteGrupo
        ) AS total";
	
		$rs = Uteis::executarQuery($sql);
        $colspan[$valorPsaRegular['titulo']] = $rs[0]['total'];

  	  }

    if (mysqli_num_rows($result) > 0) {

      $html .= "<tbody>";

      while ($valor = mysqli_fetch_array($result)) {
		  
        $valorProfessor = $AulaGrupoProfessor ->selectAulaGrupoProfessor_periodoDemo($valor['idPlanoAcaoGrupo'], $valor['dataReferencia']);
		$nomeProfessor2 = $Professor->getNome($valorProfessor[0]);
	    $idPsaIntegranteGrupo = $valor['idPsaIntegranteGrupo'];
		
        $idClientePf = $valor['idClientePf'];
		$email = $ClientePf->getEmail($idClientePf);
		
		// PSA Professor
		
		if ($rsPsaProfessor) {
             
                  $professor = new Professor();
                foreach ($rsPsaProfessor as $valorPsaProfessor) {
                    $sql = " SELECT N.idNotasTipoNota, N.nome AS valor, R.obs, R.professor_idProfessor FROM respostaPsaProfessor AS R
                    INNER JOIN tipoNota AS TN ON TN.idTipoNota = ".$valorPsaProfessor['tipo']."
                    INNER JOIN notasTipoNota AS N ON N.tipoNota_idTipoNota = TN.idTipoNota AND N.idNotasTipoNota = R.notasTipoNota_idNotasTipoNota";
					
					$sql .= " WHERE R.psaIntegranteGrupo_idPsaIntegranteGrupo = $idPsaIntegranteGrupo AND R.psaProfessor_idPsaProfessor = " . $valorPsaProfessor['idPsaProfessor'];
					
					if ($idNotasTipoNota != '') {
						$sql .= " AND N.idNotasTipoNota = ".$idNotasTipoNota;
					}
	
	              $rs = Uteis::executarQuery($sql);
				  $nomeProfessor = "";
				  
                   for ($i = 0; $i < $colspan[$valorPsaProfessor['titulo']]; $i++) {
					   
					   $nomeProfessor = $professor->getNome($rs[$i]['professor_idProfessor']);
					   if ($nomeProfessor == '') {
						$nomeProfessor = $nomeProfessor2;   
						   
					   }
					   
					   $valorAtual = isset($rs[$i]) ? $rs[$i]['valor'] : "Não Avaliado";
					   
					   if (is_numeric($valorAtual)) {
						$totalNotas += $valorAtual;  
						  $totalProfessor++;
					  }
					  
				//	  echo $totalNotas."<br>";
					   
					    if((is_numeric($valorAtual) && $valorAtual <= 6) || $valorAtual=="Ruim" || $valorAtual=="Regular" || $valorAtual=="Regular" || $valorAtual=="Prefiro Não Avaliar")
                      $cor = "style=\"background-color:#aa0000;color:#fff\"";
                      else 
                      $cor ="";    
                      
					  if ($excel == false) {
					  
                      $marcar = ($rs[$i]['obs']!='') ? "<img src=\"".CAMINHO_IMG."pendente.png\">":"";
					  
					  }
						   
					   if ($idNotasTipoNota != '') {
					   
                        if ($valorAtual == $rs[$i]['valor'] ) {
							$usarEste = 1;
							
							 $html2P .= "<td ".$cor.">" .$nomeProfessor. "</td>";  
							 
							 if ($mostrarComentarios == 0) {                   
                      $html2 .= "<td title=\"".$rs[$i]['obs']."\" ".$cor.">" . $valorAtual.$marcar. "</td>";
					  } else {
					  $html2 .= "<td ".$cor."><div style=\"width:168px;\" >" . $valorAtual.$marcar. "<br>".$rs[$i]['obs']."</div></td>";
					  }
						
						} else {
                      		$usarEste = 0;
						}
						
					   } else {
							$usarEste = 1;   
							
							 $html2P .= "<td ".$cor.">" .$nomeProfessor. "</td>";  
							 
							  if ($mostrarComentarios == 0) {                   
                      $html2 .= "<td title=\"".$rs[$i]['obs']."\" ".$cor.">" . $valorAtual.$marcar. "</td>";
					  } else {
					  $html2 .= "<td ".$cor."><div style=\"width:168px;\" >" . $valorAtual.$marcar. "<br>".$rs[$i]['obs']."</div></td>";
					  }
						   
					   }
						  
                    }

                  }
  				}
				
				// PSA Regular
				if ($semPro == 1) {
				
	
   			} else {
		
		if ($rsPsaRegular) {
			
			
            $html4 = "";
			   for ($i = 0; $i < count($rsPsaRegular); $i++) {
				   
	
	               $sql = " SELECT N.idNotasTipoNota, N.nome AS valor , R.obs, R.psaRegular_idPsa FROM respostaPsaRegular AS R                    
                    INNER JOIN tipoNota AS TN ON TN.idTipoNota = ".$rsPsaRegular[$i]['tipo']."
                    INNER JOIN notasTipoNota AS N ON N.tipoNota_idTipoNota = TN.idTipoNota AND N.idNotasTipoNota = R.notasTipoNota_idNotasTipoNota 
                    WHERE R.psaIntegranteGrupo_idPsaIntegranteGrupo = $idPsaIntegranteGrupo AND R.psaRegular_idPsa = " . $rsPsaRegular[$i]['idPsa']; 					
					if ($idNotasTipoNota != '') {
						$sql .= " AND N.idNotasTipoNota = ".$idNotasTipoNota;
					}
							
                    $rs = Uteis::executarQuery($sql);
					$valorAtual = isset($rs[0]) ? $rs[0]['valor'] : "Não Avaliado";
					
					if(is_numeric($valorAtual)) {
					  $notas[$rs[0]['psaRegular_idPsa']]['obs'] = $rs[0]['obs'];
					  $notas[$rs[0]['psaRegular_idPsa']]['valor'] = $valorAtual;
					  $notas[$rs[0]['psaRegular_idPsa']]['cor'] = $cor;
     
						if ($rs[0]['psaRegular_idPsa'] == 7) {
							$totalNPS += $valorAtual;
							$qtdeNPS++;	
						} elseif ($rs[0]['psaRegular_idPsa'] == 8) {
							$totalGestao += $valorAtual;	
							$qtdeGestao++;
						} elseif ($rs[0]['psaRegular_idPsa'] == 9) {
							$totalQualidade += $valorAtual;
							$qtdeQualidade++;
						} elseif ($rs[0]['psaRegular_idPsa'] == 10) {
							$totalResultado += $valorAtual;	
							$qtdeResultado++;
						} elseif ($rs[0]['psaRegular_idPsa'] == 11) {
							$totalCompromisso += $valorAtual;	
							$qtdeCompromisso++;
						}
					}
					
					   if((is_numeric($valorAtual) && $valorAtual <= 6) || $valorAtual=="Ruim" || $valorAtual=="Regular" || $valorAtual=="Regular" || $valorAtual=="Prefiro Não Avaliar")
                      $cor = "style=\"background-color:#aa0000;color:#fff\"";
                      else 
                      $cor ="";   
	
					  $notas[$rs[0]['psaRegular_idPsa']]['obs'] = $rs[0]['obs'];
					  $notas[$rs[0]['psaRegular_idPsa']]['valor'] = $valorAtual;
					  $notas[$rs[0]['psaRegular_idPsa']]['cor'] = $cor;
     
					   }
                    }
				}
						
				if ($campos) {
	          $html .= "<tr>";
			  foreach ($campos as $campo) {
				  if ($campo == 'grupo') {

              $html .= "<td >";
			if (!$excel)  $html .= "  <img src='/cursos/images/cad.png' title='Ver grupo' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$valor['idPlanoAcaoGrupo']."\",\"\" ,\"\" )'>";
			  
			  $html .= $valor['Grupo'] . "</td>";
				  } else if ($campo == 'aluno') {
				
				 if ($valor['nomeAluno'] != ''){
				
						$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "clientePf/cadastro.php?id=" . $idClientePf . "', '', '')\" ";
				
             				if(!$excel) { $html .= "<td ><img src=\"".CAMINHO_IMG ."\cad.png\" $onclick>" . $valor['nomeAluno'] . "</td>"; }
			 				else {
								$html .=  "<td>".$valor['nomeAluno']."</td>";
			 			}
					  } else {
						
						$onclick = " onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $valor['idProfessor'] . "', '', '')\" ";
				
             				if(!$excel) { $html .= "<td ><img src=\"".CAMINHO_IMG ."\cad.png\" $onclick>" . $valor['nomeProfessor'] . "</td>"; }
			 				else {
								$html .=  "<td>".$valor['nomeProfessor']."</td>";
			 			}	
							
						}
			  } else if ($campo == 'email') {

              $html .= "<td >" . $email . "</td>";
				  } else if ($campo == 'dataReferencia') {

              $html .= "<td >" . Uteis::exibirData($valor['dataReferencia']) . "</td>";
				  } else if ($campo == 'nomeProfessor') {

			  $html .= $html2P; //Nome Professor
				  } else if ($campo == 'PROFESSOR') {
			 
			  $html .= $html2; //Conceito Professor
				  } else if ($campo == 'GESTÃO DE CURSOS') {
					   if ($excel == false) {
	                      $marcar = ($notas[2]['obs']!='') ? "<img src=\"".CAMINHO_IMG."pendente.png\">":"";
					  } 
					  
		  			 if ($mostrarComentarios == 0) { 
							 $html .= "<td title=\"".$notas[2]['obs']."\" ".$notas[2]['cor'].">".$notas[2]['valor'].$marcar. "</td>";                  
					 } else {
					 		 $html .= "<td ".$notas[2]['cor'].">".$notas[2]['valor'].$marcar. "<br>".$notas[2]['obs']. "</td>";                  
					 }
				  } else if ($campo == 'gestaoCurso') {
					   if ($excel == false) {
	                      $marcar = ($notas[8]['obs']!='') ? "<img src=\"".CAMINHO_IMG."pendente.png\">":"";
					  } 
					  
		  			 if ($mostrarComentarios == 0) { 
							 $html .= "<td title=\"".$notas[8]['obs']."\" ".$notas[8]['cor'].">".$notas[8]['valor'].$marcar. "</td>";                  
					 } else {
					 		 $html .= "<td ".$notas[8]['cor'].">".$notas[8]['valor'].$marcar. "<br>".$notas[8]['obs']. "</td>";                  
					 }
				  } else if ($campo == 'QUALIDADE DA AULA') {
	  				   if ($excel == false) {
	                      $marcar = ($notas[4]['obs']!='') ? "<img src=\"".CAMINHO_IMG."pendente.png\">":"";
					  } 
	
					   if ($mostrarComentarios == 0) { 
							 $html .= "<td title=\"".$notas[4]['obs']."\" ".$notas[4]['cor'].">".$notas[4]['valor'].$marcar. "</td>";                  
					 } else {
					 		 $html .= "<td ".$notas[4]['cor'].">".$notas[4]['valor'].$marcar. "<br>".$notas[4]['obs']. "</td>";                  
					 }
				  } else if ($campo == 'qualidadeAula') {
	  				   if ($excel == false) {
	                      $marcar = ($notas[9]['obs']!='') ? "<img src=\"".CAMINHO_IMG."pendente.png\">":"";
					  } 
	
					   if ($mostrarComentarios == 0) { 
							 $html .= "<td title=\"".$notas[9]['obs']."\" ".$notas[9]['cor'].">".$notas[9]['valor'].$marcar. "</td>";                  
					 } else {
					 		 $html .= "<td ".$notas[9]['cor'].">".$notas[9]['valor'].$marcar. "<br>".$notas[9]['obs']. "</td>";                  
					 }
				  } else if ($campo == 'RESULTADO DO CURSO') {
	  				   if ($excel == false) {
	                      $marcar = ($notas[5]['obs']!='') ? "<img src=\"".CAMINHO_IMG."pendente.png\">":"";
					  } 
	
					   if ($mostrarComentarios == 0) { 
							 $html .= "<td title=\"".$notas[5]['obs']."\" ".$notas[5]['cor'].">".$notas[5]['valor'].$marcar. "</td>";                  
					 } else {
					 		 $html .= "<td ".$notas[5]['cor'].">".$notas[5]['valor'].$marcar. "<br>".$notas[5]['obs']. "</td>";                  
					 }
				  } else if ($campo == 'resultadoCurso') {
	  				   if ($excel == false) {
	                      $marcar = ($notas[10]['obs']!='') ? "<img src=\"".CAMINHO_IMG."pendente.png\">":"";
					  } 
	
					   if ($mostrarComentarios == 0) { 
							 $html .= "<td title=\"".$notas[10]['obs']."\" ".$notas[10]['cor'].">".$notas[10]['valor'].$marcar. "</td>";                  
					 } else {
					 		 $html .= "<td ".$notas[10]['cor'].">".$notas[10]['valor'].$marcar. "<br>".$notas[10]['obs']. "</td>";                  
					 }
				  } else if ($campo == 'compromisso') {
	  				   if ($excel == false) {
	                      $marcar = ($notas[11]['obs']!='') ? "<img src=\"".CAMINHO_IMG."pendente.png\">":"";
					  } 
	
					   if ($mostrarComentarios == 0) { 
							 $html .= "<td title=\"".$notas[11]['obs']."\" ".$notas[11]['cor'].">".$notas[11]['valor'].$marcar. "</td>";                  
					 } else {
					 		 $html .= "<td ".$notas[11]['cor'].">".$notas[11]['valor'].$marcar. "<br>".$notas[11]['obs']. "</td>";                  
					 }
				  } else if (($campo == 'NPS - Net Promoter Score') || ($campo == 'nps')) {
	  				   if ($excel == false) {
	                      $marcar = ($notas[7]['obs']!='') ? "<img src=\"".CAMINHO_IMG."pendente.png\">":"";
					  } 
	
					   if ($mostrarComentarios == 0) { 
							 $html .= "<td title=\"".$notas[7]['obs']."\" ".$notas[7]['cor'].">".$notas[7]['valor'].$marcar. "</td>";                  
					 } else {
					 		 $html .= "<td ".$notas[7]['cor'].">".$notas[7]['valor'].$marcar. "<br>".$notas[7]['obs']. "</td>";                  
					 }
				  } 
			  	}
        	  $html .= "</tr>";
			  
			  unset($notas);
				}
				$html2 = "";
				$html2P = '';
    	  }
    }

	   $media = round($totalNotas / $totalProfessor,2);
	   if(!$excel) {
	$retorno['professor'] =  "Soma notas Professor:". $totalNotas." Quantidade: ".$totalProfessor. " <strong>Média: ".$media."</strong>";
	if ($totalGestao > 0) {
		$mediaGestao = round($totalGestao / $qtdeGestao,2);
	$retorno['gestao'] = "<br>Soma notas Gestão:". $totalGestao." Quantidade: ".$qtdeGestao. " <strong>Média: ".$mediaGestao."</strong>";	
		
	}
	if ($totalQualidade > 0) {
		$mediaQualidade = round($totalQualidade / $qtdeQualidade, 2);
	$retorno['qualidade'] = "<br>Soma notas Qualidade:". $totalQualidade." Quantidade: ".$qtdeQualidade. " <strong>Média: ".$mediaQualidade."</strong>";	
		
	}
	if ($totalResultado > 0) {
		$mediaResultado = round($totalResultado / $qtdeResultado, 2);
	$retorno['resultado'] = "<br>Soma notas Resultado:". $totalResultado." Quantidade: ".$qtdeResultado. " <strong>Média: ".$mediaResultado."</strong>";	
		
	}
		
	if ($totalCompromisso > 0) {
		$mediaCompromisso = round($totalCompromisso / $qtdeCompromisso, 2);
	$retorno['compromisso'] = "<br>Soma notas Compromisso:". $totalCompromisso." Quantidade: ".$qtdeCompromisso. " <strong>Média: ".$mediaCompromisso."</strong>";	
		
	}
		
	if ($totalNPS > 0) {
		$mediaNPS = round($totalNPS / $qtdeNPS, 2);
	$retorno['nps'] = "<br>Soma notas NPS:". $totalNPS." Quantidade: ".$qtdeNPS. " <strong>Média: ".$mediaNPS."</strong>";	
		
	}
	   }
	
	if ($soRetorno == 0) {
   $html_base = $this -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);
   return $html_base . $html;
	} else {
		return $retorno;
	}
 

  }
//error_reporting(E_ALL);
function relatorioPsaConsolidado($gerente = "", $where = "", $idProfessor, $tipo, $idNotasTipoNota) {
	
	$Gerente = new Gerente();
	
    $where = " AND PIG.finalizado = 1 " .$where;

    $sql_id = "SELECT PIG.idPsaIntegranteGrupo FROM psaIntegranteGrupo AS PIG WHERE " . $where;

    $sql_corpo = " FROM psaIntegranteGrupo AS PIG  
    LEFT JOIN integranteGrupo AS IG ON IG.idIntegranteGrupo = PIG.integranteGrupo_idIntegranteGrupo
    INNER JOIN planoAcaoGrupo AS PAG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
    INNER JOIN grupo AS G ON PAG.grupo_idGrupo = G.idGrupo
    INNER JOIN grupoClientePj AS GCNPJ ON GCNPJ.grupo_idGrupo = G.idGrupo
    INNER JOIN gerenteTem AS GER ON GER.clientePj_idClientePj = GCNPJ.clientePj_idClientePj  AND GER.dataExclusao IS NULL
    INNER JOIN clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf ";
	
	if ($idProfessor > 0) {
		$sql_corpo .= " INNER JOIN respostaPsaProfessor AS RPP on RPP.psaIntegranteGrupo_idPsaIntegranteGrupo = PIG.idPsaIntegranteGrupo";
		$where .= " AND RPP.professor_idProfessor = ".$idProfessor;
	}
	
 $sql = "SELECT PIG.idPsaIntegranteGrupo, G.nome AS Grupo, CPF.nome AS nomeAluno, PIG.dataReferencia, CPF.idClientePf, GER.gerente_idGerente " . $sql_corpo . $where.$gerente;

     $result = $this -> query($sql);

     $psaProfessor = new PsaProfessor();
	 
    $ConceitosPsa = $psaProfessor->conceitosPsaProfessor($tipo);
    foreach($ConceitosPsa as $k => $v){
        $retorno[$v['titulo']][$v['nome']]= 0;
    }
    
    $psaRegular = new PsaRegular(); 
    $ConceitosPsa = $psaRegular->conceitosPsaRegular($tipo);    
    foreach($ConceitosPsa as $k => $v){
        $retorno[$v['titulo']][$v['nome']]= 0;
    }
   
    $rpsa_prof = new RespostaPsaProfessor();
    
    $rpsa_regular = new RespostaPsaRegular();
    
	while($valor = mysqli_fetch_array($result)){
		
    $integrante = $valor['idPsaIntegranteGrupo'];
    $periodo = $valor['dataReferencia'];    
	$nome = $Gerente->getNomeGerente($valor['gerente_idGerente']);
    $rsp =  $rpsa_prof->selectPsaProfessorNota($integrante, $periodo); 
 
    for($i=0;$i<count($rsp);$i++){
      if($retorno[$rsp[$i]['titulo']]['total']==""){
       $retorno[$rsp[$i]['titulo']]['total'] = 0; 
      }         
	
    if($retorno[$rsp[$i]['titulo']][$rsp[$i]['nome']]>=0){   
        $retorno[$rsp[$i]['titulo']][$nome][$rsp[$i]['nome']] += 1;
		$retorno[$rsp[$i]['titulo']][$nome]['total'] +=1;
	    $retorno[$rsp[$i]['titulo']][$rsp[$i]['nome']]+=1;
        $retorno[$rsp[$i]['titulo']]['total'] +=1;
        
	  }
     }
     $rsr = $rpsa_regular->selectPsaRegularNota($integrante, $periodo);
     for($i=0;$i<count($rsr);$i++){
        if($retorno[$rsr[$i]['titulo']]['total']==""){      
        $retorno[$rsr[$i]['titulo']]['total'] = 0; 
      }  
	  
      if($retorno[$rsr[$i]['titulo']][$rsr[$i]['nome']]>=0){  
	        $retorno[$rsr[$i]['titulo']][$nome][$rsr[$i]['nome']] += 1;
			$retorno[$rsr[$i]['titulo']][$nome]['total'] +=1; 
            $retorno[$rsr[$i]['titulo']][$rsr[$i]['nome']]+=1;
            $retorno[$rsr[$i]['titulo']]['total'] +=1;
        
	   }
	
     }

    } 
    return $retorno;
   }
   
  function relatorioPagConsolidado($where = "", $excel = false, $idProfessor, $mes, $ano, $mesF, $anoF, $idTipoBaixaPagamento ) {
	  
	  if ($mes == $mesF) {  $naoUsarB = 1;  }
		  
	  $sql = "SELECT SQL_CACHE D.idDemonstrativoPagamento, PR.nome AS nomeProf, D.professor_idProfessor, D.mes, D.ano,	D.tipoPagamento_idTipoPagamento, D.total, D.tipoDemo
		FROM
     demonstrativoPagamento AS D 
        INNER JOIN
     professor AS PR ON PR.idProfessor = D.professor_idProfessor";
	
	if ($naoUsarB == 1) {
		$sql .= " WHERE D.mes = $mes AND D.ano = $ano";
	} else {
		$sql .=	" WHERE (D.mes BETWEEN $mes AND $mesF) AND (D.ano BETWEEN $ano AND $anoF)";
	}
	
	if ($idProfessor > 1) {
		$sql .= " AND PR.idProfessor in ( ".$idProfessor. ")";	
	}
	
		$sql2 = $sql." GROUP BY D.mes";
	
		$sql .=" GROUP BY D.professor_idProfessor";

    $result = $this -> query($sql2);
	$result2 = $this -> query($sql);

	$colunas = array();
	$colunas[] = "Professor";
	$meses = array();
 
  	if (mysqli_num_rows($result) > 0) {
    	$html .= "<tbody>";
      		while ($valor = mysqli_fetch_array($result)) {
				$colunas[] = Uteis::retornaNomeMes($valor['mes']);
				$meses[] = $valor['mes'];
	       }
	}
	
	$colunas[] = "Total";
	
    	while ($valor = mysqli_fetch_array($result2)) {
			$html .= "<tr><td>".$valor['nomeProf']."</td>";
	
				for ($x=0;$x<count($meses);$x++) {
					$sql3 = "SELECT SQL_CACHE D.idDemonstrativoPagamento, D.professor_idProfessor, D.mes, D.ano, D.tipoPagamento_idTipoPagamento, D.total, D.tipoDemo
							 FROM
     							demonstrativoPagamento AS D
							 WHERE
								D.mes = ".$meses[$x]." AND D.ano = ".$anoF." AND D.professor_idProfessor = ".$valor['professor_idProfessor']." ORDER BY D.idDemonstrativoPagamento DESC";
	
	$result3 = $this -> executeQuery($sql3);
		$html .= "<td>".Uteis::formatarMoeda($result3[0]['total'])."</td>";
		$Vtotal += $result3[0]['total'];
	}
	
		$html .= "<td>".Uteis::formatarMoeda($Vtotal)."</td>";
		$Vtotal = 0;
		$html .= "</tr>";	 
    }

	$html_base = $this -> montaTb($colunas, $excel);
    return $html_base . $html;
  }
  
function relatorioPagamento($where = "", $excel = false, $impostos, $idProfessor, $mes, $ano, $idTipoBaixaPagamento, $tipo, $mesF, $anoF, $credDeb) {
	  
	  $DemonstrativoPagamento = new DemonstrativoPagamento();
	  $TipoBaixaPagamento = new TipoBaixaPagamento();
	  $ProfessorTipoImposto = new ProfessorTipoImposto();
	  $CreditoDebitoGrupo = new CreditoDebitoGrupo();
	  $DemonstrativoPagamentoOutrosServicos = new DemonstrativoPagamentoOutrosServicos();
	  $OutrosServicos = new OutrosServicos();
	  $DemonstrativoPagamentoImposto = new DemonstrativoPagamentoImposto();
	  $DemonstrativoPagamentoCredDeb = new DemonstrativoPagamentoCredDeb();
	  $DadosBancarios = new DadosBancarios();

	$sql = "SELECT SQL_CACHE D.idDemonstrativoPagamento, PR.nome AS nomeProf, PR.id_migracao, PR.idProfessor, PR.documentoUnico,  D.professor_idProfessor, D.mes,	D.ano, D.tipoPagamento_idTipoPagamento	
		FROM
     demonstrativoPagamento AS D 
        INNER JOIN
    professor AS PR ON PR.idProfessor = D.professor_idProfessor
	 " . $where. "";
  $sql .=" GROUP BY PR.nome";
 // echo $sql;

    $result = $this -> query($sql);
	$valotDocTotal = 0;	
   if (mysqli_num_rows($result) > 0) {
      $html .= "<tbody>";
      while ($valor = mysqli_fetch_array($result)) {
		  
		  $rs = $DadosBancarios->selectDadosBancarios(" WHERE professor_idProfessor = ".$valor['idProfessor']);
		  
		  $dadosB = $rs[0]['banco']." - Ag.:".$rs[0]['agencia']." - Cc.:".$rs[0]['numero']." - ".$rs[0]['tipo']. " - Fav.:".$rs[0]['favorecido'];
		 // Uteis::pr($rs);
		  
		  $idFinanceiro = $valor['id_migracao'];
		  
		  if ($idFinanceiro > 0) {
			  $TextoFinanceiro = "(IDFinanceiro: ".$valor['id_migracao'].")";
		  } else {
		  	  $TextoFinanceiro = " <font color=\"#FF0000\"> Sem ID financeiro </font>";
		  }
        $html .= "<tr>";
	if (!$excel) {
		$onclick = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"Ver cadastro\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "professor/contratado/cadastro.php?id=" . $valor['idProfessor'] . "', '', '')\" />";
		
		$onclick2 = "onclick=\"abrirNivelPagina(this, '" . CAMINHO_MODULO . "pagamento/demonstrativo/include/form/demonstrativo.php?idProfessor=" . $valor['idProfessor'] . "&mes=".$valor['mes']."&ano=".$valor['ano']."', '', '')\"";
	}
		if ($tipo != 1) {
		$rsDemonstrativo = $DemonstrativoPagamento -> selectDemonstrativoPagamento (" where professor_idProfessor = ".$valor['professor_idProfessor']." and mes = ".$valor['mes']." and ano = ".$valor['ano']." And tipoDemo = 2");	} else {
		$rsDemonstrativo = $DemonstrativoPagamento -> selectDemonstrativoPagamento (" where professor_idProfessor = ".$valor['professor_idProfessor']." and mes = ".$valor['mes']." and ano = ".$valor['ano']." And tipoDemo = 1");
		
		}

		$rsDemonstrativo2 = $DemonstrativoPagamento -> selectDemonstrativoPagamento (" where professor_idProfessor = ".$valor['professor_idProfessor']." and mes = ".$valor['mes']." and ano = ".$valor['ano']);
		$x=0;
foreach ($rsDemonstrativo2 as $valorDemonstrativo) {
	
	$idDemonstrativosP[] = $valorDemonstrativo['idDemonstrativoPagamento'];
	$x++;
	
}
if ($x > 1) {
$style=" style=\"text-decoration:underline;\"";
} else {
$style="";	
}
	$html .= "<td  $style> $onclick" . $valor['nomeProf'] ." ". $TextoFinanceiro."<br>".$valor['documentoUnico']." </td>";
	$html .= "<td >".$dadosB."</td>";
			
		$html2 = "";
		$html3 = "";

$ids = implode(",",$idDemonstrativosP);

		unset($idDemonstrativosP);

	$html2 .= $TipoBaixaPagamento -> getNome($valor['tipoPagamento_idTipoPagamento']);
	
	$html3 .= Uteis::exibirData($valorDemonstrativo['dataBaixa']);
	$html3 .= " ";
	
	$idDemonstrativosPagamentos[] = $valorDemonstrativo['idDemonstrativoPagamento'];

        $html .= "<td $onclick2>" .$html2."</td>";
        $html .= "<td $onclick2>" .$html3 ."</td>";
		
//AULAS

	if (($mes != $mesF) || ($ano != $anoF)) {
		$mesesAula = array();
					for ($x = $mes;$x<=$mesF;$x++) {
		
$rsDemonstrativoPagamento = $DemonstrativoPagamento -> selectDemonstrativoPagamentoTr_aulasTotal($valor['professor_idProfessor'], $x, $ano);
$valorTotalAulas = 0;
foreach ($rsDemonstrativoPagamento as $valorDemonstrativoPagamento) {
	$valorTotalAulas += $valorDemonstrativoPagamento['total'];
}	
$mesesAula[$x] = $valorTotalAulas;
$mesesAula['total'] += $valorTotalAulas;
//$totalGeralBruto += $valorTotalAulas;
					}
	} else {
		$rsDemonstrativoPagamento = $DemonstrativoPagamento -> selectDemonstrativoPagamentoTr_aulasTotal($valor['professor_idProfessor'], $mes, $ano);
$valorTotalAulas = 0;
foreach ($rsDemonstrativoPagamento as $valorDemonstrativoPagamento) {
	$valorTotalAulas += $valorDemonstrativoPagamento['total'];
}
	}

//Consultoria
if ($impostos != 1) {
$rsDemonstrativoConsultoria = $DemonstrativoPagamento -> selectDemonstrativoPagamento(" WHERE mes = $mes AND ano = $ano AND professor_idProfessor = ".$valor['professor_idProfessor']." AND tipoDemo = 2");

} else {
$rsDemonstrativoConsultoria = $OutrosServicos -> selectOutrosServicos(" WHERE mes = $mes AND ano = $ano AND professor_idProfessor = ".$valor['professor_idProfessor']." AND (tipo = 1 or tipo = 2 or tipo = 3 or tipo = 4 or tipo = 5 or tipo = 6)");	
$rsConsultoriaDebito = $OutrosServicos -> selectOutrosServicos(" WHERE mes = $mes AND ano = $ano AND professor_idProfessor = ".$valor['professor_idProfessor']." AND tipo = 7");
}

$valorTotalConsultoria = 0;
$debitoConsultoria = 0;
$textoC = "";
foreach ($rsConsultoriaDebito as $valorD) {
	
	$debitoConsultoria += $valorD['valor'];
	}
foreach ($rsDemonstrativoConsultoria as $valorDemonstrativoConsultoria) {
$rsConsultoria += $DemonstrativoPagamentoOutrosServicos->getTotal($valorDemonstrativoConsultoria['idDemonstrativoPagamento']);
	$valorTotalConsultoria += $valorDemonstrativoConsultoria['total'];
	$valorTotalConsultoria += $valorDemonstrativoConsultoria['valor'];
	
	if ($tipo != 1) {

	if ($valorDemonstrativoConsultoria['tipo'] == 1) {
		$texto = "Consultoria ";
	
	} elseif ($valorDemonstrativoConsultoria['tipo'] == 2) {
		$texto = "Tradução ";
	}
	$textoC .= $texto.": ".$valorTotalConsultoria . " ";

	}
	
}
		
//IMPOSTO
$valorTotalImposto = 0;
$where = " WHERE P.professor_idProfessor= " . $valor['professor_idProfessor'];
$rsProfessorTipoImposto = $ProfessorTipoImposto -> selectProfessorTipoImpostoTr_demonstrativo($where, $valorTotalAulas);
if( $rsProfessorTipoImposto ){
	foreach ($rsProfessorTipoImposto as $valorProfessorTipoImposto){
		$valorTotalImposto += $valorProfessorTipoImposto['total'];
	}
}	

//CREDITO
$valorTotalCredito = 0;
$obsCredito = " ";
$where = " WHERE mes = '" . $mes . "' AND ano= '" . $ano . "' AND excluido = 0 AND professor_idProfessor = " . $valor['professor_idProfessor'] . " AND tipo = 1 ";
$rsCredito = $CreditoDebitoGrupo -> selectCreditoDebitoGrupoTr_total($where);
if( $rsCredito ){
	foreach ($rsCredito as $valorCredito) {
		$valorTotalCredito += $valorCredito['valor'];
		$obsCredito .= "C R$".$valorCredito['valor']."-".$valorCredito['obs']."\n";
	}
}

//DEBITOS
$valorTotalDebito = 0;
$obsDebito = " ";
$where = " WHERE mes = '" . $mes . "' AND ano= '" . $ano . "' AND excluido = 0 AND professor_idProfessor = " . $valor['professor_idProfessor'] . " AND tipo = 2 ";
$rsDebito = $CreditoDebitoGrupo -> selectCreditoDebitoGrupoTr_total($where);
if( $rsDebito ){
	
	foreach ($rsDebito as $valorDebito) {
		$valorTotalDebito += $valorDebito['valor'];
		$obsDebito .= "D R$".$valorDebito['valor']."-".$valorDebito['obs']."\n";
	}
}	

//Taxa de DOC
$where = " WHERE demonstrativoPagamento_idDemonstrativoPagamento in (".$ids.") AND tipo = 2 AND obs = 'Tarifa22 Doc'";
$rs = $DemonstrativoPagamentoCredDeb->selectDemonstrativoPagamentoCredDeb($where);
$valorDoc = $rs[0]['valor'];
$valotDocTotal += $valorDoc;

//Carrega Totais
$totalCreditoDebito = 0;
if ($credDeb == 0) {
	$valorLiquido = $valorTotalAulas + $valorTotalCredito - $valorTotalDebito - $valorTotalImposto;
} else {
	$valorLiquido = $valorTotalAulas;
}
$totalGeralC += $valorTotalConsultoria;

if ($tipo == 1) {
$totalCreditoDebito += ($valorTotalCredito - $valorTotalDebito);

} else {
	
$totalCreditoDebito += ($valorTotalCredito - $valorTotalDebito) + ($creditoConsultoria - $debitoConsultoria);

}

$totalGeralCD += $totalCreditoDebito;

		if ($impostos == 1) {
			
		$html .= "<td >" . Uteis::formatarMoeda($valorTotalAulas) . "</td>";
		$totalGeralB = $valorTotalAulas;
		
		} else {
			
			if (empty($mesesAula)) {
		
		$html .= "<td >" . Uteis::formatarMoeda($valorLiquido) . "</td>";
			} else {
				foreach($mesesAula as $key=>$valor2) {
					if ($key != 'total')
					$html .= "<td>".Uteis::formatarMoeda($valor2) . "</td>";	
				}
				$html .= "<td>".Uteis::formatarMoeda($mesesAula['total'])."</td>";
				$totalGeralBruto += $mesesAula['total'];
		
				
			}
		$totalGeralB = $valorLiquido;
		}
		
		if ($tipo != 1) {
		
		$html .= "<td >" . Uteis::formatarMoeda($valorTotalConsultoria) . "</td>";
		
		}
		
		$totalGeralAulas += $totalGeralB;
     
	   if ($impostos == 1) {
		   $impostoT = 0;
		   $imposto1 = 0;
		   $imposto2 = 0;
		   $imposto3 = 0;
		   		
		$whereI = " where demonstrativoPagamento_idDemonstrativoPagamento in (".$ids. ") And tipoImpostoProfessor_idTipoImpostoProfessor = ";
		
	
		$impostoTmp = $DemonstrativoPagamentoImposto->selectDemonstrativoPagamentoImposto($whereI."1 order by demonstrativoPagamento_idDemonstrativoPagamento Desc"); 	

		foreach ($impostoTmp as $valorI) {

		$imposto1 += $valorI['valor'];
		
		$totalImposto1 += $imposto1;
		
		}
		
		$impostoTmp = $DemonstrativoPagamentoImposto->selectDemonstrativoPagamentoImposto($whereI."2 order by demonstrativoPagamento_idDemonstrativoPagamento Desc"); 	
		
		foreach ($impostoTmp as $valorI) {
		$imposto2 += $valorI['valor'];
		
		$totalImposto2 += $imposto2;
		}
		
		$impostoTmp = $DemonstrativoPagamentoImposto->selectDemonstrativoPagamentoImposto($whereI."3 order by demonstrativoPagamento_idDemonstrativoPagamento Desc"); 	
		
		foreach ($impostoTmp as $valorI) {
		$imposto3 += $valorI['valor'];
		
		$totalImposto3 += $imposto3;
		}
		
		$impostoT += $imposto1 + $imposto2 + $imposto3;
		$html .= "<td >" . Uteis::formatarMoeda($imposto1) . "</td>";
		$html .= "<td >" . Uteis::formatarMoeda($imposto2) . "</td>";
		$html .= "<td >" . Uteis::formatarMoeda($imposto3). "</td>";
		$html .= "<td >" . Uteis::formatarMoeda($impostoT) . "</td>";
				
		$html .= "<td title=\"".$obsCredito.$obsDebito."\">".Uteis::formatarMoeda($totalCreditoDebito)."</td>";
		$html .= "<th>". Uteis::formatarMoeda($valorDoc)." </th>";
		if ($tipo != 1) {
		
		$html .= "<td>".Uteis::formatarMoeda(($totalGeralB+$valorTotalConsultoria)-$impostoT+($totalCreditoDebito)-$valorDoc)." </td>";
		} else {
			$html .= "<td>".Uteis::formatarMoeda($valorLiquido)."</td>";
		}
		}
		
        $html .= "</tr>";
      }
      $html .= "</tbody>";
	  $html .= " <tfoot>
      <tr>
        <th>Totais</th>
        <th></th>
        <th></th>
		<th></th>";
		if (($mes != $mesF) || ($ano != $anoF)) {
			$html .= "<th>R$ ".Uteis::formatarMoeda($totalGeralBruto)."</th>";	
		} else {
		
        $html .= "<th>R$ ".Uteis::formatarMoeda($totalGeralAulas)."</th>";
		}
		
		if ($tipo != 1) {
		
	$html .="	<th>R$ ".Uteis::formatarMoeda($totalGeralC)."</th>";
		}	
		
		if ($impostos == 1) {
		
      $html .= "  <th>R$ ".Uteis::formatarMoeda($totalImposto1)."</th>
		<th>R$ ".Uteis::formatarMoeda($totalImposto2)."</th>
        <th>R$ ".Uteis::formatarMoeda($totalImposto3)."</th>
        <th>R$ ".Uteis::formatarMoeda($totalImposto1 + $totalImposto2 + $totalImposto3)."</th>
        <th>R$ ".Uteis::formatarMoeda($totalGeralCD)."</th>";
		
		$html .= "<th>".Uteis::formatarMoeda($valotDocTotal)."</th>";
		if ($tipo != 1) {

        $html .= "<th>R$ ".Uteis::formatarMoeda(($totalGeralAulas+$totalGeralC-($totalImposto1+$totalImposto2+$totalImposto3)+($totalGeralCD)-$valotDocTotal))."</th>";
		} else {

		 $html .= "<th>R$ ".Uteis::formatarMoeda(($totalGeralAulas-($totalImposto1+$totalImposto2+$totalImposto3)+($totalGeralCD)-$valotDocTotal))."</th>";
		}
		} 
		
		
    $html .="  </tr>
    </tfoot>";
	
    }
	
	if ($impostos == 1) {
		
		if ($tipo != 1) {
	
    $colunas = array("Professor", "Dados Bancarios", "Forma de pagamento", "Data da baixa", "Total Bruto Aulas", "Total Outros Serviços", "INSS", "IR", "ISS", " - Total Impostos"," + Débitos/Créditos","- Taxa Doc", " = Total pago");
	
		} else {
	
	$colunas = array("Professor", "Dados Bancarios", "Forma de pagamento", "Data da baixa", "Total Bruto Aulas", "INSS", "IR", "ISS", " - Total Impostos"," + Débitos/Créditos","- Taxa Doc", " = Total pago");
		}
	
	} else {
		if ($tipo != 1) {
			
		$colunas = array("Professor",  "Dados Bancarios", "Forma de pagamento", "Data da baixa", "Total Liquido", "Outros Serviços");
		
		} else {
			$meses = array();
				if (($mes != $mesF) || ($ano != $anoF)) {
					for ($x = $mes;$x<=$mesF;$x++) {
				 $meses[] = "Total Aulas<br>".$x."/".$ano;	
					}
				$meses[] = "Total";	
					$colunasT = array("Professor", "Dados Bancarios", "Forma de pagamento", "Data da baixa");
					$colunas = array_merge($colunasT, $meses);
					
				} else {
			
					$colunas = array("Professor", "Dados Bancarios", "Forma de pagamento", "Data da baixa", "Total Liquido<br>".$mes."/".$ano."");
				}
		}
			
	}
		
    $html_base = $this -> montaTb($colunas, $excel);
    return $html_base . $html;

  }
    
    function relatorioPagamentoTxt($where = "", $excel = false, $impostos, $idProfessor, $mes, $ano, $idTipoBaixaPagamento, $tipo) {
	  
	  $DemonstrativoPagamento = new DemonstrativoPagamento();
	  $TipoBaixaPagamento = new TipoBaixaPagamento();
	  $ProfessorTipoImposto = new ProfessorTipoImposto();
	  $CreditoDebitoGrupo = new CreditoDebitoGrupo();
	  $DemonstrativoPagamentoOutrosServicos = new DemonstrativoPagamentoOutrosServicos();
	  $OutrosServicos = new OutrosServicos();
	  
	  $DemonstrativoPagamentoImposto = new DemonstrativoPagamentoImposto();
	  $DemonstrativoPagamentoCredDeb = new DemonstrativoPagamentoCredDeb();

	$sql = "SELECT SQL_CACHE D.idDemonstrativoPagamento, PR.nome AS nomeProf, PR.id_migracao, D.professor_idProfessor, D.mes, D.ano, D.tipoPagamento_idTipoPagamento	
		FROM
     demonstrativoPagamento AS D 
         INNER JOIN
    professor AS PR ON PR.idProfessor = D.professor_idProfessor
	 " . $where. "";
  $sql .=" GROUP BY PR.nome";
	
    $result = $this -> query($sql);
	
   if (mysqli_num_rows($result) > 0) {
      while ($valor = mysqli_fetch_array($result)) {  
  		if ($valor['id_migracao'] != '') {
			
        $html .= $valor['id_migracao'];

		
//AULAS
$rsDemonstrativoPagamento = $DemonstrativoPagamento -> selectDemonstrativoPagamentoTr_aulasTotal($valor['professor_idProfessor'], $mes, $ano);
$valorTotalAulas = 0;
foreach ($rsDemonstrativoPagamento as $valorDemonstrativoPagamento) {
	$valorTotalAulas += $valorDemonstrativoPagamento['total'];
}

$rsDemonstrativoConsultoria = $OutrosServicos -> selectOutrosServicos(" WHERE mes = $mes AND ano = $ano AND professor_idProfessor = ".$valor['professor_idProfessor']." AND (tipo = 1 or tipo = 2)");	

$valorTotalConsultoria = 0;

foreach ($rsDemonstrativoConsultoria as $valorD) {	
	$valorTotalConsultoria += $valorD['valor'];
	}

$totalGeralT = $valorTotalAulas + $valorTotalConsultoria;
$totalGeral = number_format($totalGeralT,'2', "", ""); 

$totalGeralo = str_pad($totalGeral, 12, "0", STR_PAD_LEFT);

$html .= $totalGeralo."00000000000000";

$html .= "<br>
		 ";

//Carrega totais
$totalCreditoDebito = 0;
$valorTotalAulas += $valorTotalConsultoria;
	  }

	}
	
	}
   return $html;

  }
  
 function relatorioPagAulas($where, $mes, $ano, $mes1, $ano1, $idProfessor, $excel = false, $numero, $compara = 0) {
	 
	$DemonstrativoPagamento = new DemonstrativoPagamento();
	$Professor = new Professor();
	$FolhaFrequencia = new FolhaFrequencia();
	$PlanoAcaoGrupo = new PlanoAcaoGrupo();
	$DiaAulaFF = new DiaAulaFF();
	$Professor = new Professor();
	$PlanoAcao = new PlanoAcao();
	$ValorHoraGrupo = new ValorHoraGrupo();
	$PlanoAcaoGrupoStatusCobranca = new PlanoAcaoGrupoStatusCobranca();
	$StatusCobranca = new StatusCobranca(); 
	
	$sql = "SELECT  D.idDemonstrativoCobranca, concat_ws('/', D.mes, D.ano ) AS Periodo, G.idGrupo, G.nome AS grupo, D.planoAcaoGrupo_idPlanoAcaoGrupo, D.valCurso, D2.professor_idProfessor, PR.nome, VCHR.valor AS valorHora, PA.idPlanoAcao, gerente_idGerente,VCHR.valorDesconto, VCHR.validadeDesconto,
	(select sum(Di.horas) from demonstrativoCobrancaDias as Di where Di.demonstrativoCobranca_idDemonstrativoCobranca = D.idDemonstrativoCobranca) as Totalhoras
FROM
    demonstrativoCobranca AS D
        LEFT JOIN
    demonstrativoCobrancaProfessor AS D2 ON D2.demonstrativoCobranca_idDemonstrativoCobranca = D.idDemonstrativoCobranca
        LEFT JOIN
	demonstrativoCobrancaValorHora AS VCHR ON VCHR.demonstrativoCobranca_idDemonstrativoCobranca = D.idDemonstrativoCobranca
        LEFT JOIN
    professor AS PR ON PR.idProfessor = D2.professor_idProfessor
        INNER JOIN
	planoAcaoGrupo AS PAG on PAG.idPlanoAcaoGrupo = D.planoAcaoGrupo_idPlanoAcaoGrupo
		INNER JOIN
	grupo as G on G.idGrupo = PAG.grupo_idGrupo
		INNER JOIN
	planoAcao as PA on PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao
		INNER JOIN
	grupoClientePj AS GCP on GCP.grupo_idGrupo = G.idGrupo
		LEFT JOIN
	gerenteTem AS GT ON GT.clientePj_idClientePj = GCP.clientePj_idClientePj
";

$sql .= $where;

$sql .= " AND (D.mes = $mes AND D.ano = $ano) group by D.idDemonstrativoCobranca";

//		echo $sql;
		
		$result = $this -> query($sql);
		if ($mes <10) {
			$mes = "0".$mes;
		}
		
		if ($mes1 <10) {
			$mes1 = "0".$mes1;
		}
		
	 $dataReferencia = date("Y-m-d", strtotime($ano."-".$mes."-01"));
	 $dataReferenciaInicial = $dataReferencia;
	 $dataReferenciaFinal = date($ano."-".$mes."-"."t");
	
	 $dataReferencia2 = date("Y-m-d", strtotime($ano1."-".$mes1."-01"));
	 $dataReferenciaInicial2 = $dataReferencia2;
	 $dataReferenciaFinal2 = date($ano1."-".$mes1."-"."t");
	
	$html = "<tbody>";
	
	 $x = 0;
	 $totalMargem = "";
	 
	 $periodo2 = "<br>".$mes1."/".$ano1;

 while ($valorDemonstrativoPagamento = mysqli_fetch_array($result)) {
	
	$nome = $Professor->getNome($idProfessor);
	$idPlanoAcaoGrupo = $valorDemonstrativoPagamento['planoAcaoGrupo_idPlanoAcaoGrupo'];
	$valorDesconto = $valorDemonstrativoPagamento['valorDesconto'];
	$validadeDesconto = $valorDemonstrativoPagamento['validadeDesconto'];
	$periodo = "<br>".$valorDemonstrativoPagamento['Periodo'];
	
	$Ididioma = $PlanoAcao -> getIdIdioma($valorDemonstrativoPagamento['idPlanoAcao'], false);
	$idGrupo = $valorDemonstrativoPagamento['idGrupo'];
	
	$valorPeriodo2 = $this->relatorioPagAulas2($where, $mes1, $ano1, $idGrupo);
	$valorHora = $valorPeriodo2[0]['valorHora'];
	
	$valorFinanceiro = $PlanoAcaoGrupoStatusCobranca->selectPlanoAcaoGrupoStatusCobranca(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." ORDER BY idPlanoAcaoGrupoStatusCobranca DESC"); 
	$idCobranca = $valorFinanceiro[0]['statusCobranca_idStatusCobranca'];
	$mesStatus = $valorFinanceiro[0]['mes'];
	$anoStatus = $valorFinanceiro[0]['ano'];
		  
		  $ValorCobranca = $StatusCobranca->selectStatusCobranca(" WHERE idStatusCobranca = ".$idCobranca);
		  if ($idCobranca == 2) {
		  $statusC = $ValorCobranca[0]['status']. " Data do status: ".$mesStatus."/".$anoStatus;
		  } else {
			$statusC = $ValorCobranca[0]['status'];  
		  }
		  $corStatus = $ValorCobranca[0]['cor'];
		  
		 if ($excel != true) {
		  
		   $imgCobranca =  "<div class=\"legenda_box\" title=\"".$statusC."\" style=\"background-color:$corStatus\"></div>";
		 }
	
	//Status de cobrança do 2ºperiodo
	$idPlanoAcaoGrupo2 = $valorPeriodo2[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
	$valorDesconto2 = $valorPeriodo2[0]['valorDesconto'];
	$validadeDesconto2 = $valorPeriodo2[0]['validadeDesconto'];
	
	if ($valorDesconto2 != '') { 
	
		if ($validadeDesconto2 >= $dataReferenciaInicial2) {
		
			if ($validadeDesconto2 <= $dataReferenciaFinal2) {
		
	$aplicarDesconto2 = $valorPeriodo2[0]['valorHora'] - $valorDesconto2;
	$usar2 = 1;
		} else {
			$usar2 = 1;
		$aplicarDesconto2 = $valorPeriodo2[0]['valorHora'] - $valorDesconto2;	
		}
		
	} else {
		$usar2 = 0;
	$aplicarDesconto2 =	$valorPeriodo2[0]['valorHora'];
		
		}
	
	} else {
		$usar2 = 0;
		$aplicarDesconto2 = $valorPeriodo2[0]['valorHora'];
		
	}
	//1º periodo
	
		if ($valorDesconto != '') { 
	
	if ($validadeDesconto >= $dataReferenciaInicial) {
		
		if ($validadeDesconto <= $dataReferenciaFinal) {
	
	$aplicarDesconto = $valorDemonstrativoPagamento['valorHora'] - $valorDesconto;
	$usar = 1;
		} else {
			$usar = 1;
		$aplicarDesconto = 	$valorDemonstrativoPagamento['valorHora'] - $valorDesconto;	
		}
		
	} else {
		$usar = 0;
	$aplicarDesconto = 	$valorDemonstrativoPagamento['valorHora'];
		
		}
	
	} else {
		$usar = 0;
		$aplicarDesconto = 	$valorDemonstrativoPagamento['valorHora'];
	}
	
	// Professores 2º periodo
	$sql7 = " SELECT DISTINCT(AGP.professor_idProfessor) AS idProfessor, AGP.plano 
		FROM planoAcaoGrupo AS PAG
		LEFT JOIN aulaDataFixa AS AF ON AF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
		LEFT JOIN aulaPermanenteGrupo AS AP ON AP.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 
		INNER JOIN aulaGrupoProfessor AS AGP ON 
			(AGP.aulaDataFixa_idAulaDataFixa = AF.idAulaDataFixa OR AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo = AP.idAulaPermanenteGrupo) 
		WHERE PAG.idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND AGP.dataInicio <= '" . $dataReferenciaFinal2 . "' 
			AND (
				(AGP.dataFim >= '" . $dataReferencia2 . "' AND AGP.dataFim <= '" . $dataReferenciaFinal2 . "') 
				OR 
				AGP.dataFim IS NULL OR AGP.dataFim = ''
			) ";
			
	//		echo $sql6;
			
	$result7 = $this -> query($sql7);
	
	$professorNomes2 = "";
	 $valorPlano2 = "";
	 $margem2 = "";
		
	while ($valorProfessores2 = mysqli_fetch_array($result7)) {
		
		$professorNomes2 .= $Professor->getNome($valorProfessores2['idProfessor'])."</br>";
		
		if ($valorProfessores2['plano'] == '') {
		
			$valorPlanoN = $Professor->getPlanoCarreira($valorProfessores2['idProfessor'], $Ididioma);
		} else {
			$valorPlanoN = $valorProfessores['plano'];	
		}
		$margem2 .=  round((1 - ($valorPlanoN / $aplicarDesconto2)) * 100, 2) ."%<br>";
		$margemS2 =  round((1 - ($valorPlanoN / $aplicarDesconto2)) * 100, 2);
				
		$valorPlano2 .= Uteis::formatarMoeda($valorPlanoN)."</br>"; 
	}
	 
	// Professores 1º periodo
	$sql6 = " SELECT DISTINCT(AGP.professor_idProfessor) AS idProfessor, AGP.plano 
		FROM planoAcaoGrupo AS PAG
		LEFT JOIN aulaDataFixa AS AF ON AF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
		LEFT JOIN aulaPermanenteGrupo AS AP ON AP.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 
		INNER JOIN aulaGrupoProfessor AS AGP ON 
			(AGP.aulaDataFixa_idAulaDataFixa = AF.idAulaDataFixa OR AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo = AP.idAulaPermanenteGrupo) 
		WHERE PAG.idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND AGP.dataInicio <= '" . $dataReferenciaFinal . "' 
			AND (
				(AGP.dataFim >= '" . $dataReferencia . "' AND AGP.dataFim <= '" . $dataReferenciaFinal . "') 
				OR 
				AGP.dataFim IS NULL OR AGP.dataFim = ''
			) ";
			
	//		echo $sql6;
			
	$result6 = $this -> query($sql6);
	
	$professorNomes = "";
	$valorPlano = "";
	$margem = "";
		
	while ($valorProfessores = mysqli_fetch_array($result6)) {
		
		$professorNomes .= $Professor->getNome($valorProfessores['idProfessor'])."</br>";
		
		if ($valorProfessores['plano'] == '') {
		
			$valorPlanoN = $Professor->getPlanoCarreira($valorProfessores['idProfessor'], $Ididioma);
		} else {
			$valorPlanoN = $valorProfessores['plano'];	
		}
		$margem .=  round((1 - ($valorPlanoN / $aplicarDesconto)) * 100, 2) ."%<br>";
		$margemS =  round((1 - ($valorPlanoN / $aplicarDesconto)) * 100, 2);
					
		$valorPlano .= Uteis::formatarMoeda($valorPlanoN)."</br>"; 
		
	}
		if ($excel != true) {
	 $onclick = " <img src=\"".CAMINHO_IMG ."\cad.png\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_REL . "grupo/cadastro.php?id=" . $idPlanoAcaoGrupo . "', '', '')\" >";
		}
	
	$html .= "<tr>";
	 
	 $html .= "<td >".$onclick. " ".$valorDemonstrativoPagamento['grupo']."<br>".$imgCobranca."</td>";
	 $html .= "<td>".Uteis::exibirHoras($valorDemonstrativoPagamento['Totalhoras'])."</td>";
	 
	 if ($compara == 1) { 
	 $html .= "<td>".Uteis::exibirHoras($valorPeriodo2[0]['Totalhoras'])."</td>";
	 
	 }
		 
	if ($usar == 1) {
	 $html .= "<td style=\"color:red\">".Uteis::formatarMoeda($aplicarDesconto)."</td>";
	} else {
	$html .= "<td>".Uteis::formatarMoeda($aplicarDesconto)."</td>";	
	}
	
	if ($compara == 1) {
	
	if ($usar2 == 1) {
	  $html .= "<td style=\"color:red\">".Uteis::formatarMoeda($aplicarDesconto2)."</td>";
	} else {
	$html .= "<td>".Uteis::formatarMoeda($aplicarDesconto2)."</td>";	
		}
	}
	
		 $html .= "<td>".$professorNomes."</td>";
	 if ($compara == 1) {
		 $html .= "<td>".$professorNomes2."</td>";
	 }
	 
	 	$html .= "<td>".$valorPlano."</td>";
	 if ($compara == 1) {
		$html .= "<td>".$valorPlano2."</td>";	 
	 }
	 	$html .= "<td>".$margem."</td>";
	 if ($compara ==1 ) {
	 	$html .= "<td>".$margem2."</td>";
	 }
	 
	 if ($margemS > 0) {
	 
	 $totalMargem += $margemS;
	 $x++;
	 
	 }
	 
	 $valoReajuste = $ValorHoraGrupo->selectValorHoraGrupo_periodo($idPlanoAcaoGrupo, $dataReferencia);

	 $reajuste = $valoReajuste[0]['previsaoReajuste'];

	 $html .= "<td>".Uteis::exibirData($reajuste)."</td>";
	 
	  $html .= "<td>".Uteis::exibirData($validadeDesconto)."</td>";
}
	$html .= "</tr></tbody>";
	
	$media = round($totalMargem / $x,2);
	
	if ($compara != 1) { 
	 $colunas = array("Grupo", "Horas Cobradas".$periodo."", "Valor Hora Grupo".$periodo."", "Professores".$periodo."", "Hora Aula Professor".$periodo."", "Margem Bruta | Média da carteira:".$periodo." ".$media."%", "Próximo reajuste", "Validade Desconto");
	 
	} else {
	 $colunas = array("Grupo2", "Horas Cobradas".$periodo."", "Horas Cobradas".$periodo2."", "Valor Hora Grupo".$periodo."", "Valor Hora Grupo".$periodo2."", "Professores".$periodo."", "Professores".$periodo2."", "Hora Aula Professor".$periodo."", "Hora Aula Professor".$periodo2."", "Margem Bruta | Média da carteira:".$periodo." ".$media."%", "Margem Bruta | Média da carteira:".$periodo2." ".$media."%", "Próximo reajuste", "Validade Desconto");	
	}
 
    $html_base = $this -> montaTb($colunas, $excel,"", $numero);
    return $html_base . $html;
	 
 }
 
  function relatorioPagAulas2($where, $mes1, $ano1, $idGrupo) {
	  
	  $sql = "SELECT  D.idDemonstrativoCobranca, concat_ws('/', D.mes, D.ano ) AS Periodo, G.idGrupo, G.nome AS grupo, D.planoAcaoGrupo_idPlanoAcaoGrupo, D.valCurso, D2.professor_idProfessor, PR.nome, VCHR.valor AS valorHora, PA.idPlanoAcao, gerente_idGerente,VCHR.valorDesconto, VCHR.validadeDesconto,
	(select sum(Di.horas) from demonstrativoCobrancaDias as Di where Di.demonstrativoCobranca_idDemonstrativoCobranca = D.idDemonstrativoCobranca) as Totalhoras
FROM
    demonstrativoCobranca AS D
        LEFT JOIN
    demonstrativoCobrancaProfessor AS D2 ON D2.demonstrativoCobranca_idDemonstrativoCobranca = D.idDemonstrativoCobranca
        LEFT JOIN
	demonstrativoCobrancaValorHora AS VCHR ON VCHR.demonstrativoCobranca_idDemonstrativoCobranca = D.idDemonstrativoCobranca
        LEFT JOIN
    professor AS PR ON PR.idProfessor = D2.professor_idProfessor
        INNER JOIN
	planoAcaoGrupo AS PAG on PAG.idPlanoAcaoGrupo = D.planoAcaoGrupo_idPlanoAcaoGrupo
		INNER JOIN
	grupo as G on G.idGrupo = PAG.grupo_idGrupo
		INNER JOIN
	planoAcao as PA on PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao
		INNER JOIN
	grupoClientePj AS GCP on GCP.grupo_idGrupo = G.idGrupo
		LEFT JOIN
	gerenteTem AS GT ON GT.clientePj_idClientePj = GCP.clientePj_idClientePj
";
	$sql .= $where." AND G.idgrupo = ".$idGrupo;
	$sql .= " AND (D.mes = $mes1 AND D.ano = $ano1) GROUP BY D.idDemonstrativoCobranca";

	$result = Uteis::executarQuery($sql);
	return $result; 
	  
  }
 

  function relatorioClientePf($where = "", $campos, $camposNome, $excel = false, $idGrupo, $idIdioma,$comgrupo,$dataInicio, $dataFim) {
	  
	  $IntegranteGrupo = new IntegranteGrupo();
	  $Grupo = new Grupo();
	  $Idioma = new Idioma();
	  $nomeGrupo = 0;
	  $FechamentoGrupo = new FechamentoGrupo();
	  $PlanoAcaoGrupo = new PlanoAcaoGrupo();

    $where = " WHERE CPF.excluido = 0 " . $where;

    //CARREGA DADOS SIMPLES
    $sql1 = "SELECT distinct(CPF.idClientePf), CPF.nome, CPF.nomeExibicao, CPF.sexo, CPF.rf, CPF.dataNascimento, CPF.inativo, CPF.cargo, CPF.naoReceberEmail, CPF.documentoUnico, CPF.rg, /*IG.dataSaida,*/
    TC.tipo AS tipoCliente, EC.valor AS estadoCivil, TDU.valor AS tipoDoc, P.pais
	, COALESCE(CPJ.razaoSocial, 'Particular') AS empresa, /*PAG.grupo_idGrupo,*/ CPJ.idClientePj/*,  I.idIdioma*/";
	
	if ($comgrupo == 1) {
	//$sql1 .= ",PAG.grupo_idGrupo ";
	}
	
	 $sql1 .= " FROM clientePf AS CPF "; // PAG.idPlanoAcaoGrupo";
	$sql .= "    
    INNER JOIN tipoCliente AS TC ON TC.idTipoCliente = CPF.tipoCliente_idTipoCliente 
    LEFT JOIN estadoCivil AS EC ON EC.idEstadoCivil = CPF.estadoCivil_idEstadoCivil 
    LEFT JOIN tipoDocumentoUnico AS TDU ON TDU.idTipoDocumentoUnico = CPF.tipoDocumentoUnico_idTipoDocumentoUnico     
    LEFT JOIN pais AS P ON P.idPais = CPF.pais_idPais 
    LEFT JOIN clientePj AS CPJ ON CPJ.idClientePj = CPF.clientePj_idClientePj 
	LEFT JOIN gerenteTem as GT on GT.clientePj_idClientePj = CPJ.idClientePj
	LEFT JOIN integranteGrupo AS IG on IG.clientePf_idClientePf = CPF.idClientePf
    LEFT JOIN planoAcaoGrupo AS PAG on IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPLanoAcaoGrupo
	LEFT JOIN	grupo as G ON G.idGrupo = PAG.grupo_idGrupo
    LEFT JOIN planoAcao AS PA ON PA.idPlanoAcao = PAG.planoAcao_idPlanoAcao		
	INNER JOIN proposta AS P2 ON ( P2.idProposta = PA.proposta_idProposta OR P2.idProposta = PA.proposta_idProposta )
	INNER JOIN idioma AS I ON I.idIdioma = P2.idioma_idIdioma";
	$sql .= $where;
	
	if ($idGrupo > 0) {
		
	$sql .= " AND PAG.grupo_idGrupo = ".$idGrupo;
	}
if ($idIdioma[0] >0) {
	$ids = implode(",", $idIdioma);  
	$sql .= " AND I.idIdioma in(".$ids.")";
}

if ($comgrupo == 1) {
	$sql .= " AND (IG.dataEntrada between '".$dataInicio."' and '".$dataFim."') AND (IG.dataSaida is null or IG.dataSaida > '".$dataFim."')";
	} elseif ($comgrupo == 2) {
	$sql .= " AND (IG.dataEntrada is null or IG.dataEntrada >= '".$dataInicio."') AND ((IG.dataSaida IS not NULL)
        AND (IG.dataSaida between '".$dataInicio."' and '".$dataFim."'))
        ";
	} else {
	$sql .= " AND (IG.dataEntrada >= '".$dataInicio."')	 ";
	}
	$sql .= "   AND G.inativo = 0 AND PAG.inativo = 0 ORDER BY PAG.idPlanoAcaoGrupo DESC";
	$sql_id = "SELECT CPF.idClientePf FROM clientePf AS CPF " . $sql;
 //echo $sql1.$sql;

    $result = $this -> query($sql1.$sql);

    //CARREGA DADOS DE TABELAS RELACIONADAS
    $colspan = array();
	
    if (in_array("telefone", $campos)) {

      $Telefone = new Telefone();

      $sql = "SELECT MAX(total) AS total FROM (
        SELECT COUNT(idTelefone) AS total 
        FROM telefone 
        WHERE clientePf_idClientePf IN ( $sql_id )
        GROUP BY clientePf_idClientePf
      ) AS total";
  //     echo $sql;
       $rs = Uteis::executarQuery($sql);
      $colspan["telefone"] = $rs[0]['total'];
    }

    if (in_array("endereco", $campos)) {

      $Endereco = new Endereco();

      $sql = "SELECT MAX(total) AS total FROM (
        SELECT COUNT(idEndereco) AS total 
        FROM endereco  
        WHERE excluido = 0 AND clientePf_idClientePf IN ( $sql_id )
        GROUP BY clientePf_idClientePf
      ) AS total";
      $rs = Uteis::executarQuery($sql);
      $colspan["endereco"] = $rs[0]['total'];
    }

    //CARREGA DADOS DE TABELAS RELACIONADAS DE FORMA DINAMICA (de acordo com a parametrização do sistema)
    $TipoEnderecoVirtual = new TipoEnderecoVirtual();
    $rsTipoEnderecoVirtual = $TipoEnderecoVirtual -> selectTipoEnderecoVirtual(" WHERE excluido = 0 AND inativo = 0 ");

    foreach ($rsTipoEnderecoVirtual as $valorTipoEnderecoVirtual) {
      if (in_array($valorTipoEnderecoVirtual['tipo'], $campos)) {
        $sql = "SELECT MAX(total) AS total FROM (
          SELECT COUNT(idEnderecoVirtual) AS total 
          FROM enderecoVirtual  
          WHERE clientePf_idClientePf IN ( $sql_id ) AND tipoEnderecoVirtual_idTipoEnderecoVirtual = " . $valorTipoEnderecoVirtual['idTipoEnderecoVirtual'] . "
          GROUP BY clientePf_idClientePf
        ) AS total";
        //echo $sql;
         $rs = Uteis::executarQuery($sql);
        $colspan[$valorTipoEnderecoVirtual['tipo']] = $rs[0]['total'];
      }
    }

    $html = "";
	$f = 0;
	$m = 0;
    if (mysqli_num_rows($result) > 0) {

      $html .= "<tbody>";

      while ($valor = mysqli_fetch_array($result)) {

        $idClientePf = $valor['idClientePf'];
		
		$imgB = "<img src=\"" . CAMINHO_IMG . "cad.png\" title=\"IR PARA O CADASTRO\" onclick=\"abrirNivelPagina(this, '" . CAMINHO_CAD . "clientePf/cadastro.php?id=" . $idClientePf . "', '$caminhoAtualizar', '#div_integranteGrupo')\" >";
		
		//NivelInicial 
		
	$sql2 = "SELECT SQL_CACHE
    P.idIntegranteGrupo,
    P.planoAcaoGrupo_idPlanoAcaoGrupo,
    P.clientePf_idClientePf,
    P.dataEntrada,
    P.dataSaida,
    P.obs,
    P.dataSaidaDemonstrativo,
    P.dataRetorno
FROM
    integranteGrupo AS P
    WHERE P.clientePf_idClientePf = ".$idClientePf."
    ORDER BY idIntegranteGrupo ASC";
	
	$valorInicial = Uteis::executarQuery($sql2);
	$idPlanoAcaoGrupoNI = $valorInicial[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
	$nivelInicial = $PlanoAcaoGrupo->getIdNivel($idPlanoAcaoGrupoNI,true);
	
		//NivelInicial 
		
	$sql2 = "SELECT SQL_CACHE P.idIntegranteGrupo, P.planoAcaoGrupo_idPlanoAcaoGrupo, P.clientePf_idClientePf, P.dataEntrada, P.dataSaida, P.obs,   P.dataSaidaDemonstrativo, P.dataRetorno
		FROM
    integranteGrupo AS P
    	WHERE P.clientePf_idClientePf = ".$idClientePf." ORDER BY idIntegranteGrupo DESC";
	
	$valorInicial = Uteis::executarQuery($sql2);
	$idPlanoAcaoGrupoNI = $valorInicial[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
	$dataEntrada = $valorInicial[0]['dataEntrada'];
	$nivelAtual = $PlanoAcaoGrupo->getIdNivel($idPlanoAcaoGrupoNI,true);
			
		$valorIntegrante = $IntegranteGrupo->selectIntegranteGrupo("where clientePf_idClientePf = ".$idClientePf. " ORDER BY planoAcaoGrupo_idPlanoAcaoGrupo DESC");

		$sqlGrupo = "SELECT SQL_CACHE idIntegranteGrupo, planoAcaoGrupo_idPlanoAcaoGrupo, clientePf_idClientePf, PAG.grupo_idGrupo, G.nome, IG.dataSaida, I.idioma
		FROM
    integranteGrupo AS IG
    	LEFT JOIN
    planoAcaoGrupo AS PAG on PAG.idPlanoAcaoGrupo = IG.planoAcaoGrupo_idPlanoAcaoGrupo
    	LEFT JOIN
    grupo AS G on G.idGrupo = PAG.grupo_idGrupo
		LEFT JOIN
	planoAcao as PA on PAG.planoAcao_idPlanoAcao = PA.idPlanoAcao
		LEFT JOIN
    proposta AS P2 ON (P2.idProposta = PA.proposta_idProposta
        OR P2.idProposta = PA.proposta_idProposta)
        LEFT JOIN
	idioma AS I ON I.idIdioma = P2.idioma_idIdioma
		WHERE clientePf_idClientePf = ".$idClientePf." GROUP BY nome";

		$rsGrupo = Uteis::executarQuery($sqlGrupo);
		
		$htmlGrupo = "";
		$htmlIdiomas = "";
		foreach ($rsGrupo as $GrupoA) {
		$htmlGrupo .= "<div>".$GrupoA['nome']."-".Uteis::exibirData($GrupoA['dataSaida'])."</div>";
		$htmlIdiomas .= "<div>".$GrupoA['nome']."-".$GrupoA['idioma']."</div>";		
			
		}

		$motivo = $valorIntegrante[0]['obs'];
		$idPlanoAcaoGrupo = $valorIntegrante[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
		
		if (($motivo == '') && ($idPlanoAcaoGrupo >0)) {
			
			$valorFechamento = $FechamentoGrupo->selectFechamentoGrupo(" WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo);
			
			$motivo = $valorFechamento[0]['obs'];
		}
		
		$dataRetorno = $valorIntegrante[0]['dataRetorno'];	

        if ($campos) {

          $html .= "<tr>";
			
          foreach ($campos as $campo) {

            if ($campo == "nome")
              $html .= "<td >" .$imgB." ". $valor['nome'] . "</td>";
            elseif ($campo == "nomeExibicao")
              $html .= "<td >" . $valor['nomeExibicao'] . "</td>";
            elseif ($campo == "sexo") {
              $html .= "<td >" . Uteis::exibirSexo($valor['sexo']) . "</td>";
			  if ($valor['sexo'] == "F") {
				  $f++;
			  } else {
				  $m++;
			  }
			  $mostrarTotal = 1;
				
			}
			  
            elseif ($campo == "dataNascimento")
              $html .= "<td >" . Uteis::exibirData($valor['dataNascimento']) . "</td>";
            elseif ($campo == "inativo") {
              $html .= "<td >" . Uteis::exibirStatus(!$valor['inativo'], !$excel);
			  if ($valor['inativo'] == 1) {
			  $html .=    "<br>Motivo: ".$motivo."<br>Data para retornar:<br>".Uteis::exibirData($dataRetorno);
			  }
			  $html .= "</td>";
			} elseif ($campo == "dataEntrada")
			  $html .= "<td>".Uteis::exibirData($dataEntrada)."</td>";
			elseif ($campo == "nivelInicial")
			  $html .= "<td>".$nivelInicial."</td>";
			elseif ($campo == "nivelAtual")
			  $html .= "<td>".$nivelAtual."</td>";  
            elseif ($campo == "cargo")
              $html .= "<td >" . $valor['cargo'] . "</td>";
            elseif ($campo == "naoReceberEmail")
              $html .= "<td >" . Uteis::exibirStatus($valor['naoReceberEmail'], !$excel) . "</td>";
            elseif ($campo == "tipoDoc")
              $html .= "<td >" . $valor['tipoDoc'] . "</td>";
            elseif ($campo == "documentoUnico")
              $html .= "<td >" . $valor['documentoUnico'] . "</td>";
            elseif ($campo == "rg")
              $html .= "<td >" . $valor['rg'] . "</td>";
            elseif ($campo == "rf")
              $html .= "<td >" . $valor['rf'] . "</td>";
			elseif ($campo == "tipoCliente")
              $html .= "<td >" . $valor['tipoCliente'] . "</td>";
            elseif ($campo == "estadoCivil")
              $html .= "<td >" . $valor['estadoCivil'] . "</td>";
            elseif ($campo == "pais")
              $html .= "<td >" . $valor['pais'] . "</td>";
            elseif ($campo == "empresa") {
              $html .= "<td >" . $valor['empresa'] . "</td>";
			}
			elseif ($campo == "idioma") {
              $html .= "<td >".$htmlIdiomas."</td>";
			}
			
            elseif ($campo == "telefone") {

              $sql = " SELECT idTelefone AS valor FROM telefone WHERE clientePf_idClientePf = $idClientePf ";
              $rs = Uteis::executarQuery($sql);

              for ($i = 0; $i < $colspan[$campo]; $i++) {
                $valorAtual = isset($rs[$i]) ? $Telefone -> getTelefone($rs[$i]['valor']) : "";
                $html .= "<td >" . $valorAtual . "</td>";
              }

            } elseif ($campo == "endereco") {

              $sql = " SELECT idEndereco AS valor FROM endereco WHERE clientePf_idClientePf = $idClientePf ";
              $rs = Uteis::executarQuery($sql);

              for ($i = 0; $i < $colspan[$campo]; $i++) {
                $valorAtual = isset($rs[$i]) ? $Endereco -> getEnderecoCompleto($rs[$i]['valor']) : "";
                $html .= "<td >" . $valorAtual . "</td>";
              }

            } elseif ($campo == "dataSaida") {
              $html .= "<td >" . $htmlGrupo . "</td>";
			  
			} else {
              if ($rsTipoEnderecoVirtual) {
                foreach ($rsTipoEnderecoVirtual as $valorTipoEnderecoVirtual) {
                  if ($campo == $valorTipoEnderecoVirtual['tipo']) {
                    if($campo == "E-mail"){
                        $d=1;
                    }else{
                        $d=0;
                    }
                    $sql = " SELECT valor FROM enderecoVirtual 
                    WHERE clientePf_idClientePf = $idClientePf AND ePrinc = $d AND tipoEnderecoVirtual_idTipoEnderecoVirtual = " . $valorTipoEnderecoVirtual['idTipoEnderecoVirtual'];
                    $rs = Uteis::executarQuery($sql);

                    for ($i = 0; $i < $colspan[$campo]; $i++) {
                      $valorAtual = isset($rs[$i]) ? $rs[$i]['valor'] : "";
                      $html .= "<td >" . $valorAtual . "</td>";
                    }
                  }
                }
              }
            }
          }

          $html .= "</tr>";
        }
      }

      $html .= "</tbody>";

    }
	if ($mostrarTotal == 1) {
	echo "Total Mulheres:".$f."<br>Total Homens:".$m;
	}

     $html_base = $this -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);
     return $html_base . $html;

  }

  function relatorioFuncionario($where = "", $campos, $camposNome, $excel = false) {

    $where = " WHERE FU.excluido = 0 " . $where;
    $sql_id = "SELECT FU.idFuncionario AS total FROM funcionario AS FU " . $where;

    //CARREGA DADOS SIMPLES
    $sql = "SELECT FU.idFuncionario, FU.nome, FU.nomeExibicao, FU.sexo, FU.dataNascimento, FU.inativo, FU.cargo, FU.documentoUnico, FU.rg, FU.admicao, FU.demicao,
    EC.valor AS estadoCivil, TDU.valor AS tipoDoc, P.pais
    FROM funcionario AS FU 
    LEFT JOIN estadoCivil AS EC ON EC.idEstadoCivil = FU.estadoCivil_idEstadoCivil 
    LEFT JOIN tipoDocumentoUnico AS TDU ON TDU.idTipoDocumentoUnico = FU.tipoDocumentoUnico_idTipoDocumentoUnico    
    LEFT JOIN pais AS P ON P.idPais = FU.pais_idPais " . $where;
    //echo $sql;
    $result = $this -> query($sql);

    //CARREGA DADOS DE TABELAS RELACIONADAS
    $colspan = array();

    if (in_array("telefone", $campos)) {

      $Telefone = new Telefone();

      $sql = "SELECT MAX(total) AS total FROM (
        SELECT COUNT(idTelefone) AS total 
        FROM telefone 
        WHERE funcionario_idFuncionario IN ( $sql_id )
        GROUP BY funcionario_idFuncionario
      ) AS total";
       //echo $sql;
        //exit;
      $rs = Uteis::executarQuery($sql);
      $colspan["telefone"] = $rs[0]['total'];
    }

    if (in_array("endereco", $campos)) {

      $Endereco = new Endereco();

      $sql = "SELECT MAX(total) AS total FROM (
        SELECT COUNT(idEndereco) AS total 
        FROM endereco  
        WHERE excluido = 0 AND funcionario_idFuncionario IN ( $sql_id )
        GROUP BY funcionario_idFuncionario
      ) AS total";
       //echo $sql;
        //exit;
      $rs = Uteis::executarQuery($sql);
      $colspan["endereco"] = $rs[0]['total'];
    }

    //CARREGA DADOS DE TABELAS RELACIONADAS DE FORMA DINAMICA (de acordo com a parametrização do sistema)
    $TipoEnderecoVirtual = new TipoEnderecoVirtual();
    $rsTipoEnderecoVirtual = $TipoEnderecoVirtual -> selectTipoEnderecoVirtual(" WHERE excluido = 0 AND inativo = 0 ");

    foreach ($rsTipoEnderecoVirtual as $valorTipoEnderecoVirtual) {
      if (in_array($valorTipoEnderecoVirtual['tipo'], $campos)) {
        $sql = "SELECT MAX(total) AS total FROM (
          SELECT COUNT(idEnderecoVirtual) AS total 
          FROM enderecoVirtual  
          WHERE funcionario_idFuncionario IN ( $sql_id ) AND tipoEnderecoVirtual_idTipoEnderecoVirtual = " . $valorTipoEnderecoVirtual['idTipoEnderecoVirtual'] . "
          GROUP BY funcionario_idFuncionario
        ) AS total";
        $rs = Uteis::executarQuery($sql);
        $colspan[$valorTipoEnderecoVirtual['tipo']] = $rs[0]['total'];
      }
    }

    $html = "";

    if (mysqli_num_rows($result) > 0) {

      $html .= "<tbody>";

      while ($valor = mysqli_fetch_array($result)) {

        $idFuncionario = $valor['idFuncionario'];

        if ($campos) {

          $html .= "<tr>";

          foreach ($campos as $campo) {

            if ($campo == "nome")
              $html .= "<td >" . $valor['nome'] . "</td>";
            elseif ($campo == "nomeExibicao")
              $html .= "<td >" . $valor['nomeExibicao'] . "</td>";
            elseif ($campo == "sexo")
              $html .= "<td >" . Uteis::exibirSexo($valor['sexo']) . "</td>";
            elseif ($campo == "dataNascimento")
              $html .= "<td >" . Uteis::exibirData($valor['dataNascimento']) . "</td>";
            elseif ($campo == "inativo")
              $html .= "<td >" . Uteis::exibirStatus(!$valor['inativo'], !$excel) . "</td>";
            elseif ($campo == "cargo")
              $html .= "<td >" . $valor['cargo'] . "</td>";
            elseif ($campo == "tipoDoc")
              $html .= "<td >" . $valor['tipoDoc'] . "</td>";
            elseif ($campo == "documentoUnico")
              $html .= "<td >" . $valor['documentoUnico'] . "</td>";
            elseif ($campo == "rg")
              $html .= "<td >" . $valor['rg'] . "</td>";
            elseif ($campo == "tipoCliente")
              $html .= "<td >" . $valor['tipoCliente'] . "</td>";
            elseif ($campo == "estadoCivil")
              $html .= "<td >" . $valor['estadoCivil'] . "</td>";
            elseif ($campo == "pais")
              $html .= "<td >" . $valor['pais'] . "</td>";
            elseif ($campo == "admicao")
              $html .= "<td >" . Uteis::exibirData($valor['admicao']) . "</td>";
            elseif ($campo == "demicao")
              $html .= "<td >" . Uteis::exibirData($valor['demicao']) . "</td>";
            elseif ($campo == "telefone") {

              $sql = " SELECT idTelefone AS valor FROM telefone WHERE funcionario_idFuncionario = $idFuncionario ";
              $rs = Uteis::executarQuery($sql);

              for ($i = 0; $i < $colspan[$campo]; $i++) {
                $valorAtual = isset($rs[$i]) ? $Telefone -> getTelefone($rs[$i]['valor']) : "";
                $html .= "<td >" . $valorAtual . "</td>";
              }

            } elseif ($campo == "endereco") {

              $sql = " SELECT idEndereco AS valor FROM endereco WHERE funcionario_idFuncionario = $idFuncionario ";
              $rs = Uteis::executarQuery($sql);

              for ($i = 0; $i < $colspan[$campo]; $i++) {
                $valorAtual = isset($rs[$i]) ? $Endereco -> getEnderecoCompleto($rs[$i]['valor']) : "";
                $html .= "<td >" . $valorAtual . "</td>";
              }

            } else {

              foreach ($rsTipoEnderecoVirtual as $valorTipoEnderecoVirtual) {
                if ($campo == $valorTipoEnderecoVirtual['tipo']) {

                  $sql = " SELECT valor FROM enderecoVirtual 
                  WHERE funcionario_idFuncionario = $idFuncionario AND tipoEnderecoVirtual_idTipoEnderecoVirtual = " . $valorTipoEnderecoVirtual['idTipoEnderecoVirtual'];
                  $rs = Uteis::executarQuery($sql);

                  for ($i = 0; $i < $colspan[$campo]; $i++) {
                    $valorAtual = isset($rs[$i]) ? $rs[$i]['valor'] : "";
                    $html .= "<td >" . $valorAtual . "</td>";
                  }
                }

              }

            }

          }

          $html .= "</tr>";

        }

      }

      $html .= "</tbody>";

    }
    $html_base = $this -> montaTb_avancado($campos, $camposNome, $excel, $colspan);
    return $html_base . $html;

  }

  function relatorioProfessor($where = "", $campos, $camposNome, $excel = false, $idProfessor) {
	  
   $Professor = new Professor();
   $IdiomaProfessor = new IdiomaProfessor();
   $Idioma = new Idioma();
   $NivelLinguistico = new NivelLinguistico();
   $SotaqueIdiomaProfessor = new SotaqueIdiomaProfessor();
   $FormacaoPerfil = new FormacaoPerfil();
   $CertificadoCurso = new CertificadoCurso();

    $where = " WHERE 1 " . $where;
    $sql_id = "SELECT PR.idProfessor AS total FROM professor AS PR 
	 LEFT JOIN
    idiomaProfessor AS IP ON IP.professor_idProfessor = PR.idProfessor " . $where;

    //CARREGA DADOS SIMPLES
    $sql = "SELECT distinct(PR.idProfessor), PR.candidato, PR.nome, IP.nivelF, PR.nomeExibicao, PR.sexo, PR.dataNascimento, PR.rg, PR.documentoUnico, PR.inativo, PR.inss, PR.ccm, PR.otimaPerformance, PR.altaPerformance, PR.dataContratacao, PR.vetado, PR.indisponivel, EC.valor AS estadoCivil, TDU.valor AS tipoDoc, P.pais
    FROM professor AS PR  
    LEFT JOIN estadoCivil AS EC ON EC.idEstadoCivil = PR.estadoCivil_idEstadoCivil 
    LEFT JOIN tipoDocumentoUnico AS TDU ON TDU.idTipoDocumentoUnico = PR.tipoDocumentoUnico_idTipoDocumentoUnico
    LEFT JOIN idiomaProfessor AS IP ON IP.professor_idProfessor = PR.idProfessor  AND IP.inativo = 0     
    LEFT JOIN pais AS P ON P.idPais = PR.pais_idPais " . $where;
//	echo $sql;
    $result = $this -> query($sql);

    //CARREGA DADOS DE TABELAS RELACIONADAS
    $colspan = array();

    if (in_array("telefone", $campos)) {

      $Telefone = new Telefone();

      $sql = "SELECT MAX(total) AS total FROM (
        SELECT COUNT(idTelefone) AS total 
        FROM telefone 
        WHERE professor_idProfessor IN ( $sql_id )
        GROUP BY professor_idProfessor
      ) AS total";
      $rs = Uteis::executarQuery($sql);
      $colspan["telefone"] = $rs[0]['total'];
    }

    if (in_array("endereco", $campos)) {

      $Endereco = new Endereco();

      $sql = "SELECT MAX(total) AS total FROM (
        SELECT COUNT(idEndereco) AS total 
        FROM endereco  
        WHERE excluido = 0 AND professor_idProfessor IN ( $sql_id )
        GROUP BY professor_idProfessor
      ) AS total";
       //echo $sql;
        //exit;
      $rs = Uteis::executarQuery($sql);
      $colspan["endereco"] = $rs[0]['total'];
    }

    //CARREGA DADOS DE TABELAS RELACIONADAS DE FORMA DINAMICA (de acordo com a parametrização do sistema)
    $TipoEnderecoVirtual = new TipoEnderecoVirtual();
    $rsTipoEnderecoVirtual = $TipoEnderecoVirtual -> selectTipoEnderecoVirtual(" WHERE excluido = 0 AND inativo = 0 ");

    foreach ($rsTipoEnderecoVirtual as $valorTipoEnderecoVirtual) {
      if (in_array($valorTipoEnderecoVirtual['tipo'], $campos)) {
        $sql = "SELECT MAX(total) AS total FROM (
          SELECT COUNT(idEnderecoVirtual) AS total 
          FROM enderecoVirtual  
          WHERE professor_idProfessor IN ( $sql_id ) AND tipoEnderecoVirtual_idTipoEnderecoVirtual = " . $valorTipoEnderecoVirtual['idTipoEnderecoVirtual'] . "
          GROUP BY professor_idProfessor
        ) AS total";
         //echo $sql;
        //exit;
        $rs = Uteis::executarQuery($sql);
        $colspan[$valorTipoEnderecoVirtual['tipo']] = $rs[0]['total'];
      }
    }
	
	if ($idProfessor > 0) {
		
		$sql2 = "SELECT SQL_CACHE DISTINCT
    (PF.idClientePf), CONCAT('(', G.nome, ') ', PF.nome) AS nome, EV.valor
FROM
    professor AS P
        INNER JOIN
    aulaGrupoProfessor AS AGP ON AGP.professor_idProfessor = P.idProfessor
        LEFT JOIN
    aulaDataFixa AS ADF ON ADF.idAulaDataFixa = AGP.aulaDataFixa_idAulaDataFixa
        LEFT JOIN
    aulaPermanenteGrupo AS APG ON APG.idAulaPermanenteGrupo = AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo
        INNER JOIN
    planoAcaoGrupo AS PAG ON (PAG.idPlanoAcaoGrupo = ADF.planoAcaoGrupo_idPlanoAcaoGrupo
        OR PAG.idPlanoAcaoGrupo = APG.planoAcaoGrupo_idPlanoAcaoGrupo)
        INNER JOIN
    grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
        INNER JOIN
    integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        INNER JOIN
    clientePf AS PF ON PF.idClientePf = IG.clientePf_idClientePf
		INNER JOIN
	enderecoVirtual AS EV on EV.clientePf_idClientePf = PF.idClientePf 
		AND EV.ePrinc = 1
WHERE
    P.idProfessor = ".$idProfessor." AND PAG.inativo = 0
        AND G.inativo = 0
ORDER BY G.nome , PF.nome";

$rs = Uteis::executarQuery($sql2);

$alunos = "";
foreach($rs as $valor) {
	$alunos .= "<div>".$valor['nome']." - ".$valor['valor']."</div>";
	}
	
	$idProfessor2 = $idProfessor;
}

    $html = "";

    if (mysqli_num_rows($result) > 0) {

      $html .= "<tbody>";

      while ($valor = mysqli_fetch_array($result)) {

        $idProfessor = $valor['idProfessor'];
		$valorIdiomas = $IdiomaProfessor->selectIdiomaProfessor(" WHERE professor_idProfessor =".$idProfessor);

        if ($campos) {
          $html .= "<tr>";

          foreach ($campos as $campo) {

            if ($campo == "nome")
              $html .= "<td >" . $valor['nome'] . "</td>";
            elseif ($campo == "nomeExibicao")
              $html .= "<td >" . $valor['nomeExibicao'] . "</td>";
            elseif ($campo == "candidato")
              $html .= "<td >" . Uteis::exibirStatus(!$valor['candidato'], !$excel) . "</td>";
            elseif ($campo == "sexo")
              $html .= "<td >" . Uteis::exibirSexo($valor['sexo']) . "</td>";
            elseif ($campo == "dataNascimento")
              $html .= "<td >" . Uteis::exibirData($valor['dataNascimento']) . "</td>";
            elseif ($campo == "inativo")
              $html .= "<td >" . Uteis::exibirStatus(!$valor['inativo'], !$excel) . "</td>";
            elseif ($campo == "tipoDoc")
              $html .= "<td >" . $valor['tipoDoc'] . "</td>";
            elseif ($campo == "documentoUnico")
              $html .= "<td >" . $valor['documentoUnico'] . "</td>";
            elseif ($campo == "rg")
              $html .= "<td >" . $valor['rg'] . "</td>";
            elseif ($campo == "estadoCivil")
              $html .= "<td >" . $valor['estadoCivil'] . "</td>";
			elseif ($campo == "valorHora") {
			
			$html .= "<td>";
			$valorProfessor = "";
			foreach($valorIdiomas as $valor) {
			$valorProfessor .= $Idioma->getNome($valor['idioma_idIdioma'])."- R$ " ;	
			$valorProfessor .= $Professor->getPlanoCarreira($idProfessor, $valor['idioma_idIdioma'])."<br>";
			
			}
			 
			  $html .= $valorProfessor. "</td>";
			} elseif ($campo == "idioma") {
				$html .= "<td>";
			$valorIdioma = "";
			$valorNivel = "";
			$valorSotaque = "";
			foreach($valorIdiomas as $valor) {
			$valorIdioma .= "<div>".$Idioma->getNome($valor['idioma_idIdioma'])."</div>";
			$valorNivel .= "<div>".$NivelLinguistico->getNome($valor['nivelLinguistico_idNivelLinguistico'])."</div>";
			$valorSotaque .= "<div>".$SotaqueIdiomaProfessor->getNome($valor['sotaqueIdiomaProfessor_idSotaqueIdiomaProfessor'])."</div>";
			} 
			$html .= $valorIdioma."</td>";
			} elseif ($campo == "nivel")
				$html .= "<td>".$valorNivel."</td>";
			elseif ($campo == "sotaque")
				$html .= "<td>".$valorSotaque."</td>";
			elseif ($campo == "nivelF") {
				if ($valor['nivelF'] == 1) {
					$nivelF = "Fluente";	
				} elseif ($valor['nivelF'] == 2) {
					$nivelF = "Nativo";
				} elseif ($valor['nivelF'] == 3) {
					$nivelF = "Avançado";
				} elseif ($valor['nivelF'] == 4) {
					$nivelF = "Intermediário";
				} elseif ($valor['nivelF'] == 5) {
					$nivelF = "Básico";
				}
				$html .= "<td>".$nivelF."</td>";
			} elseif ($campo == 'formacao') {
				$rs = $FormacaoPerfil->selectFormacaoPerfil(" WHERE professor_idProfessor = ".$idProfessor);
				$formacao = "";
				foreach ($rs as $value) {
					$nome = $CertificadoCurso->getNome($value['curso']);
					$formacao .= "<div>".$nome."</div>";
				}
					$html .= "<td>".$formacao."</td>";
				
			} elseif ($campo == "pais")
              $html .= "<td >" . $valor['pais'] . "</td>";
            elseif ($campo == "inss")
              $html .= "<td >" . $valor['inss'] . "</td>";
            elseif ($campo == "ccm")
              $html .= "<td >" . $valor['ccm'] . "</td>";
            elseif ($campo == "otimaPerformance")
              $html .= "<td >" . Uteis::exibirStatus($valor['otimaPerformance'], !$excel) . "</td>";
            elseif ($campo == "altaPerformance")
              $html .= "<td >" . Uteis::exibirStatus($valor['altaPerformance'], !$excel) . "</td>";
            elseif ($campo == "vetado")
              $html .= "<td >" . Uteis::exibirStatus(!$valor['vetado'], !$excel) . "</td>";
            elseif ($campo == "indisponivel")
              $html .= "<td >" . Uteis::exibirStatus($valor['indisponivel'], !$excel) . "</td>";
            elseif ($campo == "dataContratacao")
              $html .= "<td >" . Uteis::exibirData($valor['dataContratacao']) . "</td>";
            elseif ($campo == "telefone") {

              $sql = " SELECT idTelefone AS valor FROM telefone WHERE professor_idProfessor = $idProfessor ";
              $rs = Uteis::executarQuery($sql);

              for ($i = 0; $i < $colspan[$campo]; $i++) {
                $valorAtual = isset($rs[$i]) ? $Telefone -> getTelefone($rs[$i]['valor']) : "";
                $html .= "<td >" . $valorAtual . "</td>";
              }

            } elseif ($campo == "endereco") {

              $sql = " SELECT idEndereco AS valor FROM endereco WHERE professor_idProfessor = $idProfessor ";
              $rs = Uteis::executarQuery($sql);

              for ($i = 0; $i < $colspan[$campo]; $i++) {
                $valorAtual = isset($rs[$i]) ? $Endereco -> getEnderecoCompleto($rs[$i]['valor']) : "";
                $html .= "<td >" . $valorAtual . "</td>";
              }

            } else {

              foreach ($rsTipoEnderecoVirtual as $valorTipoEnderecoVirtual) {
                if ($campo == $valorTipoEnderecoVirtual['tipo']) {

                  $sql = " SELECT valor FROM enderecoVirtual 
                  WHERE professor_idProfessor = $idProfessor AND tipoEnderecoVirtual_idTipoEnderecoVirtual = " . $valorTipoEnderecoVirtual['idTipoEnderecoVirtual'];
                  $rs = Uteis::executarQuery($sql);

                  for ($i = 0; $i < $colspan[$campo]; $i++) {
                    $valorAtual = isset($rs[$i]) ? $rs[$i]['valor'] : "";
                    $html .= "<td >" . $valorAtual . "</td>";
                  }
                }
              }

            }

          }
		  if ($idProfessor2 > 0 ) {
			$html .= "<td>".$alunos."</td>";
			$campos[] = "Alunos";
			$camposNome[] = "Alunos";  
			 
		  }

          $html .= "</tr>";

        }

      }

      $html .= "</tbody>";

    }
    $html_base = $this -> montaTb_avancado($campos, $camposNome, $excel, $colspan);
    return $html_base . $html;

  }
  
  

function RelatorioFreqEmpresa($idGrupos, $excel = false, $data_ini, $data_fim){
      
  $BancoHoras = new BancoHoras(); 
  $PlanoAcaoGrupo = new PlanoAcaoGrupo();
  $Grupo = new Grupo();
  $FolhaFrequencia = new FolhaFrequencia();
  $DemonstrativoCobranca = new DemonstrativoCobranca();
	 
	  $idGruposL = $idGrupos;
  
  for ($x=0;$x<count($idGruposL);$x++) {
	  $id = $idGruposL[$x];
	  
	  $nome = $Grupo->getNome($id);
	  
	  $html .= "<tr>";
	  $html .= "<td><img src='/cursos/images/cad.png' title='Ver grupo' onclick='abrirNivelPagina(this, '/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id='".$id.", '/cursos/admin/relatorios/banco/include/resourceHTML/banco.php', 'tr')'>".$nome."</td>";
  
	  $valorX = array();
	  $anoRef = date("Y",strtotime($data_ini));
	  $mesRef = date("m",strtotime($data_ini));
  
	   //Gerar Total com Debito e Credito
	$ids = $PlanoAcaoGrupo->getPAG_total($id);
	$soma = 0;
	for ($y=0;$y<count($ids);$y++) {
		$valorX[] = $ids[$y]['idPlanoAcaoGrupo'];
		
		$rs = $FolhaFrequencia->selectFF_diasHoras($ids[$y]['idPlanoAcaoGrupo'], $anoRef, $mesRef);

	  //Horas Cobradas
	  //COSULTA SE EXISTE REGISTRO
	$where = " WHERE planoAcaoGrupo_idPlanoAcaoGrupo = ".$ids[$y]['idPlanoAcaoGrupo']." AND mes = $mesRef AND ano = $anoRef ";
	$rsDemonstrativo = $DemonstrativoCobranca->selectDemonstrativoCobranca($where);

	if($rsDemonstrativo){
	$totalPagas = $rsDemonstrativo[0]['totalHoras'];
		}
	}
	
	for ($r=0;$r<count($rs['reposicao']);$r++) {

		$soma += $rs['reposicao'][$r]['horasTotal'];
		}
	
	for ($r=0;$r<count($rs['fixa']);$r++) {
		
		$soma += $rs['fixa'][$r]['horasTotal'];
		}

	for ($r=0;$r<count($rs['permanente']);$r++) {
		
		$soma += $rs['permanente'][$r]['horasTotal'];
		}

	$valorx2 = implode(', ',$valorX);
	  
//Where Temporario para trazer os créditos e débitos para junto do quadro
	 $where = "WHERE  DFF.reposicao = 0 AND DFF.banco = 1 AND 
	 			PAG.idPlanoAcaoGrupo in (".$valorx2.")
				And FF.dataReferencia between '".$data_ini."' and '".$data_fim."'   
                 OR DFF.idDiaAulaFF in 
                 (SELECT 
            diaAulaFF_idDiaAulaFF
        FROM
            planoAcaoGrupo AS PAG
                INNER JOIN
            folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
                AND FF.finalizadaParcial = 1
                AND FF.finalizadaPrincipal = 1
				And FF.dataReferencia between '".$data_ini."' and '".$data_fim."'
                INNER JOIN
            diaAulaFF AS DFF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia
                INNER JOIN
            bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DFF.idDiaAulaFF
        WHERE
            PAG.grupo_idGrupo =".$id.") ";

	// Total Horas Expiradas
	 $opcao = "expirada";
     $horasExpiradas = $BancoHoras->selectBancoHorasTo($where, $id, $opcao,$valorx2, $data_ini, $data_fim);

	 $totalExpiradasG += $horasExpiradas;
     $somaG += $soma;
	 $totalPagasG += $totalPagas;

	$saldoHoras = $soma - $totalPagas - $horasExpiradas;
	$saldoHorasG = $somaG - $totalPagasG - $totalExpiradasG;
	
	if($saldoHoras == 0){
         $obs = "OK";
    }else if($saldoHoras > 0){
		 $obs = " a compensar";
	}else{
		$saldoHoras *= -1;
		$obs = " realizadas a mais";
	}
	
	  $html .= "<td><center>".Uteis::exibirHoras($soma)."</center></td>";
	  $html .= "<td><center>".Uteis::exibirHoras($totalPagas)."</center></td>";
	  $html .= "<td><center>".Uteis::exibirHoras($horasExpiradas)."</center></td>";
	  $html .= "<td>".Uteis::exibirHoras($saldoHoras). "- " .$obs."</td>";
	  $html .= "</tr>";
  }
  
  	if($saldoHorasG == 0){
         $obs = "OK";
    }else if($saldoHorasG > 0){
		 $obs = " a compensar";
	}else{
		$saldoHorasG *= -1;
		$obs = " realizadas a mais";
	}
  	  $html .= "<tfoot>
        <tr> 
          <th>Total :</th>
          <th>".Uteis::exibirHoras($somaG)."</th>
          <th>".Uteis::exibirHoras($totalPagasG)."</th>
          <th>".Uteis::exibirHoras($totalExpiradasG)."</th>
          <th>".Uteis::exibirHoras($saldoHorasG). "- ".$obs."</th>          
        </tr>
      </tfoot>";	

 	 $colunas = array("Grupo", "Horas Realizadas", "Horas Pagas", "Horas expiradas", "Total:(Horas Realizadas - Horas Pagas - Horas Expiradas)");
	 $html_base = $this -> montaTb($colunas, $excel, "",1);
     return $html_base . $html;
  
}


function relatorioFrequencia_mensal2($where="", $soFinalizadasPri = true){
    
        $sql = "SELECT SQL_CACHE
    COALESCE(PJ.razaoSocial, 'Particular') AS empresa,
    G.idGrupo, G.nome AS grupo, PRF.idProfessor, PRF.nome AS nomeProfessor, FF.idFolhaFrequencia, PJ.idClientePj, PAG.idPlanoAcaoGrupo, SUM(COALESCE((AP.horaFim - AP.horaInicio),(AF.horaFim - AF.horaInicio),0)) AS horasProgramadas, SUM(DAF.horaRealizada) AS horasRealizadasPeloGrupo, MONTH(FF.dataReferencia) AS mes, YEAR(FF.dataReferencia) AS ano FROM 
    grupo AS G INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo
    INNER JOIN folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo";
    if( $soFinalizadasPri ){
      $sql .= " AND FF.finalizadaPrincipal = 1 ";
    }else{
      $sql .= " AND FF.finalizadaParcial >= 0 ";
    }
    $sql .= "INNER JOIN diaAulaFF AS DAF ON DAF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia AND DAF.aulaInexistente = 0
        LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = DAF.aulaPermanenteGrupo_idAulaPermanenteGrupo
        LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = DAF.aulaDataFixa_idAulaDataFixa
        INNER JOIN professor AS PRF ON PRF.idProfessor = FF.professor_idProfessor        
        LEFT JOIN grupoClientePj AS GPJ ON GPJ.grupo_idGrupo = G.idGrupo LEFT JOIN clientePj AS PJ ON PJ.idClientePj = GPJ.clientePj_idClientePj
        LEFT JOIN bancoHoras AS BH ON BH.diaAulaFF_idDiaAulaFF = DAF.idDiaAulaFF ".$where." GROUP BY  G.idGrupo, FF.idFolhaFrequencia ORDER BY PAG.idPlanoAcaoGrupo, FF.dataReferencia";
  // echo $sql;
    $result = $this->query($sql); 
  
   if (mysqli_num_rows($result) > 0) {
     while ($valor = mysqli_fetch_array($result)):
           
          $horasProgramadas[$valor['idGrupo']] = $valor['horasProgramadas'];
          $horasRealizadasPeloGrupo[$valor['idGrupo']] = $valor['horasRealizadasPeloGrupo'];          
          
          $somarHoras = Uteis::executarQuery("SELECT SUM(COALESCE((AP.horaFim - AP.horaInicio),(AF.horaFim - AF.horaInicio),0)) - COALESCE(SUM(DAF.horaRealizada), 0) AS somarCom_horasRealizadasPeloGrupo 
     FROM diaAulaFF AS DAF INNER JOIN ocorrenciaFF AS OC ON OC.idOcorrenciaFF = DAF.ocorrenciaFF_idOcorrenciaFF LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = DAF.aulaPermanenteGrupo_idAulaPermanenteGrupo 
     LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = DAF.aulaDataFixa_idAulaDataFixa WHERE DAF.folhaFrequencia_idFolhaFrequencia = ".$valor['idFolhaFrequencia']." AND (DAF.aulaPermanenteGrupo_idAulaPermanenteGrupo IS NOT NULL OR DAF.aulaDataFixa_idAulaDataFixa IS NOT NULL) AND ((OC.reporAula = 1 AND OC.pagarProfessor = 1) OR (OC.reporAula = 0 AND OC.pagarProfessor = 1))");
          
          $totalHorasGrupo[$valor['idGrupo']]  =  $horasRealizadasPeloGrupo[$valor['idGrupo']] +  $somarHoras[0]['somarCom_horasRealizadasPeloGrupo'];
          
          $ajudaCustoD = Uteis::executarQuery("SELECT COALESCE(SUM(PAC.valor), 0) AS ajudaCustoDia FROM planoAcaoGrupoAjudaCusto AS PAC WHERE PAC.excluido = 0 AND PAC.planoAcaoGrupo_idPlanoAcaoGrupo = ".$valor['idPlanoAcaoGrupo']." AND PAC.professor_idProfessor = ".$valor['idProfessor']." AND PAC.porDia = 1");
          $ajudaCustoDia[$valor['idGrupo']] = $ajudaCustoD[0]['ajudaCustoDia'];
          
          $ajudaCustoH = Uteis::executarQuery("SELECT COALESCE(SUM(PAC.valor), 0) AS ajudaCustoHora FROM planoAcaoGrupoAjudaCusto AS PAC WHERE PAC.excluido = 0 AND PAC.planoAcaoGrupo_idPlanoAcaoGrupo = ".$valor['idPlanoAcaoGrupo']." AND PAC.professor_idProfessor = ".$valor['idProfessor']." AND PAC.porDia = 0");
          $ajudaCustoHora[$valor['idGrupo']] = $ajudaCustoH[0]['ajudaCustoHora'];
                
          $diasAula_pagar = Uteis::executarQuery("SELECT COUNT(DISTINCT (DFF.dataAula)) AS diasAula_pagarProf FROM diaAulaFF AS DFF INNER JOIN folhaFrequencia AS FF ON FF.idFolhaFrequencia = DFF.folhaFrequencia_idFolhaFrequencia WHERE DFF.aulaInexistente = 0 AND FF.idFolhaFrequencia = ".$valor['idFolhaFrequencia']);
          $diasAula_pagarProf[$valor['idGrupo']] = $diasAula_pagar[0]['diasAula_pagarProf'];
                 
          $reposicoes ="";
          $reposicoes_ocorridas[$valor['idGrupo']] ="" ;
          
          $reposicoes_pagar ="";
          $reposicoes_pagarProf[$valor['idGrupo']] = $diasAula_ocorridas;
          
          $diasAula_ocorridas ="";
          $diasAula_ocorridos[$valor['idGrupo']] = $diasAula_ocorridas;
        
        $diasAula_total[$valor['idGrupo']] = "";
       
    endwhile;
     $resultado = array("Programadas"=>$horasProgramadas,"TotalHoras"=>$totalHorasGrupo, "AjudaCustoDia"=>$ajudaCustoDia,"AjudaCustoHora"=>$ajudaCustoHora,"Aulas_PagarProf"=>$diasAula_pagarProf,"AulasDadas"=>$diasAula_ocorridos, "TotalDiasAula"=>$diasAula_total);
   }
    return $resultado;
    
  }
  
function pagarProfessor($retorno = FALSE){
    $result = Uteis::executarQuery("SELECT idOcorrenciaFF, sigla from ocorrenciaFF where excluida = 0 AND pagarProfessor = 1");
    $cont = 0;
    if($retorno){
        foreach($result as $valor){         
            if($cont==0){
                $resp = $valor['sigla'];            
            }else{
                $resp .= ",".$valor['sigla'];
            } 
        }      
    }else{
        foreach($result as $valor){         
            if($cont==0){
                $resp = $valor['idOcorrenciaFF'];           
            }else{
                $resp .= ",".$valor['idOcorrenciaFF'];
            }
        }   
    }
}

function permiteReposicao($retorno = FALSE){
$result = Uteis::executarQuery("SELECT idOcorrenciaFF, sigla from ocorrenciaFF where excluida = 0 AND reporAula = 1");
    $cont = 0;
    if($retorno){
        foreach($result as $valor){         
            if($cont==0){
                $resp = $valor['sigla'];            
            }else{
                $resp .= ",".$valor['sigla'];
            }  
            }     
    }else{
        foreach($result as $valor){         
            if($cont==0){
                $resp = $valor['idOcorrenciaFF'];           
            }else{
                $resp .= ",".$valor['idOcorrenciaFF'];
            }
    }   
    }
}

function pagarReposicao($retorno = FALSE){
$result = Uteis::executarQuery("SELECT idOcorrenciaFF, sigla from ocorrenciaFF where excluida = 0 AND pagarReposicao = 1");  
    $cont = 0;
    if($retorno){
        foreach($result as $valor){         
            if($cont==0){
                $resp = $valor['sigla'];            
            }else{
                $resp .= ",".$valor['sigla'];
            }       }
    }else{
        foreach($result as $valor){         
            if($cont==0){
                $resp = $valor['idOcorrenciaFF'];           
            }else{
                $resp .= ",".$valor['idOcorrenciaFF'];
            }
        }
    }
    return $resp;
}

function reposicaoExpira($retorno = FALSE){
$result = Uteis::executarQuery("SELECT idOcorrenciaFF, sigla from ocorrenciaFF where excluida = 0 AND expira = 1");  
    $cont = 0;
    if($retorno){
        foreach($result as $valor){         
            if($cont==0){
                $resp = $valor['sigla'];            
            }else{
                $resp .= ",".$valor['sigla'];
            }       }
    }else{
        foreach($result as $valor){         
            if($cont==0){
                $resp = $valor['idOcorrenciaFF'];           
            }else{
                $resp .= ",".$valor['idOcorrenciaFF'];
            }
        }         
    }
    return $resp;   
}

function horasProgramadas($idFolhaFrequencia, $folha=""){
    
    switch($folha){
        case 1:
             $add = "AND FF.finalizadaPrincipal = 1 AND FF.finalizadaParcial = 1";
        break;
        case 2:
            $add = "AND FF.finalizadaPrincipal = 0 AND FF.finalizadaParcial = 1";
        break;
        default:
            $add = "AND FF.finalizadaPrincipal = 0 AND (FF.finalizadaParcial = 0 OR FF.finalizadaParcial = 1)";
        break;  
    }
    $sql = "SELECT SQL_CACHE SUM(COALESCE((AP.horaFim - AP.horaInicio), (AF.horaFim - AF.horaInicio), 0)) AS horasProgramadas FROM grupo AS G INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo INNER JOIN folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo INNER JOIN diaAulaFF AS DAF ON DAF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia AND DAF.aulaInexistente = 0 LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = DAF.aulaPermanenteGrupo_idAulaPermanenteGrupo LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = DAF.aulaDataFixa_idAulaDataFixa INNER JOIN professor AS PRF ON PRF.idProfessor = FF.professor_idProfessor WHERE ".$add." FF.idFolhaFrequencia = ".$idFolhaFrequencia." GROUP BY G.idGrupo , FF.idFolhaFrequencia ORDER BY PAG.idPlanoAcaoGrupo , FF.dataReferencia";
    $result = Uteis::executarQuery($sql);
    return $result[0]['horasProgramadas'];
}

function horasRealizadas($idFolhaFrequencia, $folha=""){

    switch($folha){
        case 1:
             $add = "AND FF.finalizadaPrincipal = 1 AND FF.finalizadaParcial = 1";
        break;
        case 2:
            $add = "AND FF.finalizadaPrincipal = 0 AND FF.finalizadaParcial = 1";
        break;
        default:
            $add = "AND FF.finalizadaPrincipal = 0 AND (FF.finalizadaParcial = 0 OR FF.finalizadaParcial = 1)";
        break;  
    }

    $sql = "SELECT SQL_CACHE SUM(DAF.horaRealizada) AS horasRealizadasPeloGrupo FROM grupo AS G INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo INNER JOIN folhaFrequencia AS FF ON FF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo INNER JOIN diaAulaFF AS DAF ON DAF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia AND DAF.aulaInexistente = 0 LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = DAF.aulaPermanenteGrupo_idAulaPermanenteGrupo LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = DAF.aulaDataFixa_idAulaDataFixa INNER JOIN professor AS PRF ON PRF.idProfessor = FF.professor_idProfessor WHERE FF.idFolhaFrequencia = ".$idFolhaFrequencia." GROUP BY G.idGrupo , FF.idFolhaFrequencia ORDER BY PAG.idPlanoAcaoGrupo , FF.dataReferencia";
    $result = Uteis::executarQuery($sql);
    return $result[0]['horasProgramadas'];
}

function somarComHorasRealizadas($idFolhaFrequencia){

 $sql = Uteis::executarQuery("SELECT SUM(COALESCE((AP.horaFim - AP.horaInicio),(AF.horaFim - AF.horaInicio),0)) - COALESCE(SUM(DAF.horaRealizada), 0) AS somarCom_horasRealizadasPeloGrupo 
     FROM diaAulaFF AS DAF INNER JOIN ocorrenciaFF AS OC ON OC.idOcorrenciaFF = DAF.ocorrenciaFF_idOcorrenciaFF LEFT JOIN aulaPermanenteGrupo AS AP ON AP.idAulaPermanenteGrupo = DAF.aulaPermanenteGrupo_idAulaPermanenteGrupo 
     LEFT JOIN aulaDataFixa AS AF ON AF.idAulaDataFixa = DAF.aulaDataFixa_idAulaDataFixa WHERE DAF.folhaFrequencia_idFolhaFrequencia = ".$idFolhaFrequencia." AND (DAF.aulaPermanenteGrupo_idAulaPermanenteGrupo IS NOT NULL OR DAF.aulaDataFixa_idAulaDataFixa IS NOT NULL) AND ((OC.reporAula = 1 AND OC.pagarProfessor = 1) OR (OC.reporAula = 0 AND OC.pagarProfessor = 1))");
    $result = Uteis::executarQuery($sql);
    return $result[0]['somarCom_horasRealizadasPeloGrupo'];  

}

function ajudaCusto($idProfessor, $idPlanoAcaoGrupo,$hora = false){
$sql = "SELECT COALESCE(SUM(PAC.valor), 0) AS ajudaCustoDia FROM planoAcaoGrupoAjudaCusto AS PAC WHERE PAC.excluido = 0 AND PAC.planoAcaoGrupo_idPlanoAcaoGrupo = ".$idPlanoAcaoGrupo." AND PAC.professor_idProfessor = ".$idProfessor;
    if($hora){
        $sql .= " AND PAC.porDia = 0";
    }else{
        $sql .= " AND PAC.porDia = 1";
    }
$result = Uteis::executarQuery($sql);
    return $result[0]['ajudaCustoDia']; 
}

function MediasProvas($idIntegrante, $complemento=""){
  $sql = "SELECT SQL_CACHE COALESCE(PJ.razaoSocial, 'Particular') AS empresa, G.nome AS grupo, CPF.nome AS aluno, P.nome AS nomeProva, 
      C.dataPrevistaNova, C.dataPrevistaInicial, C.dataAplicacao, AVG(ICP.nota) AS notaProva
      FROM grupo AS G 
      INNER JOIN planoAcaoGrupo AS PAG ON PAG.grupo_idGrupo = G.idGrupo
      INNER JOIN integranteGrupo AS IG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
      INNER JOIN clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf
      INNER JOIN calendarioProva AS C ON C.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
      INNER JOIN prova AS P ON P.idProva = C.prova_idProva  
      INNER JOIN itenProva AS IP ON IP.prova_idProva = P.idProva
      INNER JOIN itemCalendarioProva AS ICP ON ICP.calendarioProva_idCalendarioProva = C.idCalendarioProva 
        AND ICP.itenProva_idItenProva = IP.idItenProva AND ICP.integranteGrupo_idIntegranteGrupo = IG.idIntegranteGrupo
      INNER JOIN professor AS PRF ON PRF.idProfessor = ICP.professor_idProfessor
      LEFT JOIN grupoClientePj AS GPJ ON GPJ.grupo_idGrupo = G.idGrupo
      LEFT JOIN clientePj AS PJ ON PJ.idClientePj = GPJ.clientePj_idClientePj WHERE IG.idIntegranteGrupo =" . $idIntegrante . $complemento." GROUP BY IG.idIntegranteGrupo, P.nome";
      //echo $sql;
      $result = $this -> executeQuery($sql);
      return $result; 
}
function CsaException(){
    
}

//Relatorio Financeiro Detalhado

function relatorioConsolidado($where = "", $caminhoAtualizar = "", $ondeAtualiza = "", $apenasLinha = false, $excel = false, $campos, $camposNome) {

    $sql = "SELECT D.idDemonstrativoCobranca, G.nome, CPJ.razaoSocial, CPJ.cnpj, G.idGrupo, D.obs, D.mes, D.ano, D.valCurso, D.valMaterial,    D.valCredito, D.valDebito, D.totalHoras, (COALESCE(D.valCurso, 0) + COALESCE(D.valMaterial, 0) + COALESCE(D.valCredito, 0) - COALESCE(D.valDebito, 0)) AS totalCusto, D.dataVencimento, month(FG.dataFechamento) as mesF, year(FG.dataFechamento) as yearF
		FROM
    demonstrativoCobranca AS D
        LEFT JOIN
    planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = D.planoAcaoGrupo_idPlanoAcaoGrupo
        LEFT JOIN
    grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
        LEFT JOIN
    clientePj AS CPJ ON CPJ.idClientePj = D.clientePj_idClientePj
        LEFT JOIN
    gerenteTem AS GER ON GER.clientePj_idClientePj = CPJ.idClientePj
    	LEFT JOIN
    planoAcaoGrupoStatusCobranca AS GSC on D.idDemonstrativoCobranca = GSC.idPlanoAcaoGrupoStatusCobranca
		LEFT JOIN
	fechamentoGrupo AS FG on FG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo	
	" . $where;
 //   echo $sql;
    $result = $this -> query($sql);
	
    $total = 0;
	$caminhoAtualizar_base = CAMINHO_RELAT . "consolidado/include/resourceHTML/consolidado.php";
	$cont=0;

    if (mysqli_num_rows($result) > 0) {
     while ($valor = mysqli_fetch_array($result)) {
		 
		 $caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idDemonstrativoCobranca=" . $valor['idDemonstrativoCobranca'];
		 $caminhoAtualizar .= "&ordem=" . ($cont++);
			
		  $sql2 = "SELECT DG.integranteGrupo_idIntegranteGrupo, DG.cursoEmpresa, DG.materialEmpresa, DG.creditoEmpresa, DG.debitoEmpresa, sum((COALESCE(DG.cursoEmpresa,0) + COALESCE(DG.materialEmpresa,0) + COALESCE(DG.creditoEmpresa,0) - COALESCE(DG.debitoEmpresa,0))) AS totalEmpresa FROM demonstrativoCobrancaIntegranteGrupo AS DG
		  where DG.demonstrativoCobranca_idDemonstrativoCobranca = ".$valor['idDemonstrativoCobranca'];
	  
		  $result2 = $this -> query($sql2);
		  $valor2a = mysqli_fetch_array($result2);
		  
		  $totalEmp .=  $valor2a['totalEmpresa'];
		  
		  $sql3 = "SELECT EV.valor, PF.nomeExibicao, PF.documentoUnico, IG.clientePf_idClientePf, DG.idDemonstrativoCobrancaIntegranteGrupo, DG.integranteGrupo_idIntegranteGrupo, DG.cursoAluno, DG.materialAluno, DG.creditoAluno, DG.debitoAluno, DG.obs
FROM demonstrativoCobrancaIntegranteGrupo AS DG 
left join integranteGrupo AS IG on DG.integranteGrupo_idIntegranteGrupo = IG.idIntegranteGrupo
left join clientePf AS PF on IG.clientePf_idClientePf = PF.idClientePf
left join enderecoVirtual AS EV on IG.clientePf_idClientePf = EV.clientePf_idClientePf
 where EV.ePrinc = 1 AND DG.demonstrativoCobranca_idDemonstrativoCobranca =".$valor['idDemonstrativoCobranca'];
	      $result3 = $this -> query($sql3);
		  $html2 =" ";
		  $totalAluno = 0;
		  while ($valor3 = mysqli_fetch_array($result3)) {
			$totalAluno += $valor3['cursoAluno'] + $valor3['materialAluno'] + $valor3['creditoAluno'] - $valor3['debitoAluno'];
			$html2 .= "<div class=\"destacaLinha\" title=\"Clique neste item para inserir o número da Nota fiscal\"  onclick=\"abrirNivelPagina(this, '" . CAMINHO_RELAT . "consolidado/include/form/alterarNFaluno.php?&idDemonstrativoCobranca=".$valor3['idDemonstrativoCobrancaIntegranteGrupo']."', '$caminhoAtualizar', '$ondeAtualiza')\">"
			.$valor3['nomeExibicao']. " - "
			.$valor3['documentoUnico']."<br>"
			.$valor3['valor']. "<br>"
			.Uteis::formatarMoeda($totalAluno). "<br>"
			."NFe:".$valor3['obs']."
			</div>";
		}			  
		  $nome = $valor['nome'];
		  $razao = $valor['razaoSocial'];
		  $cnpj = $valor['cnpj'];
		  $valorEmp = Uteis::formatarMoeda($valor2a['totalEmpresa']);
		  		  
		  $obs = $valor['obs'];
		  $dataVencimento = Uteis::exibirData($valor['dataVencimento']);
		  $valCurso = Uteis::formatarMoeda($valor['valCurso']);
		  
		if ($apenasLinha) {

					$col = array();

					$col[] = $nome;
					$col[] = $razao . "<br>".$cnpj;
					$col[] = $valorEmp . "<br>".$obs;
					$col[] = $html2;
                    $col[] = $dataVencimento;
					$col[] = $valCurso;
					$html = $col;
					break;

				} else {
					if ($campos) {						
        $html .= "<tr>";
				foreach ($campos as $campo) {
					if ($campo == 'grupo') {
        $html .= "<td >" . $nome . "</td>";
				} else if ($campo == 'empresa') {
        $html .= "<td >" . $razao . "<br>".$cnpj ."</td>";
				} else if ($campo == 'parteE') {
        $html .= "<td title=\"Clique neste item para inserir o número da Nota fiscal\"  onclick=\"abrirNivelPagina(this, '" . CAMINHO_RELAT . "consolidado/include/form/alterarNFemp.php?idDemonstrativoCobranca=".$valor['idDemonstrativoCobranca']."', '$caminhoAtualizar', '$ondeAtualiza')\"> ";
		$html .=  $valorEmp;
		$html .= "<br>".$obs;
		$html .= "</td>";
				} else if ($campo == 'parteA') {
		$html .= "<td>".$html2."</td>";
				} else if ($campo == 'vencimento') {
        $html .= "<td >" . $dataVencimento . "</td>";
				} else if ($campo == 'total') { 
		$html .= "<td >" . $valCurso . "</td>";
					}
				}
        $html .= "</tr>";
					}
				
        $total += $valor['totalCusto'];
	      }
   		}
	}
	 $html_base = $this -> montaTb_avancado($campos, $camposNome, $excel, $colspan, $head);

    return $html_base. $html;

  }
  
    function relatorioConsolidadoTr($where = "", $tipo, $excel = false) {

    $sql = "SELECT SQL_CACHE D.idDemonstrativoCobranca, G.nome, CPJ.razaoSocial, CPJ.cnpj, G.idGrupo, D.obs, D.mes, D.ano, D.valCurso, D.valMaterial, D.valCredito, D.valDebito, D.totalHoras,
    (COALESCE(D.valCurso,0) + COALESCE(D.valMaterial,0) + COALESCE(D.valCredito,0) - COALESCE(D.valDebito,0)) AS totalCusto, D.dataVencimento
    FROM demonstrativoCobranca AS D   
    LEFT JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = D.planoAcaoGrupo_idPlanoAcaoGrupo
    LEFT JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo
    LEFT JOIN clientePj AS CPJ ON CPJ.idClientePj = D.clientePj_idClientePj
    LEFT JOIN gerenteTem as GER ON GER.clientePj_idClientePj = CPJ.idClientePj
	" . $where;
    //echo $sql;
    $result = $this -> query($sql);

    if (mysqli_num_rows($result) > 0) {
      $html .= "<tbody>";
      while ($valor = mysqli_fetch_array($result)) {
		  
		   $sql2 = "SELECT SQL_CACHE DG.integranteGrupo_idIntegranteGrupo, DG.cursoEmpresa, DG.materialEmpresa, DG.creditoEmpresa, DG.debitoEmpresa, sum((COALESCE(DG.cursoEmpresa,0) + COALESCE(DG.materialEmpresa,0) + COALESCE(DG.creditoEmpresa,0) - COALESCE(DG.debitoEmpresa,0))) AS totalEmpresa FROM demonstrativoCobrancaIntegranteGrupo AS DG
		  where DG.demonstrativoCobranca_idDemonstrativoCobranca = ".$valor['idDemonstrativoCobranca'];
	  
		  $result2 = $this -> query($sql2);
		  $valor2a = mysqli_fetch_array($result2);
		  
		  $sql3 = "SELECT SQL_CACHE EV.valor, PF.nomeExibicao, PF.documentoUnico, IG.clientePf_idClientePf, DG.idDemonstrativoCobrancaIntegranteGrupo, DG.integranteGrupo_idIntegranteGrupo, DG.cursoAluno, DG.materialAluno, DG.creditoAluno, DG.debitoAluno, DG.obs
FROM demonstrativoCobrancaIntegranteGrupo AS DG 
left join integranteGrupo AS IG on DG.integranteGrupo_idIntegranteGrupo = IG.idIntegranteGrupo
left join clientePf AS PF on IG.clientePf_idClientePf = PF.idClientePf
left join enderecoVirtual AS EV on IG.clientePf_idClientePf = EV.clientePf_idClientePf
 where EV.ePrinc = 1 AND DG.demonstrativoCobranca_idDemonstrativoCobranca =".$valor['idDemonstrativoCobranca'];
	      $result3 = $this -> query($sql3);
		  	  
        $total += $valor['total'];
        $html .= "<tr>";
        $html .= "<td >" . $valor['nome'] . "</td>";
        $html .= "<td >" . $valor['razaoSocial'] . "<br>". $valor['cnpj']."</td><br>";
		$html .=  "<td>".Uteis::formatarMoeda($valor2a['totalEmpresa']);
		if ($valor['obs']) {
			$html .= "<br>".$valor['obs'];
		}
		$html .= "</td><td>";
		while ($valor3 = mysqli_fetch_array($result3)) {
			$totalAluno = $valor3['cursoAluno'] + $valor3['materialAluno'] + $valor3['creditoAluno'] - $valor3['debitoAluno'];
		$html .="<table><tr><td>".	$valor3['nomeExibicao']. " - "
			.$valor3['documentoUnico']."<br>"
			.$valor3['valor']. "<br>"
			.Uteis::formatarMoeda($totalAluno). "<br>"
			.$valor3['obs']."
			<hr size='1' style='border-style: inset; border-width: 1px;'></td></tr></table>";
		}
        $html .=  "</td>";
        $html .= "<td >" . Uteis::exibirData($valor['dataVencimento']) . "</td>";
		$html .= "<td >" . Uteis::formatarMoeda($valor['valCurso']) . "</td>";
		
        $html .= "</tr>";
        $total += $valor['totalCusto'];
      
      }
      $html .= "</tbody>";
    }
    $colunas = array("Grupo", "Empresa", "Parte Total Empresa R$ / Nfe", "Parte Total Aluno R$ / Nfe", "Vencimento", "Total (R$: ".Uteis::formatarMoeda($total).")");
    $html_base = $this -> montaTb($colunas, $excel);

    return $html_base . $html;

  }
  
  function relatorioFatConsolidado($where = "", $caminhoAtualizar = "", $ondeAtualiza = "", $apenasLinha = false, $excel = false, $comparativo) {
	  
	  $PlanoAcaoGrupo = new PlanoAcaoGrupo();

	 $sql = "SELECT D.idDemonstrativoCobranca, G.nome, CPJ.razaoSocial, CPJ.cnpj, G.idGrupo, D.obs, D.mes, D.ano, D.valCurso, D.valMaterial, D.valCredito, D.valDebito, D.totalHoras, PAG.idPlanoAcaoGrupo, (COALESCE(D.valCurso,0) + COALESCE(D.valMaterial,0) + COALESCE(D.valCredito,0) - COALESCE(D.valDebito,0)) AS totalCusto, D.dataVencimento
    FROM demonstrativoCobranca AS D   
    INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = D.planoAcaoGrupo_idPlanoAcaoGrupo /*AND PAG.inativo = 0*/
    INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo AND G.inativo = 0
    LEFT JOIN clientePj AS CPJ ON CPJ.idClientePj = D.clientePj_idClientePj
    LEFT JOIN gerenteTem as GER ON GER.clientePj_idClientePj = CPJ.idClientePj
	".$where. " GROUP by D.idDemonstrativoCobranca";
 
  //   echo $sql;
    $result = $this -> query($sql);
	
    $total = 0;
	$caminhoAtualizar_base = CAMINHO_RELAT . "fatconsolidado/include/resourceHTML/fatconsolidado.php";
	$cont=0;
	$html = "<tbody>";
	
    if (mysqli_num_rows($result) > 0) {
	 		
     while ($valor = mysqli_fetch_array($result)) {
		 
		 $caminhoAtualizar = $caminhoAtualizar_base . "?tr=1&idDemonstrativoCobranca=" . $valor['idDemonstrativoCobranca'];
		 $caminhoAtualizar .= "&ordem=" . ($cont++);
		 $ano = $valor['ano'];
	     $mes = $valor['mes'];
			 if ($mes < 10) {
    	        $mes = "0" . $mes;
			 }
		 $idPlanoAcaoGrupo = $valor['idPlanoAcaoGrupo'];
		 $todosPAG = $PlanoAcaoGrupo->getTodosPAG($idPlanoAcaoGrupo);
		 $dataReferencia = "$ano-$mes-01";
	     $dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataReferencia))));
		 $totalHoras = $valor['totalHoras'];
		 
	     $nome = "<img src='/cursos/images/cad.png' title='Ver grupo' onclick='abrirNivelPagina(this, \"/cursos/admin/modulos/relacionamento/grupo/cadastro.php?id=".$valor['idPlanoAcaoGrupo']."\", \"\", \"\")'>".$valor['nome']."";
		 
		 $valCurso = Uteis::formatarMoeda($valor['valCurso']);
		 
		 // Totais
		 $totalTotalHoras += $totalHoras;
		 $totalValCurso += $valCurso;

	
	$sql3 = " SELECT DISTINCT
    (AGP.professor_idProfessor) AS idProfessor, PR.nomeExibicao
FROM
    planoAcaoGrupo AS PAG
        LEFT JOIN
    aulaDataFixa AS AF ON AF.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        LEFT JOIN
    aulaPermanenteGrupo AS AP ON AP.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        INNER JOIN
    aulaGrupoProfessor AS AGP ON (AGP.aulaDataFixa_idAulaDataFixa = AF.idAulaDataFixa
        OR AGP.aulaPermanenteGrupo_idAulaPermanenteGrupo = AP.idAulaPermanenteGrupo)
        INNER JOIN
    professor as PR on AGP.professor_idProfessor = PR.idProfessor
		WHERE PAG.inativo = 0 
		AND PAG.idPlanoAcaoGrupo in ( ".$todosPAG." ) ";
$sql3 .= " AND ((AGP.dataFim >= '".$dataReferencia."' AND AGP.dataFim <= '".$dataReferenciaFinal."') 
        OR AGP.dataFim is null OR AGP.dataFim >= '".$dataReferencia."' )";
		
	 $result3 = $this -> query($sql3);
	 
	 $html2 =" ";
     $html3 =" ";
	 $html4 =" ";
	 $html5 =" ";
	 $html6 = "";
	 
	 $totalPagamento = 0;
	
	// Professores
	
	  while ($valor3 = mysqli_fetch_array($result3)) {
		  
		$html2 .= "<div>".$valor3['nomeExibicao']."</div>";	
				
			  
			  $idProfessor = $valor3['idProfessor'];
			  
	          $sql6 ="SELECT sum( DFF.horaRealizada) AS reposicao FROM diaAulaFF AS DFF
	             INNER JOIN folhaFrequencia AS FF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia 
                 INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo
                 INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo WHERE DFF.reposicao = 1 AND PAG.idPlanoAcaoGrupo in (".$todosPAG.") AND FF.professor_idProfessor = ".$idProfessor." AND (DFF.dataAula >= '" . $dataReferencia . "' AND DFF.dataAula <= '" . $dataReferenciaFinal . "')" ; 
	
				 $result6 = $this -> executeQuery($sql6); 
					 
				  $reposicao = 0;
		         
				  $html5 .= "<div>";
				  $totalReposicao += $result6[0]['reposicao'];
				  $html5 .= Uteis::exibirHoras($result6[0]['reposicao'])."</div>";
	  //Premiação

    $sql8 = "SELECT sum(CDG.valor) as premio FROM creditoDebitoGrupo AS CDG
	where CDG.professor_idProfessor = ".$idProfessor." AND CDG.mes = ".$mes." AND CDG.ano = ".$ano." AND CDG.premiacao = 1 AND CDG.excluido = 0";
	
	$result9 = $this-> executeQuery($sql8);
	$premiacao = $result9[0]['premio'];
	$totalPremiacao += $premiacao;
	
	$totalPagamento += $premiacao;
	
	//Hora Realizada
	$sql9 ="SELECT sum( DFF.horaRealizada) AS horaRealizada FROM diaAulaFF AS DFF
	             INNER JOIN folhaFrequencia AS FF ON DFF.folhaFrequencia_idFolhaFrequencia = FF.idFolhaFrequencia 
                 INNER JOIN planoAcaoGrupo AS PAG ON PAG.idPlanoAcaoGrupo = FF.planoAcaoGrupo_idPlanoAcaoGrupo
                 INNER JOIN grupo AS G ON G.idGrupo = PAG.grupo_idGrupo WHERE DFF.reposicao = 0 AND PAG.idPlanoAcaoGrupo in (".$todosPAG.") AND FF.professor_idProfessor = ".$idProfessor." AND (DFF.dataAula >= '" . $dataReferencia . "' AND DFF.dataAula <= '" . $dataReferenciaFinal . "')" ; 
	
				 $result9 = $this -> executeQuery($sql9); 
				
				$html4 .= "<div>".Uteis::exibirHoras($result9[0]['horaRealizada'])."</div>";
				
				$totalHoraRealizada += $result9[0]['horaRealizada'];
			
	// Pagamento de professor
	$sql5 = "SELECT DP.idDemonstrativoPagamento, DPA.horas, DPA.valor, DP.total FROM demonstrativoPagamento AS DP
	INNER JOIN
	demonstrativoPagamentoAulas AS DPA
	on DP.idDemonstrativoPagamento = DPA.demonstrativoPagamento_idDemonstrativoPagamento
	where DP.professor_idProfessor = ".$idProfessor." AND DP.mes = ".$mes." AND DP.ano = ".$ano." AND DP.tipoDemo = 1 AND DPA.planoAcaoGrupo_idPlanoAcaoGrupo in (".$todosPAG.")";
//	echo $sql5;

	 $result5 = $this -> query($sql5);
	 
	  while ( $valor5 = mysqli_fetch_array($result5)) {
		  $html3 .= "<div>".Uteis::formatarMoeda($valor5['valor'])."</div>";
		
		  $html6 .= "<div>";
		  $totalProfessor = ($valor5['horas'] / 60) * $valor5['valor'];
		  
		  $totalPagamento += $totalProfessor;
		  $html6 .= Uteis::formatarMoeda($totalProfessor)."</div>";
	      $xPagProfessor   += $totalProfessor;
		  
	  } // Fim pagamento professor
	} // Fim While Professor
	
		if ($apenasLinha) {

					$col = array();
     				$col[] = $nome;
					$col[] = Uteis::formatarMoeda($valCurso);
					$col[] = Uteis::exibirHoras($totalHoras);
					$col[] = Uteis::formatarMoeda($premiacao);
					$col[] = "";
					$col[] = "<td>".$cobradoPrevisto."</td>";
					$col[] = "<td>".$html2."</td>";
					
                    $col[] = $html3."";
					$col[] = $html4."";
					$col[] = $html5;
					$html = $col;
					break;

				} else {
        $html .= "<tr>";
        $html .= "<td >" . $nome . "</td>";
		$html .= "<td align='center'>".Uteis::formatarMoeda($valCurso)." </td>";
		$html .= "<td align='center'>".Uteis::exibirHoras($totalHoras)." </td>";
		$html .=  "<td>".$html2."</td>";
		$html .= "<td>".$html3."</td>";
		$html .= "<td>".$html6."</td>";
		$html .= "<td align='center'>".Uteis::formatarMoeda($premiacao)." </td>";
		$html .= "<td>".Uteis::formatarMoeda($totalPagamento)."</td>";
			$cobradoPrevisto = round(($totalPagamento/$valCurso) * 100, 2)."%";
		
		$html .= "<td>".$cobradoPrevisto."</td>";
		
 	    $html .= "<td>".$html4."</td>";
        $html .= "<td>".$html5."</td>";
		
		$html .= "</tr>";
        }
		
		$totalPagamentoGeral += $totalPagamento;
	
		 
	 	} // FIM WHILE PRINCIPAL
	}
	
	$html .= "</tbody>";
	  $html .= "  <tfoot>
    <tr>
     <th></th>
      <th>Valor Total Cobrado: <br>".Uteis::formatarMoeda($totalValCurso)."</th>
      <th>Total Horas Cobradas: <br>".Uteis::exibirHoras($totalTotalHoras)."</th>
      <th></th>
	  <th></th>  
	  <th>Pagamento Total Aulas: <br>" .Uteis::formatarMoeda($xPagProfessor)."</th>
	  <th>Total de premiação: ".Uteis::formatarMoeda($totalPremiacao)."</th>
	  <th>Total Pagamento Geral:".Uteis::formatarMoeda($totalPagamentoGeral)."</th>
      <th></th>
	  <th>Horas Realizadas: <br>".Uteis::exibirHoras($totalHoraRealizada)."</th>
      <th>Total Horas Repostas: <br>".Uteis::exibirHoras($totalReposicao)."</th> 
    </tr>
  </tfoot>";
 
   $colunas = array("Grupo", "Valor Cobrado", "Total Horas Cobradas", "Professor", "Valor Hora", "Professor Aulas + Reposicao", "Premiação", "Total Pago",  "% Custo Prof", "Horas Realizadas", "Horas Repostas");
    $html_base = $this -> montaTb($colunas, $excel,"",$comparativo);

    return $html_base . $html;
  }
  
  
}