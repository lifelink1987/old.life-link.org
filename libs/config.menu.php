<?php

function create_menu()
{
	global $menu, $links;
	$whatis = array
	(
		'What is Life-Link?',
		$links['whatis'],
		array
		(
			'In Brief' => array($links['whatis_get'] . 'brief', 'Overview &amp; Ethics'),
			'In Detail' => array($links['whatis_get'] . 'detail', 'Peace Actions, Networking &amp; Benefits'),
			'Membership' => array($links['whatis_get'] . 'membership', 'How to Get Membership'),
			'Board' => array($links['whatis_get'] . 'board', 'Members, Advisors &amp; Core Supporters')
		),
		'Overview &amp; In Detail Information, Board Members'
	);
	$actions = array
	(
		'Peace Actions',
		$links['actions'],
		array
		(
			'Care for Myself' => array($links['actions_get'] . 'myself', 'Focus on Yourself!'),
			'Care for Others' => array($links['actions_get'] . 'others', 'Focus on Those around You!'),
			'Care for Nature' => array($links['actions_get'] . 'nature', 'Focus on What is around You!'),
			'Let\'s Get Organised!' => array($links['actions_get'] . 'organised', 'Have Clear Thoughts!')
		),
		'Proposed Peace Actions/Projects'
	);
	$project = array
	(
		'Project Management',
		$links['actions_get'] . 'management',
		array(),
		'How to keep a Global Perspective'
	);
	$contact = array
	(
		'Contact Life-Link',
		$links['contact'],
		array
		(
			'Send a Message' => array($links['contact'], 'Write an E-m@il, letter or Phone us'),
			'Want to Join in?' => array($links['join'], 'Become a Member School')
		),
		'Get in Touch with Us'
	);
	$support = array
	(
		'Support Life-Link!',
		$links['support'],
		array(),
		'Donate now!'
	);
	$members = array
	(
		'Schools &amp; Actions',
		$links['members'],
		array
		(),
		'Member Schools &amp; Action Reports'
	);
	$report = array
	(
		'Action Report',
		$links['report'],
		array
		(),
		'Fill in Report Form'
	);
	$agenda = array
	(
		'Agenda',
		$links['agenda'],
		array(),
		'Campaigns, Conferences, UN Days &amp; Other Events'
	);
	$campaigns = array
	(
		'Campaigns',
		$links['campaigns'],
		array
		(
			'In the Spotlight' => array($links['campaigns'], 'Forthcoming &amp; Latest Campaigns'),
			'Previous' => array($links['campaigns_get'] . 'old', 'Past Campaigns')
		),
		'Life-Link Campaigns'
	);
	$conferences = array
	(
		'Conferences',
		$links['conferences'],
		array
		(
			'In the Spotlight' => array($links['conferences'], 'Forthcoming &amp; Latest Conferences'),
			'Previous' => array($links['conferences_get'] . 'old', 'Past Conferences')
		),
		'Life-Link Conferences'
	);
	$manual = array
	(
		'Life-Link Manual',
		$links['manual'],
		array
		(),
		'Read or Download the Manual'
	);
	$official = array
	(
		'Diploma &amp; Logos',
		$links['official'],
		array(
			'Action Diploma' => array($links['official_get'] . 'diploma', 'Give your Active Pupils a Sign of Appreciation!'),
			'Official Logos' => array($links['official_get'] . 'logos', 'Bring Unity to your Peace Actions')
		),
		'How to Act as a Life-Link School'
	);
	$live = array
	(
		'Live! News',
		$links['live'],
		array
		(
			'Top News' => array($links['live_get'] . 'news', 'Latest Information'),
			'Newsletters' => array($links['live_get'] . 'newsletters', 'Subscribe to Receive News by E-m@il'),
			'Board Meetings' => array($links['live_get'] . 'appendix', 'Appendix Documents')
			//,
			//'Blog' => array($links['blog'], 'Freedom to Comment!')
		),
		'News, Newsletters &amp; Board Meetings'
	);
	$gallery = array
	(
		'Photo Gallery',
		$links['gallery'],
		array(),
		'Browse Photos &amp; Comment'
	);
	$reactions = array
	(
		'Reactions',
		$links['reactions'],
		array(),
		'Reactions of Official Representatives'
	);
	$collaboration = array
	(
		'Collaboration',
		$links['collaboration'],
		array
		(
			'Partnerships' => array($links['collaboration_get'] . 'partnerships', 'Partner Organisations'),
			'Organisations' => array($links['collaboration_get'] . 'organisations', 'Peace Organisations')
		),
		'Partnerships &amp; Other Organisations'
	);
	$surveys = array
	(
		'Surveys',
		$links['surveys'],
		array(),
		'Help Us Get Answers!'
	);

	$menu = array
	(
		'in practice' => array
		(
			$members,
			$report,
			$agenda,
			$campaigns,
			$conferences,
			
			array('Contact Life-Link', $links['contact'], array(), 'Get in Touch with Us'),
			array('Want to Join in?', $links['join'], array(), 'Become a Member School'),
			
			$support
		),
		'in theory' => array
		(
			array('What is Life-Link?', $links['whatis'], array(), 'Overview &amp; In Detail Information, Board Members'),
				array('&middot; In Brief', $links['whatis_get'] . 'brief', array(), 'Overview &amp; Ethics'),
				array('&middot; In Detail', $links['whatis_get'] . 'detail', array(), 'Peace Actions, Networking &amp; Benefits'),
				array('&middot; Membership', $links['whatis_get'] . 'membership', array(), 'How to Get Membership'),
				array('&middot; Board &amp; Statute', $links['whatis_get'] . 'board', array(), 'Statute, Members, Advisors &amp; Core Supporters'),
				
				array('&nbsp; &middot; Board Meetings', $links['files_get'] . 'board_meetings', array(), ''),
				array('&nbsp; &middot; Anual Meetings', $links['files_get'] . 'anual_meetings', array(), ''),
			
			array('Peace Actions', $links['actions'], array(), 'Proposed Peace Actions/Projects'),
				array('&middot; Care for Myself', $links['actions_get'] . 'myself', array(), 'Focus on Yourself!'),
				array('&middot; Care for Others', $links['actions_get'] . 'others', array(), 'Focus on Those around You!'),
				array('&middot; Care for Nature', $links['actions_get'] . 'nature', array(), 'Focus on What is around You!'),
				array('&middot; Let\'s Get Organised!', $links['actions_get'] . 'organised', array(), 'Have Clear Thoughts!'),
			
			$project
		),
		'resources' => array
		(
			$manual,
			//$live,
			$gallery,
			$reactions,
			
			array('Collaboration', $links['collaboration'], array(), 'Partnerships &amp; Other Organisations'),
				array('&middot; Partnerships', $links['collaboration_get'] . 'partnerships', array(), 'Partner Organisations'),
				array('&middot; Organisations', $links['collaboration_get'] . 'organisations', array(), 'Peace Organisations'),
			
			$official,
			$surveys
		)
	);
}

?>