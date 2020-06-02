<?if (!is_null($links)):
    foreach ($links as $link):?>
        <link rel="stylesheet" href="<?=$link?>">
    <?endforeach;
endif;