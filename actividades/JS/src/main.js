function getDatos()
       {
            var nombre = window.prompt("Nombre: ", "");
            var edad   = prompt("Edad: ", "");

            var div1 = document.getElementById('nombre');
            div1.innerHTML = '<h3> Nombre: ' + nombre + '</h3>';

            var div2 = document.getElementById('edad');
            div2.innerHTML = '<h3> Edad: ' + edad + '</h3>';
        }

function Ejemplo1()
{
    var div1 = document.getElementById('Saludo');
    div1.innerHTML = '<h3> Hola mundo </h3>';
}

function Ejemplo2()
{
    var div1 = document.getElementById('Juan');
    div1.innerHTML = 
    '<p> Juan </p>' +
    
    '<p> 20 </p>' +
    
    '<p> 1.92 </p>' +
    
    '<p> false </p>';
}

// Ejemplo 3
function Ejemplo3() {
    var nombre = prompt('Ingresa tu nombre:', '');
    var edad = prompt('Ingresa tu edad:', '');

    var div3 = document.getElementById('ejemplo3');
    div3.innerHTML = 'Hola ' + nombre + ', así que tienes ' + edad + ' años';
}

// Ejemplo 4
function Ejemplo4() {
    var valor1 = prompt('Introducir primer número:', '');
    var valor2 = prompt('Introducir segundo número:', '');

    var suma = parseInt(valor1) + parseInt(valor2);
    var producto = parseInt(valor1) * parseInt(valor2);

    var div4 = document.getElementById('ejemplo4');
    div4.innerHTML = 'La suma es ' + suma + '<br>El producto es ' + producto;
}

// Ejemplo 5
function Ejemplo5() {
    var nombre = prompt('Ingresa tu nombre:', '');
    var nota = prompt('Ingresa tu nota:', '');

    var div5 = document.getElementById('ejemplo5');
    
    if (nota >= 4) {
        div5.innerHTML = nombre + ' está aprobado con un ' + nota;
    } else {
        div5.innerHTML = nombre + ' no está aprobado, su nota es ' + nota;
    }
}

// Ejemplo 6
function Ejemplo6() {
    var num1 = prompt('Ingresa el primer número:', '');
    var num2 = prompt('Ingresa el segundo número:', '');

    num1 = parseInt(num1);
    num2 = parseInt(num2);

    var div6 = document.getElementById('ejemplo6');

    if (num1 > num2) {
        div6.innerHTML = 'El mayor es ' + num1;
    } else if (num1 < num2) {
        div6.innerHTML = 'El mayor es ' + num2;
    } else {
        div6.innerHTML = 'Ambos números son iguales';
    }
}

// Ejemplo 7
function Ejemplo7() {
    var nota1 = prompt('Ingresa 1ra. nota:', '');
    var nota2 = prompt('Ingresa 2da. nota:', '');
    var nota3 = prompt('Ingresa 3ra. nota:', '');

    // Convertimos los 3 strings en enteros
    nota1 = parseInt(nota1);
    nota2 = parseInt(nota2);
    nota3 = parseInt(nota3);

    var pro = (nota1 + nota2 + nota3) / 3;
    var div7 = document.getElementById('ejemplo7');

    if (pro >= 7) {
        div7.innerHTML = 'Aprobado';
    } else if (pro >= 4) {
        div7.innerHTML = 'Regular';
    } else {
        div7.innerHTML = 'Reprobado';
    }
}

// Ejemplo 8
function Ejemplo8() {
    var valor = prompt('Ingresar un valor comprendido entre 1 y 5:', '');
    // Convertimos a entero
    valor = parseInt(valor);
    var div8 = document.getElementById('ejemplo8');

    switch (valor) {
        case 1:
            div8.innerHTML = 'uno';
            break;
        case 2:
            div8.innerHTML = 'dos';
            break;
        case 3:
            div8.innerHTML = 'tres';
            break;
        case 4:
            div8.innerHTML = 'cuatro';
            break;
        case 5:
            div8.innerHTML = 'cinco';
            break;
        default:
            div8.innerHTML = 'Debe ingresar un valor comprendido entre 1 y 5.';
    }
}

// Ejemplo 9
function Ejemplo9() {
    var col = prompt('Ingresa el color con que quieras pintar el fondo de la ventana (rojo, verde, azul)', '');
    
    switch (col) {
        case 'rojo':
            document.body.style.backgroundColor = '#ff0000';
            break;
        case 'verde':
            document.body.style.backgroundColor = '#00ff00';
            break;
        case 'azul':
            document.body.style.backgroundColor = '#0000ff';
            break;
        default:
            alert('Color no reconocido. Por favor ingresa rojo, verde o azul.');
    }
}

