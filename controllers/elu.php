<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;

class ElusControllerElu extends FormController
{
    /**
     * Tâche pour ajouter un nouvel élu.
     */
    public function add()
    {
        $this->setRedirect('index.php?option=com_elus&view=elu&layout=edit');
    }

    /**
     * Enregistrer l'élu.
     */
    public function save($key = null, $urlVar = null)
    {
        $app = \JFactory::getApplication();
        $data = $app->input->get('jform', array(), 'array');

        $model = $this->getModel();
        if ($model->save($data)) {
            $this->setMessage('Élu enregistré avec succès.');
        } else {
            $this->setMessage('Échec de l\'enregistrement.', 'error');
        }

        $this->setRedirect(\JRoute::_('index.php?option=com_elus&view=elus', false));
    }
}

