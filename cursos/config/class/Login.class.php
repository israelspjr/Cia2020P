<?php
class Login extends Database {
	// class attributes
	var $id; 
	// constructor
	function __construct() {
		parent::__construct();
		//parent::__construct();
		$this -> id = "0";        
	}

	function __destruct() {
		parent::__destruct();
	}

	// class methods
	function setId($value) {
		$this -> id = ($value) ? $this -> gravarBD($value) : "0";
	}

	function efetuarLogin($documentoUnico, $senhaAcesso) {
		$Log = new Log();
		$sql = " SELECT documentoUnico, senhaAcesso, nomeExibicao, idFuncionario  FROM funcionario 
		WHERE inativo = 0 AND excluido = 0 AND documentoUnico = '" . $documentoUnico . "' AND senhaAcesso = '" . $senhaAcesso . "' ";
	//echo $sql;
		$rs = $this -> query($sql);

		if ($result = mysqli_fetch_array($rs)) {		    			
				
				$_SESSION['logado'] = true;
				$_SESSION['idFuncionario_SS'] = $result['idFuncionario'];
				$_SESSION['nome_SS'] = $result['nomeExibicao'];
                $_SESSION['usuario'] = "funcionario";
                $_SESSION['idUsuario'] = $result['idFuncionario'];                           
                $Log -> Log('Login Funcionario', 0, "Login Efetuado com Sucesso usuário:".$documentoUnico." - senha:".EncryptSenha::B64_Decode($senhaAcesso),array("usuario"=>$_SESSION['usuario'],"idUsuario"=>$_SESSION['idUsuario']));
                $funcionario = new Funcionario();                
                $email = $funcionario->getEmail($result['idFuncionario']);               
                $_SESSION['email'] = $email;                               
				header('Location:/cursos/admin/index.php');
				return true;
		
		}
        $Log -> Log('Login Funcionario', 1, "Erro ao efetuar o Login usuário:".$documentoUnico." - senha:".EncryptSenha::B64_Decode($senhaAcesso));
		return false;
	}

	function efetuarLogin_RH($documentoUnico, $senhaAcesso, $mobile, $portalUnico = 0) {
        $Log = new Log();
		$sql = " SELECT idClientePj, razaoSocial, cnpj, senhaAcesso FROM clientePj 
		WHERE tipoCliente_idTipoCliente = 3 AND inativo = 0 AND excluido = 0 AND cnpj = " . $this -> gravarBD($documentoUnico) . " AND senhaAcesso = " . $this -> gravarBD($senhaAcesso) . " ";
		$rs = $this -> query($sql);

		if ($result = mysqli_fetch_array($rs)) {
		    				
				$_SESSION['logado'] = true;
				$_SESSION['idClientePj_SS'] = $result['idClientePj'];
				$_SESSION['nome_SS'] = $result['razaoSocial'];
                $_SESSION['usuario'] = "clientepj";
                $_SESSION['idUsuario'] = $result['idClientePj']; 
				$_SESSION['idUnico'] = $result['idClientePj'];
                $Log -> Log('Login ClientePj', 0, "Login Efetuado com Sucesso usuário:".$documentoUnico." - senha:".EncryptSenha::B64_Decode($senhaAcesso),array("usuario"=>$_SESSION['usuario'],"idUsuario"=>$_SESSION['idUsuario']));
				$_SESSION['appN'] = 4;
				if ($portalUnico != 1) {
					header('Location:/cursos/mobile/rh/index.php');
					
				} else {
					echo '<meta http-equiv="refresh" content="0;url=/cursos/portais/index.php">'; //header('Location:/cursos/portais/index.php');
			//	echo "teste3";
				}	
			return true;
		}
         $Log -> Log('Login ClientePj', 1, "Erro ao efetuar o Login usuário:".$documentoUnico." - senha:".EncryptSenha::B64_Decode($senhaAcesso));
		return false;
	}

