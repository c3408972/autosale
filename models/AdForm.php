<?php
namespace app\models;

use yii\base\ErrorException;
use yii\base\Model;
use Yii;
use yii\db\ActiveRecord;

class AdForm extends model
{
    public $Region;
    public $City;
    public $Mark;
    public $Model;
    public $EngineCapacity;
    public $NumberHosts;
    public $Mileage;
    public $Images;


    // Метод настройки правил валидации
    public function rules()
    {
        return [
            [['Region', 'City', 'Model', 'EngineCapacity', 'NumberHosts', 'Mileage', 'Images'], 'required', 'message' => 'Выберите {attribute}'],
            ['Mark', 'required', 'message' => 'Выберите марку'],
            [['Images'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 10 ]
        ];
    }

    // Прописываем лейблы для полей
    public function attributeLabels()
    {
        return [
            'Region' => 'Область',
            'City' => 'Город',
            'Mark' => 'Марка',
            'Model' => 'Модель',
            'EngineCapacity' => 'Мощность двигателя',
            'NumberHosts' => 'Количество владельцев',
            'Mileage' => 'Пробег',
            'Images' => 'Изображения',
        ];
    }

    // Метод загрузки данных для вывода в фильтр и для формы добавления, а вообще можно юзать по усмотрению.
    public function LoadData()
    {
        // Вносим все данные в текущую модель
        $this->Region = Region::find()->orderBy('Name')->all();
        $this->Mark = Mark::find()->orderBy('Name')->all();
        $this->EngineCapacity = EngineCapacity::find()->orderBy('Value')->all();
        $this->NumberHosts = NumberHosts::find()->orderBy('Value')->all();
        $this->Mileage = Mileage::find()->orderBy('Value')->all();
    }

    // Возвращаем информацию о превышении лимита
    public function LimitIsExceeded()
    {
        $userData = User::findOne(Yii::$app->user->id);
        $dataAd = Ad::findAll(['IdUser' => Yii::$app->user->id]);

        return Count($dataAd) <= $userData['limitation'] ? true : $userData['limitation'];
    }

    // Метод добавления обьявления
    public function AddData()
    {
        if ($this->validate()) {    // Валидируем данные
            $arrSaveImages = $this->upload();   // Сохраняем картинки и получаем данные о местоположении
            $ad = new Ad();

            $transaction = Ad::getDb()->beginTransaction(); // Открываем транзакцию в модели обьявления
            try {

                // Вносим данные
                $ad->City = $this->City;
                $ad->Model = $this->Model;
                $ad->EngineCapacity = $this->EngineCapacity;
                $ad->NumberHosts = $this->NumberHosts;
                $ad->Mileage = $this->Mileage;
                $ad->DateTime = date("Y-m-d H:i:s");
                $ad->IdUser = Yii::$app->user->id;

                if($ad->save()) // Сохраняем, если строка была добавлена, то добавляем и картинки
                {
                    foreach($this->Images as $file) // Проходимся по всем картинкам
                    {
                        $images = new Images();
                        $images->Url = $arrSaveImages["InsertBD"][$file->baseName]; // Вносим урл
                        $images->IdAd = $ad->Id;    // Айди обьявления
                        if(!$images->save())    // Сохраняем данные
                            throw new ErrorException("Ошибка добавления картинки"); // Если хотя бы одна картинка не добавлилась, создаем исключение
                    }
                }else throw new ErrorException("Ошибка добавления обьявления"); // Если обьявление не добавлось то выводим искючение

                $transaction->commit(); // Выполяем все операции
            } catch (Exception $e) {    // Ловам исключения класса Exception
                $this->rollBackUpload($arrSaveImages);  // Делаем откат картинок которые сохраняли (удаляем их)
                $transaction->rollback();   // Откат всех действий которые внесли в БД
                return false;   // возваращаеи ложь, если что-то пошло не так
            }catch (ErrorException $e)  // Ловам исключения класса ErrorException
            {
                $this->rollBackUpload($arrSaveImages);  // Делаем откат картинок которые сохраняли (удаляем их)
                $transaction->rollback(); // Откат всех действий которые внесли в БД
                return false;   // возваращаеи ложь, если что-то пошло не так
            }
            return true;    // возваращаеи правду, если всё прошло хорошо
        } else false;   // возваращаеи ложь, если что-то пошло не так
    }

    // Метод отката картинок, получаем на вход массив данных о местоположении
    private function rollBackUpload($arrSaveImages)
    {
        foreach ($this->Images as $file) {  // Прокручиваем все пути
            unlink($arrSaveImages["unlinkImg"][$file->baseName]);   // Удаляем картинки
        }
    }

    // Метод сохранения картинок
    private function upload()
    {
        $arrSaveImages = [];    // Создаем массив для хранения данных о местоположении
        foreach ($this->Images as $file) {  // Прокручиваем полученый картинки
            $ImgUnique = uniqid(time());    // Создаем уникальное имя на основании времени
            $pathImg = Yii::getAlias('@webroot/uploads/' . $ImgUnique . '.' . $file->extension);    // Получаем путь сохранения
            $arrSaveImages["unlinkImg"][$file->baseName] = $pathImg;    // Вносим в массив путь удаления картинки
            $arrSaveImages["InsertBD"][$file->baseName] = $ImgUnique . '.' . $file->extension;  // Вносим название картинки для базы, так как путей не должно быть в базе.
            $file->saveAs($pathImg);    // Сохраняем картинки
        }
        return $arrSaveImages;
    }

    // Получаем Город
    public function GetCity()
    {
        return City::find()->select(['Id', 'Name'])->where(['IdRegion' => $this->Region])->orderBy('Name')->all();
    }

    // Получаем Модель
    public function GetModel()
    {
        return \app\models\Model::find()->select(['Id', 'Name'])->where(['IdMark' => $this->Mark])->orderBy('Name')->all();
    }


}