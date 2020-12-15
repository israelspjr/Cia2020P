<?php
class Gerente extends Database {
	// class attributes
	var $idGerente;
	var $funcionarioIdFuncionario;
	var $cor;
	var $dataCadastro;
	var $inativo;
	var $obs;
	
	// constructor
	function __construct() {
		parent::__construct();
		$this->idGerente = "NULL";
		$this->funcionarioIdFuncionario = "NULL";
		$this->cor = "NULL";
		$this->dataCadastro = "'".date('Y-m-d H:i:s')."'";
		$this->inativo = "0";
		$this->obs = "NULL";
		
	}

	function __destruct(){
		parent::__destruct();
	}

// class methods
	function setIdGerente($value) {
		$this->idGerente = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setFuncionarioIdFuncionario($value) {
		$this->funcionarioIdFuncionario = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setCor($value) {
		$this->cor = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setDataCadastro($value) {
		//$this->dataCadastro = ($value) ? $this->gravarBD($value) : "NULL";
	}

	function setInativo($value) {
		$this->inativo = ($value) ? $this->gravarBD($value) : "0";
	}

	function setObs($value) {
		$this->obs = ($value) ? $this->gravarBD($value) : "NULL";
	}

	/**
	 * addGerente() Function
	 */
	function addGerente() {
		$sql = "INSERT INTO gerente (funcionario_idFuncionario, cor, dataCadastro, inativo, obs) VALUES ($this->funcionarioIdFuncionario, $this->cor, $this->dataCadastro, $this->inativo, $this->obs)";
		$result = $this->query($sql, true);
		return $this->connect;
	}

	/**
	 * deleteGerente() Function
	 */
	function deleteGerente() {
		$sql = "DELETE FROM gerente WHERE idGerente = $this->idGerente";
		$result = $this->query($sql, true);
	}

	/**
	 * updateFieldGerente() Function
	 */
	function updateFieldGerente($field, $value) {
		$value = ($value != "NULL") ? $this->gravarBD($value) : $value;
        $sql = "UPDATE gerente SET ".$field." = ".$value." WHERE idGerente = $this->idGerente";
        $result = $this->query($sql, true);
    }

    /**
	 * updateGerente() Function
	 */
	function updateGerente() {
		$sql = "UPDATE gerente SET funcionario_idFuncionario = $this->funcionarioIdFuncionario, cor = $this->cor, inativo = $this->inativo, obs = $this->obs WHERE idGerente = $this->idGerente";
		$result = $this->query($sql, true);
	}

	/**
	 * selectGerente() Function
	 */
	function selectGerente($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idGerente, funcionario_idFuncionario, cor, dataCadastro, inativo, obs FROM gerente ".$where;
		echo $sql;
		$result = $this->query($sql);
		for ($i = 0; $i < $this->numRows($result); $i++) {
            $array[$i] = $this->fetchArray($result);
        }
        return $array;
	}
	
	/**
	 * selectGerenteTr() Function
	 */
	function selectGerenteTr() {
		$sql = "SELECT SQL_CACHE g.idGerente, f.nome, g.inativo, g.cor FROM funcionario f INNER JOIN gerente g ON f.idFuncionario = g.funcionario_idFuncionario ";
		$result = $this->query($sql);
		
		if(mysqli_num_rows($result) > 0){
			$html ="";
			while($valor = mysqli_fetch_array($result)){
				
				$onclick = "  onclick=\"abrirNivelPagina(this, '".CAMINHO_CAD."gerente/cadastro.php?id=".$valor['idGerente']."', '".CAMINHO_CAD."gerente/index.php', '#centro')\" ";
				
				$html .= "<tr>
				
				<td $onclick >".($valor['nome'])."</td>
				
				<td $onclick align=\"center\" >
					<div style=\"background-color:".$valor['cor']."; width:50%; height:5px;\" ></div>
				</td>
				
				<td $onclick align=\"center\">".Uteis::exibirStatus(!$valor['inativo'])."</td>
				
				</tr>";
			}
        }
		
        return $html;
	}
	
	function getIdGerentePorGrupo( $idGrupo ){
		
		$ClientePj = new ClientePj();
		$GerenteTem = new GerenteTem();
		
		$valor = $GerenteTem->selectGerenteTem(" WHERE (dataExclusao IS NULL OR dataExclusao = '') AND grupo_idGrupo = ".$idGrupo);	
		if( $valor ){
			return $valor[0]['gerente_idGerente'];
		}else{
			$idClientePj = $ClientePj->getIdClientePj_porGrupo($idGrupo);			
			$valor = $GerenteTem->selectGerenteTem(" WHERE (dataExclusao IS NULL OR dataExclusao = '') AND clientePj_idClientePj = ".$idClientePj);	
			if( $valor ) return $valor[0]['gerente_idGerente'];			
		}	
			
		return "0";
	}
	
	
	function getNomeGerente($idGerente){
		$Funcionario = new Funcionario();
		$nomeGerente = $this->selectGerente(" WHERE idGerente = ".$idGerente);
		$idFuncionario = $nomeGerente[0]['funcionario_idFuncionario'] ? $nomeGerente[0]['funcionario_idFuncionario'] : "0";
		$nomeGerente = $Funcionario->selectFuncionario(" WHERE idFuncionario = ".$idFuncionario);
		return $nomeGerente[0]['nomeExibicao'];		
	}
	
	function selectGerente_legenda(){
		
		$html = "";
		$rs = $this->selectGerente(" WHERE inativo = 0 ");
		if($rs){
			$html .= "<div style=\"float:right\">";
			foreach($rs as $valor){
				$html .= "<div class=\"legenda\" ><div class=\"legenda_box\" style=\"background-color:".$valor['cor']."\"></div>".$this->getNomeGerente($valor['idGerente'])."</div>";
			}	
			$html .= "</div>";
			$html .= "<div class=\"clear\"></div>";
		}
		
		return $html;
	}
	function selectGerenteSelect($classes = "", $idAtual = 0, $where = ""){
	  $sql = "SELECT SQL_CACHE G.idGerente FROM gerente AS G $where";
    $result = $this -> query($sql);
    $html = "<select id=\"idGerente\" name=\"idGerente[]\" style=\"height: 87px;\" class=\"" . $classes . "\" multiple=\"multiple\" >";
    $html .= "<option value=\"-\" ".(($idAtual==0)? "selected=\"selected\"":"").">Todos</option>";
    while ($valor = mysqli_fetch_array($result)) {
      $selecionado = $idAtual == $valor['idGerente'] ? "selected=\"selected\"" : "";
      $html .= "<option " . $selecionado . " value=\"" . $valor['idGerente'] . "\">" . $this->getNomeGerente($valor['idGerente']) . "</option>";
    }
    $html .= "</select>";
    return $html;
	}	
	
	function selectGerenteSimples($classes = "", $idAtual = 0, $where = ""){
	  $sql = "SELECT SQL_CACHE G.idGerente FROM gerente AS G $where";
    $result = $this -> query($sql);
    $html = "<select id=\"idGerente\" name=\"idGerente\"  class=\"" . $classes . "\"  >";
    $html .= "<option value=\"-\" ".(($idAtual==0)? "selected=\"selected\"":"").">Todos</option>";
    while ($valor = mysqli_fetch_array($result)) {
      $selecionado = $idAtual == $valor['idGerente'] ? "selected=\"selected\"" : "";
      $html .= "<option " . $selecionado . " value=\"" . $valor['idGerente'] . "\">" . $this->getNomeGerente($valor['idGerente']) . "</option>";
    }
    $html .= "</select>";
    return $html;
	}	
	
}?>