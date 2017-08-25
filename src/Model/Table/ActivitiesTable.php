<?php
namespace App\Model\Table;

use Cake\ORM\Table;


class ActivitiesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('activity');
        $this->setPrimaryKey('id');

    }


}
