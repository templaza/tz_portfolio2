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

if (JFactory::getApplication()->isSite()) {
	JRequest::checkToken('get') or die(JText::_('JINVALID_TOKEN'));
}

require_once JPATH_ROOT . '/components/com_tz_portfolio/helpers/route.php';

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');

$function	= JRequest::getCmd('function', 'jSelectTag');
//var_dump($function); die();
$listOrder	= $this->order;
$listDirn	= $this->order_Dir;
?>

<form action="<?php echo JRoute::_('index.php?option=com_tz_portfolio&view=tags&layout=modal&tmpl=component&function='.$function.'&'.JSession::getFormToken().'=1');?>" method="post" name="adminForm" id="adminForm">
	<fieldset class="filter clearfix">
		<div class="left">
			<label for="filter_search">
				<?php echo JText::_('JSEARCH_FILTER_LABEL'); ?>
			</label>
			<input type="text" name="filter_search" id="filter_search" value="<?php echo JRequest::getCmd('filter_search'); ?>" size="30" title="<?php echo JText::_('COM_CONTENT_FILTER_SEARCH_DESC'); ?>" />

			<button type="submit">
				<?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></button>
			<button type="button" onclick="document.id('filter_search').value='';this.form.submit();">
				<?php echo JText::_('JSEARCH_FILTER_CLEAR'); ?></button>
		</div>

		<div class="right">
<!--			<select name="filter_access" class="inputbox" onchange="this.form.submit()">-->
<!--				<option value="">--><?php //echo JText::_('JOPTION_SELECT_ACCESS');?><!--</option>-->
<!--				--><?php //echo JHtml::_('select.options', JHtml::_('access.assetgroups'), 'value', 'text', $this->state->get('filter.access'));?>
<!--			</select>-->

			<select name="filter_published" class="inputbox" onchange="this.form.submit()">
				<option value=""><?php echo JText::_('JOPTION_SELECT_PUBLISHED');?></option>
				<?php echo JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->filter_state, true);?>
			</select>

<!--			<select name="filter_category_id" class="inputbox" onchange="this.form.submit()">-->
<!--				<option value="">--><?php //echo JText::_('JOPTION_SELECT_CATEGORY');?><!--</option>-->
<!--				--><?php //echo JHtml::_('select.options', JHtml::_('category.options', 'com_content'), 'value', 'text', $this->state->get('filter.category_id'));?>
<!--			</select>-->
<!---->
<!--			<select name="filter_language" class="inputbox" onchange="this.form.submit()">-->
<!--				<option value="">--><?php //echo JText::_('JOPTION_SELECT_LANGUAGE');?><!--</option>-->
<!--				--><?php //echo JHtml::_('select.options', JHtml::_('contentlanguage.existing', true, true), 'value', 'text', $this->state->get('filter.language'));?>
<!--			</select>-->
		</div>
	</fieldset>

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
                    <?php echo JHtml::_('grid.sort','Name','name',$this -> order_Dir,$this -> order);?>
                </th>
                <th nowrap="nowrap" width="1%">
                    <?php echo JHtml::_('grid.sort','Published','published',$this -> order_Dir,$this -> order);?>
                </th>
                <th nowrap="nowrap" width="1%">
                    <?php echo JHtml::_('grid.sort','ID','id',$this -> order_Dir,$this -> order);?>
                </th>
            </tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="15">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<?php if($this -> lists):?>
        <tbody>
            <?php $i=0;?>
            <?php foreach($this -> lists as $row):?>
                <tr class="row<?php echo $i%2;?>">
                    <td><?php echo $i+1;?></td>
                    <td>
                        <input type="checkbox" id="cb<?php echo $i;?>"
                               name="cid[]"
                               value="<?php echo $row -> id;?>"
                               onclick="isChecked(this.checked);">
                    </td>
                    <td>
                        <span class="editlinktip hasTip">
                            <a class="pointer"
                               onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $row->id; ?>', '<?php echo $this->escape(addslashes($row->name)); ?>', '', null, 'index.php?option=com_tz_portfolio&view=tags&id=<?php echo $row -> id;?>');"
                            >
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

	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>