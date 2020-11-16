<?php
class ProdutoAdicionalValorSimuladoPlanoAcao extends Database {
	// class attributes
	var $idProdutoAdicionalValorSimuladoPlanoAcao;
	var $produtoAdicionalIdProdutoAdicional;
	var $valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao;
	
	// constructor
	function __construct() {
		parent::__construct();
		$this->idProdutoAdicionalValorSimuladoPlanoAcao = "NULL";
		$this->produtoAdicionalIdProdutoAdicional = "NULL";
		$this->valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao = "NULL";
		
	}

	function __destruct(){
		parent::__destruct();
	}

// class methods
	function setIdProdutoAdicionalValorSimuladoPlanoAcao($value) {
		$this->idProdutoAdicionalValorSimuladoPlanoAcao = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setProdutoAdicionalIdProdutoAdicional($value) {
		$this->produtoAdicionalIdProdutoAdicional = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setValorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao($value) {
		$this->valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addProdutoAdicionalValorSimuladoPlanoAcao() Function
	 */
	function addProdutoAdicionalValorSimuladoPlanoAcao() {
		$sql = "INSERT INTO produtoAdicionalValorSimuladoPlanoAcao (produtoAdicional_idProdutoAdicional, valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao) VALUES ($this->produtoAdicionalIdProdutoAdicional, $this->valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao)";
		$result = $this->query($sql, true);
		return $this->connect;
	}

	/**
	 * deleteProdutoAdicionalValorSimuladoPlanoAcao() Function
	 */
	function deleteProdutoAdicionalValorSimuladoPlanoAcao($where="") {
		$sql = "DELETE FROM produtoAdicionalValorSimuladoPlanoAcao WHERE idProdutoAdicionalValorSimuladoPlanoAcao = $this->idProdutoAdicionalValorSimuladoPlanoAcao ".$where;
		//echo $sql;
		$result = $this->query($sql, true);
	}

	/**
	 * updateFieldProdutoAdicionalValorSimuladoPlanoAcao() Function
	 */
	function updateFieldProdutoAdicionalValorSimuladoPlanoAcao($field, $value) {
		$value = ($value != "NULL") ? $this->gravarBD($value) : $value;
        $sql = "UPDATE produtoAdicionalValorSimuladoPlanoAcao SET ".$field." = ".$value." WHERE idProdutoAdicionalValorSimuladoPlanoAcao = $this->idProdutoAdicionalValorSimuladoPlanoAcao";
        $result = $this->query($sql, true);
    }

    /**
	 * updateProdutoAdicionalValorSimuladoPlanoAcao() Function
	 */
	function updateProdutoAdicionalValorSimuladoPlanoAcao() {
		$sql = "UPDATE produtoAdicionalValorSimuladoPlanoAcao SET produtoAdicional_idProdutoAdicional = $this->produtoAdicionalIdProdutoAdicional, valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao = $this->valorSimuladoPlanoAcaoIdValorSimuladoPlanoAcao WHERE idProdutoAdicionalValorSimuladoPlanoAcao = $this->idProdutoAdicionalValorSimuladoPlanoAcao";
		$result = $this->query($sql, true);
	}

	/**
	 * selectProdutoAdicionalValorSimuladoPlanoAcao() Function
	 */
	function selectProdutoAdicionalValorSimuladoPlanoAcao($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idProdutoAdicionalValorSimuladoPlanoAcao, produtoAdicional_idProdutoAdicional, valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao FROM produtoAdicionalValorSimuladoPlanoAcao ".$where;
		$result = $this->query($sql);
		for ($i = 0; $i < $this->numRows($result); $i++) {
            $array[$i] = $this->fetchArray($result);
        }
        return $array;
	}
	
	function selectProdutoAdicionalValorSimuladoPlanoAcaoTr($where = "") {
		
		$sql = " SELECT PV.idProdutoAdicionalValorSimuladoPlanoAcao, PA.nome, PA.inativo, PA.valor, PV.valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao FROM produtoAdicionalValorSimuladoPlanoAcao AS PV INNER JOIN produtoAdicional AS PA ON PV.produtoAdicional_idProdutoAdicional = PA.idProdutoAdicional  ".$where;
		//echo $sql;
		$result = $this->query($sql);
		
		if(mysqli_num_rows($result) > 0){
			
			
			
			$html = "";
			
			while($valor = mysqli_fetch_array($result)){
				
				$html .= "<tr>";				
				
				$html .= "<td  >".$valor['nome']."</td>";
				
				$html .= "<td  >R$ ".Uteis::formatarMoeda($valor['valor'])."</td>";
				
				$deleta = " onclick=\"deletaRegistro('".CAMINHO_VENDAS."planoAcao/include/acao/produtoAdicional.php', ".$valor['idProdutoAdicionalValorSimuladoPlanoAcao'].", '".CAMINHO_VENDAS."planoAcao/include/resourceHTML/produtoAdicional.php?id=".$valor['valorSimuladoPlanoAcao_idValorSimuladoPlanoAcao']."', '#div_lista_ProdutoAdicional')\" ";
				
				$html .= "<td $deleta >"."<center><img src=\"".CAMINHO_IMG."excluir.png\"></center>"."</td>";	
				
				
				$html .= "</tr>";
			}
        }
		return $html;
	}
		
}?>