<?php
/**************************************************************************************/
//                      SERVER STATUS CONFIG FILE TEMPLATE
//                THIS FILE IS FOR CREATING YOUR CONFIG MANUALLY
//                     !!!!!!!IMPORTANT NOTE!!!!!!!!!
// You will need to create your htaccess or web.config file yourself if you use this template
//           Please head to http(s)://yourdomain.com/create-server-config.php
//		        Wait until script finishes.
//               Then delete it from your document root.
// If you don't want to allow php to access your root directory or if you have permission
//                issues please follow the steps below.
// --------------------------
// FOR IIS:
// Rename IISWebConfig to web.config
// FOR Apache and Nginx
// Rename ApacheHtaccess to .htaccess
// --------------------------
//   Contributors:
//   Vojtěch Sajdl - Yigit Kerem Oktay - Thomas Nilsen - jhuesser
/**************************************************************************************/
session_start();
require 'vendor/autoload.php';

//Start editing here
//define("NAME", "##name##"); //Website name
//define("TITLE", "##title##");
//define("WEB_URL", "##url##"); //Used for links
//define("MAILER_NAME", "##mailer##"); //Mailer name
//define("MAILER_ADDRESS", "##mailer_email##"); //Mailer address
define("POLICY_NAME", "Server Status DEV"); //name for contact in policy
define("ADDRESS", "Server Status DEV");
define("POLICY_MAIL", "sysadmin@example.com"); //contact email in policy
define("POLICY_PHONE", "123456789");
define("WHO_WE_ARE","Server Status DEV");
define("POLICY_URL","http://server-status.localhost/policy.php");
define("INSTALL_OVERRIDE", false);
define("DEFAULT_LANGUAGE", "en_GB");
define("CUSTOM_LOGO_URL",""); // This will use the default logo if left empty
define("COPYRIGHT_TEXT",""); // Leave this empty if you don't want your copyright displayed
// Without COPYRIGHT_TEXT Set
// 2020 Server Status Project Contributors
// With COPYRIGHT_TEXT Set
// 2020 Server Status Project Contributors and COPYRIGHT_TEXT
//Stop editing
require("classes/locale-negotiator.php");

$negotiator = new LocaleNegotiator(DEFAULT_LANGUAGE);

if (!isset($_SESSION['locale'])||isset($_GET['lang']))
{
	$override = ((isset($_GET['lang']))?$_GET['lang']:null);
	$best_match = $negotiator->negotiate($override);
	$_SESSION['locale'] = $best_match;
}

putenv('LANGUAGE='.$_SESSION['locale'].'.UTF-8');
setlocale(LC_ALL, $_SESSION['locale'].".UTF-8");
setlocale(LC_MESSAGES, $_SESSION['locale'].".UTF-8");
bindtextdomain("server-status", __DIR__ . "/locale/");
bind_textdomain_codeset("server-status", "utf-8");
textdomain("server-status");

//Database connection
$mysqli = new mysqli("server-status-mysql","root","root","server-status");

if ($mysqli->connect_errno) {
    printf(_("Connection failed: %s\n"), $mysqli->connect_error);
    exit();
}

$mysqli->set_charset("utf8");
