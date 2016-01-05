<?php
/**
 * @Author: iceStone
 * @Date:   2015-11-13 16:19:38
 * @Last Modified by:   iceStone
 * @Last Modified time: 2016-01-05 16:10:10
 */

/**
 * wp_init actions
 */
function micua_init() {
    _register_360_open_sans();
    _remove_useless_heads();
    // _custom_post_types();
}
add_action( 'init', 'micua_init' );

// /**
//  * wp_enqueue_scripts actions
//  */
// function micua_enqueue_scripts() { }
// add_action( 'wp_enqueue_scripts', 'micua_enqueue_scripts' );

// /**
//  * 自定义内容类型
//  */
// function _custom_post_types() {
//     // 注册课程内容类型
//     $labels = array(
//         'name'                  => __( 'Courses', 'one' ),
//         'singular_name'         => __( 'Course', 'one' ),
//         'menu_name'             => __( 'Courses', 'one' ),
//         'name_admin_bar'        => __( 'Courses', 'one' ),
//         'parent_item_colon'     => __( 'Parent Course:', 'one' ),
//         'all_items'             => __( 'All Courses', 'one' ),
//         'add_new_item'          => __( 'Add New Course', 'one' ),
//         'add_new'               => __( 'Add New', 'one' ),
//         'new_item'              => __( 'New Course', 'one' ),
//         'edit_item'             => __( 'Edit Course', 'one' ),
//         'update_item'           => __( 'Update Course', 'one' ),
//         'view_item'             => __( 'View Course', 'one' ),
//         'search_items'          => __( 'Search Course', 'one' ),
//         'not_found'             => __( 'Not Found', 'one' ),
//         'not_found_in_trash'    => __( 'Not Found in Trash', 'one' ),
//         'items_list'            => __( 'Courses List', 'one' ),
//         'items_list_navigation' => __( 'Courses List Navigation', 'one' ),
//         'filter_items_list'     => __( 'Filter Courses List', 'one' ),
//     );
//     $rewrite = array(
//         'slug'                  => 'course',
//         'with_front'            => false,
//         'pages'                 => true,
//         'feeds'                 => true,
//     );
//     $args = array(
//         'label'                 => __( 'Course', 'one' ),
//         'description'           => __( 'Course Share', 'one' ),
//         'labels'                => $labels,
//         'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields' ),
//         'taxonomies'            => array( /*'category', 'post_tag'*/ ),
//         'hierarchical'          => false,
//         'public'                => true,
//         'show_ui'               => true,
//         'show_in_menu'          => true,
//         'menu_position'         => 4,
//         'menu_icon'             => 'dashicons-admin-post',
//         'show_in_admin_bar'     => true,
//         'show_in_nav_menus'     => true,
//         'can_export'            => true,
//         'has_archive'           => 'courses',
//         'exclude_from_search'   => true,
//         'publicly_queryable'    => true,
//         'rewrite'               => $rewrite,
//         'capability_type'       => 'post',
//     );
//     register_post_type( 'course', $args );
// }

/**
 * 删除 Google 字体的引用
 * 注册 360 字体服务
 */
function _register_360_open_sans() {
    $open_sans_font_url = '';
    /* translators: If there are characters in your language that are not supported
     * by Open Sans, translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Open Sans font: on or off' ) ) {
        $subsets = 'latin,latin-ext';

        /* translators: To add an additional Open Sans character subset specific to your language,
         * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
         */
        $subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)' );

        if ( 'cyrillic' == $subset ) {
            $subsets .= ',cyrillic,cyrillic-ext';
        } elseif ( 'greek' == $subset ) {
            $subsets .= ',greek,greek-ext';
        } elseif ( 'vietnamese' == $subset ) {
            $subsets .= ',vietnamese';
        }

        // Hotlink Open Sans, for now
        $open_sans_font_url = "//fonts.useso.com/css?family=Open+Sans:300italic,400italic,600italic,300,400,600&subset=$subsets";
    }
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', $open_sans_font_url );
}

/**
 * 删除无用的头部命令
 */
function _remove_useless_heads() {
    // remove_action( 'wp_head', 'feed_links', 2 ); //禁止显示feed地址，比如文章和留言
    // remove_action( 'wp_head', 'feed_links_extra', 3 ); //禁止显示额外的feed地址，比如某分类的feed地址
    // remove_action( 'wp_head', 'rsd_link'); //禁止显示rsd信息
    // remove_action( 'wp_head', 'wlwmanifest_link'); //禁止显示Windows Live Writer信息
    // remove_action( 'wp_head', 'index_rel_link'); //禁止显示index链接
    // remove_action( 'wp_head', 'parent_post_rel_link'); //禁止上篇链接
    // remove_action( 'wp_head', 'start_post_rel_link'); //禁止开始页链接
    // remove_action( 'wp_head', 'adjacent_posts_rel_link'); //禁止显示相邻链接
    remove_action('wp_head', 'wp_generator'); //禁止显示WP版本号
}