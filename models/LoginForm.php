<?php
/**
 * Created by PhpStorm.
 * User: phpNT
 * Date: 02.05.2015
 * Time: 18:16
 */
namespace app\models;
use yii\base\Model;
use Yii;
class LoginForm extends Model
{
    public $password;
    public $email;
    public $status;
    private $_user = false;

    public function rules()
    {
        return [
            ['email', 'required', 'message' => 'Введите e-mail'],
            ['password', 'required', 'message' => 'Введите пароль'],
            ['email', 'email', 'message' => 'Введите корректно e-mail'],
            ['password', 'validatePassword']
        ];
    }
    public function validatePassword($attribute)
    {
        if (!$this->hasErrors()):
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)):
                $this->addError($attribute, 'Неверный e-mail или пароль.');
            endif;
        endif;
    }
    public function getUser()
    {
        if ($this->_user === false):
            $this->_user = User::findByEmail($this->email);
        endif;
        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Емайл',
            'password' => 'Пароль',
        ];
    }
    public function login()
    {
        if ($this->validate()){
            $this->status = ($user = $this->getUser()) ? $user->status : User::STATUS_NOT_ACTIVE;
            if ($this->status === User::STATUS_ACTIVE){
                return Yii::$app->user->login($user, 3600*24*30);
            }
            else if($this->status === User::STATUS_NOT_ACTIVE){
                $this->addError('password', 'Аккаунт заблокирован');
                return false;
            }else
            {
                $this->addError('password', 'Аккаунт удален');
                return false;
            }
        }
        else{
            return false;
        }
    }
}