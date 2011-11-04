<?php

db_wordpress::init();

class db_wordpress
{
	private static $db;

	static function init()
	{
		self::$db = new db(LL_DB_HOST_UTIL);
	}

	static function get_category_id($name)
	{
		global $db_wp_prefix;
		$db =& self::$db;
		$result = $db->data_row("
			SELECT term_taxonomy_id
			FROM {$db_wp_prefix}terms t
			JOIN {$db_wp_prefix}term_taxonomy tt
				ON t.term_id = tt.term_id
			WHERE UPPER(t.name) = UPPER('$name')
				AND tt.taxonomy = 'category'
		", 0);
		return $result[0];
	}

	static function get_list($category = null, $orderby = null, $limit = null, $published = 1)
	{
		global $db_wp_prefix;
		$db =& self::$db;
		if ($category)
		{
			$category = self::get_category_id($category);
			$category = " AND pc.term_taxonomy_id = $category";
		}
		if (!$orderby)
		{
			$orderby = " ORDER BY p.post_date_gmt DESC";
		}
		if ($limit)
		{
			$limit = " LIMIT $limit";
		}
		if ($published)
		{
			$published = " AND p.post_status = 'publish'";
		}
		$sql = "
			SELECT DISTINCT p.ID
			FROM {$db_wp_prefix}term_relationships pc
			JOIN {$db_wp_prefix}posts p
				ON p.ID = pc.object_id
			WHERE 1=1 AND p.post_type = 'post'$category$published
			$orderby
			$limit
		";
		while ($result = $db->data_row($sql, 0))
		{
			$posts[] = $result[0];
		}
		$db->clear();
		return $posts;
	}

	static function get_attachment_list($category = null, $post_parent = null, $year = null, $month = null, $orderby = null, $limit = null)
	{
		global $db_wp_prefix;
		$db =& self::$db;
		if ($category)
		{
			$category = self::get_category_id($category);
			$category = " AND pc.term_taxonomy_id = $category";
		}
		if ($post_parent)
		{
			$post_parent = " AND p.post_parent = $post_parent";
		}
		if ($year)
		{
			$year = " AND YEAR(p.post_date_gmt) = $year";
		}
		if ($month)
		{
			$month = " AND MONTH(p.post_date_gmt) = $month";
		}
		if (!$orderby)
		{
			$orderby = " ORDER BY p.post_date_gmt ASC";
		}
		if ($limit)
		{
			$limit = " LIMIT $limit";
		}
		$sql = "
			SELECT DISTINCT p.ID
			FROM {$db_wp_prefix}term_relationships pc
			JOIN {$db_wp_prefix}posts p
				ON p.ID = pc.object_id
			WHERE 1=1 AND p.post_type = 'attachment'$post_parent$year$month
			$orderby
			$limit
		";
		while ($result = $db->data_row($sql, 0))
		{
			$attachment = $result[0];
			$attachments[] = $attachment;
		}
		$db->clear();
		return $attachments;
	}
	
	static function get_links($category_id, $fieldname, $fieldvalue, $orderby = null, $limit = null)
	{
		global $db_wp_prefix;
		$db =& self::$db;
		if ($category_id)
		{
			$category_id = " AND pc.term_taxonomy_id = $category_id";
		}
		if (!$orderby)
		{
			$orderby = " ORDER BY p.post_date_gmt ASC";
		}
		if ($limit)
		{
			$limit = " LIMIT $limit";
		}
		$sql = "
			SELECT DISTINCT p.ID
			FROM {$db_wp_prefix}term_relationships pc
			JOIN {$db_wp_prefix}posts p
				ON p.ID = pc.object_id
			JOIN {$db_wp_prefix}postmeta pm
				ON p.ID = pm.post_id
			WHERE 1=1 AND p.post_status = 'publish' AND p.post_type = 'post' AND pm.meta_key = '$fieldname' AND pm.meta_value = '$fieldvalue'$category_id
			$orderby
			$limit
		";
		while ($result = $db->data_assoc($sql, 0))
		{
			$ids[] = $result['ID'];
		}
		if ($ids)
		{
			for($i=0; $i<count($ids); $i++)
			//foreach ($ids as &$id)
			{
				$meta = self::get_meta($ids[$i]);
				//$meta = self::get_meta($id);
				if (stripos($meta['attach'], 'text') !== false)
				{
					$results[] = self::get($id);
				}
				if ((stripos($meta['attach'], 'files') !== false) || (!$meta['attach']))
				{
					$files = self::get_attachment_list(null, $id);
					if ($files)
					{
						for($j=0; $j<count($ids); $j++)
						//foreach ($files as &$file)
						{
							$results[] = self::get($files[$j]);
							//$results[] = self::get($file);
						}
					}
				}
			}
		}
		$db->clear();
		return $results;
	}

	static function get_raw($id)
	{
		global $db_wp_prefix;
		$db =& self::$db;
		$result = $db->data_assoc("
			SELECT *
			FROM {$db_wp_prefix}posts
			WHERE ID=$id
		");
		return $result;
	}

	static function get_category_raw($id)
	{
		global $db_wp_prefix;
		$db =& self::$db;
		$result = $db->data_assoc("
			SELECT *
			FROM {$db_wp_prefix}terms
			WHERE term_id=$id
		");
		return $result;
	}

	static function get_author_raw($id)
	{
		global $db_wp_prefix;
		$db =& self::$db;
		$result = $db->data_assoc("
			SELECT *
			FROM {$db_wp_prefix}users
			WHERE ID=$id
		");
		return $result;
	}

	static function get($id)
	{
		$raw_result = self::get_raw($id);
		if (!$raw_result)
		{
			return;
		}
		$result['id'] = $raw_result['ID'];
		$result['post_author'] = self::get_author($raw_result['post_author']);
		$result['post_date'] = $raw_result['post_date'];
		$result['post_date_gmt'] = $raw_result['post_date_gmt'];
		$result['post_content'] = nl2br($raw_result['post_content']);
		$result['post_title'] = $raw_result['post_title'];
		$result['post_excerpt'] = nl2br($$raw_result['post_excerpt']);
		$result['post_status'] = $raw_result['post_status'];
		$result['post_type'] = $raw_result['post_type'];
		$result['post_name'] = $raw_result['post_name'];
		$result['post_modified'] = $raw_result['post_modified'];
		$result['post_modified_gmt'] = $raw_result['post_modified_gmt'];
		$result['post_parent'] = $raw_result['post_parent'];
		$result['guid'] = $raw_result['guid'];
		$result['meta'] = self::get_meta($result['id']);
		if ($result['post_type'] == 'attachment')
		{
			$pathinfo = pathinfo($result['guid']);
			$result['post_extension'] = $pathinfo['extension'];
		}
		return $result;
	}
	
	static function get_meta($id)
	{
		global $db_wp_prefix;
		$db =& self::$db;
		$sql = "
			SELECT DISTINCT p.id, pm.meta_id, pm.meta_key, pm.meta_value
			FROM {$db_wp_prefix}posts p
			JOIN {$db_wp_prefix}postmeta pm
				ON p.ID = pm.post_id
			WHERE 1=1 AND p.ID = $id
			ORDER BY pm.meta_id
		";
		while ($result = $db->data_assoc($sql, 0))
		{
			
			$meta[$result['meta_key']] = $result['meta_value'];
		}
		$db->clear();
		return $meta;
	}

	static function get_full($id)
	{
		global $timetest;

		$timetest['wordpress_getfull_'.$id] = array(gmdate('H:i:s'), memory_get_usage(true));
		$result = self::get($id);
		$timetest['wordpress_getfull_end_'.$id] = array(gmdate('H:i:s'), memory_get_usage(true));
		$attachments_list = db_wordpress::get_attachment_list(null, $id);
		$timetest['wordpress_getfull_attach_end_'.$id] = array(gmdate('H:i:s'), memory_get_usage(true));
		if ($attachments_list)
		{
			foreach ($attachments_list as &$attachment_id)
			{
				$attachments[] = self::get($attachment_id);
			}
		}
		$timetest['wordpress_getfull_attach_end2_'.$id] = array(gmdate('H:i:s'), memory_get_usage(true));
		$result['attachments'] = $attachments;
		return $result;
	}

	static function get_category($id)
	{
		$raw_result = self::get_category_raw($id);
		if (!$raw_result)
		{
			return;
		}
		$result['term_ID'] = $raw_result['term_ID'];
		$result['term_name'] = $raw_result['term_name'];
		return $result;
	}

	static function get_author($id)
	{
		$raw_result = self::get_author_raw($id);
		if (!$raw_result)
		{
			return;
		}
		$result['user_nicename'] = $raw_result['user_nicename'];
		$result['display_name'] = $raw_result['display_name'];
		$result['user_email'] = $raw_result['user_email'];
		$result['user_url'] = $raw_result['user_url'];
		return $result;
	}

	static function counter($condition)
	{
		global $db_wp_prefix;
		$db =& self::$db;
		return $db->count("{$db_wp_prefix}term_relationships pc JOIN {$db_wp_prefix}posts p ON p.ID = pc.object_id", $condition);
	}
}

?>