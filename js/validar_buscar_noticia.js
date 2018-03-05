window.addEventListener("load",Inicio);

function Inicio () {
	
	var bsubmit = document.querySelector("#buscar");
	bsubmit.addEventListener("click",Validar);

	var btitular = document.querySelector("#titular");
	btitular.addEventListener("blur",ValidaTitular);

}

function ValidaTitular() {
	if (this.value.length == 0) {
		this.className="form-control error-input";
		this.nextSibling.innerHTML="No puedes dejar el titular vacío";
		this.nextSibling.className = "error";
	} else {
		this.className="form-control";
		this.nextSibling.innerHTML="Ok";
		this.nextSibling.className="ok";
	}
}

function Validar(e) {
	ititular = document.querySelector("#titular");

	if (ititular.value.length == 0) {
		alert("Debe rellenar el campo titular para poder buscar una noticia");
		e.preventDefault();
	}
}