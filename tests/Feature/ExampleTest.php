<?php

test('the welcome and login pages are separate', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Log in to FleeV')
        ->assertDontSee('<form', false);

    $this->get('/login')
        ->assertOk()
        ->assertSee('Welcome back')
        ->assertSee('<form', false);
});

test('old and protected login paths use the shared login page', function () {
    $this->get('/admin/login')->assertRedirect(url('/login'));
    $this->get('/admin/dashboard')->assertRedirect(url('/login'));
});
