<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$cf7sr_ts_key    = get_option( 'cf7sr_ts_key' );
$cf7sr_ts_secret = get_option( 'cf7sr_ts_secret' );

if ( empty( $cf7sr_ts_key ) || empty( $cf7sr_ts_secret ) || is_admin() ) {
    return;
}

function enqueue_cf7sr_turnstile_script() {
    $cf7sr_script_url = 'https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit&onload=cf7srLoadTurnstile';

    $cf7sr_ts_key = get_option( 'cf7sr_ts_key' );

    $inline_js = "
        var turnstileIds = [];
        
        window.cf7srLoadTurnstile = function() {
            var widgets = document.querySelectorAll('.cf7sr-g-turnstile');
            for (var i = 0; i < widgets.length; ++i) {
                var widget = widgets[i];
                if (typeof turnstile !== 'undefined') {
                    turnstileIds.push(
                        turnstile.render('#' + widget.id, {
                            'sitekey' : " . wp_json_encode( $cf7sr_ts_key ) . "
                        })
                    );
                }
            }
        };

        window.cf7srResetTurnstile = function() {
            for (var i = 0; i < turnstileIds.length; i++) {
                if (typeof turnstile !== 'undefined') {
                    turnstile.reset(turnstileIds[i]);
                }
            }
        };

        document.addEventListener('wpcf7invalid', cf7srResetTurnstile);
        document.addEventListener('wpcf7mailsent', cf7srResetTurnstile);
        document.addEventListener('invalid.wpcf7', cf7srResetTurnstile);
        document.addEventListener('mailsent.wpcf7', cf7srResetTurnstile);
    ";

    wp_enqueue_script( 'cf7sr-turnstile-api', $cf7sr_script_url, array(), null, true );
    wp_add_inline_script( 'cf7sr-turnstile-api', $inline_js, 'before' );
}

function cf7sr_turnstile_form_tag_handler( $tag ) {
    enqueue_cf7sr_turnstile_script();

    $cf7sr_ts_key = get_option( 'cf7sr_ts_key' );
    $cf7sr_ts_language = get_option( 'cf7sr_ts_language' );
    if ( empty( $cf7sr_ts_language ) ) {
        $cf7sr_ts_language = 'auto';
    }
    $cf7sr_theme = $tag->get_option( 'theme', '(light|dark|auto)', true );
    $cf7sr_theme = $cf7sr_theme ? $cf7sr_theme : 'auto';
    $cf7sr_ts_size = $tag->get_option( 'size', '(normal|flexible|compact)', true );
    $cf7sr_ts_size = $cf7sr_ts_size ? $cf7sr_ts_size : 'normal';
    $cf7sr_ts_appearance = $tag->get_option( 'appearance', '(always|execute|interaction-only)', true );
    $cf7sr_ts_appearance = $cf7sr_ts_appearance ? $cf7sr_ts_appearance : 'always';

    $cf7sr_id = 'cf7sr-' . uniqid();

    return '<div id="' . esc_attr( $cf7sr_id ) . '" class="cf7sr-g-turnstile" data-theme="' . esc_attr( $cf7sr_theme ) . '" data-language="'
        . esc_attr( $cf7sr_ts_language ) . '" data-size="' . esc_attr( $cf7sr_ts_size ) . '" data-appearance="' . esc_attr( $cf7sr_ts_appearance ) . '" data-sitekey="' . esc_attr( $cf7sr_ts_key )
        . '"></div><span class="wpcf7-form-control-wrap cf7sr-turnstile" data-name="cf7sr-turnstile"><input type="hidden" name="cf7sr-turnstile" value="" class="wpcf7-form-control"></span>';
}

function cf7sr_register_turnstile_form_tag() {
    wpcf7_add_form_tag(
        'cf7sr_turnstile',
        'cf7sr_turnstile_form_tag_handler',
        array( 'display-block' => true )
    );
}
add_action( 'wpcf7_init', 'cf7sr_register_turnstile_form_tag' );

function cf7sr_verify_turnstile( $result, $tag ) {
    if ( ! class_exists( 'WPCF7_Submission' ) ) {
        return $result;
    }

    $submission = WPCF7_Submission::get_instance();
    if ( ! $submission ) {
        return $result;
    }

    $data = $submission->get_posted_data();

    $message = get_option( 'cf7sr_ts_message' );
    if ( empty( $message ) ) {
        $message = 'Invalid captcha';
    }

    if ( empty( $data['cf-turnstile-response'] ) ) {
        $result->invalidate( array( 'type' => 'cf7sr_turnstile', 'name' => 'cf7sr-turnstile' ), $message );
        if ( function_exists( 'cf7sr_record_spam_block' ) ) {
            cf7sr_record_spam_block( 'turnstile' );
        }
        return $result;
    }

    $request = wp_remote_post( 'https://challenges.cloudflare.com/turnstile/v0/siteverify', array(
        'timeout' => 15,
        'body' => array(
            'secret'   => get_option( 'cf7sr_ts_secret' ),
            'response' => sanitize_text_field( $data['cf-turnstile-response'] ),
            'remoteip' => cf7sr_get_ip()
        ),
    ) );

    if ( is_wp_error( $request ) || 200 !== wp_remote_retrieve_response_code( $request ) ) {
        return $result;
    }

    $response = json_decode( wp_remote_retrieve_body( $request ) );

    if ( empty( $response->success ) ) {
        $result->invalidate( array( 'type' => 'cf7sr_turnstile', 'name' => 'cf7sr-turnstile' ), $message );
        if ( function_exists( 'cf7sr_record_spam_block' ) ) {
            cf7sr_record_spam_block( 'turnstile' );
        }
    }

    return $result;
}
add_filter( 'wpcf7_validate_cf7sr_turnstile', 'cf7sr_verify_turnstile', 30, 2 );
