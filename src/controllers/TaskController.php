<?php

namespace App\Controllers;

use App\validation\TaskValidation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class TaskController
{
    private static array $tasks = [];

    public function getAllTasks(Request $request): JsonResponse
    {
        return new JsonResponse(self::$tasks);
    }

    public function getTask(Request $request): JsonResponse
    {
        $id = $request->attributes->get('id');
        if (isset(self::$tasks[$id])) {
            return new JsonResponse(self::$tasks[$id]);
        } else {
            return new JsonResponse(['error' => 'Task not found'], 404);
        }
    }

    public function createTask(Request $request): JsonResponse
    {
        $data = $request->attributes->all();
        // Validate request data
        $validationErrors = TaskValidation::validateTaskData($data);
        if (!empty($validationErrors)) {
            return new JsonResponse(['error' => 'Validation failed', 'errors' => $validationErrors], 400);
        }
        $task = [
            'id' => uniqid(),
            'title' => $data['title'],
            'description' => $data['description'],
            'status' => $data['status']
        ];
        self::$tasks[$task['id']] = $task;
        return new JsonResponse($task, 201);
    }

    public function updateTask(Request $request): JsonResponse
    {
        $data = $request->attributes->all();
        $id = $data['id'];
        if (isset(self::$tasks[$id])) {
            $data = $request->attributes->all();
            $task = self::$tasks[$id];
            $task['title'] = $data['title'];
            $task['description'] = $data['description'];
            $task['status'] = $data['status'];
            $validationErrors = TaskValidation::validateTaskData($task);
            if (!empty($validationErrors)) {
                return new JsonResponse(['error' => 'Validation failed', 'errors' => $validationErrors], 400);
            }
            self::$tasks[$id] = $task;
            return new JsonResponse($task);
        } else {
            return new JsonResponse(['error' => 'Task not found'], 404);
        }
    }

    public function deleteTask(Request $request): JsonResponse
    {
        $data = $request->attributes->all();
        $id = $data['id'];
        if (isset(self::$tasks[$id])) {
            unset(self::$tasks[$id]);
            return new JsonResponse(status:204);
        } else {
            return  new JsonResponse(['error' => 'Task not found'], 404);
        }
    }

}
