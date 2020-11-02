<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/NivelEstudo.class.php");

$NivelEstudo = new NivelEstudo();

?>
<div id="cadastro_NivelEstudo" class="">
<fieldset>
  <legend>NivelEstudo</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/nivelestudo/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/nivelestudo/index.php";?>', '#cadastro_NivelEstudo');" /> </div>
<div class="lista"><table id="tb_lista_NivelEstudo" class="registros">
    <thead>
      <tr>
	  <th>IdNivelEstudo</th><th>Nível</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/nivelestudo/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/nivelestudo/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/nivelestudo/";		
		
		echo $NivelEstudo->selectNivelEstudoTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>IdNivelEstudo</th><th>Nível</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_NivelEstudo', 'config');</script> 
</div>