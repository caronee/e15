<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;
    use withFaker;

    /**
     *
     */
    public function testRegistration()
    {
        $this->browse(function (Browser $browser) {
            $name = $this->faker()->name;

            $browser->visit('/')
                    ->click('@register-link')
                    ->assertVisible('@register-heading')
                    ->type('@name-input', $name)
                    ->type('@email-input', $this->faker()->email)
                    ->type('@password-input', 'asdfasdf')
                    ->type('@password-confirm-input', 'asdfasdf')
                    ->click('@register-button')
                    ->assertSee($name);
        });
    }

    /**
     *
     */
    public function testFailedRegistration()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/register')
                    ->click('@register-button')
                    ->assertVisible('@error-field-name')
                    ->assertVisible('@error-field-email')
                    ->assertVisible('@error-field-password');
        });
    }

    /**
     *
     */
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $password = 'asdfasdf';
            $user = User::factory()->create(['password' => Hash::make('asdfasdf')]);

            $browser->logout()
                    ->visit('/login')
                    ->type('@email-input', $user->email)
                    ->type('@password-input', $password)
                    ->click('@login-button')
                    ->assertVisible('@welcome-heading')
                    ->assertSee($user->name);
        });
    }

    /**
     *
     */
    public function testFailedLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/login')
                    ->type('@email-input', 'fail@gmail.com')
                    ->type('@password-input', 'fail')
                    ->click('@login-button')
                    ->assertVisible('@error-field-email')
                    ->assertSee('These credentials do not match our records.');
        });
    }
    
    /**
    *
    */
    public function testAuthorizationRequired()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/specimens')
                    ->assertPresent('@login-heading')
                    ->visit('/list')
                    ->assertPresent('@login-heading');
        });
    }
}