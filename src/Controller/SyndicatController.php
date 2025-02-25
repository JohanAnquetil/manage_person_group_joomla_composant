<?php
namespace Joomla\Component\Elus\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

class SyndicatController extends FormController
{
    protected $view_list = 'syndicats';  // Vue de retour après action
    protected $view_item = 'syndicat';   // Vue pour l'édition
    protected $text_prefix = 'COM_ELUS';

    public function add()
    {
        $this->input->set('view', 'syndicat');
        parent::add();
    }

    public function edit($key = null, $urlVar = 'id')
    {
        $this->input->set('view', 'syndicat');
        parent::edit($key, $urlVar);
    }

    public function delete()
    {
        $input = \Joomla\CMS\Factory::getApplication()->input;
        $ids = $input->get('cid', [], 'array');

        if ($ids) {
            $model = $this->getModel();
            if ($model->delete($ids)) {
                $this->setMessage('Syndicats supprimés avec succès.');
            } else {
                $this->setMessage('Échec de la suppression.', 'error');
            }
        }

        $this->setRedirect('index.php?option=com_elus&view=syndicats');
    }
}