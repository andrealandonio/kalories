<!doctype html>
<html <?php language_attributes() ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ) ?>">
        <title><?php bloginfo( 'name' ) ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo( 'description' ) ?>">

		<?php wp_head() ?>
	</head>

	<body <?php body_class() ?>>

		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
			<header class="header">

                <!-- logo -->
                <div class="logo">
                    <a href="<?php echo home_url() ?>">
                        Kalories
                    </a>
                </div>
                <!-- /logo -->

			</header>
			<!-- /header -->
