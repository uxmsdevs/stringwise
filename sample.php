<?php
/* First in first, need to integrate the class for running the examples.. */
require_once 'StringWise.php';

use Uxms\Stringwise\StringWise;

/*
 * I have NormalAdmin (so have User privileges), Reading and Writing permissions, so:
 */
$myPermissions = StringWise::orInt([
	StringWise::NormalAdmin,
	StringWise::Reading,
	StringWise::Writing
]);	// gives 27

echo "
Your rights: $myPermissions<br>
	<ul>";
foreach (StringWise::getConstants() as $key => $value) {
	if (StringWise::andInt([$myPermissions, $value]) == $value)
		echo "<li>$key</li>";
}
echo '
	</ul>';

/*
 * I gave permissions to user which have NormalAdmin and Reading rights for WEB SERVICE, so:
 */
$neededPermissionsWS = StringWise::orInt([
	StringWise::NormalAdmin,
	StringWise::Reading
]);

echo "
Needed permissions for entering the WEB SERVICE section: $neededPermissionsWS<br>
	<ul>";
foreach (StringWise::getConstants() as $key => $value) {
	if (StringWise::andInt([$neededPermissionsWS, $value]) == $value)
		echo "<li>$key</li>";
}
echo '
	</ul>';

if (StringWise::andInt([$myPermissions, $neededPermissionsWS]) == $neededPermissionsWS) {
	echo '<h1><em style="color:#58B058;">You have rights for enter WEB SERVICE section</em></h1>';
} else {
	echo '<h1><em style="color:#D14641;">You don\'t have rights for enter WEB SERVICE section</em></h1>';
}

/*
 * I give permissions to user which have SysAdmin and Reading rights for ADMIN PANEL, so:
 */
$neededPermissionsAP = StringWise::orInt([
		StringWise::SysAdmin,
		StringWise::Reading
]);

echo "
Needed permissions for entering the ADMIN PANEL section: $neededPermissionsAP<br>
	<ul>";
foreach (StringWise::getConstants() as $key => $value) {
	if (StringWise::andInt([$neededPermissionsAP, $value]) == $value)
		echo "<li>$key</li>";
}
echo '
	</ul>';

if (StringWise::andInt([$myPermissions, $neededPermissionsAP]) == $neededPermissionsAP) {
	echo '<h1><em style="color:#58B058;">You have rights for enter ADMIN PANEL section</em></h1>';
} else {
	echo '<h1><em style="color:#D14641;">You don\'t have rights for enter ADMIN PANEL section</em></h1>';
}
