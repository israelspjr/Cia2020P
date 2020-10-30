<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
if($_REQUEST['acao'] == 'cidade'){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Cidade.class.php");	
	$Cidade = new Cidade();
	
	?>
	<p> 
      <label>Cidade:</label>     
      <?php echo $Cidade->selectCidadePorEstadoSelect("required", $_POST['idCidade'], $_POST['idUf']);?><span class="placeholder">Campo Obrigatório</span>       
    </p>
    <?php
	
}elseif($_REQUEST['acao'] == 'zonaCidade'){
	
	$class = "";
	if($_REQUEST['idProfessor'] != ''){
		$class = "required";
		$andProfessor = " AND ( idZonaAtendimentoCidade NOT IN (SELECT zonaAtendimentoCidade_idZonaAtendimentoCidade FROM localAulaProfessor WHERE professor_idProfessor =".$_REQUEST['idProfessor']."))";
	}
	
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ZonaAtendimentoCidade.class.php");
	$ZonaAtendimentoCidade = new ZonaAtendimentoCidade(); ?>
	
    <p>          
   	<label>Zona de atendimento:</label>    
    <?php 
	echo $ZonaAtendimentoCidade->selectZonaatendimentocidadePorCidadeSelect($class, $_REQUEST['idZona'], $_REQUEST['idCidade'], $andProfessor);
	
	if($_REQUEST['idProfessor'] != '') echo "<span class=\"placeholder\">Campo obrigatório</span>";
	
	?>          
    </p>
 
<?php   
}elseif($_REQUEST['acao'] == 'zonaPais'){
	$class = "";
	if($_REQUEST['idProfessor'] != ''){
		$class = "required";
		$andProfessor = " AND ( idZonaAtendimentoCidade NOT IN (SELECT zonaAtendimentoCidade_idZonaAtendimentoCidade FROM localAulaProfessor WHERE professor_idProfessor =".$_REQUEST['idProfessor']."))";
	}
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ZonaAtendimentoCidade.class.php");
	$ZonaAtendimentoCidade = new ZonaAtendimentoCidade(); ?>
	
    <p>  
    <label>Zona de atendimento:</label>   
    <?php 
	echo $ZonaAtendimentoCidade->selectZonaatendimentocidadePorPaisSelect($class, $_REQUEST['idZona'], $_REQUEST['idPais'], $andProfessor);
	
	if($_REQUEST['idProfessor'] != '') echo "<span class=\"placeholder\">Campo obrigatório</span>";
	?>          
    </p>
    
<?php   
        
}elseif($_REQUEST['acao'] == 'ufCidade'){
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uf.class.php");	
	$Uf = new Uf();
	
	echo $Uf->selectUfPorCidade($_POST['idCidade']);     


}else{
	$arrayRetorno = array();
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Endereco.class.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/BuscaAvulsa.class.php");
	
	$Endereco = new Endereco();		
	$BuscaAvulsa = new BuscaAvulsa();		
	
	$idEndereco = $_REQUEST['id'];	
	
	$Endereco->setIdEndereco($idEndereco);
	
	if($_POST['acao'] == 'deletar'){
		
		$valorEndereco = $Endereco->selectEndereco(" WHERE idEndereco = ".$idEndereco);
		if($valorEndereco[0]['principal'] == 1){
			$arrayRetorno['mensagem'] = "Defina outro endereço como principal antes de excluir este.";
		}else{
			$Endereco->deleteEndereco();
			$arrayRetorno['mensagem'] = MSG_CADDEL;
		}
		
	}else{	
		
		$principal = ( $_POST['principal'] == "1" ? 1 : 0);
		
		$Endereco->setClientePjIdClientePj($_POST['clientePj_idClientePj']);
		$Endereco->setClientePfIdClientePf($_POST['clientePf_idClientePf']);
		$Endereco->setFuncionarioIdFuncionario($_POST['funcionario_idFuncionario']);
		$Endereco->setProfessorIdProfessor($_POST['professor_idProfessor']);
		$Endereco->setCidadeIdCidade($_POST['idCidade']);
		$Endereco->setPaisIdPais($_POST['pais_idPais']);
		$Endereco->setZonaAtendimentoCidadeIdZonaAtendimentoCidade($_POST['idZonaAtendimentoCidade']);		
		$Endereco->setRua($_POST['rua']);
		$Endereco->setBairro($_POST['bairro']);
		$Endereco->setNumero($_POST['numero']);
		$Endereco->setCep($_POST['cep']);
		$Endereco->setComplemento($_POST['complemento']);
		$Endereco->setObs($_POST['obs']);
		$Endereco->setReferencia($_POST['referencia']);
		$Endereco->setLinkMapa($_POST['linkMapa']);
		$Endereco->setPrincipal($principal);
		
		if($idEndereco != "" && $idEndereco > 0 ){
			$Endereco->updateEndereco();
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{
			$idEndereco = $Endereco->addEndereco();		
			
			$BuscaAvulsa->setIdBuscaAvulsa($_POST['idBuscaAvulsa']);
			$BuscaAvulsa->updateFieldBuscaAvulsa("endereco_idEndereco", $idEndereco);
			
			$arrayRetorno['mensagem'] = "Cadastro efetuado com sucesso!";
		}
		
		$arrayRetorno['fecharNivel'] = true;
	}
	echo json_encode($arrayRetorno);
}

?>