<?php

namespace Atreito\Core\Router;

class Routes {

    // Caminho base para as views
    const VIEW_BASE_PATH = "/var/www/html/atreito/app/View/";

    // Rotas
    const LOGIN_ROUTE              = "/login";
    const DASHBOARD_ROUTE          = "/dashboard";
    const CADASTRO_USUARIO_ROUTE  = "/cadastro-usuario";
    const AUTO_CADASTRO_ROUTE      = "/auto-cadastro";
    const PONTOS_ADMIN_ROUTE       = "/pontos-admin";
    const PERFIL_ROUTE             = "/perfil";
    const CONFIG_ADMIN_ROUTE       = "/config-admin";
    const USUARIOS_ROUTE           = "/usuarios";
    const RANKING_ROUTE            = "/ranking";
    const VANTAGENS_CLIENTE_ROUTE  = "/vantagens-cliente";
    const LOGS_ROUTE               = "/logs";
    const LOGOUT_ROUTE             = "/logout";

    // Caminhos dos arquivos de view correspondentes às rotas
    const LOGIN_VIEW              = self::VIEW_BASE_PATH . "login.php";
    const DASHBOARD_VIEW          = self::VIEW_BASE_PATH . "dashboard.php";
    const CADASTRO_USUARIO_VIEW  = self::VIEW_BASE_PATH . "cadastro_usuario.php";
    const AUTO_CADASTRO_VIEW      = self::VIEW_BASE_PATH . "auto_cadastro.php";
    const PONTOS_ADMIN_VIEW       = self::VIEW_BASE_PATH . "pontos_admin.php";
    const PERFIL_VIEW             = self::VIEW_BASE_PATH . "perfil.php";
    const CONFIG_ADMIN_VIEW       = self::VIEW_BASE_PATH . "configuracoes_admin.php";
    const USUARIOS_VIEW           = self::VIEW_BASE_PATH . "usuarios.php";
    const RANKING_VIEW            = self::VIEW_BASE_PATH . "ranking.php";
    const VANTAGENS_CLIENTE_VIEW  = self::VIEW_BASE_PATH . "vantagens_cliente.php";
    const LOGS_VIEW               = self::VIEW_BASE_PATH . "logs.php";
    const LOGOUT_VIEW             = self::VIEW_BASE_PATH . "logout.php";

    public static function getRoutesToViewsMap(): array {
        return [
            self::LOGIN_ROUTE => self::LOGIN_VIEW,
            self::DASHBOARD_ROUTE => self::DASHBOARD_VIEW,
            self::CADASTRO_USUARIO_ROUTE => self::CADASTRO_USUARIO_VIEW,
            self::AUTO_CADASTRO_ROUTE => self::AUTO_CADASTRO_VIEW,
            self::PONTOS_ADMIN_ROUTE => self::PONTOS_ADMIN_VIEW,
            self::PERFIL_ROUTE => self::PERFIL_VIEW,
            self::CONFIG_ADMIN_ROUTE => self::CONFIG_ADMIN_VIEW,
            self::USUARIOS_ROUTE => self::USUARIOS_VIEW,
            self::RANKING_ROUTE => self::RANKING_VIEW,
            self::VANTAGENS_CLIENTE_ROUTE => self::VANTAGENS_CLIENTE_VIEW,
            self::LOGS_ROUTE => self::LOGS_VIEW,
            self::LOGOUT_ROUTE => self::LOGOUT_VIEW
        ];
    }

    // ROTAS para CONTROLLERS ...

    public static function getControllerRoutes(): array {
        return [
            '/login-ajax' => [
                'class' => 'UserController',
                'method' => 'loginAjax'
            ],
            '/admin-add-user' => [
                'class' => 'UserController',
                'method' => 'addUser'
            ],
            '/results-user' => [
                'class' => 'UserController',
                'method' => 'getUsersBySearch'
            ]
            // mais rotas de controlador aqui conforme necessário
        ];
    }
}
