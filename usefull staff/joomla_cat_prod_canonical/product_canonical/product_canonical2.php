<?php
defined('_JEXEC') or die('Restricted access');
//error_reporting(E_ALL);
//ini_set('display_errors','1');
class plgJshoppingProductsProduct_canonical extends JPlugin{

    function __construct(&$subject, $config){
        parent::__construct($subject, $config);
    } 

    function onBeforeDisplayProduct(&$product){
        $document = JFactory::getDocument();
        $maincategory_id = $product->getCategory();
        $product_id = JRequest::getInt('product_id');
        $category_id = JRequest::getInt('category_id');

        $menu = shopItemMenu::getInstance();
        $menu->init();
        $list = $menu->getListCategory();

        
        $category = JSFactory::getTable('category', 'jshop');
        $category->load($maincategory_id);

        $tree = $category->getTreeParentCategories();
        if($tree) {
        	$parent = $tree[0];
		} else {
			$parent = $maincategory_id;
		}

		$itemId = isset($list[$parent]) ? $list[$parent] : 0;


		if ($category_id!=$maincategory_id || $this->params->get('hidemain', '1') == 0){
			if(!$itemId) {
            	$url = SEFLink('index.php?option=com_jshopping&controller=product&task=view&category_id='.$maincategory_id.'&product_id='.$product_id);
        	} else {
        		$url = JRoute::_('index.php?option=com_jshopping&controller=product&task=view&category_id='.$maincategory_id.'&product_id='.$product_id.'&Itemid='.$itemId);
        	}
        	
            $document->addCustomTag('<link rel="canonical" href="https://kotli-omsk.ru'.$url.'"/>');
        }

//        $doc_data = $document->getHeadData();
//        $_url        = JURI::root();
//        $sch        = parse_url($_url, PHP_URL_SCHEME);
//        $server     = parse_url($_url, PHP_URL_HOST);
//        $canonical  = $_SERVER['REQUEST_URI'];
//        $newtag     = '<link rel="canonical" href="'.$sch.'://'.$server.$canonical.'"/>';
////
//        $replaced = false;
//        foreach ($doc_data['custom'] as $key=>$c) {
//            if (strpos($c, 'rel="canonical"')!==FALSE) {
//                $doc_data['custom'][$key] = $newtag;
//                $replaced = true;
//            }
//        }
//        if (!$replaced) {
//            $doc_data['custom'][] = $newtag;
//        }
    }

}