<?php


namespace app\models;


abstract class Record
{
    protected ?int $id;

    protected static array $arrayOfColumns = [];
	protected array $cache = [];
	protected static array $hiddenProps = [
		'arrayOfColumns',
		'cache',
		'hiddenProps',
		'database',
		'id',
		'pass',
		'product',
		'orderTable',
	];

	abstract public static function getTableName() :string;

//	Автосоздание списков колонок, плейсхолдеров и значений
	protected function getArrayOfColumns(): array {
		//массив всех параметров объекта
		if (empty(static::$arrayOfColumns)) {
			foreach ($this as $key => $value) {
				if (!in_array($key,static::$hiddenProps)) {
					static::$arrayOfColumns[] = $key;
				}
			}
		}
		return static::$arrayOfColumns;
	}
	protected function getArrayOfFillers(): array {
		$fillers = $this->getArrayOfColumns();
		foreach ($fillers as &$column) {
			$column = ":{$column}";
		}
		return $fillers;
	}
	protected function getArrayOfValues(): array {
		$values = [];
		foreach ($this as $key => $value) {
			if (!in_array($key,static::$hiddenProps)) {
				$values[] = $value;
			}
		}
		return $values;
	}
	public function getArrayOfParams(): array {
		$fillers = $this->getArrayOfFillers();
		$values = $this->getArrayOfValues();
		return array_combine($fillers, $values);
	}
	public function getStringOfColumns(): string {
		$columns = $this->getArrayOfColumns();
		foreach ($columns as &$key) {
			$key = "`{$key}`";
		}
		return implode(', ',$columns);
	}
	public function getStringOfFillers(): string {
		$fillers = $this->getArrayOfFillers();
		return implode(', ',$fillers);
	}
	public function getStringOfParams(): string {
		$columns = $this->getArrayOfColumns();
		$fillers = $this->getArrayOfFillers();
		$result = array_map(function ($column, $filler) {
			return "`{$column}`={$filler}";
		},$columns,$fillers);
		return implode(', ',$result);
	}
	public function getArrayOfCacheParams(): array {
		$params = [];
		$keys = $this->getArrayOfColumns();
		foreach ($keys as $key) {
			if (
				array_key_exists($key,$this->cache) &&
				($this->$key != $this->cache[$key])
			) {
				$params[":{$key}"] = $this->$key;
			}
		}
		return $params;
	}
	public function getStringOfCacheParams(): string {
		$columns = $this->getArrayOfCacheParams();
		$result = [];
		foreach ($columns as $key => $column) {
			$result[] = str_replace('`:','`',"`{$key}` = {$key}");
		}
		return implode(', ',$result);
	}

    public function __construct($id = null)
    {
        $this->id = $id;
    }
    public function __get($name) {
        if (!in_array($name,static::$hiddenProps)) {
            return $this->$name;
        } else {
            return $this->$name;
        }
    }
    public function __set($name, $value) {
        if (!in_array($name,static::$hiddenProps)) {
            $this->cache[$name] = $this->$name;
        }
        $this->$name = $value;
    }
}