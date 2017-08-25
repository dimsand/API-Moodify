<?php
namespace App\Model\Table;

use Cake\Chronos\Chronos;
use Cake\ORM\Table;
use Cake\Utility\Text;

class TokensTable extends Table
{
    /**
     * {@inheritDoc}
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setTable('api_user_tokens');
        $this->setPrimaryKey('id');
        $this->setDisplayField('type');

        $this->addBehavior('Timestamp');
    }

    /**
     * get token by id
     * @param  string $id   token id
     * @return bool|Token   false or token entity
     */

}
