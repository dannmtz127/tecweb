<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
        require_once __DIR__ . '/Opcion.php';
        require_once __DIR__ . '/Menu.php';

        $menu1 = new Menu('horizontal');

        $opc1 = new Opcion('Facebook', 'https://www.facebook.com', '#C3D9FF');
        $menu1->insertar_opcion($opc1);

        $opc2 = new Opcion('Outlook', "https://www.outlook.com", '#CDEBBB');
        $menu1->insertar_opcion($opc2);

        $opc3 = new Opcion('Instagram', 'https://www.instagram.com', 'FFD9C3');
        $menu1->insertar_opcion($opc3);

        $menu1->graficar();
        ?>
    </body>
</html>