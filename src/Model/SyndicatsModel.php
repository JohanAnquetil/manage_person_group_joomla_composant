<?php
namespace Joomla\Component\Elus\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\ParameterType;
use Joomla\CMS\Factory;

class SyndicatsModel extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'nom', 'a.nom',
                'description', 'a.description',
                'photo', 'a.photo',
                'published', 'a.published'  // Ajout du champ published
            );
        }

        parent::__construct($config);
    }

    protected function getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        $query->select(
            $db->quoteName([
                'a.id',
                'a.nom',
                'a.description',
                'a.photo',
                'a.published'  // Ajout du champ published
            ])
        )->from($db->quoteName('#__syndicats', 'a'));

        // Filtrer par recherche
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            $search = '%' . $db->escape(trim($search), true) . '%';
            $query->where('a.nom LIKE ' . $db->quote($search));
        }

        // Filtrer par état de publication
        $published = $this->getState('filter.published');
        if (is_numeric($published)) {
            $query->where($db->quoteName('a.published') . ' = ' . (int) $published);
        }

        // Ordre
        $orderCol = $this->getState('list.ordering', 'a.nom');
        $orderDirn = $this->getState('list.direction', 'ASC');
        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        return $query;
    }

    protected function populateState($ordering = 'a.nom', $direction = 'ASC')
    {
        $app = Factory::getApplication();

        // Filtre de recherche
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        // Filtre de publication
        $published = $app->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
        $this->setState('filter.published', $published);

        // Ordre par défaut
        parent::populateState($ordering, $direction);
    }
}