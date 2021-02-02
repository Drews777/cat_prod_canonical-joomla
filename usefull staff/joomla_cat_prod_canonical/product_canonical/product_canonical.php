<?php
defined('_JEXEC') or die('Restricted access');
class plgJshoppingProductsProduct_canonical extends JPlugin{
    
    function __construct(&$subject, $config){
        parent::__construct($subject, $config);
    } 

    function onBeforeDisplayProduct(&$product){
        $document = JFactory::getDocument();
        $maincategory_id = $product->getCategory();
        $product_id = JRequest::getInt('product_id');
        $category_id = JRequest::getInt('category_id');

		if ($category_id!=$maincategory_id || $this->params->get('hidemain', '1') == 0){
            $url = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$maincategory_id.'&product_id='.$product_id);
            $document->addCustomTag('<link rel="canonical" href="http://babr38.ru'.$url.'"/>');
        }
    }
    
}