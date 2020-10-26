<?php  
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	
	$ClientePj = new ClientePj();
	$TipoDocumentoUnico = new TipoDocumentoUnico();
	$TipoCliente = new TipoCliente();
	$ContatoAdicional = new ContatoAdicional();
	$Conheceu = new ComoConheceu();
	
		
	$idClientePj = $_GET['id'];
	if($idClientePj != '' && $idClientePj  > 0){

		$valorClientePJ = $ClientePj->selectClientePj('WHERE idClientePj='.$idClientePj);
		
		//print_r($valorClientePJ);
		
		$idClientePj = $valorClientePJ[0]['idClientePj']; 
		$idTipoCliente = $valorClientePJ[0]['tipoCliente_idTipoCliente'];  
		$razaoSocial = $valorClientePJ[0]['razaoSocial']; 		
		$nomeFantasia = $valorClientePJ[0]['nomeFantasia']; 
		$cnpj = $valorClientePJ[0]['cnpj']; 
		$inscricaoEstadual = $valorClientePJ[0]['inscricaoEstadual']; 
		$logo = $valorClientePJ[0]['logo'];
		$senhaAcesso = EncryptSenha::B64_Decode($valorClientePJ[0]['senhaAcesso']); 		
		$inativo = $valorClientePJ[0]['inativo']; 		 		
		$frequenciaMinimaExigida = $valorClientePJ[0]['frequenciaMinimaExigida'];  		
		$faltaJustificadaPresenca = $valorClientePJ[0]['faltaJustificadaPresenca']; 		
		$dataContratacao = Uteis::exibirData($valorClientePJ[0]['dataContratacao']); 		
		$obs = $valorClientePJ[0]['obs']; 		
		$dataCadastro = $valorClientePJ[0]['dataCadastro'];
		$clientePj_idClientePj = $valorClientePJ[0]['clientePj_idClientePj'];  
		$intGrupo = $valorClientePJ[0]['intGrupo'];  
		$empresaIndica = $valorClientePJ[0]['empresaIndica'];  
		$conheceu = $valorClientePJ[0]['conheceu'];

	} else {
	// Padrão para clientes novos.
		$faltaJustificadaPresenca = 1;
	}
		
?>



<div id="cadastro" class="">
<div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <div id="abas">
    <div id="aba_cadastro_clientepj" divExibir="div_cadastro_clientepj" class="aba_interna ativa">Dados pessoais</div>
    <?php if($idClientePj != "" && $idClientePj > 0){ ?>
     <div id="aba_indicacoes_clientepf" divExibir="div_indicacoes_clientepf" class="aba_interna">Follow-up / Indicações</div>
    <div id="aba_cadastro_clientepj" divExibir="div_contrato_clientepj" class="aba_interna">Contrato</div>
    <div id="aba_cadastro_clientepj" divExibir="div_aviso_clientepj" class="aba_interna">Avisos</div>
    <?php } ?>
    
  </div>
  <div id="modulos_clientepj" class="conteudo_nivel">
    <div id="div_cadastro_clientepj" class="div_aba_interna">
      <?php require_once 'include/form/clientePj.php';?>
      <?php if($idClientePj != "" && $idClientePj > 0){ ?>           
      <div id="div_lista_telefone" class="esquerda">
        <?php require_once 'include/resourceHTML/telefone.php';?>
      </div>
      <div id="div_lista_contatoAdicional" class="direita">
        <?php require_once 'include/resourceHTML/contatoAdicional.php';?>
      </div>
	  <div id="div_lista_endereco" class="linha-inteira">
        <?php require_once 'include/resourceHTML/endereco.php';?>
      </div> 
    </div>
   
   <div id="div_indicacoes_clientepf" style="display:none" class="div_aba_interna">
     <div class="esquerda" id="div_indicacaoClientePf_ClientePf">
        <?php require_once 'include/resourceHTML/indicacaoClientePf_ClientePf.php';?>
      </div>
      <div class="direita" id="div_indicacaoClientePf_ClientePj">
        <?php require_once 'include/resourceHTML/indicacaoClientePf_ClientePj.php';?>
      </div>
    </div>
   
   <div id="div_contrato_clientepj" style="display:none" class="div_aba_interna">
      <div id="div_lista_contrato" class="lista">
        <?php require_once 'include/resourceHTML/contrato.php';?>
      </div>
       <div id="div_anotacoes_financeiro" class="linha-inteira">
        <?php require_once 'include/resourceHTML/anotacoesFinanceiro.php'?>
      </div>
   </div>
  
   <div id="div_aviso_clientepj" style="display:none;" class="div_aba_interna">
      <div id="div_lista_aviso" class="lista">
        <?php require_once 'include/resourceHTML/aviso.php';?>
      </div>
  </div>
    <?php } ?>
  </div>
</div>
<script>
	ativarForm();
</script> 
