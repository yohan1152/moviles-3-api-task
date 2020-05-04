<?php
require '../src/Config/db.php';

class Task{

    public function list(){

        $sql = "SELECT*FROM tasks";

        try{
           
            $db = new db();
            $db = $db->conectionDB();
            $resultado = $db->query($sql);
            if($resultado->rowCount() > 0){
                $tasks = $resultado->fetchAll(PDO::FETCH_OBJ);
                http_response_code(200); 
                echo json_encode(array("tasks"=>$tasks));
            }else{
                http_response_code(204);
                echo json_encode(array("response"=>"No tasks registered"));
            }
            $resultado = null;
            $db = null;
        }catch(PDOException $e){
            echo json_encode(array("error"=>$e.getMessage()));
        }
    }

    public function getId($id){
        
        $sql = "SELECT*FROM tasks WHERE id = $id";

        try{
           
            $db = new db();
            $db = $db->conectionDB();
            $resultado = $db->query($sql);
            if($resultado->rowCount() > 0){
                $tasks = $resultado->fetchAll(PDO::FETCH_OBJ); 
                http_response_code(200);
                echo json_encode(array("task"=>$tasks));
            }else{
                http_response_code(204);
                echo json_encode(array("response"=>"The task could not be found"));
            }
            $resultado = null;
            $db = null;
        }catch(PDOException $e){
            echo json_encode(array("error"=>$e.getMessage()));
        }
    }

    public function add($task, $date){
        
        $sql = "INSERT INTO tasks (task, date) VALUES (:task, :date)";

        try{
           
            $db = new db();
            $db = $db->conectionDB();
            $resultado = $db->prepare($sql);

            $resultado->bindParam(':task',$task);
            $resultado->bindParam(':date',$date);

            if($resultado->execute() == true && $resultado->rowCount() > 0){
                http_response_code(200);
                echo json_encode(array("response"=>"Task added successfully"));
            }else{
                http_response_code(400);
                echo json_encode(array("response"=>"The task could not be added"));
            }

            $resultado = null;
            $db = null;
        }catch(PDOException $e){
            echo json_encode(array("error"=>$e.getMessage()));
        }
    }

    public function update($id, $task, $date){
        
        $sql = "UPDATE tasks SET task = :task, date = :date WHERE id = :id";

        try{
           
            $db = new db();
            $db = $db->conectionDB();
            $resultado = $db->prepare($sql);

            $resultado->bindParam(':id',$id);
            $resultado->bindParam(':task',$task);
            $resultado->bindParam(':date',$date);

            if($resultado->execute() == true && $resultado->rowCount() > 0){
                http_response_code(200);
                echo json_encode(array("response"=>"Task updated successfully"));
            }else{
                http_response_code(404);
                echo json_encode(array("response"=>"The task could not be updated"));
            }
            
            $resultado = null;
            $db = null;
        }catch(PDOException $e){
            echo json_encode(array("error"=>$e.getMessage()));
        }
    }

    public function delete($id){
        
        $sql = "DELETE FROM tasks WHERE id = :id";

        try{
           
            $db = new db();
            $db = $db->conectionDB();
            $resultado = $db->prepare($sql);

            $resultado->bindParam(':id',$id);

            if($resultado->execute() == true && $resultado->rowCount() > 0){
                http_response_code(200);
                echo json_encode(array("response"=>"Task deleted successfully"));
            }else{
                http_response_code(404);
                echo json_encode(array("response"=>"The task could not be deleted"));
            }
            
            $resultado = null;
            $db = null;
        }catch(PDOException $e){
            echo json_encode(array("error"=>$e.getMessage()));
        }
    }
}