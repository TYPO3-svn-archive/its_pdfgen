<?php
namespace ITSHofmann\ItsPdfgen\Domain\Repository;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Christoph Hofmann <typo3<add>its-hofmann.de>, ITS Hofmann
 *  
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 *
 *
 * @package its_pdfgen
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class SessionRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
   // Example for repository wide settings
   
   	/**
	 * The TYPO3 database object
	 *
	 * @var \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected $databaseHandle;
   
   	public function initializeObject() {
		$this->databaseHandle = $GLOBALS['TYPO3_DB'];
	}
   
	
		
	/**
	 * Adds an object to this repository.
	 *
	 * @param object $object The object to add
	 * @return void
	 * @api
	 */
	public function add($object) {
	
		debug1($object->getSessionid());
		debug1($object->getTstamp());
		debug1($object->getUserid());
		debug1($object->getHashlock());
		debug1($object->getIplock());
		debug1($object->getName());
		
		$fields = array();
		$fields['ses_id'] = "'".$object->getSessionid()."'";
		$fields['ses_name']  = "'".$object->getName()."'";
		$fields['ses_iplock'] = "'".$object->getIplock()."'";
		$fields['ses_hashlock'] = "'".$object->getHashlock()."'";
		$fields['ses_userid'] = $object->getUserid();
		$fields['ses_tstamp'] = $object->getTstamp();
		$keys = array_keys ( $fields);
		$tableName = 'fe_sessions';
		$sqlString = 'INSERT INTO ' . $tableName . ' ( ' . implode(', ', $keys ) .') VALUES ('. implode(', ', $fields).');' ;
	
		// debug($sqlString,-2);
		$returnValue = $this->databaseHandle->sql_query($sqlString);
	}
}
?>