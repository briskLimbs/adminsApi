<?php

class Addons {
	
	function __construct($database) {
		$this->database = $database;
		$this->table = 'addons';
		$this->defaultLimit = 2;
	}

	public function list($parameters = false) {
		if (is_array($parameters)) {
			foreach ($parameters as $column => $condition) {
				if (in_array($column, $this->KEYS)) {
					if (is_array($condition)) {
						if (isset($condition['2'])) { // support for between, in etc
							$this->database->where($column, array($condition['0'], $condition['1']), $condition['2']);
						} else {
							$this->database->where($column, $condition['0'], $condition['1']);
						}
					} else {
						$this->database->where($column, $condition);
					}
				}
			}
		}

		if (isset($parameters['keyword'])) {
			$keyword = str_replace(array('?'), '', $parameters['keyword']);
      $keyword = mysqli_real_escape_string($this->database->mysqli(), $keyword);
			$this->database->where("MATCH (name, description, author) AGAINST ('$keyword' in boolean mode)");
		}

		$limit = isset($parameters['limit']) ? $parameters['limit'] : $this->defaultLimit;
		$sort = isset($parameters['sort']) ? $parameters['sort'] : 'id';
		if ($sort) {
			if (is_array($sort)) {
				$this->database->orderBy($sort['0'], isset($sort['1']) ? $sort['1'] : 'DESC');
			} else {
				$this->database->orderBy($sort);
			}
		}
		
		return isset($parameters['count']) ? $this->database->getValue($this->table, 'count(*)') : $this->database->get($this->table, $limit);
	}
}