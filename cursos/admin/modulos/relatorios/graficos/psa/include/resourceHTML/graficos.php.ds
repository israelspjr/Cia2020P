<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
require_once "../psa/include/acao/filtros.php";
$Relatorio = new Relatorio();          
?>
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
$(document).ready(function( 
    google.load("visualization", 1, {packages:["controls"]});
google.setOnLoadCallback(grafico);
function grafico() {
        
    // Create our data table out of JSON data loaded from server.
    var parametros = {
        <?php echo $param;?> 
    }
    var jsonData = $.ajax({
          url: "getDadosGrafico.php",          
          dataType:"json",
          data: parametros,
          async: false
          }).responseText;
          
    var dashboard = new google.visualization.Dashboard($("dashboard_div"));
    
    var dados = new google.visualization.arrayToDataTable([jsonData]);
    
    var dRangeSlider = new google.visualization.ControlWrapper({
        controlType:'Variações',
        containerid:'filtro_div',
        options:{
            filterColumnLabel:'<?php echo $filtro;?>',
            minValue:0,
            maxValue:100
        },
        state:{
            lowValue:0,
            highValue:100
        }
    });
    var pChart = new google.visualiztion.ChartWarpper({
        chartType:'PieChart',
        containerId:'grafico_div',
        options:{
            whidth:'800',
            height:'600',
            title:'Gr&aacute;fico <?php echo $tipo;?>'
        },
        view:{columns:[0,100]}
    });
    dashboard.bind(dRangeSlider,pChart);
    dashboard.draw();   
};
});
</script>
<div id="dashboard_div">
<div id="filtro_div"></div>
<div id="grafico_div" style="width:800; height:600"></div>
</div>
