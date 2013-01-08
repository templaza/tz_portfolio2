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

class TZ_PortfolioViewFields extends JView
{
    public $_option     = null;
    public $_view       = null;
    public $_link       = null;
    public $_task       = null;

    function display($tpl=null){

        $doc    = &JFactory::getDocument();
         //Get editor
        $editor =& JFactory::getEditor();
        $state  =   $this -> get('State');

        $this -> assignRef('lists',$this -> get(ucfirst($this -> _view)));
        $this -> assignRef('defvalue',$this -> get('Params'));
        //var_dump($this -> get('Params'));
        $this -> assignRef('listsEdit',$this -> get(ucfirst($this -> _view).'Edit'));
        $this -> assignRef('listsGroup',$this -> get('FieldsGroup'));
        $this -> assignRef('pagination',$this -> get('Pagination'));
        $this -> assignRef('editor',$editor);
        $this -> assignRef('option',$this -> _option);
        $this -> assignRef('view',$this -> _view);
        $this -> assignRef('order',$state -> filter_order);
        $this -> assignRef('order_Dir',$state -> filter_order_Dir);
        $this -> assignRef('filter_state',$state -> filter_state);
        $this -> assignRef('filter_type',$state -> filter_type);
        $this -> assignRef('filter_group',$state -> filter_group);
        $this -> assign('filter_search',$state -> filter_search);
        $this -> setToolBar();
        parent::display($tpl);
    }

    protected function setToolBar(){
        switch ($this -> _task){
            default:
                JToolBarHelper::title(JText::_('COM_TZ_PORTFOLIO_FIELDS_MANAGER'));
                //JSubmenuHelper::addEntry(JText::_('Fields'),$this -> _link,true);
                JToolBarHelper::publishList();
                JToolBarHelper::unpublishList();
                JToolBarHelper::addNewX();
                JToolBarHelper::editListX();
                JToolBarHelper::deleteListX(JText::_('COM_TZ_PORTFOLIO_QUESTION_DELETE'));
                JToolBarHelper::preferences('com_tz_portfolio');
                break;
            case 'add':
            case 'new':
                JRequest::setVar('hidemainmenu',true);
                JToolBarHelper::title(JText::sprintf('COM_TZ_PORTFOLIO_FIELDS_MANAGER_TASK','<small><small>['
                                               .JText::_(ucfirst($this-> _task)).']</small></small>'));
                JToolBarHelper::save2new();
                JToolBarHelper::save();
                JToolBarHelper::apply();
                JToolBarHelper::cancel();
                break;
            case 'edit':
                JRequest::setVar('hidemainmenu',true);
                JToolBarHelper::title(JText::sprintf('COM_TZ_PORTFOLIO_FIELDS_MANAGER_TASK','<small><small>['
                                               .JText::_(ucfirst($this-> _task)).']</small></small>'));
                JToolBarHelper::save();
                JToolBarHelper::save2new();
                JToolBarHelper::apply();
                JToolBarHelper::cancel('cancel',JText::_('JTOOLBAR_CLOSE'));
                break;
        }
    }
}