<?php
namespace Joomla\Component\Elus\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Language\Text;

class CommissionsController extends AdminController
{
    protected $text_prefix = 'COM_ELUS';

    public function getModel($name = 'Commission', $prefix = 'Administrator', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }
}