<?php

namespace Models;

class Like
{
    protected $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    /**
     * Verificar si un usuario ya dio like a una publicación
     */
    public function existe($idPublicacion, $idUsuario)
    {
        $result = $this->db->query(
            "SELECT idLike FROM likes
             WHERE idPublicacion = :idPublicacion AND idUsuario = :idUsuario",
            ['idPublicacion' => $idPublicacion, 'idUsuario' => $idUsuario]
        )->find();

        return (bool) $result;
    }

    /**
     * Dar like (inserta en likes y suma 1 en publicaciones)
     */
    public function dar($idPublicacion, $idUsuario)
    {
        $this->db->query(
            "INSERT INTO likes (idPublicacion, idUsuario)
             VALUES (:idPublicacion, :idUsuario)",
            ['idPublicacion' => $idPublicacion, 'idUsuario' => $idUsuario]
        );

        $this->db->query(
            "UPDATE publicaciones SET likes = likes + 1
             WHERE idPublicacion = :id",
            ['id' => $idPublicacion]
        );
    }

    /**
     * Quitar like (elimina de likes y resta 1 en publicaciones)
     */
    public function quitar($idPublicacion, $idUsuario)
    {
        $this->db->query(
            "DELETE FROM likes
             WHERE idPublicacion = :idPublicacion AND idUsuario = :idUsuario",
            ['idPublicacion' => $idPublicacion, 'idUsuario' => $idUsuario]
        );

        $this->db->query(
            "UPDATE publicaciones SET likes = GREATEST(likes - 1, 0)
             WHERE idPublicacion = :id",
            ['id' => $idPublicacion]
        );
    }

    /**
     * Toggle: si ya tiene like lo quita, si no lo da. Devuelve el nuevo estado.
     */
    public function toggle($idPublicacion, $idUsuario)
    {
        if ($this->existe($idPublicacion, $idUsuario)) {
            $this->quitar($idPublicacion, $idUsuario);
            return false; // ya no tiene like
        }

        $this->dar($idPublicacion, $idUsuario);
        return true; // ahora tiene like
    }
}