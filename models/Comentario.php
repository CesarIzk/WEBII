<?php

namespace Models;

class Comentario
{
    protected $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    /**
     * Comentarios de una publicación con datos del autor
     */
    public function porPublicacion($idPublicacion)
    {
        return $this->db->query(
            "SELECT c.idComentario, c.contenido AS texto, c.fecha,
                    u.Nombre AS nombre, u.fotoPerfil
             FROM comentarios c
             JOIN users u ON u.idUsuario = c.idUsuario
             WHERE c.idPublicacion = :id
             ORDER BY c.fecha ASC",
            ['id' => $idPublicacion]
        )->get();
    }

    /**
     * Crear un comentario
     */
    public function create($idPublicacion, $idUsuario, $contenido)
    {
        $this->db->query(
            "INSERT INTO comentarios (idPublicacion, idUsuario, contenido)
             VALUES (:idPublicacion, :idUsuario, :contenido)",
            [
                'idPublicacion' => $idPublicacion,
                'idUsuario'     => $idUsuario,
                'contenido'     => $contenido,
            ]
        );

        // Actualizar contador en publicaciones
        $this->db->query(
            "UPDATE publicaciones SET comentarios = comentarios + 1
             WHERE idPublicacion = :id",
            ['id' => $idPublicacion]
        );
    }
}