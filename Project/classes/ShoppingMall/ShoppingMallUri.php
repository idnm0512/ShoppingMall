<?php
    namespace ShoppingMall;

    use Common\Uri;
    use Common\DatabaseTable;
    use Common\Authentication;
    use Common\Mail;
    use ShoppingMall\Controllers\Home;
    use ShoppingMall\Controllers\User\Login;
    use ShoppingMall\Controllers\User\Join;
    use ShoppingMall\Controllers\User\Withdraw;
    use ShoppingMall\Controllers\User\Infomation;
    use ShoppingMall\Controllers\User\Find;

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
            $loginController = new Login($this -> authentication);
            $joinController = new Join($this -> userTable);
            $withdrawController = new Withdraw($this -> userTable);
            $infoController = new Infomation($this -> userTable);
            $findController = new Find($this -> userTable);
            $mailController = new Mail();

            $uri = [
                '' => [
                    'GET' => [
                        'controller' => $homeController,
                        'action' => 'home'
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
                'user/withdraw' => [
                    'GET' => [
                        'controller' => $withdrawController,
                        'action' => 'getPwdCheckForm'
                    ],
                    'POST' => [
                        'controller' => $withdrawController,
                        'action' => 'withdraw'
                    ]
                ],
                'user/info' => [
                    'GET' => [
                        'controller' => $infoController,
                        'action' => 'getUserInfoForm'
                    ],
                    'POST' => [
                        'controller' => $infoController,
                        'action' => 'updateUserInfo'
                    ]
                ],
                'user/find-id' => [
                    'GET' => [
                        'controller' => $findController,
                        'action' => 'getFindIdForm'
                    ],
                    'POST' => [
                        'controller' => $findController,
                        'action' => 'findId'
                    ]
                ],
                'user/find-pwd' => [
                    'GET' => [
                        'controller' => $findController,
                        'action' => 'getFindPwdForm'
                    ],
                    'POST' => [
                        'controller' => $findController,
                        'action' => 'findPwd'
                    ]
                ],
                'mail' => [
                    'POST' => [
                        'controller' => $mailController,
                        'action' => 'sendMail'
                    ]
                ]
            ];

            return $uri;
        }
    }