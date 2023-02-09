<?php

require_once __DIR__ . "/../Entity/Todolist.php";
require_once __DIR__ . "/../Repository/TodolistRepository.php";
require_once __DIR__ . "/../Service/TodolistService.php";
require_once __DIR__ . "/../Config/Database.php";

use Config\Database;
use Entity\Todolist;
use Service\TodolistServiceImpl;
use Repository\TodolistRepositoryImpl;


function testShowTodolist()
{
    $connection = Database::getConnection();
    $todolistRepository = new TodolistRepositoryImpl($connection);

    /**
     * stepnya, dibuat dulu objectnya menggunakan class TodolistRepositoryImpl.
     * di insert datanya, data yang di insert pun bentuknya object.  
     * objectnya dikirim pakai fungsi constructor TodolistServiceImpl
     * lalu dicek satu satu di fungsi showTodoList() yang ada di TodolistServiceImpl
     * dikembalikan nilainya.
     */

    $todolistService = new TodolistServiceImpl($todolistRepository);
    $todolistService->showTodoList();
}

function testAddTodolist()
{

    $connection = Database::getConnection();

    $todolistRepository = new TodolistRepositoryImpl($connection);
    $todolistService = new TodolistServiceImpl($todolistRepository);
    $todolistService->addTodoList("Belajar PHP");
    $todolistService->addTodoList("Belajar PHP OOP");
    $todolistService->addTodoList("Belajar PHP Database");
    $todolistService->addTodoList("Belajar PHP Laravel");
    // $todolistService->showTodoList();
}

function testRemoveTodolist()
{
    $connection = Database::getConnection();
    $todolistRepository = new TodolistRepositoryImpl($connection);

    $todolistService = new TodolistServiceImpl($todolistRepository);

    echo $todolistService->removeTodoList(5);
    echo $todolistService->removeTodoList(4);
    echo $todolistService->removeTodoList(3);
    echo $todolistService->removeTodoList(2);
    echo $todolistService->removeTodoList(1);
}

testShowTodolist();
