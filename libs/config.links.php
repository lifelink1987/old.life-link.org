<?php

$links =& $template['links'];

$links['home'] = LL_WEBPATH . '/home.php';

$links['whatis'] = LL_WEBPATH . '/whatis.php';
$links['whatis_get'] = $links['whatis'] . '?sub=';

$links['actions'] = LL_WEBPATH . '/actions.php';
$links['action'] = $links['actions'] . '?id=';
$links['actions_get'] = $links['actions'] . '?sub=';

$links['contact'] = LL_WEBPATH . '/contact.php';
$links['contact_get'] = $links['contact'] . '?to=';
$links['contact_school_info'] = $links['contact'] . "?message=%23";
$links['contact_school_info_end'] = "%0D%0A%0D%0AMy school's contact information is outdated. Please update the following:%0D%0A%0D%0A...";
$links['join'] = LL_WEBPATH . '/join.php';

$links['members'] = LL_WEBPATH . '/members.php';
$links['member'] = $links['members'] . '?sub=school&amp;schoolnumber=';
$links['members_get'] = $links['members'] . '?sub=';
$links['members_get_photo'] = $links['members'] . '?sub=photo&amp;photo=';
$links['members_get_thumbnail'] = $links['members'] . '?sub=photo&amp;thumbnail=1&amp;photo=';
$links['members_get_country'] = $links['members'] . '?sub=list&amp;list_sr=s&amp;list_country=';
$links['prepare'] = LL_WEBPATH . '/prepare.php';
$links['report'] = LL_WEBPATH . '/report.php';
$links['report_get'] = $links['report'] . '?schoolnumber=';
$links['report_get_action'] = $links['report'] . '?actionnumber=';
$links['report_photos'] = LL_WEBPATH . '/report.photos.php';
$links['report_photos_get_photo'] = $links['report_photos'] . '?photo=';
$links['report_photos_get_thumbnail'] = $links['report_photos'] . '?thumbnail=1&amp;photo=';
$links['agenda'] = LL_WEBPATH . '/agenda.php';
$links['campaigns'] = LL_WEBPATH . '/campaigns.php';
$links['campaigns_get'] = $links['campaigns'] . '?sub=';
$links['campaign_get'] = $links['campaigns'] . '?sub=single&amp;id=';
$links['campaign_get_lphoto'] = $links['campaigns'] . '?sub=logo&amp;id=';
$links['campaign_get_lthumbnail'] = $links['campaigns'] . '?sub=logo&amp;thumbnail=1&amp;id=';
$links['conferences'] = LL_WEBPATH . '/conferences.php';
$links['conferences_get'] = $links['conferences'] . '?sub=';
$links['conference_get'] = $links['conferences'] . '?sub=single&amp;id=';
$links['conference_get_lphoto'] = $links['conferences'] . '?sub=logo&amp;id=';
$links['conference_get_lthumbnail'] = $links['conferences'] . '?sub=logo&amp;thumbnail=1&amp;id=';

$links['manual'] = LL_WEBPATH . '/manual.php';

$links['official'] = LL_WEBPATH . '/official.php';
$links['official_get'] = $links['official'] . '?sub=';

//$links['live'] = LL_WEBPATH . '/live.php';
//$links['live_get'] = $links['live'] . '?sub=';
$links['blog'] = LL_WEBPATH . '/live';
$links['blog_category_get'] = $links['blog'] . '/category/';
$links['gallery'] = 'http://media.life-link.org';
$links['gallery_get'] = $links['gallery'] . '/';

$links['reactions'] = LL_WEBPATH . '/reactions.php';
$links['reactions_get'] = $links['reactions'] . '?sub=';

$links['collaboration'] = LL_WEBPATH . '/collaboration.php';
$links['collaboration_get'] = $links['collaboration'] . '?sub=';

$links['website'] = LL_WEBPATH . '/website.php';
$links['website_get'] = LL_WEBPATH . '/website.php?sub=';

$links['support'] = LL_WEBPATH . '/support.php';
$links['support_get'] = LL_WEBPATH . '/support.php?sub=';

$links['download'] = LL_WEBPATH . '/download.php?sub=';
$links['shared'] = 'http://shared.life-link.org';
$links['shared_get'] = $files['shared'] . '/';
$links['files'] = 'http://files.life-link.org';
$links['files_get'] = $links['files'] . '/';
$links['upload'] = LL_WEBPATH . '/upload.php';
$links['andrei'] = 'http://andreineculau.com';
//$links['surveys'] = 'http://www.gs-management.se';
//$links['surveys_get'] = $links['surveys'] . '/';
$links['captcha'] = LL_WEBPATH . '/captcha.php?' . date('YmdHis');
$links['flag_get'] = LL_WEBPATH . '/pages/flags/';

$links['mail'] = 'mailto:' . LL_MAIL;
$links['mail_actions'] = 'mailto:' . LL_MAIL_ACTIONS;
$links['mail_webmaster'] = 'mailto:' . LL_MAIL_WEBMASTER;
$links['mail_wiki'] = 'mailto:' . LL_MAIL_WIKI;
$links['mail_gallery'] = 'mailto:' . LL_MAIL_GALLERY;
$links['mail_newsletter'] = 'mailto:' . LL_MAIL_NEWSLETTER;

?>