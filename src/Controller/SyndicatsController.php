<?php
namespace Joomla\Component\Elus\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Language\Text;

class SyndicatsController extends AdminController
{
    protected $text_prefix = 'COM_ELUS';

    public function getModel($name = 'Syndicat', $prefix = 'Administrator', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }
}