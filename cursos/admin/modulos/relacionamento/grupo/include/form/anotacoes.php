<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
	
	//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RegistroDeAnotacoes.class.php");	
		
	$RegistroDeAnotacoes = new RegistroDeAnotacoes();	
		
		
	$idRegistroDeAnotacoes = $_GET['id'];
	$proposta_idProposta = $_GET['idProposta'];
	$planoAcao_idPlanoAcao = $_GET['idPlanoAcao'];
	$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];	

	if($idRegistroDeAnotacoes != '' && $idRegistroDeAnotacoes  > 0){
	
		$valorRegistroDeAnotacoes = $RegistroDeAnotacoes->selectRegistroDeAnotacoes('WHERE financeiro = 0 AND idRegistroDeAnotacoes='.$idRegistroDeAnotacoes);
		
		$proposta_idProposta = $valorRegistroDeAnotacoes[0]['proposta_idProposta'];
	    $planoAcao_idPlanoAcao = $valorRegistroDeAnotacoes[0]['planoAcao_idPlanoAcao'];
	    $idPlanoAcaoGrupo = $valorRegistroDeAnotacoes[0]['planoAcaoGrupo_idPlanoAcaoGrupo'];
	    $titulo = $valorRegistroDeAnotacoes[0]['titulo'];
	    $anotacao = $valorRegistroDeAnotacoes[0]['anotacao'];
		$dataNovoContato = Uteis::exibirData( $valorRegistroDeAnotacoes[0]['dataNovoContato'] );
		

	}
	
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Anotações </legend>
    <form id="form_RegistroDeAnotacoes" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="idPlanoAcaoGrupo" id="idPlanoAcaoGrupo" value="<?php echo $idPlanoAcaoGrupo ?>" />
      <p>
        <label>Título: </label>
        <input type="text" name="titulo" id="titulo" value="<?php echo $titulo ?>" class="required" />
        <span class="placeholder">Campo obrigatório</span></p>
      <p>
        <label>Data para novo contato: </label>
        <input type="text" name="dataNovoContato" id="dataNovoContato" value="<?php echo $dataNovoContato ?>" class="data" />
      </p>
      <p>
        <label>Anotação: </label>
        <textarea id="anotacao" name="anotacao" class="required" cols="60" rows="6"><?php echo $anotacao ?></textarea>
        <span class="placeholder">Campo obrigatório</span></p>
      <p>
        <button class="button blue" onclick="postForm('form_RegistroDeAnotacoes', '<?php echo CAMINHO_REL?>grupo/include/acao/anotacoes.php?id=<?php echo $idRegistroDeAnotacoes?>&idPlanoAcaoGrupo=<?php echo $idPlanoAcaoGrupo?>');">Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 
