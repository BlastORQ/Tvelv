<?php

$text = array();
$text[] = '{{сьогодні|вчора} {зранку|вночі|ввечері|після обіду|}} {я|мій {брат|друг|сусід|босс|знайомий} {|молюск|краб|прибиральник|сторож|шершень|джмілль|таракан}} {побіжав|пішов|поїхав} в {{цілодобовий|продуктовий} магазин|парк|аптеку} щоб {першим|} {купити|позичити|взяти в кредит|побачити} {костюм {сови|{людини павука|бетмена}|вінні-пуха|чебурашки|колобка}|диван|ковбасу|пилосос|вівцю|корову|автомобіль|двері|книгу п\'ятдесят відтінів сірого|із сиром пироги|пиріжки {|з капустою|з м\'ясом|з повидлом|з сиром}|хліб|масло|годинник|рибу|ковбасу|пакет|відро|москітну сітку}';

$text[] = '{Вафля|Печиво|Торт|Какао|Булочка|Круасан|Кекс|Цукерка|Тістечко|Пряник|Пиріг|Пиріжок|Шоколадка} - {це|} {страва|кондитерський виріб|річ|фкусняшка|вкусняшка|нямка|їжа|хавчик}, як{у|е|і} любить {Вася|Віка|наталя|Вікуся|Наталі|Коля|Юра|Бодя|Богдан|Олег|Макс|Святослав|Славік|Віталік|Сергій|Захар|Вадим|тато|мама|Наталя|Юля|Таня|Оля|Надя|хтось}{{,| і| та| й| -|;} {мій {брат|друг|дід|тато|таракан|босс|начальник|секретар|кіт|пес|однокласник|одногрупник|однокурсник|товариш}|моя {мама|сестра|баба|подружка|кішка|собака|нога|однокласниця|однокурсниця|одногрупниця}}|}{.|, {але це не точно|хоча я не впевнений|і це точно|це точно|найімовірніше|походу|і не тільки|і більше ніхто}{)|(|:)|:(|...|.}}';

$text[] = 'Чи {спостерігав|стежив|підозрював|розглядав|знімав|фотографував|малював|перемальовував|переслідував} {колись|якось|, бува, |} ти {палаючого|плачучого|червоного|жовтого |оранжевого|зеленого|синього|фіолетового||чорного|білого|голого|одягненого|смішного|смачного|огидного|підозрілого|пахучого|напівсонного|сонного|обережного|необережного|підозрілого|біжучого|сидячого|плаваючого|тонучого|лежачого|висячого|мертвого|страшного|кумедного|дивного|дивакуватого|кмітливого|розгубленого|зконцентрованого|обачного|необачного|незконцентрованого} {палаючого|плачучого|червоного|жовтого |оранжевого|зеленого|синього|фіолетового||чорного|білого|голого|одягненого|смішного|смачного|огидного|підозрілого|пахучого|напівсонного|сонного|обережного|необережного|підозрілого|біжучого|сидячого|плаваючого|тонучого|лежачого|висячого|мертвого|страшного|кумедного|дивного|дивакуватого|кмітливого|розгубленого|зконцентрованого|обачного|необачного|незконцентрованого} {єдинорога|коня|кота|пса|цуценя|птаха|орла|сича|депутата|актора|таргана|черв\'яка|слимака|молюска|кита|гриба|рибака|алкоголіка|прибиральника|сторожа|міліціонера|лікаря|вовка|художника|письменника|дизайнера|веб-розробника|хакера|спамера|геймера|ведмедя|школяра|студента|лоха|моржа|вчителя|директора|лектора|декана|фотографа|оператора|слідчого|суддю|адвоката|психа|навіженого|батька|діда|сина|дідуся|бармена|велосипедиста|байкера|бандита|мотоцикліста|чоловіка|злодія}?';

$str = $text[rand(0,count($text)-1)];
while(preg_match('#(?<!\\\)\{#', $str))
{
    $str = preg_replace_callback('#(?<!\\\)\{((?(?!\\\)[^\{]+?|[\s\S]+?))(?<!\\\)\}#', function($mathces)
    {
        $arr = preg_split('#(?<!\\\)\|#', $mathces[1]);
        return $arr[array_rand($arr)];
    }, $str);
}
$str = str_replace(array('\{', '\}', '\|'), array('{', '}', '|'), $str);
$answer = $str;
$str = wordwrap($str, 45, "\r\n");
?>