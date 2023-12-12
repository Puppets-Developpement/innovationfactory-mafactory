<?php get_header(); ?>

<div class="body-home section">
    <section class="main">
        <?php 
            $user = wp_get_current_user();
            $role = $user->roles[0];
            $temp_role = str_replace("um_", "",$role);
            $new_role = str_replace("-", " ",$temp_role);

            $global_array = [];

            $args = array(
                'post_type'   => 'projets',
                'meta_key'    => 'date_de_debut',
                'orderby'     => 'meta_value',
                'order'       => 'DESC',
                'posts_per_page' => -1,
                'tax_query'   => array(
                    array(
                        'taxonomy' => 'entreprises_partenaires',
                        'field' => 'slug',
                        'terms' => $new_role
                    )
                ),
            );
            
            $latest_projects = new WP_Query( $args );
            $count = $latest_projects->post_count;

            $args_2 = array(
                'post_type'   => 'ifevents',
                'meta_key'    => 'date_de_debut',
                'orderby'     => 'meta_value',
                'order'       => 'DESC',
                'posts_per_page' => -1
            );
            
            $latest_ifevents = new WP_Query( $args_2 );


            function array_push_assoc($array, $key, $value){
                $array[$key] = $value;
                return $array;
            }
        ?>
        <div class="subheader-home">
            <ul>
                <!-- <li><p><span>2</span>Années de partenariat</p></li> -->
                <?php
                    $en_cours = 0;
                    if ( $latest_projects->have_posts() ) :
                        while ($latest_projects->have_posts() ) :
                            $latest_projects->the_post();

                            //$today = date("Y/m/d");
                            $today = new Datetime();

                            $find = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
                            $replace = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

                            $date_brief = get_field('date_de_debut');
                            $new_brief = explode(" ", $date_brief);

                            $temp_date_brief = str_replace($find, $replace, strtolower($date_brief));
                            // $final_date_brief = date('Y/m/d', strtotime($temp_date_brief));
                            $final_date_brief = new Datetime($temp_date_brief);

                            
                            $date_restitution = get_field('date_de_fin');
                            $new_restit = explode(" ", $date_restitution);

                            $temp_date_restitution = str_replace($find, $replace, strtolower($date_restitution));
                            //$final_date_restitution = date('Y/m/d', strtotime($temp_date_restitution));
                            $final_date_restitution = new Datetime($temp_date_restitution);
                            $temp_data = [];
                            // var_dump($today, $final_date_restitution);

                            // Compteurs projets en cours
                            if ($final_date_restitution > $today) {
                                $en_cours ++;
                                $temp_data += [
                                    "is_project" => true,
                                    "title" => get_the_title(),
                                    "date_de_debut" => get_field('date_de_debut'),
                                    "date_de_fin" => get_field('date_de_fin'),
                                    "type" => get_field('type_du_projet'),
                                    "lien" => get_permalink()
                                ];
                            };
                            $amc = 0;
                            if (!isset($date_restitution)) {
                                if ($final_date_brief > $today) {
                                    $amc ++;

                                    // $temp_data += [ "is_project" => false ];
                                    // $temp_data += [ "title" => get_the_title() ];
                                    // $temp_data += [ "date_de_debut" => get_field('date_de_debut') ];
                                    // $temp_data += [ "date_de_fin" => get_field('date_de_fin') ];
                                    // $temp_data += [ "heure_de_debut" => get_field('heure_de_debut') ];
                                    // $temp_data += [ "heure_de_fin" => get_field('heure_de_fin') ];
                                    // $temp_data += [ "type" => get_field('type_devenement') ];
                                    // $temp_data += [ "lien" => get_permalink() ];
                                };
                            };
                            $en_cours = $en_cours + $amc;

                            // echo print_r($temp_data);

                        endwhile;
                    endif;
                ?>
                    <li><p><span><?php echo $en_cours; ?></span>Projets en cours</p></li>
                    <li><p><span><?php echo ($count - $en_cours); ?></span>Projets réalisés</p></li>
                <!-- <li><p><span>10</span>Etudiants en stage/alternance</p></li>
                <li><p><span>1</span>Factorien recruté</p></li> -->
                <!-- À REMETTRE POUR LA V2 -->
            </ul>                    
        </div>
        <div class="dashboard">
            <div class="dashboard-header">
                <h2>Événements IF</h2>
                <img src="<?php bloginfo('template_directory'); ?>/img/if-logo.png" alt="if-logo" class="logo"/>
                <h2>Rendez-vous projets</h2>
            </div>
            <div class="dashboard-timeline">
                <div class="dashboard-timeline-line"></div>
                <div class="dashboard-timeline-list">
                <?php
                    if ( $latest_projects->have_posts() ) {
                        while ($latest_projects->have_posts() ) {
                            $latest_projects->the_post();

                            // $today = date("Y/m/d");
                            $today = new Datetime();

                            $find = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
                            $replace = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

                            $date_brief = get_field('date_de_debut');
                            $new_brief = explode(" ", $date_brief);

                            $temp_date_brief = str_replace($find, $replace, strtolower($date_brief));
                            // $final_date_brief = date('Y/m/d', strtotime($temp_date_brief));
                            $final_date_brief = new Datetime($temp_date_brief);

                            
                            $date_restitution = get_field('date_de_fin');
                            $new_restit = explode(" ", $date_restitution);

                            $temp_date_restitution = str_replace($find, $replace, strtolower($date_restitution));
                            // $final_date_restitution = date('Y/m/d', strtotime($temp_date_restitution));
                            $final_date_restitution = new Datetime($temp_date_restitution);
                            

                            if ($final_date_restitution > $today) {
                ?>
                    <div class="item-pr">  
                        <div class="timeline-item type-pr">
                            <div class="timeline-item-type" style="background-color: #64c3f0">
                                <?php 
                                    if ($final_date_brief > $today) { ?>
                                        <p><?php echo $new_brief[0]; ?></p>
                                        <p class="date"><?php echo $new_brief[1]; ?></p>
                                        <p class="date"><?php echo $new_brief[2]; ?></p>
                                    <?php
                                    } else { ?>
                                        <p><?php echo $new_restit[0]; ?></p>
                                        <p class="date"><?php echo $new_restit[1]; ?></p>
                                        <p class="date"><?php echo $new_restit[2]; ?></p>
                                    <?php
                                    };
                                ?>  
                            </div>
                            <div class="timeline-item-content">
                                <h4><?php the_title(); ?></h4>
                                <p class="timeline-item-content-dates"><?php the_field('date_de_debut'); ?> - <?php the_field('date_de_fin'); ?></p>
                                <p class="timeline-item-content-question"><?php the_field('type_du_projet'); ?></p>
                                <a href="<?php echo get_permalink(); ?>" style="background-color: #64c3f0">Voir le projet</a>
                            </div>
                        </div>
                    </div>
                <?php } elseif (!isset($date_restitution) && $final_date_brief > $today) { ?>
                    <div class="item-pr">  
                        <div class="timeline-item type-pr">
                            <div class="timeline-item-type" style="background-color: #64c3f0">
                                <p><?php echo $new_brief[0]; ?></p>
                                <p class="date"><?php echo $new_brief[1]; ?></p>
                                <p class="date"><?php echo $new_brief[2]; ?></p>
                            </div>
                            <div class="timeline-item-content">
                                <h4><?php the_title(); ?></h4>
                                <p class="timeline-item-content-dates"><?php the_field('date_de_debut'); ?></p>
                                <p class="timeline-item-content-question"><?php the_field('type_du_projet'); ?></p>
                                <a href="<?php echo get_permalink(); ?>" style="background-color: #64c3f0">Voir le projet</a>
                            </div>
                        </div>
                    </div>
                <?php
                            }
                        }
                    } else {
                ?>
                <div class="item-pr">  
                    <div class="timeline-item empty">
                        <div class="timeline-item-type">
                        </div>
                        <div class="timeline-item-content">
                            <h4>Aucun projet en cours ou à venir.</h4>
                        </div>
                    </div>
                </div>
                    <?php } ?>


                <?php
                    if ( $latest_ifevents->have_posts() ) {
                        while ($latest_ifevents->have_posts() ) :
                            $latest_ifevents->the_post();

                            // setlocale(LC_TIME, "fr_FR");
                            // $today = strftime("%e %B %Y");

                            // $today = date("Y/m/d");
                            $today = new Datetime();

                            $find = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
                            $replace = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

                            $date_evenement = get_field('date_de_debut');
                            $new_event = explode(" ", $date_evenement);

                            $temp_date = str_replace($find, $replace, strtolower($date_evenement));
                            $final_date = new Datetime($temp_date);
                            

                            if ($final_date > $today) {
                ?>
                        <div class="item-ev"> 
                            <div class="timeline-item type-ev">
                                <div class="timeline-item-type" style="background-color: #F06475">
                                    <p><?php echo $new_event[0]; ?></p>
                                    <p class="date"><?php echo $new_event[1]; ?></p>
                                    <p class="date"><?php echo $new_event[2]; ?></p>
                                </div>
                                <div class="timeline-item-content">
                                    <h4><?php the_title(); ?></h4>
                                    <?php if(get_field('heure_de_fin') == '') { ?>
                                        <p class="timeline-item-content-dates">Le <?php the_field('date_de_debut'); ?> de <?php the_field('heure_de_debut'); ?> à <?php the_field('heure_de_fin'); ?></p>
                                    <?php } else { ?>
                                        <p class="timeline-item-content-dates">Le <?php the_field('date_de_debut'); ?> à <?php the_field('heure_de_debut'); ?></p>
                                    <?php } ?>
                                    <p class="timeline-item-content-question"><?php the_field('type_devenement'); ?></p>
                                    <a href="<?php echo get_permalink(); ?>" style="background-color: #F06475">S'inscrire</a>
                                </div>
                            </div>
                        </div>
                    <?php  }
                        endwhile;
                        } else { 
                    ?>
                    <div class="item-ev">  
                        <div class="timeline-item empty">
                            <div class="timeline-item-type">
                            </div>
                            <div class="timeline-item-content">
                                <h4>Aucun événement de prévu pour le moment.</h4>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>