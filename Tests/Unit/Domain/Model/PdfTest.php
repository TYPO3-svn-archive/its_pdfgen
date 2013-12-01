<?php

namespace ITSHofmann\ItsPdfgen\Tests;
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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \ITSHofmann\ItsPdfgen\Domain\Model\Pdf.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage ITS PDF Generator
 *
 * @author Christoph Hofmann <typo3<add>its-hofmann.de>
 */
class PdfTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \ITSHofmann\ItsPdfgen\Domain\Model\Pdf
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new \ITSHofmann\ItsPdfgen\Domain\Model\Pdf();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getUrlReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setUrlForStringSetsUrl() { 
		$this->fixture->setUrl('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getUrl()
		);
	}
	
	/**
	 * @test
	 */
	public function getFilenameReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setFilenameForStringSetsFilename() { 
		$this->fixture->setFilename('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getFilename()
		);
	}
	
	/**
	 * @test
	 */
	public function getCreatedatReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setCreatedatForDateTimeSetsCreatedat() { }
	
	/**
	 * @test
	 */
	public function getUseridReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getUserid()
		);
	}

	/**
	 * @test
	 */
	public function setUseridForIntegerSetsUserid() { 
		$this->fixture->setUserid(12);

		$this->assertSame(
			12,
			$this->fixture->getUserid()
		);
	}
	
}
?>