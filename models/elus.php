<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Form\Form;
use Joomla\Component\Elus\Administrator\Table\ElusTable;

class ElusModelElus extends AdminModel
{
    /**
     * Méthode pour obtenir la table associée.
     */

     public function getItems()
     {
         $db = $this->getDbo();
         $query = $db->getQuery(true)
             ->select('*')
             ->from($db->quoteName('#__elus'));
     
         $db->setQuery($query);
     
         return $db->loadObjectList();
     }
     
    
    public function getTable($type = 'Elus', $prefix = 'Table', $config = array())
    {
        require_once JPATH_ADMINISTRATOR . '/components/com_elus/src/Table/ElusTable.php';
        return new \Joomla\Component\Elus\Administrator\Table\ElusTable($this->getDbo());
    }

    /**
     * Méthode pour obtenir le formulaire.
     */
    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm('com_elus.elus', 'elus', ['control' => 'jform', 'load_data' => $loadData]);

        if (!$form) {
            $this->setError(JText::_('Échec du chargement du formulaire.'));
            return false;
        }

        return $form;
    }

    /**
     * Charger les données du formulaire.
     */
    protected function loadFormData()
    {
        $data = $this->getItem();
        return $data ?: $this->getStoreId();
    }

    /**
     * Récupérer un élément par ID.
     */
    public function getItem($pk = null)
    {
        $pk = $pk ?: (int) $this->getState('elus.id');

        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__elus'))
            ->where($db->quoteName('id') . ' = ' . (int) $pk);

        $db->setQuery($query);
        $result = $db->loadObject();

        if (!$result) {
            throw new \RuntimeException('Aucun élu trouvé avec cet ID.');
        }

        return $result;
    }
}
