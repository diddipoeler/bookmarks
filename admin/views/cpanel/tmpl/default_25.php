<?php
/**
 * @package    bookmark diddipoeler
 * @author     Dieter Plöger http://www.fussballineuropa.de
 * @copyright  Copyright (C) 2014 Dieter Plöger. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */
 
defined('_JEXEC') or die();
?>
<div style="width:500px;">
<h2><?php echo JText::_('COM_BOOKMARKSDIDDIPOELER_VIEW_CPANEL_WELCOME'); ?></h2>
<p>
<?php echo JText::_('COM_BOOKMARKSDIDDIPOELER_VIEW_CPANEL_INTRO'); ?>
</p>
<br>

<div id="cpanel" style="float:left">
    <div style="float:left;">
            <div class="icon">
                <a href="index.php?option=com_categories&extension=com_bookmarksdiddipoeler" >
                <img src="<?php echo JURI::base(true);?>/../media/com_dpcalendar/images/admin/48-events.png" height="50px" width="50px">
                <span><?php echo JText::_('COM_BOOKMARKSDIDDIPOELER_VIEW_CPANEL_CATEGORIES'); ?></span>
                </a>
            </div>
            
            <div class="icon">
                <a href="index.php?option=com_bookmarksdiddipoeler&view=bookmarks" >
                <img src="<?php echo JURI::base(true);?>/../media/com_dpcalendar/images/admin/48-locations.png" height="50px" width="50px">
                <span><?php echo JText::_('COM_BOOKMARKSDIDDIPOELER_VIEW_CPANEL_BOOKMARKS'); ?></span>
                </a>
            </div>
           
            
    </div>
</div>
</div>


<div align="center" style="clear: both">
	<br>
	<?php echo sprintf(JText::_('COM_BOOKMARKSDIDDIPOELER_FOOTER'), JRequest::getVar('BOOKMARKSDIDDIPOELER_VERSION'));?>
</div>
