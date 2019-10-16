<?php

	require_once (File::build_path(array('model', 'ModelUser.php')));

	class ControllerUser {

		protected static $object = "user";

		public static function read() {
			echo "Welcome to the Pied de Chaise";
		}

		public static function readAll() {

		}        

		public static function create() {

		}

		public static function created() {
		
		}

		public static function delete() {

		}

		public static function update() {
		
		}

		public static function updated() {

		}

	}

?>