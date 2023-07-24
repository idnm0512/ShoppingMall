<?php
    namespace ShoppingMall;

    use Common\Authentication;
    use Common\Uri;
    use Common\DatabaseTable;
    use ShoppingMall\Controllers\Home;
    use ShoppingMall\Controllers\Join;
    use ShoppingMall\Controllers\Login;

    class ShoppingMallUri implements Uri {

        private $userTable;
        private $authentication;

        public function __construct() {
            include __DIR__ . '/../../includes/DatabaseConnection.php';

            $this -> userTable = new DatabaseTable($pdo, 'user', 'id', 'ShoppingMall\Entity\User', []);
            $this -> authentication = new Authentication($this -> userTable, 'user_id', 'password');
        }

        public function getUri(): Array {
            $homeController = new Home();
            $joinController = new Join($this -> userTable);
            $loginControlelr = new Login($this -> authentication);

            $uri = [
                '' => [
                    'GET' => [
                        'controller' => $homeController,
                        'action' => 'home'
                    ]
                ],
                'user/join' => [
                    'GET' => [
                        'controller' => $joinController,
                        'action' => 'joinForm'
                    ],
                    'POST' => [
                        'controller' => $joinController,
                        'action' => 'saveUser'
                    ]
                ],
                'user/login' => [
                    'GET' => [
                        'controller' => $loginControlelr,
                        'action' => 'loginForm'
                    ],
                    'POST' => [
                        'controller' => $loginControlelr,
                        'action' => 'loginProcess'
                    ]
                ],
            ];

            return $uri;
        }
    }