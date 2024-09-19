<?php

$parqueVehicular = [
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
    'ABC1234' => [
        'Auto' => [
            'marca' => 'TOYOTA',
            'modelo' => '2021',
            'tipo' => 'sedan'
        ],
        'Propietario' => [
            'nombre' => 'Daniel Martínez',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 1'
        ]
    ],
    'DEF5678' => [
        'Auto' => [
            'marca' => 'FORD',
            'modelo' => '2018',
            'tipo' => 'hatchback'
        ],
        'Propietario' => [
            'nombre' => 'Diego León',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 2'
        ]
    ],
    'GHI9101' => [
        'Auto' => [
            'marca' => 'BMW',
            'modelo' => '2020',
            'tipo' => 'camioneta'
        ],
        'Propietario' => [
            'nombre' => 'Michael Phelps',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 3'
        ]
    ],
    'JKL1122' => [
        'Auto' => [
            'marca' => 'AUDI',
            'modelo' => '2019',
            'tipo' => 'sedan'
        ],
        'Propietario' => [
            'nombre' => 'Adam Peaty',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 4'
        ]
    ],
    'MNO3344' => [
        'Auto' => [
            'marca' => 'HONDA',
            'modelo' => '2022',
            'tipo' => 'hatchback'
        ],
        'Propietario' => [
            'nombre' => 'Haiyang Qin',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 5'
        ]
    ],
    'PQR5566' => [
        'Auto' => [
            'marca' => 'MERCEDES',
            'modelo' => '2021',
            'tipo' => 'sedan'
        ],
        'Propietario' => [
            'nombre' => 'Chad Leclos',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 6'
        ]
    ],
    'STU7788' => [
        'Auto' => [
            'marca' => 'HYUNDAI',
            'modelo' => '2020',
            'tipo' => 'camioneta'
        ],
        'Propietario' => [
            'nombre' => 'Miguel Torres',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 7'
        ]
    ],
    'VWX9900' => [
        'Auto' => [
            'marca' => 'KIA',
            'modelo' => '2019',
            'tipo' => 'sedan'
        ],
        'Propietario' => [
            'nombre' => 'Aranza Gómez',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 8'
        ]
    ],
    'YZA1234' => [
        'Auto' => [
            'marca' => 'CHEVROLET',
            'modelo' => '2018',
            'tipo' => 'hatchback'
        ],
        'Propietario' => [
            'nombre' => 'Ambar Perez',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 9'
        ]
    ],
    'BCD5678' => [
        'Auto' => [
            'marca' => 'NISSAN',
            'modelo' => '2020',
            'tipo' => 'camioneta'
        ],
        'Propietario' => [
            'nombre' => 'Abraham Lopez',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 10'
        ]
    ],
    'EFG9101' => [
        'Auto' => [
            'marca' => 'SUBARU',
            'modelo' => '2019',
            'tipo' => 'sedan'
        ],
        'Propietario' => [
            'nombre' => 'Lucía Martínez',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 11'
        ]
    ],
    'HIJ1122' => [
        'Auto' => [
            'marca' => 'JEEP',
            'modelo' => '2021',
            'tipo' => 'camioneta'
        ],
        'Propietario' => [
            'nombre' => 'Alejandra Armas',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 12'
        ]
    ],
    'KLM3344' => [
        'Auto' => [
            'marca' => 'FIAT',
            'modelo' => '2018',
            'tipo' => 'hatchback'
        ],
        'Propietario' => [
            'nombre' => 'Homero Simpson',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 13'
        ]
    ]
];

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricula = $_POST['matricula'] ?? null;
    
    if ($matricula) {
        if (isset($parqueVehicular[$matricula])) {
            echo '<h3>Información del Vehículo con Matrícula ' . htmlspecialchars($matricula) . '</h3>';
            echo '<pre>';
            print_r($parqueVehicular[$matricula]);
            echo '</pre>';
        } else {
            echo '<h3>No se encontró la matrícula ' . htmlspecialchars($matricula) . '</h3>';
        }
    } elseif (isset($_POST['consultar_todos'])) {
        echo '<h3>Lista Completa de Autos Registrados</h3>';
        echo '<pre>';
        print_r($parqueVehicular);
        echo '</pre>';
    }
}
?>
