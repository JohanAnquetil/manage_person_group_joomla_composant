<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

HTMLHelper::_('behavior.multiselect');
?>

<form action="<?php echo Route::_('index.php?option=com_elus&view=commissions'); ?>" method="post" name="adminForm" id="adminForm">
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="1%"><?php echo HTMLHelper::_('grid.checkall'); ?></th>
                <th width="1%"><?php echo Text::_('ID'); ?></th>
                <th><?php echo Text::_('Nom'); ?></th>
                <th><?php echo Text::_('Description'); ?></th>
                <th width="1%"><?php echo Text::_('Éditer'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php foreach ($this->items as $i => $item) : ?>
                    <tr>
                        <td><?php echo HTMLHelper::_('grid.id', $i, $item->id); ?></td>
                        <td><?php echo $item->id; ?></td>
                        <td><?php echo $item->nom; ?></td>
                        <td><?php echo $item->description; ?></td>
                        <td>
                            <a href="<?php echo Route::_('index.php?option=com_elus&task=commission.edit&id=' . $item->id); ?>">
                                <?php echo Text::_('Modifier'); ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>