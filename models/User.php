<?php

namespace app\models;
use Yii;
class User extends \yii\base\Model implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $email;
    public $authKey;
    public $accessToken;
    public $rememberMe;

    public static function tableName(){
        return "user";
    }
  
    public function rules()
    {
      return [
        [["username","email"],"required"],
        ["username","email"]
      ];
    }

    // private static $users = [
    //     '100' => [
    //         'id' => '100',
    //         'username' => 'admin',
    //         'password' => 'admin',
    //         'authKey' => 'test100key',
    //         'accessToken' => '100-token',
    //     ],
    //     '101' => [
    //         'id' => '101',
    //         'username' => 'demo',
    //         'password' => 'demo',
    //         'authKey' => 'test101key',
    //         'accessToken' => '101-token',
    //     ],
    // ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $db = Yii::$app->db;

        $data = $db->createCommand("SELECT * FROM user where username = :username",[
            ":username"=>$username
        ])->queryAll();

        if(empty($data)){
            $data = null;
        }
        
        var_dump($data);
        exit;
        
        $user = new self;

        $user->id = $data[0]["id"];
        $user->username = $data[0]["username"];
        $user->email = $data[0]["email"];

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function getUsername(){
        return $this->username;
    }
}
