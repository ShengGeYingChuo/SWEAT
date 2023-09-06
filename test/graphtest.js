

function graph(){
	var title = {
		text: 'SWEAT'
	};
	
	var subtitle ={
		text: 'on semester 1'
	};
	

	var xAxis = {
		categories: ['week 1','week 2','week 3','week 4','week 5','week 6','week 7'
		,'week 8','week 9','week 10','week 11','week 12','week 13','week 14','week 15'
		,'week 16']
	};
	
	var yAxis = {
		title: {
			text: 'hours'
		},
		poplotLines:[{
			value: 0,
			width: 1,
			color: '#808080'
		}],
		categories: ['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15']
	};
	
	var tooltip = {
		valueSuffix: 'hrs'
		}

	var legend = {
		layout: 'vertical',
		align: 'right',
		verticalAlign: 'middle',
		borderWidth: 0
		};
	
	var series = [
	{
		name: 'test',
		data: [24,24,24,24,24,24,24,24,24,24,24,24,24,24,24,24]
    }
	];
	
	var json ={}
	json.title = title;
	json.subtitle = subtitle;
	json.xAxis = xAxis;
	json.yAxis = yAxis;
	json.tooltip = tooltip;
	json.legend = legend;
	json.series = series;
	
	Highcharts.chart('graph',json);
}