	function efetuarLogin_Aluno($documentoUnico, $senhaAcesso, $mobile, $portalUnico = 0) {
       $Log = new Log();
		$sql = " SELECT idClientePf, nomeExibicao, documentoUnico, senhaAcesso FROM clientePf 
		WHERE tipoCliente_idTipoCliente = 3 AND inativo = 0 AND excluido = 0 AND documentoUnico = '" .$documentoUnico . "' AND senhaAcesso = '" . $senhaAcesso . "' ";
//		echo $sql;
		$rs = $this -> query($sql);
		
		if ($result = mysqli_fetch_array($rs)) {
			if ($result['documentoUnico'] == $documentoUnico && $result['senhaAcesso'] == $senhaAcesso) {
				
				$_SESSION['logado'] = true;
				$_SESSION['idClientePf_SS'] = $result['idClientePf'];
				$_SESSION['idUnico'] = $result['idClientePf'];
				$_SESSION['nome_SS'] = $result['nomeExibicao'];
				$_SESSION['usuario'] = "clientepf";
                $_SESSION['idUsuario'] = $result['idClientePf'];
				$_SESSION['appN'] = 1;
                $Log -> Log('Login ClientePf', 0, "Login Efetuado com Sucesso usuário:".$documentoUnico." - senha:".EncryptSenha::B64_Decode($senhaAcesso),array("usuario"=>$_SESSION['usuario'],"idUsuario"=>$_SESSION['idUsuario']));
				header('Location:/cursos/portais/index.php');
					return true;
			}
		} else {
			$sql = " SELECT idProfessor, nomeExibicao, documentoUnico, senha FROM professor 
		WHERE inativo = 0 AND excluido = 0 AND tipoDocumentoUnico_idTipoDocumentoUnico = 1 AND documentoUnico = " . $this -> gravarBD($documentoUnico) . " AND senha = " . $this -> gravarBD($senhaAcesso) . " AND tambemAluno = 1";
		$rs = $this -> query($sql);
		
		if ($result = mysqli_fetch_array($rs)) {
			if ($result['documentoUnico'] == $documentoUnico && $result['senha'] == $senhaAcesso) {
				$_SESSION['logado'] = true;
				$_SESSION['idClientePf_SS'] = $result['idProfessor'];
				$_SESSION['nome_SS'] = $result['nomeExibicao'];
				$_SESSION['usuario'] = "clientepf";
                $_SESSION['idUsuario'] = $result['idProfessor'];
				$_SESSION['appN'] = 1;
                $Log -> Log('Login ClientePf', 0, "Login Efetuado com Sucesso usuário:".$documentoUnico." - senha:".EncryptSenha::B64_Decode($senhaAcesso),array("usuario"=>$_SESSION['usuario'],"idUsuario"=>$_SESSION['idUsuario']));
		//		if ($portalUnico != 1) {
		//			header('Location:/cursos/mobile/aluno/index.php');	
		//		} else {
					header('Location:/cursos/portais/index.php');
		//		}	
				return true;
			}
		} 
        	$Log -> Log('Login ClientePf', 1, "Erro ao efetuar o Login usuário:".$documentoUnico." - senha:".EncryptSenha::B64_Decode($senhaAcesso));
			return false;
		}
	}

	function efetuarLogin_Prof($documentoUnico, $senhaAcesso, $tipo, $mobile, $novo = 0) {
        $Log = new Log();
		if ($novo == 0) {
		$sql = " SELECT idProfessor, nomeExibicao, documentoUnico, senha FROM professor 
		WHERE inativo = 0 AND excluido = 0 AND tipoDocumentoUnico_idTipoDocumentoUnico = ".$tipo." AND documentoUnico = " . $this -> gravarBD($documentoUnico) . " AND senha = " . $this -> gravarBD($senhaAcesso) . " ";
		$rs = $this -> query($sql);

		if ($result = mysqli_fetch_array($rs)) {			
				
				$_SESSION['logado'] = true;
				$_SESSION['idProfessor_SS'] = $result['idProfessor'];
				$_SESSION['nome_SS'] = $result['nomeExibicao'];
                $_SESSION['usuario'] = "professor";
                $_SESSION['idUsuario'] = $result['idProfessor'];
                $Log -> Log('Login Professor', 0, "Login Efetuado com Sucesso usuário:".$documentoUnico." - senha:".EncryptSenha::B64_Decode($senhaAcesso),array("usuario"=>$_SESSION['usuario'],"idUsuario"=>$_SESSION['idUsuario']));
				header('Location:/cursos/portais/index.php');	
				return true;			
		}
        $Log -> Log('Login Professor', 1, "Erro ao efetuar o Login usuário:".$documentoUnico." - senha:".EncryptSenha::B64_Decode($senhaAcesso));
		
		} else {
				$_SESSION['logado'] = true;
				$_SESSION['idProfessor_SS'] = -1;
				$_SESSION['nome_SS'] = 'Novo Cadstro';
                $_SESSION['usuario'] = "professor";
                $_SESSION['idUsuario'] = -1;
				header('Location:/cursos/portais/index.php');	
				return true;
		}
		return false; 
		
	}

