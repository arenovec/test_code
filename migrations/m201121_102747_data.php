<?php

    use yii\db\Migration;

    /**
     * Class m201121_102747_data
     */
    class m201121_102747_data extends Migration
    {

        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {

            //Добавление данных в базу, не стал расписывать по таблицам, т.к. это данные для теста
            $this->execute("
            INSERT INTO `authors` (`id`, `name`, `birthday`, `rating`) VALUES (1, 'Саша Пушкин', '2014-02-20', 8);
            INSERT INTO `authors` (`id`, `name`, `birthday`, `rating`) VALUES (2, 'Саша Блок', '2020-11-10', 5);
            INSERT INTO `books` (`id`, `author_id`, `publishing`, `title`, `rating`) VALUES (1, 1, '2020-11-10', 'Онегин', 4);
            INSERT INTO `books` (`id`, `author_id`, `publishing`, `title`, `rating`) VALUES (2, 1, '2020-10-10', 'Онегин2', 6);
            INSERT INTO `books` (`id`, `author_id`, `publishing`, `title`, `rating`) VALUES (3, 2, '2010-11-21', 'Скифы', 8);
            INSERT INTO `books` (`id`, `author_id`, `publishing`, `title`, `rating`) VALUES (4, 2, '2010-07-21', 'Скифы2', 3);
            ");
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            echo "m201121_102747_data cannot be reverted.\n";

            return false;
        }

        /*
          // Use up()/down() to run migration code without a transaction.
          public function up()
          {

          }

          public function down()
          {
          echo "m201121_102747_data cannot be reverted.\n";

          return false;
          }
         */
    }
    