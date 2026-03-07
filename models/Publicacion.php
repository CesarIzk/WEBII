<?php

namespace Models;

class Publicacion
{
    protected $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    /**
     * Todas las publicaciones (para el feed general)
     */
    public function all()
    {
        return $this->db->query(
            "SELECT p.idPublicacion AS id, p.texto, p.tipoContenido, p.rutaMulti,
                    p.likes, p.comentarios, p.estado, p.postdate AS fecha,
                    p.idCategoria, u.Nombre AS autor, u.idUsuario
             FROM publicaciones p
             JOIN users u ON u.idUsuario = p.idUsuario
             WHERE p.estado = 'publico'
             ORDER BY p.postdate DESC"
        )->get();
    }

    /**
     * Buscar una publicación por ID
     */
    public function find($id)
    {
        return $this->db->query(
            "SELECT p.idPublicacion AS id, p.texto, p.tipoContenido, p.rutaMulti,
                    p.likes, p.comentarios, p.estado, p.postdate AS fecha,
                    p.idCategoria, u.Nombre AS autor, u.idUsuario
             FROM publicaciones p
             JOIN users u ON u.idUsuario = p.idUsuario
             WHERE p.idPublicacion = :id",
            ['id' => $id]
        )->find();
    }

    /**
     * Crear nueva publicación
     */
    public function create($attributes)
    {
        $this->db->query(
            "INSERT INTO publicaciones (idUsuario, texto, tipoContenido, rutaMulti, idCategoria, estado)
             VALUES (:idUsuario, :texto, :tipoContenido, :rutaMulti, :idCategoria, 'publico')",
            [
                'idUsuario'     => $attributes['idUsuario'],
                'texto'         => $attributes['texto'],
                'tipoContenido' => $attributes['tipoContenido'] ?? 'texto',
                'rutaMulti'     => $attributes['rutaMulti']     ?? null,
                'idCategoria'   => $attributes['idCategoria']   ?? null,
            ]
        );

        return $this->db->connection->lastInsertId();
    }

    /**
     * Eliminar publicación por ID
     */
    public function delete($id)
    {
        $this->db->query(
            "DELETE FROM publicaciones WHERE idPublicacion = :id",
            ['id' => $id]
        );
    }

    /**
     * Cambiar estado (publico / oculto)
     */
    public function cambiarEstado($id, $estado)
    {
        $this->db->query(
            "UPDATE publicaciones SET estado = :estado WHERE idPublicacion = :id",
            ['estado' => $estado, 'id' => $id]
        );
    }

    /**
     * Dar like a una publicación
     */
    public function like($id)
    {
        $this->db->query(
            "UPDATE publicaciones SET likes = likes + 1 WHERE idPublicacion = :id",
            ['id' => $id]
        );
    }

    /**
     * Publicaciones para el panel admin (todas, incluyendo ocultas)
     */
    public function allAdmin()
    {
        return $this->db->query(
            "SELECT p.idPublicacion AS id, p.texto, p.tipoContenido, p.rutaMulti,
                    p.likes, p.comentarios, p.estado, p.postdate AS fecha,
                    u.Nombre AS autor, u.idUsuario
             FROM publicaciones p
             JOIN users u ON u.idUsuario = p.idUsuario
             ORDER BY p.postdate DESC"
        )->get();
    }

    /**
     * Buscar publicaciones por texto o autor (feed con filtro)
     */
    public function buscar($q)
    {
        if (empty(trim($q))) {
            return $this->all();
        }

        $termino = '%' . trim($q) . '%';

        return $this->db->query(
            "SELECT p.idPublicacion AS id, p.texto, p.tipoContenido, p.rutaMulti,
                    p.likes, p.comentarios, p.estado, p.postdate AS fecha,
                    u.Nombre AS autor, u.idUsuario
             FROM publicaciones p
             JOIN users u ON u.idUsuario = p.idUsuario
             WHERE p.estado = 'publico'
               AND (p.texto LIKE :q OR u.Nombre LIKE :q2)
             ORDER BY p.postdate DESC",
            ['q' => $termino, 'q2' => $termino]
        )->get();
    }

    /**
     * Publicaciones de un usuario específico (para su perfil)
     */
    public function buscarPorUsuario($usuario_id)
    {
        return $this->db->query(
            "SELECT idPublicacion AS id, texto, tipoContenido, rutaMulti,
                    likes, comentarios, estado, postdate AS fecha
             FROM publicaciones
             WHERE idUsuario = :usuario_id
             ORDER BY postdate DESC",
            ['usuario_id' => $usuario_id]
        )->get();
    }
}