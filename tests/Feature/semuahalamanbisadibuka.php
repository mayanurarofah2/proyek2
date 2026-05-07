<?php

test('Halaman Login Bisa Diakses', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
});

test('Halaman Register Bisa Diakses', function () {
    $response = $this->get('/register');
    $response->assertStatus(200);
});
