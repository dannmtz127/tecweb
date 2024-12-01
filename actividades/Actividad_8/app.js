// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
    };


function init() {
    let edit = false;
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
    $('#product-result').hide(); 
    // SE LISTAN TODOS LOS PRODUCTOS
    listarProductos();

    // Apartir de aquí estan las funciones que  hacen lo mismo que las anteriores, pero ahora con JQuery

    $('#search').keyup(function() { 
        $('#product-result').hide();
        if($('#search').val()){
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php',
                type: 'POST',
                data: {search}, // Tambien podría ser {search: search}
                success: function(response){
                    //console.log(response)
                    let products = JSON.parse(response);
                    let template = '';
                    products.forEach(producto => {
                        template += `
                            <li> ${producto.id} - ${producto.nombre} </li>
                        `;
                    });
                    console.log(template);
                    $('#container').html(template);
                    $('#product-result').show();
                }
            })
        }
    })

    $('#product-form').submit(function(e){
        // Evitamos que se recarge la pagina
        e.preventDefault();
        var productoJsonString = document.getElementById('description').value;
        var finalJSON = JSON.parse(productoJsonString);
        finalJSON['nombre'] = document.getElementById('name').value;
        finalJSON['id'] = document.getElementById('productId').value
        let comp = validaciones(finalJSON);
        if(comp != 0){
            if(comp == 2)
                finalJSON['imagen']= "img/default.jpg";
            productoJsonString = JSON.stringify(finalJSON,null,2);
            //console.log(finalJSON);
            const postData = {
                obj: productoJsonString
            };

            let url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';

            $.post(url, postData, function(response){
                $('#product-form').trigger('reset');
                //console.log(response);
                baseJSON = {
                    "precio": 0.0,
                    "unidades": 1,
                    "modelo": "XX-000",
                    "marca": "NA",
                    "detalles": "NA",
                    "imagen": "img/default.png"
                };
                JsonString = JSON.stringify(baseJSON,null,2);
                document.getElementById("description").value = JsonString;
                //console.log(response);
                let respuesta = JSON.parse(response);
                // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
                let template_bar = '';
                template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;

                // SE HACE VISIBLE LA BARRA DE ESTADO
                document.getElementById("product-result").className = "card my-4 d-block";
                // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                document.getElementById("container").innerHTML = template_bar;
                listarProductos();
            });
        }
        else
            window.alert("[CLIENTE]: Los datos dados son invalidos, intentelo de nuevo");
    });

    $(document).on('click', '.product-delete', function(){
        if(confirm("¿Estas seguro de querer eliminar este producto?")){
            let product = $(this)[0].parentElement.parentElement; 
            let id = $(product).attr('productId');
            $.ajax({
                url: './backend/product-delete.php',
                type: 'GET',
                data: {id},
                success: function (response){
                    let respuesta = JSON.parse(response);
                    let template_bar = '';
                    template_bar += `
                                <li style="list-style: none;">status: ${respuesta.status}</li>
                                <li style="list-style: none;">message: ${respuesta.message}</li>
                            `;

                    // SE HACE VISIBLE LA BARRA DE ESTADO
                    document.getElementById("product-result").className = "card my-4 d-block";
                    // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                    document.getElementById("container").innerHTML = template_bar;
                    listarProductos();
                }
            });
        }
    });

    $(document).on('click', '.product-item', function(){
        let product = $(this)[0].parentElement.parentElement; 
        let id = $(product).attr('productId');
        $.ajax({
            url: './backend/product-single.php',
            type: 'GET',
            data: {id},
            success: function (response){
                let respuesta = JSON.parse(response);
                console.log(respuesta);
                $('#name').val(respuesta.nombre);
                $('#productId').val(respuesta.id)
                baseJSON['precio'] = respuesta.precio;
                baseJSON['unidades'] = respuesta.unidades;
                baseJSON['modelo'] = respuesta.modelo;
                baseJSON['marca'] = respuesta.marca;
                baseJSON['detalles'] = respuesta.detalles;
                baseJSON['imagen'] = respuesta.imagen;
                JsonString = JSON.stringify(baseJSON,null,2);
                document.getElementById("description").value = JsonString;
                edit = true;
            }
        });
    });
}

function listarProductos(){
    $.ajax({
        url: './backend/product-list.php',
        type: 'GET',
        success: function (response){
            let productos = JSON.parse(response);
            let template = '';
            productos.forEach(producto => {
                // SE COMPRUEBA QUE SE OBTIENE UN OBJETO POR ITERACIÓN
                //console.log(producto);

                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                descripcion += '<li>precio: '+producto.precio+'</li>';
                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                descripcion += '<li>marca: '+producto.marca+'</li>';
                descripcion += '<li>detalles: '+producto.detalles+'</li>';
            
                template += `
                    <tr productId="${producto.id}">
                        <td>${producto.id}</td>
                        <td>
                            <a href="#" class = "product-item">${producto.nombre}</a>
                        </td>
                        <td><ul>${descripcion}</ul></td>
                        <td>
                            <button class="product-delete btn btn-danger"">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                `;
            });
            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
            $("#products").html(template);
        }
    })
}

function validaciones(datProductos){
    var nombre = datProductos['nombre'];
    var precio = datProductos['precio'];
    var unidades = datProductos['unidades'];
    var modelo = datProductos['modelo'];
    var marca = datProductos['marca'];
    var detalles = datProductos['detalles'];
    var imagen = datProductos['imagen'];
    var vali = 1;
    //console.log(nombre + " " + precio + " " + unidades + " " + modelo + " " + marca + " " + detalles + " " + imagen )
    if(nombre.length > 0 && nombre.length <= 100){
        vali++;
    }
    if(marca.length > 0){
        vali++;
    }
    if(modelo.length > 0 && modelo.length <= 25){
        vali++;
    }
    if(!isNaN(precio) > 0 && (parseFloat(precio) > 99.9)){
        vali++;
    }
        
    if(detalles.length <= 255){
        vali++;
    }
        
    if(!isNaN(unidades) > 0 && parseInt(unidades) >= 0){
        vali++;
    }
    if(imagen.length == 0 && vali == 7){
        vali++;
    }
    switch(vali){
        case 7:
            return 1;
        case 8:
            return 2;
        default:
            return 0;
    }
}