<?php
/*------------------------------------------------------------------------

# TZ Portfolio Extension

# ------------------------------------------------------------------------

# author    DuongTVTemPlaza

# copyright Copyright (C) 2012 templaza.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.templaza.com

# Technical Support:  Forum - http://templaza.com/Forum

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

$options = array(
	JHtml::_('select.option', 'c', JText::_('JLIB_HTML_BATCH_COPY')),
	JHtml::_('select.option', 'm', JText::_('JLIB_HTML_BATCH_MOVE'))
);
$published	= $this->state->get('filter.published');
$extension	= $this->escape($this->state->get('filter.extension'));
?>
<fieldset class="batch">
	<legend><?php echo JText::_('COM_CATEGORIES_BATCH_OPTIONS');?></legend>
	<p><?php echo JText::_('COM_CATEGORIES_BATCH_TIP'); ?></p>
	<?php echo JHtml::_('batch.access');?>
	<?php echo JHtml::_('batch.language'); ?>

	<?php if ($published >= 0) : ?>
		<label id="batch-choose-action-lbl" for="batch-category-id">
			<?php echo JText::_('COM_CATEGORIES_BATCH_CATEGORY_LABEL'); ?>
		</label>
		<fieldset id="batch-choose-action" class="combo">
		<select name="batch[category_id]" class="inputbox" id="batch-category-id">
			<option value=""><?php echo JText::_('JSELECT') ?></option>
			<?php echo JHtml::_('select.options', JHtml::_('category.categories', $extension, array('filter.published' => $published)));?>
		</select>
		<?php echo JHtml::_( 'select.radiolist', $options, 'batch[move_copy]', '', 'value', 'text', 'm'); ?>
		</fieldset>
	<?php endif; ?>

	<button type="submit" onclick="submitbutton('category.batch');">
		<?php echo JText::_('JGLOBAL_BATCH_PROCESS'); ?>
	</button>
	<button type="button" onclick="document.id('batch-category-id').value='';document.id('batch-access').value='';document.id('batch-language-id').value=''">
		<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>
	</button>
</fieldset>
