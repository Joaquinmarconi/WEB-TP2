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
    function getBandas()
    {
        $query = $this->db->prepare('SELECT * FROM banda');
        $query->execute();

        // $Bandas es un arreglo de banda
        $Bandas = $query->fetchAll(PDO::FETCH_OBJ);

        return $Bandas;
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
    function insertBanda($title, $description, $priority)
    {
        $query = $this->db->prepare('INSERT INTO banda (titulo, descripcion, prioridad) VALUES(?,?,?)');
        $query->execute([$title, $description, $priority]);

        return $this->db->lastInsertId();
    }


    function deleteBanda($id)
    {
        $query = $this->db->prepare('DELETE FROM banda WHERE id = ?');
        $query->execute([$id]);
    }

    
    public function updateBanda($bandaId, $campo, $nuevoValor)
    {
        // Prepara la consulta SQL
        $query = $this->db->prepare("UPDATE banda SET {$campo} = ? WHERE Banda_ID = ?");

        // Ejecuta la consulta con los valores del formulario
        $query->execute([$nuevoValor, $bandaId]);
    }
}