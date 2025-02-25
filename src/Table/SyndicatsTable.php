<?php
namespace Joomla\Component\Elus\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;
use Joomla\CMS\Factory;
use Joomla\Database\DatabaseDriver;
use Joomla\Registry\Registry;

class SyndicatsTable extends Table
{
    /**
     * Constructeur
     */
    public function __construct(DatabaseDriver $db)
    {
        $this->setColumnAlias('published', 'state');
        parent::__construct('#__syndicats', 'id', $db);
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

    protected function _getAssetName()
    {
        $k = $this->_tbl_key;
        return 'com_elus.syndicats';
    }

    protected function _getAssetTitle()
    {
        return 'Syndicats';
    }

    protected function _getAssetParentId()
    {
        $assetParent = Table::getInstance('Asset');
        if ($assetParent->loadByName('com_elus'))
        {
            return $assetParent->id;
        }
        return parent::_getAssetParentId();
    }
}