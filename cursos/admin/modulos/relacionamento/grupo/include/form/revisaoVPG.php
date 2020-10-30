<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RevisaoVPG.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AcompanhamentoCurso.class.php");

$AcompanhamentoCurso = new AcompanhamentoCurso();
$RevisaoVPG = new RevisaoVPG();


$idRevisaoVPG = $_REQUEST['id'];
$idAcompanhamentoCurso = $_REQUEST['idAcompanhamentoCurso'];

if(is_numeric($idRevisaoVPG) && $idRevisaoVPG > 0){
	
	$rs = $RevisaoVPG->selectRevisaoVPG(" WHERE idRevisaoVPG = ".$idRevisaoVPG);

	$idAcompanhamentoCurso= $rs[0]['acompanhamentoCurso_idAcompanhamentoCurso'];
	$anexo= $rs[0]['anexo'];
	$data= Uteis::exibirData($rs[0]['data']);
	$obs= $rs[0]['obs'];
}

$mostrarAcoes = $AcompanhamentoCurso->verificaPodeEditar($idAcompanhamentoCurso);
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Revisão VPG </legend>
    <form id="formulario_upload_anexo" method="post" enctype="multipart/form-data" action="<?php echo CAMINHO_REL."grupo/include/acao/revisaoVPG.php"?>" style="display:none;">
      <input type="hidden" id="acao" name="acao" value="file" />
      <input type="hidden" id="acao" name="idRevisaoVPG" value="<?php echo $idRevisaoVPG?>" />
      <input type="file" id="add_file_anexo" onchange="enviaArquivo();" name="file" />
    </form>
    <form id="form_RevisaoVPG" class="validate" method="post" action="" onsubmit="return false" >
      <input name="idAcompanhamentoCurso" type="hidden" value="<?php echo $idAcompanhamentoCurso?>" />
      <p>
        <label>Anexo:</label>
        <img style="float:left;" src="<?php echo CAMINHO_IMG?>upload_file.png" onclick="$('#add_file_anexo').click();" title="Anexar novo"/>
      <div id="visualizar_anexo" >
        <p>
          <input type="text" name="file_oculto_anexo" readonly="readonly" value="<?php echo $anexo?>" class="required"/>
          <span class="placeholder">Insira um arquivo</span></p>
      </div>
      </p>
      <p>
        <label>Data:</label>
        <input type="text" name="data" id="data" class="required data" value="<?php echo $data?>" />
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <label>Observação:</label>
        <textarea name="obs" id="obs" cols="40" rows="4"><?php echo $obs?></textarea>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <?php if($mostrarAcoes){?>
        <button class="button blue" onclick="postForm('form_RevisaoVPG', '<?php echo CAMINHO_REL."grupo/include/acao/revisaoVPG.php?id=$idRevisaoVPG"?>')">
        Enviar</button>
        
        <?php } ?>
      </p>
    </form>
  </fieldset>
</div>

<script>
function enviaArquivo(){
	$('#visualizar_anexo').attr({'status':'esperando'}).html('Carregando arquivo...')
		$('#formulario_upload_anexo').ajaxForm({
		target:'#visualizar_anexo', // o callback será no elemento com o id #visualizar	
		success: function() {
			$('#visualizar_anexo').removeAttr('status');
			alert('Arquivo carregado');
		}
	}).submit();
}

ativarForm();
</script> 
