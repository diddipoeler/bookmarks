<?php

defined('_JEXEC') or die();
?>
<div style="width:500px;">
<h2><?php echo JText::_('COM_BOOKMARKS_DIDDIPOELER_VIEW_CPANEL_WELCOME'); ?></h2>
<p>
<?php echo JText::_('COM_BOOKMARKS_DIDDIPOELER_VIEW_CPANEL_INTRO'); ?>
</p>
<br>

<div id="cpanel" style="float:left">
    <div style="float:left;">
            <div class="icon">
                <a href="index.php?option=com_dpcalendar&view=events" >
                <img src="<?php echo JURI::base(true);?>/../media/com_dpcalendar/images/admin/48-events.png" height="50px" width="50px">
                <span><?php echo JText::_('COM_DPCALENDAR_VIEW_CPANEL_EVENTS'); ?></span>
                </a>
            </div>
            <div class="icon">
                <a href="index.php?option=com_dpcalendar&view=event&layout=edit" >
                <img src="<?php echo JURI::base(true);?>/../media/com_dpcalendar/images/admin/48-event.png" height="50px" width="50px">
                <span><?php echo JText::_('COM_DPCALENDAR_VIEW_CPANEL_ADD_EVENT'); ?></span>
                </a>
            </div>
            <div class="icon">
                <a href="index.php?option=com_categories&extension=com_dpcalendar" >
                <img src="<?php echo JURI::base(true);?>/../media/com_dpcalendar/images/admin/48-dpcalendar.png" height="50px" width="50px">
                <span><?php echo JText::_('COM_DPCALENDAR_VIEW_CPANEL_CALENDARS'); ?></span>
                </a>
            </div>
            <div class="icon">
                <a href="index.php?option=com_dpcalendar&view=locations" >
                <img src="<?php echo JURI::base(true);?>/../media/com_dpcalendar/images/admin/48-locations.png" height="50px" width="50px">
                <span><?php echo JText::_('COM_DPCALENDAR_VIEW_CPANEL_LOCATIONS'); ?></span>
                </a>
            </div>
           
            <div class="icon">
                <a href="index.php?option=com_dpcalendar&view=tools" >
                <img src="<?php echo JURI::base(true);?>/../media/com_dpcalendar/images/admin/48-tools.png" height="50px" width="50px">
                <span><?php echo JText::_('COM_DPCALENDAR_SUBMENU_TOOLS'); ?></span>
                </a>
            </div>
            <div class="icon">
                <a href="index.php?option=com_dpcalendar&view=support" >
                <img src="<?php echo JURI::base(true);?>/../media/com_dpcalendar/images/admin/48-support.png" height="50px" width="50px">
                <span><?php echo JText::_('COM_DPCALENDAR_VIEW_CPANEL_SUPPORT'); ?></span>
                </a>
            </div>
            <div class="icon">
                <a href="index.php?option=com_dpcalendar&view=tools&layout=translate">
                <img src="<?php echo JURI::base(true);?>/../media/com_dpcalendar/images/admin/48-translation.png" height="50px" width="50px">
                <span><?php echo JText::_('COM_DPCALENDAR_VIEW_TOOLS_TRANSLATE'); ?></span>
                </a>
            </div>
    </div>
</div>
</div>


<div align="center" style="clear: both">
	<br>
	<?php echo sprintf(JText::_('COM_BOOKMARKS_DIDDIPOELER_FOOTER'), JRequest::getVar('DPCALENDAR_VERSION'));?>
</div>
