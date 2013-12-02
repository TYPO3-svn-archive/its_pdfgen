<?php
namespace ITSHofmann\ItsPdfgen\Domain\Model;

/**
 *
 *
 * @package its_pdfgen
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Setup extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {


	/**
	 * fullIp
	 *
	 * @var \string
	 */
	protected $fullIp;
	
	/**
	 * Returns the fullIp
	 *
	 * @return \string $fullIp
	 */
	public function getFullIp() {
		return $this->fullIp;
	}

	/**
	 * Sets the fullIp
	 *
	 * @param \string $fullIp
	 * @return void
	 */
	public function setFullIp($fullIp) {
		$this->fullIp = $fullIp;
	}

	/**
	 * sessionId
	 *
	 * @var \string
	 */
	protected $sessionId;
	
	/**
	 * Returns the sessionId
	 *
	 * @return \string $sessionId
	 */
	public function getSessionId() {
		return $this->sessionId;
	}

	/**
	 * Sets the sessionId
	 *
	 * @param \string $sessionId
	 * @return void
	 */
	public function setSessionId($sessionId) {
		$this->sessionId = $sessionId;
	}


	/**
	 * ipLock
	 *
	 * @var \string
	 */
	protected $ipLock;
	
	/**
	 * Returns the ipLock
	 *
	 * @return \string $ipLock
	 */
	public function getIpLock() {
		return $this->ipLock;
	}

	/**
	 * Sets the ipLock
	 *
	 * @param \string $ipLock
	 * @return void
	 */
	public function setIpLock($ipLock) {
		$this->ipLock = $ipLock;
	}



	/**
	 * crdate
	 *
	 * @var \integer
	 */
	protected $crdate;
	
	/**
	 * Returns the crdate
	 *
	 * @return \integer $crdate
	 */
	public function getCrdate() {
		return $this->crdate;
	}

	/**
	 * Sets the crdate
	 *
	 * @param \integer $crdate
	 * @return void
	 */
	public function setCrdate($crdate) {
		$this->crdate = $crdate;
	}


	/**
	 * tstamp
	 *
	 * @var \integer
	 */
	protected $tstamp;
	
	/**
	 * Returns the tstamp
	 *
	 * @return \integer $tstamp
	 */
	public function getTstamp() {
		return $this->tstamp;
	}

	/**
	 * Sets the tstamp
	 *
	 * @param \integer $tstamp
	 * @return void
	 */
	public function setTstamp($tstamp) {
		$this->tstamp = $tstamp;
	}



}

?>