<?php

namespace Models;

class User {
    protected $db;

    public function __construct($database) {
        $this->db = $database;
    }

    /**
     * Busca un usuario por email (útil para login)
     */
    public function findByEmail($email) {
        return $this->db->query("SELECT * FROM users WHERE email = :email", [
            'email' => $email
        ])->find();
    }

    /**
     * Lógica de autenticación
     */
    public function attempt($email, $password) {
        $user = $this->findByEmail($email);

        if ($user && $user['contrasena'] === $password) {
            return $user;
        }

        return false;
    }

    /**
     * Crear un nuevo usuario (Registro)
     */
    public function create($attributes) {
        $this->db->query(
            "INSERT INTO users (Nombre, email, contrasena, fechaNacimiento, genero) 
             VALUES (:nombre, :email, :contrasena, :fecha, :genero)",
            [
                'nombre'    => $attributes['nombre'],
                'email'     => $attributes['correo'],
                'contrasena' => $attributes['password'],
                'fecha'     => $attributes['fecha_nacimiento'],
                'genero'    => $attributes['genero'],
            ]
        );

        return $this->db->connection->lastInsertId();
    }

    /**
     * Buscar por ID
     */
    public function find($id) {
        return $this->db->query("SELECT * FROM users WHERE idUsuario = :id", [
            'id' => $id
        ])->find();
    }

    /**
     * Publicaciones de un usuario para su perfil
     */
    public function publicaciones($usuario_id) {
        return $this->db->query(
            "SELECT
                p.idPublicacion AS id,
                p.texto,
                p.tipoContenido,
                p.rutaMulti,
                p.estado,
                p.postdate      AS fecha,
                p.likes,
                p.comentarios
             FROM publicaciones p
             WHERE p.idUsuario = :usuario_id
             ORDER BY p.postdate DESC",
            ['usuario_id' => $usuario_id]
        )->get();
    }

    /**
     * Buscar usuarios por nombre o email (buscador de amigos)
     */
    public function buscar($q, $usuario_id_actual) {
        if (empty(trim($q))) {
            return [];
        }

        $termino = '%' . trim($q) . '%';

        return $this->db->query(
            "SELECT idUsuario AS id, Nombre AS nombre, email, avatar
             FROM users
             WHERE (Nombre LIKE :q OR email LIKE :q2)
               AND idUsuario != :yo
             LIMIT 20",
            [
                'yo' => $usuario_id_actual,
                'q'  => $termino,
                'q2' => $termino,
            ]
        )->get();
    }
}