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
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgSystemTZ_Portfolio extends JPlugin {

    function onAfterInitialise(){
        $app		= &JFactory::getApplication();
        
        if($app -> isAdmin()){
            $option     = 'com_tz_portfolio';
            $curOption  = JRequest::getCmd('option');
            $curPath    = JURI::getInstance() -> toString();
            $view       = JRequest::getString('view');
            $extension  = JRequest::getString('extension');
            $newPath    = null;

            if($curOption == 'com_content' || $curOption == 'com_categories'){
                if($curOption == 'com_categories' && $extension == 'com_content')
                    $newPath    = str_replace($curOption,$option,$curPath);
                if($curOption == 'com_content')
                    $newPath    = str_replace($curOption,$option,$curPath);
                if($curOption == 'com_content' && !$view){
                    $newPath    .= '&view=articles';
                }

                if($curOption == 'com_categories' && $extension == 'com_content'){
                    $newPath    = str_replace('&extension='.$extension,'',$newPath);
                    $newPath    .= '&view=categories';
                }

                if($newPath){
                    $app -> redirect($newPath);
                }
            }
        }
    }


    // Extend user forms with TZ Portfolio fields
	function onAfterDispatch() {
        JFactory::getLanguage() -> load('com_tz_portfolio');
        $mainframe = &JFactory::getApplication();
        
		if($mainframe->isAdmin())return;

		$option = JRequest::getCmd('option');
		$view = JRequest::getCmd('view');
		$task = JRequest::getCmd('task');
		$layout = JRequest::getCmd('layout');
		$user = &JFactory::getUser();

        if($option == 'com_users' && $view == 'registration' && !$layout){
                require_once (JPATH_SITE.DS.'components'.DS.'com_users'.DS.'controller.php');
                $controller = new UsersController;
                $view = $controller->getView($view, 'html');
                $view->addTemplatePath(JPATH_SITE.DS.'components'
                                       .DS.'com_tz_portfolio'
                                       .DS.'views'.DS.'users'.DS.'tmpl');
                $view->setLayout('register');

                ob_start();
                $view->display();
                $contents = ob_get_clean();
                $document = &JFactory::getDocument();
                $document->setBuffer($contents, 'component');
        }
        if($user -> username && $option == 'com_users'
           && $view == 'profile' && $layout == 'edit'){

            require_once (JPATH_SITE.DS.'components'.DS.'com_users'.DS.'controller.php');
            $controller = new UsersController;
            $view = $controller->getView($view, 'html');
            $view->addTemplatePath(JPATH_SITE.DS.'components'
                                   .DS.'com_tz_portfolio'
                                   .DS.'views'.DS.'users'.DS.'tmpl');
            $view->setLayout('profile');

            require_once(JPATH_ADMINISTRATOR.DS.'components'
                         .DS.'com_tz_portfolio'.DS.'models'.DS.'user.php');
            $model  = new TZ_PortfolioModelUser;

            $userData   = $model -> getUsers($user -> id);

            $view -> assign('user',$user);
            $view -> assign('TZUser',$userData);

            ob_start();
            $view->display();
            $contents = ob_get_clean();
            $document = &JFactory::getDocument();
            $document->setBuffer($contents, 'component');
        }

    }
    
}
?>