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
                'mail', 'a.mail',
                'telephone', 'a.telephone',
                'adresse', 'a.adresse',
                'ville', 'a.ville',
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

        $query->select(
            [
                $db->quoteName('a.id'),
                $db->quoteName('a.nom'),
                $db->quoteName('a.prenom'),
                $db->quoteName('a.poste'),
                $db->quoteName('a.syndicat'),
                $db->quoteName('a.etablissement'),
                $db->quoteName('a.commissions'),
                $db->quoteName('a.missions_local'),
                $db->quoteName('a.cse_local'),
                $db->quoteName('a.missions_cse_central'),
                $db->quoteName('a.mail'),
                $db->quoteName('a.telephone'),
                $db->quoteName('a.adresse'),
                $db->quoteName('a.ville'),
                $db->quoteName('a.photo'),
                $db->quoteName('a.fichier'),
                $db->quoteName('a.published'),
                $db->quoteName('a.is_delegue'),
                $db->quoteName('a.ordering'),
                $db->quoteName('s.nom', 'syndicat_nom'),  // Nom du syndicat
                $db->quoteName('a.commissions', 'commissions_raw'), // Pour déboguer
                // Version modifiée de la sous-requête pour les commissions
                '(SELECT GROUP_CONCAT(' . $db->quoteName('c.nom') . ' SEPARATOR \', \') 
                  FROM ' . $db->quoteName('#__commissions') . ' AS c 
                  INNER JOIN (
                    SELECT REPLACE(TRIM(BOTH \'"\' FROM j.value), \'[\', \'\') AS commission_id
                    FROM JSON_TABLE(
                        IF(a.commissions IS NULL, \'[]\', a.commissions),
                        \'$[*]\' COLUMNS (value VARCHAR(50) PATH \'$\')
                    ) j
                  ) tmp ON tmp.commission_id = c.id
                ) AS commission_noms'
            ]
        )
        ->from($db->quoteName('#__elus', 'a'))
        // Jointure avec la table syndicats
        ->join(
            'LEFT',
            $db->quoteName('#__syndicats', 's'),
            $db->quoteName('s.id') . ' = ' . $db->quoteName('a.syndicat')
        );

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
        parent::populateState($ordering, $direction);
        
        $this->setState('list.limit', 100);

        $app = Factory::getApplication();

        // Filtre de recherche
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        // Filtre de publication
        $published = $app->getUserStateFromRequest($this->context . '.filter.published', 'filter_published', '');
        $this->setState('filter.published', $published);
    }
}
