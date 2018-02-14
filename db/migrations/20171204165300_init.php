<?php

use Phinx\Migration\AbstractMigration;

class Init extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up()
    {
        $table = $this->table('users');
        $table
            ->addColumn('user_name', 'string')
            ->save();

        $table = $this->table('todo_list');
        $table
            ->addColumn('user_id', 'integer')
            ->addColumn('name', 'string', ['limit' => '40'])
            ->addForeignKey('user_id', 'users', 'id')
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('todo_list')->dropForeignKey('user_id')->save();
        $this->dropTable('todo_list');
        $this->dropTable('users');
    }

}
