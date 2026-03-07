<?php

namespace Core\Middleware;

class Authenticated
{
    public function handle()
    {
        // Bug fix: paréntesis necesarios para que ?? actúe como fallback correcto
        if (! ($_SESSION['user'] ?? false)) {
            header('location: /login');
            exit();
        }
    }
}