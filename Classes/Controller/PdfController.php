<?php
namespace ITSHofmann\ItsPdfgen\Controller;

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
class PdfController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * pdfRepository
	 *
	 * @var \ITSHofmann\ItsPdfgen\Domain\Repository\PdfRepository
	 * @inject
	 */
	protected $pdfRepository;

	/**
	 * setupRepository
	 *
	 * @var \ITSHofmann\ItsPdfgen\Domain\Repository\SetupRepository
	 * @inject
	 */
	protected $setupRepository;


	/**
	 * sessionRepository
	 *
	 * @var \ITSHofmann\ItsPdfgen\Domain\Repository\SessionRepository
	 * @inject
	 */
	protected $sessionRepository;


	// Keyword list (commalist with no spaces!): "useragent".
	// Each keyword indicates some information that can be included in
	// a integer hash made to lock down usersessions. Configurable through
	// $GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['lockHashKeyWords']
	/**
	 * @todo Define visibility
	 */
	public $lockHashKeyWords = 'useragent';


	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$pdfs = $this->pdfRepository->findAll();
		$this->view->assign('pdfs', $pdfs);
	}

	/**
	 * action show
	 *
	 * @param \ITSHofmann\ItsPdfgen\Domain\Model\Pdf $pdf
	 * @return void
	 */
	public function showAction(\ITSHofmann\ItsPdfgen\Domain\Model\Pdf $pdf) {
		$this->view->assign('pdf', $pdf);
	}

	/**
	 * action new
	 *
	 * @param \ITSHofmann\ItsPdfgen\Domain\Model\Pdf $newPdf
	 * @dontvalidate $newPdf
	 * @return void
	 */
	public function newAction(\ITSHofmann\ItsPdfgen\Domain\Model\Pdf $newPdf = NULL) {
		$this->view->assign('newPdf', $newPdf);
	}

	/**
	 * action create
	 *
	 * @param \ITSHofmann\ItsPdfgen\Domain\Model\Pdf $newPdf
	 * @return void
	 */
	public function createAction(\ITSHofmann\ItsPdfgen\Domain\Model\Pdf $newPdf) {
		$this->pdfRepository->add($newPdf);
		$this->flashMessageContainer->add('Your new Pdf was created.');
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \ITSHofmann\ItsPdfgen\Domain\Model\Pdf $pdf
	 * @return void
	 */
	public function editAction(\ITSHofmann\ItsPdfgen\Domain\Model\Pdf $pdf) {
		$this->view->assign('pdf', $pdf);
	}

	/**
	 * action update
	 *
	 * @param \ITSHofmann\ItsPdfgen\Domain\Model\Pdf $pdf
	 * @return void
	 */
	public function updateAction(\ITSHofmann\ItsPdfgen\Domain\Model\Pdf $pdf) {
		$this->pdfRepository->update($pdf);
		$this->flashMessageContainer->add('Your Pdf was updated.');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \ITSHofmann\ItsPdfgen\Domain\Model\Pdf $pdf
	 * @return void
	 */
	public function deleteAction(\ITSHofmann\ItsPdfgen\Domain\Model\Pdf $pdf) {
		$this->pdfRepository->remove($pdf);
		$this->flashMessageContainer->add('Your Pdf was removed.');
		$this->redirect('list');
	}

	/**
	 * action render
	 *
	 * @return void
	 */
	public function createpdfAction() {
		$getVars = \TYPO3\CMS\Core\Utility\GeneralUtility::_GET();
		unset($getVars[type]);
		
		$pageId= $GLOBALS['TSFE']->id;
		$link = $this->uriBuilder
			->setCreateAbsoluteUri(true)
			->setTargetPageUid($pageId)
			->setArguments($getVars)
			->buildFrontendUri();
		$basicFileFunctions = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('t3lib_basicFileFunctions');
		$title = $GLOBALS['TSFE']->page[title];
		$fileName = $basicFileFunctions->getUniqueName(
				$title.'.pdf' ,
			\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('uploads/tx_itspdfgen/'));
		$renderscript = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:its_pdfgen/');
		$renderscript =  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('its_pdfgen').'Resources/Private/bin/raster.js';
		$call = 'phantomjs '.$renderscript.' '.$link. ' \''.$fileName.'\' A4';
		$userId = $GLOBALS['TSFE']->fe_user->user[uid];
		// Session Handling for private Content
		if ( intval($userId) >0 ) {
			$setup = $this->setupRepository->findByUid(1);
			if (! $setup ) {
				
				$call = 'phantomjs -v';
				$result='';
				$result1='';
				exec ($call,$result,$result1);
				
				
				$call = 'phantomjs '.$renderscript.' '.$link. ' \''.$fileName.'\' A4';
			}
			$cookieName = \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication::getCookieName();
			$sessionData = \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication::fetchSessionData();
			$session = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('ITSHofmann\ItsPdfgen\Domain\Model\Session');
			$random = \TYPO3\CMS\Core\Utility\GeneralUtility::getRandomHexString(32);
			$this->lockHashKeyWords = $GLOBALS['TYPO3_CONF_VARS']['FE']['lockHashKeyWords'];
			
			$session->setSessionid($random);
			$session->setTstamp(time());
			$session->setUserid($userId);
			$session->setHashlock($this->hashLockClause_getHashInt());
			$session->setIplock('10.10');
			$session->setName($cookieName);
			$this->sessionRepository->add($session);
			
		}
	
		
	}

	/**
	 * Creates hash integer to lock user to. Depends on configured keywords
	 *
	 * @return integer Hash integer
	 * @access private
	 */
	protected function hashLockClause_getHashInt() {
		$hashStr = '';
		if (\TYPO3\CMS\Core\Utility\GeneralUtility::inList($this->lockHashKeyWords, 'useragent')) {
			$hashStr .= ':' .'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/26.0';
		}		
		return \TYPO3\CMS\Core\Utility\GeneralUtility::md5int($hashStr);
	}




}
?>