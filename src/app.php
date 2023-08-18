<?php

namespace App;

use App\Controllers\TaskController;
use Symfony\Component\Routing;


$routes = new Routing\RouteCollection();

$routes->add('getAllTasks', new Routing\Route('/tasks', [
    '_controller' => [new TaskController(), 'getAllTasks'],
], methods: "GET"));

$routes->add('getTask', new Routing\Route('/tasks/{id}', [
    '_controller' => [new TaskController(), 'getTask'],
], methods: "GET"));

$routes->add('createTask', new Routing\Route('/tasks', [
    '_controller' => [new TaskController(), 'createTask'],
], methods: "POST"));

$routes->add('updateTask', new Routing\Route('/tasks/{id}', [
    '_controller' => [new TaskController(), 'updateTask'],
], methods: "PUT"));

$routes->add('deleteTask', new Routing\Route('/tasks/{id}', [
    '_controller' => [new TaskController(), 'deleteTask'],
], methods: "DELETE"));

return $routes;
