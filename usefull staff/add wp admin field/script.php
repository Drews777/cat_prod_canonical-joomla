add_action('init', 'register_girl'); // Использовать функцию только внутри хука init

function register_girl()
{
    $labels = array(
        'name' => 'Девушки',
        'singular_name' => 'девушка', // админ панель Добавить->Функцию
        'add_new' => 'Добавить девушку',
        'add_new_item' => 'Добавить новую девушку', // заголовок тега <title>
        'edit_item' => 'Редактировать',
        'new_item' => 'Новая девушка',
        'all_items' => 'Все девушки',
        'view_item' => 'Просмотр девушек на сайте',
        'search_items' => 'Искать девушек',
        'not_found' => 'Девушка не найдено.',
        'not_found_in_trash' => 'В корзине нет.',
        'menu_name' => 'Девушки' // ссылка в меню в админке
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true, // показывать интерфейс в админке
        'has_archive' => true,
        'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg id="Capa_1" enable-background="new 0 0 511.952 511.952" height="20" viewBox="0 0 511.952 511.952" fill="#fff" width="20" xmlns="http://www.w3.org/2000/svg"><g><path d="m75.976 511.952h360c8.284 0 15-6.716 15-15 0-32.394-4.489-57.673-13.723-77.282-6.058-12.864-14.182-23.317-24.635-31.672 5.378-12.615 8.358-26.489 8.358-41.046v-211c0-74.785-60.229-135.266-134.388-135.6-6.703-.501-43.251-2.709-62.953 15.375-4.74 4.35-8.194 9.523-10.287 15.309-35.36 6.024-62.372 36.865-62.372 73.916v84.787l-25.606 25.606c-5.858 5.858-5.858 15.355 0 21.213s15.355 5.858 21.213 0l4.571-4.571c2.142 37.603 24.161 69.969 55.689 86.735-8.807 30.902-29.178 37.142-56.348 45.447-39.883 12.191-89.519 27.363-89.519 132.782 0 8.286 6.716 15.001 15 15.001zm344.612-30h-266.723l147.111-58.844v13.844c0 8.284 6.716 15 15 15 32.467 0 61.537-14.814 80.813-38.036 11.392 10.535 21.702 29.315 23.799 68.036zm-59.612-273.065c9.58.93 19.574 1.553 30 1.851v136.214c0 36.219-25.809 66.524-60 73.493 0-18.563 0-105.805 0-121.089 18.546-18.946 30-44.86 30-73.404zm-180-103.935c0-24.813 20.187-45 45-45 8.284 0 15-6.716 15-15 0-3.132.849-5.192 2.928-7.108 9.643-8.884 33.239-7.493 42.072-7.493 57.897 0 105 47.153 105 105.601v44.771c-99.5-3.074-148.946-40.599-150.002-75.989l.002.218c0-8.284-6.716-15-15-15s-15 6.716-15 15c0 19.59-12.718 36.791-30 43.265zm0 121v-46.537c18.118-3.755 34.766-14.419 46.264-30.862 23.589 32.674 64.12 48.713 103.736 56.138v21.26c0 41.355-33.645 75-75 75s-75-33.643-75-74.999zm-21.712 166.908c27.945-8.542 62.04-18.972 75.84-63.994 6.748 1.366 13.727 2.087 20.872 2.087 16.095 0 31.353-3.645 45-10.145v69.989l-209.14 83.656c5.159-62.549 33.034-71.08 67.428-81.593z"/></g></svg>'), // иконка в меню
        'menu_position' => 20, // порядок в меню
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'page-attributes')
    );
    register_post_type('girls', $args);
    register_taxonomy('girls-type', array('girls'), array(
        'label' => 'Типы девушек',
        'labels' => array(
            'name' => 'Типы девушек',
            'singular_name' => 'Тип девушки',
            'search_items' => 'Искать',
            'all_items' => 'Все типы',
            'parent_item' => 'Родит. тип',
            'parent_item_colon' => 'Родит. тип:',
            'edit_item' => 'Редактировать тип',
            'update_item' => 'Обновить тип',
            'add_new_item' => 'Добавить тип',
            'new_item_name' => 'Заголовок',
            'menu_name' => 'Типы девушек',
        ),
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => true,
        'rewrite' => array('hierarchical' => true),
        'show_admin_column' => true,
    ));
}
