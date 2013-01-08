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
<form action="index.php?option=com_tz_portfolio&view=tags" method="post" name="adminForm">

    <table>
        <tbody>
        <tr>
            <td width="100%" align="left">
                <?php echo JText::_('JSEARCH_FILTER_LABEL');?>
                <input type="text" name="search"
                       id="search"
                       value="<?php echo JRequest::getCmd('search')?>"
                       class="text_area"
                       onchange="document.adminForm.submit();">
                <button onclick="this.form.submit();"><?php echo JText::_('JSEARCH_FILTER_SUBMIT');?></button>
                <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_state').value='';this.form.submit();">
                    <?php echo JText::_('JSEARCH_FILTER_CLEAR');?>
                </button>
            </td>
            <td nowrap="nowrap">
                <?php echo JHtml::_('grid.state',$this -> filter_state);?>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="adminlist">
        <thead>
        <tr>
            <th width="10">#</th>
            <th width="10" class="title">
                <input type="checkbox" name="toggle"
                       value=""
                       onclick="checkAll(<?php echo count($this -> lists);?>);">
            </th>
            <th class="title">
                <?php echo JHtml::_('grid.sort','COM_TZ_PORTFOLIO_HEADING_NAME','name',$this -> order_Dir,$this -> order);?>
            </th>
            <th nowrap="nowrap" width="1%">
                <?php echo JHtml::_('grid.sort','JSTATUS','published',$this -> order_Dir,$this -> order);?>
            </th>
            <th nowrap="nowrap" width="1%">
                <?php echo JHtml::_('grid.sort','ID','id',$this -> order_Dir,$this -> order);?>
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

        <?php if($this -> lists):?>
        <tbody>
            <?php $i=0;?>
            <?php foreach($this -> lists as $row):?>
        <tr class="<?php echo ($i%2==0)?'row0':'row1';?>">
            <td><?php echo $i+1;?></td>
            <td>
                <input type="checkbox" id="cb<?php echo $i;?>"
                       name="cid[]"
                       value="<?php echo $row -> id;?>"
                       onclick="isChecked(this.checked);">
            </td>
            <td>
                        <span class="editlinktip hasTip">
                            <a href="index.php?option=com_tz_portfolio&amp;view=tags&amp;task=edit&amp;cid[]=<?php echo $row -> id;?>">
                                <?php echo $row -> name;?>
                            </a>
                        </span>
            </td>
            <td align="center"><?php echo JHtml::_('grid.published',$row -> published,$i);?></td>
            <td align="center"><?php echo $row -> id;?></td>
        </tr>
            <?php $i++;?>
            <?php endforeach;?>
        </tbody>
        <?php endif;?>

    </table>

    <input type="hidden" name="option" value="com_tz_portfolio">
    <input type="hidden" name="view" value="tags">
    <input type="hidden" name="task" value="">
    <input type="hidden" name="boxchecked" value="0">
    <input type="hidden" name="filter_order" value="<?php echo $this -> order;?>">
    <input type="hidden" name="filter_order_Dir" value="<?php echo $this -> order_Dir;?>">
    <?php echo JHtml::_('form.token');?>
</form>