<?php
class ComplementoAbordagem extends Database {
	// class attributes
	var $idComplementoAbordagem;
	var $item;
	var $inativo;
	var $padrao;
	var $nome;
	var $excluido;
	var $portalProfessor;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idComplementoAbordagem = "NULL";
		$this -> item = "NULL";
		$this -> inativo = "NULL";
		$this -> padrao = "NULL";
		$this -> nome = "NULL";
		$this -> excluido = "0";
		$this -> portalProfessor = "0";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdComplementoAbordagem($value) {
		$this -> idComplementoAbordagem = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setItem($value) {
		$this -> item = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setPadrao($value) {
		$this -> padrao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
	
	function setPortalProfessor($value) {
		$this -> portaProfessor = ($value) ? $this -> gravarBD($value) : "0";
	}
	
    function getNome(){
   	    return $this->nome;
 	}
  
    function getItem(){
    	return $this->item;
    }
	
	/**
	 * addComplementoAbordagem() Function
	 */
	function addComplementoAbordagem() {
		$sql = "INSERT INTO ComplementoAbordagem (item, inativo, padrao, nome, excluido, portalProfessor) VALUES ($this->item, $this->inativo, $this->padrao, $this->nome, $this->excluido, $this->portalProfessor)";
		echo $sql;
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteComplementoAbordagem() Function
	 */
	function deleteComplementoAbordagem() {
		$sql = "DELETE FROM ComplementoAbordagem WHERE idComplementoAbordagem = $this->idComplementoAbordagem";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldComplementoAbordagem() Function
	 */
	function updateFieldComplementoAbordagem($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE ComplementoAbordagem SET " . $field . " = " . $value . " WHERE idComplementoAbordagem = $this->idComplementoAbordagem";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateComplementoAbordagem() Function
	 */
	function updateComplementoAbordagem() {
		$sql = "UPDATE ComplementoAbordagem SET item = $this->item, inativo = $this->inativo, padrao = $this->padrao, nome = $this->nome, portalProfessor = $this->portalProfessor WHERE idComplementoAbordagem = $this->idComplementoAbordagem";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectComplementoAbordagem() Function
	 */
	function selectComplementoAbordagem($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idComplementoAbordagem, item, inativo, padrao, nome, excluido, portalProfessor FROM ComplementoAbordagem " . $where;
    echo $sql;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectComplementoAbordagemTr() Function
	 */
	function selectComplementoAbordagemTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idComplementoAbordagem, item, inativo, padrao, nome, excluido, portalProfessor FROM ComplementoAbordagem " . $where;
	//	echo $sql;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idComplementoAbordagem = $valor['idComplementoAbordagem'];
				$item = $valor['item'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
				$padrao = Uteis::exibirStatus($valor['padrao']);
				$nome = $valor['nome'];

				$html .= "<td>" . $idComplementoAbordagem . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idComplementoAbordagem'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>" . $inativo . "</td>";
				$html .= "<td>" . $padrao . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idComplementoAbordagem'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectComplementoAbordagemSelect() Function
	 */
	function selectComplementoAbordagemSelect($classes = "", $idAtual = 0, $and = "") {
		$sql = "SELECT SQL_CACHE idComplementoAbordagem, item, padrao, nome FROM ComplementoAbordagem WHERE inativo = 0 " . $and . " ORDER BY nome ";
		$result = $this -> query($sql);
		$html = "<select id=\"idComplementoAbordagem\" name=\"idComplementoAbordagem\" class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";

		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idComplementoAbordagem'] ? "selected=\"selected\"" : "";
			$padrao = $valor['padrao'] ? " (padrão)" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idComplementoAbordagem'] . "\">" . $valor['nome'] . $padrao . "</option>";
		}
		$html .= "</select>";
		return $html;
	}
  
  function selectAbordagemCheckbox($idPlanoAcao, $idIdioma, $addQuery = "",$portalP, $div = "") {

    $sql = "SELECT SQL_CACHE idComplementoAbordagem, item, padrao, nome FROM ComplementoAbordagem WHERE excluido = 0 AND inativo = 0 " . $addQuery . "";
	if ($portalP == 1) {
		$sql .= " AND portalProfessor = 1";	
	}
	
	$sql .= " ORDER BY nome";
	//echo $sql;
    $result = $this -> query($sql);
    
    $idioma = new Idioma();

    $PlanoAcaoComplemento = new PlanoAcaoComplemento();

    if (mysqli_num_rows($result) > 0) {
      $html = "";

      //CONSULTA SE HÁ ALGUM complemento cadastrado
      $where = " WHERE planoAcao_idPlanoAcao = " . $idPlanoAcao;
      $Acompanhamento = $PlanoAcaoComplemento -> selectPlanoAcaoComplemento($where);

      while ($valor = mysqli_fetch_array($result)) {

        if ($Acompanhamento) {
          $where = " WHERE planoAcao_idPlanoAcao = " . $idPlanoAcao . " AND complementoAbordagem_idComplementoAbordagem = " . $valor['idComplementoAbordagem'];
          $checked = $PlanoAcaoComplemento -> selectPlanoAcaoComplemento($where) ? " checked " : "";
        } 

        $html .= "<div  >";

        $html .= "<img id=\"".$div."img_abordagem_" . $valor['idComplementoAbordagem'] . "\" src=\"" . CAMINHO_IMG . ($checked == "" ? "mais" : "menos") . ".png\" onclick=\"abrirFormulario('".$div."div_abordagem_" . $valor['idComplementoAbordagem'] . "', '".$div."img_abordagem_" . $valor['idComplementoAbordagem'] . "')\" style=\"float:left; margin-right:10px;\" />";

        $html .= "<label for=\"check_abordagem_" . $valor['idComplementoAbordagem'] . "\">";

        $html .= "<input type=\"checkbox\" id=\"".$div."check_abordagem_" . $valor['idComplementoAbordagem'] . "\" name=\"".$div."check_abordagem_" . $valor['idComplementoAbordagem'] . "\" $checked value=\"1\" />";

        $html .= "<strong>" . strtoupper($valor['nome']) . "</strong> ";

        $html .= "</label>";

        $html .= "<div id=\"".$div."div_abordagem_" . $valor['idComplementoAbordagem'] . "\" style=\"display:" . ($checked == "" ? "none" : "block") . "; padding:1em; text-align:justify;\" >" . $valor['item'] . "</div></div><br/><br/>";
      }
    }
    return $html;
  }

}