<?php
namespace app;
class Report
{
    // Запись найденых даных в файл CSV.
    public function reportCSV($date, $adres)
    {
        $fp = fopen($adres, 'a');
        foreach ($date as $string) {
            $dates[] = $string . "\n";
        }
        fputcsv($fp, $dates);
        fclose($fp);
    }

    public function viewsReportCSV($domain)
    {
    // Валидация домена.
        $corect_domain = preg_match('#http#', $domain);

        if ($corect_domain !== 0) {
            $segments = explode('/', $domain);
            $domain = $segments[2];
        } else {
            $segments = explode('/', $domain);
            $domain = $segments[0];
        }

    // Поиск файла отчета ссылок.
        $fl_link = ROOT . '/report_files/' . $domain . '_List_Links.csv';
        if (file_exists($fl_link)) {
            $f_link = fopen($fl_link, 'r');
            $arr_link = fgetcsv($f_link);
            fclose($f_link);

            echo "\n\Знайдено посилань: " . count($arr_link) .
                "\nЗвіт із переліком посилань домена: " . $fl_link;
        } else {
            echo "\n\nНе знайдено файлів звіту із переліком посилань домена!\n";
        }

    // Поиск файла отчета изображений.
        $fl_img = ROOT . '/report_files/' . $domain . '_List_Image.csv';
        if (file_exists($fl_img)) {
            $f_image = fopen($fl_img, 'r');
            $arr_img = fgetcsv($f_image);
            fclose($f_image);

            echo "\n\Знайдено зображень: " . count($arr_img) .
                "\nЗвіт із переліком зображень домена: " . $fl_img . "\n";
            exit();
        } else {
            echo "\n\nНе знайдено файлів звіту із переліком зображень домена!\n";
            exit();
        }
    }

}