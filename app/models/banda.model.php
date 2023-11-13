<?php

class BandaModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=pagina_musica;charset=utf8', 'root', '');
    }

    /**
     * Obtiene y devuelve de la base de datos todas las banda.
     */
    function getBandas($sortOrder, $sortField, $filterField, $filterValue, $resultLimit, $resultOffset)
    {

        $params = [];
        $sql = "SELECT * FROM banda";

        $allowedFields = ['Banda_ID', 'Nombre_Banda', 'Fecha_Fundacion'];

        if (!empty($filterField) && !empty($filterValue) && in_array($filterField, $allowedFields)) {
            $sql .= ' WHERE ' . $filterField . ' = ?';
            $params[] = $filterValue;
        }

        if (!empty($sortField) && in_array($sortField, $allowedFields)) {
            $sql .= ' ORDER BY ' . $sortField;
        } else if (empty($sortField)) {
            $sql .= ' ORDER BY Nombre_Banda';
        } else {
            throw new Exception("Campo de ordenación no permitido");
        }

        $allowedSortOrders = ['ASC', 'DESC'];

        if (!empty($sortOrder) && in_array($sortOrder, $allowedSortOrders)) {
            $sql .= ' ' . $sortOrder;
        } else if (empty($sortOrder)) {
            $sql .= ' ASC';
        } else {
            throw new Exception("Tipo de ordenación no permitido");
        }

        if (!empty($resultLimit) && is_numeric($resultLimit)) {
            $sql .= ' LIMIT ' . (int) $resultLimit;
        }

        if (!empty($resultOffset) && is_numeric($resultOffset)) {
            $sql .= ' OFFSET ' . (int) $resultOffset;
        }

        $query = $this->db->prepare($sql);
        $query->execute($params);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    function getBandaById($id)
    {
        $query = $this->db->prepare('SELECT * FROM banda WHERE Banda_ID = ?');
        $query->execute([$id]);

        // $banda es un objeto que representa la banda
        $banda = $query->fetch(PDO::FETCH_OBJ);

        return $banda;
    }


    /**
     * Inserta la tarea en la base de datos
     */
    function insertBanda($Nombre_banda, $Fecha_Fundacion)
    {
        $query = $this->db->prepare('INSERT INTO banda (Nombre_banda, Fecha_Fundacion) VALUES(?,?)');
        $query->execute([$Nombre_banda, $Fecha_Fundacion]);

        return $this->db->lastInsertId();
    }


    function deleteBanda($id)
    {
        $query = $this->db->prepare('DELETE FROM banda WHERE Banda_ID = ?');
        $query->execute([$id]);
    }


    public function updateBanda($bandaId, $campo, $nuevoValor)
    {
        $allowedFields = ['Nombre_banda', 'Fecha_Fundacion'];

        if (in_array($campo, $allowedFields)) {
            $query = $this->db->prepare("UPDATE banda SET {$campo} = ? WHERE Banda_ID = ?");

            $query->execute([$nuevoValor, $bandaId]);
        } else {
            throw new Exception("Campo no permitido");
        }
    }

}


