<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
		
$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();
$NivelLingustico = new NivelLinguistico();
$Professor = new Professor();
$Telefone = new Telefone();
$EnderecoVirtual = new EnderecoVirtual();

$professor_idProfessor = $_GET['id'];	

if($professor_idProfessor!=''){
	
	$valorPSP = $ProcessoSeletivoProfessor->selectProcessoSeletivoProfessor("WHERE professor_idProfessor = ".$professor_idProfessor);
	
	$idPSP = $valorPSP[0]['idProcessoSeletivoProfessor'];
	$nome = $Professor->getNome($valorPSP[0]['professor_idProfessor']);
	$email = $Professor->getEmail($valorPSP[0]['professor_idProfessor']);
	$mora = $valorPSP[0]['regiaoAtende'];
	
	$telefones = $Telefone->selectTelefone(" WHERE professor_idProfessor = ".$valorPSP[0]['professor_idProfessor']);
	
	$ddd = $telefones[0]['ddd'];
	$tel = $telefones[0]['numero'];
	
	
	//skype
	$rs = $EnderecoVirtual->selectEnderecoVirtual(" WHERE professor_idProfessor = ".$professor_idProfessor." AND tipoEnderecoVirtual_idTipoEnderecoVirtual = 9");
	$skype = $rs[0]['valor'];
	
	//Nacionalidade
	$nacionalidade = $Professor->getnacionalidade($valorPSP[0]['professor_idProfessor']);
	
	// Idade
	$idade = $Professor->getIdade($valorPSP[0]['professor_idProfessor']);


	$geral = 1;
	$totalCandidatos = 1;
} 
	
?>

<div id="cadastro_professor">
 <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  
  <div id="abas">
  <div id="aba_candidato1" divExibir="aba_P_candidato1" class="aba_interna ativa"><?php echo $nome?></div>';
  </div>
  
  <div id="modulos_professor"  class="conteudo_nivel" > 
  <fieldset>
    <legend>Quadro completo Processo seletivo</legend>
    <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_idiomaProfessor', 'img_');" />
    
   		<div id="aba_P_candidato1" class="div_aba_interna">
  
    <div class="agrupa" id="div_form_idiomaProfessor">
 
        <div class="esquerda">
        <p>
        <label>Nome:</label>
        <?php echo $nome; ?>
        </p>
        <p>
        <label>Email:</label>
		<?php echo $email; ?></p>
        <p>
        <label>WhatsApp:</label>
         <?php echo $ddd."-".$tel; ?></p>
        </p>
        <p>
        <label>Skype:</label>
        <?php echo $skype;?>
        </p>
     <div id="div_lista_comportamental">
          <?php require_once 'comportamental.php';?>
     </div>   
        </div>
        <div class="esquerda">
        <p>
        <label>Nacionalidade:</label>
        <?php echo $nacionalidade;?>
        </p>
        <p>
        <label>Mora:</label>
        <?php echo $mora;?> 
        </p>
        <p>
        <label>Idade:</label>
       <?php echo $idade;?> anos </p>
     
   
	</div>
    
<div class="direita">
	<div id="div_lista_pedagogico">
          <?php require_once 'pedagogico.php';?>
    </div>
    <div id="div_lista_analiseFinal">
          <?php require_once 'analiseFinal.php';?>
    </div>
</div>
<div class="linha-inteira">
	<div id="div_lista_avaliacao">
          <?php require_once 'avaliacaoOralNivel.php';?>
    </div>
</div>
</div>
    </div>
 </fieldset>
 </div>
</div>