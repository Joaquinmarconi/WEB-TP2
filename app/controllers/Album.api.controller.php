<?php
require_once './app/models/album.model.php';
require_once './app/views/album.view.php';
require_once './app/helpers/auth.helper.php';
require_once './app/models/banda.model.php';


class AlbumController
{
    private $model;
    private $view;
    private $category_model;

    public function __construct()
    {

        $this->model = new AlbumModel();
        $this->view = new ApiView();
        $this->category_model = new BandaModel();
    }

    public function showAlbums()
    {
        // obtengo tareas del controlador
        $Albums = $this->model->getAlbums();

        // muestro las tareas desde la vista
        $this->view->showAlbums($Albums);
    }

    public function showAlbumDetail($id)
{
    // Obtén los datos del álbum
    $album = $this->model->getAlbumById($id);

    // Obtén los datos de la banda
    $banda = $this->category_model->getBandaById($album->Banda_ID);

    // Muestra el detalle del álbum desde la vista
    $this->view->showAlbumDetails($album, $banda);
}

    public function addAlbum()
    {

        AuthHelper::verify();
        // obtengo los datos del álbum
        $nombre_album = $_POST['nombre_album'];
        $año = $_POST['año'];
        $banda_id = $_POST['banda_id'];

        // validaciones
        if (empty($nombre_album) || empty($año) || empty($banda_id)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertAlbum($nombre_album, $año, $banda_id);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showError("Error al insertar el álbum");
        }
    }


    function removeAlbum($id)
    {
        AuthHelper::verify();
        $this->model->deleteAlbum($id);
        header('Location: ' . BASE_URL);
    }

    public function updateAlbum()
    {
        AuthHelper::verify();
        // Obtén los valores del formulario
        $albumId = $_POST['albumId'];
        $campo = $_POST['campo'];
        $nuevoValor = $_POST['nuevoValor'];

        // Actualiza el álbum en la base de datos
        $this->model->updateAlbum($albumId, $campo, $nuevoValor);

        // Redirige al usuario a la página de administración
        header('Location: ' . BASE_URL . 'administracion_album');
    }

}
