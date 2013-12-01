<?php
namespace ITSHofmann\ItsPdfgen\Domain\Model;

/**
 *
 *
 * @package its_pdfgen
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Session extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {


	/**
	 * sessionData
	 *
	 * @var \string
	 */
	protected $sessionData;
	
		/**
	 * Returns the sessionData
	 *
	 * @return \string $sessionData
	 */
	public function getSessionData() {
		return $this->sessionData;
	}

	/**
	 * Sets the sessionData
	 *
	 * @param \string $sessionData
	 * @return void
	 */
	public function setSessionData($sessionData) {
		$this->sessionData = $sessionData;
	}

	/**
	 * sessionid
	 *
	 * @var \string
	 */
	protected $sessionid;
	
		/**
	 * Returns the sessionid
	 *
	 * @return \string $sessionid
	 */
	public function getSessionid() {
		return $this->sessionid;
	}

	/**
	 * Sets the sessionid
	 *
	 * @param \string $sessionid
	 * @return void
	 */
	public function setSessionid($sessionid) {
		$this->sessionid = $sessionid;
	}


	/**
	 * name
	 *
	 * @var \string
	 */
	protected $name;
	
	/**
	 * Returns the name
	 *
	 * @return \string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param \string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * iplock
	 *
	 * @var \string
	 */
	protected $iplock;
	
	/**
	 * Returns the iplock
	 *
	 * @return \string $iplock
	 */
	public function getIplock() {
		return $this->iplock;
	}

	/**
	 * Sets the iplock
	 *
	 * @param \string $iplock
	 * @return void
	 */
	public function setIplock($iplock) {
		$this->iplock = $iplock;
	}

	/**
	 * hashlock
	 *
	 * @var \string
	 */
	protected $hashlock;
	
	/**
	 * Returns the hashlock
	 *
	 * @return \string $hashlock
	 */
	public function getHashlock() {
		return $this->hashlock;
	}

	/**
	 * Sets the hashlock
	 *
	 * @param \string $hashlock
	 * @return void
	 */
	public function setHashlock($hashlock) {
		$this->hashlock = $hashlock;
	}



	/**
	 * userid
	 *
	 * @var \string
	 */
	protected $userid;
	
	/**
	 * Returns the userid
	 *
	 * @return \string $userid
	 */
	public function getUserid() {
		return $this->userid;
	}

	/**
	 * Sets the userid
	 *
	 * @param \string $userid
	 * @return void
	 */
	public function setUserid($userid) {
		$this->userid = $userid;
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