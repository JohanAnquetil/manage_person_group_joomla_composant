<?php
defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

$wa = $this->document->getWebAssetManager();
$wa->registerAndUseStyle('com_elus.admin', 'com_elus/admin.css');
?>

<div class="row">
    <div class="col-md-12">
        <h1><?php echo Text::_('COM_ELUS_DASHBOARD_TITLE'); ?></h1>
    </div>
</div>

<div class="row mt-4">
    <!-- Section Élus -->
    <div class="col-md-4">
        <div class="card dashboard-card">
            <div class="card-body text-center">
                <i class="icon-users dashboard-icon"></i>
                <h3><?php echo Text::_('COM_ELUS_DASHBOARD_ELUS'); ?></h3>
                <div class="btn-group">
                    <a href="<?php echo Route::_('index.php?option=com_elus&view=elus'); ?>" class="btn btn-primary">
                        <i class="icon-list"></i> <?php echo Text::_('COM_ELUS_DASHBOARD_VIEW_ALL'); ?>
                    </a>
                    <a href="<?php echo Route::_('index.php?option=com_elus&task=elu.add'); ?>" class="btn btn-success">
                        <i class="icon-plus"></i> <?php echo Text::_('COM_ELUS_DASHBOARD_ADD_NEW'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Syndicats -->
    <div class="col-md-4">
        <div class="card dashboard-card">
            <div class="card-body text-center">
                <i class="icon-flag dashboard-icon"></i>
                <h3><?php echo Text::_('COM_ELUS_DASHBOARD_SYNDICATS'); ?></h3>
                <div class="btn-group">
                    <a href="<?php echo Route::_('index.php?option=com_elus&view=syndicats'); ?>" class="btn btn-primary">
                        <i class="icon-list"></i> <?php echo Text::_('COM_ELUS_DASHBOARD_VIEW_ALL'); ?>
                    </a>
                    <a href="<?php echo Route::_('index.php?option=com_elus&task=syndicat.add'); ?>" class="btn btn-success">
                        <i class="icon-plus"></i> <?php echo Text::_('COM_ELUS_DASHBOARD_ADD_NEW'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Commissions -->
    <div class="col-md-4">
        <div class="card dashboard-card">
            <div class="card-body text-center">
                <i class="icon-tree-2 dashboard-icon"></i>
                <h3><?php echo Text::_('COM_ELUS_DASHBOARD_COMMISSIONS'); ?></h3>
                <div class="btn-group">
                    <a href="<?php echo Route::_('index.php?option=com_elus&view=commissions'); ?>" class="btn btn-primary">
                        <i class="icon-list"></i> <?php echo Text::_('COM_ELUS_DASHBOARD_VIEW_ALL'); ?>
                    </a>
                    <a href="<?php echo Route::_('index.php?option=com_elus&task=commission.add'); ?>" class="btn btn-success">
                        <i class="icon-plus"></i> <?php echo Text::_('COM_ELUS_DASHBOARD_ADD_NEW'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section Tutorial -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h3 class="mb-0"><i class="icon-info-circle"></i> <?php echo Text::_('COM_ELUS_DASHBOARD_TUTORIAL'); ?></h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4><?php echo Text::_('COM_ELUS_TUTORIAL_STEP1_TITLE'); ?></h4>
                        <p><?php echo Text::_('COM_ELUS_TUTORIAL_STEP1_DESC'); ?></p>
                    </div>
                    <div class="col-md-4">
                        <h4><?php echo Text::_('COM_ELUS_TUTORIAL_STEP2_TITLE'); ?></h4>
                        <p><?php echo Text::_('COM_ELUS_TUTORIAL_STEP2_DESC'); ?></p>
                    </div>
                    <div class="col-md-4">
                        <h4><?php echo Text::_('COM_ELUS_TUTORIAL_STEP3_TITLE'); ?></h4>
                        <p><?php echo Text::_('COM_ELUS_TUTORIAL_STEP3_DESC'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>