<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Aviso = new Aviso();
$IntegranteGrupo = new IntegranteGrupo();

$idAviso = $_GET['id'];
//QUEM ENVIOU A MSG
$idClientePf = $_SESSION['idClientePf_SS'];

if($idAviso){
    
	$valor = $Aviso->selectAviso(" WHERE idAviso = ".$idAviso);
		
	//QUEM RECEBERA A MSG
	$idProfessor_enviou = $valor[0]['professor_idProfessor_enviou'];
	$idFuncionario_enviou = $valor[0]['funcionario_idFuncionario_enviou'];
	
	//DADOS
	$tituloAviso = $valor[0]['tituloAviso'];
	$aviso = $valor[0]['aviso'];
	$dataAviso = Uteis::exibirData($valor[0]['dataAviso']);
	 
	//MARCAR COMO LIDO
	$lido = $valor[0]['lido'];
	$dataVisualizacao = $valor[0]['dataVisualizacao'];
	if(!$lido || !$dataVisualizacao){
		$Aviso->setIdAviso($idAviso);
		$Aviso->updateFieldAviso("lido", "1");   
		$Aviso->updateFieldAviso("dataVisualizacao", date('Y-m-d H:i:s'));   
	}
	
}

$idIntegranteGrupo_s = $IntegranteGrupo->getidIntegranteGrupo($idClientePf);
?>

<br />
<!--<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>-->
  <fieldset>
    <legend>Avisos</legend>
    <?php if($idAviso){?>
    <div class="linha-inteira">
      <form class="validate">
        <p><strong>Aviso:</strong></p>
        <p>
          <label>Titulo:</label>
          <?php echo $tituloAviso?> - <?php echo $dataAviso?></p>
        <p>
          <label>Mensagem:</label>
        	<textarea name="avisoRecebido_base" id="avisoRecebido_base" ><?php echo $aviso?></textarea>
	        <textarea name="avisoRecebido" id="avisoRecebido" class="required" ></textarea>
        </p>
      </form>
			<script>viraEditor('avisoRecebido');</script>	
      
      <form id="form_Aviso" class="validate" method="post" action="" onsubmit="return false" >
        <p><strong>Responder:</strong></p>
        <input type="hidden" name="idAviso" id="idAviso" class="required" value="<?php echo $idAviso?>" />
        
        <!--QUEM ESTA ENVIANDO A MSG-->
        <input type="hidden" name="idClientePf_enviou" id="idClientePf_enviou" value="<?php echo $idClientePf?>" />
        
        <!--QUEM RECEBERÁ A MSG-->
        <input type="hidden" name="idProfessor" id="idProfessor" value="<?php echo $idProfessor_enviou?>" />
        <input type="hidden" name="idFuncionario" id="idFuncionario" value="<?php echo $idFuncionario_enviou?>" />
        <p>
          <label>Titulo:</label>
          <input type="text" name="titulo" id="titulo" value="" class="required"/>
          <span class="placeholder">Campo obrigatório</span></p>
        <p>
          <label>Resposta:</label>
          <textarea name="aviso_base" id="aviso_base" ></textarea>
	        <textarea name="aviso" id="aviso" class="required" ></textarea>
          <span class="placeholder">Campo obrigatório</span></p>
        <p>
          <button class="button blue" onclick="postForm_editor('aviso', 'form_Aviso', '<?php echo CAMINHO_MODULO."aviso/acao/aviso.php"?>');">Salvar</button>
        </p>
      </form>
    </div>
    <?php }else{?>
    <form id="form_Aviso" class="validate" method="post" action="" onsubmit="return false" >
      <p><strong>Novo aviso:</strong></p>
      <input type="hidden" name="idClientePf_enviou" id="idClientePf_enviou" value="<?php echo $idClientePf?>" />
      <p>
        <label>Pra quem:</label>
        <label for="professor">
          <input type="radio" name="paraQuem" id="professor" onclick="alternarParaQuem('#cotentProfessor', '#contentGerente')" value="1"/>
          Professor</label>
      <div id="cotentProfessor" style="display:none;">
        <p> <?php echo $IntegranteGrupo->select_professoresIntegranteGrupo($idIntegranteGrupo_s, "", "required")?><span class="placeholder">Campo obrigatório</span></p>
      </div>
      <label for="gerente">
        <input type="radio" name="paraQuem" id="gerente" value="2" onclick="alternarParaQuem('#contentGerente', '#cotentProfessor')" />
        Gerente</label>
      <div id="contentGerente" style="display:none;">
        <p> <?php echo $IntegranteGrupo->select_gerentePorIdCliente($idClientePf, "", "required")?><span class="placeholder">Campo obrigatório</span></p>
      </div>
      </p>
      <p>
        <label>Titulo:</label>
        <input type="text" name="titulo" id="titulo" value="" class="required"/>
        <span class="placeholder">Campo obrigatório</span></p>
      <p>
        <label>Mensagem:</label>
        <textarea name="aviso_base" id="aviso_base" class="tinymce" ></textarea>
	      <textarea name="aviso" id="aviso" class="required" ></textarea>
        <span class="placeholder">Campo obrigatório</span></p>
      <p>
        <button class="button blue" onclick="enviarAviso()">Salvar</button>
      </p>
    </form>
    <script>
			
			function alternarParaQuem(mostra, esconde){	
				$( mostra ).show().find('select').addClass('required');
				$( esconde ).hide().find('select').removeClass('invalid required').find('option').prop('selected', false);
			}
			
			function enviarAviso(){
				if( $('input[type=radio][name=paraQuem]:checked').val() != undefined ){
					postForm_editor('aviso', 'form_Aviso', '<?php echo "cursos/portais/aviso/avisoAcao.php"?>');
				}else{
					alerta('Escolha para quem irá o aviso.');
				}
			}
			
			</script>
    <?php }?>
  </fieldset>
</div>
<script>
//ativarForm();
viraEditor('aviso');
</script> 