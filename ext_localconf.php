<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'ITSHofmann.' . $_EXTKEY,
	'Itspdfgen',
	array(
		'Pdf' => 'list, show, new, create, edit, update, delete',
		
	),
	// non-cacheable actions
	array(
		'Pdf' => 'create, update, delete',
		
	)
);

?>