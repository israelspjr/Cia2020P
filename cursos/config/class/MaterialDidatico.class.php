<?php
class MaterialDidatico extends Database {
	// class attributes
	var $idMaterialDidatico;
	var $editoraMaterialDidaticoIdEditoraMaterialDidatico;
	var $materialDidaticoTipoIdMaterialDidaticoTipo;
	var $idiomaIdIdioma;
	var $isbn;
	var $valor;
	var $opcional;
	var $dataCadastro;
	var $obs;
	var $inativo;
	var $nome;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idMaterialDidatico = "NULL";
		$this -> editoraMaterialDidaticoIdEditoraMaterialDidatico = "NULL";
		$this -> materialDidaticoTipoIdMaterialDidaticoTipo = "NULL";
		$this -> idiomaIdIdioma = "NULL";
		$this -> isbn = "NULL";
		$this -> valor = "NULL";
		$this -> opcional = "0";
		$this -> dataCadastro = "'" . date('Y-m-d H:i:s') . "'";
		$this -> obs = "NULL";
		$this -> inativo = "NULL";
		$this -> nome = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdMaterialDidatico($value) {
		$this -> idMaterialDidatico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setEditoraMaterialDidaticoIdEditoraMaterialDidatico($value) {
		$this -> editoraMaterialDidaticoIdEditoraMaterialDidatico = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMaterialDidaticoTipoIdMaterialDidaticoTipo($value) {
		$this -> materialDidaticoTipoIdMaterialDidaticoTipo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIdiomaIdIdioma($value) {
		$this -> idiomaIdIdioma = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setIsbn($value) {
		$this -> isbn = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
	}

	function setOpcional($value) {
		$this -> opcional = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}

	/**
	 * addMaterialDidatico() Function
	 */
	function addMaterialDidatico() {
		$sql = "INSERT INTO materialDidatico (editoraMaterialDidatico_idEditoraMaterialDidatico, materialDidaticoTipo_idMaterialDidaticoTipo, idioma_idIdioma, isbn, valor, opcional, dataCadastro, obs, inativo, nome, excluido) VALUES ($this->editoraMaterialDidaticoIdEditoraMaterialDidatico, $this->materialDidaticoTipoIdMaterialDidaticoTipo, $this->idiomaIdIdioma, $this->isbn, $this->valor, $this->opcional, '" . date('Y-m-y H:i:s') . "', $this->obs, $this->inativo, $this->nome, $this->excluido)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteMaterialDidatico() Function
	 */
	function deleteMaterialDidatico() {
		$sql = "DELETE FROM materialDidatico WHERE idMaterialDidatico = $this->idMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldMaterialDidatico() Function
	 */
	function updateFieldMaterialDidatico($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE materialDidatico SET " . $field . " = " . $value . " WHERE idMaterialDidatico = $this->idMaterialDidatico";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateMaterialDidatico() Function
	 */
	function updateMaterialDidatico() {
		$sql = "UPDATE materialDidatico SET editoraMaterialDidatico_idEditoraMaterialDidatico = $this->editoraMaterialDidaticoIdEditoraMaterialDidatico, materialDidaticoTipo_idMaterialDidaticoTipo = $this->materialDidaticoTipoIdMaterialDidaticoTipo, idioma_idIdioma = $this->idiomaIdIdioma, isbn = $this->isbn, valor = $this->valor, opcional = $this->opcional,obs = $this->obs, inativo = $this->inativo, nome = $this->nome WHERE idMaterialDidatico = $this->idMaterialDidatico";

		$result = $this -> query($sql, true);
	}

	/**
	 * selectMaterialDidatico() Function
	 */
	function selectMaterialDidatico($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idMaterialDidatico, editoraMaterialDidatico_idEditoraMaterialDidatico, materialDidaticoTipo_idMaterialDidaticoTipo, idioma_idIdioma, isbn, valor, opcional, dataCadastro, obs, inativo, nome, excluido FROM materialDidatico " . $where;
	//	echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectMaterialDidaticoTr() Function
	 */
	function selectMaterialDidaticoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {

		$sql = "SELECT SQL_CACHE m.idMaterialDidatico, m.editoraMaterialDidatico_idEditoraMaterialDidatico, m.materialDidaticoTipo_idMaterialDidaticoTipo, m.idioma_idIdioma, m.isbn, m.valor, m.opcional, m.dataCadastro, m.obs, m.inativo, m.nome, m.excluido, i.idioma nomeIdioma, md.tipo as nomeMaterialDidaticoTipo, e.editora as nomeEditoraMaterialDidatico  FROM materialDidatico m 
		INNER JOIN editoraMaterialDidatico e ON e.idEditoraMaterialDidatico=m.editoraMaterialDidatico_idEditoraMaterialDidatico 
		INNER JOIN tipoMaterialDidatico md ON md.idTipoMaterialDidatico = m.materialDidaticoTipo_idMaterialDidaticoTipo 
		INNER JOIN idioma i ON i.idIdioma = m.idioma_idIdioma " . $where;

		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {

				$html .= "<tr>";

				$idMaterialDidatico = $valor['idMaterialDidatico'];
				$nome = $valor['nome'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				//
				$nomeEditoraMaterialDidatico = $valor['nomeEditoraMaterialDidatico'];
				$nomeMaterialDidaticoTipo = $valor['nomeMaterialDidaticoTipo'];
				$nomeIdioma = $valor['nomeIdioma'];
				$valor_ = Uteis::formatarMoeda($valor['valor']);

				$onclick = " onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idMaterialDidatico'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" ";

				$html .= "<td $onclick >" . $nome . "</td>";
				$html .= "<td $onclick >" . $nomeMaterialDidaticoTipo . "</td>";
				$html .= "<td $onclick >" . $nomeEditoraMaterialDidatico . "</td>";
				$html .= "<td $onclick >" . $nomeIdioma . "</td>";
				$html .= "<td $onclick >" . $valor_ . "</td>";
				$html .= "<td $onclick >" . $inativo . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idMaterialDidatico'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	function selectMaterialDidaticoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE DISTINCT(idMaterialDidatico) AS idMaterialDidatico, valor, nome, E.editora, T.tipo ";
		$sql .= "FROM materialDidatico AS M ";
		$sql .= "LEFT JOIN materialDidaticoINF AS MDINF ON MDINF.materialDidatico_idMaterialDidatico = M.idMaterialDidatico ";
		$sql .= "LEFT JOIN relacionamentoINF AS INF ON INF.idRelacionamentoINF = MDINF.relacionamentoINF_idRelacionamentoINF ";
		$sql .= "LEFT JOIN tipoMaterialDidatico AS T ON T.idTipoMaterialDidatico = M.materialDidaticoTipo_idMaterialDidaticoTipo ";
		$sql .= "LEFT JOIN editoraMaterialDidatico AS E ON E.idEditoraMaterialDidatico = M.editoraMaterialDidatico_idEditoraMaterialDidatico ";
		$sql .= $where . " ORDER BY nome";
	//	echo $sql;
		$result = $this -> query($sql);

		$html = "<select id=\"idMaterialDidatico\" name=\"idMaterialDidatico\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";

		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idMaterialDidatico'] ? "selected=\"selected\"" : "";
			$material = $valor['nome'];
			$material .= " - R$ " . Uteis::formatarMoeda($valor['valor']);
			$material .= ($valor['editora'] ? " - " . $valor['editora'] : "");
			$material .= ($valor['tipo'] ? " - " . $valor['tipo'] : "");
			$html .= "<option " . $selecionado . " value=\"" . $valor['idMaterialDidatico'] . "\">" . $material . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

	function selectMaterialDidaticoSelect2($idAtual = 0, $where = "") {
    	$sql = "SELECT SQL_CACHE M.idMaterialDidatico, nome, T.tipo, I.idioma ";
    	$sql .= "FROM materialDidatico AS M ";
    	$sql .= "LEFT JOIN materialDidaticoINF AS MDINF ON MDINF.materialDidatico_idMaterialDidatico = M.idMaterialDidatico ";
    	$sql .= "LEFT JOIN relacionamentoINF AS INF ON INF.idRelacionamentoINF = MDINF.relacionamentoINF_idRelacionamentoINF ";
    	$sql .= "LEFT JOIN tipoMaterialDidatico AS T ON T.idTipoMaterialDidatico = M.materialDidaticoTipo_idMaterialDidaticoTipo ";
    	$sql .= "LEFT JOIN editoraMaterialDidatico AS E ON E.idEditoraMaterialDidatico = M.editoraMaterialDidatico_idEditoraMaterialDidatico ";
 	   $sql .= "INNER JOIN idioma AS I ON M.idioma_ididioma = I.idIdioma ";
   	   $sql .= $where . " ORDER BY nome";
    
  	  //echo $sql;
   	   $result = $this -> query($sql);
	
    $html = "<select id=\"idMaterialDidatico\" name=\"idMaterialDidatico\" class=\"required\" >";
    $html .= "<option value=\"\">Selecione</option>";

    while ($valor = mysqli_fetch_array($result)) {
      $selecionado = $idAtual == $valor['idMaterialDidatico'] ? "selected=\"selected\"" : "";
      $material = $valor['nome'];
      $material .= ($valor['tipo'] ? " - " . $valor['tipo'] : "");
      $material .= ($valor['idioma'] ? " - " . $valor['idioma'] : "");
      $html .= "<option " . $selecionado . " value=\"" . $valor['idMaterialDidatico'] . "\">" . $material . "</option>";
    }
  	  $html .= "</select>";
    return $html;
  }
  
	function selectMaterialDidatico_itens($where = "") {

		$sql = " SELECT MD.idMaterialDidatico, MD.nome, EMD.editora, TMD.tipo, MD.valor FROM planoAcaoGrupo AS PAG 
		INNER JOIN planoAcaoGrupoMaterialDidatico AS PAMD ON PAMD.planoAcaoGrupo_idPlanoAcaoGrupo = PAG.idPlanoAcaoGrupo 
		INNER JOIN materialDidatico AS MD ON MD.idMaterialDidatico = PAMD.materialDidatico_idMaterialDidatico 
		LEFT JOIN editoraMaterialDidatico AS EMD ON EMD.idEditoraMaterialDidatico = MD.materialDidaticoTipo_idMaterialDidaticoTipo 
		LEFT JOIN tipoMaterialDidatico AS TMD ON TMD.idTipoMaterialDidatico = MD.materialDidaticoTipo_idMaterialDidaticoTipo 
		".$where;
		return Uteis::executarQuery($sql);

	}
	
	function selectJoin($where){
		$sql = " SELECT MD.idMaterialDidatico, MD.nome, EMD.editora, TMD.tipo, MD.valor, MD.isbn, MD.obs 
		FROM materialDidatico AS MD 
	    INNER JOIN
    editoraMaterialDidatico AS EMD ON EMD.idEditoraMaterialDidatico = MD.editoraMaterialDidatico_idEditoraMaterialDidatico
        INNER JOIN
    tipoMaterialDidatico AS TMD ON TMD.idTipoMaterialDidatico = MD.materialDidaticoTipo_idMaterialDidaticoTipo
      INNER JOIN
    materialDidaticoINF AS MDINF on MDINF.materialDidatico_idMaterialDidatico = MD.idMaterialDidatico
		INNER JOIN
    relacionamentoINF AS INF ON MDINF.relacionamentoINF_idRelacionamentoINF = INF.idRelacionamentoINF
		".$where;
	//	echo $sql;
		return Uteis::executarQuery($sql);
	}
	
	function montaMaterial($id, $apostila = false){
		$rs = $this->selectJoin(" WHERE MD.idMaterialDidatico = $id ");
		if($apostila)
        return $rs[0]['tipo']." - Valor: ".Uteis::formatarMoeda($rs[0]['valor']);   
            else
		return $rs[0]['nome']." - ".$rs[0]['editora']." - ".$rs[0]['tipo']." - ISBN: ".$rs[0]['isbn'];
	}

}
?>