<?php function real_estate_shortcode($atts) {
    function selectCreator($acf_field_name, $select_label, $bootstrap_column_class) {
        $args = array('post_type' => 'real-estate');
        $the_query = new WP_Query($args);
        $select_heading = __($select_label, 'wp-bootstrap-starter');
        $select = '';

        if ($the_query->have_posts()) {
            while ($the_query->have_posts()) {
    
                $the_query->the_post();

                $select_option = '';
                
                $field = get_field_object($acf_field_name);
                
                if ($field['choices']) {
                    $select = '<div class="'. $bootstrap_column_class .'"><div class="form-group"><select class="form-control" name="'. $acf_field_name .'">';
                    $select .= '<option selected disabled>' .  $select_heading. '</option>';
                    foreach ($field['choices'] as $value => $label) :
                        $select_option .= '<option>' . $label . '</option>';
                    endforeach;
                    $select .=  $select_option . '</select></div></div>';
                } else {
                    while( have_rows('rooms') ) : the_row();
                        if( get_row_index() == 1)  {
                            $field = get_sub_field_object($acf_field_name);
                            $select = '<div class="'. $bootstrap_column_class . '"><div class="form-group"><select class="form-control" name="'. $acf_field_name .'">';
                            $select .= '<option selected disabled>' .  $select_heading. '</option>';
                            foreach( $field['choices'] as $k => $v ) :
                                    $select_option .= '<option>' . $v . '</option>';
                            endforeach;
                            $select .=  $select_option . '</select></div></div>';
                        }
                    endwhile;
                }
                
            }
        }
        return $select;
    }



    $form_filter = '<form action="' .  site_url() .  '/wp-admin/admin-ajax.php"' . 'method="POST" id="filter" class="container"><div class="row">';

    $form_filter .= '<div class="col-md-3"><div class="form-group"><input type="text" name="name" class="form-control" placeholder="Название дома" /></div></div>';
    $form_filter .= '<div class="col-md-3"><div class="form-group"><input type="text" name="location"  class="form-control" placeholder="Координаты" /></div></div>';
    $form_filter .= selectCreator('type','Тип объекта', 'col-md-3');
    $form_filter .= selectCreator('number_of_floors','Кол. этажей', 'col-md-3');
    $form_filter .= selectCreator('sustainability','Экологичность', 'col-md-2');
    $form_filter .= '<div class="col-md-2"><div class="form-group"><input type="text" name="area"  class="form-control" placeholder="Площадь помещения" /></div></div>';
    $form_filter .= selectCreator('number_of_rooms','Кол. комнат', 'col-md-2');
    $form_filter .= selectCreator('balcony','Балкон', 'col-md-2');
    $form_filter .= selectCreator('toilet','Сан. узел', 'col-md-2');
    $form_filter .= '<div class="col-md-2"><div class="form-group text-right mb-0"><button type="submit" class="btn btn-primary mb-0">Поиск</button></div></div>';
    $form_filter .= '<input type="hidden" name="action" value="myfilter"></div>';
    
    $form_filter .= ' </form>';
    $form_filter .= '<div id="response" class="w-100"></div>';
    
    

    $output = $form_filter;
    return $output;
}



add_shortcode('building_filter', 'real_estate_shortcode');
