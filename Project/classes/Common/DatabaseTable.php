<?php
    namespace Common;

    class DatabaseTable {

        private $pdo;
        private $tableName;
        private $primaryKeyName;
        private $className;
        private $constructorArgs;

        public function __construct(\PDO $pdo, string $tableName, string $primaryKeyName,
                                        string $className = '\stdClass', array $constructorArgs = []) {
            $this -> pdo = $pdo;
            $this -> tableName = $tableName;
            $this -> primaryKeyName = $primaryKeyName;
            $this -> className = $className;
            $this -> constructorArgs = $constructorArgs;
        }

        private function query($strQuery, $parameters = []) {
            $query = $this -> pdo -> prepare($strQuery);

            $query -> execute($parameters);

            return $query;
        }

        private function formatDate($parameters) {
            foreach ($parameters as $key => $value) {
                if ($value instanceof \DateTime) {
                    $parameters[$key] = $value -> format('Y-m-d H:i:s');
                }
            }

            return $parameters;
        }

        public function total() {
            $strQuery = 'SELECT COUNT(*) FROM `' . $this -> tableName . '`';
            
            $query = $this -> query($strQuery);

            $result = $query -> fetch();

            return $result[0];
        }

        public function findAll() {
            $strQuery = 'SELECT * FROM `' . $this -> tableName . '`';

            $query = $this -> query($strQuery);

            $result = $query -> fetchAll(\PDO::FETCH_CLASS, $this -> className, $this -> constructorArgs);

            return $result;
        }

        public function findByColumn($columnName, $value) {
            $strQuery = 'SELECT * FROM `' . $this -> tableName . '` WHERE `' . $columnName . '` = :value';

            $parameters = [
                ':value' => $value
            ];

            $query = $this -> query($strQuery, $parameters);

            $result = $query -> fetchAll(\PDO::FETCH_CLASS, $this -> className, $this -> constructorArgs);

            return $result;
        }

        public function findById($idx) {
            $strQuery = 'SELECT * FROM `' . $this -> tableName . '` WHERE `' . $this -> primaryKeyName . '` = :value';

            $parameters = [
                ':value' => $idx
            ];

            $query = $this -> query($strQuery, $parameters);

            $result = $query -> fetchObject($this -> className, $this -> constructorArgs);

            return $result;
        }

        public function save($parameters) {
            $entity = new $this -> className(...$this -> constructorArgs);

            try {
                if ($parameters[$this -> primaryKeyName] == '') {
                    $parameters[$this -> primaryKeyName] = null;
                }

                $parameters['insert_date'] = new \DateTime();

                $lastInsertId = $this -> insert($parameters);

                $entity -> {$this -> primaryKeyName} -> $lastInsertId;
            } catch (\PDOException $e) {
                $parameters['update_date'] = new \DateTime();

                $this -> update($parameters);
            }

            foreach ($parameters as $key => $value) {
                if (!empty($value)) {
                    $entity -> $key = $value;
                }
            }

            return $entity;
        }

        private function insert($parameters) {
            $strQuery = 'INSERT INTO `' . $this -> tableName . '` (';

            foreach ($parameters as $key => $value) {
                $strQuery .= '`' . $key . '`,';
            }

            $strQuery = rtrim($strQuery, ',');
            $strQuery .= ') VALUES (';

            foreach ($parameters as $key => $value) {
                $strQuery .= ':' . $key . ',';
            }

            $strQuery = rtrim($strQuery, ',');
            $strQuery .= ')';

            $parameters = $this -> formatDate($parameters);

            $this -> query($strQuery, $parameters);

            $lastInsertId = $this -> pdo -> lastInsertId();

            return $lastInsertId;
        }

        private function update($parameters) {
            $strQuery = 'UPDATE `' . $this -> tableName . '` SET ';

            foreach ($parameters as $key => $value) {
                $strQuery .= '`' . $key . '` = :' . $key . ',';
            }

            $strQuery = rtrim($strQuery, ',');
            $strQuery .= ' WHERE `' . $this -> primaryKeyName . '` = :value';

            $parameters[':value'] = $parameters['idx'];

            $parameters = $this -> formatDate($parameters);

            $this -> query($strQuery, $parameters);
        }

        public function deleteByColumn($columnName, $value) {
            $strQuery = 'DELETE FROM `' . $this -> tableName . '` WHERE `' . $columnName . '` = :value';

            $parameters = [
                ':value' => $value
            ];

            $this -> query($strQuery, $parameters);
        }

        public function deleteById($idx) {
            $strQuery = 'DELETE FROM `' . $this -> tableName . '` WHERE `' . $this -> primaryKeyName . '` = :value';

            $parameters = [
                ':value' => $idx
            ];

            $this -> query($strQuery, $parameters);
        }
    }