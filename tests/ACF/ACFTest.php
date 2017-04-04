<?php

namespace FilcPress\Tests\ACF;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ACFTest extends DuskTestCase
{
    protected function setUp()
    {
        parent::setUp();

        wp_insert_post([
            'post_title' => 'cc',
            'post_content' => 'dd',
        ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testACF()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/wp/wp-admin')
                ->assertSee('Username or Email Address')
                ->type('#user_login', env('ADMIN_USERNAME'))
                ->type('#user_pass', env('ADMIN_PASSWORD'))
                ->press('Log In')
                ->assertSee('Welcome to WordPress!')
                ->visit('/wp/wp-admin/post-new.php?post_type=page')
                ->assertSee('Add New Page')
                ->type('post_title', 'ACF testing')
                ->type('acf[automated_test_acf_title]', 'Some title.')
                ->select('page_template', 'acf_testing')
                ->pause(1000)
                ->click('#publish')
                ->waitFor('#message')
                ->assertSee('Page published.')
            ;

            $pageId = $browser->value('#post_ID');

            $browser
                ->clickLink('View Page')
                ->assertSeeIn('#automated_test_acf_title', 'Some title.')
            ;

            $browser
                ->visit('/wp/wp-admin/post.php?post='.$pageId.'&action=edit')
                ->clickLink('Move to Trash')
                ->waitFor('#message')
                ->assertSee('page moved to the Trash.')
                ->visit('/wp/wp-admin/edit.php?post_status=trash&post_type=page')
                ->click('#delete_all')
            ;
        });
    }
}
