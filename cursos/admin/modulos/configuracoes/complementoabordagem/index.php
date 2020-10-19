<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ComplementoAbordagem = new ComplementoAbordagem();

?>

<div id="cadastro_ComplementoAbordagem" class="">
  <fieldset>
    <legend>Complemento de Abordagem</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/complementoabordagem/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/complementoabordagem/index.php";?>', '#cadastro_ComplementoAbordagem');" /> </div>
    <div class="lista">
      <table id="tb_lista_ComplementoAbordagem" class="registros">
        <thead>
          <tr>
            <th>idComplementoAbordagem</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Padrão</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/complementoabordagem/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/complementoabordagem/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/complementoabordagem/";		
		
		echo $ComplementoAbordagem->selectComplementoAbordagemTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idComplementoAbordagem</th>
            <th>Nome</th>
            <th>Status</th>
            <th>Padrão</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_ComplementoAbordagem', 'config');</script> 
</div>
