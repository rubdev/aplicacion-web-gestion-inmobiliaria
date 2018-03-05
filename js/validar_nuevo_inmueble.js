window.addEventListener("load",Inicio);

function Inicio() {
	var bsubmit = document.querySelector("#nuevo_inmueble");
	bsubmit.addEventListener("click",Validar);

	var bdir = document.querySelector("#dir");
	dir.addEventListener("blur",ValidarDireccion);

	var bdes = document.querySelector("#des");
	bdes.addEventListener("blur",ValidarDescripcion);

	var bpre = document.querySelector("#pre");
	bpre.addEventListener("blur",ValidarPrecio);

}

function ValidarDireccion() {
	if (this.value.trim() == "") {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! La dirección no puede quedar vacía";
		this.nextSibling.className = "error";
	} else if (this.value.trim().length > 50) {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! La dirección no puede tener mas de 50 caracteres";
		this.nextSibling.className = "error";
	} else {
		this.className = "form-control";
		this.nextSibling.innerHTML = "La dirección es válida";
		this.nextSibling.className ="ok";
	}
}

function ValidarDescripcion() {
	if (this.value.trim() == "") {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! La descripción no puede quedar vacía";
		this.nextSibling.className = "error";
	} else if (this.value.trim().length > 1500) {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! La descripción no puede tener mas de 1500 caracteres";
		this.nextSibling.className = "error";
	} else {
		this.className = "form-control";
		this.nextSibling.innerHTML = "La descripción es válida";
		this.nextSibling.className ="ok";
	}
}

function ValidarPrecio() {
	if (this.value.trim() == "") {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! El precio no puede quedar vacío";
		this.nextSibling.className = "error";
	} else if (isNaN(this.value)) {
		this.className = "form-control error-input";
		this.nextSibling.innerHTML = "¡Atención! El precio debe ser numérico";
		this.nextSibling.className = "error";
	} else {
		this.className = "form-control";
		this.nextSibling.innerHTML = "El precio es válido";
		this.nextSibling.className ="ok";
	}
}

function Validar(info_evento) {
	var idir = document.querySelector("#dir");
	var ides = document.querySelector("#des");
	var ipre = document.querySelector("#pre");

	if (idir.value.trim() == "") {
		alert("La dirección no puede quedar vacía");
		info_evento.preventDefault();
	} else if (idir.value.trim().length > 50) {
		alert("La dirección no puede superar los 50 caracteres");
		info_evento.preventDefault();
	} else {
		if (ides.value.trim() == "") {
			alert("La descripción no puede quedar vacía");
			info_evento.preventDefault();
		} else if (ides.value.trim().length > 1500) {
			alert("La descripción no puede superar los 1500 caracteres");
			info_evento.preventDefault();
		} else {
			if (ipre.value.trim() == "") {
				alert("El precio no puede quedar vacío");
				info_evento.preventDefault();
			} else if (isNaN(ipre.value)) {
				alert("EL precio debe ser numérico");
				info_evento.preventDefault();
			}
		}
	}

}