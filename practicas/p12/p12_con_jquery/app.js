// Variable baseJSON que contiene los productos
let baseJSON = [
    { id: 1, name: "Producto 1", description: "Descripción del Producto 1", deleted: false },
    { id: 2, name: "Producto 2", description: "Descripción del Producto 2", deleted: false },
    { id: 3, name: "Producto 3", description: "Descripción del Producto 3", deleted: true },
    { id: 4, name: "Producto 4", description: "Descripción del Producto 4", deleted: false }
  ];
  
  // Función para inicializar la página
  function init() {
    cargarProductos();
  }
  
  // Cargar toda la lista de productos no eliminados
  function cargarProductos() {
    const productosNoEliminados = baseJSON.filter(producto => !producto.deleted);
    
    // Llenar la tabla de productos
    const $productsTable = $("#products");
    $productsTable.empty();
    productosNoEliminados.forEach(producto => {
      $productsTable.append(`
        <tr>
          <td>${producto.id}</td>
          <td>${producto.name}</td>
          <td>${producto.description}</td>
        </tr>
      `);
    });
  
    // Actualizar la barra de estado con los nombres de los productos
    const $statusBar = $("#container");
    $statusBar.empty();
    productosNoEliminados.forEach(producto => {
      $statusBar.append(`<li>${producto.name}</li>`);
    });
  
    // Mostrar la barra de estado si no está visible
    $("#product-result").removeClass("d-none");
  }
  
  // Buscar productos en tiempo real
  $("#search").on("keyup", function () {
    const query = $(this).val().toLowerCase();
    const productosFiltrados = baseJSON.filter(
      producto => !producto.deleted &&
        (producto.name.toLowerCase().includes(query) || 
         producto.description.toLowerCase().includes(query))
    );
  
    // Actualizar la tabla
    const $productsTable = $("#products");
    $productsTable.empty();
    productosFiltrados.forEach(producto => {
      $productsTable.append(`
        <tr>
          <td>${producto.id}</td>
          <td>${producto.name}</td>
          <td>${producto.description}</td>
        </tr>
      `);
    });
  
    // Actualizar la barra de estado
    const $statusBar = $("#container");
    $statusBar.empty();
    productosFiltrados.forEach(producto => {
      $statusBar.append(`<li>${producto.name}</li>`);
    });
  });
  
  // Agregar un nuevo producto
  $("#product-form").on("submit", function (e) {
    e.preventDefault();
  
    const name = $("#name").val();
    const description = $("#description").val();
  
    if (!name || !description) {
      alert("Por favor, completa todos los campos.");
      return;
    }
  
    // Simular ID único
    const newId = baseJSON.length ? baseJSON[baseJSON.length - 1].id + 1 : 1;
  
    // Agregar producto a baseJSON
    baseJSON.push({ id: newId, name, description, deleted: false });
  
    // Mostrar mensaje de éxito
    alert("Producto agregado exitosamente.");
  
    // Limpiar formulario
    $("#name").val("");
    $("#description").val("");
  
    // Recargar lista de productos
    cargarProductos();
  });
  
  // Función para eliminar un producto (simulado por ID)
  function eliminarProducto(id) {
    const producto = baseJSON.find(p => p.id === id);
    if (producto) {
      producto.deleted = true;
      alert(`Producto con ID ${id} eliminado.`);
  
      // Recargar lista de productos
      cargarProductos();
    } else {
      alert("Producto no encontrado.");
    }
  }
  