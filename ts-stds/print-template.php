<html>
<body>
    <?php $a = get_option('ts_admin_options'); echo stripslashes($a['analytics_code']); ?>

<?php
    $qp1 = new WP_Query('p='.$_GET['print']);
    if ($qp1->have_posts()) :
        while ($qp1->have_posts() ) : $qp1->the_post();
            echo '<title>'.get_the_title().'</title>';
            echo '<div class="meta">'.get_bloginfo('name').' at '.get_bloginfo('url').'</div>';
            echo '<h2>'.get_the_title().'</h2>';
            echo '<div class="meta">By ';
            the_author();
            echo ' | '.get_the_date('M. j, Y').' | ';
            the_permalink();
            echo '</div>';
            the_content();
            echo '<div style="margin-top:60px">'.get_permalink().'.</div>';
            echo '<div style="margin-top:60px">&copy; Copyright '.date('Y').' '.get_bloginfo('name').' Accessed '.date('r').'.</div>';
        endwhile; endif;
?>


</body>
</html>