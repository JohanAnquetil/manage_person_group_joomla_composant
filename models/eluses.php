<?php
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\ListModel;

class ElusModelEluses extends ListModel
{
    protected function getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__elus'));
        return $query;
    }
}
