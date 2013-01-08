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
 
$doc    = &JFactory::getDocument();
$doc -> addStyleSheet('components/com_tz_portfolio/css/tz_portfolio.css');

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$lang   = &JFactory::getLanguage();
$lang -> load('com_tz_portfolio',JPATH_ADMINISTRATOR);

?>

<div class="registration">
	<?php if ($this->params->get('show_page_heading')) : ?>
	    <h1><span><?php echo $this->escape($this->params->get('page_heading')); ?></span></h1>
    <?php endif; ?>
	<form class="form-validate"
          method="post"
          autocomplete="off"
          action="<?php echo JRoute::_('index.php?'); ?>"
          id="member-profile"
            enctype="multipart/form-data">
        <?php foreach ($this->form->getFieldsets() as $group => $fieldset):// Iterate through the form fieldsets and display each one.?>
        <?php $fields = $this->form->getFieldset($group);?>
        <?php if (count($fields)):?>
        <fieldset>
            <?php if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.
            ?>
                <legend><?php echo JText::_($fieldset->label);?></legend>
            <?php endif;?>
            <table class="tz_portfolio_user_register">
                <?php foreach($fields as $field):// Iterate through the fields in the set and display them.?>
                    <?php if ($field->hidden):// If the field is hidden, just display the input.?>
                        <tr><td><?php echo $field->input;?></td></tr>
                    <?php else:?>
                        <tr>
                            <td>
                                <?php echo $field->label; ?>
                                <?php if (!$field->required && $field->type!='Spacer'): ?>
                                    <span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL'); ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo ($field->type!='Spacer') ? $field->input : "&#160;"; ?></td>
                        </tr>

                        <?php if(($field-> fieldname) == 'email2'):?>
                            <tr>
                                <td>
                                    <label title="<?php echo JText::_('COM_TZ_PORTFOLIO_USER_FIELD_GENDER_LABEL');?>::<?php echo JText::_('COM_TZ_PORTFOLIO_USER_FIELD_GENDER_LABEL_DESC');?>"
                                       class="hasTip required"
                                       >
                                    <?php echo JText::_('COM_TZ_PORTFOLIO_USER_FIELD_GENDER_LABEL');?>
                                </label>
                                </td>
                                <td class="tz_radio">
                                    <input type="radio"
                                       id="jform_gender1"
                                       name="gender"
                                       value="m"
                                        <?php if($this -> TZUser AND $this -> TZUser -> gender == 'm') echo ' checked="checked"';?>
                                    >
                                    <label for="jform_gender1"><?php echo JText::_('Male');?></label>

                                    <input type="radio"
                                       id="jform_gender2"
                                       name="gender"
                                       value="f"
                                        <?php if($this -> TZUser AND $this -> TZUser -> gender == 'f') echo ' checked="checked';?>
                                    >
                                    <label for="jform_gender2"><?php echo JText::_('Female');?></label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label id="jform_client_images-lbl"
                                           class=""
                                           for="jform_client_images"
                                           aria-invalid="false">
                                        <?php echo JText::_('COM_TZ_PORTFOLIO_USER_FIELD_CLIENT_IMAGES_LABEL')?>
                                    </label>

                                </td>
                                <td>
                                    <input id="jform_client_images"
                                            type="file"
                                           size="50"
                                           name="jform[client_images]"
                                           class="">
                                </td>
                            </tr>

                            <?php if($this -> TZUser AND !empty($this -> TZUser -> images)):?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <img src="<?php echo $this -> TZUser -> images;?>" style="max-width:120px;"/>
                                        <input type="hidden" name="current_images"
                                               value="<?php echo $this -> TZUser -> imageName?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                        <input type="checkbox" name="delete_images" value="1">
                                            <label><?php echo JText::_('COM_TZ_PORTFOLIO_DELETE_IMAGES');?></label>
                                    </td>
                                </tr>
                            <?php endif;?>

                            <tr>
                                <td>
                                    <label id="jform_url_images-lbl"
                                           class=""
                                           for="jform_url_images"
                                           aria-invalid="false">
                                        <?php echo JText::_('COM_TZ_PORTFOLIO_USER_FIELD_URL_IMAGES_LABEL');?></label>
                                </td>
                                <td>
                                    <input id="jform_url_images"
                                           class=""
                                           type="text" size="40"
                                           value=""
                                           name="jform[url_images]"
                                           aria-invalid="false">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><?php echo JText::_('COM_TZ_PORTFOLIO_TWITTER_LABEL');?></label>
                                </td>
                                <td>
                                    <input type="text" name="url_twitter" size="40"
                                           value="<?php if($this -> TZUser) echo $this -> TZUser -> twitter?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><?php echo JText::_('COM_TZ_PORTFOLIO_FACEBOOK_LABEL');?></label>
                                </td>
                                <td>
                                    <input type="text" name="url_facebook" size="40"
                                           value="<?php if($this -> TZUser) echo $this -> TZUser -> facebook;?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label><?php echo JText::_('COM_TZ_PORTFOLIO_GOOGLE_PLUS_LABEL');?></label>
                                </td>
                                <td>
                                    <input type="text" name="url_google_one_plus" size="40"
                                           value="<?php if($this -> TZUser) echo $this -> TZUser -> google_one;?>">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php echo JText::_('COM_TZ_PORTFOLIO_DESCRIPTION');?></label>
                                </td>
                                <td>
                                    <textarea rows="10" cols="50" name="description"><?php if($this -> TZUser) echo $this -> TZUser -> description;?></textarea>
                                </td>
                            </tr>
                        <?php endif;?>
                    <?php endif;?>
                <?php endforeach;?>
            </table>

        </fieldset>
        <?php endif;?>
        <?php endforeach;?>

        <div>
            <button class="validate" type="submit"><span><?php echo JText::_('JSUBMIT'); ?></span></button>
            <?php echo JText::_('COM_USERS_OR'); ?>
            <a href="<?php echo JRoute::_(''); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>

            <input type="hidden" value="<?php echo $this -> user -> id;?>" id="jform_id" name="jform[id]">
            <input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="profile.save" />
            <?php echo JHTML::_('form.token');?>
        </div>
	</form>
</div>