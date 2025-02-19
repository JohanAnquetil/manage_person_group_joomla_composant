<?php
namespace Joomla\Component\Elus\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

class ElusController extends BaseController
{
    public function display($cachable = false, $urlparams = [])
    {
        $view = $this->input->getCmd('view', 'elus');
        $this->input->set('view', $view);
        parent::display($cachable, $urlparams);
    }

    public function save()
    {
        $data = $this->input->getArray($_POST);
        $model = $this->getModel('Elus');
        $model->save($data);
        $this->setRedirect(JRoute::_('index.php?option=com_elus&view=elus', false));
    }
}
