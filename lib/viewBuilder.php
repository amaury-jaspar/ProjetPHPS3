<?php

    class viewBuilder {

    	public static function displayView($v_view, $v_pagetitle) {
        $array = array("view", "view.php");
		$view = $v_view;
		$pagetitle = $v_pagetitle;
		require (File::build_path($array));
	}

}
?>