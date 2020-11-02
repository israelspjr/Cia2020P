<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/EtapasProcessoSeletivoProfessor.class.php");

$EtapasProcessoSeletivoProfessor = new EtapasProcessoSeletivoProfessor();

?>
<div id="cadastro_EtapasProcessoSeletivoProfessor" class="">

<fieldset>
  <legend>Etapas Processo Seletivo Professor</legend>
  <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/etapasprocessoseletivoprofessor/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/etapasprocessoseletivoprofessor/index.php";?>', '#cadastro_EtapasProcessoSeletivoProfessor');" /> </div>
<div class="lista"><table id="tb_lista_EtapasProcessoSeletivoProfessor" class="registros">
    <thead>
      <tr>
	  <th>ID</th><th>Nome</th><th>Status</th>
	  	<th></th>
	  </tr>
    </thead>
    <tbody>
        <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/etapasprocessoseletivoprofessor/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/etapasprocessoseletivoprofessor/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/etapasprocessoseletivoprofessor/";		
		
		echo $EtapasProcessoSeletivoProfessor->selectEtapasProcessoSeletivoProfessorTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
    </tbody>
    <tfoot>
      <tr>
        <th>ID</th><th>Nome</th><th>Status</th>
	  	<th></th>
      </tr>
    </tfoot>
  </table></div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_EtapasProcessoSeletivoProfessor', 'config');</script> 
</div>