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
		$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager");
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
		$extensionpath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('its_pdfgen')
		);
		
		
		$userId = $GLOBALS['TSFE']->fe_user->user[uid];
		// Session Handling for private Content
		$setup = $this->setupRepository->findAll()->getFirst();
		if (! $setup ) {
			
			$call = 'phantomjs -v';
			$result='';
			$ok = FALSE;
			exec ($call,$result);
			if (is_array($result)) {
				$version = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger($result[0]);
				if (intval($version) < 1007000 ) {
					$filename = $extensionpath.'Resources/Public/Pdf/nophantomjs.pdf';
					$ctype = 'Content-type: application/pdf';
					header("Pragma: public");
		            header("Expires: 0");
		            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		            header("Cache-Control: private",false);
		            header("Content-Type: $ctype");
		            header("Content-Disposition: attachment; filename=\"".basename($filename)."\";");
		            header("Content-Transfer-Encoding: binary");
		            header("Content-Length: ".@filesize($filename));
		            set_time_limit(0);
					@readfile("$filename") or die("File not found.".$renderscript);
					exit;
				} else {
					$ok = TRUE;
				}
			}
			if ($ok) {
				$getVars['type'] = 170266;
				$random = \TYPO3\CMS\Core\Utility\GeneralUtility::getRandomHexString(32);
				$getVars['tx_itspdfgen_itspdfgen[token]']=$random ;
				
				$link1 = $this->uriBuilder
					->setCreateAbsoluteUri(true)
					->setTargetPageUid($pageId)
					->setArguments($getVars)
					->buildFrontendUri();
				$renderscript = $extensionpath.'Resources/Private/Bin/setup.js';
				$setup = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('ITSHofmann\ItsPdfgen\Domain\Model\Setup');
				$setup->setSessionId($random);
				$setup->setTstamp(time());
				$setup->setCrdate(time());
				//time
				
				$this->setupRepository->add($setup);
				$persistenceManager->persistAll();
				$call = 'phantomjs '.$renderscript.' \''.$link1. '\' \''.$fileName.'\'';
				unset ($getVars['tx_itspdfgen_itspdfgen[token]']);
				
				exec ($call,$result);
				$uid = $setup->getUid();
				$setupRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('ITSHofmann\ItsPdfgen\Domain\Repository\SetupRepository');
				                                                                         
				//$setup1 = $setupRepository->findBySessionid($random)->getFirst();
				// Why cant get the IP here ?
				$ip = $this->setupRepository->getIpLockByUid($uid);

				
				$ok = FALSE;
				if ($ip) {
					if (strlen($ip)>0) {
						$setup->setIpLock($ip);
						$ok=TRUE;
					}
				}
				if (!$ok) {
					$setup1 = $this->setupRepository->findAll()->getFirst();
					$this->setupRepository->remove($setup1);
					$persistenceManager->persistAll();
					die('// something went wrong');
					
				}
			}
		}
		if ( intval($userId) >0 ) {
			unset($getVars['type'] );
			
			$IP = $setup->getFullIp();
			$ok=FALSE;
			$lastSessionId='';
			$lastSessionTstamp = time()-7200;
			$setup=$this->setupRepository->findByFullIp($IP)->getFirst();
			$lastSessionId=$setup->getSessionId();
			$lastSessionTstamp = $setup->getTstamp();
			
			if ((time() - $lastSessionTstamp ) < 3600 ) {
				$session = $this->sessionRepository->findBySessionid($lastSessionId)->getFirst();
				if ($session) {
					if (time()-$session->getTstamp()<3600) {
						$ok = TRUE;
					}
				}
			}
			$cookieName = \TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication::getCookieName();
			
			if (!$ok) {
				$random = \TYPO3\CMS\Core\Utility\GeneralUtility::getRandomHexString(32);
				$session = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('ITSHofmann\ItsPdfgen\Domain\Model\Session');
				$session->setSessionid($random);
				$session->setTstamp(time());
				$session->setUserid($userId);
				$session->setHashlock($this->hashLockClause_getHashInt());
				$session->setIplock($setup->getIpLock());
				$session->setName($cookieName);
				$this->sessionRepository->add($session);
				$setup->setSessionId($random);
			}
			$setup->setTstamp(time());
			$random = $setup->getSessionId();
			$this->setupRepository->update($setup);
			$link1 = $this->uriBuilder
				->setCreateAbsoluteUri(true)
				->setTargetPageUid($pageId)
				->setArguments($getVars)
				->buildFrontendUri();
			$pdf = $this->pdfRepository->findByUserIDAndUrl($userId,$link)->getFirst();
			if ($pdf) {
				//todo found
			}
			
			$renderscript = $extensionpath.'Resources/Public/Pdf/setup.js';
			$this->lockHashKeyWords = $GLOBALS['TYPO3_CONF_VARS']['FE']['lockHashKeyWords'];
			
			$persistenceManager->persistAll();
			$fileName = $basicFileFunctions->getUniqueName(
				$title.'.pdf' ,
				\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('uploads/tx_itspdfgen/')
			);
			$uri = $IP = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('TYPO3_HOST_ONLY');
			$renderscript =  \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('its_pdfgen').'Resources/Private/Bin/rasterize.js';
			$call = 'phantomjs '.$renderscript.' \''.$link1. '\' \''.$fileName.'\' '.$cookieName.' '.$random.' '.$uri;
			
			exec ($call,$result);
			$ctype = 'Content-type: application/pdf';
			header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false);
            header("Content-Type: $ctype");
            //header("Content-Disposition: attachment; filename=\"".basename($fileName)."\";");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".@filesize($fileName));
            set_time_limit(0);
			@readfile("$fileName") or die("File not found.".$fileName);
			exit;
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
	
	/**
	 * Returns the IP address to lock to.
	 * The IP address may be partial based on $parts.
	 *
	 * @param integer $parts 1-4: Indicates how many parts of the IP address to return. 4 means all, 1 means only first number.
	 * @return string (Partial) IP address for REMOTE_ADDR
	 * @access private
	 */
	protected function ipLockClause_remoteIPNumber($parts) {
		$IP = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('REMOTE_ADDR');
		if ($parts >= 4) {
			return $IP;
		} else {
			$parts = \TYPO3\CMS\Core\Utility\MathUtility::forceIntegerInRange($parts, 1, 3);
			$IPparts = explode('.', $IP);
			for ($a = 4; $a > $parts; $a--) {
				unset($IPparts[$a - 1]);
			}
			return implode('.', $IPparts);
		}
	}
	
	
	/**
	 * action setup
	 * @param \string $token
	 * @return void
	 */
	public function setupAction($token) {
		$setup = $this->setupRepository->findBySessionId($token)->getFirst();
		if ($setup) {
			$ip_lock = $this->ipLockClause_remoteIPNumber($GLOBALS['TYPO3_CONF_VARS']['FE']['lockIP']);
			$IP = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('REMOTE_ADDR');
			$hash_lock = $this->hashLockClause_getHashInt2();
			debug1('--2--');
			$setup->setIpLock($ip_lock);
			$setup->setFullIp($IP );
			$setup->setTstamp(time());
			$setup = $this->setupRepository->update($setup);
			$persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager");
			$persistenceManager->persistAll();
			$setup1 = $this->setupRepository->findBySessionId($token)->getFirst();
		}
	}
	
	/**
	 * Creates hash integer to lock user to. Depends on configured keywords
	 *
	 * @return integer Hash integer
	 * @access private
	 */
	protected function hashLockClause_getHashInt2() {
		$hashStr = '';
		if (\TYPO3\CMS\Core\Utility\GeneralUtility::inList($this->lockHashKeyWords, 'useragent')) {
			$hashStr .= ':' . \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('HTTP_USER_AGENT');
		}
		return \TYPO3\CMS\Core\Utility\GeneralUtility::md5int($hashStr);
	}
	
	
	
	



}
?>