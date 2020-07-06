<?php

namespace app\interfaces;

interface IRecord
{
	public static function getTableName(): string;

	public function getArrayOfColumns(): array;
	public function getArrayOfParams(): array;
	public function getStringOfColumns(): string;
	public function getStringOfFillers(): string;
	public function getStringOfParams(): string;
	public function getArrayOfCacheParams(): array;
	public function getStringOfCacheParams(): string;

	public function __get($name);
	public function __set($name, $value);
}