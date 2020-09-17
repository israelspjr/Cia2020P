<?php
class MaterialDidaticPlanoAcao extends Database {
	// class attributes
	var $idMaterialDidaticPlanoAcao;
	var $materialDidaticoIdMaterialDidatico;
	var $planoAcaoIdPlanoAcao;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idMaterialDidaticPlanoAcao = "NULL";
		$this -> materialDidaticoIdMaterialDidatico = "NULL";
		$this -> planoAcaoIdPlanoAcao = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdMaterialDidaticPlanoAcao($value) {
		$this -> idMaterialDidaticPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMaterialDidaticoIdMaterialDidatico($value) {
		$this -> materialDidaticoIdMaterialDidatico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoIdPlanoAcao($value) {
		$this -> planoAcaoIdPlanoAcao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addMaterialDidaticPlanoAcao() Function
	 */
	function addMaterialDidaticPlanoAcao() {
		$sql = "INSERT INTO materialDidaticPlanoAcao (materialDidatico_idMaterialDidatico, planoAcao_idPlanoAcao) VALUES ($this->materialDidaticoIdMaterialDidatico, $this->planoAcaoIdPlanoAcao)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteMaterialDidaticPlanoAcao() Function
	 */
	function deleteMaterialDidaticPlanoAcao() {
		$sql = "DELETE FROM materialDidaticPlanoAcao WHERE idMaterialDidaticPlanoAcao = $this->idMaterialDidaticPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldMaterialDidaticPlanoAcao() Function
	 */
	function updateFieldMaterialDidaticPlanoAcao($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE materialDidaticPlanoAcao SET " . $field . " = " . $value . " WHERE idMaterialDidaticPlanoAcao = $this->idMaterialDidaticPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateMaterialDidaticPlanoAcao() Function
	 */
	function updateMaterialDidaticPlanoAcao() {
		$sql = "UPDATE materialDidaticPlanoAcao SET materialDidatico_idMaterialDidatico = $this->materialDidaticoIdMaterialDidatico, planoAcao_idPlanoAcao = $this->planoAcaoIdPlanoAcao WHERE idMaterialDidaticPlanoAcao = $this->idMaterialDidaticPlanoAcao";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectMaterialDidaticPlanoAcao() Function
	 */
	function selectMaterialDidaticPlanoAcao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idMaterialDidaticPlanoAcao, materialDidatico_idMaterialDidatico, planoAcao_idPlanoAcao FROM materialDidaticPlanoAcao " . $where;
		return $this -> executeQuery($sql);
	}

	function selectMaterialDidaticPlanoAcaoTr($where = "",$apenasVer) {

		$sql = "SELECT SQL_CACHE idMaterialDidaticPlanoAcao, M.nome, M.valor, planoAcao_idPlanoAcao, E.editora, T.tipo FROM materialDidaticPlanoAcao AS MP ";
		$sql .= " INNER JOIN materialDidatico AS M ON M.idMaterialDidatico = MP.materialDidatico_idMaterialDidatico ";
		$sql .= " LEFT JOIN tipoMaterialDidatico AS T ON T.idTipoMaterialDidatico = M.materialDidaticoTipo_idMaterialDidaticoTipo ";
		$sql .= " LEFT JOIN editoraMaterialDidatico AS E ON E.idEditoraMaterialDidatico = M.editoraMaterialDidatico_idEditoraMaterialDidatico " . $where;
		
	//	echo $sql;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				$html .= "<td >" . $valor['nome'] . "</td>";
				$html .= "<td >" . $valor['editora'] . "</td>";
				$html .= "<td >" . $valor['tipo'] . "</td>";
				$html .= "<td>" . Uteis::formatarMoeda($valor['valor']) . "</td>";
				
				if ($apenasVer != 1) {
				$html .= "<td onclick=\"deletaRegistro('" . CAMINHO_VENDAS . "planoAcao/include/acao/materialDidaticPlanoAcao.php', " . $valor['idMaterialDidaticPlanoAcao'] . ", '" . CAMINHO_VENDAS . "planoAcao/include/resourceHTML/materialDidaticPlanoAcao.php?id=" . $valor['planoAcao_idPlanoAcao'] . "', '#div_lista_MaterialDidaticPlanoAcao')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				} else {
				$html .= "<td></td>";
				}
				$html .= "</tr>";
			}
		}
		return $html;
	}
    function AcompanhamentoMaterialPlano($idPlanoAcaoGrupo, $idFolhaFrequencia, $abrir, $atualizar,$relatorio,$semTr, $semInicial){
				
	  $PlanoAcaoGrupo = new PlanoAcaoGrupo();
      $PlanoAcao = new PlanoAcao();  
      $pag = $PlanoAcaoGrupo->selectPlanoAcaoGrupo("WHERE idPlanoacaoGrupo = ".$idPlanoAcaoGrupo);
      $pa = $PlanoAcao->selectPlanoAcao("WHERE idPlanoAcao = ".$pag[0]['planoAcao_idPlanoAcao']);      
	  $idIdioma = $PlanoAcao->getIdIdioma($pag[0]['planoAcao_idPlanoAcao']);
      $idNivel = $pa[0]['nivelEstudo_IdNivelEstudo'];
      $idFoco = $pa[0]['focoCurso_idFocoCurso'];
	  
	  $where = "WHERE planoAcao_idPlanoAcao = ".$pag[0]['planoAcao_idPlanoAcao'];
      
   /*   $sql = "SELECT SQL_CACHE K.idKitMaterial, K.nome AS Ordem, K.inativo, MD.nome, MDINF.idMaterialDidaticoINF, MDINF.unidadeInicial, MDINF.unidadeFinal FROM kitMaterial AS K 
      INNER JOIN relacionamentoINF AS INF ON INF.idioma_idIdioma = ".$idIdioma." AND INF.nivelEstudo_IdNivelEstudo = ".$idNivel." AND INF.focoCurso_idFocoCurso = ".$idFoco." INNER JOIN kitMaterialINF AS KMINF ON KMINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF AND kitMaterial_idKitMaterial = K.idKitMaterial 
      INNER JOIN materialDidaticoINF AS MDINF ON MDINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = MDINF.materialDidatico_idMAterialDidatico WHERE K.inativo = 0 
      AND MDINF.unidadeInicial is not null AND MDINF.unidadeFinal is not null AND K.idKitMaterial =".$pa[0]['kitMaterial_idKitMaterial'];*/
	  $sql = "SELECT SQL_CACHE idMaterialDidaticPlanoAcao, M.nome, M.valor, planoAcao_idPlanoAcao, E.editora, T.tipo FROM materialDidaticPlanoAcao AS MP ";
		$sql .= " INNER JOIN materialDidatico AS M ON M.idMaterialDidatico = MP.materialDidatico_idMaterialDidatico ";
		$sql .= " LEFT JOIN tipoMaterialDidatico AS T ON T.idTipoMaterialDidatico = M.materialDidaticoTipo_idMaterialDidaticoTipo ";
		$sql .= " LEFT JOIN editoraMaterialDidatico AS E ON E.idEditoraMaterialDidatico = M.editoraMaterialDidatico_idEditoraMaterialDidatico " . $where;
		 if ($semTr == 1) {
		$sql .= " LIMIT 1";  
		  
	  }
	  
	  
   //    echo $sql;     
      $result = $this -> query($sql);     
      if (mysqli_num_rows($result) > 0) {
      
          $html = "";

            while ($valor = mysqli_fetch_array($result)) {
                $Material = new AcompanhamentoMaterial();
                $AM = $Material->selectAcompanhamentoMaterial("WHERE folhaFrequencia_idFolhaFrequencia =".$idFolhaFrequencia." AND materialDidaticPlanoAcao_idMaterialDidaticPlanoAcao = ".$valor['idMaterialDidaticPlanoAcao']);
               if ($AM[0]['idAcompanhamentoMaterial']) {
                    $onclick = "onclick=\"abrirNivelPagina(this, '".$abrir."?id=" . $AM[0]['idAcompanhamentoMaterial'] ."&idIdioma=".$idIdioma."&idNivel=".$idNivel."&idFoco=".$idFoco."','".$atualizar."?idFolhaFrequencia=".$idFolhaFrequencia."', '#div_ff_geral')\" ";
                }else{
                    $onclick = "onclick=\"abrirNivelPagina(this, '".$abrir."?idKit=".$valor['idKitMaterial']."&idFolhaFrequencia=".$idFolhaFrequencia."&idIdioma=".$idIdioma."&idNivel=".$idNivel."&idFoco=".$idFoco."','".$atualizar."?idFolhaFrequencia=".$idFolhaFrequencia."', '#div_ff_geral')\"";
                }
                
				if($semTr != 1) {
		        $html .= "<tr>";
				}
                
				$html .="
                <td id=\"AcompMat\" $onclick >" . $valor['nome'] . "</td>  ";
				if ($semInicial == 0 ) {              
                $html .= "<td $onclick>" . $valor['unidadeInicial'] . "</td>";                
				}
                $html .= "<td $onclick>" . $valor['unidadeFinal'] . "</td>                
                <td $onclick>" . (($AM[0]['unidade']!="")? $AM[0]['unidade']:"Pendente"). "</td>                
                <td $onclick>" . $AM[0]['obs'] . "</td>";
				
				 if($semTr != 1) {              
                $html .= "</tr>";
				 }
            }
        }
		
		if ($relatorio != 1) {
		
        return $html;
		
		} else {
			return	(($AM[0]['unidade']!="")? $AM[0]['unidade']:"Pendente");
		}
   
    }

    function selectMaterialDescricao($where, $padrao = true) {

    $sql = "SELECT SQL_CACHE idMaterialDidaticPlanoAcao, M.nome, M.valor, planoAcao_idPlanoAcao, E.editora, T.tipo FROM materialDidaticPlanoAcao AS MP ";
    $sql .= " INNER JOIN materialDidatico AS M ON M.idMaterialDidatico = MP.materialDidatico_idMaterialDidatico ";
    $sql .= " LEFT JOIN tipoMaterialDidatico AS T ON T.idTipoMaterialDidatico = M.materialDidaticoTipo_idMaterialDidaticoTipo ";
    $sql .= " LEFT JOIN editoraMaterialDidatico AS E ON E.idEditoraMaterialDidatico = M.editoraMaterialDidatico_idEditoraMaterialDidatico " . $where;
    
    //echo $sql;   
    $result = $this -> query($sql);
    $html = "";
    if (mysqli_num_rows($result) > 0) {            
        $html = "<pre>";
        while ($valor = mysqli_fetch_array($result)) {      
          $html .= $valor['nome']."\n";
        }
        $html .= "</pre>";
    }
    return $html;
  }
}
?>