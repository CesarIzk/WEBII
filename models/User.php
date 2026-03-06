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
}