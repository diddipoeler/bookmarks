<?php
/**
 * @package    bookmark diddipoeler
 * @author     Dieter Plöger http://www.fussballineuropa.de
 * @copyright  Copyright (C) 2014 Dieter Plöger. All rights reserved.
 * @license    http://www.gnu.org/licenses/gpl.html GNU/GPL
 */

defined('_JEXEC') or die();

JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');

$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$canOrder	= $user->authorise('core.edit.state', 'com_bookmarksdiddipoeler.category');


?>

<form action="<?php echo JRoute::_('index.php?option=com_bookmarksdiddipoeler&view=bookmarks'); ?>" method="post" name="adminForm" id="adminForm">
<fieldset id="filter-bar">

<div class="filter-search fltlft">
			<label class="filter-search-lbl" for="filter_search"><?php echo JText::_('JSEARCH_FILTER_LABEL'); ?></label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo $this->escape($this->state->get('filter.search')); ?>"
				title="<?php echo JText::_('COM_DPCALENDAR_SEARCH_IN_TITLE'); ?>" />
                
<button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button"
				onclick="document.id('filter_search').value=''this.form.submit();">
				<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>
        
        <div class="filter-select fltrt">
        
      <select name="filter_category_id" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_CATEGORY');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('category.options', 'com_bookmarksdiddipoeler'), 'value', 'text', $this->state->get('filter.category_id'));?>
			</select>

		

            <select name="filter_access" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_ACCESS');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('access.assetgroups'), 'value', 'text', $this->state->get('filter.access'));?>
			</select>

			<select name="filter_language" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_LANGUAGE');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('contentlanguage.existing', true, true), 'value', 'text', $this->state->get('filter.language'));?>
			</select>
            
            <select name="filter_published" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.published'), true);?>
			</select>
                              
</div>
</fieldset>
	<div class="clr"> </div>
    
<table class="adminlist">
		<thead>
			<tr>
				<th width="">
					<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
				</th>
				<th class="title">
					<?php echo JHtml::_('grid.sort',  'JGLOBAL_TITLE', 'b.title', $listDirn, $listOrder); ?>
				</th>
                
                <th class="title">
					<?php echo JHtml::_('grid.sort',  'COM_BOOKMARKSDIDDIPOELER_PAGERANK', 'b.pagerank', $listDirn, $listOrder); ?>
				</th>
                <th><?php echo JText::_('COM_BOOKMARKSDIDDIPOELER_ADMIN_SNAPSHOTER_PIC'); ?>


				<th width="">
					<?php echo JHtml::_('grid.sort',  'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
				</th>
                <th width="">
					<?php echo JHtml::_('grid.sort',  'JCATEGORIES', 'category_title', $listDirn, $listOrder); ?>
				</th>

				<th width="">
					<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ACCESS', 'b.access', $listDirn, $listOrder); ?>
				</th>
				<th width="">
					<?php echo JHtml::_('grid.sort',  'JGLOBAL_HITS', 'b.hits', $listDirn, $listOrder); ?>
				</th>
				<th width="">
					<?php echo JHtml::_('grid.sort', 'JGRID_HEADING_LANGUAGE', 'b.language', $listDirn, $listOrder); ?>
				</th>
				<th width="" class="nowrap">
					<?php echo JHtml::_('grid.sort',  'JGRID_HEADING_ID', 'b.id', $listDirn, $listOrder); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="11">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
        
        <tbody>
		<?php foreach ($this->items as $i => $item)
		{
			$item->cat_link	= JRoute::_('index.php?option=com_categories&extension=com_bookmarksdiddipoeler&task=edit&type=other&cid[]=' . $item->catid);
			$canCreate	= $user->authorise('core.create',		'com_bookmarksdiddipoeler.category.' . $item->catid);
			$canEdit	= $user->authorise('core.edit',			'com_bookmarksdiddipoeler.category.' . $item->catid);
			$canCheckin	= $user->authorise('core.manage',		'com_checkin') || $item->checked_out == $user->get('id') || $item->checked_out == 0;
			$canChange	= $user->authorise('core.edit.state',	'com_bookmarksdiddipoeler.category.' . $item->catid) && $canCheckin;
            $published  = JHtml::_('grid.published',$item,$i, 'tick.png','publish_x.png','bookmarks.');
            
            //$rank_img = JURI::root(). 'components/com_bookmarks/images/gpr'.$item->pagerank.'.png';
            
			?>
			<tr class="row<?php echo $i % 2; ?>">
				<td class="center">
					<?php echo JHtml::_('grid.id', $i, $item->id); ?>
				</td>
				<td>
					<?php if ($item->checked_out)
					{ ?>
						<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'events.', $canCheckin); ?>
					<?php
					} ?>
					<?php if ($canEdit)
					{ ?>
						<a href="<?php echo JRoute::_('index.php?option=com_bookmarksdiddipoeler&task=bookmark.edit&id=' . (int) $item->id); ?>">
							<?php echo $this->escape($item->title); ?></a>
					<?php
					} else
					{ ?>
							<?php echo $this->escape($item->title); ?>
					<?php
					} ?>
					
				</td>
				
                <td class="">
						
									<?php
                                    $attribs = array();
                                    if ( $item->pagerank < 0 )
                                    {
                                        $url = JURI::root().'administrator/components/com_bookmarksdiddipoeler/assets/images/error.png';
                                    }
                                    else
                                    {
                                        $url = JURI::root().'administrator/components/com_bookmarksdiddipoeler/assets/images/gpr'.$item->pagerank.'.png';
                                    }
                    
$alt = $item->title;
$attribs['title'] = $item->title;
echo JHtml::_('image', $url, $alt, $attribs);

//									$imageTitle = JText::_('COM_SPORTSMANAGEMENT_ADMIN_LEAGUES_EDIT_DETAILS');
//									echo JHtml::_(	'image',JURI::root().'administrator/components/com_bookmarksdiddipoeler/assets/images/gpr'.$item->pagerank.'.png',
//													$imageTitle,'title= "'.$imageTitle.'"');
									?>
						
							</td>
       
       <td class="center">
					<?php 
                    $attribs = array();
                    $url = 'http://www.thumbshots.de/cgi-bin/show.cgi?url='.$item->url;
$alt = $item->title;
$attribs['width'] = '50px';
$attribs['title'] = $item->title;
echo JHtml::_('image', $url, $alt, $attribs);
                    
                    
//                    echo '<img style="" src="http://www.thumbshots.de/cgi-bin/show.cgi?url='.$item->url.'">'; ?>
				</td>
                

				<td class="center">
					<?php echo $published; ?>
				</td>
				<td class="center">
					<?php echo $this->escape($item->category_title); ?>
				</td>
				<td class="center">
					<?php echo $this->escape($item->access_level); ?>
				</td>
				<td class="center">
					<?php echo $item->hits; ?>
				</td>
				<td class="center nowrap">
					<?php if ($item->language == '*')
					{?>
						<?php echo JText::alt('JALL', 'language'); ?>
					<?php
					} else
					{?>
						<?php echo $item->language_title ? $this->escape($item->language_title) : JText::_('JUNDEFINED'); ?>
					<?php
					}?>
				</td>
				<td class="center">
					<?php echo (int) $item->id; ?>
				</td>
			</tr>
			<?php
			} ?>
		</tbody>
        
        
        
        
</table>        
        
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>

<div align="center" style="clear: both">
	<?php echo sprintf(JText::_('COM_BOOKMARKSDIDDIPOELER_FOOTER'), JRequest::getVar('BOOKMARKSDIDDIPOELER_VERSION'));?>
</div>
