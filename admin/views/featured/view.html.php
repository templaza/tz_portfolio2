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

jimport('joomla.application.component.view');

/**
 * @package		Joomla.Administrator
 * @subpackage	com_content
 */
class TZ_PortfolioViewFeatured extends JView
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
        $lang   = &JFactory::getLanguage();
        $lang -> load('com_content');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state		= $this->get('State');

        require_once(JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'categories.php');
        $this -> assign('listGroup',TZ_PortfolioModelCategories::getFieldsGroup(true));
        
		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		$state	= $this->get('State');
		$canDo	= ContentHelper::getActions($this->state->get('filter.category_id'));

		JToolBarHelper::title(JText::_('COM_CONTENT_FEATURED_TITLE'), 'featured.png');

		if ($canDo->get('core.create')) {
			JToolBarHelper::addNew('article.add');
		}
		if ($canDo->get('core.edit')) {
			JToolBarHelper::editList('article.edit');
		}

		if ($canDo->get('core.edit.state')) {
			JToolBarHelper::divider();
			JToolBarHelper::publish('articles.publish', 'JTOOLBAR_PUBLISH', true);
			JToolBarHelper::unpublish('articles.unpublish', 'JTOOLBAR_UNPUBLISH', true);
			JToolBarHelper::divider();
			JToolBarHelper::archiveList('articles.archive');
			JToolBarHelper::checkin('articles.checkin');
			JToolBarHelper::custom('featured.delete', 'remove.png', 'remove_f2.png', 'JTOOLBAR_REMOVE', true);
		}

		if ($state->get('filter.published') == -2 && $canDo->get('core.delete')) {
			JToolBarHelper::deleteList('', 'articles.delete', 'JTOOLBAR_EMPTY_TRASH');
			JToolBarHelper::divider();
		} elseif ($canDo->get('core.edit.state')) {
			JToolBarHelper::divider();
			JToolBarHelper::trash('articles.trash');
		}

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_tz_portfolio');
//			JToolBarHelper::preferences('com_content');
			JToolBarHelper::divider();
		}
		JToolBarHelper::help('JHELP_CONTENT_FEATURED_ARTICLES');
	}
}
