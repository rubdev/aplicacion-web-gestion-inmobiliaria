window.addEventListener("load",Inicio);

function Inicio() {

	// validación al enviar noticia
	var bsubmit = document.querySelector("#nueva_noticia");
	bsubmit.addEventListener("click",Validar);

	// validación en tiempo real cuando entro/salgo de cada campo
	var btitular = document.querySelector("#titular");
	btitular.addEventListener("blur",ValidarTitular);

	var bcontenido = document.querySelector("#contenido");
	bcontenido.addEventListener("blur",ValidarContenido);

	var bfecha = document.querySelector("#fecha");
	bfecha.addEventListener("blur",ValidarFecha);

}

/*function ErrorCampo(msj,c_input,c_span) {
	this.className = c_input;
	this.nextSibling.innerHTML = msj;
	this.nextSibling.className = c_span;
}

function CampoValido(msj,c_span) {
	this.className = "form-control";
	this.nextSibling.innerHTML = msj;
	this.nextSibling.className = c_span;
}*/

function ValidarTitular() {
	if (this.value.trim() == "") {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! El titular no puede quedar vacío";
		this.nextSibling.className = "error";
	} else if (this.value.trim().length > 30) {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! El titular no puede superar los 30 caracteres";
		this.nextSibling.className = "error";
	} else {
		this.className="form-control";
		this.nextSibling.innerHTML = "El titular es válido";
		this.nextSibling.className = "ok";
	}
}

function ValidarContenido() {
	if (this.value.trim() == "") {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! El contenido no puede quedar vacío";
		this.nextSibling.className = "error";
	} else if (this.value.trim().length > 1500) {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! El contenido no puede superar los 1500 caracteres";
		this.nextSibling.className = "error";
	} else {
		this.className="form-control";
		this.nextSibling.innerHTML = "El contenido es válido";
		this.nextSibling.className = "ok";
	}
}


function ValidarFecha() {
	
	fecha = new Date();
	var dia = fecha.getDate();
	if (dia < 10) { dia = '0' + dia;} 
	var mes = fecha.getMonth() + 1;
	var anio = fecha.getFullYear();
	var fecha_formateada = anio+'-'+mes+'-'+dia;


	if (this.value == "") {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! Debe indicar una fecha de publicación";
		this.nextSibling.className = "error";
	} else if (this.value < fecha_formateada ) {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! No puedes indicar una fecha de publicación anterior al día de hoy";
		this.nextSibling.className = "error";
	} else {
		this.className="form-control";
		this.nextSibling.innerHTML = "La fecha es válida";
		this.nextSibling.className = "ok";
	}
}

function Validar(info_evento) {
	
	var ititular = document.querySelector("#titular");
	var icontenido = document.querySelector("#contenido");
	var ifecha = document.querySelector("#fecha");

	if (ititular.value.trim() == "") {
		alert("El titular no puede quedar vacío");
		info_evento.preventDefault();
	} else if (ititular.value.trim().length > 30) {
		alert("El titular sólo puede contener 30 caracteres");
		info_evento.preventDefault();
	} else {
		if (icontenido.value.trim() == "") {
			alert("El contenido no puede quedar vacío");
			info_evento.preventDefault();
		} else if (icontenido.value.trim().length > 1500) {
			alert("El contenido no puede superar los 1500 caracteres");
			info_evento.preventDefault();
		} else {
			fecha = new Date();
			var dia = fecha.getDate();
			if (dia < 10) { dia = '0' + dia;} 
			var mes = fecha.getMonth() + 1;
			var anio = fecha.getFullYear();
			var fecha_formateada = anio+'-'+mes+'-'+dia;

			if (ifecha.value == "") {
				alert("Debe seleccionar una fecha de publicación");
				info_evento.preventDefault();
			} else if (ifecha.value < fecha_formateada) {
				alert("No puedes indicar una fecha de publicación anterior al día de hoy");
				info_evento.preventDefault();
			}
		}
	}
}












