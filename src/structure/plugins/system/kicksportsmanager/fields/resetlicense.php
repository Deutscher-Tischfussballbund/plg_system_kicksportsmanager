<?php
/**
 * @package    [PROJECT_NAME]
 *
 * @author     [AUTHOR] <[AUTHOR_EMAIL]>
 * @copyright  [COPYRIGHT]
 * @license    [LICENSE]
 * @link       [AUTHOR_URL]
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormField;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;

class JFormFieldResetLicense extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'ResetLicense';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	public function getInput()
	{
		JHtml::_('script', 'plg_system_kicksportsmanager/kicksportsmanager-reset-license.js', array('version' => 'auto', 'relative' => true));

		$html   = array();
		$html[] = '<div class="row">';
		$html[] = '<div class="span3">';
		$html[] = '<select id="license" class="form-select">';

		$html[] = '<option value="">' . Text::_('PLG_SYSTEM_KICKSPORTSMANAGER_SELECTLICENSE') . '</option>';
		$html[] = '<option value="A">A</option>';
		$html[] = '<option value="B">B</option>';
		$html[] = '<option value="C">C</option>';
		$html[] = '<option value="D">D</option>';

		$html[] = '</select>';
		$html[] = '</div>';
		$html[] = '<div class="span3">';
		$html[] = '<select id="where" class="form-select">';

		$html[] = '<option value="">' . Text::_('PLG_SYSTEM_KICKSPORTSMANAGER_SELECTWHERE') . '</option>';
		$html[] = '<option value="*">' . Text::_('PLG_SYSTEM_KICKSPORTSMANAGER_ALL') . '</option>';
		$html[] = '<option value="A">A</option>';
		$html[] = '<option value="B">B</option>';
		$html[] = '<option value="C">C</option>';
		$html[] = '<option value="D">D</option>';

		$html[] = '</select>';
		$html[] = '</div>';
		$html[] = '<div class="span3">';
		$html[] = '<input data-url="' . Uri::base(false) . "index.php?option=com_ajax&plugin=ResetLicense&format=raw" . '" type="button" class="btn btn-success" value="' . Text::_('PLG_SYSTEM_KICKSPORTSMANAGER_RESETLICENSE') . '" id="sportsmanagerresetlicense">';
		$html[] = '</div>';
		$html[] = '</div>';
		$html[] = '<div id="ResetError" class="alert alert-danger hidden">' . Text::_('PLG_SYSTEM_KICKSPORTSMANAGER_FILERENEW_ERROR') . '</div>';
		$html[] = '<div id="ResetSuccess" class="alert alert-success hidden">' . Text::_('PLG_SYSTEM_KICKSPORTSMANAGER_FILERENEW_SUCCESS') . '</div>';

		return implode("\n", $html);
	}

}
