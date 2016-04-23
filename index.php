<?php
/*
Plugin Name: Editor de Comentarios
Plugin URI
Description: Administra y gestiona Los comentarios de tu blog
Author: ROG@MA
Author URI: http://www.rogamainformatica.es
Version: 0.0.1
License: GPL2
Require: PHP 5.6 or higther
*/

const UPDATE_SUCCESS = 0;
include_once 'libs\AdminNotice.php';
add_action('admin_notices', [AdminNotice::getInstance(), 'displayAdminNotice']);

add_action('admin_menu', 'edit_comments_init');
function edit_comments_init()
{
    add_submenu_page('edit-comments.php', 'Editar comentarios', 'Editar Comentarios', 'moderate_comments', 'move-comments.php', 'edit_commnets');
}

/**
 * @return null
 */
function edit_commnets()
{
    $notice = AdminNotice::getInstance();

    $userOrigin = filter_input(INPUT_POST, 'user-origin', FILTER_VALIDATE_INT);
    $userDestination = filter_input(INPUT_POST, 'user-destination', FILTER_VALIDATE_INT);
    $submit = filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_STRING);
    $result = false;

    if ($submit === "Guardar" && (empty($userOrigin) || empty($userDestination))) {
        $notice->displayError('Datos introducidos erroneos');
        return null;
    } else if ($submit === "Guardar" && !empty($userOrigin) && !empty($userDestination)) {
        global $wpdb;
        $username = get_user_by ( 'ID', $userDestination )->user_nicename;
        $result = $wpdb->query("UPDATE wp_ta_comments set comment_author = '{$username}', user_id = {$userDestination} where user_id = {$userOrigin}");
    }

    if ($result >= UPDATE_SUCCESS) {
        $notice->displaySuccess('Cambios realizados correctamente.');
        $notice->displayAdminNotice();
    }

    //Print the form
    include 'templates/move-comments.php';
}