<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArticlesTable extends Table {
    
    public function validationDefault(Validator $validator) {
        $validator
                ->allowEmpty('title', false)
                ->allowEmpty('body', false);
        
        return $validator;
    }
    
}