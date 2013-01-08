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

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');

// Load the tooltip behavior.
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$canDo = TZ_PortfolioHelperUsers::getActions();

// Get the form fieldsets.
$fieldsets = $this->form->getFieldsets();

?>

<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'user.cancel' || document.formvalidator.isValid(document.id('user-form'))) {
			Joomla.submitform(task, document.getElementById('user-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_tz_portfolio&layout=edit&id='.(int) $this->item->id); ?>"
      method="post" name="adminForm"
      id="user-form"
      class="form-validate"
      enctype="multipart/form-data">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_USERS_USER_ACCOUNT_DETAILS'); ?></legend>
			<ul class="adminformlist">
			<?php foreach($this->form->getFieldset('user_details') as $field) :?>
				<li>
                    <?php echo $field->label; ?>
				    <?php echo $field->input; ?>
                </li>
                <?php if($field -> fieldname == 'name'):?>
                    <li>
                        <label><?php echo JText::_('COM_TZ_PORTFOLIO_USER_LINK_LABEL');?></label>
                        <input type="text"
                               name="url"
                               size="50"
                               value="<?php if($this -> listsUsers) echo $this -> listsUsers -> url;?>"
                        >
                    </li>
                    <li>
                        <label><?php echo JText::_('COM_TZ_PORTFOLIO_USER_FIELD_GENDER_LABEL');?></label>
                        <fieldset class="radio">
                            <input type="radio"
                                   name="gender"
                                   value="m"
                                   <?php if($this -> listsUsers AND $this -> listsUsers -> gender == 'm'): ?>
                                    checked="checked"
                                   <?php endif;?>
                            >
                            <label><?php echo JText::_('Male');?></label>
                            <input type="radio"
                                   name="gender"
                                   value="f"
                                   <?php if($this -> listsUsers AND $this -> listsUsers -> gender == 'f'): ?>
                                    checked="checked"
                                   <?php endif;?>
                            >
                            <label><?php echo JText::_('Female');?></label>
                        </fieldset>
                    </li>
                <?php endif;?>

                <?php if($this -> listsUsers):?>
                    <?php if($field -> fieldname == 'url_images' AND $this -> listsUsers -> images AND !empty($this -> listsUsers -> images)):?>
                        <li>
                            <label>&nbsp;</label>
                            <img src="<?php if($this -> listsUsers) echo $this -> listsUsers -> images;?>" style="width:120px;">
                            <input type="hidden" name="current_images"
                                   value="<?php if($this -> listsUsers) echo $this -> listsUsers -> imageName?>">
                        </li>
                        <li>
                            <label>&nbsp;</label>
                            <fieldset class="radio">
                                <input type="checkbox" name="delete_images" id="delete_images" value="1">
                                <label for="delete_images"><?php echo JText::_('COM_TZ_PORTFOLIO_DELETE_IMAGES');?></label>
                            </fieldset>
                        </li>
                    <?php endif;?>
                <?php endif;?>
			<?php endforeach; ?>
                <li>
                    <label><?php echo JText::_('COM_TZ_PORTFOLIO_TWITTER_LABEL');?></label>
                    <input type="text" name="url_twitter" size="40"
                           value="<?php if($this -> listsUsers) echo $this -> listsUsers -> twitter?>">
                </li>
                <li>
                    <label><?php echo JText::_('COM_TZ_PORTFOLIO_FACEBOOK_LABEL');?></label>
                    <input type="text" name="url_facebook" size="40"
                           value="<?php if($this -> listsUsers) echo $this -> listsUsers -> facebook?>">
                </li>
                <li>
                    <label><?php echo JText::_('COM_TZ_PORTFOLIO_GOOGLE_PLUS_LABEL');?></label>
                    <input type="text" name="url_google_one_plus" size="40"
                           value="<?php if($this -> listsUsers) echo $this -> listsUsers -> google_one?>">
                </li>
                <li>
                    <div class="clr"></div>
                    <label><?php echo JText::_('COM_TZ_PORTFOLIO_DESCRIPTION');?></label>
                    <div style="float: left;">
                        <?php echo $this -> editor -> display('description',($this -> listsUsers)?$this -> listsUsers -> description:'',500,250,50,60,array('article','image','readmore','pagebreak'));?>
                    </div>
                </li>
			</ul>
		</fieldset>

		<?php if ($this->grouplist) :?>
		<fieldset id="user-groups" class="adminform">
			<legend><?php echo JText::_('COM_USERS_ASSIGNED_GROUPS'); ?></legend>
			<?php echo $this->loadTemplate('groups');?>
		</fieldset>
		<?php endif; ?>
	</div>

	<div class="width-40 fltrt">
		<?php
		echo JHtml::_('sliders.start');
		foreach ($fieldsets as $fieldset) :
			if ($fieldset->name == 'user_details') :
				continue;
			endif;
			echo JHtml::_('sliders.panel', JText::_($fieldset->label), $fieldset->name);
		?>
		<fieldset class="panelform">
		<ul class="adminformlist">
		<?php foreach($this->form->getFieldset($fieldset->name) as $field): ?>
			<?php if ($field->hidden): ?>
				<?php echo $field->input; ?>
			<?php else: ?>
				<li><?php echo $field->label; ?>
				<?php echo $field->input; ?></li>
			<?php endif; ?>
		<?php endforeach; ?>
		</ul>
		</fieldset>
		<?php endforeach; ?>
		<?php echo JHtml::_('sliders.end'); ?>

		<input type="hidden" name="task" value="" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
