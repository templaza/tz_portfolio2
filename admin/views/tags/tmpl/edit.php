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

//no direct access
defined('_JEXEC') or die('Restricted access');

?>
<script type="text/javascript ">
    Joomla.submitbutton = function (pressbutton) {
        var form = document.adminForm;
        if (pressbutton == 'cancel') {
            submitform( pressbutton );
            return;
        }

        // do field validation
        if ( form.name.value == "" ) {
            alert( "<?php echo JText::_( 'COM_TZ_PORTFOLIO_INPUT_TAG_NAME', true ); ?>" );
            form.name.focus();
        } else {
            submitform( pressbutton);
        }
    }
</script>
<form name="adminForm" method="post" action="index.php?option=com_tz_portfolio&view=tags">

    <div class="col width-100">
        <fieldset class="adminform">
            <legend><?php echo JText::_('COM_TZ_PORTFOLIO_FIELDSET_DETAILS');?></legend>
            <table class="admintable">
                <tbody>
                <tr>
                    <td class="key">
                        <label width="100" for="name">
                            <?php echo JText::_('COM_TZ_PORTFOLIO_NAME')?>
                            <span class="star"> *</span>
                        </label>
                    </td>
                    <td colspan="2">
                        <input type="text"
                               title=""
                               maxlength="255"
                               size="50"
                               value="<?php echo $this -> listEdit -> name;?>"
                               id="name"
                               name="name">
                    </td>
                </tr>
                <tr>
                    <td class="key">
                        <label width="100" for="published">
                            <?php echo JText::_('JPUBLISHED')?>
                        </label>
                    </td>
                    <td colspan="2">
                        <fieldset class="radio inputbox">
                            <?php echo JHTML::_('select.booleanlist','published','',$this -> listEdit -> published);?>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <td class="key" valign="top">
                        <label width="100" for="description">
                            <?php echo JText::_('COM_TZ_PORTFOLIO_DESCRIPTION');?>
                        </label>
                    </td>
                    <td>
                        <?php echo $this -> editor -> display('description',htmlspecialchars_decode($this -> listEdit -> description),'500', '300', '60', '20', array('pagebreak', 'readmore'));?>
                    </td>
                </tr>
                </tbody>
            </table>
        </fieldset>

    </div>
    <div class="clr"></div>

    <input type="hidden" value="com_tz_portfolio" name="option">
    <input type="hidden" value="<?php $cid=JRequest::getVar('cid',array(),'','array'); echo $cid[0];?>" name="cid[]">
    <input type="hidden" value="" name="task">
    <?php echo JHTML::_('form.token');?>
</form>