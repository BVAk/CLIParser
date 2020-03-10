<?php
namespace app;
class Images
{
// Поиск картинок
    public function listImage($site, $url,$domain)
    {
        preg_match_all('/<img.+?src="(.*?)"/s', $site, $result);

        //Валидация сылок на картинки
        foreach ($result[1] as $item) {
            $corectSrc=preg_match('#http#',$item);
            if ($corectSrc== 0){
                $item = $domain . '/' . $item;
            }
            $pictures[] = $item;
        }

        // Удаление лишних символов
        foreach ($pictures as $pict) {
            $a[] = str_replace('/../../', '/', $pict);
        }
        foreach ($a as $pict) {
            $b[] = str_replace('/../', '/', $pict);
        }
        foreach ($b as $pict) {
            $f_pictures_link[] = str_replace('//', '/', $pict);
        }

        // Удаляем дубли из масива изображений.
        $f_pictures_link = array_unique($f_pictures_link);

        array_unshift(
            $f_pictures_link,
            "Source link: " . $url . "\n", ''
        );

        return $f_pictures_link;

    }
}

