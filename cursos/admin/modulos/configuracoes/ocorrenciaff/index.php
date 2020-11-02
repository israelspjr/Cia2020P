<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/OcorrenciaFF.class.php");

$OcorrenciaFF = new OcorrenciaFF();

?>

<div id="cadastro_OcorrenciaFF" class="">
  <fieldset>
    <legend>Ocorrencia F.F.</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/ocorrenciaff/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/ocorrenciaff/index.php";?>', '#cadastro_OcorrenciaFF');" /> </div>
    <div class="lista">
      <table id="tb_lista_OcorrenciaFF" class="registros">
        <thead>
          <tr>
            <th>idOcorrenciaFF</th>
            <th>Sigla</th>
            <th>Decrição Sigla</th>
            <th>Status</th>
            <th>Pagar Professor</th>
            <th>Repor Aula</th>
            <th>Pagar Reposição</th>
            <th>Professor Ve.</th>
            <th>Admin Ve.</th>
            <th>Horas expirão?</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/ocorrenciaff/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/ocorrenciaff/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/ocorrenciaff/";		
		
		echo $OcorrenciaFF->selectOcorrenciaFFTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idOcorrenciaFF</th>
            <th>Sigla</th>
            <th>Decrição Sigla</th>
            <th>Status</th>
            <th>Pagar Professor</th>
            <th>Repor Aula</th>
            <th>Pagar Reposição</th>
            <th>Professor Ve.</th>
            <th>Admin Ve.</th>
            <th>Horas expirão?</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_OcorrenciaFF', 'config');</script> 
</div>
