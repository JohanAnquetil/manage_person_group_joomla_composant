<?php
namespace Joomla\Component\Elus\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\CMS\Factory;
use Joomla\Database\DatabaseDriver;
use Joomla\Registry\Registry;

class EluTable extends Table
{
    /**
     * Constructeur
     */
    public function __construct(DatabaseDriver $db)
    {
        $this->setColumnAlias('published', 'state');
        parent::__construct('#__elus', 'id', $db);
    }

    /**
     * Méthode pour lier les données
     */
    public function bind($array, $ignore = '')
    {
        if (isset($array['params']) && is_array($array['params'])) {
            $registry = new Registry($array['params']);
            $array['params'] = (string) $registry;
        }
        
        // Assurez-vous que la date de création est définie
        if (empty($array['created'])) {
            $array['created'] = Factory::getDate()->toSql();
        }

        return parent::bind($array, $ignore);
    }

    /**
     * Méthode pour vérifier l'enregistrement
     */
    public function check()
    {
        if (trim($this->nom) == '') {
            $this->setError('Le nom est requis');
            return false;
        }

        if (trim($this->prenom) == '') {
            $this->setError('Le prénom est requis');
            return false;
        }

        return true;
    }

    /**
     * Méthode pour stocker l'enregistrement
     */
    public function store($updateNulls = false)
    {
        $date = Factory::getDate();
        $user = Factory::getApplication()->getIdentity();

        if ($this->id) {
            // Mise à jour
            $this->modified = $date->toSql();
            $this->modified_by = $user->id;
        } else {
            // Nouveau
            if (empty($this->created)) {
                $this->created = $date->toSql();
            }
            if (empty($this->created_by)) {
                $this->created_by = $user->id;
            }
        }

        return parent::store($updateNulls);
    }
}