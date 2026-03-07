<?php

namespace Models;

class Categoria
{
    protected $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    /**
     * Todas las categorías
     */
    public function all()
    {
        return $this->db->query(
            "SELECT idCategoria AS id, nombre, descripcion
             FROM categorias
             ORDER BY nombre ASC"
        )->get();
    }

    /**
     * Buscar categoría por ID
     */
    public function find($id)
    {
        return $this->db->query(
            "SELECT idCategoria AS id, nombre, descripcion
             FROM categorias
             WHERE idCategoria = :id",
            ['id' => $id]
        )->find();
    }
}