	function efetuarLogoff($redireciona = true, $mobile) {
	    $Log = new Log();	
		if($_SESSION['idFuncionario_SS']!=""){
		    $Log -> Log('Logoff Funcionario', 0, "Logoff Efetuado com sucesso",array("usuario"=>$_SESSION['usuario'],"idUsuario"=>$_SESSION['idFuncionario_SS']));
		    unset($_SESSION['logado']);
            unset($_SESSION['nome_SS']);
            unset($_SESSION['usuario']);
            unset($_SESSION['idUsuario']);
    		unset($_SESSION['idFuncionario_SS']);
            session_destroy();
            
        }elseif($_SESSION['idClientePj_SS']!=""){
		    $Log -> Log('Logoff ClientePj', 0, "Logoff Efetuado com sucesso",array("usuario"=>$_SESSION['usuario'],"idUsuario"=>$_SESSION['idClientePj_SS']));
		    unset($_SESSION['logado']);
            unset($_SESSION['nome_SS']);
            unset($_SESSION['usuario']);
            unset($_SESSION['idUsuario']);
		    unset($_SESSION['idClientePj_SS']);
		    session_destroy();
             
		}elseif($_SESSION['idClientePf_SS']!=""){
		    $Log -> Log('Logoff ClientePf', 0, "Logoff Efetuado com sucesso",array("usuario"=>$_SESSION['usuario'],"idUsuario"=>$_SESSION['idClientePf_SS']));
    		unset($_SESSION['logado']);
            unset($_SESSION['nome_SS']);
            unset($_SESSION['usuario']);
            unset($_SESSION['idUsuario']);
    		unset($_SESSION['idClientePf_SS']);
            session_destroy();
            
		}elseif($_SESSION['idProfessor_SS']!=""){
		    
		    $Log -> Log('Logoff Professor', 0, "Logoff Efetuado com sucesso",array("usuario"=>$_SESSION['usuario'],"idUsuario"=>$_SESSION['idProfessor_SS']));
		    unset($_SESSION['logado']);
            unset($_SESSION['nome_SS']);
            unset($_SESSION['usuario']);
            unset($_SESSION['idUsuario']); 
		    unset($_SESSION['idProfessor_SS']);
            session_destroy();
        }
     
		if ($redireciona == true) {		
			header('Location:/cursos');
		}
	}

	function verificarLogin() {
//		echo $_SESSION;
		/*$_SESSION['logado'] = true;
		$_SESSION['idFuncionario_SS'] = 18;
		$_SESSION['nome_SS'] = "Teste";*/
		
		if ($_SESSION['logado'] && $_SESSION['idFuncionario_SS'] && $_SESSION['nome_SS']) {
			return true;
		} else {
			return false;
		}
	}

	function verificarLogin_rh() {
		if ($_SESSION['logado'] && $_SESSION['idClientePj_SS'] && $_SESSION['nome_SS']) {
			return true;
		} else {
			return false;
		}
	}

	function verificarLogin_aluno() {
		if ($_SESSION['logado'] && $_SESSION['idClientePf_SS'] && $_SESSION['nome_SS']) {
			return true;
		} else {
			return false;
		}
	}

	function verificarLogin_prof() {
		if ($_SESSION['logado'] && $_SESSION['idProfessor_SS'] && $_SESSION['nome_SS']) {
			return true;
		} else {
			return false;
		}
	}
	
	function verificarLogin_unico() {
		if ($_SESSION['logado'] && $_SESSION['idUnico'] && 	$_SESSION['nome_SS']) {
			return true;
		} else {
			return false;
		}
	}
	
	
	
	function efetuarLogin_pre($documentoUnico, $email) {
        $Log = new Log();
		$sql = " SELECT idPreClientePf, nome, email, jaRealizado, clientePj_idClientePj, funcionario_idFuncionario FROM preClientePf 
		WHERE nome = '" . $documentoUnico . "' AND email = '" . $email . "' ";
//		echo $sql;
		$rs = $this -> query($sql);

		if ($result = mysqli_fetch_array($rs)) {
			if ($result['nome'] == $documentoUnico && $result['email'] == $email) {
				
				$_SESSION['logado'] = true;
				$_SESSION['idClientePf_SS'] = 4; //$result['idClientePf'];
				$_SESSION['idUnico'] = 4;
				$_SESSION['nome_SS'] = $result['nome'];
				$_SESSION['usuario'] = "clientepf";
				$_SESSION['emailpf'] = $email;
                $_SESSION['idUsuario'] = $result['idPreClientePf'];
				$_SESSION['clientePj'] = $result['clientePj_idClientePj'];
				$_SESSION['funcionario'] = $result['funcionario_idFuncionario'];
				$_SESSION['appN'] = 1;
                $Log -> Log('Login ClientePf', 0, "Login Efetuado com Sucesso usuário:".$documentoUnico." - senha:".EncryptSenha::B64_Decode($senhaAcesso),array("usuario"=>$_SESSION['usuario'],"idUsuario"=>$_SESSION['idUsuario']));
			echo '<meta http-equiv="refresh" content="0;url=/cursos/portais/index.php">';
				return true;
			}
		}
        $Log -> Log('Login ClientePf', 1, "Erro ao efetuar o Login usuário:".$documentoUnico." - email:".$email);
		return false;
	}
}
?>