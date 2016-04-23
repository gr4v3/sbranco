<ul class="nav">
    <?php 
        foreach($items as $menu) {
            $menu->title = preg_replace('/_i_(.*)_i_/i', '<i>$1</i>', $menu->title);
            $menu->title = preg_replace('/_span_(.*)_span_/i', '<span>$1</span>', $menu->title);
            echo '<li><a data-type="async" href="/'.$menu->link.'" title="'.$menu->title.'">'.$menu->title.'</a></li>';
        }
    ?>
    <li><a title="contact me">contact me</a></li>
    <li><a title="about me">about me</a></li>
</ul>
