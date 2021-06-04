// Добавлять в functions.php
add_action( 'init', 'create_posttype_taxonomy' );
function create_posttype_taxonomy() {
  register_post_type( 'slider',
    array(
      'labels' => array(
        'name'              => __( 'Слайды' ),
		    'singular_name'     => __( 'Слайд' ),
		    'search_items'      => __( 'Поиск по слайдам' ),
		    'all_items'         => __( 'Все слайды' ),
		    'edit_item'         => __( 'Редактировать слайд' ),
		    'update_item'       => __( 'Обновить слайд' ),
		    'add_new_item'      => __( 'Добавить слайд' ),
		    'new_item_name'     => __( 'Название слайда' ),
		    'menu_name'         => __( 'Слайды' ),
        'add_new'           => __( 'Добавить слайд' ),
      ),
      'public' => true,
      'has_archive' => false,
      'menu_icon'   => 'dashicons-format-gallery',
      'rewrite' => array('slug' => 'slider'),
      'supports' => array('title', 'editor', 'excerpt', 'thumbnail')
    )
  );
}