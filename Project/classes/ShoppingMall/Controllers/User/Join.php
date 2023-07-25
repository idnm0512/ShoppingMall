<?php
    namespace ShoppingMall\Controllers\User;

    use Common\DatabaseTable;
    use Common\Util;

    class Join {
        
        private $userTable;

        public function __construct(DatabaseTable $userTable) {
            $this -> userTable = $userTable;
        }

        public function getJoinForm() {
            return [
                'template' => 'joinForm.html.php',
                'title' => '회원가입'
            ];
        }

        public function join() {
            $userReq = $_POST['user'];

            $errors = blankCheck($userReq);

            if (!empty($userReq['id']) && count($this -> userTable -> findByColumn('id', $userReq['id'])) > 0) {
                $errors[] = '이미 가입된 아이디입니다.';
            };

            if (!empty($userReq['email'])) {
                if (filter_var($userReq['email'], FILTER_VALIDATE_EMAIL) == false) {
                    $errors[] = '이메일 형식이 올바르지 않습니다.';
                } else if (count($this -> userTable -> findByColumn('email', $userReq['email'])) > 0) {
                    $errors[] = '이미 가입된 이메일입니다.';
                }
            }

            if (empty($errors)) {
                $userReq['password'] = password_hash($userReq['password'], PASSWORD_DEFAULT);

                $this -> userTable -> save($userReq);

                header('location: /');
            } else {
                return [
                    'template' => 'joinForm.html.php',
                    'title' => '회원가입',
                    'variables' => [
                        'errors' => $errors,
                        'user' => $userReq
                    ]
                ];
            }
        }
    }