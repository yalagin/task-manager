<?php

namespace App;

use Symfony\Component\Routing;


$routes = new Routing\RouteCollection();

$routes->add('getAllTasks', new Routing\Route('/tasks', [
    '_controller' => 'App\Controllers\TaskController::getAllTasks',
], methods: "GET"));

$routes->add('getTask', new Routing\Route('/tasks/{id}', [
    '_controller' => 'App\Controllers\TaskController::getTask',
], methods: "GET"));

$routes->add('createTask', new Routing\Route('/tasks', [
    '_controller' =>  'App\Controllers\TaskController::createTask',
], methods: "POST"));

$routes->add('updateTask', new Routing\Route('/tasks/{id}', [
    '_controller' =>  'App\Controllers\TaskController::updateTask',
], methods: "PUT"));

$routes->add('deleteTask', new Routing\Route('/tasks/{id}', [
    '_controller' => 'App\Controllers\TaskController::deleteTask',
], methods: "DELETE"));

return $routes;
