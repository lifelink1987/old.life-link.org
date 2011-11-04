<?php

require_once('funcs.db/agenda.php');			$db_agenda_name = 'll_events_agenda';
require_once('funcs.db/actions.php');			$db_actions_name = 'll_lists_actions';
require_once('funcs.db/campaigns.php');			$db_campaigns_name = 'll_events_campaigns';
require_once('funcs.db/conferences.php');		$db_conferences_name = 'll_events_conferences';
require_once('funcs.db/contacts.php');			$db_contacts_name = 'll_lists_contacts';
require_once('funcs.db/countries.php');			$db_countries_name = 'll_lists_countries';
require_once('funcs.db/days.php');				$db_days_name = 'll_lists_days';
require_once('funcs.db/members_reports.php');	$db_reports_name = 'll_members_reports';
require_once('funcs.db/members_schools.php');	$db_schools_name = 'll_members_schools';
require_once('funcs.db/organisations.php');		$db_organisations_name = 'll_lists_organisations';
require_once('funcs.db/reactions.php');			$db_reactions_name = 'll_lists_reactions';
require_once('funcs.db/website.php');			$db_website_name = 'll_website';
require_once('funcs.db/wordpress.php');			$db_wp_prefix = 'wpress_';

class db
{
	protected $connection, $host, $user, $pass, $schema;
	protected $data_last_query;
	protected $data_last_result;

	function __construct($host = null, $user = null, $pass = null, $schema = null)
	{
		$this->host = (empty($host))?LL_DB_HOST:$host;
		$this->user = (empty($user))?LL_DB_USER:$user;
		$this->pass = (empty($pass))?LL_DB_PASS:$pass;
		$this->schema = (empty($schema))?LL_DB_SCHEMA:$schema;
		$this->connection = mysql_pconnect($this->host, $this->user, $this->pass);

		if (mysql_errno($this->connection))
		{
			die(sprintf("Can't connect to database. Error: %s", mysql_error($this->connection)));
		}
		$this->execute('SET NAMES UTF8');
		mysql_select_db($this->schema);
	}

	/*return both associative and numeric array*/
	function data_array($sql, $clear = 1)
	{
		$this->check_query($sql);
		$result = mysql_fetch_array($this->data_last_result);
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
		$result = mysql_fetch_assoc($this->data_last_result);
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
		$result = mysql_fetch_row($this->data_last_result);
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
		$result = mysql_fetch_object($this->data_last_result);
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
	
	function insert_id()
	{
		return mysql_insert_id($this->connection);
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
		echo "$sql<br/>";
		return $this->execute($sql);
	}

	function date_format($string)
	{
		return date('Y-m-d', strtotime($string));
	}

	function date_build($year, $month, $day)
	{
		if ($year < 50)
		{
			$year = 2000 + $year;
		}
		if ($year < 100)
		{
			$year = 1900 + $year;
		}
		$month = str_pad($month, 2, '0', STR_PAD_LEFT);
		$day = str_pad($day, 2, '0', STR_PAD_LEFT);
		return "$year-$month-$day";
	}

	function date_between($field, $after, $before)
	{
		return $field . ' BETWEEN \'' . $after . '\' AND \'' . $before . '\'';
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
		array_change_key_case($array, CASE_LOWER);
		$sql = "
			SELECT *
			FROM $table
			LIMIT 1
		";
		$result = $this->query($sql);
		$types = array();
		$sql_fields = array();
		$i = 0;
		while ($i < mysql_num_fields($result))
		{
			$field_name = strtolower(mysql_field_name($result, $i));
			if (!empty($array[$field_name]))
			{
				if (get_magic_quotes_gpc())
				{
					$array[$field_name] = stripslashes($array[$field_name]);
				}
				if (!is_numeric($array[$field_name]))
				{
					$array[$field_name] = "'" . mysql_real_escape_string($array[$field_name], $this->connection) . "'";
				}
				$sql_fields[] = "`$field_name`";
				$sql_values[] = $array[$field_name];
			}
			$i++;
		}

		$sql_fields = join(', ', $sql_fields);
		$sql_values = join(', ', $sql_values);
	}

	function execute($sql)
	{
		return mysql_query($sql, $this->connection);
	}

	function query($sql)
	{
		$this->data_last_query = $sql;
		$result = mysql_query($sql, $this->connection);
		if ($result === false)
		{
			echo '<br>MYSQL ERROR: ' . mysql_error($this->connection);
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
	
	static function restrict($results, $fields)
	{
		$fields = array_flip($fields);
		$new_results = array();
		foreach ($results as &$result)
		{
			$new_results[] = array_intersect_key($result, $fields);
		}
		return $new_results;
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

?>