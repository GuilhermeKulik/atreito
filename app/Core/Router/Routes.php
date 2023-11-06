<?php

namespace Atreito\Core\Router;

class Routes {

    // Caminho base para as views
    const VIEW_BASE_PATH = "/var/www/html/atreito/app/View/";

    // Rotas
    const LOGIN_ROUTE              = "/login";
    const USUARIOS_ROUTE           = "/usuarios";
    const USUARIO_EDIT_ROUTE      = "/usuarios/editar";
    const CADASTRO_USUARIO_ROUTE   = "/usuarios/cadastrar";
    const AUTO_CADASTRO_ROUTE      = "/auto-cadastro";
    const PONTOS_ROUTE             = "/pontos";
    const PERFIL_ROUTE             = "/perfil";
    const CONFIG_ADMIN_ROUTE       = "/config-admin";
    const RANKING_ROUTE            = "/ranking";
    const LOGS_ROUTE               = "/historico";
    const LOGOUT_ROUTE             = "/logout";
    const PROMOS_ROUTE             = "/promocoes";

    // Caminhos dos arquivos de view correspondentes às rotas
    const LOGIN_VIEW              = self::VIEW_BASE_PATH . "login.php";              /* OK */
    const USUARIOS_VIEW           = self::VIEW_BASE_PATH . "usuarios.php";           /* OK */
    const USUARIO_EDIT_VIEW       = self::VIEW_BASE_PATH . "editar_usuario.php";            
    const CADASTRO_USUARIO_VIEW   = self::VIEW_BASE_PATH . "cadastro_usuario.php"; /* OK */
    const AUTO_CADASTRO_VIEW      = self::VIEW_BASE_PATH . "auto_cadastro.php"; 
    const PONTOS_VIEW             = self::VIEW_BASE_PATH . "pontos.php";         /* OK */
    const PERFIL_VIEW             = self::VIEW_BASE_PATH . "perfil.php";        /* FAZER */
    const CONFIG_ADMIN_VIEW       = self::VIEW_BASE_PATH . "configuracoes.php";
    const RANKING_VIEW            = self::VIEW_BASE_PATH . "ranking.php";    /* OK */
    const LOGS_VIEW               = self::VIEW_BASE_PATH . "historico.php";
    const LOGOUT_VIEW             = self::VIEW_BASE_PATH . "logout.php";
    const PROMOS_VIEW             = self::VIEW_BASE_PATH . "promocoes.php";

    public static function getRoutesToViewsMap(): array {
        return [
            self::LOGIN_ROUTE => self::LOGIN_VIEW,
            self::USUARIOS_ROUTE => self::USUARIOS_VIEW,
            self::USUARIO_EDIT_ROUTE => self::USUARIO_EDIT_VIEW,
            self::CADASTRO_USUARIO_ROUTE => self::CADASTRO_USUARIO_VIEW,
            self::AUTO_CADASTRO_ROUTE => self::AUTO_CADASTRO_VIEW,
            self::PONTOS_ROUTE => self::PONTOS_VIEW,
            self::PERFIL_ROUTE => self::PERFIL_VIEW,
            self::CONFIG_ADMIN_ROUTE => self::CONFIG_ADMIN_VIEW,
            self::USUARIOS_ROUTE => self::USUARIOS_VIEW,
            self::RANKING_ROUTE => self::RANKING_VIEW,
            self::LOGS_ROUTE => self::LOGS_VIEW,
            self::LOGOUT_ROUTE => self::LOGOUT_VIEW,
            self::PROMOS_ROUTE => self::PROMOS_VIEW
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
            ],
            '/add-points' => [
                'class' => 'ScoreController',
                'method' => 'addPoints'
            ],
            '/consume-points' => [
                'class' => 'ScoreController',
                'method' => 'consumePoints'
            ],
            '/get-user' => [
                'class' => 'UserController',
                'method' => 'getUserByIdJson'
            ],
            '/user-edit-send' => [
                'class' => 'UserController',
                'method' => 'updateUserInfo'
            ],
        ];
    }
}
