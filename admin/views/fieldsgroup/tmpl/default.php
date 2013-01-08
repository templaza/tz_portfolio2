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
<form name="adminForm" method="post" action="index.php?option=com_tz_portfolio">

		<table>
            <tbody>
            <tr>
			<td align="left" width="100%">
				<?php echo JText::_('JSEARCH_FILTER_LABEL')?>
				<input type="text"
                       onchange="document.adminForm.submit();"
                       class="text_area"
                       value="<?php echo $this -> filter_search;?>"
                       id="filter_search"
                       name="filter_search">
				<button onclick="this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_SUBMIT');?></button>
				<button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();">
                    <?php echo JText::_('JSEARCH_FILTER_CLEAR');?>
                </button>
			</td>
<!--			<td nowrap="nowrap">-->
<!--                --><?php //echo JHTML::_('grid.state',$this -> filter_state);?>
<!--            </td>-->
            </tr>
            </tbody>
        </table>

    <table class="adminlist">
        <thead>
            <tr>
                <th width="10">#</th>
                <th width="10" class="title">
                    <input type="checkbox" onclick="checkAll(<?php echo count($this -> lists);?>);" value="" name="toggle">
                </th>
                <th class="title">
                   <?php echo JHTML::_('grid.sort','COM_TZ_PORTFOLIO_HEADING_NAME','name',$this -> order_Dir,$this -> order);?>
                </th>
                <th width="1%" nowrap="nowrap">
                    <?php echo JHTML::_('grid.sort','JGRID_HEADING_ID','id',$this -> order_Dir,$this -> order);?>
                </th>
            </tr>
        </thead>

        <tfoot>
            <tr>
                <td colspan="11">
                    <?php echo $this -> pagination -> getListFooter();?>
                </td>
            </tr>
        </tfoot>

        <tbody>
        <?php
        if($this -> lists){
            $i=0;
            foreach($this -> lists as $item){
        ?>
        <tr class="row<?php echo ($i%2==1)?'1':$i;?>">
            <td><?php echo $i+1;?></td>
            <td>
                <input type="checkbox" onclick="isChecked(this.checked);"
                       value="<?php echo $item -> id?>"
                       name="cid[]"
                       id="cb<?php echo $i;?>">
            </td>
            <td>
                <span class="editlinktip hasTip">
                    <a href="index.php?option=com_tz_portfolio&amp;view=fieldsgroup&amp;task=edit&amp;cid[]=<?php echo $item -> id;?>">
                        <?php echo $item -> name;?>
                    </a>
                </span>
            </td>
            <td align="center"><?php echo $item -> id;?></td>
        </tr>
        <?php
                $i++;
            }
        }
        ?>
        </tbody>

    </table>

    <input type="hidden" value="<?php echo $this -> option;?>" name="option">
    <input type="hidden" value="<?php echo $this -> view;?>" name="view">
    <input type="hidden" value="" name="task">
    <input type="hidden" value="0" name="boxchecked">
    <input type="hidden" value="<?php echo $this -> order;?>" name="filter_order">
    <input type="hidden" value="<?php echo $this -> order_Dir;?>" name="filter_order_Dir">
    <?php echo JHTML::_('form.token');?>
</form>
