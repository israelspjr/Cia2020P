<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Professor = new Professor();
$TipoBaixaPagamento = new TipoBaixaPagamento();

$mes = date('m');
$ano = date('Y');

$mesF = date('m');
$anoF = date('Y');
?>

<fieldset>
  <legend>Relatório de pagamento</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_rel_pf" class="validate" method="post" action="" onsubmit="return false" >
      
      <p><strong>Filtros</strong></p>
      <div class="linha-inteira">
        <div class="esquerda">
        <label> De:</label>
        <p>
          <select name="mes" id="mes" >
            <?php for($x=1; $x <= 12; $x++){ ?>
            <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
            <?php }?>
          </select>
          <span class="placeholder"></span>
          <select name="ano" id="ano" >
            <?php for($x = date('Y')+1; $x >= 2014; $x-- ){?>
            <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
            <?php } ?>
          </select>
          <span class="placeholder"></span></p>
        <label> Até:</label>
        <p>
          <select name="mesF" id="mesF" >
            <?php for($x=1; $x <= 12; $x++){ ?>
            <option value="<?php echo $x?>" <?php echo ($mesF == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
            <?php }?>
          </select>
          <span class="placeholder"></span>
          <select name="anoF" id="anoF" >
            <?php for($x = date('Y'); $x >= 2014; $x-- ){?>
            <option value="<?php echo $x?>" <?php echo ($anoF == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
            <?php } ?>
          </select>
          <span class="placeholder"></span></p>  
          
        <p>
          <label>Professor:</label>
          <?php echo $Professor->selectProfessorSelectMult("", "", " AND candidato = 0")?></p>
        <p>
          <label>Tipo de pagamento:</label>
          <?php echo $TipoBaixaPagamento->selectTipoBaixaPagamentoSelectMult("", "", " WHERE inativo = 0")?></p>
      </div>
        <div class="direita">
         <p>
          <label>Em Aberto</label>
          <input type="radio" id="baixa" name="baixa" value="2" />
          </p>
          <p>
          <label>Baixado</label>
          <input type="radio" id="baixa" name="baixa" value="1" />
          </p>
          <p>
          <label>Ambos</label>
          <input type="radio" id="baixa" name="baixa" checked="checked" value="-" />
          </p>
          <p>
          <label>Com impostos </label>
          <input type="checkbox" id="impostos" name="impostos" value="1" />
          </p>
            <p>
          <label>Somente Aulas (Clique neste quando o periodo de até for diferente)</label>
          <input type="checkbox" id="aulas" name="aulas" value="1" />
          </p>
            <p>
          <label>Não somar débitos / crédito</label>
          <input type="checkbox" id="credDeb" name="credDeb" value="1" />
          </p>
          
          
        <p> 
        </div>
      </div>
      
      <div class="linha-inteira" >
        <button class="button blue" id="geraRel" onclick="postForm_relatorio('img_form_Grupos', '', 'form_rel_pf', '<?php echo CAMINHO_RELAT."pagamento/include/resourceHTML/pagamento.php"?>', '#res_rel')">Gerar relatório</button>        
      </div>
    </form>
  </div>
  
</fieldset>

<fieldset>
  <legend>Resultado da pesquisa</legend>
  <div id="res_rel" class="lista" ></div>
</fieldset>
<script> ativarForm();</script> 