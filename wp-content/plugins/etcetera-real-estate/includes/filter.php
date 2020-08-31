<?php
function my_posts_where($where)
{
    global $wpdb;
    $where = str_replace(
        "meta_key = 'rooms_%",
        "meta_key LIKE 'rooms_%",
        $wpdb->remove_placeholder_escape($where)
    );
    return $where;
}

add_filter('posts_where', 'my_posts_where');
function misha_script_and_styles()
{
    global $wp_query;

    // register our main script but do not enqueue it yet
    wp_register_script('misha_scripts',  plugin_dir_url( __FILE__ ) . '../public/js/myloadmore.js', array('jquery'), time());

    // now the most interesting part
    // we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
    // you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()
    wp_localize_script('misha_scripts', 'misha_loadmore_params', array(
        'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
        'posts' => json_encode($wp_query->query_vars), // everything about your loop is here
        'current_page' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
        'max_page' => $wp_query->max_num_pages,
        'first_page' => get_pagenum_link(1)
    ));

    wp_enqueue_script('misha_scripts');
}
add_action('wp_enqueue_scripts', 'misha_script_and_styles', 1);




function misha_paginator($first_page_url)
{

    // the function works only with $wp_query that's why we must use query_posts() instead of WP_Query()
    global $wp_query;

    // remove the trailing slash if necessary
    $first_page_url = untrailingslashit($first_page_url);


    // it is time to separate our URL from search query
    $first_page_url_exploded = array(); // set it to empty array
    $first_page_url_exploded = explode("/?", $first_page_url);
    // by default a search query is empty
    $search_query = '';
    // if the second array element exists
    if (isset($first_page_url_exploded[1])) {
        $search_query = "/?" . $first_page_url_exploded[1];
        $first_page_url = $first_page_url_exploded[0];
    }

    // get parameters from $wp_query object
    // how much posts to display per page (DO NOT SET CUSTOM VALUE HERE!!!)
    $posts_per_page = (int) $wp_query->query_vars['posts_per_page'];
    // current page
    $current_page = (int) $wp_query->query_vars['paged'];
    // the overall amount of pages
    $max_page = $wp_query->max_num_pages;

    // we don't have to display pagination or load more button in this case
    if ($max_page <= 1) return;

    // set the current page to 1 if not exists
    if (empty($current_page) || $current_page == 0) $current_page = 1;

    // you can play with this parameter - how much links to display in pagination
    $links_in_the_middle = 4;
    $links_in_the_middle_minus_1 = $links_in_the_middle - 1;

    // the code below is required to display the pagination properly for large amount of pages
    // I mean 1 ... 10, 12, 13 .. 100
    // $first_link_in_the_middle is 10
    // $last_link_in_the_middle is 13
    $first_link_in_the_middle = $current_page - floor($links_in_the_middle_minus_1 / 2);
    $last_link_in_the_middle = $current_page + ceil($links_in_the_middle_minus_1 / 2);

    // some calculations with $first_link_in_the_middle and $last_link_in_the_middle
    if ($first_link_in_the_middle <= 0) $first_link_in_the_middle = 1;
    if (($last_link_in_the_middle - $first_link_in_the_middle) != $links_in_the_middle_minus_1) {
        $last_link_in_the_middle = $first_link_in_the_middle + $links_in_the_middle_minus_1;
    }
    if ($last_link_in_the_middle > $max_page) {
        $first_link_in_the_middle = $max_page - $links_in_the_middle_minus_1;
        $last_link_in_the_middle = (int) $max_page;
    }
    if ($first_link_in_the_middle <= 0) $first_link_in_the_middle = 1;

    // begin to generate HTML of the pagination
    $pagination = '<nav id="pagination" class="navigation pagination" role="navigation"><div class="nav-links">';

    // when to display "..." and the first page before it
    if ($first_link_in_the_middle >= 2 && $links_in_the_middle < $max_page) {
        $pagination .= '<a href="' . $first_page_url . $search_query . '" class="page-numbers" id="1">1</a>'; // first page

        if ($first_link_in_the_middle != 2)
            $pagination .= '<span class="page-numbers extend">...</span>';
    }


    // loop page links in the middle between "..." and "..."
    for ($i = $first_link_in_the_middle; $i <= $last_link_in_the_middle; $i++) {
        if ($i == $current_page) {
            $pagination .= '<span class="page-numbers current" id="'.$i.'">' . $i . '</span>';
        } else {
            $pagination .= '<a href="' . $first_page_url . '/page/' . $i . $search_query . '" id="'.$i.'"class="page-numbers">' . $i . '</a>';
        }
    }

    // when to display "..." and the last page after it
    if ($last_link_in_the_middle < $max_page) {

        if ($last_link_in_the_middle != ($max_page - 1))
            $pagination .= '<span class="page-numbers extend" id="'.$i.'">...</span>';

        $pagination .= '<a href="' . $first_page_url . '/page/' . $max_page . $search_query . '" class="page-numbers" id="'.$i.'">' . $max_page . '</a>';
    }

    // end HTML
    $pagination .= "</div></nav>\n";


    // replace first page before printing it
    echo str_replace(array("/page/1?", "/page/1\""), array("?", "\""), $pagination);
}





