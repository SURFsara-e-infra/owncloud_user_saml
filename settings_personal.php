<?php

OCP\Util::addscript('user_saml', 'settings_personal');

// fill template
$tmpl = new OCP\Template( 'user_saml', 'settings_personal');
$tmpl->assign('user_name_login', \OCP\User::getUser());
return $tmpl->fetchPage();
