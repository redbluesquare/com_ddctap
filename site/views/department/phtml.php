<?php
 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 
 
//Display partial views
class DdctapViewsDepartmentPhtml extends JViewHTML
{
  function render()
  {
  	$this->params = JComponentHelper::getParams('com_ddctap');
    return parent::render();
  }
}
