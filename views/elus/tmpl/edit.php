<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('behavior.formvalidator');
?>

<h1>Ajouter un élu</h1>

<form action="<?php echo Route::_('index.php?option=com_elus&task=elu.save'); ?>" method="post" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">
    <div>
        <?php foreach ($this->form->getFieldset() as $field) : ?>
            <div class="form-group">
                <?php echo $field->label; ?>
                <?php echo $field->input; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <input type="hidden" name="task" value="elu.save" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
