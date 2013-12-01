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
	 * ip
	 *
	 * @var \string
	 */
	protected $ip;
	
	/**
	 * Returns the ip
	 *
	 * @return \string $ip
	 */
	public function getIp() {
		return $this->ip;
	}

	/**
	 * Sets the ip
	 *
	 * @param \string $ip
	 * @return void
	 */
	public function setIp($ip) {
		$this->ip = $ip;
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


}

?>