<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Chronos\Chronos;
use Cake\Utility\Text;

/**
 * Users Model
 *
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('firstname');

        $validator
            ->allowEmpty('lastname');

        $validator
            ->allowEmpty('password');

        $validator
            ->allowEmpty('link');

        $validator
            ->allowEmpty('avatar');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// TOKENS GENERATOR

    public function read($token_id)
    {
        // clean expired tokens first
        $this->_cleanExpired();

        // clean id
        $token_id = preg_replace('/^([a-f0-9]{32}).*/', '$1', $token_id);

        // Get token for this id
        return $this->find('all')
            ->where(['token_expire > NOW()', 'token_id' => $token_id])
            ->first();
    }

    /**
     * create token with option
     * @param  null|date    $expire  expire date or null
     * @return string                token id
     */
    public function newToken($user_id, $expire = null)
    {
        if(is_null($user_id)){
            return false;
        }

        $entity = $this->get($user_id);
        $entity->token_id = $this->uniqId();
        $entity->token_expire = is_null($expire) ? Chronos::now() : Chronos::parse($expire);
        $this->save($entity);

        return $entity->token_id;
    }

    /**
     * generate uniq token id
     * @return string
     */
    protected function uniqId()
    {
        $exists = true;

        while ($exists) {
            $key = $this->generateKey();
            $exists = $this->find()->where(['token_id' => $key])->first();
        }

        return $key;
    }

    /**
     * generate random key
     * @return string  32 chars key
     */
    protected function generateKey()
    {
        return substr(hash('sha256', Text::uuid()), 0, 32);
    }

    /**
     * clean expired tokens
     * @return void
     */
    protected function _cleanExpired()
    {
        $this->deleteAll(['token_expire <' => \Cake\I18n\FrozenTime::parse('-7 days')]);
    }


}
