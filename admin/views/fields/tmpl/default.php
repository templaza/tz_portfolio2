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

<form id="adminForm" name="adminForm" method="post" action="index.php">


<fieldset id="filter-bar">
    <div class="filter-search fltlft">
        <label for="filter_search" class="filter-search-lbl"><?php echo JText::_('JSEARCH_FILTER_LABEL');?></label>
        <input type="text" title="<?php echo JText::_('COM_TZ_PORTFOLIO_FIELDS_SEARCH_DESC');?>"
               value="<?php echo $this -> filter_search;?>"
               id="filter_search"
               name="filter_search">
        <button type="submit"><?php echo JText::_('JSEARCH_FILTER_SUBMIT');?></button>
        <button onclick="document.id('filter_search').value='';this.form.submit();" type="button"><?php echo JText::_('JSEARCH_FILTER_CLEAR');?></button>
    </div>
    <div class="filter-select fltrt">

        <select name="filter_type" id="filter_type" onchange="Joomla.submitform();">
            <option value="0"><?php echo JText::_('COM_TZ_PORTFOLIO_OPTION_SELECT_TYPE')?></option>
            <option value="textfield"<?php echo ($this -> filter_type == 'textfield')?' selected="selected"':'';?>>
                <?php echo JText::_('COM_TZ_PORTFOLIO_TEXT_FIELD');?>
            </option>
            <option value="textarea"<?php echo ($this -> filter_type == 'textarea')?' selected="selected"':'';?>>
                <?php echo JText::_('COM_TZ_PORTFOLIO_TEXTAREA');?>
            </option>
            <option value="select"<?php echo ($this -> filter_type == 'select')?' selected="selected"':'';?>>
                <?php echo JText::_('COM_TZ_PORTFOLIO_DROP_DOWN_SELECTION');?>
            </option>
            <option value="multipleSelect"<?php echo ($this -> filter_type == 'multipleSelect')?' selected="selected"':'';?>>
                <?php echo JText::_('COM_TZ_PORTFOLIO_MULTI_SELECT_LIST');?>
            </option>
            <option value="radio"<?php echo ($this -> filter_type == 'radio')?' selected="selected"':'';?>>
                <?php echo JText::_('COM_TZ_PORTFOLIO_RADIO_BUTTONS');?>
            </option>
            <option value="checkbox"<?php echo ($this -> filter_type == 'checkbox')?' selected="selected"':'';?>>
                <?php echo JText::_('COM_TZ_PORTFOLIO_CHECK_BOX');?>
            </option>
            <option value="link"<?php echo ($this -> filter_type == 'link')?' selected="selected"':'';?>>
                <?php echo JText::_('COM_TZ_PORTFOLIO_LINK');?>
            </option>
<!--            <option value="file"--><?php //echo ($this -> filter_type == 'file')?' selected="selected"':'';?><!-->-->
<!--                File-->
<!--            </option>-->
<!--            <option value="date"--><?php //echo ($this -> filter_type == 'date')?' selected="selected"':'';?><!-->-->
<!--                Date-->
<!--            </option>-->
        </select>
        <select name="filter_group" id="filter_group" onchange="Joomla.submitform();">
            <option value="-1"><?php echo JText::_('COM_TZ_PORTFOLIO_OPTION_SELECT_GROUP')?></option>
            <?php
            if(count($this -> listsGroup)){
                foreach($this -> listsGroup as $item){
            ?>
                    <option
                        value="<?php echo $item -> id;?>"<?php echo ($item -> id == $this -> filter_group)?' selected="selected"':'';?>>
                        <?php echo $item -> name;?>
                    </option>
            <?php
                }
            }
            ?>
        </select>
        <?php echo JHTML::_('grid.state',$this -> filter_state);?>
    </div>
</fieldset>

