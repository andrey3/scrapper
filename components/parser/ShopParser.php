<?php

namespace app\components\parser;

use Yii;

require Yii::getAlias('@app/libs/simpleHtmlDom/simple_html_dom.php');

class ShopParser implements IShopParser
{
    public function parsePrice($link)
    {
        $html = file_get_html($link);
        return $html->find('a[data-id=prices]', 1)->plaintext;
    }
}