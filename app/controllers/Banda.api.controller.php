<?php
require_once './app/models/banda.model.php';
require_once './app/views/api.view.php';

class BandaApiController extends ApiController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new BandaModel();
    }

    public function getBands()
    {
        $sortOrder = $_GET['sortOrder'] ?? null;
        $sortField = $_GET['sortField'] ?? null;
        $filterField = $_GET['filterField'] ?? null;
        $filterValue = $_GET['filterValue'] ?? null;
        $resultLimit = $_GET['resultLimit'] ?? null;
        $resultOffset = $_GET['resultOffset'] ?? null;

        // obtengo bandas del modelo
        $bands = $this->model->getBandas($sortOrder, $sortField, $filterField, $filterValue, $resultLimit, $resultOffset);

        // muestro las bandas desde la vista
        $this->view->response($bands);
    }


    public function addBand($params = null)
    {

        $band = $this->getData();

        if (empty($band->Nombre_banda) || empty($band->Fecha_Fundacion)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertBanda($band->Nombre_banda, $band->Fecha_Fundacion);
            $band = $this->model->getBandaById($id);
            $this->view->response($band, 201);
        }
    }

    public function getBand($params = null)
    {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $band = $this->model->getBandaById($id);

        // si no existe devuelvo 404
        if ($band)
            $this->view->response($band);
        else
            $this->view->response("La banda con el id=$id no existe", 404);
    }

    public function deleteBand($params = null)
    {

        $id = $params[':ID'];

        $band = $this->model->getBandaById($id);
        if ($band) {
            $this->model->deleteBanda($id);
            $this->view->response($band);
        } else
            $this->view->response("La banda con el id=$id no existe", 404);
    }

    public function updateBand($params = [])
    {
        $Banda_ID = $params[':ID'];
        $band = $this->model->getBandaById($Banda_ID);

        if ($band) {
            $body = $this->getData();
            $this->model->updateBanda($Banda_ID, 'Nombre_banda', $body->Nombre_banda);
            $this->model->updateBanda($Banda_ID, 'Fecha_Fundacion', $body->Fecha_Fundacion);
            $this->view->response("Banda id=$Banda_ID actualizada con éxito", 200);
        } else
            $this->view->response("Banda id=$Banda_ID no encontrada", 404);
    }

}


