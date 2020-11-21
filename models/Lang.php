<?php

    namespace app\models;

    use Yii;

    /**
     * This is the model class for table "lang".
     *
     * @property integer $id
     * @property string $url
     * @property string $local
     * @property string $name
     * @property integer $default
     * @property integer $date_update
     * @property integer $date_create
     */
    class Lang extends \yii\db\ActiveRecord
    {

        //Переменная, для хранения текущего объекта языка
        static $current = null;

        public function behaviors()
        {
            return [
                'timestamp' => [
                    'class' => 'yii\behaviors\TimestampBehavior',
                    'attributes' => [
                        \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                        \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                    ],
                ],
            ];
        }

        //Получение текущего объекта языка
        static function getCurrent()
        {
            if(self::$current === null) {
                self::$current = self::getDefaultLang();
            }
            return self::$current;
        }

        //Установка текущего объекта языка и локаль пользователя
        static function setCurrent($url)
        {
            $language = self::getLangByUrl($url);
            self::$current = ($language == "") ? self::getDefaultLang() : $language;
            Yii::$app->language = self::$current->local;
        }

        //Получения объекта языка по умолчанию
        static function getDefaultLang()
        {
            // CACHING
            $language = \Yii::$app->cache->getOrSet(__METHOD__ . "()", function ()
            {
                return Lang::find()->where('`default` = :default', [':default' => 1])->one();
            }, 3600 * 24 * 30);

            return $language;
        }

        //Получения объекта языка по буквенному идентификатору
        static function getLangByUrl($url)
        {

            if($url == "" and strlen($url) > 3) {
                self::getDefaultLang();
            } else {
                // CACHING
                $language = \Yii::$app->cache->getOrSet(__METHOD__ . "($url)", function () use ($url)
                {
                    return Lang::find()->where('url = :url', [':url' => $url])->one();
                }, 3600 * 24 * 30);
            }

            return ($language) ?? null;
        }

        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return 'lang';
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['url', 'local', 'name', 'date_update', 'date_create'], 'required'],
                [['default', 'date_update', 'date_create'], 'integer'],
                [['url', 'local', 'name'], 'string', 'max' => 255],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id' => 'ID',
                'url' => 'Url',
                'local' => 'Local',
                'name' => 'Name',
                'default' => 'Default',
                'date_update' => 'Date Update',
                'date_create' => 'Date Create',
            ];
        }

    }
    