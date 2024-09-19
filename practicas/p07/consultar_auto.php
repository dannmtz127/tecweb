<?php

include 'src/funciones.php';

$vehiculos = [
    'UBN6338' => [
        'Auto' => [
            'marca' => 'HONDA',
            'modelo' => '2020',
            'tipo' => 'camioneta'
        ],
        'Propietario' => [
            'nombre' => 'Alfonzo Esparza',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'C.U., Jardines de San Manuel'
        ]
    ],
    'UBN6339' => [
        'Auto' => [
            'marca' => 'MAZDA',
            'modelo' => '2019',
            'tipo' => 'sedan'
        ],
        'Propietario' => [
            'nombre' => 'Ma. del Consuelo Molina',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => '97 oriente'
        ]
    ],
    'XYZ1234' => [
        'Auto' => [
            'marca' => 'TOYOTA',
            'modelo' => '2021',
            'tipo' => 'sedan'
        ],
        'Propietario' => [
            'nombre' => 'Daniel Martínez',
            'ciudad' => 'Ciudad de México',
            'direccion' => 'Av. Reforma 123'
        ]
    ],
    'ABC5678' => [
        'Auto' => [
            'marca' => 'NISSAN',
            'modelo' => '2018',
            'tipo' => 'hatchback'
        ],
        'Propietario' => [
            'nombre' => 'Diego León',
            'ciudad' => 'Monterrey, NL',
            'direccion' => 'Calle 5 de Febrero 456'
        ]
    ],
    'LMN9012' => [
        'Auto' => [
            'marca' => 'FORD',
            'modelo' => '2019',
            'tipo' => 'camioneta'
        ],
        'Propietario' => [
            'nombre' => 'Michael Phelps',
            'ciudad' => 'Los Angeles, CA',
            'direccion' => '123 Main St.'
        ]
    ],
    'DEF3456' => [
        'Auto' => [
            'marca' => 'CHEVROLET',
            'modelo' => '2022',
            'tipo' => 'sedan'
        ],
        'Propietario' => [
            'nombre' => 'Adam Peaty',
            'ciudad' => 'London',
            'direccion' => '456 Oxford St.'
        ]
    ],
    'GHI7890' => [
        'Auto' => [
            'marca' => 'HONDA',
            'modelo' => '2020',
            'tipo' => 'hatchback'
        ],
        'Propietario' => [
            'nombre' => 'Haiyang Qin',
            'ciudad' => 'Shanghai',
            'direccion' => '789 Nanjing Rd.'
        ]
    ],
    'JKL1234' => [
        'Auto' => [
            'marca' => 'AUDI',
            'modelo' => '2021',
            'tipo' => 'sedan'
        ],
        'Propietario' => [
            'nombre' => 'Chad Leclos',
            'ciudad' => 'Durban',
            'direccion' => '123 Beach Rd.'
        ]
    ],
    'MNO5678' => [
        'Auto' => [
            'marca' => 'BMW',
            'modelo' => '2022',
            'tipo' => 'camioneta'
        ],
        'Propietario' => [
            'nombre' => 'Miguel Torres',
            'ciudad' => 'Madrid',
            'direccion' => '789 Gran Vía'
        ]
    ],
    'PQR9012' => [
        'Auto' => [
            'marca' => 'MERCEDES',
            'modelo' => '2023',
            'tipo' => 'sedan'
        ],
        'Propietario' => [
            'nombre' => 'Aranza Gómez',
            'ciudad' => 'Buenos Aires',
            'direccion' => '456 Avenida 9 de Julio'
        ]
    ],
    'STU3456' => [
        'Auto' => [
            'marca' => 'SUBARU',
            'modelo' => '2020',
            'tipo' => 'hatchback'
        ],
        'Propietario' => [
            'nombre' => 'Ambar Perez',
            'ciudad' => 'Lima',
            'direccion' => '123 Av. Larco'
        ]
    ],
    'VWX7890' => [
        'Auto' => [
            'marca' => 'JEEP',
            'modelo' => '2021',
            'tipo' => 'camioneta'
        ],
        'Propietario' => [
            'nombre' => 'Abraham Lopez',
            'ciudad' => 'Bogotá',
            'direccion' => '456 Carrera 7'
        ]
    ],
    'YZ1234' => [
        'Auto' => [
            'marca' => 'KIA',
            'modelo' => '2022',
            'tipo' => 'sedan'
        ],
        'Propietario' => [
            'nombre' => 'Lucía Martínez',
            'ciudad' => 'Quito',
            'direccion' => '789 Av. Amazonas'
        ]
    ],
    'AAA5678' => [
        'Auto' => [
            'marca' => 'RENAULT',
            'modelo' => '2020',
            'tipo' => 'hatchback'
        ],
        'Propietario' => [
            'nombre' => 'Alejandra Armas',
            'ciudad' => 'Asunción',
            'direccion' => '123 Av. España'
        ]
    ],
    'BBB9012' => [
        'Auto' => [
            'marca' => 'TOYOTA',
            'modelo' => '2021',
            'tipo' => 'camioneta'
        ],
        'Propietario' => [
            'nombre' => 'Homero Simpson',
            'ciudad' => 'Springfield',
            'direccion' => '742 Evergreen Terrace'
        ]
    ]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['matricula'])) {
        $matricula = $_POST['matricula'];
        if (array_key_exists($matricula, $vehiculos)) {
            $auto = $vehiculos[$matricula];
            echo '<h2>Información del vehículo</h2>';
            echo '<pre>';
            print_r($auto);
            echo '</pre>';
        } else {
            echo '<h2>Información del vehículo</h2>';
            echo '<p>No se encontró un vehículo con la matrícula proporcionada.</p>';
        }
    } elseif (isset($_POST['todos'])) {
        echo '<h2>Todos los vehículos registrados</h2>';
        echo '<pre>';
        print_r($vehiculos);
        echo '</pre>';
    }
}
?>
