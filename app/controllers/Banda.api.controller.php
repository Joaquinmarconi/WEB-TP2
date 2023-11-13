<?php
require_once './app/models/banda.model.php';
require_once './app/views/api.view.php';
require_once './app/helpers/auth.helper.php';

class BandaController extends ApiController
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new BandaModel();
    }

    public function showBands()
    {
        // obtengo bandas del controlador
        $bands = $this->model->getBandas();

        // muestro las bandas desde la vista
        $this->view->response($bands);
    }

    public function showBandDetail($id)
    {
        // Obtén los datos de la banda
        $band = $this->model->getBandaById($id);

        // Muestra el detalle de la banda desde la vista
        $this->view->showBandDetails($band);
    }

    public function addBand($params = null){
        
        $band = $this->getData();

        if (empty($band->Nombre_banda) || empty($band->Fecha_Fundacion)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insertBanda($band->Nombre_banda, $band->Fecha_Fundacion);
            $band = $this->model->getBandaById($id);
            $this->view->response($band, 201);
        }
    }

    public function getBand($params = null) {
        // obtengo el id del arreglo de params
        $id = $params[':ID'];
        $band = $this->model->getBandaById($id);

        // si no existe devuelvo 404
        if ($band)
            $this->view->response($band);
        else 
            $this->view->response("La banda con el id=$id no existe", 404);
    }

    public function deleteBand($params = null) {
        
        $id = $params[':ID'];

        $band = $this->model->getBandaById($id);
        if ($band) {
            $this->model->deleteBanda($id);
            $this->view->response($band);
        } else 
            $this->view->response("La banda con el id=$id no existe", 404);
    }

    public function updateBand($params = []) {

        $Banda_ID = $params[':ID'];
        $band = $this->model->getBandaById($Banda_ID);

        if ($band) {
            $body = $this->getData();
            $Nombre_banda = $body->Nombre_banda;
            $Fecha_Fundacion = $body->Fecha_Fundacion;
            $this->model->updateBanda($Banda_ID, $Nombre_banda, $Fecha_Fundacion);
            $this->view->response("Banda id=$Banda_ID actualizada con éxito", 200);
        }
        else 
            $this->view->response("Banda id=$Banda_ID no encontrada", 404);
    }
}


