
var idProceso = 0;
var nomProceso;
var durProceso;
var tiempoFaltante;
var estadoProceso;
var padre;  
var indiceColumnaEnEjecucion=0;
var controlTiempo;
var seccionCritica = false;

function enviar(){
	if (seccionCritica==false) {
		nomProceso = document.getElementById("nombreProceso").value;
		durProceso = parseInt(document.getElementById("duracionProceso").value);
		if (isNaN(durProceso)){
			alert(document.getElementById("duracionProceso").value+" no es un entero. Ingrese el número de segundos");
		}else{
				
			tiempoFaltante = durProceso;
			estadoProceso = "Preparado";

				var elementoTr = document.createElement("tr");
				var elementoTd = document.createElement("td");
				var contenido = [document.createTextNode(idProceso), document.createTextNode(nomProceso),
								 document.createTextNode(durProceso), document.createTextNode(tiempoFaltante),
								 document.createTextNode(estadoProceso)];

			for (var i=0; i<=4; i++){
				
				elementoTd = document.createElement("td");
				
				if (i==0){
					elementoTr = document.createElement("tr");
					elementoTr.setAttribute("id", idProceso.toString());
					elementoTd.appendChild(contenido[i]);
					elementoTr.appendChild(elementoTd);

					padre = document.getElementById("listaProceso");
					padre.appendChild(elementoTr);
				}else{
					elementoTd.appendChild(contenido[i]);
					
					padre = document.getElementById(idProceso.toString());
					padre.appendChild(elementoTd);
				}
			}
			idProceso = idProceso +1;
		}
		ejecucion();
	}else{
		enviar();
	}
}

function ejecucion(){
	if(document.getElementById("fcfsPlan").checked == true){
		fcfsFuncion();
	}
	
	if(document.getElementById("sjfPlan").checked == true){
		sjfFuncion();
	}
}

function sjfFuncion(){


	seccionCritica = true;
	var indiceTopFila = parseInt(document.getElementById("listaProceso").rows.length) - 1;
	var copiaNodo;
	var valorNodoMenor;
	var valorNodoSiguiente;
	var nodoPadre;

	for(var i=0; i < indiceTopFila ; i++){
		valorNodoMenor = parseInt(document.getElementById("listaProceso").rows[i].childNodes[3].firstChild.nodeValue);
		for (var j = (i+1); j <= indiceTopFila ; j++ ){
			valorNodoSiguiente = parseInt(document.getElementById("listaProceso").rows[j].childNodes[3].firstChild.nodeValue);
			if (valorNodoMenor > valorNodoSiguiente){
				copiaNodo = document.getElementById("listaProceso").rows[j];
				
				nodoPadre = document.getElementById("listaProceso").rows[i].parentNode;

				nodoPadre.insertBefore(copiaNodo, document.getElementById("listaProceso").rows[i]);

				valorNodoMenor = valorNodoSiguiente;
			}
		}
	}
	seccionCritica = false;
	fcfsFuncion();
}
		

function fcfsFuncion(){

	clearInterval(controlTiempo);
	seccionCritica = true;

	var valorDelNodoEstado;
	var indiceTopFila = parseInt(document.getElementById("listaProceso").rows.length) - 1;
	

	if (document.getElementById("listaProceso").rows[indiceColumnaEnEjecucion].getElementsByTagName("td")[4].innerHTML == "Ejecucion") {

		document.getElementById("listaProceso").rows[indiceColumnaEnEjecucion].getElementsByTagName("td")[4].innerHTML == "Preparado";
		indiceColumnaEnEjecucion=0;
	}else{
    	indiceColumnaEnEjecucion=0;
	}
	


	var valorDelNodoTiempoFaltante = parseInt(document.getElementById("listaProceso").rows[indiceColumnaEnEjecucion].childNodes[3].firstChild.nodeValue);

	for (var i = 0; i == indiceTopFila; i++) {
		if (valorDelNodoTiempoFaltante == 0){
			document.getElementById("listaProceso").rows[i].getElementsByTagName("td")[4].innerHTML = "Terminado";
			indiceColumnaEnEjecucion++;
		}
	}

	seccionCritica = false;
	

	function frame() {
		seccionCritica = true;

		if (valorDelNodoTiempoFaltante == 0){
			document.getElementById("listaProceso").rows[indiceColumnaEnEjecucion].getElementsByTagName("td")[4].innerHTML = "Terminado";
			indiceColumnaEnEjecucion++;
		}else{
	    	valorDelNodoTiempoFaltante --;
	        document.getElementById("listaProceso").rows[indiceColumnaEnEjecucion].getElementsByTagName("td")[3].innerHTML = valorDelNodoTiempoFaltante;
		}

		valorDelNodoEstado = document.getElementById("listaProceso").rows[indiceColumnaEnEjecucion].childNodes[4].firstChild.nodeValue;

		if( valorDelNodoEstado == "Preparado"){
			document.getElementById("listaProceso").rows[indiceColumnaEnEjecucion].getElementsByTagName("td")[4].innerHTML = "Ejecucion";
		}

		indiceTopFila = parseInt(document.getElementById("listaProceso").rows.length) -1;
		valorDelNodoTiempoFaltante = parseInt(document.getElementById("listaProceso").rows[indiceColumnaEnEjecucion].childNodes[3].firstChild.nodeValue);

    	if (indiceColumnaEnEjecucion==indiceTopFila && valorDelNodoTiempoFaltante == 0) {
    		document.getElementById("listaProceso").rows[indiceColumnaEnEjecucion].getElementsByTagName("td")[4].innerHTML = "Terminado";
    		clearInterval(controlTiempo);
    	} 
    	seccionCritica = false;
	}
	controlTiempo = setInterval(frame, 1000);
}