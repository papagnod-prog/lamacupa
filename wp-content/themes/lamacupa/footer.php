<footer class="site-footer" id="siteFooter">
    <div class="container">
        <div class="footer-top">

            <!-- Brand Column -->
            <div class="footer-brand">
                <div class="footer-brand__logo-text">
                    <?php
                    if ( has_custom_logo() ) {
                        $logo_id  = get_theme_mod( 'custom_logo' );
                        echo wp_get_attachment_image( $logo_id, [120, 60], false, [
                            'class' => 'footer-brand__logo-img',
                            'alt'   => esc_attr( get_bloginfo( 'name' ) ),
                            'style' => 'height:50px;width:auto;filter:brightness(0) invert(1);margin-bottom:12px',
                        ] );
                    } else {
                        echo '<span>' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
                    }
                    ?>
                </div>
                <p class="footer-brand__tagline">Olio Extravergine d&rsquo;Oliva di Alta Qualit&agrave;</p>
                <p class="footer-brand__desc">
                    Produttori di olio extravergine d'oliva dal profondo cuore della Puglia e Basilicata.
                    Una storia di famiglia, terra e passione che si tramanda di generazione in generazione,
                    nel rispetto della natura e della tradizione.
                </p>

                <!-- Social Links -->
                <div class="footer-social">
                    <a
                        href="https://www.instagram.com/lamacupa"
                        class="footer-social__link"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="<?php esc_attr_e( 'Seguici su Instagram', 'lamacupa' ); ?>"
                    >
                        <!-- Instagram SVG icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    <a
                        href="https://www.facebook.com/lamacupa"
                        class="footer-social__link"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="<?php esc_attr_e( 'Seguici su Facebook', 'lamacupa' ); ?>"
                    >
                        <!-- Facebook SVG icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                </div>
            </div><!-- /.footer-brand -->

            <!-- Quick Links Column -->
            <div class="footer-col">
                <h3 class="footer-col__title"><?php esc_html_e( 'Link Rapidi', 'lamacupa' ); ?></h3>
                <nav class="footer-nav" aria-label="<?php esc_attr_e( 'Link rapidi footer', 'lamacupa' ); ?>">
                    <?php
                    if ( has_nav_menu( 'footer' ) ) {
                        wp_nav_menu( [
                            'theme_location' => 'footer',
                            'container'      => false,
                            'menu_class'     => 'footer-nav',
                            'items_wrap'     => '%3$s',
                            'depth'          => 1,
                        ] );
                    } else {
                        $links = [
                            home_url( '/' )                  => 'Home',
                            home_url( '/chi-siamo/' )         => 'Chi Siamo',
                            home_url( '/la-nostra-terra/' )   => 'La Nostra Terra',
                            home_url( '/gli-orci/' )          => 'Gli Orci',
                            home_url( '/premi/' )             => 'Premi',
                            home_url( '/olioturismo/' )       => 'Olioturismo',
                            home_url( '/prodotti/' )          => 'Prodotti',
                            home_url( '/contatti/' )          => 'Contatti',
                        ];
                        foreach ( $links as $url => $label ) {
                            printf( '<a href="%s">%s</a>', esc_url( $url ), esc_html( $label ) );
                        }
                    }
                    ?>
                </nav>
            </div><!-- /.footer-col -->

            <!-- Contact Column -->
            <div class="footer-col">
                <h3 class="footer-col__title"><?php esc_html_e( 'Contatti', 'lamacupa' ); ?></h3>

                <div class="footer-contact-item">
                    <span class="footer-contact-item__icon" aria-hidden="true">📍</span>
                    <span class="footer-contact-item__text">
                        Via Lamacupa<br>
                        Montescaglioso (MT)<br>
                        Basilicata, Italia
                    </span>
                </div>

                <div class="footer-contact-item">
                    <span class="footer-contact-item__icon" aria-hidden="true">📞</span>
                    <span class="footer-contact-item__text">
                        <a href="tel:+39000000000" style="color:inherit">+39 000 000 0000</a>
                    </span>
                </div>

                <div class="footer-contact-item">
                    <span class="footer-contact-item__icon" aria-hidden="true">✉️</span>
                    <span class="footer-contact-item__text">
                        <a href="mailto:info@lamacupa.it" style="color:inherit">info@lamacupa.it</a>
                    </span>
                </div>

                <div class="footer-contact-item" style="margin-top:16px">
                    <span class="footer-contact-item__icon" aria-hidden="true">🕐</span>
                    <span class="footer-contact-item__text">
                        <strong style="color:rgba(255,255,255,0.85)"><?php esc_html_e( 'Visite in azienda', 'lamacupa' ); ?></strong><br>
                        <?php esc_html_e( 'Lun–Sab: 9:00–18:00', 'lamacupa' ); ?><br>
                        <?php esc_html_e( 'Dom: su prenotazione', 'lamacupa' ); ?>
                    </span>
                </div>
            </div><!-- /.footer-col -->

        </div><!-- /.footer-top -->
    </div><!-- /.container -->

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <p>
                &copy; <?php echo esc_html( date( 'Y' ) ); ?>
                <?php bloginfo( 'name' ); ?>.
                <?php esc_html_e( 'Tutti i diritti riservati.', 'lamacupa' ); ?>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <a href="<?php echo esc_url( home_url( '/cookie-policy/' ) ); ?>">Cookie Policy</a>
                &nbsp;&nbsp;|&nbsp;&nbsp;
                <?php esc_html_e( 'P.IVA:', 'lamacupa' ); ?> IT0000000000
            </p>
        </div>
    </div>

</footer><!-- /.site-footer -->

<?php wp_footer(); ?>
</body>
</html>
