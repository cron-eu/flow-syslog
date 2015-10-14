<?php
/**
 * Created by PhpStorm.
 * User: lazarrs
 * Date: 13.10.15
 * Time: 20:59
 */

namespace CRON\Flow\Log\Backend;

class SyslogBackend extends \TYPO3\Flow\Log\Backend\AbstractBackend {

	protected $name = 'flow-app';

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	protected $facility = LOG_LOCAL1;

	/**
	 * @param int $facility
	 */
	public function setFacility($facility) {
		$this->facility = $facility;
	}

	/**
	 * Carries out all actions necessary to prepare the logging backend, such as opening
	 * the log file or opening a database connection.
	 *
	 * @return void
	 * @api
	 */
	public function open() {
		openlog($this->name, LOG_PID, $this->facility);
	}

	/**
	 * Appends the given message along with the additional information into the log.
	 *
	 * @param string $message The message to log
	 * @param integer $severity One of the LOG_* constants
	 * @param mixed $additionalData A variable containing more information about the event to be logged
	 * @param string $packageKey Key of the package triggering the log (determined automatically if not specified)
	 * @param string $className Name of the class triggering the log (determined automatically if not specified)
	 * @param string $methodName Name of the method triggering the log (determined automatically if not specified)
	 * @return void
	 * @api
	 */
	public function append($message, $severity = LOG_INFO, $additionalData = NULL, $packageKey = NULL,
	                       $className = NULL, $methodName = NULL) {

		if ($severity > $this->severityThreshold) { return; }

		// package key
		$output = sprintf('[%s]', $packageKey);

		// + message itself
		$output .= sprintf(' %s', $message);

		// + remote addr, if requested
		if ($this->logIpAddress === TRUE) {
			$output .= sprintf(' (%s)', isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '-');
		}

		// + additional data
		if (!empty($additionalData)) {
			$output .= PHP_EOL . $this->getFormattedVarDump($additionalData);
		}

		syslog($severity, $output);
	}

	/**
	 * Carries out all actions necessary to cleanly close the logging backend, such as
	 * closing the log file or disconnecting from a database.
	 *
	 * @return void
	 * @api
	 */
	public function close() {
		closelog();
	}
}