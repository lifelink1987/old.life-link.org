<?php

$uri = array();

$uri['home'] = '/';

$uri['api'] = '/api.php?';

$uri['country'] = '/friendship-schools/country/';
$uri['city'] = '/friendship-schools/country/';

$uri['friendship_schools'] = '/friendship-schools';
$uri['friendship_schools_search'] = '/friendship-schools/search';
$uri['school'] = '/friendship-schools/school/';
$uri['map'] = '/friendship-schools/world-map';
$uri['certificate'] = '/friendship-schools/certificate';

$uri['join'] = '/friendship-schools/join';
$uri['report'] = '/friendship-schools/report/';
$uri['report_action'] = '/friendship-schools/report/action';
$uri['report_image'] = '/friendship-schools/report/image/';
$uri['report_thumb'] = '/friendship-schools/report/thumb/';
$uri['report_file'] = '/friendship-schools/report/file/';

$uri['manual'] = '/friendship-schools/manual';
$uri['actions'] = '/friendship-schools/care-actions';
$uri['action'] = '/friendship-schools/action/';
$uri['care_for_myself'] = $uri['theme_1'] = '/friendship-schools/theme/care-for-myself';
$uri['care_for_others'] = $uri['theme_2'] = '/friendship-schools/theme/care-for-others';
$uri['care_for_nature'] = $uri['theme_3'] = '/friendship-schools/theme/care-for-nature';
$uri['lets_get_organised'] = $uri['theme_4'] = '/friendship-schools/theme/lets-get-organised';

$uri['search_schools_in_city'] = '/friendship-schools/s/schools/city/';
$uri['search_schools_in_country'] = '/friendship-schools/s/schools/country/';

$uri['project_management'] = '/project-management';

$uri['campaigns'] = '/campaigns';
$uri['campaign'] = '/campaign/';
$uri['conferences'] = '/conferences';
$uri['conference'] = '/conference/';
$uri['events'] = '/events';
$uri['event'] = '/event/';
$uri['reactions'] = '/reactions';
$uri['press'] = '/press';

$uri['support'] = '/support';
$uri['donate'] = '/support/donate';
$uri['contact/send'] = '/contact/send';

$uri['about'] = '/about';
$uri['programme'] = '/about/programme';
$uri['benefits'] = '/about/benefits';

$uri['board'] = '/board';

$uri['partnerships'] = '/misc/partnerships';
$uri['logo'] = '/misc/logo';
$uri['what_is_lifelink'] = '/friendship_schools/what_is_lifelink';
$uri['contact_newspaper'] = '/friendship_schools/contact_a_newspaper';
$uri['engage_schools'] = '/friendship_schools/engage_schools_near_you';
$uri['engage_community'] = '/friendship_schools/engage_your_community';

$uri['icon_file'] = '/icon/file/';
$uri['icon_social'] = '/icon/social/';
$uri['icon_flag_16'] = '/icon/flag_16/';
$uri['icon_flag_24'] = '/icon/flag_24/';
$uri['icon_flag_32'] = '/icon/flag_32/';
$uri['icon_flag_48'] = '/icon/flag_48/';

$uri['contactable'] = '/contact/send';

$uri['admin'] = $uri['admin_fs'] = '/admin/friendship-schools';
$uri['admin_fs_schools'] = $uri['admin_fs'] . '/schools';
$uri['admin_fs_school'] = $uri['admin_fs'] . '/school/';
$uri['admin_fs_reports'] = $uri['admin_fs'] . '/reports';
$uri['admin_fs_report'] = $uri['admin_fs'] . '/report/';

array_walk($uri, create_function('&$v,$k', '$v = LL_ROOT_URI . $v;'));

$uri['icon_quartz'] = 'http://shared.life-link.org/icons/quartz/';
$uri['files'] = 'http://files.life-link.org/';
$uri['suggestions'] = 'http://suggestions.life-link.org/';
$uri['board_meetings'] = $uri['files'] . '/board_meetings/';
$uri['anual_meetings'] = $uri['files'] . '/annual_meetings/';
$uri['contact'] = "javascript:$('#contactable').click();";
$uri['media'] = 'http://media.life-link.org/';
$uri['wikipedia'] = 'http://en.wikipedia.org/wiki/';

