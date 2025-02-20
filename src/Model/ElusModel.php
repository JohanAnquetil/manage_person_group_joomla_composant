<?php
namespace Joomla\Component\Elus\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Database\ParameterType;
use Joomla\CMS\Factory;

class ElusModel extends ListModel
{
    public function __construct($config = array())
    {
        if (empty($config['filter_fields']))
        {
            $config['filter_fields'] = array(
                'id', 'a.id',
                'nom', 'a.nom',
                'prenom', 'a.prenom',
                'poste', 'a.poste',
                'syndicat', 'a.syndicat',
                'etablissement', 'a.etablissement',
                'commissions', 'a.commissions',
                'missions_local', 'a.missions_local',
                'cse_local', 'a.cse_local',
                'coordonnees', 'a.coordonnees',
                'photo', 'a.photo',
                'fichier', 'a.fichier',
                'published', 'a.published',
                'ordering', 'a.ordering',
                'created', 'a.created',
                'created_by', 'a.created_by',
                'modified', 'a.modified',
                'modified_by', 'a.modified_by'
            );
        }

        parent::__construct($config);
    }

    /**
     * Prépare la requête pour la liste des élus.
     */
    protected function getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Sélection des colonnes
        $query->select(
            $db->quoteName([
                'a.id',
                'a.nom',
                'a.prenom',
                'a.poste',
                'a.syndicat',
                'a.etablissement',
                'a.commissions',
                'a.missions_local',
                'a.cse_local',
                'a.coordonnees',
                'a.photo',
                'a.fichier',
                'a.published',
                'a.ordering',
                'a.checked_out',
                'a.checked_out_time',
                'a.created',
                'a.created_by',
                'a.modified',
                'a.modified_by'
            ])
        )->from($db->quoteName('#__elus', 'a'));

        // Filtrer par recherche
        $search = $this->getState('filter.search');
        if (!empty($search))
        {
            $search = '%' . $db->escape(trim($search), true) . '%';
            $query->where('(a.nom LIKE ' . $db->quote($search) . ' OR a.prenom LIKE ' . $db->quote($search) . ')');
        }

        // Filtrer par état de publication
        $published = $this->getState('filter.published');
        if (is_numeric($published))
        {
            $query->where($db->quoteName('a.published') . ' = ' . (int) $published);
        }

        // Ordre
        $orderCol  = $this->getState('list.ordering', 'a.nom');
        $orderDirn = $this->getState('list.direction', 'ASC');
        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        return $query;
    }

    /**
     * État du modèle.
     */
    protected function populateState($ordering = 'a.nom', $direction = 'ASC')
    {
        $app = Factory::getApplication();

        // Filtre de recherche
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        // Filtre de publication
        $published = $app->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
        $this->setState('filter.published', $published);

        parent::populateState($ordering, $direction);
    }
}
