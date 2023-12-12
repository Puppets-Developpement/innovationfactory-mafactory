<?php get_header() ?>

<div class="Home">
    <h1 class="Oswald">_INNOVATION FACTORY</h1>
    <div class="Content">
        <div class="Presentation">
            <h2 class="Oswald">_maFactory</h2>
            <?php $blog_title = get_bloginfo( 'description' ); ?>
            <p><?php echo $blog_title; ?></p>
        </div>
        <div class="ConnectForm">
        <h2>Connexion</h2>
            <form>
                <label>
                    <p>Adresse mail</p>
                    <input type="text" name="name" class="connect"/>
                </label>
                <label>
                    <p>Mot de passe</p>
                    <input type="password" name="name" class="connect"/>
                </label>
                <input type="submit" value="Log in" class="validate"/>
            </form>
        </div>
    </div>
</div>

<?php get_footer() ?>