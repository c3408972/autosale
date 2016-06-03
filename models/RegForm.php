<?php


namespace app\models;
use yii\base\Model;
use Yii;
class RegForm extends Model
{
    public $email;
    public $password;
    public $status;
    public $passwordRepeat;

    public function rules()
    {
        return [
            [['email', 'password', 'passwordRepeat'],'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => 'Введите почту'],
            ['password', 'required', 'message' => 'Введите пароль'],
            ['passwordRepeat', 'required', 'message' => 'Введите повтор пароля'],
            ['password', 'string', 'min' => 6, 'max' => 255, 'tooShort' => 'Введите пароль от 6 до 255 символов'],
            ['email', 'email', 'message' => 'Введите корректно почту'],
            ['email', 'unique',
                'targetClass' => User::className(),
                'message' => 'Эта почта уже занята.'],
            ['status', 'default', 'value' => User::STATUS_ACTIVE, 'on' => 'default'],
            ['status', 'in', 'range' =>[
                User::STATUS_NOT_ACTIVE,
                User::STATUS_ACTIVE
                ]],
            ['passwordRepeat', 'compare','compareAttribute'=>'password','operator'=>'==','message'=>'Пароли не совпадают'],
        ];
    }
    public function attributeLabels()
    {
        return [
            'email' => 'Эл. почта',
            'password' => 'Пароль'
        ];
    }
    public function reg()
    {
        $user = new User();
        $user->email = $this->email;
        $user->status = $this->status;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}