window.addEventListener("load",Inicio);

function Inicio() {
	var bsubmit = document.querySelector("#nueva_cita");
	bsubmit.addEventListener("click",Validar);

	var bfecha = document.querySelector("#fecha");
	bfecha.addEventListener("blur",ValidarFecha);

	var bhora = document.querySelector("#hora");
	bhora.addEventListener("blur",ValidarHora);

	var bmotivo = document.querySelector("#motivo");
	bmotivo.addEventListener("blur",ValidarMotivo);

	var blugar = document.querySelector("#lugar");
	blugar.addEventListener("blur",ValidarLugar);
}

function ValidarFecha() {
	fecha = new Date();
	var dia = fecha.getDate();
	if (dia < 10) { dia = '0' + dia;} 
	var mes = fecha.getMonth() + 1;
	if (mes < 10) { mes = '0' + mes;} 
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

function ValidarHora() {
	if (this.value == "") {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! Debe seleccionar una hora";
		this.nextSibling.className = "error";
	} else {
		this.className="form-control";
		this.nextSibling.innerHTML = "La hora es válida";
		this.nextSibling.className = "ok";
	}
}

function ValidarMotivo() {
	if (this.value.trim() == "") {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! El motivo no puede quedar vacío";
		this.nextSibling.className = "error";
	} else if (this.value.trim().length > 50) {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! El motivo no puede superar los 1500 caracteres";
		this.nextSibling.className = "error";
	} else {
		this.className="form-control";
		this.nextSibling.innerHTML = "El motivo es válido";
		this.nextSibling.className = "ok";
	}
}

function ValidarLugar() {
	if (this.value.trim() == "") {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! El lugar no puede quedar vacío";
		this.nextSibling.className = "error";
	} else if (this.value.trim().length > 50) {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! El lugar no puede superar los 1500 caracteres";
		this.nextSibling.className = "error";
	} else {
		this.className="form-control";
		this.nextSibling.innerHTML = "El lugar es válido";
		this.nextSibling.className = "ok";
	}
}

function Validar(info_evento) {
	ifecha = document.querySelector("#fecha");
	ihora = document.querySelector("#hora");
	imotivo = document.querySelector("#motivo");
	ilugar = document.querySelector("#lugar");

	fecha = new Date();
	var dia = fecha.getDate();
	if (dia < 10) { dia = '0' + dia;} 
	var mes = fecha.getMonth() + 1;
	var anio = fecha.getFullYear();
	var fecha_formateada = anio+'-'+mes+'-'+dia;

	if (ifecha.value == "") {
		alert("La fecha no puede quedar vacía");
		info_evento.preventDefault();
	} else if (ifecha.value < fecha_formateada) {
		alert("La fecha introducida ya ha pasado");
		info_evento.preventDefault();
	} else {
		if (ihora.value == "") {
			alert("La hora no puede quedar vacía");
			info_evento.preventDefault();
		} else {
			if (imotivo.value.trim() == "") {
				alert("El motivo no puede quedar vacío");
				info_evento.preventDefault();
			} else if (imotivo.value.trim().length > 50) {
				alert("El motivo no puede superar los 50 caracteres");
				info_evento.preventDefault();
			} else {
				if (ilugar.value.trim() == "") {
					alert("El lugar no puede quedar vacío");
					info_evento.preventDefault();
				} else if (ilugar.value.trim().length > 30) {
					alert("El lugar no puede superar los 30 caracteres");
					info_evento.preventDefault();
				}
			}
		}
	}
}