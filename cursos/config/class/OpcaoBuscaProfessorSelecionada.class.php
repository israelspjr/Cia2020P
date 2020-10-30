<?php
class OpcaoBuscaProfessorSelecionada extends Database {
	// class attributes
	var $idOpcaoBuscaProfessorSelecionada;
	var $buscaProfessorIdBuscaProfessor;
	var $professorIdProfessor;
	var $aceito;
	var $obs;
	var $motivo;
	var $valorHora;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idOpcaoBuscaProfessorSelecionada = "NULL";
		$this -> buscaProfessorIdBuscaProfessor = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> aceito = "NULL";
		$this -> obs = "NULL";
		$this -> motivo = "NULL";
		$this -> valorHora = "NULL";
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdOpcaoBuscaProfessorSelecionada($value) {
		$this -> idOpcaoBuscaProfessorSelecionada = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setBuscaProfessorIdBuscaProfessor($value) {
		$this -> buscaProfessorIdBuscaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAceito($value) {
		$this -> aceito = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setObs($value) {
		$this -> obs = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMotivo($value) {
		$this -> motivo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	
	function setValorHora($value) {
		$this -> valorHora = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	//
	//	 * addOpcaoBuscaProfessorSelecionada() Function
	//
	function addOpcaoBuscaProfessorSelecionada() {
		$sql = "INSERT INTO opcaoBuscaProfessorSelecionada (buscaProfessor_idBuscaProfessor, professor_idProfessor, aceito, obs, motivo, valorHora) VALUES ($this->buscaProfessorIdBuscaProfessor, $this->professorIdProfessor, $this->aceito, $this->obs, $this->motivo, $this->valorHora)";
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	//	 * deleteOpcaoBuscaProfessorSelecionada() Function
	//
	function deleteOpcaoBuscaProfessorSelecionada($where="") {
		$sql = "DELETE FROM opcaoBuscaProfessorSelecionada WHERE idOpcaoBuscaProfessorSelecionada = $this->idOpcaoBuscaProfessorSelecionada OR ".$where;
		$result = $this -> query($sql);
        return $result;
	}

	//	 * updateFieldOpcaoBuscaProfessorSelecionada() Function
	//
	function updateFieldOpcaoBuscaProfessorSelecionada($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE opcaoBuscaProfessorSelecionada SET " . $field . " = " . $value . " WHERE idOpcaoBuscaProfessorSelecionada = $this->idOpcaoBuscaProfessorSelecionada";
		$result = $this -> query($sql, true);
	}

	//	 * updateOpcaoBuscaProfessorSelecionada() Function
	//
	function updateOpcaoBuscaProfessorSelecionada() {
		$sql = "UPDATE opcaoBuscaProfessorSelecionada SET buscaProfessor_idBuscaProfessor = $this->buscaProfessorIdBuscaProfessor, professor_idProfessor = $this->professorIdProfessor, aceito = $this->aceito, obs = $this->obs, motivo = $this->motivo, valorHora = $this->valorHora WHERE idOpcaoBuscaProfessorSelecionada = $this->idOpcaoBuscaProfessorSelecionada";
		$result = $this -> query($sql, true);
	}

	//	 * selectOpcaoBuscaProfessorSelecionada() Function
	//
	function selectOpcaoBuscaProfessorSelecionada($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idOpcaoBuscaProfessorSelecionada, buscaProfessor_idBuscaProfessor, professor_idProfessor, aceito, obs, motivo, valorHora FROM opcaoBuscaProfessorSelecionada " . $where;
		//echo $sql;
		return $this -> executeQuery($sql);
	}

	function selectOpcaoBuscaProfessorSelecionadaTr($where) {
		$Professor = new Professor();
		$sql = "SELECT SQL_CACHE o.idOpcaoBuscaProfessorSelecionada, o.buscaProfessor_idBuscaProfessor, o.professor_idProfessor,o.aceito, o.obs, o.motivo, o.valorHora, p.nome FROM opcaoBuscaProfessorSelecionada o INNER JOIN professor p ON  professor_idProfessor - idProfessor " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";
				$html .= "<td>" . $valor['nome'] . "</td>";
				if ($valor['valorHora'] != '') {
				$html .= "<td>" . $Professor -> getPlanoCarreira($valor['professor_idProfessor'], $idIdioma) . "</td>";
				} else {
				$html .= "<td>" . $valor['valorHora']. "</td>";			
				}
				$html .= "</tr>";
			}
		}
		return $html;
	}

	function upAceito() {
	        
	    $this -> query("UPDATE opcaoBuscaProfessorSelecionada SET aceito = 2, motivo = $this->motivo WHERE buscaProfessor_idBuscaProfessor = $this->buscaProfessorIdBuscaProfessor AND professor_idProfessor = $this->professorIdProfessor");
        $rs = mysqli_fetch_array($this -> query("SELECT SQL_CACHE idOpcaoBuscaProfessorSelecionada FROM opcaoBuscaProfessorSelecionada WHERE buscaProfessor_idBuscaProfessor = $this->buscaProfessorIdBuscaProfessor AND professor_idProfessor = $this->professorIdProfessor"));

		return $rs['idOpcaoBuscaProfessorSelecionada'];
	}
    
    function upRejeito() {
           
       $this -> query("UPDATE opcaoBuscaProfessorSelecionada SET aceito = 3, motivo = $this->motivo WHERE buscaProfessor_idBuscaProfessor = $this->buscaProfessorIdBuscaProfessor AND professor_idProfessor = $this->professorIdProfessor");
       $rs = mysqli_fetch_array($this -> query("SELECT SQL_CACHE idOpcaoBuscaProfessorSelecionada FROM opcaoBuscaProfessorSelecionada WHERE buscaProfessor_idBuscaProfessor = $this->buscaProfessorIdBuscaProfessor AND professor_idProfessor = $this->professorIdProfessor"));

      return $rs['idOpcaoBuscaProfessorSelecionada'];
    }

    function upEscolha() {        
           $this -> query("UPDATE opcaoBuscaProfessorSelecionada SET aceito = 2 WHERE buscaProfessor_idBuscaProfessor = $this->buscaProfessorIdBuscaProfessor AND aceito = 1");
           $this -> query("UPDATE opcaoBuscaProfessorSelecionada SET aceito = 1 WHERE buscaProfessor_idBuscaProfessor = $this->buscaProfessorIdBuscaProfessor AND professor_idProfessor = $this->professorIdProfessor");
            $rs = mysqli_fetch_array($this -> query("SELECT SQL_CACHE idOpcaoBuscaProfessorSelecionada FROM opcaoBuscaProfessorSelecionada WHERE buscaProfessor_idBuscaProfessor = $this->buscaProfessorIdBuscaProfessor AND professor_idProfessor = $this->professorIdProfessor"));

        return $rs['idOpcaoBuscaProfessorSelecionada'];
    }

	function professorDoDia($idBuscaProfessor) {

		$sql = " SELECT SQL_CACHE DISTINCT(P.idProfessor), P.nome
		FROM opcaoBuscaProfessorSelecionada AS OBP 
		LEFT JOIN professor AS P ON P.idProfessor	= OBP.professor_idProfessor
		WHERE OBP.aceito = 1 AND OBP.buscaProfessor_idBuscaProfessor = $idBuscaProfessor";
		$rs = Uteis::executarQuery($sql);
		return $rs[0]['nome'] ? $rs[0]['nome'] : "";
	}

}
?>