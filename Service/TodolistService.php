<?php

// Service adalah busines Logic, tempat dimana fungsi fungsi manipulasi data dibuat
// Service : bisnis rule yang berhubungan dengan logic aplikasi

namespace Service {

    use Entity\Todolist;
    use Repository\{TodolistRepository, TodolistRepositoryImpl};

    /**
     * mengapa menggunakan interface terlebih dahulu?
     * agar dapat gambaran logic, berguna ketika nanti di php unit test
     */
    interface TodolistService
    {
        function showTodoList(): void;

        function addTodoList(string $todo): void;

        function removeTodoList(int $number): void;
    }

    class TodolistServiceImpl implements TodolistService
    {
        private TodolistRepository $todolistRepository;
        /**
         * mengapa properties diatas menggunakan tipe data TodolistRepository? bukannya harus menggunakan TodolistRepositoryImpl?
         * karena menggunakan kemampuan polimorphisme, yaitu ketika kita menggunakan tipe data dari parentClass, maka kita bisa mengubah bentuk menjadi class class turunannya.
         * dalam kasus ini parent classnya yaitu interface
         */

        public function __construct(TodolistRepository $todolistRepository)
        {
            $this->todolistRepository = $todolistRepository;
            // construct disini untuk menerima object repository, yang berisikan method save, remove, findAll dan juga properti array todolist untuk menyimpan nilai
        }

        function showTodoList(): void
        {
            echo "TODOLIST" . PHP_EOL;
            $todolist = $this->todolistRepository->findAll();
            foreach ($todolist as $number => $value) {
                echo $value->getId() . "." . $value->getTodo() . PHP_EOL;
            }
        }

        function addTodoList(string $todo): void
        {
            $todolist = new Todolist($todo);
            // membuat object entiti dengan constructor yang diterima dari parameter method.

            $this->todolistRepository->save($todolist);
            echo "SUKSES MENAMBAH TODOLIST" . PHP_EOL;
        }

        function removeTodoList(int $number): void
        {
            if ($this->todolistRepository->remove($number)) {
                echo "SUKSES MENGHAPUS TODO" . \PHP_EOL;
            } else {
                echo "GAGAL MENGHAPUS TODO" . \PHP_EOL;
            }
        }
    }
}
