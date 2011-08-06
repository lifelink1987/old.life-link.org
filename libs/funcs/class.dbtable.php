<?php

require_once 'class.extendedclass.php';
require_once 'class.db.php';

/**
 * Implements DbTable class
 *
 * This class enhances database work
 *
 * @author	Andrei Neculau <andrei.neculau@gmail.com>, http://www.andreineculau.com
 * @version	0.1.$LastChangedRevision
 * @date	$LastChangedDate
 */

class DbTable extends ExtendedClass {

	protected $_db;

	protected $_table;

	protected $_view;

	protected $_quoted_fields;

	protected $_debug = FALSE;

	/**
	 * Instance
	 * @var array
	 */
	protected static $_instance;

	public function __construct($db, $table_info, $debug = FALSE) {
		$this->_db = $db;
		@list ($this->_table, $this->_view, $this->_id) = (array) $table_info;
		if (! $this->_view) {
			$this->_view = $this->_table;
		}
		$this->_debug = $debug;
		$this->_get_quoted_fields();
		
		if (! isset(self::$_instance)) {
			self::$_instance = array();
		}
		self::$_instance[get_called_class()] = $this;
	}

	/**
	 * Return a reference to this instantiation, if available
	 * @return object
	 */
	public static function get_instance() {
		$class = get_called_class();
		if (! isset(self::$_instance)) {
			self::$_instance = array();
		}
		if (! isset(self::$_instance[$class])) {
			return FALSE;
		}
		return self::$_instance[$class];
	}

	/**
	 * Prevent cloning of this object
	 */
	final private function __clone() {
	}

	public function id($where) {
		$record = $this->get($where);
		
		if ($record) {
			return $record[$this->_id];
		}
		
		return FALSE;
	}

	public function clean_results($items) {
		return $items;
	}

	public function get($where, $orderby = NULL) {
		//If an id was passed an argument, change it to a WHERE condition
		if (is_numeric($where)) {
			$where = array(
				$this->_id => $where
			);
		}
		
		//Build up condition part of query based on available data content
		$cond = '';
		$where = (array) $where;
		if (count($where)) {
			foreach ($where as $cond_column => $cond_value) {
				if (is_numeric($cond_column)) {
					$cond .= " AND $cond_value";
				} else {
					$cond_value = $this->_db->real_escape_string($cond_value);
					if (in_array($cond_column, $this->_quoted_fields)) {
						$cond .= " AND `$cond_column` = '$cond_value'";
					} else {
						$cond .= " AND `$cond_column` = $cond_value";
					}
				}
			}
		}
		
		//Build ORDER BY
		if ($orderby) {
			$orderby = "ORDER BY $orderby";
		}
		
		$from = '`' . $this->_view . '`';
		$from = $this->_db->schema_prefix ? $this->_db->schema_prefix . $from : $from;
		
		//Build up complete sql query
		$sql = "
			SELECT *
			FROM $from
			WHERE 1=1$cond
			$orderby
			LIMIT 0,1
		";
		
		//Execute query
		$items = $this->_db->query_all($sql);
		
		//Handle results
		if ($items !== FALSE) {
			if ($items) {
				$items = $this->clean_results($items);
				return @array_shift($items);
			} else {
				return $items;
			}
		} else {
			return FALSE;
		}
	}

	public function gets($where = array(), $orderby = NULL, $limit = NULL) {
		//Build WHERE conditions
		$cond = '';
		$where = (array) $where;
		if (count($where)) {
			foreach ($where as $cond_column => $cond_value) {
				if (is_numeric($cond_column)) {
					$cond .= " AND $cond_value";
				} else {
					$cond_value = $this->_db->real_escape_string($cond_value);
					if (in_array($cond_column, $this->_quoted_fields)) {
						$cond .= " AND `$cond_column` = '$cond_value'";
					} else {
						$cond .= " AND `$cond_column` = $cond_value";
					}
				}
			}
		}
		
		//Build ORDER BY
		if ($orderby) {
			$orderby = "ORDER BY $orderby";
		}
		
		//Build LIMIT
		if ($limit) {
			if (is_numeric($limit)) {
				$limit = "0, $limit";
			}
			$limit = "LIMIT $limit";
		}
		
		$from = '`' . $this->_view . '`';
		$from = $this->_db->schema_prefix ? $this->_db->schema_prefix . $from : $from;
		
		//Build complete SQL query
		$sql = "
			SELECT *
			FROM $from
			WHERE 1=1$cond
			$orderby
			$limit
		";
		
		//Execute query
		$items = $this->_db->query_all($sql);
		
		//Handle results
		if ($items !== FALSE && $items) {
			$items = $this->clean_results($items);
		}
		return $items;
	}

