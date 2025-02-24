<?php
namespace Joomla\Component\Elus\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

class EluController extends FormController
{
    protected $view_list = 'elus';  // Vue de retour après action
    protected $view_item = 'elu';   // Vue pour l'édition
    protected $text_prefix = 'COM_ELUS';

    public function add()
    {
        $this->input->set('view', 'elu');
        parent::add();
    }

    public function edit($key = null, $urlVar = 'id')
    {
        $this->input->set('view', 'elu');
        parent::edit($key, $urlVar);
    }
}