// Ejemplo 10
function Ejemplo10() {
    var x = 1;
    var resultado = ''; // Para almacenar los números como un string

    while (x <= 100) {
        resultado += x + '<br>'; // Concatenamos el número con un salto de línea
        x = x + 1;
    }

    var div10 = document.getElementById('ejemplo10');
    div10.innerHTML = resultado; // Mostramos los números en el div
}

// Ejemplo 11
function Ejemplo11() {
    var x = 1;
    var suma = 0;
    var valor;

    while (x <= 5) {
        valor = prompt('Ingresa el valor:', '');
        valor = parseInt(valor);
        suma = suma + valor;
        x = x + 1;
    }

    var div11 = document.getElementById('ejemplo11');
    div11.innerHTML = "La suma de los valores es " + suma + "<br>";
}

// Ejemplo 12
function Ejemplo12() {
    var valor;
    var resultado = '';

    do {
        valor = prompt('Ingresa un valor entre 0 y 999:', '');
        valor = parseInt(valor);
        resultado += 'El valor ' + valor + ' tiene ';
        
        if (valor < 10) {
            resultado += '1 dígito';
        } else if (valor < 100) {
            resultado += '2 dígitos';
        } else if (valor < 1000) {
            resultado += '3 dígitos';
        } else {
            resultado += 'fuera de rango';
        }
        
        resultado += '<br>';
    } while (valor != 0);

    var div12 = document.getElementById('ejemplo12');
    div12.innerHTML = resultado;
}

// Ejemplo 13
function Ejemplo13() {
    var resultado = '';
    for (var f = 1; f <= 10; f++) {
        resultado += f + ' ';
    }
    
    var div13 = document.getElementById('ejemplo13');
    div13.innerHTML = resultado;
}

// Ejemplo 14
function Ejemplo14() {
    var resultado = '';
    for (var i = 0; i < 3; i++) {
        resultado += "Cuidado<br>";
        resultado += "Ingresa tu documento correctamente<br>";
    }
    
    var div14 = document.getElementById('ejemplo14');
    div14.innerHTML = resultado;
}

// Ejemplo 15
function Ejemplo15() {
    var resultado = '';
    
    function mostrarMensaje() {
        resultado += "Cuidado<br>";
        resultado += "Ingresa tu documento correctamente<br>";
    }
    
    mostrarMensaje();
    mostrarMensaje();
    mostrarMensaje();
    
    var div15 = document.getElementById('ejemplo15');
    div15.innerHTML = resultado;
}

// Ejemplo 16
function Ejemplo16() {
    var valor1 = prompt('Ingresa el valor inferior:', '');
    valor1 = parseInt(valor1);
    var valor2 = prompt('Ingresa el valor superior:', '');
    valor2 = parseInt(valor2);
    
    var resultado = '';
    
    function mostrarRango(x1, x2) {
        for (var inicio = x1; inicio <= x2; inicio++) {
            resultado += inicio + ' ';
        }
    }
    
    mostrarRango(valor1, valor2);
    
    var div16 = document.getElementById('ejemplo16');
    div16.innerHTML = resultado;
}

// Ejemplo 17
function Ejemplo17() {
    function convertirCastellano(x) {
        switch (x) {
            case 1: return "uno";
            case 2: return "dos";
            case 3: return "tres";
            case 4: return "cuatro";
            case 5: return "cinco";
            default: return "valor incorrecto";
        }
    }

    var valor = prompt("Ingresa un valor entre 1 y 5", "");
    valor = parseInt(valor);
    var resultado = convertirCastellano(valor);

    var div17 = document.getElementById('ejemplo17');
    div17.innerHTML = resultado;
}

// Ejemplo 18
function Ejemplo18() {
    function convertirCastellano(x) {
        switch (x) {
            case 1: return "uno";
            case 2: return "dos";
            case 3: return "tres";
            case 4: return "cuatro";
            case 5: return "cinco";
            default: return "valor incorrecto";
        }
    }

    var valor = prompt("Ingresa un valor entre 1 y 5", "");
    valor = parseInt(valor);
    var resultado = convertirCastellano(valor);

    var div18 = document.getElementById('ejemplo18');
    div18.innerHTML = resultado;
}
