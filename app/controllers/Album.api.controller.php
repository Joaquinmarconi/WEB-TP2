<?php
require_once './app/models/album.model.php';
require_once './app/views/api.view.php';
require_once './app/models/banda.model.php';
require_once 'api.controller.php';


class AlbumApiController extends ApiController
{
    protected $model;

    private $category_model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new AlbumModel();
        $this->category_model = new BandaModel();
    }

    public function getAlbums()
    {
        $sortOrder = $_GET['sortOrder'] ?? null;
        $sortField = $_GET['sortField'] ?? null;
        $filterField = $_GET['filterField'] ?? null;
        $filterValue = $_GET['filterValue'] ?? null;
        $resultLimit = $_GET['resultLimit'] ?? null;
        $resultOffset = $_GET['resultOffset'] ?? null;

        // obtengo álbumes del modelo
        $albums = $this->model->getAlbums($sortOrder, $sortField, $filterField, $filterValue, $resultLimit, $resultOffset);

        // muestro los álbumes desde la vista
        $this->view->response($albums);
    }


    public function addAlbum($params = null)
    {
        $album = $this->getData();

        if (empty($album->Nombre_Album) || empty($album->Año) || empty($album->Banda_ID)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertAlbum($album->Nombre_Album, $album->Año, $album->Banda_ID);
            $album = $this->model->getAlbumById($id);
            $this->view->response($album, 201);
        }
    }

    public function getAlbum($params = null)
    {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $album = $this->model->getAlbumById($id);

        // si no existe devuelvo 404
        if ($album)
            $this->view->response($album);
        else
            $this->view->response("El album con el id=$id no existe", 404);
    }

    public function deleteAlbum($params = null)
    {

        $id = $params[':ID'];

        $album = $this->model->getAlbumById($id);
        if ($album) {
            $this->model->deleteAlbum($id);
            $this->view->response($album);
        } else
            $this->view->response("El album con el id=$id no existe", 404);
    }

    public function updateAlbum($params = [])
    {
        $Album_ID = $params[':ID'];
        $album = $this->model->getAlbumById($Album_ID);

        if ($album) {
            $body = $this->getData();
            $this->model->updateAlbum($Album_ID, 'Nombre_Album', $body->Nombre_Album);
            $this->model->updateAlbum($Album_ID, 'Año', $body->Año);
            $this->model->updateAlbum($Album_ID, 'Banda_ID', $body->Banda_ID);
            $this->view->response("Tarea id=$Album_ID actualizada con éxito", 200);
        } else
            $this->view->response("Task id=$Album_ID not found", 404);
    }



}
