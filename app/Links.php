<?php

namespace app;
class Links
{
    // Поиск ссылок.
    public static function listLinks($site, $url)
    {
        $f_link=array();
     
        preg_match_all('#<a.+?href=".+?//' . DOMAIN . '(.+?)".+?>#', $site, $links);
        
        
         // Ищем сылки только на указаном домене.
        array_shift($links);

        foreach ($links[0] as $item) {
            $f_link[] = DOMAIN . $item;
        }

        $f_link = array_unique($f_link); // Проверка на дубливование.

        array_unshift($f_link, "Source link: " . $url . "\n");

        return $f_link;
    }
}