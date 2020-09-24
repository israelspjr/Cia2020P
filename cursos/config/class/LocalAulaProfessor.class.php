<?php
class LocalAulaProfessor extends Database {
	// class attributes
	var $idLocalAulaProfessor;
	var $professorIdProfessor;
	var $zonaAtendimentoCidadeIdZonaAtendimentoCidade;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idLocalAulaProfessor = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> zonaAtendimentoCidadeIdZonaAtendimentoCidade = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdLocalAulaProfessor($value) {
		$this -> idLocalAulaProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setZonaAtendimentoCidadeIdZonaAtendimentoCidade($value) {
		$this -> zonaAtendimentoCidadeIdZonaAtendimentoCidade = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	/**
	 * addLocalAulaProfessor() Function
	 */
	function addLocalAulaProfessor() {
		$sql = "INSERT INTO localAulaProfessor (professor_idProfessor, zonaAtendimentoCidade_idZonaAtendimentoCidade) VALUES ($this->professorIdProfessor, $this->zonaAtendimentoCidadeIdZonaAtendimentoCidade)";
//		echo $sql;
		$result = $this -> query($sql, true);
		return mysqli_insert_id($this -> connect);
	}

	/**
	 * deleteLocalAulaProfessor() Function
	 */
	function deleteLocalAulaProfessor() {
		$sql = "DELETE FROM localAulaProfessor WHERE idLocalAulaProfessor = $this->idLocalAulaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldLocalAulaProfessor() Function
	 */
	function updateFieldLocalAulaProfessor($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE localAulaProfessor SET " . $field . " = " . $value . " WHERE idLocalAulaProfessor = $this->idLocalAulaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateLocalAulaProfessor() Function
	 */
	function updateLocalAulaProfessor() {
		$sql = "UPDATE localAulaProfessor SET professor_idProfessor = $this->professorIdProfessor, zonaAtendimentoCidade_idZonaAtendimentoCidade = $this->zonaAtendimentoCidadeIdZonaAtendimentoCidade WHERE idLocalAulaProfessor = $this->idLocalAulaProfessor";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectLocalAulaProfessor() Function
	 */
	function selectLocalAulaProfessor($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idLocalAulaProfessor, professor_idProfessor, zonaAtendimentoCidade_idZonaAtendimentoCidade FROM localAulaProfessor " . $where;
		return $this -> executeQuery($sql);
	}

	function selectLocalAulaProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE LAP.idLocalAulaProfessor, P.pais, Z.zona, C.cidade, E.nome AS estado 
		FROM localAulaProfessor AS LAP
		INNER JOIN zonaAtendimentoCidade AS Z ON LAP.zonaAtendimentoCidade_idZonaAtendimentoCidade = Z.idZonaAtendimentoCidade 
		LEFT JOIN pais AS P ON P.idPais = Z.pais_idPais 
		LEFT JOIN cidade AS C ON C.idCidade = Z.cidade_idCidade 
		LEFT JOIN uf AS E ON E.idUf = C.uf_idUf " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$html .= "<tr>
				
				<td>" . $valor['pais'] . "</td>
				
				<td>" . $valor['estado'] . "</td>
				
				<td>" . $valor['cidade'] . "</td>
				
				<td>" . $valor['zona'] . "</td>
				
				<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/localAulaProfessor.php', '" . $valor['idLocalAulaProfessor'] . "', '$caminhoAtualizar', '$ondeAtualiza')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>
				
				</tr>";
			}
		}

		return $html;
	}

}
?>

