<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Members Model
 *
 * @property \Cake\ORM\Association\HasMany $Bonds
 * @property \Cake\ORM\Association\HasMany $Devices
 * @property \Cake\ORM\Association\HasMany $Earnings
 * @property \Cake\ORM\Association\HasMany $Logs
 * @property \Cake\ORM\Association\HasMany $Messages
 * @property \Cake\ORM\Association\HasMany $Workouts
 *
 * @method \App\Model\Entity\Member get($primaryKey, $options = [])
 * @method \App\Model\Entity\Member newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Member[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Member|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Member patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Member[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Member findOrCreate($search, callable $callback = null, $options = [])
 */
class MembersTable extends Table
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

        $this->table('members');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Bonds', [
            'foreignKey' => 'member_id'
        ]);
        $this->hasMany('Devices', [
            'foreignKey' => 'member_id'
        ]);
        $this->hasMany('Earnings', [
            'foreignKey' => 'member_id'
        ]);
        $this->hasMany('Logs', [
            'foreignKey' => 'member_id'
        ]);
        $this->hasMany('Messages', [
            'foreignKey' => 'member_id'
        ]);
        $this->hasMany('Workouts', [
            'foreignKey' => 'member_id'
        ]);
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
            ->uuid('id')
            ->allowEmpty('id', 'create');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password');

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

    public function checkUser($email, $pass)
    {
        $var =  $this->find()->where(['email' => $email])->first();

        
        if(password_verify($pass, $var['password'])){
            return $var['id'];
        }
        else {
            return null;
        }
        
    }

     public function checkUserInscription($email, $pass)
    {
        $var =  $this->find()->where(['email' => $email])->first();
        if($var == null)
        {
           //if($pass == $pass2){
                
                return 1;
            //}
            /*else {
                return 0;
            /}*/
        }
        else 
        {
            return null;
        }
    }

    public function userInfo($uid)
    {
        if($var =  $this->find('all')->where(['id' => $uid])->first())
        {
            return $var;
        }
        else {
            return null;
        }

    }
    public function changerMdp($email)
    {
        if($var =  $this->find('all')->where(['email' => $email])->first())
        {
            $var->password="pass";
            if($this->save($var))
            {
                return $var->password;
            }
            else
            {
                return null;
            }
        }
        else
        {
            return null;
        }
    }
}
?>