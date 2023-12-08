<?php

namespace Atreito\Core\Router;

class Routes {

    // Caminho base para as views
    const VIEW_BASE_PATH = "/var/www/html/atreito/app/View/";

    // Rotas
    const LOGIN_ROUTE              = "/login";
    const USUARIOS_ROUTE           = "/usuarios";
    const MOEDAS_ROUTE             = "/moedas";
    const PERFIL_ROUTE             = "/perfil";
    const RANKING_ROUTE            = "/ranking";
    const LOGS_ROUTE               = "/historico";
    const LOGOUT_ROUTE             = "/logout";
    const RESGATE_ROUTE             = "/resgate";

    // Caminhos dos arquivos de view correspondentes às rotas
    const LOGIN_VIEW              = self::VIEW_BASE_PATH . "login.php";              
    const USUARIOS_VIEW           = self::VIEW_BASE_PATH . "usuarios.php";          
    const MOEDAS_VIEW             = self::VIEW_BASE_PATH . "moedas.php";         
    const PERFIL_VIEW             = self::VIEW_BASE_PATH . "perfil.php";        
    const RANKING_VIEW            = self::VIEW_BASE_PATH . "ranking.php";   
    const LOGS_VIEW               = self::VIEW_BASE_PATH . "historico.php";
    const LOGOUT_VIEW             = self::VIEW_BASE_PATH . "logout.php";
    const RESGATE_VIEW             = self::VIEW_BASE_PATH . "resgate.php";

    public static function getRoutesToViewsMap(): array {
        return [
            self::LOGIN_ROUTE => self::LOGIN_VIEW,
            self::USUARIOS_ROUTE => self::USUARIOS_VIEW,
            self::MOEDAS_ROUTE => self::MOEDAS_VIEW,
            self::PERFIL_ROUTE => self::PERFIL_VIEW,
            self::USUARIOS_ROUTE => self::USUARIOS_VIEW,
            self::RANKING_ROUTE => self::RANKING_VIEW,
            self::LOGS_ROUTE => self::LOGS_VIEW,
            self::LOGOUT_ROUTE => self::LOGOUT_VIEW,
            self::RESGATE_ROUTE => self::RESGATE_VIEW
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

            /* CONTINUA ... */

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
            '/promotion-add' => [
                'class' => 'PromotionController',
                'method' => 'addPromotion'
            ]
        ];
    }
}
