<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/SotaqueIdiomaProfessor.class.php");

$SotaqueIdiomaProfessor = new SotaqueIdiomaProfessor();

?>
<div id="cadastro_SotaqueIdiomaProfessor" class="">
<fieldset>
  <legend>Sotaque Idioma Professor</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/sotaqueidiomaprofessor/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/sotaqueidiomaprofessor/index.php";?>', '#cadastro_SotaqueIdiomaProfessor');" /> </div>
<div class="lista"><table id="tb_lista_SotaqueIdiomaProfessor" class="registros">
    <thead>
      <tr>
	  <th>idSotaqueIdiomaProfessor</th><th>Idioma</th><th>Valor</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/sotaqueidiomaprofessor/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/sotaqueidiomaprofessor/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE s.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/sotaqueidiomaprofessor/";		
		
		echo $SotaqueIdiomaProfessor->selectSotaqueIdiomaProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idSotaqueIdiomaProfessor</th><th>Idioma</th><th>Valor</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_SotaqueIdiomaProfessor', 'config');</script> 
</div>