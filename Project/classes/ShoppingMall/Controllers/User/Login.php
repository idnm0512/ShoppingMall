<?php
    namespace ShoppingMall\Controllers\User;

    use Common\Authentication;

    class Login {

        private $authentication;

        public function __construct(Authentication $authentication) {
            $this -> authentication = $authentication;
        }

        public function getLoginForm() {
            return [
                'template' => 'loginForm.html.php',
                'title' => '로그인'
            ];
        }

        public function login() {
            $userReq = $_POST['user'];

            $errors = blankCheck($userReq);
            
            if (empty($errors)) {
                if ($this -> authentication -> loginProcess($userReq['id'], $userReq['password'])) {
                    header('location: /');
                } else {
                    $errors[] = '아이디/패스워드가 유효하지 않습니다.';

                    return [
                        'template' => 'loginForm.html.php',
                        'title' => '로그인',
                        'variables' => [
                            'errors' => $errors
                        ]
                    ];
                }
            } else {
                return [
                    'template' => 'loginForm.html.php',
                    'title' => '로그인',
                    'variables' => [
                        'errors' => $errors,
                        'user' => $userReq
                    ]
                ];
            }
        }

        public function logout() {
            session_unset();

            header('location: /');
        }
    }