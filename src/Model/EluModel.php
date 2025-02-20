<?php
namespace Joomla\Component\Elus\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

class EluModel extends AdminModel
{
    protected $text_prefix = 'COM_ELUS';

    /**
     * Constructor.
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->app = Factory::getApplication();
    }

    /**
     * Obtenir le formulaire.
     */
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_elus.elu',
            'elu',
            ['control' => 'jform', 'load_data' => $loadData]
        );

        if (empty($form))
        {
            return false;
        }

        return $form;
    }

    /**
     * Charger les données pour le formulaire.
     */
    protected function loadFormData()
    {
        // Utilise Factory::getApplication() directement
        $data = Factory::getApplication()->getUserState('com_elus.edit.elu.data', []);

        if (empty($data))
        {
            $data = $this->getItem();
        }

        return $data;
    }

    /**
     * Obtenir la table associée.
     */
    public function getTable($name = 'Elu', $prefix = 'Table', $options = [])
    {
        return parent::getTable($name, $prefix, $options);
    }

    /**
     * Préparation et nettoyage des données.
     */
    protected function preprocessForm($form, $data, $group = 'content')
    {
        parent::preprocessForm($form, $data, $group);
    }

    /**
     * Sauvegarde des données.
     */
    public function save($data)
    {
        if (parent::save($data))
        {
            Factory::getApplication()->enqueueMessage(Text::_('COM_ELUS_SAVE_SUCCESS'), 'message');
            return true;
        }
        else
        {
            Factory::getApplication()->enqueueMessage(Text::_('COM_ELUS_SAVE_FAILED'), 'error');
            return false;
        }
    }
}
