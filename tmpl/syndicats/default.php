<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;

$wa = $this->document->getWebAssetManager();
$wa->registerAndUseStyle('com_elus.admin', 'com_elus/admin.css');

HTMLHelper::_('behavior.multiselect');
HTMLHelper::_('bootstrap.tooltip');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn = $this->escape($this->state->get('list.direction'));
?>

<form action="<?php echo Route::_('index.php?option=com_elus'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <div class="col-md-12">
            <div id="j-main-container" class="j-main-container">
                <table class="table table-striped" id="syndicatsList">
                    <thead>
                        <tr>
                            <th class="w-1 text-center">
                                <?php echo HTMLHelper::_('grid.checkall'); ?>
                            </th>
                            <th scope="col" class="w-1 text-center">
                                <?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
                            </th>
                            <th>
                                <?php echo HTMLHelper::_('searchtools.sort', 'Nom', 'a.nom', $listDirn, $listOrder); ?>
                            </th>
                            <th>
                                <?php echo Text::_('Description'); ?>
                            </th>
                            <th>
                                <?php echo Text::_('Photo'); ?>
                            </th>
                            <th scope="col" class="w-5 d-none d-md-table-cell text-center">
                                <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->items as $i => $item) : 
                        $canEdit = true;
                    ?>
                        <tr class="row<?php echo $i % 2; ?>">
                            <td class="text-center">
                                <?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
                            </td>
                            <td class="text-center">
                                <?php echo HTMLHelper::_('jgrid.published', $item->published, $i, 'syndicats.', true); ?>
                            </td>
                            <td>
                                <?php if ($canEdit) : ?>
                                    <a href="<?php echo Route::_('index.php?option=com_elus&task=syndicat.edit&id=' . $item->id); ?>">
                                        <?php echo $this->escape($item->nom); ?>
                                    </a>
                                <?php else : ?>
                                    <?php echo $this->escape($item->nom); ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $this->escape($item->description); ?></td>
                            <td>
                                <?php if ($item->photo) : ?>
                                    <?php
                                        $image = HTMLHelper::_('image', $item->photo, $this->escape($item->nom), 
                                            ['class' => 'syndicat-logo', 'width' => '50', 'height' => '50']);
                                        echo $image;
                                    ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php echo $item->id; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

                <?php echo $this->pagination->getListFooter(); ?>

                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>">
                <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>