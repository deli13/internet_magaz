<?php
/**
 * Created by PhpStorm.
 * User: deli13
 * Date: 27.08.17
 * Time: 16:09
 */
?>
<div class="container">
    <div class="row-fluid">

            <?php foreach ($catalogs as $catalog): ?>
            <div class="col-md-4">
                    <div class="thumbnail">
                        <?= $catalog->name; ?>
                    </div>
            </div>
            <?php endforeach; ?>

    </div>
</div>
