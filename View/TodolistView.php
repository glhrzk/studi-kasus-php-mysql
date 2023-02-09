<?php


namespace view {

    use Service\TodolistService;
    use Helper\InputHelper;

    class TodolistView
    {

        private TodolistService $todolistService;
        /**
         * kenapa butuh properties ini?
         * buat nerima data dari service, jadi nanti manggil data data dari service
         * ini contoh implemen dari polimorphisme 
         */


        public function __construct(TodolistService $todolistService)
        {
            $this->todolistService = $todolistService;
        }


        /**
         * method/function ini berisi menu, di setiap menu akan dipanggil submenu, didalam submed akan dipanggil service.
         */
        function showTodoList(): void
        {
            while (true) {
                $this->todolistService->showTodoList();

                echo "MENU" . PHP_EOL;
                echo "1. Tambah Todo" . PHP_EOL;
                echo "2. Hapus Todo" . PHP_EOL;
                echo "x. Keluar" . PHP_EOL;

                $pilihan = InputHelper::input("Pilih");

                if ($pilihan == "1") {
                    $this->addTodoList();
                } elseif ($pilihan == "2") {
                    $this->removeTodoList();
                } elseif ($pilihan == "x") {
                    break;
                } else {
                    echo "Pilihan tidak ditemukan" . PHP_EOL;
                }
            }
            echo "Sampai jumpa lagi" . PHP_EOL;
        }

        function addTodoList(): void
        {
            echo "MENAMBAH TODO" . \PHP_EOL;

            $todo = InputHelper::input("Todo (x untuk batal)");

            if ($todo == "x") {
                echo "Batal Menambah todo" . \PHP_EOL;
            } else {
                $this->todolistService->addTodoList($todo);
            }
        }

        function removeTodoList(): void
        {
            echo "MENGHAPUS TODO" . PHP_EOL;

            $pilihan = InputHelper::input("Nomor (x untuk batal)");

            if ($pilihan == "x") {
                echo "Batal menghapus todo" . PHP_EOL;
            } else {
                $this->todolistService->removeTodoList((int)$pilihan);
            }
        }
    }
}
