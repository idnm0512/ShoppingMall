<?php
    namespace ShoppingMall\Controllers\User;

    use Common\DatabaseTable;

    class Withdraw {
        
        private $userTable;

        public function __construct(DatabaseTable $userTable) {
            $this -> userTable = $userTable;
        }

        public function getPwdCheckForm() {
            return [
                'template' => 'pwdCheckForm.html.php',
                'title' => '패스워드 확인'
            ];
        }

        public function withdraw() {
            $userReq = $_POST['user'];

            if (password_verify($userReq['password'], $_SESSION['password'])) {
                unset($userReq['password']);

                $this -> userTable -> save($userReq);

                session_unset();

                header('location: /');
            } else {
                $errors[] = '패스워드가 일치하지 않습니다.';

                return [
                    'template' => 'pwdCheckForm.html.php',
                    'title' => '패스워드 확인',
                    'variables' => [
                        'errors' => $errors
                    ]
                ];
            }
        }
    }