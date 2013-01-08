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
//require_once(JPATH_SITE.DS.'components'.DS.'com_tz_portfolio'.DS.'helpers'.DS.'route.php');

class TZ_PortfolioViewGallery extends JView
{
    function display($tpl=null){
        $doc    = &JFactory::getDocument();
        $doc -> addScript(JURI::root()."components/com_tz_portfolio/js/jquery-1.7.2.min.js");
        $doc -> addScript('components/com_tz_portfolio/js/jquery.tmpl.min.js');
        $doc -> addScript('components/com_tz_portfolio/js/jquery.kinetic.js');
        $doc -> addScript('components/com_tz_portfolio/js/jquery.easing.1.3.js');

        $doc -> addStyleSheet('components/com_tz_portfolio/css/portfolio_gallery.css');
        $params = $this -> get('State') -> get('params');
        $this -> assign('lists',$this -> get('Article'));
        $this -> assign('params',$params);
        parent::display($tpl);
    }
}
