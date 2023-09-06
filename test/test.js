
// counting number nb
var nb=0;


// function add a coursework
function add(){
	
	// create a table only at the first time
	if(nb==0){
		// create a legend
		var otr_h = document.createElement("tr");
		otr_h.innerHTML='<th rowspan="2">coursework title</th><th rowspan="2">weighting(%)</th><th rowspan="2">Expected hrs</th><th colspan="2">DL week</th><th rowspan="2"></th>';
		var otr2_h = document.createElement("tr");
		otr2_h.innerHTML='<th>date</th><th>time</th>';
		
		// update change
		document.getElementById("thd").appendChild(otr_h);
		document.getElementById("thd").appendChild(otr2_h);
	}
	
	// create input space for all time
	nb++;
	
		// create a line of input space
	var otr_b = document.createElement("tr");
		
		// create element of this line
	var otd_b = new Array();
	
		// name the line
	otr_b.id='tr_'+nb;
	
		// define all element
	for(var i=0;i<5;i++){
		otd_b[i] = document.createElement("td");
	}
	
	otd_b[0].innerHTML='<input type="text" name="name" required />';
	otd_b[1].innerHTML='<input type="number" name="weight" id="weight_'+nb+'" onchange="expected_hour('+nb+')" required />';
	otd_b[2].innerHTML='<p id="E_hour_'+nb+'"></p>';
	otd_b[3].innerHTML='<input type="date" name="date" required />';
	otd_b[4].innerHTML='<input type="time" name="time" required />';
	
		// update element
	for(var i=0;i<5;i++){
		otr_b.appendChild(otd_b[i]);
	}
	
		// create and update remove button
	var remove = document.createElement("td");
	remove.innerHTML='<button type="button" onclick="remove('+nb+')">delete</button>';
	otr_b.appendChild(remove);
	
		// update all change
	document.getElementById("tbd").appendChild(otr_b);
}

function expected_hour(id){
	if(document.querySelector('[name="credits"]').value !="" && nb>0){
		
		if(id==0){
			for(var i=1;i<=nb;i++){
				if(document.querySelector('#weight_'+i).value !=""){
					var obj = document.getElementById('E_hour_'+i);
					var credit = document.querySelector('[name="credits"]').value;
					var weighting = document.querySelector('#weight_'+i).value;
					var exp_h = credit*weighting/10;
					document.getElementById('E_hour_'+i).innerHTML = exp_h;
				}
			}
		}else if(document.querySelector('#weight_'+id).value !=""){
			var obj = document.getElementById('E_hour_'+id);
			var credit = document.querySelector('[name="credits"]').value;
			var weighting = document.querySelector('#weight_'+id).value;
			var exp_h = credit*weighting/10;
			document.getElementById('E_hour_'+id).innerHTML = exp_h;	
		}
	}
}



// function remove button
function remove(r_nb){
	// localisation of element
	var r_obj = document.getElementById('tr_'+r_nb);
	// delete element
	r_obj.remove();
	// reorder else element
	var newNb;
	for (;r_nb<nb;r_nb++){
		old=r_nb+1;
		var obj = document.getElementById('tr_'+old);
		document.getElementById('weight_'+old).id = 'weight_'+r_nb;
		document.getElementById('weight_'+old).onchange = '"expected_hour('+r_nb+')"';
		document.getElementById('E_hour_'+old).id = 'E_hour_'+r_nb;
		obj.lastChild.innerHTML = '<button type="button" onclick="remove('+r_nb+')">delete</button>';
		obj.id = 'tr_'+r_nb;
	}
	nb--;
	
	// delete legend if removed the last element
	if(nb==0){
		var thd = document.getElementById("thd");
		thd.innerHTML = "";
	}
}


function validete(){
	
	var weighting = 0;
	var valide = true;
	
	if(nb==0 && Number(document.querySelector('[name="CA"]').value )!= 0 ){
		document.getElementById("wei_w").innerHTML="must have 1  minimumcoursework if CA are not 0!";
		return false;
	}else if(nb>0){
		for(var i=1;i<=nb;i++){
			weighting += Number(document.querySelector('#weight_'+i).value);
		}
		
		if(weighting != Number(document.querySelector('[name="CA"]').value)){
			document.getElementById("wei_w").innerHTML="sum of weighting must be equal to CA!";
			return false;
		}else{
			document.getElementById("wei_w").innerHTML="";
		}
	}
	return valide;
}