	public function add($data, $or_update = TRUE) {
		if (! $data) {
			return;
		}
		
		//Build up set part of query based on available data content
		$data = (array) $data;
		$col = array();
		$val = array();
		$upd = array();
		foreach ($data as $set_column => $set_value) {
			$set_value = $this->_db->real_escape_string($set_value);
			if (in_array($set_column, $this->_quoted_fields)) {
				$set_value = "'$set_value'";
			}
			$col[] = "`$set_column`";
			$val[] = $set_value;
			$upd[] = "$set_column = $set_value";
		}
		$col = implode(', ', $col);
		$val = implode(', ', $val);
		
		$from = '`' . $this->_table . '`';
		$from = $this->_db->schema_prefix ? $this->_db->schema_prefix . $from : $from;
		
		if ($or_update !== FALSE) {
			if (is_array($or_update)) {
				$upd = array();
				foreach ($or_update as $set_column => $set_value) {
					if (is_numeric($set_column)) {
						$upd[] = "$set_value";
					} else {
						$set_value = $this->_db->real_escape_string($set_value);
						if (in_array($set_column, $this->_quoted_fields)) {
							$upd[] = "`$set_column` = '$set_value'";
						} else {
							$upd[] = "`$set_column` = $set_value";
						}
					}
				}
			}
			
			$upd[] = "`{$this->_id}` = LAST_INSERT_ID(`{$this->_id}`)";
			$upd = 'ON DUPLICATE KEY UPDATE ' . implode(', ', $upd);
		}
		
		//Build up complete sql query
		$sql = "
			INSERT INTO $from
			($col)
			VALUES ($val)
			$upd
		";
		
		//Execute query
		$this->_db->execute($sql);
		
		$this->last_insert_id = $this->_db->last_insert_id();
	}

	public function set($where, $data) {
		if (! $data) {
			return;
		}
		
		//If an id was passed an argument, change it to a WHERE condition
		if (is_numeric($where)) {
			$where = array(
				$this->_id => $where
			);
		}
		
		//Build up condition part of query based on available data content
		$cond = '';
		$where = (array) $where;
		if (count($where)) {
			foreach ($where as $cond_column => $cond_value) {
				if (is_numeric($cond_column)) {
					$cond .= " AND $cond_value";
				} else {
					$cond_value = $this->_db->real_escape_string($cond_value);
					if (in_array($cond_column, $this->_quoted_fields)) {
						$cond .= " AND `$cond_column` = '$cond_value'";
					} else {
						$cond .= " AND `$cond_column` = $cond_value";
					}
				}
			}
		}
		
		//Build up set part of query based on available data content
		$data = (array) $data;
		foreach ($data as $set_column => $set_value) {
			if (is_numeric($set_column)) {
				$set[] = $set_value;
			} else {
				$set_value = $this->_db->real_escape_string($set_value);
				if (in_array($set_column, $this->_quoted_fields)) {
					$set[] = "`$set_column` = '$set_value'";
				} else {
					$set[] = "`$set_column` = $set_value";
				}
			}
		}
		$set = implode(', ', $set);
		
		$from = '`' . $this->_table . '`';
		$from = $this->_db->schema_prefix ? $this->_db->schema_prefix . $from : $from;
		
		//Build up complete sql query
		$sql = "
			UPDATE $from
			SET $set
			WHERE 1=1$cond
		";
		
		//Execute query
		$this->_db->execute($sql);
	}

