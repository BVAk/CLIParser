<?php

namespace app;

class Url
{
    public $url='';
    public $domain;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function domainContent()
    {
       
        // Получение URL сайта.

        // Ограничение: минимальная длина ссылки 4 символа.
        if (strlen($this->url) < 4) {
            echo "\n\nПосилання введено не вірно!";
            exit();
        }

        $corectURL = preg_match('#http#', $this->url);

        if ($corectURL == 0) {
            $this->url = 'http://' . $this->url;
        }


    // Определяем домен
        $segment = explode('/', $this->url);
        $domain= $segment[2];

return $domain;}
public function siteContent()
{
    
        $curl = curl_init(); // создание нового ресурса cURL 
//установка параметров
        curl_setopt($curl, CURLOPT_URL, $this->url); // Установка url
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Позволяет сохранить ответ сервера в переменную а не выводить на экран.
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // Позволяет переходить по редиректам.

        $site = curl_exec($curl); // загрузка страницы и выдача ее браузеру

        return $site;
    }
}
?>