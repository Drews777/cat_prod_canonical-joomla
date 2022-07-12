<?php

class Subdomains {

    private static $_instance = null;
    

    private function __construct() {}

    protected function __clone() {}

    static public function getInstance() {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function replaceToponymShortcode($input) {
		$charset = mb_detect_encoding($input);
		$cur_domain = $_SERVER[SERVER_NAME] ;
		$str = iconv($charset, "UTF-8", $input);
		$url = $_SERVER['REQUEST_URI'];
		$urlavt = '/avtoservis/';
		if (!strstr($url, $urlavt)){
			$str = str_replace(' в Москве', ' '.$this->currentToponym, $str);
		}
        $str = str_replace('[CITY]', $this->currentToponym, $str);
		$str = str_replace('https://volvo-saab.ru/', 'https://'.$cur_domain.'/', $str);
		return $str;
    }   
}

$subd = Subdomains::getInstance();


//Массив городов по типу поддомен->название_города
$subd->subdomains = array(
	""=>"Москва",
	"spb"=>"Санкт-Петербург",
	"nsk"=>"Новосибирск",
	"ebk"=>"Екатеринбург",
	"nizhnij-novgorod"=>"Нижний Новгород",
	"chelyabinsk"=>"Челябинск",
	"omsk"=>"Омск",
	"samara"=>"Самара",
	"rostov-na-donu"=>"Ростов-на-Дону",
	"ufa"=>"Уфа",
	"krsk"=>"Красноярск",
	"perm"=>"Пермь",
	"voronezh"=>"Воронеж",
	"volgograd"=>"Волгоград",
	"krasnodar"=>"Краснодар",
	"saratov"=>"Саратов",
	"tyumen"=>"Тюмень",
	"tolyatti"=>"Тольятти",
	"izhevsk"=>"Ижевск",
	"barnaul"=>"Барнаул",
	"ulyanovsk"=>"Ульяновск",
	"irkutsk"=>"Иркутск",
	"habarovsk"=>"Хабаровск",
	"yaroslavl"=>"Ярославль",
	"vladivostok"=>"Владивосток",
	"mahachkala"=>"Махачкала",
	"tomsk"=>"Томск",
	"orenburg"=>"Оренбург",
	"kemerovo"=>"Кемерово",
	"novokuzneck"=>"Новокузнецк",
	"ryazan"=>"Рязань",
	"astrahan"=>"Астрахань",
	"naberezhnye-chelny"=>"Набережные Челны",
	"penza"=>"Пенза",
	"lipeck"=>"Липецк",
	"kirov"=>"Киров",
	"cheboksary"=>"Чебоксары",
	"tula"=>"Тула",
	"kaliningrad"=>"Калининград",
	"balashiha"=>"Балашиха",
	"kursk"=>"Курск",
	"sevastopol"=>"Севастополь",
	"ulan-udeh"=>"Улан-Удэ",
	"stavropol"=>"Ставрополь",
	"sochi"=>"Сочи",
	"tver"=>"Тверь",
	"magnitogorsk"=>"Магнитогорск",
	"ivanovo"=>"Иваново",
	"bryansk"=>"Брянск",
	"belgorod"=>"Белгород",
	"surgut"=>"Сургут",
	"vladimir"=>"Владимир",
	"nizhnij-tagil"=>"Нижний Тагил",
	"arhangelsk"=>"Архангельск",
	"chita"=>"Чита",
	"simferopol"=>"Симферополь",
	"kaluga"=>"Калуга",
	"smolensk"=>"Смоленск",
	"volzhskij"=>"Волжский",
	"saransk"=>"Саранск",
	"kurgan"=>"Курган",
	"cherepovec"=>"Череповец",
	"oryol"=>"Орёл",
	"vologda"=>"Вологда",
	"yakutsk"=>"Якутск",
	"vladikavkaz"=>"Владикавказ",
	"podolsk"=>"Подольск",
	"groznyj"=>"Грозный",
	"murmansk"=>"Мурманск",
	"tambov"=>"Тамбов",
	"sterlitamak"=>"Стерлитамак",
	"petrozavodsk"=>"Петрозаводск",
	"kostroma"=>"Кострома",
	"nizhnevartovsk"=>"Нижневартовск",
	"novorossijsk"=>"Новороссийск",
	"joshkar-ola"=>"Йошкар-Ола",
	"himki"=>"Химки",
	"taganrog"=>"Таганрог",
	"komsomolsk-na-amure"=>"Комсомольск-на-Амуре",
	"syktyvkar"=>"Сыктывкар",
	"nalchik"=>"Нальчик",
	"nizhnekamsk"=>"Нижнекамск",
	"shahty"=>"Шахты",
	"dzerzhinsk"=>"Дзержинск",
	"bratsk"=>"Братск",
	"orsk"=>"Орск",
	"ehngels"=>"Энгельс",
	"angarsk"=>"Ангарск",
	"blagoveshchensk"=>"Благовещенск",
	"staryj-oskol"=>"Старый Оскол",
	"korolyov"=>"Королёв",
	"velikij-novgorod"=>"Великий Новгород",
	"mytishchi"=>"Мытищи",
	"pskov"=>"Псков",
	"lyubercy"=>"Люберцы",
	"bijsk"=>"Бийск",
	"yuzhno-sahalinsk"=>"Южно-Сахалинск",
	"prokopevsk"=>"Прокопьевск",
	"armavir"=>"Армавир",
	"balakovo"=>"Балаково",
	"rybinsk"=>"Рыбинск",
	"abakan"=>"Абакан",
	"severodvinsk"=>"Северодвинск",
	"petropavlovsk-kamchatskij"=>"Петропавловск-Камчатск",
	"norilsk"=>"Норильск",
	"ussurijsk"=>"Уссурийск",
	"volgodonsk"=>"Волгодонск",
	"syzran"=>"Сызрань",
	"kamensk-uralskij"=>"Каменск-Уральский",
	"novocherkassk"=>"Новочеркасск",
	"zlatoust"=>"Златоуст",
	"krasnogorsk"=>"Красногорск",
	"ehlektrostal"=>"Электросталь",
	"almetevsk"=>"Альметьевск",
	"salavat"=>"Салават",
	"miass"=>"Миасс",
	"kerch"=>"Керчь",
	"nahodka"=>"Находка",
	"kopejsk"=>"Копейск",
	"pyatigorsk"=>"Пятигорск",
	"rubcovsk"=>"Рубцовск",
	"berezniki"=>"Березники",
	"kolomna"=>"Коломна",
	"majkop"=>"Майкоп",
	"hasavyurt"=>"Хасавюрт",
	"odincovo"=>"Одинцово",
	"kovrov"=>"Ковров",
	"kislovodsk"=>"Кисловодск",
	"domodedovo"=>"Домодедово",
	"neftekamsk"=>"Нефтекамск",
	"nefteyugansk"=>"Нефтеюганск",
	"batajsk"=>"Батайск",
	"novocheboksarsk"=>"Новочебоксарск",
	"serpuhov"=>"Серпухов",
	"shchyolkovo"=>"Щёлково",
	"novomoskovsk"=>"Новомосковск",
	"derbent"=>"Дербент",
	"pervouralsk"=>"Первоуральск",
	"cherkessk"=>"Черкесск",
	"orekhovo-zuevo"=>"Орехово-Зуево",
	"nazran"=>"Назрань",
	"nevinnomyssk"=>"Невинномысск",
	"kyzyl"=>"Кызыл",
	"kaspijsk"=>"Каспийск",
	"ramenskoe"=>"Раменское",
	"dimitrovgrad"=>"Димитровград",
	"obninsk"=>"Обнинск",
	"novyj-urengoj"=>"Новый Уренгой",
	"oktyabrskij"=>"Октябрьский",
	"kamyshin"=>"Камышин",
	"murom"=>"Муром",
	"dolgoprudnyj"=>"Долгопрудный",
	"essentuki"=>"Ессентуки",
	"novoshahtinsk"=>"Новошахтинск",
	"zhukovskij"=>"Жуковский",
	"seversk"=>"Северск",
	"noyabrsk"=>"Ноябрьск",
	"evpatoriya"=>"Евпатория",
	"artyom"=>"Артём",
	"pushkino"=>"Пушкино",
	"achinsk"=>"Ачинск",
	"elec"=>"Елец",
	"arzamas"=>"Арзамас",
	"reutov"=>"Реутов",
	"berdsk"=>"Бердск",
	"sergiev-posad"=>"Сергиев Посад",
	"ehlista"=>"Элиста",
	"noginsk"=>"Ногинск",
	"novokujbyshevsk"=>"Новокуйбышевск",
	"zheleznogorsk"=>"Железногорск",
    "kzn"=>"Казань"
);



//Массив городов по типу поддомен->топоним

$subd->toponyms = array(
	""=>"в Москве",
	"spb"=>"в Санкт-Петербурге",
	"nsk"=>"в Новосибирске",
	"ekb"=>"в Екатеринбург",
	"nizhnij-novgorod"=>"в Нижнем Новгороде",
	"chelyabinsk"=>"в Челябинске",
	"omsk"=>"в Омске",
	"samara"=>"в Самаре",
	"rostov-na-donu"=>"в Ростове-на-Дону",
	"ufa"=>"в Уфе",
	"krsk"=>"в Красноярске",
	"perm"=>"в Перми",
	"voronezh"=>"в Воронеже",
	"volgograd"=>"в Волгограде",
	"krasnodar"=>"в Краснодаре",
	"saratov"=>"в Саратове",
	"tyumen"=>"в Тюмени",
	"tolyatti"=>"в Тольятти",
	"izhevsk"=>"в Ижевске",
	"barnaul"=>"в Барнауле",
	"ulyanovsk"=>"в Ульяновске",
	"irkutsk"=>"в Иркутске",
	"habarovsk"=>"в Хабаровске",
	"yaroslavl"=>"в Ярославле",
	"vladivostok"=>"в Владивостоке",
	"mahachkala"=>"в Махачкале",
	"tomsk"=>"в Томске",
	"orenburg"=>"в Оренбурге",
	"kemerovo"=>"в Кемерово",
	"novokuzneck"=>"в Новокузнецке",
	"ryazan"=>"в Рязани",
	"astrahan"=>"в Астрахани",
	"naberezhnye-chelny"=>"в Набережных Челнах",
	"penza"=>"в Пензе",
	"lipeck"=>"в Липецке",
	"kirov"=>"в Кирове",
	"cheboksary"=>"в Чебоксарах",
	"tula"=>"в Туле",
	"kaliningrad"=>"в Калининграде",
	"balashiha"=>"в Балашихе",
	"kursk"=>"в Курске",
	"sevastopol"=>"в Севастополе",
	"ulan-udeh"=>"в Улан-Удэ",
	"stavropol"=>"в Ставрополе",
	"sochi"=>"в Сочи",
	"tver"=>"в Твери",
	"magnitogorsk"=>"в Магнитогорске",
	"ivanovo"=>"в Иваново",
	"bryansk"=>"в Брянске",
	"belgorod"=>"в Белгороде",
	"surgut"=>"в Сургуте",
	"vladimir"=>"во Владимире",
	"nizhnij-tagil"=>"в Нижнем Тагиле",
	"arhangelsk"=>"в Архангельске",
	"chita"=>"в Чите",
	"simferopol"=>"в Симферополе",
	"kaluga"=>"в Калуге",
	"smolensk"=>"в Смоленске",
	"volzhskij"=>"в Волжском",
	"saransk"=>"в Саранске",
	"kurgan"=>"в Кургане",
	"cherepovec"=>"в Череповце",
	"oryol"=>"в Орле",
	"vologda"=>"в Вологде",
	"yakutsk"=>"в Якутске",
	"vladikavkaz"=>"во Владикавказе",
	"podolsk"=>"в Подольске",
	"groznyj"=>"в Грозном",
	"murmansk"=>"в Мурманске",
	"tambov"=>"в Тамбове",
	"sterlitamak"=>"в Стерлитамаке",
	"petrozavodsk"=>"в Петрозаводске",
	"kostroma"=>"в Костроме",
	"nizhnevartovsk"=>"в Нижневартовске",
	"novorossijsk"=>"в Новороссийске",
	"joshkar-ola"=>"в Йошкар-Оле",
	"himki"=>"в Химках",
	"taganrog"=>"в Таганроге",
	"komsomolsk-na-amure"=>"в Комсомольск-на-Амуре",
	"syktyvkar"=>"в Сыктывкаре",
	"nalchik"=>"в Нальчике",
	"nizhnekamsk"=>"в Нижнекамске",
	"shahty"=>"в Шахтах",
	"dzerzhinsk"=>"в Дзержинске",
	"bratsk"=>"в Братске",
	"orsk"=>"в Орске",
	"ehngels"=>"в Энгельсе",
	"angarsk"=>"в Ангарске",
	"blagoveshchensk"=>"в Благовещенске",
	"staryj-oskol"=>"в Старом Осколе",
	"korolyov"=>"в Королёве",
	"velikij-novgorod"=>"в Великом Новгороде",
	"mytishchi"=>"в Мытищах",
	"pskov"=>"в Пскове",
	"lyubercy"=>"в Люберцах",
	"bijsk"=>"в Бийске",
	"yuzhno-sahalinsk"=>"в Южно-Сахалинске",
	"prokopevsk"=>"в Прокопьевске",
	"armavir"=>"в Армавире",
	"balakovo"=>"в Балаково",
	"rybinsk"=>"в Рыбинске",
	"abakan"=>"в Абакане",
	"severodvinsk"=>"в Северодвинске",
	"petropavlovsk-kamchatskij"=>"в Петропавловск-Камчатском",
	"norilsk"=>"в Норильске",
	"ussurijsk"=>"в Уссурийске",
	"volgodonsk"=>"в Волгодонске",
	"syzran"=>"в Сызрани",
	"kamensk-uralskij"=>"в Каменск-Уральске",
	"novocherkassk"=>"в Новочеркасске",
	"zlatoust"=>"в Златоусте",
	"krasnogorsk"=>"в Красногорске",
	"ehlektrostal"=>"в Электростали",
	"almetevsk"=>"в Альметьевске",
	"salavat"=>"в Салавате",
	"miass"=>"в Миассе",
	"kerch"=>"в Керчи",
	"nahodka"=>"в Находке",
	"kopejsk"=>"в Копейске",
	"pyatigorsk"=>"в Пятигорске",
	"rubcovsk"=>"в Рубцовске",
	"berezniki"=>"в Березниках",
	"kolomna"=>"в Коломне",
	"majkop"=>"в Майкопе",
	"hasavyurt"=>"в Хасавюрте",
	"odincovo"=>"в Одинцово",
	"kovrov"=>"в Коврове",
	"kislovodsk"=>"в Кисловодске",
	"domodedovo"=>"в Домодедово",
	"neftekamsk"=>"в Нефтекамске",
	"nefteyugansk"=>"в Нефтеюганске",
	"batajsk"=>"в Батайске",
	"novocheboksarsk"=>"в Новочебоксарске",
	"serpuhov"=>"в Серпухове",
	"shchyolkovo"=>"в Щёлково",
	"novomoskovsk"=>"в Новомосковске",
	"derbent"=>"в Дербенте",
	"pervouralsk"=>"в Первоуральске",
	"cherkessk"=>"в Черкесске",
	"orekhovo-zuevo"=>"в Орехово-Зуево",
	"nazran"=>"в Назрани",
	"nevinnomyssk"=>"в Невинномысске",
	"kyzyl"=>"в Кызыле",
	"kaspijsk"=>"в Каспийске",
	"ramenskoe"=>"в Раменском",
	"dimitrovgrad"=>"в Димитровграде",
	"obninsk"=>"в Обнинске",
	"novyj-urengoj"=>"в Новом Уренгое",
	"oktyabrskij"=>"в Октябрьском",
	"kamyshin"=>"в Камышине",
	"murom"=>"в Муроме",
	"dolgoprudnyj"=>"в Долгопрудном",
	"essentuki"=>"в Ессентуках",
	"novoshahtinsk"=>"в Новошахтинске",
	"zhukovskij"=>"в Жуковском",
	"seversk"=>"в Северске",
	"noyabrsk"=>"в Ноябрьске",
	"evpatoriya"=>"в Евпатории",
	"artyom"=>"в Артёме",
	"pushkino"=>"в Пушкино",
	"achinsk"=>"в Ачинске",
	"elec"=>"в Елеце",
	"arzamas"=>"в Арзамасе",
	"reutov"=>"в Реутове",
	"berdsk"=>"в Бердске",
	"sergiev-posad"=>"в Сергиевом Посаде",
	"ehlista"=>"в Элисте",
	"noginsk"=>"в Ногинске",
	"novokujbyshevsk"=>"в Новокуйбышевске",
	"zheleznogorsk"=>"в Железногорске",
	"kzn"=>"в Казани"
);


$subd->ssls = array(
	'spb'=>1,
	'nsk'=>1,
	'ekb'=>1,
	'nizhnij-novgorod'=>1,
	'chelyabinsk'=>1,
	'omsk'=>1,
	'samara'=>1,
	'rostov-na-donu'=>1,
	'ufa'=>1,
	'krsk'=>1,
	'perm'=>1,
	'voronezh'=>1,
	'volgograd'=>1,
	'krasnodar'=>1,
	'saratov'=>1,
	'tyumen'=>1,
	'tolyatti'=>1,
	'izhevsk'=>1,
	'barnaul'=>1,
	'ulyanovsk'=>1,
	'irkutsk'=>1,
	'habarovsk'=>1,
	'yaroslavl'=>1,
	'vladivostok'=>1,
	'mahachkala'=>1,
	'tomsk'=>1,
	'orenburg'=>1,
	'kemerovo'=>1,
	'novokuzneck'=>1,
	'ryazan'=>1,
	'astrahan'=>1,
	'naberezhnye-chelny'=>1,
	'penza'=>1,
	'lipeck'=>1,
	'kirov'=>1,
	'cheboksary'=>1,
	'tula'=>1,
	'kaliningrad'=>1,
	'balashiha'=>1,
	'kursk'=>1,
	'sevastopol'=>1,
	'ulan-udeh'=>1,
	'stavropol'=>1,
	'sochi'=>1,
	'tver'=>1,
	'magnitogorsk'=>1,
	'ivanovo'=>1,
	'bryansk'=>1,
	'belgorod'=>1,
	'surgut'=>1,
	'vladimir'=>1,
	'nizhnij-tagil'=>1,
	'arhangelsk'=>1,
	'chita'=>1,
	'simferopol'=>1,
	'kaluga'=>1,
	'smolensk'=>1,
	'volzhskij'=>1,
	'saransk'=>1,
	'kurgan'=>1,
	'cherepovec'=>1,
	'oryol'=>1,
	'vologda'=>1,
	'yakutsk'=>1,
	'vladikavkaz'=>1,
	'podolsk'=>1,
	'groznyj'=>1,
	'murmansk'=>1,
	'tambov'=>1,
	'sterlitamak'=>1,
	'petrozavodsk'=>1,
	'kostroma'=>1,
	'nizhnevartovsk'=>1,
	'novorossijsk'=>1,
	'joshkar-ola'=>1,
	'himki'=>1,
	'taganrog'=>1,
	'komsomolsk-na-amure'=>1,
	'syktyvkar'=>1,
	'nalchik'=>1,
	'nizhnekamsk'=>1,
	'shahty'=>1,
	'dzerzhinsk'=>1,
	'bratsk'=>1,
	'orsk'=>1,
	'ehngels'=>1,
	'angarsk'=>1,
	'blagoveshchensk'=>1,
	'staryj-oskol'=>1,
	'korolyov'=>1,
	'velikij-novgorod'=>1,
	'mytishchi'=>1,
	'pskov'=>1,
	'lyubercy'=>1,
	'bijsk'=>1,
	'yuzhno-sahalinsk'=>1,
	'prokopevsk'=>1,
	'armavir'=>1,
	'balakovo'=>1,
	'rybinsk'=>1,
	'abakan'=>1,
	'severodvinsk'=>1,
	'petropavlovsk-kamchatskij'=>1,
	'norilsk'=>1,
	'ussurijsk'=>1,
	'volgodonsk'=>1,
	'syzran'=>1,
	'kamensk-uralskij'=>1,
	'novocherkassk'=>1,
	'zlatoust'=>1,
	'krasnogorsk'=>1,
	'ehlektrostal'=>1,
	'almetevsk'=>1,
	'salavat'=>1,
	'miass'=>1,
	'kerch'=>1,
	'nahodka'=>1,
	'kopejsk'=>1,
	'pyatigorsk'=>1,
	'rubcovsk'=>1,
	'berezniki'=>1,
	'kolomna'=>1,
	'majkop'=>1,
	'hasavyurt'=>1,
	'odincovo'=>1,
	'kovrov'=>1,
	'kislovodsk'=>1,
	'domodedovo'=>1,
	'neftekamsk'=>1,
	'nefteyugansk'=>1,
	'batajsk'=>1,
	'novocheboksarsk'=>1,
	'serpuhov'=>1,
	'shchyolkovo'=>1,
	'novomoskovsk'=>1,
	'derbent'=>1,
	'pervouralsk'=>1,
	'cherkessk'=>1,
	'orekhovo-zuevo'=>1,
	'nazran'=>1,
	'nevinnomyssk'=>1,
	'kyzyl'=>1,
	'kaspijsk'=>1,
	'ramenskoe'=>1,
	'dimitrovgrad'=>1,
	'obninsk'=>1,
	'novyj-urengoj'=>1,
	'oktyabrskij'=>1,
	'kamyshin'=>1,
	'murom'=>1,
	'dolgoprudnyj'=>1,
	'essentuki'=>1,
	'novoshahtinsk'=>1,
	'zhukovskij'=>1,
	'seversk'=>1,
	'noyabrsk'=>1,
	'evpatoriya'=>1,
	'artyom'=>1,
	'pushkino'=>1,
	'achinsk'=>1,
	'elec'=>1,
	'arzamas'=>1,
	'reutov'=>1,
	'berdsk'=>1,
	'sergiev-posad'=>1,
	'ehlista'=>1,
	'noginsk'=>1,
	'novokujbyshevsk'=>1,
	'zheleznogorsk'=>1,
	'kzn'=>1,
	''=>1
);

$tmp = explode('.', $_SERVER['SERVER_NAME']);
$tmp = array_slice($tmp, 0, -2);
$subd->subdomain = implode(".", $tmp); //Текущий поддоме


foreach($subd->subdomains as $key => $value){
    $keys[] = $key;

}
if(!in_array($subd->subdomain, $keys) && !empty($subd->subdomain)){
    header('HTTP/1.0 404 Not Found');
    exit;
}
/*
if(empty($subd->subdomain)){
    $subd->subdomain = 'msk';  //Текущий поддомен
}
*/

$subd->currentCity = $subd->subdomains[$subd->subdomain];
$subd->currentToponym = $subd->toponyms[$subd->subdomain]; //Текущий топоним (название города в род. падеже)

//if (strpos(implode(",", $subd->ssls), $subd->subdomain) === false) {