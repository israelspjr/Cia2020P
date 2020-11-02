<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ComoConheceu.class.php");

$ComoConheceu = new ComoConheceu();

?>
<div id="cadastro_ComoConheceu" class="">
 
<fieldset>
  <legend>Como Conheceu</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/comoconheceu/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/comoconheceu/index.php";?>', '#cadastro_ComoConheceu');" /> </div>
<div class="lista"><table id="tb_lista_ComoConheceu" class="registros">
    <thead>
      <tr>
	  <th>idComoConheceu</th><th>Como Conheceu</th><th>Aluno</th><th>Professor</th><th>Geral</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/comoconheceu/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/comoconheceu/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/comoconheceu/";		
		
		echo $ComoConheceu->selectComoConheceuTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>idComoConheceu</th><th>Como Conheceu</th><th>Aluno</th><th>Professor</th><th>Geral</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_ComoConheceu', 'config');</script> 
</div>