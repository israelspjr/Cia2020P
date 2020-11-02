<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/StatusCobranca.class.php");


$StatusCobranca = new StatusCobranca();

if($_GET['mes']!= "" && $_GET['ano'] != ""){
	$mes = $_GET['mes'];
	$ano = $_GET['ano'];
}else{
	$mes = date('m');
	$ano = date('Y');	
}

?>

<fieldset>
  <legend>Filtros</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos');" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_Demonstrativo_data" class="validate" method="post" action="" onsubmit="return false" >
      <p>
        <label>Mês:</label>
        <select name="mes" id="mes_Demonstrativo" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>
      </p>
      <p>
        <label>Ano:</label>
        <select name="ano" id="ano_Demonstrativo" class="required">
          <?php for($x = date('Y')+1; $x >= 2010; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select>
      </p>
        
           <p>
          <label>Em aberto</label>
          <input type="checkbox" id="emAberto" name="emAberto" value="1" />
          </p>
          
      <div class="linha-inteira">
        <button class="button blue" onclick="filtro_postForm('img_form_Grupos', 'form_Demonstrativo_data', '<?php echo CAMINHO_PAG."baixa/include/resourceHTML/baixa.php"?>', '',  '#lista_baixa')">Buscar</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Baixa de pagamento</legend>
  <div id="lista_baixa" class="lista">
    
  </div>
</fieldset>
<script>
ativarForm();
</script>