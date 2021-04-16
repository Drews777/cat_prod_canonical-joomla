<?add_action( 'transition_post_status', 'intercept_all_status_changes', 10, 3 );
function intercept_all_status_changes( $new_status, $old_status, $post ) {
	if ( $new_status != $old_status ) {
		// Статус поста изменен
        $handle = fopen("/home/krymresurs/krymresurs.ru/logs/access_log.txt", "a");
        $line = date('Y-m-d H:i:s')." - $_SERVER[REMOTE_ADDR]"." - $_SERVER[REQUEST_URI]"." - Статус страницы изменен";
        fwrite($handle, $line . "\n");
        fclose($handle);
	}
}?>