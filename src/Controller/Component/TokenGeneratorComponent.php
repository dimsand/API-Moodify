<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class TokenGeneratorComponent extends Component
{

    /**
     * Create a token with data and return the id
     * @param  [type] $expire  expire exprimed in '+6 days +2 hours' format
     * @return string          The token id
     */
    public function generate($user_id, $expire = null)
    {
        return TableRegistry::get('Users')->newToken($user_id, $expire);
    }

    /**
     * read token from id
     * @param  string $id   token string id
     * @return Token        entity
     */
    public function read($token_id)
    {
        return TableRegistry::get('Users')->read($token_id);
    }
}
