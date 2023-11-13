<?php

class AlbumModel
{
    private $db;

    function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=pagina_musica;charset=utf8', 'root', '');
    }

    /**
     * Obtiene y devuelve de la base de datos tareas por filtros.
     */
    function getAlbums($sortOrder, $sortField, $filterField, $filterValue, $resultLimit, $resultOffset)
    {
        $params = [];
        $sql = "SELECT * FROM album";

        $allowedFields = ['Nombre_Album', 'Año', 'Banda_ID'];

        if (!empty($filterField) && !empty($filterValue) && in_array($filterField, $allowedFields)) {
            $sql .= ' WHERE ' . $filterField . ' = ?';
            $params[] = $filterValue;
        }

        $allowedSortOrders = ['ASC', 'DESC'];

        if (!empty($sortField) && in_array($sortField, $allowedFields)) {
            $sql .= ' ORDER BY ' . $sortField;
        } else if (empty($sortField)) {
            $sql .= ' ORDER BY Nombre_Album'; 
        } else {
            throw new Exception("Campo de ordenación no permitido");
        }
        
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



    function getAlbumById($id)
    {
        $query = $this->db->prepare('SELECT * FROM album WHERE Album_ID = ?');
        $query->execute([$id]);

        // $album es un objeto que representa el álbum
        $album = $query->fetch(PDO::FETCH_OBJ);

        return $album;
    }


    /**
     * Inserta la tarea en la base de datos
     */
    function insertAlbum($nombre_album, $año, $banda_id)
    {
        $query = $this->db->prepare('INSERT INTO album (Nombre_Album, Año, Banda_ID) VALUES(?,?,?)');
        $query->execute([$nombre_album, $año, $banda_id]);

        return $this->db->lastInsertId();
    }



    function deleteAlbum($id)
    {
        $query = $this->db->prepare('DELETE FROM album WHERE Album_ID = ?');
        $query->execute([$id]);
    }

    public function updateAlbum($albumId, $campo, $nuevoValor)
    {
        $allowedFields = ['Nombre_Album', 'Año', 'Banda_ID'];

        if (in_array($campo, $allowedFields)) {
            
            $query = $this->db->prepare("UPDATE album SET {$campo} = ? WHERE Album_ID = ?");

            $query->execute([$nuevoValor, $albumId]);
        } else {
            throw new Exception("Campo no permitido");
        }
    }


}