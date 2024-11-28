// Declaración de la variable baseJSON
const baseJSON = [
    { id: 1, name: "Producto A", description: "Descripción del producto A" },
    { id: 2, name: "Producto B", description: "Descripción del producto B" },
    { id: 3, name: "Producto C", description: "Descripción del producto C" }
  ];
  
  // Función init(): Carga el JSON inicial en el textarea
  function init() {
    $('#description').val(JSON.stringify(baseJSON, null, 2));
  }
  
  // Función para agregar productos al JSON
  $(document).on('submit', '#product-form', function (e) {
    e.preventDefault();
    const name = $('#name').val().trim();
    const description = $('#description').val().trim();
  
    if (!name || !description) {
      alert("Por favor, completa todos los campos.");
      return;
    }
  
    const newProduct = {
      id: baseJSON.length + 1,
      name: name,
      description: description
    };
  
    baseJSON.push(newProduct);
  
    // Actualiza el JSON en el textarea y la tabla
    $('#description').val(JSON.stringify(baseJSON, null, 2));
    renderProducts();
    $('#product-form').trigger('reset');
  });
  
  // Función para buscar productos por ID, marca o descripción
  $(document).on('submit', '.form-inline', function (e) {
    e.preventDefault();
    const searchTerm = $('#search').val().trim().toLowerCase();
  
    if (!searchTerm) {
      alert("Por favor, introduce un término de búsqueda.");
      return;
    }
  
    const results = baseJSON.filter(product => 
      product.id.toString().includes(searchTerm) || 
      product.name.toLowerCase().includes(searchTerm) || 
      product.description.toLowerCase().includes(searchTerm)
    );
  
    if (results.length === 0) {
      alert("No se encontraron productos que coincidan con la búsqueda.");
    } else {
      renderProducts(results);
    }
  });
  
  // Renderiza los productos en la tabla
  function renderProducts(products = baseJSON) {
    const $productsTable = $('#products');
    $productsTable.empty();
  
    products.forEach(product => {
      $productsTable.append(`
        <tr>
          <td>${product.id}</td>
          <td>${product.name}</td>
          <td>${product.description}</td>
        </tr>
      `);
    });
  }
  
  // Inicializa la aplicación
  $(document).ready(function () {
    init();
    renderProducts();
  });
  