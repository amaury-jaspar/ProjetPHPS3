<?php

	require_once (File::build_path(array('model', 'ModelCategory.php')));
	
class ControllerCategory {

	protected static $object = "category";

	public static function read() {
		$id = htmlspecialchars(Routeur::myGet('id'));
		$category = ModelCategory::select($id);
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
		$id = NULL;
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
			'id' => Routeur::myGet('id'),
			'name' => Routeur::myGet('name'),
			'description' => Routeur::myGet('description')
		);
		$category = new ModelCategory($data);
		$category->save($data);
		$tab_category = ModelCategory::selectAll();
		$view='created';
		$pagetitle='Category Created';
		require (File::build_path(array("view", "view.php")));
	}

	public static function delete() {
		$category = Routeur::myGet('id');
		ModelCategory::deleteById($id);
		$tab_category = ModelCategory::selectAll();
		$controller= static::$object;
		$view='deleted';
		$pagetitle='Delete Category';
		require_once (File::build_path(array("view", "view.php")));
	}

	public static function update() {
		$id = Routeur::myGet('id');
		$category = ModelCategory::select($id);
		$name = $category->get('name');
		$description = $category->get('description');
		$required = "readonly";
		$action = "updated";
		$view='update';
		$pagetitle='Update Category';
		require_once (File::build_path(array("view", "view.php")));
	}

    public static function updated() {
		$data = array (
			'id' => Routeur::myGet('id'),
			'name' => Routeur::myGet('name'),
			'description' => Routeur::myGet('description'),
		);
		ModelCategory::updateByID($data);
		$tab_category = ModelCategory::selectAll();
		$view='updated';
		$pagetitle='Category updated';
		require_once (File::build_path(array("view", "view.php")));
	}







}

?>