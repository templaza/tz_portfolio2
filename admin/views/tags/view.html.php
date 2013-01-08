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
jimport('joomla.application.component.view');

class TZ_PortfolioViewTags extends JView
{
    public $_task  = null;

    function display($tpl=null){
        $this -> _task  = JRequest::getCmd('task');
        $state  = $this -> get('State');

        $editor = &JFactory::getEditor();
        $this -> assign('editor',$editor);
        $this -> assign('order',$state -> filter_order);
        $this -> assign('order_Dir',$state -> filter_order_Dir);
        $this -> assign('filter_state',$state -> filter_state);
        $this -> assign('lists',$this -> get('Lists'));
        $this -> assign('listEdit',$this -> get('Edit'));
        $this -> assign('pagination',$this -> get('Pagination'));

        $this -> setToolbar();
        parent::display($tpl);
    }

    function setToolbar(){
        switch ($this -> _task){
            default:
                JToolBarHelper::title(JText::_('COM_TZ_PORTFOLIO_TAGS_MANAGER'));
                //JSubmenuHelper::addEntry(JText::_('Group fields'),$this -> _link,true);
                JToolBarHelper::addNewX();
                JToolBarHelper::editListX();
                JToolBarHelper::divider();
                JToolBarHelper::publishList();
                JToolBarHelper::unpublishList();
                JToolBarHelper::divider();
                JToolBarHelper::deleteListX(JText::_('COM_TZ_PORTFOLIO_QUESTION_DELETE?'));
                JToolBarHelper::preferences('com_tz_portfolio');
                break;
            case 'add':
            case 'new':
                JRequest::setVar('hidemainmenu',true);
                JToolBarHelper::title(JText::sprintf('COM_TZ_PORTFOLIO_TAGS_MANAGER_TASK','<small><small>['
                    .JText::_(ucfirst($this -> _task)).']</small></small>'));
                JToolBarHelper::save2new();
                JToolBarHelper::save();
                JToolBarHelper::apply();
                JToolBarHelper::cancel();
                break;
            case 'edit':
                JRequest::setVar('hidemainmenu',true);
                JToolBarHelper::title(JText::sprintf('COM_TZ_PORTFOLIO_TAGS_MANAGER_TASK','<small><small>['
                    .JText::_(ucfirst(JRequest::getCmd('task'))).']</small></small>'));
                JToolBarHelper::save();
                JToolBarHelper::save2new();
                JToolBarHelper::apply();
                JToolBarHelper::cancel('cancel',JText::_('JTOOLBAR_CLOSE'));
                break;

        }
    }
}
 
