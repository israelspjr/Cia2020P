<?php
class Log extends Database {

	// class attributes
	var $idLog;
	var $mensagem;
	var $dataLog;
	var $acao;
    var $falha;
    var $ip;
	var $professorIdProfessor;
	var $clientePfIdClientePf;
	var $clientePjIdClientePj;
	var $funcionarioIdFuncionario;

	// constructor
	function __construct() {
	    parent::__construct();
	    $this -> idLog = "NULL";
        $this -> mensagem = "NULL";
        $this -> acao = "NULL";
        $this -> ip = "NULL";
        $this -> professorIdProfessor = "NULL";
        $this -> clientePfIdClientePf = "NULL";
        $this -> clientePjIdClientePj = "NULL";
        $this -> funcionarioIdFuncionario = "NULL";
        $this -> falha = "NULL";
        $this -> dataLog = "NULL";
    }
	function __destruct() {
        parent::__destruct();
    }
    
	// class methods
	function setIdLog($value) {
		$this -> idLog = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setMensagem($value) {
		$this -> mensagem = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setAcao($value) {
		$this -> acao = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setProfessorIdProfessor($value) {
		$this -> professorIdProfessor = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePfIdClientePf($value) {
		$this -> clientePfIdClientePf = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setClientePjIdClientePj($value) {
		$this -> clientePjIdClientePj = ($value) ? $this -> gravarBD($value) : "NULL";
	}

	function setFuncionarioIdFuncionario($value) {
		$this -> funcionarioIdFuncionario = ($value) ? $this -> gravarBD($value) : "NULL";
	}
    
    function setFalha($value){
      $this -> falha = ($value) ? $this -> gravarBD($value) : 0;  
    }
    
    function setDataLog($value){
       $this -> dataLog = ($value) ? $this -> gravarBD($value) : "NULL"; 
    }
    
    function setIP($value){
       $this -> ip = ($value) ? $this -> gravarBD($value) : "NULL"; 
    }
    
	function Log($acao, $falha, $msg, $usuario = array()){
     
        $this -> setAcao($acao);    
        $this -> setMensagem($msg);        
        $this -> setIP($_SERVER['REMOTE_ADDR']); 
               
        if($usuario['usuario']=='funcionario' or $_SESSION['usuario']=="funcionario")            
            $this->setFuncionarioIdFuncionario(($usuario['idUsuario'])? $usuario['idUsuario']:$_SESSION['idUsuario']);
        
        if($usuario['usuario']=='clientepj' or $_SESSION['usuario']=="clientepj")
            $this->setClientePjIdClientePj(($usuario['idUsuario'])? $usuario['idUsuario']:$_SESSION['idUsuario']);
        
        if($usuario['usuario']=='clientepf' or $_SESSION['usuario']=="clientepf")
            $this->setClientePfIdClientePf(($usuario['idUsuario'])? $usuario['idUsuario']:$_SESSION['idUsuario']);
        
        if($usuario['usuario']=='professor' or $_SESSION['usuario']=="professor")
            $this->setProfessorIdProfessor(($usuario['idUsuario'])? $usuario['idUsuario']:$_SESSION['idUsuario']);
        
        $this -> setFalha($falha);
        $this -> setDataLog(date('Y-m-d H:i:s'));
        $this -> addLog();     
    }
	
	function addLog() {
		$sql = "INSERT INTO log (mensagem, dataLog, acao, ip, falha, professor_idProfessor, clientePf_idClientePf, clientePj_idClientePj, funcionario_idFuncionario)
			VALUES ($this->mensagem, $this->dataLog, $this->acao, $this->ip, $this->falha, $this->professorIdProfessor, $this->clientePfIdClientePf, $this->clientePjIdClientePj, $this->funcionarioIdFuncionario)";		
		$result = $this -> query($sql, FALSE);
	}
/*
	function deleteLog() {
		$sql = "DELETE FROM log WHERE idLog = $this->idLog";
		$result = $this -> query($sql);
	}

	function updateFieldLog($field, $value) {
		$value = ($value != "NULL") ? $this -> gravarBD($value) : $value;
		$sql = "UPDATE log SET " . $field . " = " . $value . " WHERE idLog = $this->idLog";
		$result = $this -> query($sql);
	}

	
	/*function updateLog() {
		$sql = "UPDATE log SET acao = $this->acao, data = $this->data, tb = $this->tb, professor_idProfessor = $this->professorIdProfessor, clientePf_idClientePf = $this->clientePfIdClientePf, clientePj_idClientePj = $this->clientePjIdClientePj, funcionario_idFuncionario = $this->funcionarioIdFuncionario WHERE idLog = $this->idLog";
		$result = $this -> query($sql, true);
	}*/	

	function selectLog($where = "WHERE 1") {
		$sql = "SELECT idLog, mensagem, dataLog, acao, falha, professor_idProfessor, clientePf_idClientePf, clientePj_idClientePj, funcionario_idFuncionario FROM log " . $where;
		return $this -> executeQuery($sql);
	}

	function selectLogTr($where = "") {
        
		$sql = "SELECT L.acao, L.mensagem, L.dataLog, L.ip, L.falha, L.professor_idProfessor, L.clientePf_idClientePf, L.clientePj_idClientePj, L.funcionario_idFuncionario FROM log AS L ".$where." ORDER BY L.dataLog";
		$result = $this -> query($sql);
        $funcionario = new Funcionario();
        $clientepf = new ClientePf();
        $clientepj = new ClientePj();
        $professor = new Professor();
        
		if (mysql_num_rows($result) > 0) {

			$html = "";

			while ($valor = mysqli_fetch_array($result)) {

				$data = $valor['dataLog'];
				$ip = $valor['ip'];
				$mensagem = $valor['mensagem'];
				$acao = $valor['acao'];
				$falha = Uteis::exibirStatus(!$valor['falha']);
				$tipo = $valor['professor_idProfessor'] ? "Professor" : $valor['clientePf_idClientePf'] ? "Aluno" : $valor['clientePj_idClientePj'] ? "Empresa" : $valor['funcionario_idFuncionario'] ? "Funcionario" : "";
				$nome = $valor['professor_idProfessor'] ? $professor->getNome($valor['professor_idProfessor']) : $valor['clientePf_idClientePf'] ? $clientepf->getNome($valor['clientePf_idClientePf']) : $valor['clientePj_idClientePj'] ? $clientepj->getNome($valor['clientePj_idClientePj']) : $valor['funcionario_idFuncionario'] ? $funcionario->getNome($valor['funcionario_idFuncionario']) : "";
                
				$html .= "<tr>";
				$html .= "<td>" . strtotime($data) . "</td>";
				$html .= "<td>" . Uteis::exibirDataHora($data) . "</td>";
				$html .= "<td>" .$ipb. "</td>";
				$html .= "<td>" .$tipo. "</td>";
				$html .= "<td>" .$nome. "</td>";
                $html .= "<td>" .$acao. "</td>";
                $html .= "<td>" .$mensagem. "</td>";
                $html .= "<td>" .$falha. "</td>";;
				$html .= "</tr>";

			}
		}
		return $html;
	}

	function getAcao($id) {
		$rs = $this -> selectLog(" WHERE idLog = $id");
		return $rs[0]['acao'];
	}

}
?>