	public function delete($where, $limit = NULL) {
		if (! $where) {
			return;
		}
		
		//If an id was passed an argument, change it to a WHERE condition
		if (is_numeric($where)) {
			$where = array(
				$this->_id => $where
			);
		}
		
		//Build up condition part of query based on available data content
		$cond = '';
		$where = (array) $where;
		if (count($where)) {
			foreach ($where as $cond_column => $cond_value) {
				if (is_numeric($cond_column)) {
					$cond .= " AND $cond_value";
				} else {
					$cond_value = $this->_db->real_escape_string($cond_value);
					if (in_array($cond_column, $this->_quoted_fields)) {
						$cond .= " AND `$cond_column` = '$cond_value'";
					} else {
						$cond .= " AND `$cond_column` = $cond_value";
					}
				}
			}
		}
		
		$from = '`' . $this->_table . '`';
		$from = $this->_db->schema_prefix ? $this->_db->schema_prefix . $from : $from;
		
		//Build up complete sql query
		$sql = "
			DELETE FROM $from
			WHERE 1=1$cond
			$limit
		";
		
		//Execute query
		$this->_db->execute($sql);
	}

	public function tagged($tags, $min_tags = 1, $where = NULL, $orderby = NULL, $limit = NULL) {
		if (! $tags) {
			return;
		}
		
		$tags = is_string($tags) ? explode(',', $tags) : (array) $tags;
		$tags = "'" . implode("','", $tags) . "'";
		
		//Set up minimum tags condition
		if ($min_tags > 1) {
			$min_tags = "HAVING COUNT(DISTINCT `te2t`.`tags_id`) >= $min_tags";
		} else {
			$min_tags = '';
		}
		
		//Build up condition part of query based on available data content
		$cond = '';
		$where = (array) $where;
		if (count($where)) {
			foreach ($where as $cond_column => $cond_value) {
				if (is_numeric($cond_column)) {
					$cond .= " AND $cond_value";
				} else {
					$cond_value = $this->_db->real_escape_string($cond_value);
					if (in_array($cond_column, $this->_quoted_fields)) {
						$cond .= " AND `$cond_column` = '$cond_value'";
					} else {
						$cond .= " AND `$cond_column` = $cond_value";
					}
				}
			}
		}
		
		//Build ORDER BY
		if ($orderby) {
			$orderby = "ORDER BY $orderby";
		}
		
		//Build LIMIT
		if ($limit) {
			if (is_numeric($limit)) {
				$limit = "0, $limit";
			}
			$limit = "LIMIT $limit";
		}
		
		$sql = "
			SELECT
				`te2t`.`{$this->_id}_fk`
			FROM
				`{$this->_table}_has_tags` `te2t`
				INNER JOIN `tags` `tt` ON `te2t`.`tags_id_fk` = `tt`.`tags_id`
			WHERE 1=1
				AND `tt`.`tag` IN ($tags)
				$cond
			GROUP BY `te2t`.`{$this->_id}_fk`
			$min_tags
			$orderby
			$limit
		";
		
		$items = $this->gets("`{$this->_id}` IN ($sql)", $orderby, $limit);
		
		return $items;
	}

