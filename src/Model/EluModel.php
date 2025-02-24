<?php
namespace Joomla\Component\Elus\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\Database\ParameterType;

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
        // Charger les données depuis l'état de l'application
        $data = Factory::getApplication()->getUserState('com_elus.edit.elu.data', array());
        
        if (empty($data)) {
            $data = $this->getItem();
            
            // Debug pour voir ce qui est chargé
            // Factory::getApplication()->enqueueMessage('Loading data: ' . print_r($data, true), 'notice');
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
        // Sauvegarder les commissions avant qu'elles ne soient converties en JSON
        $commissions = isset($data['commissions']) ? (array) $data['commissions'] : [];
        
        // Convertir le tableau des commissions en JSON pour le stockage
        $data['commissions'] = !empty($commissions) ? json_encode($commissions) : null;
        
        if (parent::save($data)) {
            Factory::getApplication()->enqueueMessage(Text::_('COM_ELUS_SAVE_SUCCESS'), 'message');
            return true;
        }
        else
        {
            Factory::getApplication()->enqueueMessage(Text::_('COM_ELUS_SAVE_FAILED'), 'error');
            return false;
        }
    }

    public function getItem($pk = null)
    {
        $item = parent::getItem($pk);

        // Convertir les commissions de JSON en tableau
        if (!empty($item->commissions)) {
            $item->commissions = json_decode($item->commissions, true);
        }

        return $item;
    }

    public function publish(&$pks, $value = 1)
    {
        $user = Factory::getApplication()->getIdentity();
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        $query->update($db->quoteName('#__elus'))
            ->set($db->quoteName('published') . ' = ' . (int) $value)
            ->where($db->quoteName('id') . ' IN (' . implode(',', array_map('intval', $pks)) . ')');

        try {
            $db->setQuery($query)->execute();
        } catch (\RuntimeException $e) {
            $this->setError($e->getMessage());
            return false;
        }

        return true;
    }
}