function real_estate_filter_function()
{
    if (isset($_POST['name'])) {
        $name = sanitize_text_field($_POST['name']);
        $meta_query[] = array(
            'key' => 'name',
            'value' => $name,
            'compare' => 'LIKE'
        );
    }

    if (isset($_POST['location'])) {
        $location = sanitize_text_field($_POST['location']);
        $meta_query[] = array(
            'key' => 'location',
            'value' => $location,
            'compare' => 'LIKE'
        );
    }

    if (isset($_POST['type'])) {
        $type = sanitize_text_field($_POST['type']);
        $meta_query[] = array(
            'key' => 'type',
            'value' => $type,
            'compare' => '='
        );
    }
    if (isset($_POST['sustainability'])) {
        $sustainability = sanitize_text_field($_POST['sustainability']);
        $meta_query[] = array(
            'key' => 'sustainability',
            'value' => $sustainability,
            'compare' => '='
        );
    }

    if (isset($_POST['number_of_floors'])) {
        $number_of_floors = sanitize_text_field($_POST['number_of_floors']);
        $meta_query[] = array(
            'key' => 'number_of_floors',
            'value' => $number_of_floors,
            'compare' => '='
        );
    }


    if (isset($_POST['balcony'])) {
        $balcony = sanitize_text_field($_POST['balcony']);
        $meta_query[] = array(
            'key' => 'rooms_%_balcony',
            'value' => $balcony,
            'compare' => '='
        );
    }
    if (isset($_POST['toilet'])) {
        $toilet = sanitize_text_field($_POST['toilet']);
        $meta_query[] = array(
            'key' => 'rooms_%_toilet',
            'value' => $toilet,
            'compare' => '='
        );
    }
    if (isset($_POST['number_of_rooms'])) {
        $number_of_rooms = sanitize_text_field($_POST['number_of_rooms']);
        $meta_query[] = array(
            'key' => 'rooms_%_number_of_rooms',
            'value' => $number_of_rooms,
            'compare' => '=',
            'type' => 'NUMERIC'
        );
    }
    if (isset($_POST['area'])) {
        $area = sanitize_text_field($_POST['area']);
        $meta_query[] = array(
            'key' => 'rooms_%_area',
            'value' => $area,
            'compare' => 'LIKE',
        );
    }

    $tax_query = array();
    $args['posts_per_page'] = 4;
    $args['post_type'] = 'real-estate';
    $args['meta_query'] = $meta_query;
    $args['tax_query'] = $tax_query;
    $args['paged'] = $_POST['page'] + 1;
    $args['post_status'] = 'publish';






    $html_wrap_start = '<div class="real-estate-objects"><div class="container"><div class="row">';
    $name_heading = __('Название дома: ', 'wp-bootstrap-starter');
    $location_heading = __('Координаты местоположения: ', 'wp-bootstrap-starter');
    $number_of_floor_heading = __('Количество этажей: ', 'wp-bootstrap-starter');
    $sustainability_heading = __('Экологичность: ', 'wp-bootstrap-starter');
    $type_heading = __('Тип объекта: ', 'wp-bootstrap-starter');
    $room_heading =  __('Квартира / Помещения: ', 'wp-bootstrap-starter');
    $real_estate_object = '';


    $html_wrap_end = '</div></div></div>';



    // prepare our arguments for the query


    // it is always better to use WP_Query but not here
    query_posts($args);

    if (have_posts()) :

        // run the loop
        while (have_posts()) : the_post();

            $real_estate_object .= '<div class="col-lg-6">';
            $real_estate_object .= '<div class="real-estate-object card">';
            $img = get_field('object_image');
            $img_html = ' <img src="' . $img['url'] . '" class="card-img-top" alt="' .  $img['alt'] .  '">';
            $real_estate_object .= $img_html;
            $real_estate_object .= '<div class="card-body row">';
            $real_estate_object .= '<div class="name card-title col-lg-12">' .  get_field('name') . '</div>';
            $real_estate_object .= '<div class="location col-lg-12">' . $location_heading . get_field('location') . '</div>';
            $real_estate_object .= '<div class="type col-lg-12">' . $type_heading . get_field('type') . '</div>';
            $real_estate_object .= '<div class="number_of_floor col-lg-12">' . $number_of_floor_heading . get_field('number_of_floors') . '</div>';
            $real_estate_object .= '<div class="sustainability col-lg-12">' . $sustainability_heading . get_field('sustainability') . '</div>';
            $real_estate_object .= '<div class="sustainability col-lg-12">' . 'Кол-во помещений / комнат: ';

            if (have_rows('rooms'))
                while (have_rows('rooms')) {
                    the_row();
                    $count = 0;
                    $count = $count + get_row_index();
                }

            $real_estate_object .= $count . '</div>';
            $real_estate_object .= '<div class="read-more col-12"> <a href="' . get_post_permalink() . '">' . __('Подробнее о здании', 'wp-bootstrap-starter') . '</a></div> ';
            $real_estate_object .= '</div><!-- end card-body -->';
            $real_estate_object .= '</div><!-- end real-estate-object -->';
            $real_estate_object .= '</div><!-- end col-lg-6 -->';

        endwhile;
       
        echo $html_wrap_start . $real_estate_object . $html_wrap_end;
        misha_paginator($_POST['first_page']);
    endif;
    die; // here we exit the script and even no wp_reset_query() required!


}


add_action('wp_ajax_myfilter', 'real_estate_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_myfilter', 'real_estate_filter_function');
