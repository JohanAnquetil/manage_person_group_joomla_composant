<?php
namespace Joomla\Component\Elus\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

class CommissionModel extends AdminModel
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
            'com_elus.commission',
            'commission',
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
        $data = Factory::getApplication()->getUserState('com_elus.edit.commission.data', []);

        if (empty($data))
        {
            $data = $this->getItem();
        }

        return $data;
    }

    /**
     * Obtenir la table associée.
     */
    public function getTable($name = 'Commission', $prefix = 'Table', $options = [])
    {
        try {
            // Factory::getApplication()->enqueueMessage('Debug getTable - Name: ' . $name, 'notice');
            // Factory::getApplication()->enqueueMessage('Debug getTable - Prefix: ' . $prefix, 'notice');
            
            $table = parent::getTable($name, $prefix, $options);
            
            if (!$table) {
                Factory::getApplication()->enqueueMessage('Table non trouvée', 'error');
                return false;
            }
            
            return $table;
        } catch (\Exception $e) {
            Factory::getApplication()->enqueueMessage('Erreur getTable: ' . $e->getMessage(), 'error');
            Factory::getApplication()->enqueueMessage('Trace: ' . $e->getTraceAsString(), 'error');
            return false;
        }
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

    /**
     * Publier les éléments.
     */
    public function publish(&$pks, $value = 1)
    {
        $user = Factory::getApplication()->getIdentity();
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        $query->update($db->quoteName('#__commissions'))
            ->set($db->quoteName('published') . ' = ' . (int) $value)
            ->where($db->quoteName('id') . ' IN (' . implode(',', array_map('intval', $pks)) . ')');

        try {
            $db->setQuery($query)->execute();
            return true;
        } catch (\RuntimeException $e) {
            $this->setError($e->getMessage());
            return false;
        }
    }
}
