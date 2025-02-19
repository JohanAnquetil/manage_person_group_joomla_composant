<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Controller\AdminController;

class ElusControllerEluses extends AdminController
{
    public function getModel($name = 'Elus', $prefix = 'ElusModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }
}
