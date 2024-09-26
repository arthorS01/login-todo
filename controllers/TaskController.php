<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;
use app\Models\Task;


class TaskController extends Controller{

    /**
     * #returns HTML view
     */

    public function actionIndex()
    {
        //get all the current tasks from the database
        $model = new Task;
        $db = Yii::$app->db;

        $tasks = $db->createCommand("SELECT * FROM tasks")->queryAll();

        return $this->render("index",["model"=>$model,"tasks"=>$tasks]);
    }

    public function actionAdd()
    {
        $model = new Task;       

        $data = Yii::$app->request->post();

        $model->detail = $data["Task"]["detail"];

        if($model->validate()){
           

            $db = Yii::$app->db;

            $db->createCommand("INSERT INTO tasks(detail) VALUES(:detail) ",[
                ":detail"=>$model->detail
            ])->execute();

            return $this->redirect("http://localhost:8080/task");
        }else{
            die("error");
        }    
    
    }

    public function actionDelete($id)
    {
        $model = new Task;

        $data = Yii::$app->request->post();

        $db = Yii::$app->db;

        $db->createCommand("DELETE FROM tasks WHERE id = :id",[
            ":id"=>$id
        ])->execute();

        return $this->redirect("http://localhost:8080/task");


    }
}