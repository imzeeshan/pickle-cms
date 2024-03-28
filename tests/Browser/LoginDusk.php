<?php

use Laravel\Dusk\Browser;

test('login', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')
            ->type('email', "admin@picklecms.com")
            ->type('password', 'admin')
            ->press('Sign in');

        $browser->screenshot('success.png');
    });
});
