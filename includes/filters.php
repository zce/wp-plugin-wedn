<?php
/**
 * 所有的过滤器
 * @Author: iceStone
 * @Date:   2015-11-13 15:48:11
 * @Last Modified by:   iceStone
 * @Last Modified time: 2015-11-13 16:18:04
 */

function micua_filters() {
    // add_filter('get_avatar', '_get_ssl_avatar');
    add_filter('get_avatar', '_get_duoshuo_avatar', 10, 3);
}
add_action('init', 'micua_filters');

/**
 * 官方Gravatar头像调用ssl头像链接
 * @param  string $avatar Gravatar头像地址
 * @return string         新的Gravatar头像地址
 */
function _get_ssl_avatar($avatar) {
    $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/', '<img src="https://secure.gravatar.com/avatar/$1" class="avatar avatar-$2" height="$2" width="$2">', $avatar);
    return $avatar;
}

/**
 * 多说官方Gravatar头像调用
 * @param  string $avatar Gravatar头像地址
 * @return string         新的Gravatar头像地址
 */
function _get_duoshuo_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "gravatar.duoshuo.com", $avatar);
    return $avatar;
}
