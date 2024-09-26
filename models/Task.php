<?php


namespace app\Models;

use yii\base\Model;


class Task extends Model{

    
    public $detail;
    public $status;

    
    public function __construct(){
        $this->detail = null;
    }

    public static function tableName(){
        return "tasks";
    }

    public function rules()
    {
        return[
            ["detail","required"]
        ];
    }
  
   
}