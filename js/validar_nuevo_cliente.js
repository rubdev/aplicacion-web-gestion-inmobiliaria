window.addEventListener("load",Inicio);

function Inicio() {
	// valido al pulsar en añadir cliente
	var bsubmit = document.querySelector("#nuevo_cliente");
	bsubmit.addEventListener("click",Validar);

	// valido en tiempo real cuando entro/salgo de cada campo
	var inombre = document.querySelector("#nombre");
	inombre.addEventListener("blur",ValidarNombre);

	var iapellidos = document.querySelector("#apellidos");
	iapellidos.addEventListener("blur",ValidarApellidos);

	var idireccion = document.querySelector("#direccion");
	idireccion.addEventListener("blur",ValidarDireccion);

	var itelefono1 = document.querySelector("#telefono1");
	itelefono1.addEventListener("blur",ValidarTelefono1);

	var itelefono2 = document.querySelector("#telefono2");
	itelefono2.addEventListener("blur",ValidarTelefono2);
}

function ValidarNombre () {
	if (this.value.trim() == "") {
		this.className="form-control error-input"; 
		this.nextSibling.innerHTML="¡Atención! El nombre no puede quedar vacío";
		this.nextSibling.className="error";
	} else if (this.value.trim().length > 15) { 
		this.className="form-control error-input"; 
		this.nextSibling.innerHTML="¡Atención! El nombre no puede superar los 15 carácteres";
		this.nextSibling.className="error";
	} else {
		this.className="form-control";
		this.nextSibling.innerHTML="El nombre es válido";
		this.nextSibling.className="ok";
	}
}

function ValidarApellidos() {
	if (this.value.trim() == "") {
		this.className="form-control error-input"; 
		this.nextSibling.innerHTML="¡Atención! Los apellidos no pueden quedar vacíos";
		this.nextSibling.className="error";
	} else if (this.value.trim().length > 30) { 
		this.className="form-control error-input"; 
		this.nextSibling.innerHTML="¡Atención! Los apellidos no pueden superar los 30 caracteres";
		this.nextSibling.className="error";
	} else {
		this.className="form-control";
		this.nextSibling.innerHTML="Los apellidos son válidos";
		this.nextSibling.className="ok";
	}
}

function ValidarDireccion() {
	if (this.value.trim() == "") {
		this.className="form-control error-input";
		this.nextSibling.innerHTML="¡Atención! La dirección no puede quedar vacía";
		this.nextSibling.className="error";
	} else if (this.value.trim().length > 50) { 
		this.className="form-control error-input"; 
		this.nextSibling.innerHTML="¡Atención! La dirección no puede superar los 50 caracteres";
		this.nextSibling.className="error";
	} else {
		this.className="form-control";
		this.nextSibling.innerHTML="La dirección es válida";
		this.nextSibling.className="ok";
	}
}

function ValidarTelefono1() {
	if (this.value.trim().length != 9) {
		this.className="form-control error-input";
		this.nextSibling.innerHTML="¡Atención! El teléfono debe tener 9 dígitos";
		this.nextSibling.className="error";
	} else if (isNaN(this.value)) {
		this.className="form-control error-input";
		this.nextSibling.innerHTML="¡Atención! El teléfono debe ser numérico";
		this.nextSibling.className="error";
	} else {
		this.className="form-control";
		this.nextSibling.innerHTML="El teléfono es válido";
		this.nextSibling.className="ok";
	}
}

function ValidarTelefono2() {
	if (isNaN(this.value)) {
		this.className="form-control error-input";
		this.nextSibling.innerHTML="¡Atención! El teléfono debe ser numérico";
		this.nextSibling.className="error";
	} else {
		this.className="form-control";
		this.nextSibling.innerHTML="El teléfono es válido";
		this.nextSibling.className="ok";
	}
}


function Validar(info_evento) {
	var inombre = document.querySelector("#nombre");
	var iapellidos = document.querySelector("#apellidos");
	var idireccion = document.querySelector("#direccion");
	var itelefono1 = document.querySelector("#telefono1");
	var itelefono2 = document.querySelector("#telefono2");

	

	if (inombre.value.trim() == 0) {
		alert("El nombre no puede quedar vacío");
		info_evento.preventDefault();
	} else if (inombre.value.trim().length > 15) {
		alert("El nombre no puede superar los 15 caracteres");
		info_evento.preventDefault();
	} else {
		if (iapellidos.value.trim() == 0) {
			alert("Los apellidos no pueden quedar vacíos");
			info_evento.preventDefault();
		} else if (iapellidos.value.trim().length > 30) {
			alert("Los apellidos no pueden superar los 30 caracteres");
			info_evento.preventDefault();
		} else {
			if (idireccion.value.trim() == "") {
				alert("La dirección no puede quedar vacía");
				info_evento.preventDefault();
			} else if (idireccion.value.trim().length > 50 ) {
				alert("La dirección es superior a los 50 caracteres");
				info_evento.preventDefault();
			} else {
				if (itelefono1.value.trim().length() != 9) {
					alert("El teléfono 1 debe contener 9 dígitos");
					info_evento.preventDefault();
				} else if (isNaN(telefono1.value)) {
					alert("El teléfono 1 debe de ser numérico");
					info_evento.preventDefault();
				} else {
					if (isNaN(telefono2.value)) {
						alert("El teléfono 2 debe contener 9 dígitos");
						info_evento.preventDefault();
					} else {
						
					}
				}
			}
		}
	}
	/*
	if (iapellidos.value.trim() == 0) {
		alert("Los apellidos no pueden quedar vacíos");
		info_evento.preventDefault();
	}

	if (idireccion.value.trim() == 0) {
		alert("La dirección no puede quedar vacía");
		info_evento.preventDefault();
	}

	if (itelefono1.value.trim() < 9) {
		alert("El teléfono debe contener 9 dígitos");
		info_evento.preventDefault();
	}

	if (isNaN(itelefono1.value)) {
		alert("El telefono 1 tiene que ser numérico");
		info_evento.preventDefault();
	}

	if (isNaN(itelefono2.value)) {
		alert("El telefono 2 tiene que ser numérico");
		info_evento.preventDefault();
	} */

}