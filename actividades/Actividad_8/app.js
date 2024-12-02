// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

$(document).ready(function(){
    let edit = false;

    let JsonString = JSON.stringify(baseJSON,null,2);
    //$('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    productos.forEach(producto => {
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
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }

    /////////////////////////////////////////////
    $('#name').on("blur", function(e){//blur(function(){
        $('#product-result').hide();
        if($('#name').val()) {
            let name = $('#name').val();
            $.ajax({
                url: './backend/product-search.php?name='+$('#name').val(),
                data: {name},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            $('#product-result').html("<p> El nombre dado NO es valido </p>");
                        }
                        else{
                            $('#product-result').html("<p> El nombre dado es valido </p>");
                        }
                    }
                }

            });
            $('#product-result').show();
        }
        else {
            $('#product-result').hide();
        }
    });
    /////////////////////////////////////////////

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
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
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();

        // SE CONVIERTE EL JSON DE STRING A OBJETO
        //let postData = JSON.parse( $('#description').val() );
        let postData = baseJSON;
        postData['id'] = $('#productId').val();
        postData['nombre'] = $('#name').val();
        postData['precio'] = $('#inPrecio').val();
        postData['unidades'] = $('#inUni').val();
        postData['modelo'] = $('#inModelo').val();
        postData['marca'] = $('#inMarca').val();
        postData['detalles'] = $('#inDet').val();
        postData['imagen'] = $('#inImg').val();

        // Se hace la validación de los campos NO VACIOS
        if(comprobarVal()){
            const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        
            $.post(url, postData, (response) => {
                //console.log(response);
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                let respuesta = JSON.parse(response);
                // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
                let template_bar = '';
                template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;
                // SE REINICIA EL FORMULARIO
                $('#name').val('');
                //$('#description').val(JsonString);
                // SE HACE VISIBLE LA BARRA DE ESTADO
                $('#product-result').show();
                // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                $('#container').html(template_bar);
                // SE LISTAN TODOS LOS PRODUCTOS
                listarProductos();
                // SE REGRESA LA BANDERA DE EDICIÓN A false
                edit = false;
                limpiar();
            });
        }
        
    });

    $(document).on('click', '.product-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('./backend/product-delete.php', {id}, (response) => {
                $('#product-result').hide();
                listarProductos();
                window.alert('Producto Elimnado Correctamente :D');
            });
        }
    });

    $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', {id}, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let product = JSON.parse(response);
            // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
            $('#name').val(product.nombre);
            // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO DESPUÉS PARA LA ACTUALIZACIÓN
            $('#productId').val(product.id);
            // SE ELIMINA nombre, eliminado E id PARA PODER MOSTRAR EL JSON EN EL <textarea>
            delete(product.nombre);
            delete(product.eliminado);
            delete(product.id);
            // SE CONVIERTE EL OBJETO JSON EN STRING
            $('#inPrecio').val(product.precio);
            $('#inUni').val(product.unidades);
            $('#inModelo').val(product.modelo);
            $('#inMarca').val(product.marca);
            $('#inDet').val(product.detalles);
            $('#inImg').val(product.imagen);    
            //let JsonString = JSON.stringify(product,null,2);
            // SE MUESTRA STRING EN EL <textarea>
            //$('#description').val(JsonString);
            
            // SE PONE LA BANDERA DE EDICIÓN EN true
            edit = true;
        });
        e.preventDefault();
    });    
});


function comprobarVal(){
    var aux = 1;
    if ($("#inNom").val() != '')
        aux++;
    if ($("#inMarca").val() != '')
        aux++;
    if ($("#inModelo").val() != '')
        aux++;
    if ($("#inPrecio").val() != '')
        aux++;
    if ($("#inUni").val() != '')
        aux++;
    if ($("#inImg").val() == ''){
        $("#inImg").val('img/default.jpg');
    }
    if ($("inDet").val() != '')
        aux++;
    if(aux == 7){
        alert("Campos validos");
        return true;
    }
    else{
        alert("Faltan campos por llenar");
        return false;
    }
}

function limpiar(){
    $('#name').val('');
    $('#productId').val('');
    $('#inPrecio').val('');
    $('#inUni').val('');
    $('#inModelo').val('');
    $('#inMarca').val('');
    $('#inDet').val('');
    $('#inImg').val(''); 
}