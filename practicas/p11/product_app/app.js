// JSON BASE A MOSTRAR EN FORMULARIO 
const baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

// FUNCION PARA BUSCAR PRODUCTOS POR ID O NOMBRE
async function buscarProducto(e) {
    e.preventDefault(); // Evita que el formulario recargue la página

    const consulta = document.getElementById('search').value; // Obtiene el valor del campo de búsqueda
    try {
        const response = await fetch('./backend/read.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `consulta=${encodeURIComponent(consulta)}`
        });
        
        if (response.ok) {
            const productos = await response.json(); // Convierte la respuesta en JSON
            if (productos.error) {
                alert("No se encontró ningún producto con la búsqueda realizada");
            } else {
                renderProductos(productos); // Llama a la función para renderizar los productos
            }
        } else {
            console.error('Error en la respuesta del servidor');
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
}

// FUNCION PARA AGREGAR PRODUCTOS
async function agregarProducto(e) {
    e.preventDefault();

    const nombre = document.getElementById('name').value;
    const productoJsonString = document.getElementById('description').value;
    let finalJSON;

    try {
        finalJSON = JSON.parse(productoJsonString); // Convierte el JSON en un objeto
    } catch (error) {
        alert("El formato JSON es inválido");
        return;
    }

    finalJSON.nombre = nombre;
    
    if (validarProducto(finalJSON)) return; // Verifica los campos de entrada

    try {
        const response = await fetch('./backend/create.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json;charset=UTF-8' },
            body: JSON.stringify(finalJSON)
        });

        if (response.ok) {
            console.log('Producto agregado exitosamente');
        } else {
            console.error('Error en la respuesta del servidor');
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
    }
}

// FUNCION PARA RENDERIZAR LOS PRODUCTOS EN LA TABLA
function renderProductos(productos) {
    const contenidoTabla = productos.map(producto => {
        return `
            <tr>
                <td>${producto.id}</td>
                <td>${producto.nombre}</td>
                <td>
                    <ul>
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                    </ul>
                </td>
            </tr>
        `;
    }).join('');

    document.getElementById("productos").innerHTML = contenidoTabla;
}

// FUNCIÓN PARA VALIDAR CAMPOS DEL PRODUCTO
function validarProducto(producto) {
    const { nombre, marca, modelo, precio, detalles, unidades } = producto;
    if (!nombre || !marca || !modelo || precio <= 0 || !detalles || unidades < 1) {
        alert("Todos los campos deben tener un valor válido");
        return true;
    }
    return false;
}

// INICIALIZACION DEL FORMULARIO
function init() {
    const JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
}

// LLAMADO A LA FUNCIÓN DE INICIALIZACIÓN
window.onload = init;
