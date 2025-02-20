<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Form\Form;

class ElusModelElu extends AdminModel
{
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_elus.elu', 'elu', ['control' => 'jform', 'load_data' => $loadData]);

        if (!$form) {
            throw new \RuntimeException('Impossible de charger le formulaire.');
        }

        return $form;
    }

    protected function loadFormData()
    {
        return $this->getItem();
    }
}
