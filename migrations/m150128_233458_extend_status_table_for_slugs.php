<?php

use yii\db\Schema;
use yii\db\Migration;

class m150128_233458_extend_status_table_for_slugs extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }
    $this->addColumn('{{%status}}','slug',Schema::TYPE_STRING.' NOT NULL');
  }

  public function down()
  {
    $this->dropColumn('{{%status}}','slug');
  }
}
