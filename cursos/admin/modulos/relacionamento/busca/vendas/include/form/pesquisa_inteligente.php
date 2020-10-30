<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$BuscaProfessor = new BuscaProfessor();
$Professor = new Professor();
$PlanoAcaoGrupo = new PlanoAcaoGrupo();
$EstadoCivil = new EstadoCivil();
$Pais = new Pais();
$NivelLinguisticoIdioma = new NivelLinguisticoIdioma();
	
$idPlanoAcaoGrupo = $_GET['idPlanoAcaoGrupo'];
$idBuscaProfessor = $_GET['idBuscaProfessor'];
	
$lucro = BuscaProfessor::margemLucroAulas();
	
?>

<fieldset>
  <legend>Pesquisar inteligente</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos2" 
onclick="abrirFormulario('div_form_Grupos2', 'img_form_Grupos2');" />
  
  <div class="agrupa" id="div_form_Grupos2">
  
    <form id="form_professor_inteligente" class="validate" method="post" action="" onsubmit="return false">
      <input name="idPlanoAcaoGrupo" type="hidden" value="<?php echo $idPlanoAcaoGrupo ?>" />
      <input name="idBuscaProfessor" type="hidden" value="<?php echo $idBuscaProfessor ?>" />
      <p>
        <label for="zona">
          <input type="checkbox" name="zona" id="zona" value="1" />
          Zonas de atendimento</label>
      </p>
      
      <p>
        <label for="cidade">
          <input type="checkbox" name="cidade" id="cidade" value="1" checked="checked" />
          Atende na mesma cidade</label>
      </p>
      <p>
        <label for="perfil">
          <input type="checkbox" name="perfil" id="perfil" value="1" />
          Perfil do professor</label>
      </p>
      <p>
        <label for="disponibilidade">
          <input type="checkbox" name="disponibilidade" id="disponibilidade" value="1" />
          Disponibilidade</label>
      </p>
      <p>
        <label for="presencial">
          <input type="checkbox" name="presencial" id="presencial" value="1" checked="checked" />
          Presencial</label>
      </p>
      <p>
        <label for="distancia">
          <input type="checkbox" name="distancia" id="distancia" value="1" checked="checked" />
          a Distância</label>
      </p>
      <p>
        <label for="lucro">
          <input type="checkbox" name="lucro" id="lucro" value="<?php echo $lucro?>" checked="checked" />
          Valor hora grupo <strong>x</strong> Valor hora professor <strong>x</strong> Margem de lucro (<?php echo $lucro?>%)</label>
      </p>
      <p>
        <button class="button blue" onclick="filtro_postForm('img_form_Grupos2', 'form_professor_inteligente', '<?php echo CAMINHO_REL."busca/vendas/include/resourceHTML/retornoProfessor_inteligente.php"?>', '', '#buscaProfessor_inteligente')">Pesquisar</button>
        
        <button class="button blue desabilitado" id="bt_busca_inteligente" onclick="postForm('form_professor_inteligente', '<?php echo CAMINHO_REL."busca/vendas/include/resourceHTML/retornoProfessor_inteligente.php"?>', '', '#buscaProfessor_inteligente')"></button>
      </p>
    </form>
  </div>
</fieldset>

<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="buscaProfessor_inteligente" class="lista"> </div>
</fieldset>
<script>
	ativarForm();
</script> 
