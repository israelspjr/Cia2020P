<?php
class Grafico extends Database {
 
  // constructor
  function __construct() {
    parent::__construct();
  }

  function __destruct() {
    parent::__destruct();
  }
  
  function GraficoJson($dados = array(), $gabarito = array()){           
       foreach($dados as $k => $valor):   
            $colunas[] = array("id"=>$valor['id'],"label"=>$valor['nome'], "pattern"=>$valor['pat'],"type"=>$valor['tipo']);  
            $linhas[] = array("c"=>array("v"=>$valor['nota'],"f"=>$valor['porcentagem']));  
       endforeach;                       
       $grafico = array("cols"=>$colunas,"rows"=>$linhas);
       json_encode($grafico); 
  }

  function TabelaGraficoPSA($gerente, $where, $exibir = false){
            
        $where = " WHERE PIG.finalizado = 1 " . $where;
        $sql_id = "SELECT PIG.idPsaIntegranteGrupo FROM psaIntegranteGrupo AS PIG " . $where;
        $sql_corpo = " FROM psaIntegranteGrupo AS PIG 
        LEFT JOIN integranteGrupo AS IG ON IG.idIntegranteGrupo = PIG.integranteGrupo_idIntegranteGrupo
        INNER JOIN planoAcaoGrupo AS PAG ON IG.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo
        INNER JOIN grupo AS G ON PAG.grupo_idGrupo = G.idGrupo
        INNER JOIN grupoClientePj AS GCNPJ ON GCNPJ.grupo_idGrupo = G.idGrupo
        INNER JOIN gerenteTem AS GER ON GER.clientePj_idClientePj = GCNPJ.clientePj_idClientePj
        LEFT JOIN clientePf AS CPF ON CPF.idClientePf = IG.clientePf_idClientePf ";

    $sql = "SELECT SQL_CACHE PIG.idPsaIntegranteGrupo, G.idGrupo, G.nome AS Grupo, CPF.nome AS nomeAluno, PIG.dataReferencia, CPF.idClientePf ".$sql_corpo.$where.$gerente." group by Grupo";
    $result = $this -> query($sql);
     
    while ($valor = $this -> fetchArray($result)) {
     $sql_grupo = "SELECT SQL_CACHE COUNT(PIG.idPsaIntegranteGrupo) AS integrantesGrupo ".$sql_corpo.$where.$gerente." AND G.idGrupo =".$valor['idGrupo']." group by idGrupo";
     $result2 = $this -> query($sql_grupo);   
     $grupo = $this -> fetchArray($result2);
 //    Uteis::pr($grupo); 
    }
  } 









}