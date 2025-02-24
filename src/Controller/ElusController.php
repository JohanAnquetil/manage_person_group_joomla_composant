<?php
namespace Joomla\Component\Elus\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Utilities\ArrayHelper;  // Ajout de l'import manquant

class ElusController extends AdminController
{
    protected $text_prefix = 'COM_ELUS';

    public function getModel($name = 'Elu', $prefix = 'Administrator', $config = ['ignore_request' => true])
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function publish()
    {
        $this->checkToken();
        
        $cid = $this->input->get('cid', [], 'array');
        $data = ['publish' => 1, 'unpublish' => 0];
        $task = $this->getTask();
        $value = \array_key_exists($task, $data) ? $data[$task] : 0;

        if (empty($cid)) {
            $this->setMessage(Text::_('JERROR_NO_ITEMS_SELECTED'), 'warning');
        } else {
            $model = $this->getModel();
            $cid = ArrayHelper::toInteger($cid);
            
            if ($model->publish($cid, $value)) {
                $this->setMessage(Text::plural('COM_ELUS_N_ITEMS_' . ($value ? 'PUBLISHED' : 'UNPUBLISHED'), count($cid)));
            }
        }

        $this->setRedirect(Route::_('index.php?option=com_elus&view=elus', false));
    }
}
