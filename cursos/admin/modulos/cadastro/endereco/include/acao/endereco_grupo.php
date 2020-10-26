<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
if($_REQUEST['acao'] == 'cidade'){
		
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
		
	$Uf = new Uf();
	
	echo $Uf->selectUfPorCidade($_POST['idCidade']);     

}else{
	
	$arrayRetorno = array();
	
	$idEndereco = $_REQUEST['id'];	
	
	$Endereco = new Endereco();		
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
		
		$Endereco->setPrincipal("1");
		
		$Endereco->setProfessorIdProfessor($_POST['professor_idProfessor']);
		$Endereco->setClientePfIdClientePf($_POST['clientePf_idClientePf']);
		$Endereco->setClientePjIdClientePj($_POST['clientePj_idClientePj']);
		$Endereco->setidPlanoAcaoGrupo($_POST['idPlanoAcaoGrupo']);
		$Endereco->setFuncionarioIdFuncionario($_POST['funcionario_idFuncionario']);
				
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
		
		
		if($idEndereco != "" && $idEndereco > 0 ){
			$Endereco->updateEndereco();
			$arrayRetorno['mensagem'] = MSG_CADATU;			
		}else{
			$idEndereco = $Endereco->addEndereco();		
			$arrayRetorno['mensagem'] = MSG_CADNEW;
	//		$arrayRetorno['pagina'] = CAMINHO_MODULO."relacionamento/grupo/include/form/aulaPermanenteGrupo.php?End=1&idPlanoAcaoGrupo=".$_POST['idPlanoAcaoGrupo']."&idAtual=".$idEndereco;
			$arrayRetorno['pagina'] = "admin/response.php?idAtual=&idAtual=".$idEndereco;
			$arrayRetorno['fecharNivel'] = true;
			$_CUSTOM =  1010;//$idEndereco;
		}
	}
	echo json_encode($arrayRetorno);
	
}

?>