<div class="clr"> </div>

    
  <table class="adminlist">
    <thead>
      <tr>
        <th width="1%">#</th>
        <th width="1%"><input type="checkbox" onclick="checkAll(<?php echo count($this -> lists);?>);" value="" name="toggle"></th>
        <th><?php echo JHTML::_('grid.sort','COM_TZ_PORTFOLIO_HEADING_NAME','f.name',$this -> order_Dir,$this -> order);?></th>
        <th width="20%"><?php echo JHTML::_('grid.sort','COM_TZ_PORTFOLIO_HEADING_GROUP','groupname',$this -> order_Dir,$this -> order);?></th>
        <th nowrap="nowrap" width="11%">
            <?php echo JHTML::_('grid.sort','JGRID_HEADING_ORDERING','f.ordering',$this -> order_Dir,$this -> order);?>
            <?php echo ($this -> order == 'f.ordering')?(JHTML::_('grid.order',$this -> lists)):'';?>
        </th>
        <th width="10%"><?php echo JHTML::_('grid.sort','COM_TZ_PORTFOLIO_HEADING_TYPE','f.type',$this -> order_Dir,$this -> order);?></th>
        <th width="10%"><?php echo JHTML::_('grid.sort','JSTATUS','f.published',$this -> order_Dir,$this -> order);?></th>
        <th nowrap="nowrap" width="1%"><?php echo JHTML::_('grid.sort','JGRID_HEADING_ID','f.id',$this -> order_Dir,$this -> order);?></th>
      </tr>
    </thead>
    <tbody>
    <?php
    if($this -> lists){
        $i=0;
        foreach($this -> lists as $item){
    ?>
    <tr class="row<?php echo ($i%2==1)?'1':$i;?>">
        <td class="center"><?php echo $i+1;?></td>
        <td class="center">
            <input type="checkbox" onclick="isChecked(this.checked);"
                       value="<?php echo $item -> id?>"
                       name="cid[]"
                       id="cb<?php echo $i;?>">
        </td>
        <td>
            <a href="index.php?option=<?php echo $this -> option?>&view=<?php echo $this -> view?>&task=edit&cid[]=<?php echo $item -> id;?>">
                <?php echo $item -> title;?>
            </a>
        </td>
        <td class="center"><?php echo $item -> groupname;?></td>
        <td class="order">
            <?php
            if($this -> order == 'f.ordering'){
            ?>
<!--            <span>-->
<!--                --><?php //echo $this -> pagination -> orderUpIcon($i,( $item -> groupid == @$this -> lists[$i-1] -> groupid ), 'orderup', 'Move Up', $this -> order);?>
<!--            </span>-->
<!--            <span>-->
<!--                --><?php //echo $this->pagination->orderDownIcon($i,count($this -> lists),( $item -> groupid == @$this->lists[$i+1] -> groupid ), 'orderdown', 'Move Down', $this -> order);?>
<!--            </span>-->
            <?php } ?>
            <input type="text"
                   name="order[]"
                   size="5"
                   value="<?php echo $item -> ordering;?>"
                   <?php echo ($this -> order != 'f.ordering')?' disabled="disabled"':'';?>
                   class="text-area-order">
        </td>
        <td class="center"><?php echo $item -> type;?></td>
        <td class="center"><?php echo JHTML::_('grid.published',$item -> published, $i);?></td>
        <td><?php echo $item -> id;?></td>
    </tr>
    <?php
            $i++;
        }
    }
    ?>

    </tbody>
    <tfoot>
      <tr>
        <td colspan="8">
            <?php echo $this -> pagination -> getListFooter();?>
        </td>
      </tr>
    </tfoot>
  </table>
  <input type="hidden" value="<?php echo $this -> option;?>" name="option">
  <input type="hidden" value="<?php echo $this -> view;?>" name="view">
  <input type="hidden" value="" name="task">
  <input type="hidden" value="0" name="boxchecked">
  <input type="hidden" value="<?php echo $this -> order;?>" name="filter_order">
  <input type="hidden" value="<?php echo $this -> order_Dir;?>" name="filter_order_Dir">
  <?php echo JHTML::_('form.token');?>