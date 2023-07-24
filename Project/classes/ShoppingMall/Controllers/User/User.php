<?php
    namespace ShoppingMall\Controllers\User;

    use Common\DatabaseTable;

    class User {

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

        public function getUserInfoForm() {
            $userRes = $this -> userTable -> findByColumn('id', $_SESSION['id']);

            if (!empty($userRes)) {
                return [
                    'template' => 'userInfo.html.php',
                    'title' => '회원정보',
                    'variables' => [
                        'user' => $userRes[0]
                    ]
                ];
            }
        }

        public function updateUserInfo() {
            $userReq = $_POST['user'];

            $errors = blankCheck($userReq);

            if (empty($errors)) {
                if (password_verify($userReq['password'], $_SESSION['password'])) {
                    unset($userReq['password']);

                    $this -> userTable -> save($userReq);

                    header('location: /user/info');
                } else {
                    $errors[] = '패스워드가 일치하지 않습니다.';

                    return [
                        'template' => 'userInfo.html.php',
                        'title' => '회원정보',
                        'variables' => [
                            'errors' => $errors,
                            'user' => (object) $userReq
                        ]
                    ];
                }
            } else {
                return [
                    'template' => 'userInfo.html.php',
                    'title' => '회원정보',
                    'variables' => [
                        'errors' => $errors,
                        'user' => (object) $userReq
                    ]
                ];
            }
        }
    }