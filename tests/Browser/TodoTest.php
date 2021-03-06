<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TodoTest extends DuskTestCase
{
     /**
     * Register test.
     *
     * @return void
     */
    public function testRegister()
    {
        $this->browse(function ($browser) {
            $browser->visit('register')
                    ->type('name', 'Ahmed Khan')
                    ->type('email', 'tessa9@cloudways.com')
                    ->type('password', 'ahmedkhan')
                    ->type('password_confirmation', 'ahmedkhan')
                    ->attach('userimage', 'C:\Users\ahmed.khan\Pictures\testominal\tesa.jpg')
                    ->press('Register')
                    ->assertPathIs('/todoapplaravel/public/todo');
        });
    }
  

   /**
     * Create Todo test.
     *
     * @return void
     */
    public function testCreateTodo()
    {
        $this->browse(function ($browser) {
            $browser->visit('todo')
                    ->clickLink('Add Todo')
                    ->type('todo', 'Testing it With Dusk')
                    ->type('category', 'dusk')
                    ->type('description', 'This is created with dusk')
                    ->press('Add')
                    ->assertPathIs('/todoapplaravel/public/todo');
        });
    }

    /**
     * View and Edit Todo Test.
     *
     * @return void
     */
    public function testViewTodo()
    {
        $this->browse(function ($browser) {
            $browser->visit('todo')
                    ->assertVisible('#view5')
                    ->visit(
                        $browser->attribute('#view5', 'href')
                    )
                    ->assertPathIs('/todoapplaravel/public/todo/5')
                    ->clickLink('Edit')
                    ->type('description', 'Testing it with dusk again')
                    ->press('Update')
                    ->assertPathIs('/todoapplaravel/public/todo/5');
        });
    }

    /**
     * Edit todo test.
     *
     * @return void
     */
    public function testEditTodo()
    {
        $this->browse(function ($browser) {
            $browser->visit('todo')
                    ->assertVisible('#edit5')
                    ->visit(
                        $browser->attribute('#edit5', 'href')
                    )
                    ->type('description', 'Testing it with dusk again')
                    ->press('Update')
                    ->assertPathIs('/todoapplaravel/public/todo/5');
        });
    }

    /**
     * Delete Todo test.
     *
     * @return void
     */
    public function testDeleteTodo()
    {
        $this->browse(function ($browser) {
            $browser->visit('todo')
                    ->assertVisible('#delete5')
                    ->visit(
                        $browser->attribute('#delete5', 'href')
                    )
                    ->assertPathIs('/todoapplaravel/public/todo');
        });
    }

    /*
     * Logout test.
     *
     * @return void
     */
    public function testLogout()
    {
        $this->browse(function ($browser) {
            $browser->visit('todo')
                    ->clickLink('Logout')
                    ->assertPathIs('/todoapplaravel/public/login');
        });
    }

    /**
     * Login test.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function ($browser) {
            $browser->visit('login')
                    ->type('email', 'tessa@cloudways.com')
                    ->type('password', 'ahmedkhan')
                    ->press('Login')
                    ->assertPathIs('/todoapplaravel/public/todo');
        });
    }

}
