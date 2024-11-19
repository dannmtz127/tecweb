//Act CP12 

// Aquí se empiezan a "cachar las validaciones"

// Para el NOMBRE
$('#name').on("input", function(e){//blur(function(){
    validarTam('#name', '#lblNombre', 100);  
});

$('#name').on("blur", function(e){//blur(function(){
    validarObligatoriosL('#name', '#lblNombreA');  
});

// Para el MODELO
$('#inModelo').on("input", function(e){//blur(function(){
    validarTam('#inModelo', '#lblModelo', 100);  
});

$('#inModelo').on("blur", function(e){//blur(function(){
    validarObligatoriosL('#inModelo', '#lblModeloA');  
});

// Para el PRECIO
$('#inPrecio').on("keypress", function(e){//blur(function(){
    return valNumRa(e);
});

$('#inPrecio').on("blur", function(e){//blur(function(){
    validarObligatoriosN('#inPrecio', '#lblPrecioA', 100);  
});


// Para el número de UNIDADES
$('#inUni').on("keypress", function(e){//blur(function(){
    return valNumNa(e);
});

$('#inUni').on("blur", function(e){//blur(function(){
    validarObligatoriosN('#inUni', '#lblUnidadesA', 0);  
});

// Para los detalles
$('#inDet').on("input", function(e){//blur(function(){
    validarTam('#inDet', '#lblDatelles', 250);  
});

$('#inDet').on("blur", function(e){//blur(function(){
    validarObligatoriosL('#inDet', '#lblDatellesA');  
});


// Funciones que as validaciones mandan a llamar
function validarTam(control, lbl, lim){
    //var type =  e.inputType
    //var lbl = document.getElementById(lbl);
    //var valRest = parseInt(lbl.innerHTML);
    var cad = $(control).val();
    if(cad.length > lim){
        cad = cad.slice(0, lim);
        $(lbl).val(cad);
        $(lbl).val('0');
        alert("Ha excedido el número máximo de caracteres")
    }
    else{
        var aux = lim - parseInt(cad.length);
        $(lbl).html(aux);
    }
}

function validarObligatoriosL(control, lbl){
    if($(control).val() == '' ){
        $(lbl).css("display", "block");
        $(lbl).html("<strong> Este campo es obligatorio</strong>");
        //console.log("aparece");
        //document.getElementById(lbl).style.display = "block";
    }
    else{
        $(lbl).css("display", "none");
        //console.log("desaparece");
        //document.getElementById(lbl).style.display = "none";
    }
}

function validarObligatoriosN(control, lbl, min){
    //l = document.getElementById(lbl);
    if($(control).val() == '' ){
        $(lbl).css("display", "block");
        //l.style.display = "block";
        $(lbl).html("<strong> Este campo es REQUERIDO</strong>");
    }
    else{
        if(parseInt($(control).val()) < min){
            $(control).val("")
            $(lbl).css("display", "block");
            $(lbl).html("<strong>  Debe ser un valor <= " + min + "</strong>");
        }
        else
        $(lbl).css("display", "none");
    }
}

function valNumRa(e){
    var code = e.which;
    console.log(code)
    if(code>=48 && code<=57)
        return true;
    else if(code == 46)
        return true;
    else
        return false;
}

function valNumNa(e){
    var code = e.which;
    if(code>=48 && code<=57)
        return true;
    else
        return false;
}