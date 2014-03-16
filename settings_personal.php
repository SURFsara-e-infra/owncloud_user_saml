<?php

OCP\Util::addscript('user_saml', 'settings_personal');

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 12; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
           
if ($_POST) {
	// CSRF check
	OCP\JSON::callCheck();
	OCP\JSON::checkLoggedIn();

	$username = \OCP\User::getUser();
        $password = randomPassword();
	if (!is_null($password)) {
		if (\OC_User::setPassword($username, $password)) {
			\OCP\JSON::success();
		} else {
			\OCP\JSON::error(array("data" => array("message" => $l->t("Error occured. Please try again.")) ));
		}
	}
	exit();
}

// fill template
$tmpl = new OCP\Template( 'user_saml', 'settings_personal');
$tmpl->assign('user_name_login', \OCP\User::getUser());
return $tmpl->fetchPage();
