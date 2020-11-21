<?php

    use yii\db\Migration;

    /**
     * Class m201120_163522_lang
     */
    class m201120_163522_lang extends Migration
    {

        private $table = '{{%lang%}}';


        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $tableOptions = null;
            if($this->db->driverName === 'mysql') {
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }

            $this->createTable(
                    $this->table, [
                        'id' => $this->primaryKey()->unsigned(),
                        'url' => $this->char(10)->unique(),
                        'local' => $this->char(255),
                        'name' => $this->char(255),
                        'default' => $this->smallInteger(1),
                        'date_update' => $this->integer()->null(),
                        'date_create' => $this->integer()->null(),
                    ], $tableOptions
            );

            $this->addCommentOnTable($this->table, 'Список языков мультиязычности');
            
            $this->createIndex('lang_default',$this->table, 'default');
            
            $this->insert($this->table, [                 
                        'url' => 'ru',
                        'local' => 'ru-RU',
                        'name' => 'Русский',
                        'default' => 1,
                        'date_update' => time(),
                        'date_create' => time(),
            ]);
            
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            echo "m201120_163522_lang cannot be reverted.\n";

            return false;
        }

        /*
          // Use up()/down() to run migration code without a transaction.
          public function up()
          {

          }

          public function down()
          {
          echo "m201120_163522_lang cannot be reverted.\n";

          return false;
          }
         */
    }
    