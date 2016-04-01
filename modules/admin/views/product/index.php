<?php

/*
 * @var $this yii\web\View
 * @var $products array
 */

$this->title = 'Products list';

use yii\helpers\Url;

?>

<?php
if(Yii::$app->session->hasFlash('delete_error')){
    echo Yii::$app->session->getFlash('delete_error');
}
?>

<table class="table table-striped">
    <thead>
        <th>id</th>
        <th>title</th>
        <th>link</th>
        <th>price</th>
        <th><a href="<?= Url::toRoute("/admin/parser/get-price")?>">Update all prices</a></th>
    </thead>
    <tbody>
        <?php if(isset($products) && !empty($products)): ?>
            <?php foreach($products as $product): ?>

                    <tr>
                        <td><?=$product->id;?></td>
                        <td><?=$product->title;?></td>
                        <td><a href="<?=$product->link;?>"><?=$product->link;?></a></td>
                        <td><?php if(isset($product->info->price))echo $product->info->price; else 0?></td>
                        <td>
                            <p><a href="<?= Url::toRoute("/admin/product/edit/$product->id") ?>">Edit</a></p>
                            <p><a href="<?= Url::toRoute("/admin/product/delete/$product->id") ?>">Delete</a></p>
                        </td>
                    </tr>

            <?php endforeach;?>
            <tr><a href="<?= Url::toRoute("/admin/product/add")?>">New product</a></tr>
        <?php else: ?>
            <td>no products</td>
        <?php endif; ?>
    </tbody>
</table>


