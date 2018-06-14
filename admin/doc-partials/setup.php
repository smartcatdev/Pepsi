<h2 class="section-heading">
    <?php esc_html_e( 'Quick-Start Guide', 'pepsi' ); ?>
</h2>

<div class="quickstart-cta">
    <a href="<?php echo esc_url( admin_url( 'themes.php?page=pepsi-theme-info#choose-navbar' ) ); ?>">
        <img alt="<?php esc_attr_e( 'Select a Navbar', 'pepsi' ); ?>" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/docs/quick_start/pepsi_qs_navbar.jpg' ); ?>">
    </a>
</div>
<div class="quickstart-cta">
    <a href="<?php echo esc_url( admin_url( 'themes.php?page=pepsi-theme-info#add-menu' ) ); ?>">
        <img alt="<?php esc_attr_e( 'Adding Your Menus', 'pepsi' ); ?>" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/docs/quick_start/pepsi_qs_menus.jpg' ); ?>">
    </a>
</div>
<div class="quickstart-cta">
    <a href="<?php echo esc_url( admin_url( 'themes.php?page=pepsi-theme-info#setup-blog' ) ); ?>">
        <img alt="<?php esc_attr_e( 'Select a Blog Layout', 'pepsi' ); ?>" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/docs/quick_start/pepsi_qs_blog.jpg' ); ?>">
    </a>
</div>

<div class="clear"></div>

<div class="quickstart-cta">
    <a href="<?php echo esc_url( admin_url( 'themes.php?page=pepsi-theme-info#customize-header' ) ); ?>">
        <img alt="<?php esc_attr_e( 'Setting Up Your Header', 'pepsi' ); ?>" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/docs/quick_start/pepsi_qs_header.jpg' ); ?>">
    </a>
</div>
<div class="quickstart-cta">
    <a href="<?php echo esc_url( admin_url( 'themes.php?page=pepsi-theme-info#page-templates' ) ); ?>">
        <img alt="<?php esc_attr_e( 'Using Page Templates', 'pepsi' ); ?>" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/docs/quick_start/pepsi_qs_templates.jpg' ); ?>">
    </a>
</div>
<div class="quickstart-cta">
    <a href="<?php echo esc_url( admin_url( 'themes.php?page=pepsi-theme-info#theme-presets' ) ); ?>">
        <img alt="<?php esc_attr_e( 'Using Theme Presets', 'pepsi' ); ?>" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/docs/quick_start/pepsi_qs_presets.jpg' ); ?>">
    </a>
</div>

<div class="clear"></div>

<?php pepsi_render_doc( 'navbar' ); ?>

<?php pepsi_render_doc( 'menus' ); ?>

<?php pepsi_render_doc( 'blog' ); ?>

<?php pepsi_render_doc( 'custom_header' ); ?>

<?php pepsi_render_doc( 'page_templates' ); ?>

<?php pepsi_render_doc( 'theme_presets' ); ?>