    <footer>
        <h2><?php echo get_theme_mod('rapsoo_footer_heading'); ?></h2>
        <?php if (!empty (get_theme_mod( 'rapsoo_email_address' ))): ?>
            <a class="anchor-button" href="mailto:<?php echo get_theme_mod( 'rapsoo_email_address' ); ?>">
                <span class="fas fa-at" aria-hidden="true"></span> <?php echo get_theme_mod( 'rapsoo_email_address' ); ?>
            </a>
        <?php endif; ?>
        <h3 class="sr-only">Social media links</h3>

        <ul>
            <?php if (!empty (get_theme_mod( 'rapsoo_linkedin_link' ))): ?>
                <li>
                    <a class="anchor-button" href="<?php echo get_theme_mod( 'rapsoo_linkedin_link' ); ?>"><span
                            class="fab fa-linkedin" aria-hidden="true"></span> LinkedIn</a>
                </li>
            <?php endif; ?>
            <?php if (!empty (get_theme_mod( 'rapsoo_github_link' ))): ?>
                <li><a class="anchor-button" href="<?php echo get_theme_mod( 'rapsoo_github_link' ); ?>"><span class="fab fa-github"
                            aria-hidden="true"></span> GitHub</a>
                </li>
            <?php endif; ?>
            <?php if (!empty (get_theme_mod( 'rapsoo_instagram_link' ))): ?>
                <li>
                    <a class="anchor-button" href="<?php echo get_theme_mod( 'rapsoo_instagram_link' ); ?>">
                        <span class="fab fa-instagram" aria-hidden="true"></span> Instagram
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </footer>
</div>
<?php wp_footer(); ?>
</body>

</html>