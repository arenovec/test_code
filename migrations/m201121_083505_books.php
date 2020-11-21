<?php

    use yii\db\Migration;

    /**
     * Class m201121_083453_books
     */
    class m201121_083505_books extends Migration
    {

        private $table = '{{%books%}}';

        /**
         * {@inheritdoc}
         */
        public function safeUp()
        {
            $this->createTable(
                    $this->table, [
                'id' => $this->primaryKey()->unsigned(),
                'author_id' => $this->integer()->unsigned(),
                'publishing' => $this->date(),
                'title' => $this->string(),
                'rating' => $this->smallInteger(),
                    ]
            );

            $this->createIndex('books_rating', $this->table, 'rating');
            $this->createIndex('books_publishing', $this->table, 'publishing');
            $this->addForeignKey('books_author_id', $this->table, 'author_id', 'authors', 'id');
        }

        /**
         * {@inheritdoc}
         */
        public function safeDown()
        {
            echo "m201121_083453_books cannot be reverted.\n";

            return false;
        }

        /*
          // Use up()/down() to run migration code without a transaction.
          public function up()
          {

          }

          public function down()
          {
          echo "m201121_083453_books cannot be reverted.\n";

          return false;
          }
         */
    }
    