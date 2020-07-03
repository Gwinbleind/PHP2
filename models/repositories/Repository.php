<?php


namespace app\models\repositories;


use app\interfaces\IRecord;
use app\interfaces\IRepository;
use app\models\Record;
use app\services\Db;

class Repository implements IRepository
{
	protected Db $db;
	protected string $recordClass;

	public function __construct(string $recordClass = Record::class)
	{
		$this->db = Db::getInstance();
		$this->db::getConnection();
		$this->recordClass = $recordClass;
	}

	protected function prepareCondition(string $condition = null) :string {
		if (!empty($condition)|$condition == 0) {
			return ' WHERE ' . $condition;
		} else {
			return '';
		}
	}

	protected function getObjectClass() :string {
		return $this->recordClass;
	}
	public function getTableName() :string {
		return $this->getObjectClass()::getTableName();
	}

	//CRUD
	protected function getCreateSqlString(Record $record)
	{
		/** @var Record $record */
//		var_dump($record);
		$sql = 'INSERT INTO `%s` (%s) VALUES (%s)';
		return sprintf(
			$sql,
			$this->getTableName(),
			$record->getStringOfColumns(),
			$record->getStringOfFillers()
		);
	}
	protected function getReadSqlString(string $condition = '1') {
		$condition = $this->prepareCondition($condition);
		$sql = "SELECT * FROM `%s`" . $condition;
		return sprintf($sql,$this->getTableName());
	}
	protected function getUpdateSqlString(string $condition = '0') {
		/** @var Record $record */
		$record = $this->getObjectClass();
		$condition = $this->prepareCondition($condition);
		$sql = "UPDATE `%s` SET %s" . $condition;
		return sprintf(
			$sql,
			$this->getTableName(),
			$record->getStringOfParams()
		);
	}
	protected function getSaveSqlString(Record $record, string $condition = '0') {
		$condition = $this->prepareCondition($condition);
		$sql = "UPDATE `%s` SET %s" . $condition;
		return sprintf(
			$sql,
			$this->getTableName(),
			$record->getStringOfCacheParams()
		);
	}
	protected function getDeleteSqlString(string $condition = '0') {
		$condition = $this->prepareCondition($condition);
		$sql = "DELETE FROM `%s`" . $condition;
		if (!empty($condition)) {
			return sprintf($sql, $this->getTableName());
		} else {
			return sprintf($sql, $this->getTableName()) . ' WHERE 0';
		}
	}
	//Create
	public function createRow(Record $record) {
		$sql = $this->getCreateSqlString($record);
		$res = $this->db->execute($sql,$record->getArrayOfParams());
		$record->id = $this->db->getLastId();
		return $res;
	}
	//Read
	public function getFullTable() :array {
		$sql = $this->getReadSqlString();
		return $this->db->queryArray($this->getObjectClass(),$sql);
	}
	public function getTableByProperty(string $name, string $value) :array {
		$condition = "`{$name}` = :{$name}";
		$sql = $this->getReadSqlString($condition);
		return $this->db->queryArray($this->getObjectClass(),$sql,[
			":{$name}"=>$value
		]);
	}
	public function getRowByProperty(string $name, string $value) :IRecord {
		$condition = "`{$name}` = :{$name}";
		$sql = $this->getReadSqlString($condition);
		return $this->db->queryOne($this->getObjectClass(),$sql, [
			":{$name}"=>$value
		]);
	}
	public function getRowByID(int $id) :IRecord {
		return $this->getRowByProperty('id',$id);
	}
	//Update
	public function saveRowByID(Record $record) {
		$arrayOfCacheParams = $record->getArrayOfCacheParams();
		if (!empty($arrayOfCacheParams)) {
			$arrayOfCacheParams = array_merge($arrayOfCacheParams, [':id'=>$record->id]);
			$condition = "`id` = :id";
			$sql = $this->getSaveSqlString($record, $condition);
			$record->cache = [];
			return $this->db->execute($sql,$arrayOfCacheParams);
		}
		return 0;
	}
	//Delete
	public function deleteRowById(Record $record) {
		$sql = $this->getDeleteSqlString("`id` = :id");
		return $this->db->execute($sql,[':id'=>$record->id]);
	}
}