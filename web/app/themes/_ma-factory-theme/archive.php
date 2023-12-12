<?php get_header(); ?>

    <section class="section">
        <div class="subheader-archives"> 
            <h1>Retrouvez tous vos projets depuis le début du partenariat.</h1>
        </div>
        <div class="main">
            <div class="archives-content">
                <div class="filter-menu archives-filter">
                    <div class="archives-filter-title">
                        <h3>Filtrer</h3>
                    </div>
                    <ul>
                        <!-- <li class="archives-filter-tags">
                            <p>Par mots-clés :</p>
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Chatbot, ...">
                        </li> -->
                        <li class="archives-filter-years">
                            <p>Par années :</p>
                            <Select width="100%">
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                            </Select>
                            <i class="fas fa-sort-down"></i>
                        </li>
                        <li class="archives-filter-checkbox">
                            <p>Par type :</p>
                            <label for="Anti-Masterclass"><input type="checkbox" id="Anti-Masterclass" value="Anti-Masterclass">Anti-Masterclass</label>
                            <label for="Week-end Challenge"><input type="checkbox" id="Week-end Challenge" value="Week-end Challenge">Week-end Challenge</label>
                            <label for="Copycat"><input type="checkbox" id="Copycat" value="Copycat">Copycat</label>
                            <label for="Projets Free-Time"><input type="checkbox" id="Projets Free-Time" value="Projets Free-Time">Projets Free-Time</label>
                            <label for="Projets Data"><input type="checkbox" id="Projets Data" value="Projets Data">Projets Data</label>
                        </li>
                    </ul>
                </div>
                <?php 
                    $user = wp_get_current_user();
                    $role = $user->roles[0];
                    $temp_role = str_replace("um_", "",$role);
                    $new_role = str_replace("-", " ",$temp_role);

                    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                    $query = array(
                        'post_type'   => 'projets',
                        'meta_key'    => 'date_de_debut',
                        'orderby'     => 'meta_value',
                        'order'       => 'DESC',
                        'posts_per_page' => 10,
                        'paged' => $paged,
                        'tax_query'   => array(
                            array(
                                'taxonomy' => 'entreprises_partenaires',
                                'field' => 'slug',
                                'terms' => $new_role
                            )
                        ),
                    );
                    
                    $latest_projects = new WP_Query( $query );
                    $total_posts = ($latest_projects->found_posts)/10;

                    if( intval(($total_posts % 10)) ) {
                        $total_posts = ceil($total_posts);
                    }
                ?>
                <div class="archives-list">
                    <?php
                        // numeric_pagination();
                        if ( $latest_projects->have_posts() ) {
                            while ( $latest_projects->have_posts() ) : $latest_projects->the_post();
                                $term = get_field('entreprise_partenaire');
                                $new_term = strtolower($term->name);

                                $today = date("Y/m/d");

                                $find = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
                                $replace = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

                                $date_brief = get_field('date_de_debut');
                                $new_brief = explode(" ", $date_brief);

                                $temp_date_brief = str_replace($find, $replace, strtolower($date_brief));
                                $final_date_brief = date('Y/m/d', strtotime($temp_date_brief));

                                
                                $date_restitution = get_field('date_de_fin');
                                $new_restit = explode(" ", $date_restitution);

                                $temp_date_restitution = str_replace($find, $replace, strtolower($date_restitution));
                                $final_date_restitution = date('Y/m/d', strtotime($temp_date_restitution)); 
                    ?>
                    <?php if (!isset($date_restitution)) { ?>
                        <div class="archive-item">
                            <div class="archive-item-type">
                                <p><?php echo $new_brief[0]; ?></p>
                                <p class="date"><?php echo $new_brief[1]; ?></p>
                                <p class="date"><?php echo $new_brief[2]; ?></p>
                            </div>
                            <div class="archive-item-content">
                                <h4><?php the_title(); ?></h4>
                                <p class="archive-item-content-dates"><?php the_field( 'date_de_debut' ); ?></p>
                                <p class="archive-item-content-question"><?php the_field( 'sujet' ); ?></p>
                                <a href="<?php echo get_permalink(); ?>">Voir le contenu</a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="archive-item">
                            <?php if ($final_date_brief > $today) { ?>
                                <div class="archive-item-type">
                                    <p><?php echo $new_brief[0]; ?></p>
                                    <p class="date"><?php echo $new_brief[1]; ?></p>
                                    <p class="date"><?php echo $new_brief[2]; ?></p>
                                </div>
                            <?php } else { ?>
                                <div class="archive-item-type">
                                    <p><?php echo $new_restit[0]; ?></p>
                                    <p class="date"><?php echo $new_restit[1]; ?></p>
                                    <p class="date"><?php echo $new_restit[2]; ?></p>
                                </div>
                            <?php } ?>
                            <div class="archive-item-content">
                                <h4><?php the_title(); ?></h4>
                                <p class="archive-item-content-dates"><?php the_field( 'date_de_debut' ); ?> - <?php the_field( 'date_de_fin' ); ?></p>
                                <p class="archive-item-content-question"><?php the_field( 'sujet' ); ?></p>
                                <a href="<?php echo get_permalink(); ?>">Voir le contenu</a>
                            </div>
                        </div>
                    <?php } endwhile; ?>
                    <?php numeric_pagination($total_posts); ?>
                </div>
                <?php } else { ?>
                    <div class="archive-item empty">
                        <div class="archive-item-type">
                        </div>
                        <div class="archive-item-content">
                            <h4>Aucun projet n'est pour le moment créé.</h4>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>