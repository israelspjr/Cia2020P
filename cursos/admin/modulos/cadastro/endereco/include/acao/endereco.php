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
	//	$class = "required";
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
//		$class = "required";
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
	$ZonaAtendimentoCidade = new ZonaAtendimentoCidade();
	
	if($_POST['acao'] == 'deletar'){
		
		$valorEndereco = $Endereco->selectEndereco(" WHERE idEndereco = ".$idEndereco);
		if($valorEndereco[0]['principal'] == 1){
			$arrayRetorno['mensagem'] = "Defina outro endereço como principal antes de excluir este.";
		}else{
			$Endereco->deleteEndereco();
			$arrayRetorno['mensagem'] = MSG_CADDEL;
		}
		
	}else{	
		if($_POST['principal']){
		$Endereco->setPrincipal(1);
        }else{
          $Endereco->setPrincipal(0);  
        }
        
		$Endereco->setProfessorIdProfessor($_POST['professor_idProfessor']);
		$Endereco->setClientePfIdClientePf($_POST['clientePf_idClientePf']);
		$Endereco->setClientePjIdClientePj($_POST['clientePj_idClientePj']);
		$Endereco->setFuncionarioIdFuncionario($_POST['funcionario_idFuncionario']);
				
		$Endereco->setCidadeIdCidade($_POST['idCidade']);
		$Endereco->setPaisIdPais($_POST['pais_idPais']);
		if ($_POST['idZonaAtendimentoCidade'] == "-") {
			$ZonaAtendimentoCidade->setCidadeIdCidade($_POST['idCidade']);
			$ZonaAtendimentoCidade->setPaisIdPais($_POST['pais_idPais']);
			$ZonaAtendimentoCidade->setZona("Todas");
			$idZonaAtendimento = $ZonaAtendimentoCidade->addZonaAtendimentoCidade();	
			
		} else {
			
		$idZonaAtendimento = $_POST['idZonaAtendimentoCidade'];	
		}
		$Endereco->setZonaAtendimentoCidadeIdZonaAtendimentoCidade($idZonaAtendimento);		
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
		}
		
		$arrayRetorno['fecharNivel'] = true;
	}
	echo json_encode($arrayRetorno);
}

?>