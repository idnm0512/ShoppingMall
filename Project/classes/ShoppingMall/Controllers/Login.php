<?php
    namespace ShoppingMall\Controllers;

    use Common\Authentication;

    class Login {

        private $authentication;

        public function __construct(Authentication $authentication) {
            $this -> authentication = $authentication;
        }

        public function loginForm() {
            return [
                'template' => 'loginForm.html.php',
                'title' => '로그인'
            ];
        }

        public function loginProcess() {
            $userReq = $_POST['user'];

            $valid = true;
            $errors = [];

            if (empty($userReq['user_id'])) {
                $valid = false;
                $errors[] = '아이디를 입력하세요.';
            }

            if (empty($userReq['password'])) {
                $valid = false;
                $errors[] = '패스워드를 입력하세요.';
            }
            
            if ($valid == true) {
                if ($this -> authentication -> login($userReq['user_id'], $userReq['password'])) {
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
    }