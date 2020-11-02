<?php
//pagina contendo a listagem
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Regras = new Regras();

?>

<div id="cadastro_Regras" class="">
  <fieldset>
    <legend>Regras</legend>
    <div class="menu_interno"> <img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo cadastro" onclick="abrirNivelPagina(this, '<?php echo CAMINHO_MODULO."configuracoes/regras/formulario.php";?>', '<?php echo CAMINHO_MODULO."configuracoes/regras/index.php";?>', '#cadastro_Regras');" /> </div>
    <div class="lista">
      <table id="tb_lista_Regras" class="registros">
        <thead>
          <tr>
            <th>idRegras</th>
            <th>Título Regra</th>
            <th> TipoCurso</th>
            <th>Status</th>
            <th>Padrão</th>
            <th>B2B</th>
            <th>B2C</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php 
		$caminhoAbrir= CAMINHO_MODULO."configuracoes/regras/formulario.php";
		$caminhoAtualizar= CAMINHO_MODULO."configuracoes/regras/index.php";
		$ondeAtualiza= "#centro";
		$where = " WHERE excluido = 0";
		$idPai = "";
		$caminhoModulo = CAMINHO_MODULO."configuracoes/regras/";		
		
		echo $Regras->selectRegrasTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, $idPai, $caminhoModulo);
		?>
        </tbody>
        <tfoot>
          <tr>
            <th>idRegras</th>
            <th>Título Regra</th>            
            <th> TipoCurso</th>
            <th>Status</th>
            <th>Padrão</th>
            <th>B2B</th>
            <th>B2C</th>
             <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </fieldset>
  <script>tabelaDataTable('tb_lista_Regras', 'config');</script> 
</div>
