<?php

namespace app;
class Links
{
    // Поиск ссылок.
    public static function listLinks($site, $url,$domain)
    {
        $f_link=array();
        preg_match_all(' /<a href="(.*?)"/s', $site, $links);
        
  
        
         // Ищем сылки только на указаном домене.
        array_shift($links);

        foreach ($links[0] as $item) {
            $corr=preg_match('#/'. $domain.'/#' , $item);
            $corr2=preg_match('#http#' , $item);
            if($corr==1){
            $f_link[] =$item;}
            else if($corr2==0){
                $f_link[] =$domain.'/'.$item;
            }
        }
          // Удаление лишних символов
          foreach ($f_link as $link) {
            $a[] = str_replace('/../../', '/', $link);
        }
        foreach ($a as $link) {
            $b[] = str_replace('/../', '/', $link);
        }
        foreach ($b as $link) {
            $f_urls_link[] = str_replace('//', '/', $link);
        }

        $f_link = array_unique($f_urls_link); // Проверка на дубливование.

        array_unshift($f_link, "Source link: " . $url . "\n", '');

        return $f_link;
    }
}