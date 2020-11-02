<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$StatusCobranca = new StatusCobranca();
$gerente = new Gerente();
$mes = date('m');
$ano = date('Y');
/*
$a = Uteis::base64_url_encode(218);
$b = Uteis::base64_url_encode('04');
$c = Uteis::base64_url_encode(2015);
*/?>

<fieldset>
  <legend>Filtros</legend>
  <img src="<?php echo CAMINHO_IMG."menos.png"?>" title="Abrir/Fechar formuário" id="img_form_Grupos" 
onclick="abrirFormulario('div_form_Grupos', 'img_form_Grupos', true);" />
  <div class="agrupa" id="div_form_Grupos">
    <form id="form_DemonstrativoCobranca_data" class="validate" method="post" action="" onsubmit="return false" >
      <div class="esquerda">
           <?php echo $a."<br />".$b."<br />".$c;?>
          <p>
              Cliente:<input type="text" name="nome" id="nome" list="nomeList">
              <datalist id="nomeList">
              </datalist>
          </p>
      <p>
          <label>Gerente:</label>
          <?php echo $gerente->selectGerenteSelect();?>
      </p> 
      <p>De:</p>   
      <p>
        <label>Mês:</label>
        <select name="mes" id="mes_DemonstrativoCobranca" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>
      </p>
      <p>
        <label>Ano:</label>
        <select name="ano" id="ano_DemonstrativoCobranca" class="required">
          <?php for($x = date('Y')+1; $x >= 2014; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select>
      </p>
   <!--    <p>Até:</p>   
      <p>
        <label>Mês:</label>
        <select name="mesF" id="mes_DemonstrativoCobranca" class="required">
          <?php for($x=1; $x <= 12; $x++){ ?>
          <option value="<?php echo $x?>" <?php echo ($mes == $x) ? "selected" : ""?> > <?php echo Uteis::retornaNomeMes($x);?> </option>
          <?php }?>
        </select>
      </p>
      <p>
        <label>Ano:</label>
        <select name="anoF" id="ano_DemonstrativoCobranca" class="required">
          <?php for($x = date('Y')+1; $x >= 2014; $x-- ){?>
          <option value="<?php echo $x?>" <?php echo ($ano == $x) ? "selected" : "" ?>> <?php echo $x?> </option>
          <?php } ?>
        </select>
      </p>-->
      </div>
      <div class="direita">
           <p>
          <label>Empresas Ativas:</label>
          <input type="radio" name="status" id="status" value="0" onchange="buscar();" checked="checked" >Ativo &nbsp;
          <input type="radio" name="status" id="status" value="1" onchange="buscar();" >Inativo &nbsp;
          <input type="radio" name="status" id="status" value="-"  onchange="buscar();" >Ambos      
        </p>
           <p>
          <label>Empresa:</label>        
          <select id="clientePj_idClientePj" name="clientePj_idClientePj">
            <option value="-">Empresas</option>            
          </select>
        </p>
        <p>
          <label>Grupos Ativos:</label>
          <input type="radio" name="statusG" id="statusG" value="0" onchange="grupos();" checked="checked" >Ativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="1" onchange="grupos();">Inativo &nbsp;
          <input type="radio" name="statusG" id="statusG" value="-"  onchange="grupos();">Ambos      
        </p>
          <p>
            <label>Grupos:</label>
            <select id="grupo_idGrupo" name="grupo_idGrupo">
                 <option value="-">Grupos</option>  
            </select>
        </p>
      </div>
      <div class="linha-inteira">
        <button class="button blue" onclick="filtro_postForm('img_form_Grupos', 'form_DemonstrativoCobranca_data', '<?php echo CAMINHO_COBRANCA."demonstrativo/include/resourceHTML/demonstrativoCobranca.php"?>', '', '#lista_DemonstrativoCobranca')">Buscar</button>
      </div>
    </form>
  </div>
</fieldset>
<fieldset>
  <legend>Demonstrativos de cobrança</legend>
  <?php echo $StatusCobranca->selectStatusCobranca_legenda();?>
  <div id="lista_DemonstrativoCobranca" class="lista">
    
  </div>
</fieldset>
<script>
    $(function(){

        $("input[name=nome").keyup(function(){
            var nome = $(this).val();
            if(nome != ""){
                var dados = {
                    tabela:'clientePf',
                    nome:nome,
                    campo:'nome'
                }
                $.post('<?php echo CAMINHO_CAD."clientePf/busca_nome.php";?>', dados, function(retorno){
                    $("#nomeList").html($.parseJSON(retorno));
                });
            }
        });
        $("input[name='Typelist']").on('input', function(e){
            alert('oi');
            var grupos = $(this).data('grupos');
            var empr = $(this).data('empr');
            alert(empr);
        })

    });
    function buscar(){
  var status, gerente, retorno;
  $( "#clientePj_idClientePj" ).empty();
  $( "#clientePj_idClientePj" ).append("<option value='-'>Empresas</option>");
  status = $("#status:checked").val();
  gerente = $("#idGerente option:selected").val();
  retorno = $.ajax({
 //   url:"<?php echo CAMINHO_COBRANCA."demonstrativo/select_cliente.php"?>",
	 url:"<?php echo CAMINHO_REL."grupo/select_cliente.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,gerente:gerente}   
  });
  retorno.done(function( html ) {
    $( "#clientePj_idClientePj" ).append( html );
  });
  
}
function grupos(){
  var status, clientePj, retorno;
  $("#grupo_idGrupo").empty();
  $("#grupo_idGrupo").append("<option value='-'>Grupos</option>");
  status = $("#statusG:checked").val();
  clientePj = $( "#clientePj_idClientePj" ).val();
  retorno = $.ajax({
    url:"<?php echo CAMINHO_REL."grupo/select_grupos.php"?>",
    type:"POST",
    datatype: "html",
    contentType: "application/x-www-form-urlencoded; charset=utf-8",
    data:{status:status,clientePj:clientePj}   
  });
  retorno.done(function( html ) {
    $( "#grupo_idGrupo" ).append( html );
  });
  
}
$('#idGerente').attr('onchange', 'buscar()');
$('#clientePj_idClientePj').attr('onchange','grupos()');
grupos();
ativarForm();
buscar();
</script>