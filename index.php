<?php
include_once("php/db.php");

$contactos = [];
$dataVacia = '<div class="divUps">Ups! No tienes contactos en tu lista, agrega uno!</div>';
$dataContacto = [];
$listaContactos = array();
$infoContactoSeleccionado = [];

$query = new ManagementDB;

$data = $query->getContacts();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $query->getContacts();
    $nombre = htmlspecialchars($_POST['nameContacto']); 
    $numero = htmlspecialchars($_POST['numeroContacto']);
    $ciudad = htmlspecialchars($_POST['ciudadContacto']);
    $empresa = htmlspecialchars($_POST['empresaContacto']);

    $contacto = [
        'nombre' => $nombre,
        'numero' => $numero,
        'ciudad' => $ciudad,
        'empresa' => $empresa,
    ];

    array_push($contactos, $contacto);

    $query->saveDB($contacto);
}


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    if (isset($_GET['id'])) {
        foreach ($data as $contacto) {
            if ($contacto['id'] == $_GET['id']) {
                $infoContactoSeleccionado = $contacto;
                break; // Opcional: detiene el bucle al encontrar el primero
            }
        }
    }
}


if(!empty($data)){
    $i=0;
    foreach($data as $monito){
        $listaContactos[$i] = '<li class="itemContactos" onclick="activeItemList()" idB="' . $monito['id'] . '"><a href="index.php?id=' . $monito['id'] . '">' . $monito['name'] . '</a></li>';
        $i++;
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="stylesheet" href="styles/styles.css">
    <script src="js/funciones.js"></script>
</head>
<body>
    <main>
        <header>
            <h1>Agenda</h1>
        </header>
        <section class="parent">
            <aside class="contactos">
                <?php 
                    if(!empty($data)){
                        foreach ($listaContactos as $key => $value){
                            echo $value;
                        }
                    }else{
                        echo '<ul id="listaContactos">' . $dataVacia . '</ul>';
                    }
                ?>
            </aside>
            <section class="nuevoContacto">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div>
                    <label for="nameContacto">Nombre:</label>
                    <input type="text" id="nameContacto" name="nameContacto">
                    </div>
                    <div>
                    <label for="nameContacto">Número:</label>
                    <input type="text" id="numeroContacto" name="numeroContacto">
                    </div>
                    <div>
                    <label for="nameContacto">Ciudad:</label>
                    <input type="text" id="ciudadContacto" name="ciudadContacto">
                    </div>
                    <div>
                    <label for="nameContacto">Empresa:</label>
                    <input type="text" id="empresaContacto" name="empresaContacto">
                    </div>
                    <button id="btnGuardarContacto" type="submit">Guardar</button>
                </form>
            </section>
            <section class="infoContacto">
                <?php
                    if(!empty($infoContactoSeleccionado)){
                        echo '
                        <div></div>
                            <div class="divInfoContacto">
                            
                            <div class="itemInfoContactoFlex">
                            <h4>Nombre:</h4><h5>'.$infoContactoSeleccionado['name'].'</h5><br>
                            <h4>Número:</h4><h5>'.$infoContactoSeleccionado['number'].'</h5><br>
                            </div>
                            <div class="itemInfoContactoFlex">
                            <h4>Ciudad:</h4><h5>'.$infoContactoSeleccionado['city'].'</h5><br>
                            <h4>Empresa:</h4><h5>'.$infoContactoSeleccionado['company'].'</h5><br>
                            </div>
                            </div>
                        ';
                    }else{
                        echo '<div class="divNoInfoContacto">
                    Selecciona un contacto de la lista de la izquierda para ver su información.
                     
                </div>';
                    }
                ?>
            </section>
        </section>
    </main>
</body>
</html>