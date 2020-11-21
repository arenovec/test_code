<?php

    use yii\db\Migration;

    /**
     * Class m201121_083501_authors
     */
    class m201121_083501_authors extends Migration
    {

        protected $table = '{{%authors%}}';

        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable(
                    $this->table, [
                'id' => $this->primaryKey()->unsigned(),
                'name' => $this->char(255),
                'birthday' => $this->date(),
                'rating' => $this->smallInteger(),
                    ]
            );

            $this->createIndex('authors_rating', $this->table, 'rating');
            $this->createIndex('authors_birthday', $this->table, 'birthday');
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            echo "m201121_083501_authors cannot be reverted.\n";

            return false;
        }

        /*
          // Use up()/down() to run migration code without a transaction.
          public function up()
          {

          }

          public function down()
          {
          echo "m201121_083501_authors cannot be reverted.\n";

          return false;
          }
         */
    }
    