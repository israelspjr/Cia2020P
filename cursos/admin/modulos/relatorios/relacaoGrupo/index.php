<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Grupo.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Idioma.class.php");

//$Grupo = new Grupo();
$Idioma = new Idioma();

$mes = date('m');
$ano = date('Y');
?>

<fieldset>
  <legend>Relação de Grupos</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
      <p><strong>Filtros</strong></p>
      <div class="linha-inteira">
        <div class="esquerda">
          <p>
            <label>Idioma:</label>
            <?php ?>
          <p>           
          </p>
        </div>
        <div class="direita">
              <p>
            <label>Empresa:</label>
            
          <p> 
        </div>
      </div>
      <div class="linha-inteira" >
        <button class="button blue" id="geraRel" onclick="postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo CAMINHO_RELAT."relacaoGrupo/include/resourceHTML/relacaoGrupo.php"?>', '#res_rel')">Gerar relatório</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<script> ativarForm();</script> 