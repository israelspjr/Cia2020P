<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$id_clientePj = $_POST['id'];

$ComoConheceu = new ComoConheceu();
$Proposta = new Proposta();	
$ClientePj = new ClientePj();
$Idioma = new Idioma();
$TipoContatoProposta = new TipoContatoProposta();
$Gestor = new Gestor();	
$idInserido = $_REQUEST['idInserido'];	
$idProposta = $_GET['id'];

//POR PADRÃO COMEÇA EM ABERTO
$statusAprovacaoIdStatusAprovacao = "1";

if($idProposta != '' && $idProposta  > 0){

	$valorProposta = $Proposta->selectProposta('WHERE idProposta='.$idProposta);

	$clientePjIdClientePj = $valorProposta[0]['clientePj_idClientePj']; 
	$idComoConheceu = $valorProposta[0]['comoConheceu_idComoConheceu'];
      $idiomaIdIdioma = $valorProposta[0]['idioma_idIdioma'];         
      $tipoContatoIdTipoContato = $valorProposta[0]['tipoContato_idTipoContato']; 
      $gestorIdGestor = $valorProposta[0]['gestor_idGestor']; 
      $statusAprovacaoIdStatusAprovacao = $valorProposta[0]['statusAprovacao_idStatusAprovacao']; 
	$obs = $valorProposta[0]['obs']; 
}

?>

<fieldset>
  <legend>Dados principais-<?=$idInserido?></legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_" onclick="abrirFormulario('div_form_Proposta', 'img_');" />
  <div class="agrupa" id="div_form_Proposta">
    <form id="form_Proposta" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="statusAprovacaoIdStatusAprovacao" id="statusAprovacaoIdStatusAprovacao" value="<?php echo $statusAprovacaoIdStatusAprovacao ?>" />
      <div class="esquerda">
        <?php if($idProposta != '' && $idProposta  > 0){?>
        <p>ID: <strong><?php echo $idProposta;?></strong></p>
        <?php }?>
        <p>
          <label>Cliente PJ :</label>
          <?php 
          if($idProposta==""){
          echo $ClientePj->selectClientePjSelect($clientePjIdClientePj, "required");
          ?>
          <img src="<?php echo CAMINHO_IMG."mais2.png"?>" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_CAD."clientePj/cadastro.php?p=1";?>', '#div_form_Proposta');">
          <?php
          }else{
          ?>
          <?php echo $ClientePj->getNome($clientePjIdClientePj);?>
          <input type="hidden" name="idClientePj" id="idClientePj" value="<?php echo $clientePjIdClientePj; ?>">  
          <?php
            }
          ?> 
          </p>
        <p>
          <label>Idioma:</label>
          <?php 
            		$and = " AND disponivelAula = 1 "; 
            		echo $Idioma->selectIdiomaSelect("required", $idiomaIdIdioma, $and);
          ?>
          <span class="placeholder">Campo Obrigatório</span></p>
           <p>
          <label>Gestor:</label>
          <?php echo $Gestor->selectGestorSelect("", $gestorIdGestor);?></p>
        </p>
        
      </div>
      <div class="direita">
        <p>
          <label>Como foi feito contato conosco:</label>
          <?php echo $TipoContatoProposta->selectTipoContatoPropostaSelect("", $tipoContatoIdTipoContato);?></p>
       
        <p>
          <label>Como conheceu?:</label>
          <?php echo $ComoConheceu->selectComoConheceuSelect("", $idComoConheceu);?></p>
        </p>
        <p>
          <label>Observação:</label>
          <textarea name="obs" id="obs" class="" cols="40" rows="4" ><?php echo $obs?></textarea>
          <span class="placeholder">Campo Obrigatório</span> </p>
      </div>
      <div class="linha-inteira">
        <p>
          <button class="button blue" onclick="postForm('form_Proposta', '<?php echo CAMINHO_VENDAS?>proposta/include/acao/proposta.php?id=<?php echo $idProposta?>');">Salvar</button>
          
        </p>
      </div>
    </form>
  </div>
</fieldset>
<script>

ativarForm();
</script>