<?php
//pagina contendo a listagem

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/RelacionamentoINF.class.php");

$RelacionamentoINF = new RelacionamentoINF();

?>

<div id="cadastro_RelacionamentoINF" class="">
  <fieldset>
    <legend>RelacionamentoINF</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/relacionamentoinf/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/relacionamentoinf/index.php";?>', '#cadastro_RelacionamentoINF');" /> </div>
    <div class="lista">
      <table id="tb_lista_RelacionamentoINF" class="registros">
        <thead>
          <tr>
            <th>idRelacionamentoINF</th>
            <th>idioma</th>
            <th>nivel Estudo</th>
            <th>foco Curso</th>
            <th>carga Horaria</th>
            <th>Status</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/relacionamentoinf/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/relacionamentoinf/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE r.excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/relacionamentoinf/";		
		
		echo $RelacionamentoINF->selectRelacionamentoINFTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idRelacionamentoINF</th>
            <th>idioma</th>
            <th>nivel Estudo</th>
            <th>foco Curso</th>
            <th>carga Horaria</th>
            <th>Status</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_RelacionamentoINF', 'simples');</script> 
</div>
