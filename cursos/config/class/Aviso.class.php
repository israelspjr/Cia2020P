<?php
class Aviso extends Database {
	// class attributes
	var $idAviso;
	var $clientePfIdClientePf;
	var $clientePjIdClientePj;
	var $professorIdProfessor;
	var $funcionarioIdFuncionario;
	var $tituloAviso;
	var $aviso;
	var $lido;
	var $dataAviso;
	var $dataVisualizacao;
	var $clientePjIdClientePjEnviou;
	var $clientePfIdClientePfEnviou;
	var $professorIdProfessorEnviou;
	var $funcionarioIdFuncionarioEnviou;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idAviso = "NULL";
		$this -> clientePfIdClientePf = "NULL";
		$this -> clientePjIdClientePj = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> funcionarioIdFuncionario = "NULL";
		$this -> tituloAviso = "NULL";
		$this -> aviso = "NULL";
		$this -> lido = "NULL";
		$this -> dataAviso = "'" . date('Y-m-d H:i:s') . "'";
		$this -> dataVisualizacao = "NULL";
		$this -> clientePjIdClientePjEnviou = "NULL";
		$this -> clientePfIdClientePfEnviou = "NULL";
		$this -> professorIdProfessorEnviou = "NULL";
		$this -> funcionarioIdFuncionarioEnviou = "NULL";

	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdAviso($value) {
		$this -> idAviso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFuncionarioIdFuncionario($value) {
		$this -> funcionarioIdFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setTituloAviso($value) {
		$this -> tituloAviso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAviso($value) {
		$this -> aviso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setLido($value) {
		$this -> lido = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataAviso($value) {
		$this -> dataAviso = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setDataVisualizacao($value) {
		$this -> dataVisualizacao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePjIdClientePjEnviou($value) {
		$this -> clientePjIdClientePjEnviou = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePfEnviou($value) {
		$this -> clientePfIdClientePfEnviou = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessorEnviou($value) {
		$this -> professorIdProfessorEnviou = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFuncionarioIdFuncionarioEnviou($value) {
		$this -> funcionarioIdFuncionarioEnviou = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function addAviso() {
		$sql = "INSERT INTO aviso (clientePf_idClientePf, clientePj_idClientePj, professor_idProfessor, funcionario_idFuncionario, tituloAviso, aviso, lido, dataAviso, dataVisualizacao, clientePj_idClientePj_enviou, clientePf_idClientePf_enviou, professor_idProfessor_enviou, funcionario_idFuncionario_enviou) VALUES ($this->clientePfIdClientePf, $this->clientePjIdClientePj, $this->professorIdProfessor, $this->funcionarioIdFuncionario, $this->tituloAviso, $this->aviso, $this->lido, $this->dataAviso, $this->dataVisualizacao, $this->clientePjIdClientePjEnviou, $this->clientePfIdClientePfEnviou, $this->professorIdProfessorEnviou, $this->funcionarioIdFuncionarioEnviou)";
	//	echo $sql;
	//	if( !EMPRESA ){
			$result = $this -> query($sql, true);
			return $this -> connect;
	//	}
	}

	/**
	 * deleteAviso() Function
	 */
	function deleteAviso() {
		$sql = "DELETE FROM aviso WHERE idAviso = $this->idAviso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateFieldAviso() Function
	 */
	function updateFieldAviso($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE aviso SET " . $field . " = " . $value . " WHERE idAviso = $this->idAviso";
		$result = $this -> query($sql, true);
	}

	/**
	 * updateAviso() Function
	 */
	function updateAviso() {
		$sql = "UPDATE aviso SET clientePf_idClientePf = $this->clientePfIdClientePf, clientePj_idClientePj = $this->clientePjIdClientePj, professor_idProfessor = $this->professorIdProfessor, funcionario_idFuncionario = $this->funcionarioIdFuncionario, representante_idRepresentante = $this->representanteIdRepresentante, gestor_idGestor = $this->gestorIdGestor, tituloAviso = $this->tituloAviso, aviso = $this->aviso, lido = $this->lido, dataAviso = $this->dataAviso, dataVisualizacao = $this->dataVisualizacao, clientePj_idClientePj_enviou = $this->clientePjIdClientePjEnviou, clientePf_idClientePf_enviou = $this->clientePfIdClientePfEnviou, professor_idProfessor_enviou = $this->professorIdProfessorEnviou, funcionario_idFuncionario_enviou = $this->funcionarioIdFuncionarioEnviou WHERE idAviso = $this->idAviso";
		$result = $this -> query($sql, true);
	}

	/**
	 * selectAviso() Function
	 */
	function selectAviso($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idAviso, clientePf_idClientePf, clientePj_idClientePj, professor_idProfessor, funcionario_idFuncionario, tituloAviso, aviso, lido, dataAviso, dataVisualizacao, clientePj_idClientePj_enviou, clientePf_idClientePf_enviou, professor_idProfessor_enviou, funcionario_idFuncionario_enviou FROM aviso " . $where;
		return $this -> executeQuery($sql);
	}

	/**
	 * selectAvisoTr() Function
	 */
	function selectAvisoTr($caminhoAbrir = "", $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT SQL_CACHE idAviso, clientePf_idClientePf, clientePj_idClientePj, professor_idProfessor, funcionario_idFuncionario, tituloAviso, aviso, lido, dataAviso, dataVisualizacao, clientePj_idClientePj_enviou, clientePf_idClientePf_enviou, professor_idProfessor_enviou, funcionario_idFuncionario_enviou FROM aviso " . $where;
		$result = $this -> query($sql);
		//echo $sql;

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			$Professor = new Professor();
			$Funcionario = new Funcionario();
			$ClientePf = new ClientePf();
			$ClientePj = new ClientePj();

			while ($valor = mysqli_fetch_array($result)) {

				//load
				$idAviso = $valor['idAviso'];
				$tituloAviso = $valor['tituloAviso'];
				$lido = $valor['lido'];
				$dataAviso = Uteis::exibirDataHora($valor['dataAviso']);
				$dataVisualizacao = $valor['dataVisualizacao'];

				$idClientePj_enviou = $valor['clientePj_idClientePj_enviou'];
				$idClientePf_enviou = $valor['clientePf_idClientePf_enviou'];
				$idProfessor_enviou = $valor['professor_idProfessor_enviou'];
				$idFuncionario_enviou = $valor['funcionario_idFuncionario_enviou'];

				if ($idClientePj_enviou) {
					$tipoQuem = "empresa";
					$nomeQuem = $ClientePj -> getNome($idClientePj_enviou);
				} elseif ($idClientePf_enviou) {
					$tipoQuem = "aluno";
					$nomeQuem = $ClientePf -> getNome($idClientePf_enviou);
				} elseif ($idProfessor_enviou) {
					$tipoQuem = "professor";
					$nomeQuem = $Professor -> getNome($idProfessor_enviou);
				} elseif ($idFuncionario_enviou) {
					$tipoQuem = "equipe administrativa";
					$nomeQuem = $Funcionario -> getNome($idFuncionario_enviou);
				} else {
					$tipoQuem = "";
					$nomeQuem = "";
				}

				//html
				$bgColor = "";
				if (!$lido)
					$bgColor = " style=\"background-color:rgba(247, 255, 127, 0.5)\" ";

				$html .= "<tr $bgColor >";

				//ORDENAR POR ESSA COLUNA
				$html .= "<td>" . strtotime($valor['dataAviso']) . "</td>";

		//		if ($caminhoAbrir != "") {
					$onclick = " onclick=\"abrirNivelPagina(this, '$caminhoAbrir?id=$idAviso', '$caminhoAtualizar', '$ondeAtualiza')\" ";
		//		} else {
		//			$onclick = "";
		//		}

				//DE QUEM
				$html .= "<td $onclick >$nomeQuem <strong>($tipoQuem)</strong></td>";

				//TITULO
				$html .= "<td $onclick >" . $tituloAviso . "</td>";

				$html .= "<td $onclick >" . $dataAviso . ($dataVisualizacao ? " (visualizado em " . Uteis::exibirDataHora($dataVisualizacao) . ")" : "") . "</td>";

				$html .= "</tr>";
			}
		}
		return $html;
	}

	/**
	 * selectAvisoSelect() Function
	 */
	function selectAvisoSelect($classes = "", $idAtual = 0, $where = "") {
		$sql = "SELECT SQL_CACHE idAviso, clientePf_idClientePf, clientePj_idClientePj, professor_idProfessor, funcionario_idFuncionario, tituloAviso, aviso, lido, dataAviso, dataVisualizacao, clientePj_idClientePj_enviou, clientePf_idClientePf_enviou, professor_idProfessor_enviou, funcionario_idFuncionario_enviou FROM aviso " . $where;
		$result = $this -> query($sql);
		$html = "<select id=\"idAviso\" name=\"idAviso\"  class=\"" . $classes . "\" >";
		$html .= "<option value=\"\">Selecione</option>";
		while ($valor = mysqli_fetch_array($result)) {
			$selecionado = $idAtual == $valor['idAviso'] ? "selected=\"selected\"" : "";
			$html .= "<option " . $selecionado . " value=\"" . $valor['idAviso'] . "\">" . ($valor['idAviso']) . "</option>";
		}

		$html .= "</select>";
		return $html;
	}

}
?>