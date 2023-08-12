<?php

test('unauthenticated user redirected to login', function () {
    $response = $this->get('/');

    $response->assertStatus(302);
});
