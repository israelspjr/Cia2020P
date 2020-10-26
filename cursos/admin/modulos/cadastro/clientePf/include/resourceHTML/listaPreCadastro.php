<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$PreClientePf = new PreClientePf();
$Funcionario = new Funcionario();
$ClientePj = new ClientePj();

?>

<div id="cadastro_listaClientepf" class="">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
<!--    <div id="abas">
 <div id="aba_cadastro_clientepf" divExibir="div_cadastro_clientepf" class="aba_interna ativa">Dados Pessoais</div>-->
 <div id="modulos_clientepf" class="conteudo_nivel">
    <div id="div_cadastro_clientepf" class="div_aba_interna">

<fieldset>
<legend>Filtros</legend>

  <img src="/cursos/images/menos.png" title="Abrir/Fechar formuário" id="img_form_Grupos2" onclick="abrirFormulario('div_form_Grupos2', 'img_form_Grupos2');">
<div class="agrupa" id="div_form_Grupos2" style="display:block">

<form id="form_2" class="validate" method="post" action onsubmit="return false">
<div class="esquerda">
<label>Funcionário</label>
<p><?php echo $Funcionario->selectFuncionarioSelect();?></p>


<input type="radio" name="naoR" id="naoR" value="0" />Mostrar somente não realizados

<input type="radio" name="naoR" id="naoR" value="1" />Mostrar somente realizados

<input type="radio" name="naoR" id="naoR" value="2" checked/>Ambos
</div>
<div class="direita">
<label>Empresa</label>
<p><?php echo $ClientePj->selectClientePjSelect();?></p>


</div>


<div>
<p>&nbsp;</p>
</div>
</form>
<!--<button class="button blue" onclick="filtro_postForm('img_form_Grupos2', 'form_filtra_Grupos2', '/cursos/admin/modulos/cadastro/clientePf/include/resourceHTML/listaPreCadastro2.php', '', '#lista_res2')">Buscar</button>-->
<button class="button blue" id="buscar" onclick="filtro_postForm('img_form_Grupos2', 'form_2', '/cursos/admin/modulos/cadastro/clientePf/include/resourceHTML/listaPreCadastroR.php', '', '#lista_res2')">Buscar</button>


</div>
</fieldset>
</div>

<div id="lista_res2" class="lista"></div>
</div>
<script> 
tabelaDataTable('tb_lista_pre2');

function buscar() {
	$('#buscar').click();	
}
buscar();
</script> 
