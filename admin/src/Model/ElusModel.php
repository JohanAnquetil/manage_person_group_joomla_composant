<?php
namespace Joomla\Component\Elus\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;

class ElusModel extends AdminModel
{
    public function save($data)
    {
        $table = $this->getTable();
        
        if (empty($data['id'])) {
            $table->save($data);
        } else {
            $table->bind($data);
            $table->store();
        }
    }

    public function getTable($type = 'Elus', $prefix = 'ElusTable', $config = [])
    {
        return JTable::getInstance($type, $prefix, $config);
    }
}
