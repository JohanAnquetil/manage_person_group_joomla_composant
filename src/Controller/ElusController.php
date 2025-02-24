<?php
namespace Joomla\Component\Elus\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\Language\Text;

class ElusController extends AdminController
{
    /**
     * Proxy pour getModel
     */
    public function getModel($name = 'Elu', $prefix = 'Administrator', $config = array('ignore_request' => true))
    {
        return parent::getModel($name, $prefix, $config);
    }

    public function delete()
    {
        $input = \Joomla\CMS\Factory::getApplication()->input;
        $ids = $input->get('cid', [], 'array');

        if ($ids) {
            $model = $this->getModel();
            if ($model->delete($ids)) {
                $this->setMessage('Élus supprimés avec succès.');
            } else {
                $this->setMessage('Échec de la suppression.', 'error');
            }
        }

        $this->setRedirect('index.php?option=com_elus&view=elus');
    }
}
