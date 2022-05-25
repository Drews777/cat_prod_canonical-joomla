<?php namespace App\Http\Controllers;

use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use App\Models\Content\Article;
use App\Models\Catalog\Filter;
use Illuminate\Http\Request;

class SitemapController extends Controller {
    private $xml;

    public $translit = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'yo',  'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'j',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'x',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shh',
        'ь' => 'mz',  'ы' => 'y',   'ъ' => 'tz',
        'э' => 'eh', 'ю' => 'yu',  'я' => 'ya',
        '-' => '6', '/' => '7',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'YO',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'J',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'X',   'Ц' => 'C',
        'Ч' => 'CH',  'Ш' => 'SH',  'Щ' => 'SHH',
        'Ь' => 'MZ',  'Ы' => 'Y',   'Ъ' => 'TZ',
        'Э' => 'EH',  'Ю' => 'YU',  'Я' => 'YA',

    );

    function Lat2ruEng($string){
        $string = strtr($string, $this->translit);
        $string = str_replace("20"," ",$string);
        $string = str_replace("19","(",$string);
        $string = str_replace("18",")",$string);
        $string = str_replace("6","-",$string);
        $string = str_replace("7","/",$string);
        return($string);
    }

    function Lat2ru($string){
        $string = strtr($string, array_flip($this->translit));

        $string = str_replace("20"," ",$string);
        $string = str_replace("19","(",$string);
        $string = str_replace("18",")",$string);
//        $string = str_replace("-"," ",$string);
        $string = str_replace("6","-",$string);
        $string = str_replace("0","ь",$string);
        $string = str_replace("7","/",$string);
        return($string);
    }


    function str2url($string){
        $string = strtr($string, $this->translit);

        $string = str_replace(" ","20",$string);
        $string = str_replace("(","19",$string);
        $string = str_replace(")","18",$string);
        $string = str_replace("'","0",$string);

        return($string);
    }

    function resort($array, $field){
        $res = array();
        $new_arr = [];
        foreach($array as $item)
            $new_arr[] = $item[$field];

        $unique = array_unique($new_arr);

        foreach($array as $key=> &$el){
            foreach($unique as $value){
                if($el[$field]==$value){
                    $res[$value][]=$el;
                }
            }

        }
        return isset($res) ? $res : false;
    }

    public function addChild($link, $priority = "1.0") {
        $url = $this->xml->addChild("url");
        $url->addChild('loc', url($link));
        $url->addChild('lastmod', date('Y-m-d'));
        $url->addChild('changefreq', 'daily');
        $url->addChild('priority', $priority);
    }

    public function getLink($category, $checbo) {
        $hash = [];

        if (isset($checbo['price'])){
            $hash[] = 'price__' . $checbo['price']['from'] . '-' . '' . $checbo['price']['to'];
        } 

        foreach ($checbo as $k => $checboxf) {
            $name = \App\Models\Catalog\Attribute::where('alias', $checboxf)->pluck('name')->first();
            $group_alias = \App\Models\Catalog\Attribute::where('alias', $checboxf)->pluck('group_alias');
            $group_attr = \App\Models\Catalog\AttributeGroups::where('alias', $group_alias)->pluck('name')->first();
            $aliases = \App\Models\Catalog\Attribute::where('alias', $checboxf)->pluck('group_alias');

            $enname = $this->str2url($name);
            if($group_attr == 'Материал внешний'){
                $checbo[$k] = [
                    'cat'   => 'mvs',
                    'value' => $this->str2url($name)
                ];
            }
            if($group_attr == 'Материал внутренний'){
                $checbo[$k] = [
                    'cat' => 'mvn',
                    'value' =>  $this->str2url($name)
                ];
            }
            if($group_attr == 'Материал подошвы'){
               $checbo[$k] = [
                   'cat' => 'mp',
                   'value' => $this->str2url($name)
               ];
            }
            if($group_attr == 'Сезонность'){
               $checbo[$k] = [
                   'cat' => 's',
                   'value' => $this->str2url($name)
               ];

            }
            if($group_attr == 'Высота'){
                $checbo[$k] = [
                    'cat' => 'visota',
                    'value' => $this->str2url($name)
                ];
            }
            if($group_attr == 'Страна производства'){
                $checbo[$k] = [
                    'cat' => 'c',
                    'value' => $this->str2url($name)
                ];
            }
            if($group_attr == 'Индивидуальная упаковка'){
                $checbo[$k] = [
                    'cat' => 'u',
                    'value' => $this->str2url($name)
                ];
            }
            if($group_attr == 'Варианты продажи'){
                $checbo[$k] = [
                    'cat' => 'var',
                    'value' => $this->str2url($name)
                ];
            }

            if(!isset($checbo[$k]['cat'])) {
                unset($checbo[$k]);
            }
        }

        $new_array = $this->resort($checbo, 'cat');
        $comma_separated = [];
        //отбросим все сомнения
        foreach ($new_array as $key => $new){
            foreach ($new as $y => $mvs){
                $comma_separated[$key][$y] = $mvs['value'];
            }
        }
        //а тут запихаем всё в хеш по чекбоксам
        foreach ($comma_separated as $keys => $_checkbox){
            //rub baby
            $hash[] = $keys.'__'.implode('--', $_checkbox);
        }

        $url = 'filters/' . implode('/', $hash);

        return route('filter', ['category' => $category->getPathString(), 'params' => $url]);
    }

    public function generate(Request $request) {
        set_time_limit(0);

        $this->xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

        /* Главная страница */
        $this->addChild(route('index'));



        /* Категории */
        $categories = Category::published()->get();
        $step = 100;
        $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 0;
        $skip = $step * $page;
        $max = $step * ($page + 1);
        $current_item = 0;
        $persent = (int)( ($skip / count($categories)) * 100);
        if($max < count($categories)) {
            echo "<p>Выгрузка, прогресс - {$skip}/" . count($categories);
            echo 	"<div style='width: 300px; height: 30px; border: 1px solid gray; margin: 10px 0; position: relative; text-align: center; line-height: 28px;'>" .
                "{$persent}%" .
                "<div style='background: #73ef73; height: 30px; width: {$persent}%; position: absolute; left: 0; top: 0; z-index: -1;'></div>" .
                "</div>";
        }
        foreach ($categories as $category) {
            if($category->alias == '00000000-0000-0000-0000-000000000000') continue;
            $current_item++;
            if( $current_item < $skip ) continue;
            if( $current_item >= $max ) {
                header('Refresh:1; URL=/sitemap/generate?page=' . ($page + 1));
                die();
            }

            $this->addChild($category->link(), "0.9");

            $filters = $category->getFilters();
            //$price_min = $category->products()->min('price');
            //$price_max = $category->products()->max('price');

            //$filter_variants[] = ['price' => ['from' => $price_min, 'to' => $price_max]];

            $filter_variants = [];
            foreach($filters as $filter){
                if($filter->values) {
                    foreach ($filter->values as $key => $value) {
                        $filter_variants[] = [$value->group_alias => [$value->attribute_alias]];
                    }
                }
            }

            $variants = $this->recursive($filter_variants);
            $links = [];
            foreach ($variants as $variant) {
                $combat = [];
                foreach ($variant as $item) {
                    $key = key($item);
                    if(!isset($combat[$key])) {
                        $combat[$key] = $item[$key];
                    } else {
                        $combat[$key] = array_merge($item[$key], $combat[$key]);
                    }
                }

                $links[] = $this->getLink($category, $combat);
            }
            $links = array_unique($links);

            foreach ($links as $key => $value) {
                $this->addChild($value, "0.8");
            }
        }

        /* Товары */
        $products = Product::published()->get();
        foreach ($products as $product) {
            $this->addChild($product->link(), "0.9");
        }

        $count = 0;
        $real_count = 0;
        $controller = new CatalogController($request);
        /* Фильтры */
        $start = microtime(true);



//        foreach ($categories as $category) {
//
//
//
//        }

        $articles = Article::get();
        foreach ($articles as $article) {
            $this->addChild($article->link(), "0.7");
        }

        $xmlDocument = new \DOMDocument('1.0');
        $xmlDocument->preserveWhiteSpace = false;
        $xmlDocument->formatOutput = true;
        $xmlDocument->loadXML($this->xml->asXML());

//        file_put_contents(public_path("sitemap1.xml"), $xmlDocument->saveXML());
        file_put_contents(public_path("sitemap.example"), $xmlDocument->saveXML());
        echo $count . "\n";
        echo $real_count;
        exit;
    }

    public function recursive($array, $current = false, $container = []) {
        if(!$current && $array) {
            $current = current($array);

            for($i = count($array); $i > 0; $i--) {
                $container[] = array_merge([$current], array_slice($array, $i, count($array)));
            }

            if(count($array) == 1 && $current) {
                return $container;
            }

            if(count($array) - 1) {
                array_shift($array);
                return $this->recursive($array, false, $container);
            }
        }
    }
}