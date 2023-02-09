<?php

/**
 * Repository : bisnis rule yang berhubungan dengan logic ke database
 * Repository juga mengelola data entity.
 */

namespace Repository {

    use Entity\Todolist;
    use PDO;

    /**
     * mengapa menggunakan interface terlebih dahulu?
     * agar dapat gambaran logic, berguna ketika nanti di php unit test
     */
    interface TodolistRepository
    {
        function save(Todolist $todolist): void;
        /**
         * menggunakan variable tipe data todolist di parameter, sama saja/seolah olah
         * : jika ingin mengesave data todolis maka membutuhkan parameter $todo yang ada pada Todolist dan ada juga fungsi setNya.
         */
        function remove(int $number): bool;

        function findAll(): array;
    }

    class TodolistRepositoryImpl implements TodolistRepository
    {
        public array $todolist = array();

        private PDO $connection;

        public function __construct(PDO $connection)
        {
            $this->connection = $connection;
        }

        function save(Todolist $todolist): void
        {
            $sql = "INSERT INTO todolist (todo) VALUES (?)";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$todolist->getTodo()]);
        }

        function remove(int $number): bool
        {

            $sql = "SELECT id FROM todolist WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$number]);

            if ($statement->fetch()) {
                // id ditemukan
                $sql = "DELETE FROM todolist WHERE id = ?";
                $statement = $this->connection->prepare($sql);
                $statement->execute([$number]);
                return \true;
            } else {
                // id tidak ditemukan
                return \false;
            }
        }

        function findAll(): array
        {
            // return $this->todolist;
            $sql = "SELECT id, todo FROM todolist";
            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $result = [];

            foreach ($statement as $row) {
                $todolist = new Todolist();
                $todolist->setId($row['id']);
                $todolist->setTodo($row['todo']);
                $result[] = $todolist;
            }

            return $result;
        }
    }
}
