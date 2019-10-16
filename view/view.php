<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!-- Social media Font -->
		<link rel="stylesheet" href="https://d1azc1qln24ryf.cloudfront.net/114779/Socicon/style-cf.css?9ukd8d">
		<!-- Materialize: Compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <!-- On créer un lien vers le fichier CSS --> 
		<link rel="stylesheet" type="text/css" href="../css/stylecss.css">

    </head>

    <body>

        <?php

            // utile pour le sticky footer
            echo '<div style="display:flex;min-height:100vh;flex-direction: column;">';
            // on intégre le header
            require_once (File::build_path(array("view", "header.php")));

            // utile pour le sticky footer
            echo '<div style="margin-left:10px;margin-right:10px;flex: 1 0 auto;">';
            // on intégre la vue que l'on veut voir apparaitre
            $filepath = File::build_path(array("view", static::$object, $view . ".php"));
            require ($filepath);
            echo '</div>';

            // on intégre le footer
            require_once (File::build_path(array("view", "footer.php")));
            echo '</div>';            

        ?>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <!--JavaScript at end of body for optimized loading-->
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

      <script>
      </script>

    </body>
</html>