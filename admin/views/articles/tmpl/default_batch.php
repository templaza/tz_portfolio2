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

$published = $this->state->get('filter.published');
?>
<fieldset class="batch">
	<legend><?php echo JText::_('COM_CONTENT_BATCH_OPTIONS');?></legend>
	<p><?php echo JText::_('COM_CONTENT_BATCH_TIP'); ?></p>
	<?php echo JHtml::_('batch.access');?>
	<?php echo JHtml::_('batch.language'); ?>

	<?php if ($published >= 0) : ?>
		<?php echo JHtml::_('batch.item', 'com_content');?>
	<?php endif; ?>

	<button type="submit" onclick="Joomla.submitbutton('article.batch');">
		<?php echo JText::_('JGLOBAL_BATCH_PROCESS'); ?>
	</button>
	<button type="button" onclick="document.id('batch-category-id').value='';document.id('batch-access').value='';document.id('batch-language-id').value=''">
		<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?>
	</button>
</fieldset>
