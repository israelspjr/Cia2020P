<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
				
$Professor = new Professor();	
$TextoEmailPadrao = new TextoEmailPadrao();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$PlanoAcao = new PlanoAcao();
$Proposta = new Proposta();
$ClientePj = new ClientePj();

$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];
$conteudoEmailAdd = $TextoEmailPadrao->getTexto("3");

$idPlanoAcao = $PlanoAcaoGrupo->getIdPlanoAcao($idPlanoAcaoGrupo);
//echo $idPlanoAcao;
$idProposta = $PlanoAcao->getIdProposta($idPlanoAcao);
//echo "proposta : ".Uteis::pr($idProposta);

$idClientePj = $Proposta->get_clientePj_idClientePJ($idProposta);

$nome = $ClientePj->getNome($idClientePj);


?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Disparo de e-mail</legend>
    <form id="form_disparoEmail" class="validate" action="" method="post" onsubmit="return false" >

      <div class="esquerda">
        <p>
          <label>Assunto</label>
          <input type="text" name="assunto" id="assunto" value="Oferta de trabalho" class="required" />
        </p>
        <p>
          
        <div class="linha-inteira">
        
          Empresa: <?php echo $nome?>
          <input type="hidden" name="empresa" id="empresa" value="<?php echo $nome?>" class="required" />
          <br />
       <!--   Endereço: <?php //echo $endereco; ?>
          <input type="hidden" name="idEndereco" id="idEndereco" value="<?php echo $idEndereco?>" class="required" />-->
        
          <label><strong>Professor(s):</strong></label>
          <?php echo $Professor->selectProfessorCheckBox_oferta($idPlanoAcaoGrupo) ?>
          <br />
        
          </div>
       
      </div>
      </p>
      <div class="direita" >
        <p>
          <label>Cópia</label>
          <img id="copiaAdd" src="<?php echo CAMINHO_IMG."mais2.png"?>" title="INSERIR EM CÓPIA" />
          <input type="text" name="copiaAux" id="copiaAux" />
          <span class="placeholder"></span></p>
        <img id="copiaRemove" src="<?php echo CAMINHO_IMG."menos2.png"?>" title="RMOVER DE CÓPIA CÓPIA" />
        <select multiple="multiple" name="copia[]" id="copia" >
        </select>
        </p>
        <p>
          <label>Cópia oculta</label>
          <img id="copiaOcultaAdd" src="<?php echo CAMINHO_IMG."mais2.png"?>" title="INSERIR EM CÓPIA CÓPIA OCULTA" />
          <input type="text" name="copiaOcultaAux" id="copiaOcultaAux" />
          <span class="placeholder"></span></p>
        <img id="copiaOcultaRemove" src="<?php echo CAMINHO_IMG."menos2.png"?>" title="RMOVER DE CÓPIA CÓPIA OCULTA" />
        <select multiple="multiple" name="copiaOculta[]" id="copiaOculta"  >
        </select>
        </p>
      </div>
      <div class="linha-inteira">
        
          <p><label>Conteúdo adicional do e-mail:</label>
          <textarea name="conteudoEmailAdd_base" id="conteudoEmailAdd_base" rows="6" cols="80" class=""><?php echo $conteudoEmailAdd?></textarea>
          <textarea name="conteudoEmailAdd" id="conteudoEmailAdd" ></textarea></p>

        <p>
          <button class="button blue" onclick="dispara()">Enviar</button>
          
        </p>
      </div>
    </form>
  </fieldset>
</div>
<script src="<?php echo CAMINHO_CFG."js/email.js"?>" type="text/javascript" ></script> 
<script>
function dispara(){
	$('#copia').find('option').attr('selected', true);
	$('#copiaOculta').find('option').attr('selected', true);
	postForm_editor('conteudoEmailAdd', 'form_disparoEmail', '<?php echo CAMINHO_REL."busca/vendas/include/acao/disparoEmail.php?idPlanoAcaoGrupo=".$idPlanoAcaoGrupo?>');	
}

viraEditor('conteudoEmailAdd');
ativarForm(); 
</script>