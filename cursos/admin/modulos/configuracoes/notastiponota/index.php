<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NotasTipoNota.class.php");

$NotasTipoNota = new NotasTipoNota();

?>

<div id="cadastro_NotasTipoNota" class="">
  <fieldset>
    <legend>Itens Tipo Nota</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/notastiponota/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/notastiponota/index.php";?>', '#cadastro_NotasTipoNota');" /> </div>
    <div class="lista">
      <table id="tb_lista_NotasTipoNota" class="registros">
        <thead>
          <tr>
            <th>idNotasTipoNota</th>
            <th>Tipo Nota</th>
            <th>Nome</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/notastiponota/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/notastiponota/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE n.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/notastiponota/";		
		
		echo $NotasTipoNota->selectNotasTipoNotaTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idNotasTipoNota</th>
            <th>Tipo Nota</th>
            <th>Nome</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_NotasTipoNota', 'config');</script> 
</div>
