<?php
namespace ITSHofmann\ItsPdfgen\Domain\Model;

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
class Pdf extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * url
	 *
	 * @var \string
	 */
	protected $url;

	/**
	 * filename
	 *
	 * @var \string
	 */
	protected $filename;

	/**
	 * createdat
	 *
	 * @var \DateTime
	 */
	protected $createdat;

	/**
	 * userid
	 *
	 * @var \integer
	 */
	protected $userid;

	/**
	 * Returns the url
	 *
	 * @return \string $url
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * Sets the url
	 *
	 * @param \string $url
	 * @return void
	 */
	public function setUrl($url) {
		$this->url = $url;
	}

	/**
	 * Returns the filename
	 *
	 * @return \string $filename
	 */
	public function getFilename() {
		return $this->filename;
	}

	/**
	 * Sets the filename
	 *
	 * @param \string $filename
	 * @return void
	 */
	public function setFilename($filename) {
		$this->filename = $filename;
	}

	/**
	 * Returns the createdat
	 *
	 * @return \DateTime $createdat
	 */
	public function getCreatedat() {
		return $this->createdat;
	}

	/**
	 * Sets the createdat
	 *
	 * @param \DateTime $createdat
	 * @return void
	 */
	public function setCreatedat($createdat) {
		$this->createdat = $createdat;
	}

	/**
	 * Returns the userid
	 *
	 * @return \integer $userid
	 */
	public function getUserid() {
		return $this->userid;
	}

	/**
	 * Sets the userid
	 *
	 * @param \integer $userid
	 * @return void
	 */
	public function setUserid($userid) {
		$this->userid = $userid;
	}

}
?>