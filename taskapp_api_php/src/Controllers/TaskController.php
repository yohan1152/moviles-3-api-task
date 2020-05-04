<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../src/Services/Task.php';

$app = new \Slim\App;

//Método GET para listar todas las tareas
$app->get('/api/listtasks', function (Request $request, Response $response) {
    $Task = new Task();
    return $res = $Task->list();
});

//Método GET para buscar tareas por ID
$app->get('/api/gettask/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $Task = new Task();
    return $res = $Task->getId($id);
});

//Método POST para añadir nuevas tareas
$app->post('/api/addtask', function (Request $request, Response $response) {
    $task = $request->getParam('task');
    $date = $request->getParam('date');
    
    $Task = new Task();
    return $res = $Task->add($task,$date);
});

//Método POST (PUT) para actualizar una tareas
$app->post('/api/updatetask', function (Request $request, Response $response) {
    $id = $request->getParam('id');
    $task = $request->getParam('task');
    $date = $request->getParam('date');
    
    $Task = new Task();
    return $res = $Task->update($id,$task,$date);
});

//Método POST (DELETE) para eliminar una tareas
$app->post('/api/deletetask', function (Request $request, Response $response) {
    $id = $request->getParam('id');
    
    $Task = new Task();
    return $res = $Task->delete($id);
});