	public function crosstagged($crosstable, $tags, $min_tags = 1, $where = NULL, $orderby = NULL, $limit = NULL) {
		if (! $tags || ! $crosstable) {
			return;
		}
		
		$tags = is_string($tags) ? explode(',', $tags) : (array) $tags;
		$tags = "'" . implode("','", $tags) . "'";
		
		//Set up minimum tags condition
		if ($min_tags > 1) {
			$min_tags = "HAVING COUNT(DISTINCT `cross_te2t`.`tags_id`) >= $min_tags";
		} else {
			$min_tags = '';
		}
		
		//Build up condition part of query based on available data content
		$cond = '';
		$where = (array) $where;
		if (count($where)) {
			foreach ($where as $cond_column => $cond_value) {
				if (is_numeric($cond_column)) {
					$cond .= " AND $cond_value";
				} else {
					$cond_value = $this->_db->real_escape_string($cond_value);
					if (in_array($cond_column, $this->_quoted_fields)) {
						$cond .= " AND `$cond_column` = '$cond_value'";
					} else {
						$cond .= " AND `$cond_column` = $cond_value";
					}
				}
			}
		}
		
		//Build ORDER BY
		if ($orderby) {
			$orderby = "ORDER BY $orderby";
		}
		
		//Build LIMIT
		if ($limit) {
			if (is_numeric($limit)) {
				$limit = "0, $limit";
			}
			$limit = "LIMIT $limit";
		}
		
		/*$sql = "
			SELECT
				`cross`.*
			FROM
				`{$this->_table}_has_tags` `te2t`
				JOIN `tags` `tt` ON `te2t`.`tags_id_fk` = `tt`.`tags_id`
				JOIN `{$crosstable->_table}_has_tags` `cross_te2t` ON `te2t`.`tags_id_fk` = `cross_te2t`.`tags_id_fk`
				JOIN `{$crosstable->_view}` `cross` ON `cross`.`{$crosstable->_id}` = `cross_te2t`.`{$crosstable->_id}_fk`
			WHERE 1=1
				AND `tt`.`tag` IN ($tags)
				$cond
			GROUP BY `cross_te2t`.`{$crosstable->_id}_fk`
			$min_tags
			$orderby
			$limit
		";*/
		
		$sql = "
			SELECT
				`cross`.*
			FROM
				`tags` `tt`
				JOIN `{$crosstable->_table}_has_tags` `cross_te2t` ON `tt`.`tags_id` = `cross_te2t`.`tags_id_fk`
				JOIN `{$crosstable->_view}` `cross` ON `cross`.`{$crosstable->_id}` = `cross_te2t`.`{$crosstable->_id}_fk`
			WHERE 1=1
				AND `tt`.`tag` IN ($tags)
				$cond
			GROUP BY `cross_te2t`.`{$crosstable->_id}_fk`
			$min_tags
			$orderby
			$limit
		";
		
		//Execute query
		$items = $this->_db->query_all($sql);
		
		//Handle results
		if ($items !== FALSE && $items) {
			$items = $crosstable->clean_results($items);
		}
		return $items;
	}

	/*public function tags($ids) {
		if (! $ids) {
			return;
		}
		
		$ids = (array) $ids;
		$ids = implode(',', $ids);
		
		$sql = "
			SELECT
				`t`.`tags_id`,
				`t`.`tag`,
			FROM
				`{$this->_table}_has_tags` `e2t`
				INNER JOIN `tags` `t` ON `e2t`.`tags_id_fk` = `t`.`tags_id`
			WHERE 1=1
				AND `e2t`.`{$this->_id}_fk` IN ($ids)
			GROUP BY `t`.`tags_id`
		";
		
		//Execute query
		$tags = $this->_db->query_all($sql);
		
		return $tags;
	}*/
	
	protected function _get_quoted_fields() {
		$from = '`' . $this->_table . '`';
		$from = $this->_db->schema_prefix ? $this->_db->schema_prefix . $from : $from;
		
		$sql = "
			SHOW FIELDS
			FROM $from
		";
		
		//Execute query
		$result = $this->_db->query($sql);
		
		$quoted_fields = array();
		while ($row = $result->fetch_assoc()) {
			//Set first column as table ID column
			if (! $this->_id) {
				$this->_id = $row['Field'];
			}
			
			$char = (strpos($row['Type'], 'char') == 0);
			$varchar = (strpos($row['Type'], 'varchar') == 0);
			$binary = (strpos($row['Type'], 'binary') == 0);
			$varbinary = (strpos($row['Type'], 'varbinary') == 0);
			
			$text = 'tinytext,mediumtext,text,longtext';
			$blob = 'tinyblob,mediumblob,blob,longblob';
			$misc = 'string,date,time,datetime,enum,set';
			$strings = "$misc,$text,$blob";
			
			if ($varchar || in_array($row['Type'], explode(',', $strings))) {
				$quoted_fields[] = $row['Field'];
			}
		}
		
		$this->_quoted_fields = $quoted_fields;
	}
}
