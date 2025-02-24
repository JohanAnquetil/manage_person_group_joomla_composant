<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('behavior.keepalive');
?>

<form action="<?php echo Route::_('index.php?option=com_elus&layout=edit&id=' . (int) $this->item->id); ?>"
      method="post" name="adminForm" id="syndicat-form" class="form-validate">

    <div class="row">
        <div class="col-md-12">
            <?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', ['active' => 'details']); ?>
            <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', Text::_('Détails du syndicat')); ?>

            <div class="form-group">
                <?php echo $this->form->renderField('nom'); ?>
                <?php echo $this->form->renderField('description'); ?>
                <?php echo $this->form->renderField('photo'); ?>
            </div>

            <?php echo HTMLHelper::_('uitab.endTab'); ?>
            <?php echo HTMLHelper::_('uitab.endTabSet'); ?>

            <input type="hidden" name="jform[id]" value="<?php echo (int) $this->item->id; ?>" />

            <div class="form-actions">
                <button type="submit" class="btn btn-success">
                    <?php echo Text::_('Enregistrer'); ?>
                </button>
                <a href="<?php echo Route::_('index.php?option=com_elus&view=syndicats'); ?>" class="btn btn-secondary">
                    <?php echo Text::_('Annuler'); ?>
                </a>
            </div>
        </div>
    </div>

    <input type="hidden" name="task" value="">
    <?php echo HTMLHelper::_('form.token'); ?>
</form>