<?php

defined('_JEXEC') or die();

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$params = $this->form->getFieldsets('params');

// Get the form fieldsets.
$fieldsets = $this->form->getFieldsets();

?>

<form action="<?php echo JRoute::_('index.php?option=com_bookmarksdiddipoeler&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" >
 
<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_BOOKMARKSDIDDIPOELER_TABS_DETAILS'); ?></legend>
			<ul class="adminformlist">
			<?php foreach($this->form->getFieldset('details') as $field) :?>
				<li><?php echo $field->label; ?>
				<?php echo $field->input; 
                
                
                
                
                
                
                ?></li>
			<?php endforeach; ?>
			</ul>
		</fieldset>
	</div>
    
<div class="clr"></div>
 
	
 
	<div>
		<input type="hidden" name="task" value="bookmark.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
        
<div style="text-align: center; clear: both">
	<?php echo sprintf(JText::_('COM_BOOKMARKSDIDDIPOELER_FOOTER'), JRequest::getVar('BOOKMARKSDIDDIPOELER_VERSION'));?>
</div>
