<ul class="nav">
    <?php 
        Debug(base_url());
        foreach($items as $menu) {
            echo '<li><a data-type="async" href="/'.$menu->link.'" title="'.$menu->title.'">'.$menu->title.'</a></li>';
        }
    ?>
    <li><a title="contact me">contact me</a></li>
    <li><a title="about me">about me</a></li>
</ul>
