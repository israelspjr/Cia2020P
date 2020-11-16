<?php
class PlanoAcaoGrupoAjudaCusto extends Database {

	// class attributes
	var $idPlanoAcaoGrupoAjudaCusto;
	var $planoAcaoGrupoIdPlanoAcaoGrupo;
	var $professorIdProfessor;
	var $mesIni;
	var $mesFim;
	var $anoIni;
	var $anoFim;
	var $valor;
	var $porDia;
	var $descricao;
	var $cobrarAluno;
	var $excluido;
	var $dataCadastro;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPlanoAcaoGrupoAjudaCusto = "NULL";
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> mesIni = "NULL";
		$this -> mesFim = "NULL";
		$this -> anoIni = "NULL";
		$this -> anoFim = "NULL";
		$this -> valor = "NULL";
		$this -> porDia = "0";
		$this -> descricao = "NULL";
		$this -> cobrarAluno = "0";		
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setIdPlanoAcaoGrupoAjudaCusto($value) {
		$this -> idPlanoAcaoGrupoAjudaCusto = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setPlanoAcaoGrupoIdPlanoAcaoGrupo($value) {
		$this -> planoAcaoGrupoIdPlanoAcaoGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMesIni($value) {
		$this -> mesIni = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMesFim($value) {
		$this -> mesFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAnoIni($value) {
		$this -> anoIni = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAnoFim($value) {
		$this -> anoFim = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setValor($value) {
		$this -> valor = ($value) ? $this -> gravarBD(Uteis::gravarMoeda($value)) : "NULL";
	}
	
	function setPorDia($value) {
		$this -> porDia = ($value) ? $this -> gravarBD(($value)) : "0";
	}
	
	function setDescricao($value) {
		$this -> descricao = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setCobrarAluno($value) {
		$this -> cobrarAluno = ($value) ? $this -> gravarBD($value) : "0";
	}


	function addPlanoAcaoGrupoAjudaCusto() {
		$sql = "INSERT INTO planoAcaoGrupoAjudaCusto (planoAcaoGrupo_idPlanoAcaoGrupo, professor_idProfessor, mesIni, mesFim, anoIni, anoFim, valor, porDia, descricao, cobrarAluno) 
		VALUES ($this->planoAcaoGrupoIdPlanoAcaoGrupo, $this->professorIdProfessor, $this->mesIni, $this->mesFim, $this->anoIni, $this->anoFim, $this->valor, $this->porDia, $this->descricao, $this->cobrarAluno)";
		$result = $this -> query($sql, true);
		return $this->connect;
	}

	function deletePlanoAcaoGrupoAjudaCusto() {
		$this -> updateFieldPlanoAcaoGrupoAjudaCusto("excluido", "1");
	}

	function updateFieldPlanoAcaoGrupoAjudaCusto($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $this -> gravarBD($value);
		$sql = "UPDATE planoAcaoGrupoAjudaCusto SET " . $field . " = " . $value . " WHERE idPlanoAcaoGrupoAjudaCusto = $this->idPlanoAcaoGrupoAjudaCusto";
		$result = $this -> query($sql, true);
	}

	function updatePlanoAcaoGrupoAjudaCusto() {
		$sql = "UPDATE planoAcaoGrupoAjudaCusto SET planoAcaoGrupo_idPlanoAcaoGrupo = $this->planoAcaoGrupoIdPlanoAcaoGrupo, professor_idProfessor = $this->professorIdProfessor, 
		mesIni = $this->mesIni, mesFim = $this->mesFim, anoIni = $this->anoIni, anoFim = $this->anoFim, valor = $this->valor, porDia = $this->porDia, descricao = $this->descricao, cobrarAluno = $this->cobrarAluno 
		WHERE idPlanoAcaoGrupoAjudaCusto = $this->idPlanoAcaoGrupoAjudaCusto";
		//echo "$sql";exit;
		$result = $this -> query($sql, true);
	}

	function selectPlanoAcaoGrupoAjudaCusto($where = "WHERE 1") {
		$sql = "SELECT idPlanoAcaoGrupoAjudaCusto, planoAcaoGrupo_idPlanoAcaoGrupo, professor_idProfessor, mesIni, mesFim, anoIni, anoFim, valor, porDia, descricao, cobrarAluno 
		FROM planoAcaoGrupoAjudaCusto WHERE excluido = 0 " . $where;
		return $this -> executeQuery($sql);
	}

	function selectPlanoAcaoGrupoAjudaCustoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {

		$sql = "SELECT PAG.idPlanoAcaoGrupoAjudaCusto, PAG.mesIni, PAG.mesFim, PAG.anoIni, PAG.anoFim, PAG.valor, P.nome, PAG.porDia, PAG.descricao, PAG.cobrarAluno  
		FROM planoAcaoGrupoAjudaCusto AS PAG 
		INNER JOIN professor AS P ON P.idProfessor = PAG.professor_idProfessor 
		WHERE PAG.excluido = 0 " . $where;
		$result = $this -> query($sql);

		if (mysqli_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$idPlanoAcaoGrupoAjudaCusto = $valor['idPlanoAcaoGrupoAjudaCusto'];
				$onclick = " onclick=\"abrirNivelPagina(this, '".$caminhoAbrir."form/planoAcaoGrupoAjudaCusto.php?id=".$idPlanoAcaoGrupoAjudaCusto."', '".$caminhoAtualizar."', '".$ondeAtualiza."')\" ";

				$html .= "<tr>";

				$html .= "<td $onclick>" . strtotime($valor['dataCadastro']) . "</td>";

				$html .= "<td $onclick>" . $valor['nome'] . " <strong>[".$valor['descricao']."]</strong></td>";

				$html .= "<td $onclick>" . $valor['mesIni'] . "/" . $valor['anoIni'] . "</td>";

				$html .= "<td $onclick>" . ($valor['mesFim'] && $valor['anoFim'] ? $valor['mesFim'] . "/" . $valor['anoFim'] : "") . "</td>";

				$html .= "<td >R$ <strong>" . Uteis::formatarMoeda($valor['valor']) . "</strong> calculo feito por <strong>" . ($valor['porDia'] ? "dia" : "hora") . "</strong>" .($valor['cobrarAluno'] ? " <font color=\"#F00\">[sera cobrado do aluno]</font>" : "") . "</td>";

				$html .= "<td align=\"center\" onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/planoAcaoGrupoAjudaCusto.php', '" . $idPlanoAcaoGrupoAjudaCusto . "', '" . $caminhoAtualizar . "', '" . $ondeAtualiza . "')\">
					<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>
				</td>";

				$html .= "</tr>";
			}
		}

		return $html;
	}

}

?>