<?php
/**
 * @package    [PACKAGE_NAME]
 *
 * @author     [AUTHOR] <[AUTHOR_EMAIL]>
 * @copyright  [COPYRIGHT]
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @link       [AUTHOR_URL]
 */

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Form\FormHelper;

/**
 * Reset License in com_sportsmanager
 *
 * @since  1.0
 */
class PlgSystemKicksportsmanager extends CMSPlugin
{
	/**
	 * Database object
	 *
	 * @var    JDatabaseDriver
	 *
	 * @since  3.8.0
	 */
	protected $db;

	/**
	 * The language object
	 *
	 * @var null
	 * @since  1.0
	 */
	protected $lang = null;

	/**
	 * Load the language file on instantiation.
	 *
	 * @var    boolean
	 * @since  3.1
	 */
	protected $autoloadLanguage = true;

	/**
	 * constructor, used to inject the language class for testing purposes
	 *
	 * @param   object  &$subject  The object to observe
	 * @param   array   $config    An optional associative array of configuration settings.
	 *                             Recognized key values include 'name', 'group', 'params', 'language'
	 *                             (this list is not meant to be comprehensive).
	 *
	 * @since  1.0
	 */
	public function __construct(&$subject, $config = array())
	{
		parent::__construct($subject, $config);

		if (version_compare(JVERSION, '4', 'lt'))
		{
			FormHelper::addFieldPath(__DIR__ . '/fields');
		}
	}

	/**
	 * Plugin
	 *
	 * @return Exception
	 */
	public function onAjaxResetLicense()
	{
		$app = Factory::getApplication();

		$license = $app->input->get('license');
		$where = $app->input->get('where');

		if (is_null($license) || is_null($where)) {
			$app->setHeader('status', 405, true);
			$app->sendHeaders();
			$return = array('reset' => 'error');
			echo json_encode($return);
			$app->close();
		}

		$query = $this->db->getQuery(true)
			->update($this->db->quoteName('#__sportsmanager_spieler'))
			->set($this->db->quoteName('lizenz') . ' = ' . $this->db->quote($license));

		if ($where !== 'ALL') {
			$query->where($this->db->quoteName('lizenz') . ' = ' . $this->db->quote($where));
		}

		try
		{
			$this->db->setQuery($query)->execute();
			$return = array('reset' => 'success');
		}
		catch (JDatabaseExceptionExecuting $e)
		{
			$app->setHeader('status', 510, true);
			$app->sendHeaders();
			$return = array('reset' => 'error');
		}

		echo json_encode($return);

		$app->close();
	}
}
