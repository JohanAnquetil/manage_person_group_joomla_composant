<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Controller\BaseController;

class ElusController extends BaseController
{
    public function display($cachable = false, $urlparams = [])
    {
        $input = \JFactory::getApplication()->input;
        $view = $input->getCmd('view', 'elus');
        $input->set('view', $view);

        parent::display($cachable, $urlparams);
    }
}
