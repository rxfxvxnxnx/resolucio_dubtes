var mostra = false;

function mostrar() {
    if (mostra==false) {
        veure();
    }else if (mostra==true) {
        guardar();
    }
}

function veure() {
    document.getElementById("menu").style.display = "flex";
    mostra = true;
}

function guardar() {
    document.getElementById("menu").style.display = "none";
    mostra = false;
}