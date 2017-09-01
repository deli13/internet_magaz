<?php

namespace app\commands;
use yii;
use yii\console\Controller;
use app\models\Catalog;
use app\models\Product;
//use yii\web\UploadedFile;


class ImportController extends Controller
{
    public function actionIndex()
    {
        $file = file_get_contents("http://mobilak-spb.ru/?route=export/xls"); //"http://mobilak-spb.ru/?route=export/xls"
        $dom = new \DOMDocument(); //Парсим файл с товарами
        libxml_use_internal_errors(true);
        $dom->loadHTML($file);
        $row_table = $dom->getElementsByTagName("tr"); //Получаем все строки из файла
        $count = $row_table->length;
        $parent = $catalog = $level_1 = $level_2 = $level_3 = 0;
        $color_level_1 = "#c6c6c6";
        $color_level_2 = "#e6e6e6";
        $color_level_3 = "#5EC3E6";
        for ($i = 6; $i < $count; $i++) { //Проходимся по файлу начиная с 6 позиции
            $row = $row_table->item($i);
            if ($row->childNodes->length == 2) { //Выцепляем каталоги
                $str = $row->childNodes[0]->textContent;
                $color=$row->childNodes[0]->getAttribute("bgcolor");
                $find = Catalog::find()->where(['name' => str_replace("&nbsp;", "", htmlentities($str))])->one();
                switch ($color){ //Определяем иерархию
                    case $color_level_1:
                        $parent=0;
                        break;
                    case $color_level_2:
                        $parent=$level_1;
                        break;
                    case $color_level_3:
                        $parent=$level_2;
                        break;
                    default:
                        $parent=0;
                        break;
                }
                if (count($find) == 0) {
                    $cat = new Catalog();
                    $cat->parent = $parent;
                    $cat->name = str_replace("&nbsp;", "", htmlentities($str));
                    if (!$cat->save()) {
                        print_r("Error");
                    };
                    $catalog = Yii::$app->db->lastInsertID;
                    print_r($catalog);
                } else {
                    $catalog = $find->id;
                }
                switch ($color){ //Устанавливаем новые значения для каталогов
                    case $color_level_1:
                        $level_1=$catalog;
                        $level_2=$catalog;
                        $level_3=$catalog;
                        break;
                    case $color_level_2:
                        $level_2=$catalog;
                        $level_3=$catalog;
                        break;
                    case $color_level_3:
                        $level_3=$catalog;
                        break;
                }
            } elseif ($row->childNodes->length > 5) { //Выцепляем товары
                $name = $row->childNodes[0]->textContent;
                $url = $row->childNodes[0]->firstChild->getAttribute('href');
                if ((float)$row->childNodes[4]->textContent < 500) { //Манипуляции с ценами
                    $delta = (float)$row->childNodes[4]->textContent * 0.2;
                } elseif ((float)$row->childNodes[4]->textContent < 1000 && (float)$row->childNodes[4]->textContent >= 500) {
                    $delta = (float)$row->childNodes[4]->textContent * 0.15;
                } else {
                    $delta = (float)$row->childNodes[4]->textContent * 0.1;
                }
                $articul = (int)$row->childNodes[2]->textContent;
                $roznica = (float)$row->childNodes[4]->textContent + $delta;
                $opt1 = (float)$row->childNodes[6]->textContent + $delta;
                $opt2 = (float)$row->childNodes[8]->textContent + $delta;
                $opt3 = (float)$row->childNodes[10]->textContent + $delta;
                $opt4 = (float)$row->childNodes[12]->textContent + $delta;
                $last = $row->childNodes[14]->textContent;
                $find_prod = Product::find()->where(['name' => $name,
                    'article' => $articul])->one();
                if (count($find_prod) == 0) { //Если товара не существует
                    $product = new Product();
                    $product->name = $name;
                    $product->article = $articul;
                    $product->price_roznica = $roznica;
                    $product->price_1 = $opt1;
                    $product->price_2 = $opt2;
                    $product->price_3 = $opt3;
                    $product->price_4 = $opt4;
                    $product->remain = $last;
                    $product->image=$this->fileUploader($url);
                    $product->id_catalog = $level_3;
                    if (!$product->save()) {
                        print_r("Error");
                    }
                } else {
                    $find_prod->price_roznica = $roznica;
                    $find_prod->price_1 = $opt1;
                    $find_prod->price_2 = $opt2;
                    $find_prod->price_3 = $opt3;
                    $find_prod->price_4 = $opt4;
                    $find_prod->remain = $last;
                    $find_prod->save();
                }
            }
        }
    }

    private function fileUploader($file_url){ //Загрузка изображений на сервер
        try{
            $find_img=file_get_contents($file_url);
        } catch (yii\base\ErrorException $e){
            return false;
        }
        $DOM=new \DOMDocument();
        libxml_use_internal_errors(true);
        $DOM->loadHTML($find_img);
        $img=$DOM->getElementsByTagName('img');
        foreach ($img as $row){
            if($row->getAttribute("title")){
                try{
                    $content=file_get_contents($row->getAttribute("src"));
                } catch (yii\base\ErrorException $e){
                    return false;
                }
                $src=$row->getAttribute("src");
                $names=explode("/",$src);
                $name=array_pop($names);
                $name="/import/".$name;
                file_put_contents( Yii::$app->basePath."/web".$name,$content);
                break;
            }
        }
        return $name;
    }

    public function  actionImport(){

    }

}
