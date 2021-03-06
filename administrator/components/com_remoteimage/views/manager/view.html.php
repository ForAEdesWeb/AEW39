<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_remoteimage
 *
 * @copyright   Copyright (C) 2012 Asikart. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Generated by AKHelper - http://asikart.com
 */

// no direct access
defined('_JEXEC') or die;

include_once AKPATH_COMPONENT.'/viewitem.php' ;

/**
 * View to edit
 */
class RemoteimageViewManager extends AKViewItem
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected 	$text_prefix = 'COM_REMOTEIMAGE';
	protected 	$items;
	protected 	$pagination;
	protected 	$state;
	
	public		$option 	= 'com_remoteimage' ;
	public		$list_name 	= 'managers' ;
	public		$item_name 	= 'manager' ;
	public		$sort_fields ;
	
	public 		$modal ;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$app = JFactory::getApplication() ;
		
		$this->params	= JComponentHelper::getParams('com_remoteimage') ;
		$this->canDo	= AKHelper::getActions($this->option);

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}
		
		if( JRequest::getVar('tmpl') == 'component' ) {
			$this->modal = true ;
		}else{
			$this->addToolbar();
		}
		
        
        $this->notice();
        

		parent::display($tpl) ;
	}

	
	
	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar()
	{
		AKToolBarHelper::title( JText::_('COM_REMOTEIMAGE_TITLE_MANAGER'), 'article-add.png');
		$canDo	= RMHelper::getActions($this->option);
		
		//parent::addToolbar();
		
		if ($canDo->get('core.admin')) {
			AKToolBarHelper::preferences($this->option);
		}
	}
    
    
    /**
     * function notice
     * @param 
     */
    public function notice()
    {
        $params = $this->params ;
        $redirect = false ;
        
        if( $params->get('Integrate_Override_InsertImageArticle', 1)
            || $params->get('Integrate_Override_MediaFormField', 1)
            || $params->get('Integrate_Override_MediaManager', 1)
          ) {
            $redirect = true ;
        }
        
        $enabled = JPluginHelper::isEnabled('system', 'remoteimage');
        
        if( $redirect && !$enabled ) {
            $msg = JText::_('COM_REMOTEIMAGE_SYSTEM_PLUGIN_NEED_ENABLED') . '<br />';
            $msg .= JHtml::link( JRoute::_('index.php?option=com_plugins&filter_search=remoteimage'), JText::_('COM_REMOTEIMAGE_GO_TO_PLUGINS') , array('target' => '_blank'));
            $app = JFactory::getApplication() ;
            $app->enqueueMessage($msg, 'warning');
        }
    }
	
	
	
	/*
	 * function handleFields
	 * @param 
	 */
	
	public function handleFields()
	{

	}
}
