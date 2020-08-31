<?php
add_action( 'init', 'create_my_taxonomies', 0 );
function create_my_taxonomies() {
    register_taxonomy(
        'Районы',
        'real-estate',
        array(
            'labels' => array(
                'name' => 'Район',
                'add_new_item' => 'Добавить район',
                'new_item_name' => "Район"
            ),
            'show_ui' => true,
            'show_tagcloud' => true,
            'hierarchical' => true,
        )
    );
}
add_action('init', 'register_post_types');
    function register_post_types()
    {
        register_post_type('real-estate', [
            'label'  => null,
            'labels' => [
                'singular_name'      => __('Объект Недвижимости', 'etcetera_real_estate'), // название для одной записи этого типа
                'name'               => __('Об. Недвижимости', 'etcetera_real_estate'), // основное название для типа записи
                'add_new'            => __('Добавить Объект', 'etcetera_real_estate'), // для добавления новой записи
                'add_new_item'       => __('Добавление Объекта', 'etcetera_real_estate'), // заголовка у вновь создаваемой записи в админ-панели.
                'edit_item'          => __('Редактирование Объекта', 'etcetera_real_estate'), // для редактирования типа записи
                'new_item'           => __('Новый Объект', 'etcetera_real_estate'), // текст новой записи
                'view_item'          => __('Смотреть Объект', 'etcetera_real_estate'), // для просмотра записи этого типа.
                'search_items'       => __('Искать Объект', 'etcetera_real_estate'), // для поиска по этим типам записи
                'not_found'          => __('Не найдено', 'etcetera_real_estate'), // если в результате поиска ничего не было найдено
                'not_found_in_trash' => __('Не найдено в корзине', 'etcetera_real_estate'), // если не было найдено в корзине
                'parent_item_colon'  => '', // для родителей (у древовидных типов)
                'menu_name'          => __('Об. Недвижимости', 'etcetera_real_estate'), // название меню
            ],
            'description'         => '',
            'public'              => true,
            // 'publicly_queryable'  => null, // зависит от public
            // 'exclude_from_search' => null, // зависит от public
            'show_ui'             => true, // зависит от public
            // 'show_in_nav_menus'   => null, // зависит от public
            'show_in_menu'        => true, // показывать ли в меню адмнки
            // 'show_in_admin_bar'   => null, // зависит от show_in_menu
            'show_in_rest'        => null, // добавить в REST API. C WP 4.7
            'rest_base'           => null, // $post_type. C WP 4.7
            'menu_position'       => null,
            'menu_icon'           => null,
            //'capability_type'   => 'post',
            //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
            //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
            'hierarchical'        => false,
            'supports'            => ['title', 'editor'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
            'taxonomies'          => array('Район'),
            'has_archive'         => false,
            'rewrite'             => true,
            'query_var'           => true,
        ]);

    }