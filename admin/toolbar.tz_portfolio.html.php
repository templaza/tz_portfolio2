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

class TOOLBAR_tz_portfolio
{
    function _DEFAULT(){
        switch(JRequest::getCmd('view',null)){
            default:
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_GROUP_FIELDS'),'index.php?option=com_tz_portfolio&view=fieldsgroup');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FIELDS'),'index.php?option=com_tz_portfolio&view=fields');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_CATEGORIES'),'index.php?option=com_tz_portfolio&view=categories');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_ARTICLES'),'index.php?option=com_tz_portfolio&view=articles',true);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FEATURED_ARTICLES'),'index.php?option=com_tz_portfolio&view=featured');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_TAGS'),'index.php?option=com_tz_portfolio&view=tags',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_USERS'),'index.php?option=com_tz_portfolio&view=users',false);
                break;
            case 'fieldsgroup':
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_GROUP_FIELDS'),'index.php?option=com_tz_portfolio&view=fieldsgroup',true);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FIELDS'),'index.php?option=com_tz_portfolio&view=fields',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_CATEGORIES'),'index.php?option=com_tz_portfolio&view=categories');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_ARTICLES'),'index.php?option=com_tz_portfolio&view=articles',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FEATURED_ARTICLES'),'index.php?option=com_tz_portfolio&view=featured',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_TAGS'),'index.php?option=com_tz_portfolio&view=tags',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_USERS'),'index.php?option=com_tz_portfolio&view=users',false);
                break;
            case 'fields':
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_GROUP_FIELDS'),'index.php?option=com_tz_portfolio&view=fieldsgroup',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FIELDS'),'index.php?option=com_tz_portfolio&view=fields',true);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_CATEGORIES'),'index.php?option=com_tz_portfolio&view=categories');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_ARTICLES'),'index.php?option=com_tz_portfolio&view=articles',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FEATURED_ARTICLES'),'index.php?option=com_tz_portfolio&view=featured');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_TAGS'),'index.php?option=com_tz_portfolio&view=tags',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_USERS'),'index.php?option=com_tz_portfolio&view=users',false);
                break;
            case 'categories':
//                JToolBarHelper::title(JText::_('COM_TZ_PORTFOLIO_CATEGORIES_MANAGER'),'categories.png');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_GROUP_FIELDS'),'index.php?option=com_tz_portfolio&view=fieldsgroup',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FIELDS'),'index.php?option=com_tz_portfolio&view=fields',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_CATEGORIES'),'index.php?option=com_tz_portfolio&view=categories',true);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_ARTICLES'),'index.php?option=com_tz_portfolio&view=articles',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FEATURED_ARTICLES'),'index.php?option=com_tz_portfolio&view=featured');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_TAGS'),'index.php?option=com_tz_portfolio&view=tags',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_USERS'),'index.php?option=com_tz_portfolio&view=users',false);
                break;
            case 'articles':
//                JToolBarHelper::title(JText::_('COM_TZ_PORTFOLIO_ARTICLES_MANAGER'),'article.png');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_GROUP_FIELDS'),'index.php?option=com_tz_portfolio&view=fieldsgroup',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FIELDS'),'index.php?option=com_tz_portfolio&view=fields',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_CATEGORIES'),'index.php?option=com_tz_portfolio&view=categories',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_ARTICLES'),'index.php?option=com_tz_portfolio&view=articles',true);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FEATURED_ARTICLES'),'index.php?option=com_tz_portfolio&view=featured');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_TAGS'),'index.php?option=com_tz_portfolio&view=tags',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_USERS'),'index.php?option=com_tz_portfolio&view=users',false);
                break;
            case 'featured':
//                JToolBarHelper::title(JText::_('COM_TZ_PORTFOLIO_ARTICLES_MANAGER'),'article.png');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_GROUP_FIELDS'),'index.php?option=com_tz_portfolio&view=fieldsgroup',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FIELDS'),'index.php?option=com_tz_portfolio&view=fields',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_CATEGORIES'),'index.php?option=com_tz_portfolio&view=categories',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_ARTICLES'),'index.php?option=com_tz_portfolio&view=articles',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FEATURED_ARTICLES'),'index.php?option=com_tz_portfolio&view=featured',true);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_TAGS'),'index.php?option=com_tz_portfolio&view=tags',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_USERS'),'index.php?option=com_tz_portfolio&view=users',false);
                break;
            case 'tags':
//                JToolBarHelper::title(JText::_('Tags Manager'),'generic.png');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_GROUP_FIELDS'),'index.php?option=com_tz_portfolio&view=fieldsgroup',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FIELDS'),'index.php?option=com_tz_portfolio&view=fields',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_CATEGORIES'),'index.php?option=com_tz_portfolio&view=categories',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_ARTICLES'),'index.php?option=com_tz_portfolio&view=articles',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FEATURED_ARTICLES'),'index.php?option=com_tz_portfolio&view=featured',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_TAGS'),'index.php?option=com_tz_portfolio&view=tags',true);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_USERS'),'index.php?option=com_tz_portfolio&view=users',false);
                break;
            case 'users':
//                JToolBarHelper::title(JText::_('Tags Manager'),'generic.png');
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_GROUP_FIELDS'),'index.php?option=com_tz_portfolio&view=fieldsgroup',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FIELDS'),'index.php?option=com_tz_portfolio&view=fields',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_CATEGORIES'),'index.php?option=com_tz_portfolio&view=categories',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_ARTICLES'),'index.php?option=com_tz_portfolio&view=articles',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_FEATURED_ARTICLES'),'index.php?option=com_tz_portfolio&view=featured',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_TAGS'),'index.php?option=com_tz_portfolio&view=tags',false);
                JSubmenuHelper::addEntry(JText::_('COM_TZ_PORTFOLIO_SUBMENU_USERS'),'index.php?option=com_tz_portfolio&view=users',true);
                break;

        }
        $doc    = &JFactory::getDocument();
        $doc -> addStyleSheet(JURI::base(JPATH_SITE).'/components/com_tz_portfolio/assets/style.css');
        // Special HTML workaround to get send popup working
        $videoTutorial    ='<a onclick="Joomla.popupWindow(\'http://www.youtube.com/channel/UCykS6SX6L2GOI-n3IOPfTVQ/videos\', \''
            .JText::_('COM_TZ_PORTFOLIO_VIDEO_TUTORIALS').'\', 800, 500, 1)"'.' href="#">'
            .'<span title="'.JText::_('COM_TZ_PORTFOLIO_VIDEO_TUTORIALS').'" class="icon-32-youtube"></span>'
            .JText::_('COM_TZ_PORTFOLIO_VIDEO_TUTORIALS').'</a>';
        $wikiTutorial    ='<a onclick="Joomla.popupWindow(\'http://wiki.templaza.com/Main_Page\', \''
            .JText::_('COM_TZ_PORTFOLIO_VIDEO_TUTORIALS').'\', 800, 500, 1)"'.' href="#">'
            .'<span title="'.JText::_('COM_TZ_PORTFOLIO_VIDEO_TUTORIALS').'" class="icon-32-wikipedia"></span>'
            .JText::_('COM_TZ_PORTFOLIO_WIKIPEDIA_TUTORIALS').'</a>';


        $bar=& JToolBar::getInstance( 'toolbar' );
        $bar->appendButton('Custom',$videoTutorial);
        $bar->appendButton('Custom',$wikiTutorial);
    }
}