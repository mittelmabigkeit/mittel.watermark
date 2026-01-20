<?
global $DB, $MESS, $APPLICATION;
IncludeModuleLangFile(__FILE__);

CModule::AddAutoloadClasses(
	'mittel.watermark',
	array(
		'CIMYIEMoreWatermark' => 'classes/general/morewatermark.php',
	)
);
