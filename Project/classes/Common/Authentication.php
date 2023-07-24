<?php
    namespace Common;

    use Common\DatabaseTable;

    class Authentication {

        private $userTable;
        private $userIdColumn;
        private $userPwdColumn;
        
        public function __construct(DatabaseTable $userTable, string $userIdColumn, string $userPwdColumn) {
            session_start();

            $this -> userTable = $userTable;
            $this -> userIdColumn = $userIdColumn;
            $this -> userPwdColumn = $userPwdColumn;
        }

        public function loginProcess($userIdValue, $userPwdValue): bool {
            $userRes = $this -> userTable -> findByColumn($this -> userIdColumn, $userIdValue);

            if (!empty($userRes) && $userRes[0] -> status != 0 && password_verify($userPwdValue, $userRes[0] -> {$this -> userPwdColumn})) {
                session_regenerate_id();

                $_SESSION['user_idx'] = $userRes[0] -> idx;
                $_SESSION['id'] = $userRes[0] -> {$this -> userIdColumn};
                $_SESSION['password'] = $userRes[0] -> {$this -> userPwdColumn};

                return true;
            } else {
                return false;
            }
        }
    }