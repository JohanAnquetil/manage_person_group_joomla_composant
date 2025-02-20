<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

HTMLHelper::_('behavior.multiselect');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo Route::_('index.php?option=com_elus&view=elus'); ?>" method="post" name="adminForm" id="adminForm">
    <table class="table table-striped">
        <thead>
            <tr>
                <th width="1%"><?php echo Text::_('ID'); ?></th>
                <th><?php echo Text::_('Nom'); ?></th>
                <th><?php echo Text::_('Prénom'); ?></th>
                <th><?php echo Text::_('Poste'); ?></th>
                <th><?php echo Text::_('CSEE'); ?></th>
                <th width="1%"><?php echo Text::_('Éditer'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->items as $i => $item) : ?>
                <tr>
                    <td><?php echo $item->id; ?></td>
                    <td><?php echo $item->nom; ?></td>
                    <td><?php echo $item->prenom; ?></td>
                    <td><?php echo $item->poste; ?></td>
                    <td><?php echo $item->cse_local; ?></td>
                    <td>
                        <a href="<?php echo Route::_('index.php?option=com_elus&task=elu.edit&id=' . $item->id); ?>">
                            <?php echo Text::_('Modifier'); ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <input type="hidden" name="task" value="" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>