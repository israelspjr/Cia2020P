<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();
?>

<fieldset>
  <legend>Relatório Relação Grupos X Professor</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_troca" class="validate" method="post" action="" onsubmit="return false" >        
      <div class="esquerda">
      <label>Professor:</label>
      <?php echo $Professor->selectProfessorSelect("", "", "");?>
      </div>
       
    </form>
  </div>
  <div class="linha-inteira" >
        <button class="button blue" onclick="geraRel()"> Gerar Relatório</button>
      </div>
</fieldset>
<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<script> 

function geraRel(){
    postForm_relatorio('img_form_Grupos', '', 'form_rel_troca', '<?php echo CAMINHO_RELAT."gruposAntigos/grupos.php"?>', '#res_rel');
}
ativarForm();
</script>