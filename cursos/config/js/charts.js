/**
 * @author Luiz
 */
google.load("visualization", 1, {packages:["controls"]});
google.setOnLoadCallback(grafico);
function grafico() {
		
	// Create our data table out of JSON data loaded from server.
	var dashboard = new google.visualization.Dashboard($("dashboard_div"));
	var dados = new google.visualization.arrayToDataTable([
		<?php echo dados;?>
	]);
	var dRangeSlider = new google.visualization.ControlWrapper({
		controlType:'Variações',
		containerid:'filtro_div',
		options:{
			filterColumnLabel:'<?php echo $tipo;?>',
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