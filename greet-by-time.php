<?php
/*
	Plugin Name: Greet By Time
	Plugin URI: https://www.github.com/sburns90/WP-greet-by-time/
	Description: Replace the unprofessional 'Howdy' message with a greeting based on time of day.
	Version: 1.1
	Author: Stephen Burns
	Author URI: http://www.StephenBurns.net
	License: GPLv2
*/
?>

<?php
/* TODO: Make the script use the USER time. Either get the user's time 
   from the timezone listed in their profile OR query their computer for the time.
*/
   
add_filter('admin_bar_menu', 'change_howdy', 10, 3);

function change_howdy($wp_admin_bar) {
	$blogtime = current_time( 'mysql' ); 
	list( $today_year, $today_month, $today_day, $hour, $minute, $second ) = split( '([^0-9])', $blogtime );
	if ($hour <= 11){
		$greet = "Good Morning";
	}
	if ($hour >= 12 && $hour <= 16){
		$greet = "Good Afternoon";
	}
	if ($hour >= 17 && $hour <= 21){
		$greet = "Good Evening";
	}
	if ($hour >= 22){
		$greet = "Go To Sleep";
	}

	$user_id = get_current_user_id();
	$current_user = wp_get_current_user();

	if ( 0 != $user_id ) {
		/* Add the "My Account" menu */
		$newtitle = sprintf( __('%1$s, %2$s'), $greet, $current_user->display_name );
	
		$wp_admin_bar->add_node( array(
			'id' => 'my-account',
				'title' => $newtitle
			) );
	}
}   
?>
