<?php

use Laravel\Dusk\Browser;

test('login', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')
            ->assertSee('Google');
    });
});
