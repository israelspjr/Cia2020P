<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ClientePj.class.php");
		
$ClientePj = new ClientePj();	

$idGgerenteTem = $_GET['id'];
$idGerente = $_GET['idGerente'];
?>

<div class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
  <fieldset>
    <legend>Vincular gerente p. jurídica</legend>
    <form id="form_gerenteClientePj" class="validate" action="" method="post" onsubmit="return false" >
      <input type="hidden" name="idGerente" id="idGerente" value="<?php echo $idGerente?>" /> 
      <p>
        <label>Clientes p. jurídica:</label>
        <?php
		$and = " AND inativo = 0 AND idClientePj NOT IN (
			SELECT COALESCE(GT.clientePj_idClientePj, 0) FROM gerenteTem AS GT
			WHERE GT.dataExclusao IS NULL 
		)";		
		echo $ClientePj->selectClientePjSelect(0, "required", $and);
    	?>
        <span class="placeholder">Campo Obrigatório</span> </p>
      <p>
        <button class="button blue" onclick="postForm('form_gerenteClientePj', '<?php echo CAMINHO_CAD."gerente/include/acao/gerenteTem.php?id=$idGgerenteTem"?>')" >
        Salvar</button>
      </p>
    </form>
  </fieldset>
</div>
<script>ativarForm();</script> 