<?php


namespace app\models;



class User extends Record
{
    public $login;
    public $pass;
    public $password_hash;
    public $session_hash;
    protected static array $hiddenProps = [
        'hiddenProps',
        'database',
        'id',
        'changed',
        'arrayOfColumns',
        'pass',
    ];

    public function __construct($id = null, $login = null, $pass = null)
    {
        parent::__construct($id);
        $this->login = $login;
        $this->pass = $pass;
    }
    public static function getTableName() :string
    {
        return 'users';
    }

    public function validation() :bool {
        return password_verify($this->pass, $this->password_hash);
    }

}