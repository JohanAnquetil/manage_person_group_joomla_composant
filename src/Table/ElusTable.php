<?php
// administrator/components/com_elus/src/Table/ElusTable.php

namespace Joomla\Component\Elus\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;
use Joomla\CMS\Language\Text;
use Joomla\Registry\Registry;

class ElusTable extends Table
{
    /**
     * Constructeur de la table Elus.
     *
     * @param DatabaseDriver $db L'objet de la base de données.
     */
    public function __construct(DatabaseDriver $db)
    {
        // Définition des champs par défaut
        $this->setColumnAlias('published', 'state');
        
        parent::__construct('#__elus', 'id', $db);
    }

    /**
     * Méthode pour lier les données avant sauvegarde
     *
     * @return boolean True en cas de succès
     */
    public function bind($array, $ignore = '')
    {
        // Conversion des champs JSON
        if (isset($array['params']) && is_array($array['params']))
        {
            $registry = new Registry($array['params']);
            $array['params'] = (string) $registry;
        }

        return parent::bind($array, $ignore);
    }

    /**
     * Méthode pour vérifier les données avant sauvegarde
     *
     * @return boolean True si les données sont valides
     */
    public function check()
    {
        // Vérification du nom
        if (trim($this->nom) == '')
        {
            $this->setError(Text::_('COM_ELUS_ERROR_NOM_REQUIRED'));
            return false;
        }

        // Vérification du prénom
        if (trim($this->prenom) == '')
        {
            $this->setError(Text::_('COM_ELUS_ERROR_PRENOM_REQUIRED'));
            return false;
        }

        return true;
    }

    /**
     * Surcharge de la méthode store pour gérer les dates
     *
     * @param  boolean  $updateNulls  True pour mettre à jour les champs null
     *
     * @return boolean  True en cas de succès
     */
    public function store($updateNulls = false)
    {
        $date = Factory::getDate();
        $user = Factory::getApplication()->getIdentity();

        if ($this->id)
        {
            // Modification
            $this->modified = $date->toSql();
            $this->modified_by = $user->id;
        }
        else
        {
            // Création
            if (!(int) $this->created)
            {
                $this->created = $date->toSql();
            }
            if (empty($this->created_by))
            {
                $this->created_by = $user->id;
            }
        }

        return parent::store($updateNulls);
    }
}
