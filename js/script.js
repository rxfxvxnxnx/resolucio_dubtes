var mostra = false;
var poi=[];
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

// function ojo(){
//   var contraseña,check;

//   contraseña=document.getElementById("contraseña");
//   check=document.getElementById("ver");

//   if(contraseña.type === "password") // Si el input esta como password 
//   {
//       contraseña.type = "text";
//   }
//   else // Si no está como password
//   {
//       contraseña.type = "password";
//   }
// }
