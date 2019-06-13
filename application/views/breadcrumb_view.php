<div class="container-fluid sortDisp">
    <div class="container">
        <?php echo isset($title) ? $title : \Repository\Config_system::titulo() ?>
        <span class="bread-crumb pull-right">
            <?php foreach ($breadCrumb as $c => $bread) { ?>
                <?php if ($bread->link != '') { ?>
                    <a href="<?php echo $bread->link ?>"><?php echo $bread->section ?></a>
                <?php } else { ?>
                    <?php echo $bread->section ?>
                <?php } ?>
                <?php echo $c < count($breadCrumb) - 1 ? ' / ' : '' ?>
            <?php } ?>
        </span>
    </div>
</div>