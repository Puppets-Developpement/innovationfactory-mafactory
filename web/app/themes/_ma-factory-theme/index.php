<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage _MaFactory
 * @version 1.0
 */ ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>_MaFactory</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="css/main.css"> -->
	<?php wp_head(); ?>
</head>
<body class="error-page">
    <header>
        <div class="header-logo">
            <a href="<?php echo home_url(); ?>">
                <h2 class="">_maFactory</h2>
            </a>
        </div>
        <div class="header-tabs">
            <a href="<?php echo home_url(); ?>">Planning</a>
            <a href="<?php echo home_url(); ?>/projets">Archives</a>
            <a href="<?php echo home_url(); ?>/contact">Contact</a>
            <a href="<?php echo home_url(); ?>/logout">Déconnexion <i class="fas fa-sign-out-alt"></i></a>
        </div>
    </header>
		<section class="container form section">
			<div class="error-page-title">
				<h1>Page introuvable</h1>
				<p>Veuillez retrouner sur la page d'accueil ou la page d'archives.</p>
			</div>
		</section>

<?php get_footer(); ?>