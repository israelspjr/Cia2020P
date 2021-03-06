<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ClientePj = new ClientePj();
$Grupo = new Grupo();

$mes = date('m');
$ano = date('Y');
?>

<fieldset>
  <legend>Gráfico de Frequência</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
      <input type="hidden" name="tipo" value="frequencia" /> 
      <p><strong>Tipo de Gráfico</strong></p>
      <div class="linha-inteira">
        <p>
          <label>
            <input type="radio" name="tipoRel" id="tipoRel_porAula" value="porAula" />
            Frequência por aula</label>
          <label>
            <input type="radio" name="tipoRel" id="tipoRel_mensal" value="mensal" checked="checked" />
            Frequência mensal </label>
        </p>
      </div>
      
      <p><strong>Filtros</strong></p>
      <div class="linha-inteira">
        <div class="esquerda">
          <p>
            <label>De:
              <select name="mes_ini" id="mes_ini" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_ini" id="ano_ini" >
                <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
          <p>
            <label>Até:
              <select name="mes_fim" id="mes_fim" >
                <?php for($x=1; $x <= 12; $x++){ ?>
                <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
                <?php }?>
              </select>
              <select name="ano_fim" id="ano_fim" >
                <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
                <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
                <?php } ?>
              </select>
            </label>
          </p>
        </div>
        <div class="direita">
          <p>
            <label>Empresa:</label>
            <?php echo $ClientePj->selectClientePjSelectMult("", "", " AND inativo = 0")?></p>
          <p>
            <label>Grupo:</label>
            <?php echo $Grupo->selectGrupoSelectMult("", "", " WHERE inativo = 0")?></p>
        </div>
      </div>
      
      <div class="linha-inteira" >
        <button class="button blue" id="geraRel" onclick="postForm_relatorio('img_form_Grupos', 'tipoRel', 'form_rel_pf', '<?php echo CAMINHO_RELAT."graficos/grafico.php"?>', '#res_rel')">Gerar Gráfico</button>        
      </div>
    </form>
  </div>
  
</fieldset>

<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<script> ativarForm();</script> 