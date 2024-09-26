<?php

/** @var yii\web\View $this */
use yii\widgets\ActiveForm;
use yii\Helpers\Html;

$user = Yii::$app->user;


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
                echo HTML::hiddenInput("user_id",Yii::$app->user->getId());
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