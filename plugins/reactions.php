<?php

class ReactionsC extends C {
	
	public function index() {
		global $smarty;
		
		$smarty->assign('title', 'Reactions to Life-Link Friendship-Schools');
			
		$dbReactions = DbReactions::get_instance();
		$reactions = $dbReactions->gets(NULL, '`country_short` ASC');
		$smarty->_assign_by_ref('reactions', $reactions);
		
		$smarty->display_wrap('reactions/index.tpl');
	}
}