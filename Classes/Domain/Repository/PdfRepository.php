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
class PdfRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
	public function  findByUserIDAndUrl ($userId,$url) {
 		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
    	$query->matching(
    		$query->logicalAnd(
    			$query->equals('url', $url),
				$query->equals('userid', $userId)
			)
		);
		return $query->execute();
	
	}
}
?>