<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
		
$ProcessoSeletivoProfessor = new ProcessoSeletivoProfessor();
$NivelLingustico = new NivelLinguistico();
$Professor = new Professor();
$Telefone = new Telefone();
$EnderecoVirtual = new EnderecoVirtual();

$ids = $_GET['ids'];
$arr_ids = explode(',', $ids);
$arr_ids2 = $arr_ids;

$html1 ="";
$geral = 1;

?>

<div id="cadastro_professor">
 <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  
  <div id="abas">
  <?php for ($x=0;$x<count($arr_ids);$x++) {
	  if ($x==0) {
		  $ativo = 'ativa';
		  $style = 'style="display:block"';
	  } else {
		  $ativo = '';
		  $style = 'style="display:none"';
	  }
	  $valorPSP = $ProcessoSeletivoProfessor->selectProcessoSeletivoProfessor("WHERE idProcessoSeletivoProfessor = ".$arr_ids[$x]);
	  $nome = $Professor->getNome($valorPSP[0]['professor_idProfessor']);
	  
	  echo '  <div id="aba_candidato'.$x.'" divExibir="aba_P_candidato'.$x.'" class="aba_interna '.$ativo.'">'.$nome.'</div>';


  } ?>
  </div>
  
  <div id="modulos_professor"  class="conteudo_nivel" style="width: max-content;"> 
  <fieldset>
    <legend>Quadro completo Comportamentais</legend>
    <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_idiomaProfessor', 'img_');" />
			  
	<?php	  
	
	
	 for ($y=0;$y<count($arr_ids2);$y++) {
		  if ($y==0) {
		  $ativo = 'ativa';
		  $style = 'style="display:block"';
	  } else {
		  $ativo = '';
		  $style = 'style="display:none"';
	  }

	  $valorPSP2 = $ProcessoSeletivoProfessor->selectProcessoSeletivoProfessor("WHERE idProcessoSeletivoProfessor = ".$arr_ids[$y]);
	  $nome2 = $Professor->getNome($valorPSP2[0]['professor_idProfessor']);
	  $email = $Professor->getEmail($valorPSP2[0]['professor_idProfessor']);
	  $mora = $valorPSP2[0]['regiaoAtende'];
	  $telefones = $Telefone->selectTelefone(" WHERE professor_idProfessor = ".$valorPSP2[0]['professor_idProfessor']);
	
	  $ddd = $telefones[0]['ddd'];
	  $tel = $telefones[0]['numero'];
	  
	//skype
	$rs = $EnderecoVirtual->selectEnderecoVirtual(" WHERE professor_idProfessor = ".$valorPSP2[0]['professor_idProfessor']." AND tipoEnderecoVirtual_idTipoEnderecoVirtual = 9");
	$skype = $rs[0]['valor'];
	  
	//Nacionalidade
   	$nacionalidade = $Professor->getnacionalidade($valorPSP2[0]['professor_idProfessor']);
	
	// Idade
	$idade = $Professor->getIdade($valorPSP2[0]['professor_idProfessor']);
	
	//Form e outros
	$idPSP = $arr_ids2[$y];

//	echo '<div id="aba_P_candidato'.$y.'" class="div_aba_interna '.$ativo.'" '.$style.'>';
?>
 
	  <div style="width:500px;float:left;">
	  <p><label>Nome:</label><?php echo $nome2?>  <span style="float:right;width:40%";><label>Nacionalidade:</label><?php echo $nacionalidade?></span></p>
	  <p><label>Email:</label><?php echo $email?>     <span style="float:right;width:40%";><label>Mora:</label><?php echo $mora?></span></p>
	  <p><label>WhatsApp:</label><?php echo $ddd."-".$tel;?>   <span style="float:right;width:40%";><label>Idade:</label><?php echo $idade?> anos</span> </p>
      <p><label>Skype:</label><?php echo $skype?></p>
	  <p>
      	<div id="div_lista_comportamental"> 
	  		<?php require 'comportamental.php'; ?>
      	</div>
      </div>
	  
<!--	  <div class="direita"><p></p>
	  <p></p>
	  <p></p>
<!--	  <div id="div_lista_pedagogico">
           <?php //require 'pedagogico.php';?>
      </div>
<!--      <div id="div_lista_analiseFinal">
           <?php //require 'analiseFinal.php'?>
      </div>
	  
<!--	  <div class="linha-inteira"><div id="div_lista_avaliacao">
           <?php //require 'avaliacaoOralNivel.php';?>
      </div>
     
      </div>-->
  
       
<?php } ?>   

		
        </div><!-- fechamento geral-->	
</div>