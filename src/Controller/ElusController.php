<?php
namespace Joomla\Component\Elus\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Language\Text;

class ElusController extends AdminController
{
    /**
     * Proxy pour getModel
     */
    public function getModel($name = 'Elu', $prefix = 'Administrator', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }
}