/*

$uri['whatis'] = LL_ROOT_URI . '/whatis';

$uri['actions'] = LL_ROOT_URI . '/actions';

$uri['contact'] = LL_ROOT_URI . '/contact';

$uri['join'] = LL_ROOT_URI . '/join';

$uri['members'] = LL_ROOT_URI . '/members.php';
$uri['member'] = $uri['members'] . '?sub=school&amp;schoolnumber=';
$uri['members_get'] = $uri['members'] . '?sub=';
$uri['members_get_photo'] = $uri['members'] . '?sub=photo&amp;photo=';
$uri['members_get_thumbnail'] = $uri['members'] . '?sub=photo&amp;thumbnail=1&amp;photo=';
$uri['members_get_country'] = $uri['members'] . '?sub=list&amp;list_sr=s&amp;list_country=';
$uri['prepare'] = LL_ROOT_URI . '/prepare.php';
$uri['report'] = LL_ROOT_URI . '/report.php';
$uri['report_get'] = $uri['report'] . '?schoolnumber=';
$uri['report_get_action'] = $uri['report'] . '?actionnumber=';
$uri['report_photos'] = LL_ROOT_URI . '/report.photos.php';
$uri['report_photos_get_photo'] = $uri['report_photos'] . '?photo=';
$uri['report_photos_get_thumbnail'] = $uri['report_photos'] . '?thumbnail=1&amp;photo=';
$uri['agenda'] = LL_ROOT_URI . '/agenda.php';
$uri['campaigns'] = LL_ROOT_URI . '/campaigns.php';
$uri['campaigns_get'] = $uri['campaigns'] . '?sub=';
$uri['campaign_get'] = $uri['campaigns'] . '?sub=single&amp;id=';
$uri['campaign_get_lphoto'] = $uri['campaigns'] . '?sub=logo&amp;id=';
$uri['campaign_get_lthumbnail'] = $uri['campaigns'] . '?sub=logo&amp;thumbnail=1&amp;id=';
$uri['conferences'] = LL_ROOT_URI . '/conferences.php';
$uri['conferences_get'] = $uri['conferences'] . '?sub=';
$uri['conference_get'] = $uri['conferences'] . '?sub=single&amp;id=';
$uri['conference_get_lphoto'] = $uri['conferences'] . '?sub=logo&amp;id=';
$uri['conference_get_lthumbnail'] = $uri['conferences'] . '?sub=logo&amp;thumbnail=1&amp;id=';

$uri['manual'] = LL_ROOT_URI . '/manual.php';

$uri['official'] = LL_ROOT_URI . '/official.php';
$uri['official_get'] = $uri['official'] . '?sub=';

//$uri['live'] = LL_ROOT_URI . '/live.php';
//$uri['live_get'] = $uri['live'] . '?sub=';
$uri['blog'] = LL_ROOT_URI . '/live';
$uri['blog_category_get'] = $uri['blog'] . '/category/';
$uri['gallery'] = 'http://media.life-link.org';
$uri['gallery_get'] = $uri['gallery'] . '/';

$uri['reactions'] = LL_ROOT_URI . '/reactions.php';
$uri['reactions_get'] = $uri['reactions'] . '?sub=';

$uri['collaboration'] = LL_ROOT_URI . '/collaboration.php';
$uri['collaboration_get'] = $uri['collaboration'] . '?sub=';

$uri['website'] = LL_ROOT_URI . '/website.php';
$uri['website_get'] = LL_ROOT_URI . '/website.php?sub=';

$uri['support'] = LL_ROOT_URI . '/support.php';
$uri['support_get'] = LL_ROOT_URI . '/support.php?sub=';

$uri['download'] = LL_ROOT_URI . '/download.php?sub=';
$uri['shared'] = 'http://shared.life-link.org';
$uri['shared_get'] = $files['shared'] . '/';
$uri['files'] = 'http://files.life-link.org';
$uri['files_get'] = $uri['files'] . '/';
$uri['upload'] = LL_ROOT_URI . '/upload.php';
$uri['andrei'] = 'http://andreineculau.com';
//$uri['surveys'] = 'http://www.gs-management.se';
//$uri['surveys_get'] = $uri['surveys'] . '/';
$uri['captcha'] = LL_ROOT_URI . '/captcha.php?' . date('YmdHis');
$uri['flag_get'] = LL_ROOT_URI . '/pages/flags/';

$uri['mail'] = 'mailto:' . LL_MAIL;
$uri['mail_actions'] = 'mailto:' . LL_MAIL_ACTIONS;
$uri['mail_webmaster'] = 'mailto:' . LL_MAIL_WEBMASTER;
$uri['mail_wiki'] = 'mailto:' . LL_MAIL_WIKI;
$uri['mail_gallery'] = 'mailto:' . LL_MAIL_GALLERY;
$uri['mail_newsletter'] = 'mailto:' . LL_MAIL_NEWSLETTER;

*/