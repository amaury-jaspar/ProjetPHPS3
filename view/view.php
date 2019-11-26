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
                // on intégre le header
                require_once (File::build_path(array("view", "header.php")));
            ?>

            <main>
                <?php
                    // on intégre la vue que l'on veut voir apparaitre
                    require (File::build_path(array("view", static::$object, $view . ".php")));
                ?>
            </main>
   
            <?php
                // on intégre le footer
                require_once (File::build_path(array("view", "footer.php")));
            ?>

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <!--JavaScript at end of body for optimized loading-->
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

        <script>
            $(document).ready(function(){
                $('select').formSelect();
                $('sidenav').sidenav();
            });
        </script>


    </body>
</html>