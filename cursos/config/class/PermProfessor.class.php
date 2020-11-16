<?php
class PermProfessor extends Database {

	var $idPerProfGroup;
	var $professorIdProfessor;
	var $grupoIdGrupo;
	var $perAtivo;

	// constructor
	function __construct() {
		parent::__construct();
		$this -> idPerProfGroup = "NULL";
		$this -> professorIdProfessor = "NULL";
		$this -> grupoIdGrupo = "NULL";
		$this -> perAtivo = "0";

	}

	function __destruct() {
		parent::__destruct();
	}
	
	function setIdPerProfGroup($value){
		$this->idPerProfGroup = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setProfessorIdProfessor($value){
		$this->professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setGrupoIdGrupo($value){
		$this->grupoIdGrupo = ($value) ? $this -> gravarBD($value) : "NULL";
	}
	
	function setPerAtivo($value){
		$this->perAtivo = ($value) ? $this -> gravarBD($value) : "0";
	}
	
/**
	 * addPsaProfessor() Function
	 */
	function addPerm() {
	    $sql = "INSERT INTO perProfGroup (professor_IdProfessor, grupo_IdGrupo, perAtivo) VALUES ($this->professorIdProfessor, $this->grupoIdGrupo, $this->perAtivo)";
		$result = $this -> query($sql, true);
		return $this -> connect;
	}

	/**
	 * deletePsaProfessor() Function
	 */
	function deletePerm() {
	   	$sql = "UPDATE perProfGroup SET perAtivo = 0  WHERE idPerProfGroup = $this->idPerProfGroup";
		$result = $this -> query($sql, true);
	}

    function updatePerm() {
        $sql = "UPDATE perProfGroup SET perAtivo = 1  WHERE idPerProfGroup = $this->idPerProfGroup";
        $result = $this -> query($sql, true);
    }
    
	function selectPerm($where = "WHERE 1") {
		$sql = "SELECT SQL_CACHE idPerProfGroup, professor_IdProfessor, grupo_IdGrupo, perAtivo FROM perProfGroup " . $where;
		return $this -> executeQuery($sql);
	}

	function selectPermTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where = "") {
		$sql = "SELECT SQL_CACHE idPerProfGroup, perAtivo, t.nome, g.nome as grupo FROM perProfGroup p 
		INNER JOIN professor t ON t.idProfessor = p.professor_IdProfessor INNER JOIN grupo g ON g.IdGrupo = p.grupo_IdGrupo Where perAtivo >0 " . $where;
		$result = $this -> query($sql);
		if (mysqli_num_rows($result) > 0) {
			$html = "";
			while ($valor = mysqli_fetch_array($result)) {
				$html .= "<tr>";

				$NomeProf = $valor['nome'];
				$NomeGrupo = $valor['grupo'];
				$Permissao =  Uteis::exibirStatus($valor['perAtivo']);

				$html .= "<td>" . $NomeProf . "</td>";
				$html .= "<td>" . $NomeGrupo . "</td>";
				$html .= "<td align=\"center\">" . $Permissao . "</td>";
				$html .= "<td onclick=\"deletaRegistro('" . $caminhoAbrir . "acao/PermissaoAula.php', " . $valor['idPerProfGroup'] . ", '$caminhoAtualizar', '$ondeAtualiza')\">" . "<center><img src=\"" . CAMINHO_IMG . "excluir.png\"></center>" . "</td>";
				$html .= "</tr>";
			}
		}
		return $html;
	}
    function selectPermGrupoSelect($classes = "", $Prof, $idAtual = 0) {
        $sql = "SELECT SQL_CACHE idGrupo, nome, professor_idProfessor FROM grupo INNER JOIN planoAcaoGrupo ON grupo_idGrupo = idGrupo 
        INNER JOIN folhaFrequencia ON planoAcaoGrupo_idPlanoAcaoGrupo = idPlanoAcaoGrupo WHERE grupo_idGrupo = idGrupo And professor_idProfessor = ".$Prof." GROUP BY nome ORDER BY nome ASC";  
        $result = $this -> query($sql);
        $html = "<select id=\"idGrupo\" name=\"idGrupo\"  class=\"" . $classes . "\" >";
        $html .= "<option value=\"\">Selecione</option>";
        while ($valor = mysqli_fetch_array($result)) {
            $selecionado = $idAtual == $valor['idGrupo'] ? "selected=\"selected\"" : "";
            $html .= "<option " . $selecionado . " value=\"" . $valor['idGrupo'] . "\">" . ($valor['nome']) . "</option>";
        }
        $html .= "</select>";
        return $html;
    }
    
}

?>