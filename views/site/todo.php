<?php

/** @var yii\web\View $this */
use yii\widgets\ActiveForm;
use yii\Helpers\Html;
use app\Models\User;

if(!Yii::$app->request->getMethod() == "GET"){
    die("redirect");
}else{
    $model = new User;
    $model->userId = Yii::$app->request->get()["id"];
}

?>

<main>

<h2>A Simple To-do List</h2>

    <section id="list-container">
        <div class="task-container">

           <?php 

               $form =  ActiveForm::begin([
                    "id"=>"task-form",
                    "action"=>"/task/add",
                    "options"=>[
                        "class"=>["form-class"]
                    ]
                    ]);

                echo $form->field($model,'detail');
                echo HTML::hiddenInput("user_id",$model->userId);
                echo HTML::submitButton('add',["class"=>"add-task-btn"]);
                ActiveForm::end();
            
                ?>
        <div id="current-tasks">
            <?php foreach($tasks as $key=>$task):?>
                <div class="task-entry">
                    <?=$task["detail"]?>
                    <?php

                        ActiveForm::begin([
                            "id"=>"delete-task",
                            "action"=>"/task/delete/?id={$task['id']}"
                        ]);

                        echo Html::submitButton("delete",["class"=>"task-done"]);

                        ActiveForm::end();
                    ?>
            </div>
            <?php endforeach;?>
        </div>
    </div>
    </section>

</main>