<?php

namespace FilcPress\WordPress;

use Illuminate\Support\ServiceProvider;

class WordPressInstallServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if (! defined('WP_INSTALLING')) {
            return;
        }

        add_action('wp_install', [$this, 'postInstall']);
    }

    /**
     * Fires after WordPress is fully installed.
     *
     * @param WP_User $user The site owner.
     */
    public function postInstall($user)
    {
        $this->deleteDefaultPost();
        $this->deleteDefaultPage();
        $homeId = $this->createHomePage();
        $this->setPageAsStaticFrontPage($homeId);
        $this->removeTagLine();
        $this->updatePermalinks();
        $this->flush();
    }

    /**
     * Remove the post "Hello World!".
     */
    private function deleteDefaultPost()
    {
        wp_delete_post(1, true);
    }

    /**
     * Remove the page "Sample page"
     */
    private function deleteDefaultPage()
    {
        wp_delete_post(2, true);
    }

    /**
     * Create new to be home page.
     */
    private function createHomePage()
    {
        return wp_insert_post([
            'post_type' => 'page',
            'post_status' => 'publish',
            'post_title' => 'Home',
            'post_content' => 'This is the home page.',
        ]);
    }

    /**
     * Set page as static front page.
     *
     * @param int $postId
     */
    private function setPageAsStaticFrontPage($postId)
    {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $postId);
    }

    /**
     * Remove the default tagline.
     */
    private function removeTagLine()
    {
        update_option('blogdescription', '');
    }

    /**
     * Update permalinks structure to SEO friendly
     */
    private function updatePermalinks()
    {
        update_option('permalink_structure', '/%postname%/');
    }

    /**
     * Flush cache and rewrite rules.
     */
    private function flush()
    {
        flush_rewrite_rules();
        wp_cache_flush();
    }
}
