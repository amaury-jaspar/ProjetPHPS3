<?php

require_once (File::build_path(array('model', 'ModelCategory.php')));
require_once (File::build_path(array('lib', 'ImageUploader.php')));
require_once (File::build_path(array('lib', 'Messenger.php')));

class ControllerCategory {

	protected static $object = "category";

	public static function read() {
		$name = htmlspecialchars(myGet('name'));
		$category = ModelCategory::select($name);
		if ($category == false) {
			$view='error';
            $pagetitle='Error page';
			require_once (File::build_path(array("view", "view.php")));
		} else {
            $view='detail';
			$pagetitle='Detail category';
            require_once (File::build_path(array("view", "view.php")));
		}
	}

	public static function readAll() {
        $tab_category = ModelCategory::selectAll();
		$view='list';
        $pagetitle='Category list';
        require (File::build_path(array("view", "view.php")));
	}

	public static function create() {
		if (Conf::getDebug() == True) { $method = "get"; } else { $method = "post";}
		$name = "";
        $description = "";
		$required = "required";
		$action = "created";
		$view='update';
		$pagetitle='Create Category';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function created() {
		$data = array (
			'name' => myGet('name'),
			'description' => myGet('description')
		);
		var_dump($_FILES);
		if(!empty($_FILES['img'])) { ImageUploader::uploadImg();}
		$category = new ModelCategory($data);
		$category->save($data);
		$tab_category = ModelCategory::selectAll();
		$view='created';
		$pagetitle='Category Created';
		require (File::build_path(array("view", "view.php")));
	}

	public static function delete() {
		$category = myGet('name');
		ModelCategory::deleteById(myGet('name'));
		$tab_category = ModelCategory::selectAll();
		$view='deleted';
		$pagetitle='Delete Category';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function update() {
		// tester si le nom de la categorie n'existe pas déjà dans la BDD et renvoyer vers le formulaire si c'est le cas
		if (Conf::getDebug() == True) { $method = "get"; } else { $method = "post";}
		$category = ModelCategory::select(myGet('name'));
		$name = htmlspecialchars($category->get('name'));
		$description = htmlspecialchars($category->get('description'));
		$required = "readonly";
		$action = "updated";
		$view='update';
		$pagetitle='Update Category';
		require_once (File::build_path(array("view", "view.php")));
	}

    public static function updated() {
		$data = array (
			'name' => myGet('name'),
			'description' => myGet('description'),
		);
		ModelCategory::updateByID($data);
		$view='updated';
		$pagetitle='Category updated';
		require_once (File::build_path(array("view", "view.php")));

	}

}

?>
