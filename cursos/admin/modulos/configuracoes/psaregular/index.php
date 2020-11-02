<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/PsaRegular.class.php");

$PsaRegular = new PsaRegular();

?>

<div id="cadastro_PsaRegular" class="">
  <fieldset>
    <legend>P.S.A. Regular</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/psaregular/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/psaregular/index.php";?>', '#cadastro_PsaRegular');" /> </div>
    <div class="lista">
      <table id="tb_lista_PsaRegular" class="registros">
        <thead>
          <tr>
            <th>idPsa</th>
            <th>Tipo</th>
            <th>Título</th>
            <th>Pergunta</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/psaregular/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/psaregular/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE p.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/psaregular/";		
		
		echo $PsaRegular->selectPsaRegularTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idPsa</th>
            <th>Tipo</th>
            <th>Título</th>
            <th>Pergunta</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_PsaRegular', 'config');</script> 
</div>
