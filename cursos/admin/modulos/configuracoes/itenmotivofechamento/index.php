<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItenMotivoFechamento.class.php");

$ItenMotivoFechamento = new ItenMotivoFechamento();

?>
<div id="cadastro_ItenMotivoFechamento" class="">
<fieldset>
  <legend>Item Motivo Fechamento: </legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="NOVO CADASTRO" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/itenmotivofechamento/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/itenmotivofechamento/index.php";?>', '#cadastro_ItenMotivoFechamento');" /> </div>
<table id="tb_lista_ItenMotivoFechamento" class="registros">
    <thead>
      <tr>
	  <th>idItenMotivoFechamento</th><th>Item</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/itenmotivofechamento/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/itenmotivofechamento/index.php";
		$ondeAtualiza= "#cadastro_ItenMotivoFechamento";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/itenmotivofechamento/";		
		
		echo $ItenMotivoFechamento->selectItenMotivoFechamentoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idItenMotivoFechamento</th><th>Item</th><th>Status</th>
		<th></th>
      </tr>
    </tfoot>
  </table>
  </fieldset>
  <script>tabelaDataTable('tb_lista_ItenMotivoFechamento', 'config');</script> 
</div>