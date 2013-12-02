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
class SetupRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
	
	/**
	 * The TYPO3 database object
	 *
	 * @var \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected $databaseHandle;
   
   	public function initializeObject() {
		$this->databaseHandle = $GLOBALS['TYPO3_DB'];
	}
	
	public function findByID($id) {
 		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
    	return $query->matching($query->equals('sessionid', $id))->execute();
	}
	
	public function getIpLockByUid($id) {
		$tableName = 'tx_itspdfgen_domain_model_setup';
		$sqlString = 'SELECT * FROM ' . $tableName . ' WHERE `uid` =' . $id.';' ;
		// debug($sqlString,-2);
		$res = $this->databaseHandle->sql_query($sqlString);
		$row = $this->databaseHandle->sql_fetch_assoc($res);
		return $row['ses_iplock'];
		
	}
}
?>