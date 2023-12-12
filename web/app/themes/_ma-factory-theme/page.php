<?php if (is_page('login')) { 
	get_header('login');	
?>

			<section class="container form">
				<div class="login-page-title">
					<h1>_maFactory</h1>
                    <?php $blog_title = get_bloginfo( 'description' ); ?>
                    <p><?php echo $blog_title; ?></p>
				</div>
				<div class="login-page-connection">
					<h2>Connexion</h2>
					<?php
						while ( have_posts() ) :
							the_post();
							the_content();
					?>
					<?php endwhile; ?>
				</div>
			</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		</body>
	</html>

<?php } elseif (is_page('contact')) {
	get_header();
?>

	<div class="body-contact">
        <div class="main main-contact">
            <div class="contact-left">
                <h1>Nous contacter</h1>
                <ul>
                    <li>
                        <p><i class="fas fa-map-pin"></i>59, Rue Nationale, 75013 Paris</p>
                    </li>
                    <li>
                        <p><i class="fas fa-phone"></i>+33 (0)1 40 09 04 10</p>
                    </li>
                    <li>
                        <p><i class="fas fa-paper-plane"></i>contact@innovationfcty.fr</p>
                    </li>
                    <li>
                        <p><i class="fas fa-tag"></i><a href="innovationfcty.fr" target="blank">innovationfcty.fr</a></p>
                    </li>
                </ul>
            </div>
            <div class="contact-right">
                <h2>Un message ?</h2>
				<?php
						while ( have_posts() ) :
							the_post();
							the_content();
					?>
				<?php endwhile; ?>
            </div>
        </div>
    </div>

<?php get_footer(); } else { ?>
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
<body class="error-page error-bis">
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

	<?php
	get_footer();
} ?>