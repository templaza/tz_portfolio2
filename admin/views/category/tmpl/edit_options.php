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

// No direct access.
defined('_JEXEC') or die; ?>

<?php //echo JHtml::_('sliders.panel', JText::_('COM_TZ_PORTFOLIO_TZ_EXTRAFIELD_OPTIONS'), 'tz_fields-options'); ?>
<!--<fieldset class="panelform" id="tz_fieldset_fieds">-->
<!--    <ul class="adminformlist">-->
<!--        <li>-->
<!--            <label title="--><?php //echo JText::_('COM_TZ_PORTFOLIO_TZ_FIELDS_DESC');?><!--" class="hasTip"-->
<!--                   for="jform_params_tz_fieldsid" id="jform_params_tz_fieldsid-lbl">-->
<!--                --><?php //echo JText::_('COM_TZ_PORTFOLIO_TZ_FIELDS_CHOOSE')?>
<!--            </label>-->
<!--            <span id="tz_fieldsid_content"></span>-->
<!--        </li>-->
<!--    </ul>-->
<!--</fieldset>-->
    
<?php echo JHtml::_('sliders.panel', JText::_('JGLOBAL_FIELDSET_PUBLISHING'), 'publishing-details'); ?>

	<fieldset class="panelform">
		<ul class="adminformlist">

			<li><?php echo $this->form->getLabel('created_user_id'); ?>
			<?php echo $this->form->getInput('created_user_id'); ?></li>

			<?php if (intval($this->item->created_time)) : ?>
				<li><?php echo $this->form->getLabel('created_time'); ?>
				<?php echo $this->form->getInput('created_time'); ?></li>
			<?php endif; ?>

			<?php if ($this->item->modified_user_id) : ?>
				<li><?php echo $this->form->getLabel('modified_user_id'); ?>
				<?php echo $this->form->getInput('modified_user_id'); ?></li>

				<li><?php echo $this->form->getLabel('modified_time'); ?>
				<?php echo $this->form->getInput('modified_time'); ?></li>
			<?php endif; ?>

		</ul>
	</fieldset>

<?php $fieldSets = $this->form->getFieldsets('params');?>

<?php
foreach ($fieldSets as $name => $fieldSet) :
	$label = !empty($fieldSet->label) ? $fieldSet->label : 'COM_CATEGORIES_'.$name.'_FIELDSET_LABEL';
	echo JHtml::_('sliders.panel', JText::_($label), $name.'-options');
	if (isset($fieldSet->description) && trim($fieldSet->description)) :
		echo '<p class="tip">'.$this->escape(JText::_($fieldSet->description)).'</p>';
	endif;
	?>
	<fieldset class="panelform">
	<ul class="adminformlist">
        <li>
            <span></span>
        </li>
		<?php foreach ($this->form->getFieldset($name) as $field) : ?>
            <?php if($field -> name != 'jform[params][tz_fieldsid_content]'):?>
                <li>
                    <?php echo $field->label; ?>
                    <?php echo $field->input; ?>
                </li>
            <?php else:?>
                <li>
                    <?php echo $field->label; ?>
                    <span id="tz_fieldsid_content"></span>
                </li>
            <?php endif;?>
		<?php endforeach; ?>

		<?php if ($name=='basic'):?>
			<li><?php echo $this->form->getLabel('note'); ?>
			<?php echo $this->form->getInput('note'); ?></li>
		<?php endif;?>
	</ul>

	</fieldset>
<?php endforeach; ?>
