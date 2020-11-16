<?php
class ProdutoAdicional extends Database {
	// class attributes
	var $idProdutoAdicional;
	var $nome;
	var $valor;
    var $porHora;
    var $descricao;
	var $inativo;
	var $excluido;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idProdutoAdicional = "NULL";
		$this -> nome = "NULL";    
        $this -> descricao = "NULL";
		$this -> valor = "NULL";
        $this -> porHora = "0";
		$this -> inativo = "NULL";
		$this -> excluido = "0";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdProdutoAdicional($value) {
		$this -> idProdutoAdicional = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setNome($value) {
		$this -> nome = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this -> inativo = ($value) ? $this -> gravarBD($value) : "0";
	}

	function setExcluido($value) {
		$this -> excluido = ($value) ? $this -> gravarBD($value) : "0";
	}
    function setPorHora($value) {
        $this -> porHora = ($value) ? $this -> gravarBD($value) : "0";
    }
  
  function setDescricao($value) {
    $this -> descricao = ($value) ? $this -> gravarBD($value) : "NULL";
  }
  
  function getIdProdutoAdicional() {
    return $this -> idProdutoAdicional;
  }

  function getNome() {
    return $this -> nome;
  }

  function getValor() {
    return $this -> valor;
  }

  function getInativo() {
    return $this -> inativo;
  }

  function getExcluido() {
    return $this -> excluido;
  }
  
  function getPorHora() {
    return $this -> porHora;
  }
  
  function getDescricao() {
    return $this -> descricao;
  }
  
	/**
	 * addProdutoAdicional() Function
	 */
	function addProdutoAdicional() {
		$sql = "INSERT INTO produtoAdicional (nome, descricao, valor, inativo, excluido, porHora) VALUES ($this->nome, $this->descricao, $this->valor, $this->inativo, $this->excluido, $this->porHora)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deleteProdutoAdicional() Function
	 */
	function deleteProdutoAdicional() {
		$sql = "DELETE FROM produtoAdicional WHERE idProdutoAdicional = $this->idProdutoAdicional";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldProdutoAdicional() Function
	 */
	function updateFieldProdutoAdicional($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE produtoAdicional SET " . $field . " = " . $value . " WHERE idProdutoAdicional = $this->idProdutoAdicional";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateProdutoAdicional() Function
	 */
	function updateProdutoAdicional() {
		$sql = "UPDATE produtoAdicional SET nome = $this->nome, descricao = $this->descricao, valor = $this->valor, inativo = $this->inativo, porHora = $this->porHora WHERE idProdutoAdicional = $this->idProdutoAdicional";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectProdutoAdicional() Function
	 */
	function selectProdutoAdicional($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idProdutoAdicional, nome, descricao, valor, inativo, excluido, porHora FROM produtoAdicional " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectProdutoAdicionalTr() Function
	 */
	function selectProdutoAdicionalTrLista($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "", $idPai = "", $caminhoModulo = "") {
		$sql = "SELECT SQL_CACHE idProdutoAdicional, nome, valor, descricao, inativo, excluido, porHora FROM produtoAdicional " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$idProdutoAdicional = $valor['idProdutoAdicional'];
				$nome = $valor['nome'];
				$descricao = $valor['descricao'];
				$valor2 = $valor['valor'];
				$inativo = Uteis::exibirStatus(!$valor['inativo']);
                $porHora = Uteis::exibirStatus($valor['porHora']);
				//

				$html .= "<td>" . $idProdutoAdicional . "</td>";
				$html .= "<td class=\"link\" onclick=\"abrirNivelPagina(this, '" . $caminhoAbrir . "?id=" . $valor['idProdutoAdicional'] . $idPai . "', '" . $caminhoAtualizar . $idPai . "', '$ondeAtualiza')\" >" . $nome . "</td>";
				$html .= "<td>" . $descricao . "</td>";
                $html .= "<td>" . $valor2 . "</td>";
                $html .= "<td>" . $porHora . "</td>";
				$html .= "<td>" . $inativo . "</td>";                
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoModulo . "grava.php', " . $valor['idProdutoAdicional'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectProdutoAdicionalTr() Function
	 */
	function selectProdutoAdicionalTr($where = "") {
		$sql = "SELECT SQL_CACHE idProdutoAdicional, nome, descricao, inativo, valor FROM produtoAdicional" . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				$html .= "<td onclick=\"abrirNivelPagina(this, '" . CAMINHO_VENDAS . "/proposta/include/form/produtoAdicional.php?id=" . $valor['idProdutoAdicional'] . "', '" . CAMINHO_VENDAS . "index.php', '#centro')\" >" . ($valor['nome']) . "</td>";
				$html .= "<td>".$valor['descricao']."</td>";
				$html .= "<td>" . $valor['valor'] . "</td>";
				$ativo = $valor['inativo'] == 0 ? "ativo.png" : "inativo.png";
				$html .= "<td align=\"center\">" . "<img src=\"" . CAMINHO_IMG . $ativo . "\">" . "</td>";
				$html .= "</tr>";
			}
		}

		return $html;
	}

	/**
	 * selectProdutoAdicionalSelect() Function
	 */
	function selectProdutoAdicionalSelect($classes = "", $idAtual = 0, $and) {

		$sql = "SELECT SQL_CACHE idProdutoAdicional, nome, valor FROM produtoAdicional  WHERE inativo = 0 " . $and . " ORDER BY nome";
		$result = $this -> query($sql);
		$html = "<select id=\"idProdutoAdicional\" name=\"idProdutoAdicional\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idProdutoAdicional'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idProdutoAdicional'] . "\">" . ($valor['nome']) . " - R$" . $valor['valor'] . "</option>";
		}
		$html .= "</select>";
		return $html;
	}

}
?>