<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Idioma = new Idioma();
$ClientePj = new ClientePj();
$Representante = new Representante();
$StatusAprovacao = new StatusAprovacao();
$NivelEstudo = new NivelEstudo();
$FocoCurso = new FocoCurso();
$TipoCurso = new TipoCurso();
?>

<fieldset>
  <legend>Filtros</legend>
 	
 	<div class="menu_interno"> 
  
		<img src="<?php echo CAMINHO_IMG."novo.png";?>" title="Novo Plano de Ação" 
	  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/cadastro.php";?>', 'click', '#bt');" /> 
      
        <img src="<?php echo CAMINHO_IMG."pasta.png";?>" title="Histórico de excluídos" 
	  onclick="abrirNivelPagina(this, '<?php echo CAMINHO_VENDAS."planoAcao/historico.php";?>', 'click', '#bt');" /> 
  
  </div>
  
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_filtra_Grupos"  class="validate" method="post" action="" onsubmit="return false" >
      <div class="linha-inteira">
        <div class="esquerda">
         <p>
          <label>Id Plano de Ação:</label>
              <input type="text" name="idPlanoAcao" id="idPlanoAcao" class="numeric" />         
          <span class="placeholder"></span>
        </p>
          <p>
            <label>Data de abertura:</label>
            de
            <input type="text" name="dataCadastro" id="dataCadastro" class="data" value="" />
            a
            <input type="text" name="dataCadastro2" id="dataCadastro2" class="data" value="" />
            <span class="placeholder"></span></p>
          <p>
            <label>Idioma:</label>
            <?php echo $Idioma->selectIdiomaSelectMult("", "", " AND disponivelAula = 1")?></p>
          <p>
            <label>Empresa:</label>
            <?php echo $ClientePj->selectClientePjSelectMult("", "", " AND inativo = 0")?></p>
          <p>
            <label>Status da aprovação:</label>
            <?php echo $StatusAprovacao->selectStatusAprovacaoSelectMult("", "1", " WHERE inativo = 0")?></p>
        </div>
        <div class="direita">
          <p>
            <label>Data de aprovação:</label>
            de
            <input type="text" name="dataAprovacao" id="dataAprovacao" class="data" value="" />
            a
            <input type="text" name="dataAprovacao2" id="dataAprovacao2" class="data" value="" />
            <span class="placeholder"></span></p>
          <p>
            <label>Nível:</label>
            <?php echo $NivelEstudo->selectNivelEstudoSelectMult("", "", " WHERE inativo = 0")?></p>
          <p>
            <label>Foco:</label>
            <?php echo $FocoCurso->selectFocoCursoSelectMult("", "", " WHERE inativo = 0")?></p>
          <p>
            <label>Representante:</label>
            <?php echo $Representante->selectRepresentanteSelectMult("", "", " AND G.inativo = 0")?></p>
        </div>
        <p>
        <label>Tipo de venda: </label>
        <input type="radio" name="tipoP" id="tipoP" value="0" checked />Vendas novas<br />
        <input type="radio" name="tipoP" id="tipoP" value="1" />Mudança de estágio<br />        
        </p>
        <p>
        <label>Tipo de curso: </label>
        <?php echo $TipoCurso->selectTipoCursoSelect("","","") ?>
  <!--      <select name="TipoC" id="TipoC">
        <option value="-">Todos</option>
        <option value="0">Presencial </option>
        <option value="5">Presencial Premium</option>
       <!-- <option value="1">On-line </option>
        <option value="2">Skype </option>
        <option value="3">ChatClub </option>-->
      <!--   <option value="4">Na Tela </option>
         <option value="6">Na Tela Premium </option>
         <option value="7">Na Tela Trilhas</option>                  
         </select>
           -->                     
      </div>
      <div class="linha-inteira">
        <button class="button blue" onclick="filtro_postForm('img_form_Grupos', 'form_filtra_Grupos', '<?php echo CAMINHO_VENDAS."planoAcao/index.php"?>', '', '#lista_res')" >Buscar</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Planos de ação</legend>
  <div id="lista_res" class="lista"> </div>
</fieldset>
<script>
ativarForm();
</script> 