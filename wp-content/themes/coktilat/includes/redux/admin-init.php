<?php

 if ( file_exists( dirname( __FILE__ ) . '/ReduxCore/framework.php' ) ) {

	require_once dirname( __FILE__ ) . '/ReduxCore/framework.php';

}

if ( file_exists( dirname( __FILE__ ) . '/admin-option.php' ) ) {

require_once( dirname( __FILE__ ) . '/admin-option.php' );

}


/*
if ( file_exists( dirname( __FILE__ ) . '/sample-config.php' ) ) {
require_once( dirname( __FILE__ ) . '/sample-config.php' );
}

if ( file_exists( dirname( __FILE__ ) . '/theme-option.php' ) ) {

require_once( dirname( __FILE__ ) . '/theme-option.php' );

}