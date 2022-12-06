selected();
selected_recibe();
document.getElementById('monto').focus();
mostrar_select();

//evento calcular
var selectElement = document.querySelector('#monto');
selectElement.addEventListener('keyup', function monto_calcular(){
	let recibe = document.getElementById('recibe').value;
	calcular();
	mostrar_resultado();
	if (isNaN(recibe)) {
			recibe = document.getElementById('recibe').value = 0;
		}
});
//evento vuelto
let entrega = document.querySelector('#entrega');
entrega.addEventListener('keyup', function calc_vuelto(){
	calcular_vuelto();
});
//evento cotizacion
let cotizacion = document.querySelector('#cotizacion');
cotizacion.addEventListener('keyup', function evento_cotizacion(){
	calcular();
	mostrar_resultado();
});

function calcular(){
	let monto = document.getElementById("monto").value;
	monto = parseFloat(monto);
	let cotizacion = document.getElementById("cotizacion").value;
	cotizacion = parseFloat(cotizacion);
	let recibe = monto * cotizacion;
	recibe = parseFloat(recibe).toFixed(2);
	document.getElementById("recibe").value = recibe;
	calcular_vuelto();
}

function selected(){
	let nom_img = document.getElementById("seleccion").value;
	if (nom_img !== '') {
		document.getElementById('img').innerHTML = "<img style='width: 30px; height: 15px' src='../assets/img/" + nom_img + ".png';>";
	}else{
		document.getElementById('img').innerHTML = "";
	}
	getdivisas();
	return nom_img;
}

function selected_recibe(){
	let nom_img = document.getElementById("seleccion_recibe").value;
	if (nom_img !== '') {
		document.getElementById('img_recibe').innerHTML = "<img style='width: 30px; height: 15px' src='../assets/img/" + nom_img + ".png';>";
	}else{
		document.getElementById('img_recibe').innerHTML = "";
	}
	getdivisas();
	return nom_img;
}

function tip_ope(){
	let tipo = document.getElementById("tipo").value;
	return tipo;
}
function selected_moneda(){
	let selected_moneda = document.getElementById("seleccion").value;
	return selected_moneda;
}

function cot(str) {
	mostrar_select()
	let tipo = tip_ope();
	let cotizacion = document.getElementById('cotizacion');
	if (tipo == "COMPRA") {
		tipo = "Compra";
	}else if(tipo == "VENTA"){
		tipo = "Venta";
	}
	let tipo_cambio = document.getElementById('cotizacion');
	tipo_cambio.value = tipo;
	getdivisas();

}

function getdivisas() {
	  getrecibe();
      var divisas;
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          let divisas = JSON.parse(this.responseText);;
          let tipo = tip_ope();
          let moneda = selected_moneda();
          let moneda_recibe = window.cot_moneda_recibe;
          for (let divisa of divisas) {
          		if(tipo == "COMPRA" && divisa.cod_divisa == moneda){
          			cot_total = divisa.com_divisa / moneda_recibe;
          			//cot_total = parseFloat(cot_total).toFixed(4);
					document.getElementById("cotizacion").value = cot_total;

					//calculando valor y mostrando resultado
					calcular();
					mostrar_resultado();
          		}else if(tipo == "VENTA" && divisa.cod_divisa == moneda){
          			cot_total = divisa.ven_divisa / moneda_recibe;
          			//cot_total = parseFloat(cot_total).toFixed(4);
	          		document.getElementById("cotizacion").value = cot_total;
	          		//calculando valor y mostrando resultado
	          		calcular();
					mostrar_resultado();
          	}

          	
		  }
        }
      };
      xhttp.open("GET", "Operaciones/get_divisas", true);
      xhttp.send();
    }
    getdivisas();

function mostrar_resultado(){
		let resultado = document.getElementById('mostrar_resultado');
		let cod_recibe = document.getElementById('seleccion_recibe').value;
		document.getElementById('cod_recibe').innerHTML = cod_recibe;
		resultado.innerHTML = document.getElementById('recibe').value;
		//titulo resultado
		let tipo = tip_ope();
		if (tipo == "COMPRA") {
			document.getElementById('titulo_resultado').innerHTML = "Cliente Recibe:";
			document.getElementById('rec').innerHTML = "Recibe";
		}else{
			document.getElementById('titulo_resultado').innerHTML = "Cliente Paga:";
			document.getElementById('rec').innerHTML = "Paga";
		}
	}

function calcular_vuelto(){
	let entrega = document.getElementById('entrega').value;
	let recibe = document.getElementById('recibe').value;
	let vuelto = entrega - recibe;
	vuelto = parseFloat(vuelto).toFixed(2);
	if (!entrega > 0 || isNaN(recibe)) {
		document.getElementById('vuelto').value = 0;
		if (isNaN(recibe)) {
			recibe = document.getElementById('recibe').value = 0;

		}
		
	}else{
		document.getElementById('vuelto').value = vuelto;
	}
	
}

function mostrar_select(){
	let tipo = tip_ope();
	if (tipo == "COMPRA") {
		document.getElementById("entrega").style.display = "none";
		document.getElementById("vuelto").style.display = "none";
		document.getElementById("entrega").value = 0;
		document.getElementById("vuelto").value = 0;
		document.getElementById("ent").style.display = "none";
		document.getElementById("vue").style.display = "none";
	}else{
		document.getElementById("entrega").style.display = "block";
		document.getElementById("vuelto").style.display = "block";
		document.getElementById("ent").style.display = "block";
		document.getElementById("vue").style.display = "block";
	}
}

function soloNumeros(e){
         key = e.keyCode || e.which;
         tecla = String.fromCharCode(key).toLowerCase();
         letras = "1234567890.";
         especiales = "";

         tecla_especial = false
         for(var i in especiales){
              if(key == especiales[i]){
                  tecla_especial = true;
          alert(tecla);
                  break;
              }
          }

          if(letras.indexOf(tecla)==-1 && !tecla_especial){
              return false;
          }
        };
function getrecibe() {
	  let divisas;
      let xhttp = new XMLHttpRequest();
      var cot_moneda_recibe = 0; 
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          let divisas = JSON.parse(this.responseText);;
          let tipo = tip_ope();
          let moneda_recibe = document.getElementById('seleccion_recibe').value;

          for (let divisa of divisas) {		
          		if(tipo == "COMPRA" && divisa.cod_divisa == moneda_recibe){
					window.cot_moneda_recibe = divisa.ven_divisa;
          		}else if(tipo == "VENTA" && divisa.cod_divisa == moneda_recibe){
	          		window.cot_moneda_recibe = divisa.com_divisa;	
	          		
          	}

		  }
        }
      };
      xhttp.open("GET", "Operaciones/get_divisas", true);
      xhttp.send(); 
      return(window.cot_moneda_recibe);
}
