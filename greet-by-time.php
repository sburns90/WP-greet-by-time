<?php
	/*
	Plugin Name: SB - Greet Admin By Time
	Plugin URI: http://wordpress.org/plugins/greet-admin-by-time/
	Description: Changes Howdy message to greet admin depending on time of day. Original concept by Alexader C. Block, complete rewrite by Stephen Burns.
	Version: 1.1
	Author: Stephen Burns
	Author URI: http://www.StephenBurns.net
	License: GPL2
	*/

	/*  Copyright 2015 Stephen Burns  (email : Stephen@StephenBurns.net)
	
    	This program is free software; you can redistribute it and/or modify
    	it under the terms of the GNU General Public License, version 2, as 
    	published by the Free Software Foundation.
	
    	This program is distributed in the hope that it will be useful,
    	but WITHOUT ANY WARRANTY; without even the implied warranty of
    	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    	GNU General Public License for more details.
	
    	You should have received a copy of the GNU General Public License
    	along with this program; if not, write to the Free Software
    	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/

	/* TO DO:
	 * UNFISHIED (4-18-16) Use the user's computer time rather than the servers time. */
?>

<?php
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
