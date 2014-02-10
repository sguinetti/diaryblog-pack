<?php

/**
 * Prepare Admin Menu
 */
function force_private_admin_menu() {
    add_submenu_page('options-general.php', 'ForcePrivate', 'ForcePrivate', 'manage_options', 'force_private_options', 'force_private_options');
}

/**
 * Register Settings
 */
function force_private_settings() {
    register_setting( 'forceprivate-options', 'fp_only_new' );
    register_setting( 'forceprivate-options', 'fp_force_category' );
}

/**
 * Render options page
 */
function force_private_options() {
    ?>
    <div class="wrap">
        <?php screen_icon(); ?>
        <h2>ForcePrivate Options</h2>
        <form method="post" action="options.php">
            <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row">ForcePrivate Options</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span>ForcePrivate Options</span></legend>
                            <?php
                            settings_fields( 'forceprivate-options' );
                            $onlyNew = get_option('fp_only_new');
                            ?>
                            <label for="fp_only_new"><input type="checkbox" name="fp_only_new" id="fp_only_new" value="1"<?php checked( 1 == $onlyNew ); ?> /> Force only NEW posts to private</label>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Force Category</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><span>Force Category</span></legend>
                            <?php
                            $forcedCats = get_option('fp_force_category');
                            $categories = get_categories(array("hide_empty" => 0));
                            foreach ($categories as $cat) {
                                ?>
                                <label for="fp_force_category_<?php echo $cat->term_id; ?>"><input type="checkbox" id="fp_force_category_<?php echo $cat->term_id; ?>" name="fp_force_category[<?php echo $cat->term_id; ?>]" value="<?php echo $cat->term_id; ?>"<?php checked( isset($forcedCats[$cat->term_id]) && $cat->term_id == $forcedCats[$cat->term_id] ); ?> /> <?php echo $cat->name; ?></label><br/>
                                <?php
                            }
                            ?>
                        </fieldset>
                    </td>
                </tr>
            </tbody>
            </table>
            <?php
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

?>
