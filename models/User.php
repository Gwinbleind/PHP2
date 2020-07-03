<?php


namespace app\models;



use app\interfaces\IRecord;

class User extends Record implements IRecord
{
    protected string $login;
    protected string $pass;
    protected ?string $password_hash;
    protected string $session_hash;

    public function __construct(string $login = '', string $pass = '', $id = null)
    {
        parent::__construct($id);
        $this->login = $login;
        $this->pass = $pass;
    }

    public function validation() :bool {
        return password_verify($this->pass, $this->password_hash);
    }

	public static function getTableName(): string
	{
		return 'users';
	}
}