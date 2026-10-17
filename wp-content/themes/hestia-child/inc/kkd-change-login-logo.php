<?php

/**
 * Change the default WordPress login logo to favicon
 *
 * @since 1.0.0
 */

function custom_login_branding() {
    // Ambil ID dan URL site icon
    $site_icon_id = get_option( 'site_icon' );
    $icon_url = $site_icon_id ? wp_get_attachment_image_url( $site_icon_id, 'full' ) : '';

    // Tambahkan CSS jika URL tersedia
    if ( $icon_url ) {
        echo '<style>
            #login h1 a {
                background-image: url(' . esc_url( $icon_url ) . ') !important;
                background-size: contain !important;
                width: 100% !important;
                height: 100px !important;
            }
        </style>';
    }

    // Ganti URL dan title dengan filter
    add_filter( 'login_headerurl', function() {
        return home_url();
    });

    add_filter( 'login_headertext', function() {
        return get_bloginfo( 'name' );
    });
}
add_action( 'login_enqueue_scripts', 'custom_login_branding' );

?>