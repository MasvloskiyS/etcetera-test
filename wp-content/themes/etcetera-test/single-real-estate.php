<?php
/*
Template Name: Real Estate
Template Post Type: real-estate
*/
get_header();


$img = get_field('object_image');
$name = get_field('name');
$location = get_field('location');
$type = get_field('type');
$number_of_floors = get_field('number_of_floors');
$sustainability = get_field('sustainability');
?>
<div class="col-12" id="real-estate__header" style="background-image: url('<?php echo $img['url']; ?>');">
    <div class="overlay-white"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 ">
                <h1><?php echo $name; ?></h1>
                <a href="#info" class="page-scroller"><i class="fa fa-fw fa-angle-down"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="container" id="info">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 ">
                <?php echo get_field('real_estate_description'); ?>
                <h4><?php _e('Дополнительная информация'); ?></h4>
                <p><?php _e('Тип строения: ');
                    echo $type; ?></p>
                <p><?php _e('Координаты местоположения: ');
                    echo $location; ?></p>
                <p><?php _e('Количество этажей: ');
                    echo $number_of_floors; ?></p>
                <p><?php _e('Экологичность: ');
                    echo $sustainability; ?></p>
            </div>
        </div>
    </div>
</div>

<?php if (have_rows('rooms'))
    while (have_rows('rooms')) {
        the_row();

        $img = get_sub_field('photo');
        $img_html = ' <img src="' . $img['url'] . '" class="d-block w-100" alt="' .  $img['alt'] .  '">';
        $room .= '<div class="container px-0">';
        $room .= '<div class="room row">';
        $room .= '<div class="photo col-lg-6">' . $img_html . ' </div> ';
        $room .= '<div class="room__info col-lg-6">';
        $room .= '<div class="area">' . '<b>' . __('Площадь: ', 'wp-bootstrap-starter') . '</b>' . get_sub_field('area') . ' </div> ';
        $room .= '<div class="number_of_rooms">' . '<b>' . __('Количество комнат: ', 'wp-bootstrap-starter') . '</b>' . get_sub_field('number_of_rooms') . ' </div> ';
        $room .= '<div class="balcony">' . '<b>' . __('Балкон: ', 'wp-bootstrap-starter') . '</b>' . get_sub_field('balcony') . ' </div> ';
        $room .= '<div class="toilet">' . '<b>' . __('Сан. узел: ', 'wp-bootstrap-starter') . '</b>' . get_sub_field('toilet') . ' </div> ';
        $room .= '</div></div></div>';
    }


?>
<div class="col-12 ">
    <div class="container" id="slider-section">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 ">
                <h2><?php _e('Все квартиры и помещения в этом строении'); ?></h2>
                <div class="responsive-slider-wrapper">
                    <button class="prev"><i class="fas fa-arrow-left"></i></button>
                    <div class="responsive-slider">
                        <?php echo $room; ?>
                    </div>
                    <button class="next"><i class="fas fa-arrow-right"></i>
                </div>

            </div>

        </div>

    </div>
</div>
</div>
<?php

get_footer(); ?>