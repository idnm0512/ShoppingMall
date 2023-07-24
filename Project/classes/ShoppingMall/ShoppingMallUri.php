<?php
    namespace ShoppingMall;

    use Common\Uri;
    use Common\DatabaseTable;
    use Common\Authentication;
    use ShoppingMall\Controllers\Home;
    use ShoppingMall\Controllers\User\Join;
    use ShoppingMall\Controllers\User\Login;
    use ShoppingMall\Controllers\User\User;

    class ShoppingMallUri implements Uri {

        private $userTable;
        private $authentication;

        public function __construct() {
            include __DIR__ . '/../../includes/DatabaseConnection.php';

            $this -> userTable = new DatabaseTable($pdo, 'user', 'idx', 'ShoppingMall\Entity\User', []);
            $this -> authentication = new Authentication($this -> userTable, 'id', 'password');
        }

        public function getUri(): Array {
            $homeController = new Home();
            $joinController = new Join($this -> userTable);
            $loginController = new Login($this -> authentication);
            $userController = new User($this -> userTable);

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
                        'action' => 'getJoinForm'
                    ],
                    'POST' => [
                        'controller' => $joinController,
                        'action' => 'join'
                    ]
                ],
                'user/login' => [
                    'GET' => [
                        'controller' => $loginController,
                        'action' => 'getLoginForm'
                    ],
                    'POST' => [
                        'controller' => $loginController,
                        'action' => 'login'
                    ]
                ],
                'user/logout' => [
                    'GET' => [
                        'controller' => $loginController,
                        'action' => 'logout'
                    ]
                ],
                'user/withdraw' => [
                    'GET' => [
                        'controller' => $userController,
                        'action' => 'getPwdCheckForm'
                    ],
                    'POST' => [
                        'controller' => $userController,
                        'action' => 'withdraw'
                    ]
                ],
                'user/info' => [
                    'GET' => [
                        'controller' => $userController,
                        'action' => 'getUserInfoForm'
                    ],
                    'POST' => [
                        'controller' => $userController,
                        'action' => 'updateUserInfo'
                    ]
                ],
            ];

            return $uri;
        }
    }