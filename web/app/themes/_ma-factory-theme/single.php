<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<?php if ( is_singular( 'projets' ) ): ?>
    <section class="main main-event section">
        <?php while ( have_posts() ) : the_post(); ?>
        
        <div class="subheader-event">
            <h2>
				<?php the_field( 'type_du_projet' ); ?><span><?php the_field( 'sujet' ); ?></span>
            </h2>
            <p>
				<?php the_field( 'date_de_brief' ); ?>
                <span>
                    <?php
                        $term = wp_get_post_terms($post->ID, 'entreprises_partenaires', array("fields" => "names"));
                        echo $term[0];
                    ?>
                </span>
            </p>
        </div>
        <div class="event-infos">
            <div class="event-infos-content">
                <div class="content-description">
                    <h3>Description</h3>
                    <p>
                        <?php the_field( 'description' ); ?>
                    </p>
                </div>
                <div class="content-files">
                    <h3>Rendus des équipes</h3>
                    <?php if( (have_rows('rendus_des_equipes')) ) { ?>
                    <ul>
                    <?php 
						while( have_rows('rendus_des_equipes') ): the_row();
							if( get_row_layout() == 'ajout_dun_rendu_dequipe' ):
                                    $fichier = get_sub_field('fichier');
                                    if (strlen($fichier['title']) > 25) {
                                        $new_fichier = substr($fichier['title'], 0, 22) . '...';
                                    } else {
                                        $new_fichier = $fichier['title'];
                                    }
					?>
                        <li>
                            <?php //print_r($fichier); ?>
                            <a href="<?php echo $fichier['url']; ?>" download="<?php echo $new_fichier; ?>"><i class="far fa-file-pdf fa-3x"></i><span><?php echo $new_fichier?></span></a>
                        </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
                    <?php } else { ?>
                        <li id="no-files">
                            <i class="far fa-times-circle fa-2x"></i><span>Aucun rendu n'est encore disponible.</span>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
            </div>
            <?php $date_restitution = get_field('date_de_fin');
            if (!isset($date_restitution)) { ?>
            <div class="event-infos-sidebar">
                <div class="event-infos-sidebar-infos">
                    <div class="event-infos-sidebar-infos-date">
                        <h5>Événement</h5>
                        <p><i class="far fa-calendar-alt"></i>Le <?php the_field( 'date_de_debut' ); ?> à <?php the_field( 'heure_de_levenement' ); ?></p>
                        <p><i class="fas fa-map-marker-alt"></i><?php the_field( 'lieu_de_levenement' ); ?></p>
                    </div>
                </div>
            </div>
            <?php } else { ?>
            <div class="event-infos-sidebar">
                <div class="event-infos-sidebar-infos">
                    <div class="event-infos-sidebar-infos-date">
                        <h5>Brief</h5>
                        <p><i class="far fa-calendar-alt"></i>Le <?php the_field( 'date_de_debut' ); ?> à <?php the_field( 'heure_de_brief' ); ?></p>
                        <p><i class="fas fa-map-marker-alt"></i><?php the_field( 'lieu_de_brief' ); ?></p>
                    </div>
                    <div class="event-infos-sidebar-infos-address">
                        <h5>Restitution</h5>
                        <p><i class="far fa-calendar-alt"></i>Le <?php the_field( 'date_de_fin' ); ?> à <?php the_field( 'heure_de_resitution' ); ?></p>
                        <p><i class="fas fa-map-marker-alt"></i><?php the_field( 'lieu_de_restitution' ); ?></p>
                    </div> 
                </div>
            </div>
            <?php } ?>
		</div>
		
        <?php endwhile; ?>
	</section>

<?php elseif( is_singular( 'ifevents' ) ):  ?>
    <section class="main main-event section">
        <?php while ( have_posts() ) : the_post(); ?>
        
        <div class="subheader-event">
            <h2>
                <?php the_field( 'date_de_debut' ); ?>
            </h2>
            <p>
                <?php the_title(); ?>
                <span>
					<?php the_field( 'type_devenement' ); ?>
                </span>
            </p>
        </div>
        <div class="event-infos">
            <div class="event-infos-content">
                <div>
                    <h3>Description</h3>
                    <p>
                        <?php the_field( 'description' ); ?>
                    </p>
                </div>
            </div>
            <div class="event-infos-sidebar">
                <?php if (get_field('lien_eventbrite') !== '' ): ?>
                <div class="event-infos-sidebar-sub">
                    <a href="<?php the_field( 'lien_eventbrite' ); ?>">S'inscrire</a>
                </div>
                <?php endif; ?>
                <div class="event-infos-sidebar-infos">
                    <?php $date_de_fin = get_field('heure_de_fin');
                    if ($date_de_fin == '') { ?>
                    <div class="event-infos-sidebar-infos-date">
                        <h5>Date et heure</h5>
                        <p>Le <?php the_field( 'date_de_debut' ); ?><span>À <?php the_field( 'heure_de_debut' ); ?></span></p>
                    </div>
                    <?php } else { ?>
                    <div class="event-infos-sidebar-infos-date">
                        <h5>Date et heure</h5>
                        <p>Le <?php the_field( 'date_de_debut' ); ?><span>De <?php the_field( 'heure_de_debut' ); ?> à <?php the_field( 'heure_de_fin' ); ?></span></p>
                    </div>
                    <?php } ?>
                    <div class="event-infos-sidebar-infos-address">
                        <h5>Adresse</h5>
                        <p><?php the_field( 'lieu' ); ?></p>
                    </div> 
                </div>
            </div>
        </div>
        <div class="event-contact">
            <p>Des questions concernant l'événement ?</p>
            <button class="submit">Contactez-nous</button>
        </div>

        <?php endwhile; ?>
	</section>

<?php endif; ?>

<?php get_footer(); ?>