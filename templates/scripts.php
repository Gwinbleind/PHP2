<?if (!is_null($scripts)):
    foreach ($scripts as $script):?>
        <script src="<?=$script['link']?>"<?=($script['async']) ? ' async' : ''?>></script>
    <?endforeach;
endif;