<?php

class db extends mysqli
{
	protected $data_last_query;
	protected $data_last_result;

	function __construct($host = null, $user = null, $pass = null, $schema = null)
	{
		$host = (empty($host))?LL_DB_HOST:$host;
		$user = (empty($user))?LL_DB_USER:$user;
		$pass = (empty($pass))?LL_DB_PASS:$pass;
		$schema = (empty($schema))?LL_DB_SCHEMA:$schema;
		@parent::__construct($host, $user, $pass, $schema);

		if (mysqli_connect_errno())
		{
			die(sprintf("Can't connect to database. Error: %s", mysqli_connect_error()));
		}
		$this->execute('SET NAMES UTF8');
	}

	/*return both associative and numeric array*/
	function data_array($sql, $clear = 1)
	{
		$this->check_query($sql);
		$result = $this->data_last_result->fetch_array();
		if ($clear)
		{
			$this->clear();
		}
		return $result;
	}

	/*return associative array*/
	function data_assoc($sql, $clear = 1)
	{
		$this->check_query($sql);
		$result = $this->data_last_result->fetch_assoc();
		if ($clear)
		{
			$this->clear();
		}
		return $result;
	}

	/*return numeric array*/
	function data_row($sql, $clear = 1)
	{
		$this->check_query($sql);
		$result = $this->data_last_result->fetch_row();
		if ($clear)
		{
			$this->clear();
		}
		return $result;
	}

	/*return object*/
	function data_object($sql, $clear = 1)
	{
		$this->check_query($sql);
		$result = $this->data_last_result->fetch_object();
		if ($clear)
		{
			$this->clear();
		}
		return $result;
	}

	function &insert($table, $content_array)
	{
		$this->assoc2sql($content_array, $table, $sql_fields, $sql_values);
		$this->execute("
			INSERT INTO $table
			($sql_fields)
			VALUES ($sql_values)
		");
	}

	function &update($table, $content_array, $condition)
	{
		$sql_set = "";
		foreach ($content_array as $key => $value)
		{
			if (strpos($key, 'string_') == 0)
			{
				$key = substr($key, 2);
				$value = "'$value'";
			}
			$sql_set .= ", `$key` = $value";
		}
		$sql_set = substr($sql_set, 2);

		$sql = "
			UPDATE $table
			SET $sql_set
			WHERE 1=1$condition
		";
		return $this->execute($sql);
	}
	
	function date_format($field, $after = null, $before = null)
	{
		return ' BETWEEN ' . date('Y-m-d', strtotime($after)) . ' AND ' . date('Y-m-d', strtotime($before));
	}

	function db2html($text, $acceptHTML = 0, $doubleSpaced = 0)
	{
		$text = trim($text);
		if (!$acceptHTML)
		{
			$text = htmlspecialchars($text);
		}
		else
		{
			$text = preg_replace('@\-\-\-+@', '<hr>', $text);
			$text = preg_replace('@(?:(?:http(s)?://)|(www\.))((?:(?:(?:\w|\-|\_)+\.)+)(?:[a-z]{2,5}))((?:/(?:(?:(?:(?:\w|\-|\_)+\.)*(?:\w|\-|\_)+/?)*))*)(\?(?:\S*))?@i', "<a href=\"http$1://$2$3$4$5\" target=\"_blank\">$2$3$4$5</a>", $text);
			$text = preg_replace("/([\w|\.|\-|_]+@[\w|\.|\-|_]+\.[\w|\.|\-|_]{2,})/", "<a href=\"mailto:$1\">$1</a>", $text);
			$text = preg_replace_callback('@(action\s)?([1-4]:[0-1][0-9])@i', create_function('$matches', 'global $template; return "<a href=\"" . $template["links"]["action"] . db_actions::clean_actionnumber($matches[2]) . "\">" . $matches[1] . $matches[2] . "</a>";'), $text);
		}
		if ($doubleSpaced)
		{
			$text = nl2br($text);
		}
		$text = nl2br($text);
		$text = trim($text);
		return $text;
	}
	
	function assoc2sql($array, $table, &$sql_fields, &$sql_values)
	{
		$sql_fields = array_keys($array);
		$i = -1;
		foreach ($sql_fields as $field)
		{
			$i++;
			$sql_fields[$i] = "`$field`";
		}
		$sql_values = array_values($array);
		$i = -1;
		foreach ($sql_values as $value)
		{
			$i++;
			$sql = "
				SELECT $item
				FROM $table
				LIMIT 1
			";
			$result = $this->query($sql);
			if (mysql_field_type($result, 0) == 'string')
			{
				$sql_values[$i] = "'$value'";
			}
		}
	}

	function execute($sql)
	{
		return $this->query($sql);
	}
	
	function query($sql)
	{
		$this->data_last_query = $sql;
		$result = parent::query($sql);
		if ($result === false)
		{
			echo '<br>MYSQL ERROR: ' . mysqli_error($this);
			die();
		}
		return $result;
	}
	
	function clear()
	{
		$this->data_last_query = null;
		$this->data_last_result = null;
	}
	
	function count($table, $condition = null)
	{
		$sql = "
			SELECT COUNT(*)
			FROM $table
			WHERE 1=1$condition
		";
		$result = $this->data_row($sql, 1);
		return $result[0];
	}
	
	protected function check_query($sql)
	{
		$sql_array = explode("\n", $sql);
		array_walk($sql_array, 'db_line_clean');
		$sql = implode(' ', $sql_array);
		if (($sql != $this->data_last_query)
			&& (!empty($sql)))
		{
			$this->data_last_result = $this->query($sql);
		}
	}
}

function db_line_clean(&$item, $key)
{
	$item = trim($item);
}

require_once('funcs.db/actions.php');						$db_actions_name = 'll_lists_actions';
require_once('funcs.db/campaigns.php');					$db_campaigns_name = 'll_events_campaigns';
require_once('funcs.db/conferences.php');				$db_conferences_name = 'll_events_conferences';
require_once('funcs.db/contacts.php');					$db_contacts_name = 'll_lists_contacts';
require_once('funcs.db/countries.php');					$db_countries_name = 'll_lists_countries';
require_once('funcs.db/members_reports.php');		$db_reports_name = 'll_members_reports';
require_once('funcs.db/members_schools.php');		$db_schools_name = 'll_members_schools';
require_once('funcs.db/organisations.php');			$db_organisations_name = 'll_lists_organisations';
require_once('funcs.db/reactions.php');					$db_reactions_name = 'll_lists_reactions';
require_once('funcs.db/website.php');						$db_website_name = 'll_website';

?>