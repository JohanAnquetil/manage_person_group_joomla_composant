<?php
// administrator/components/com_elus/src/Table/ElusTable.php

namespace Joomla\Component\Elus\Administrator\Table;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class ElusTable extends Table
{
    /**
     * Constructeur de la table Elus.
     *
     * @param DatabaseDriver $db L'objet de la base de données.
     */
    public function __construct(DatabaseDriver $db)
    {
        parent::__construct('#__elus', 'id', $db);
    }
}
