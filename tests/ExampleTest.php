<?php

use MichaelCrowcroft\CloudIP\Models\CloudIP;

it('can test', function () {
    $post = CloudIP::factory()->create(['title' => 'Fake Title']);
    $this->assertEquals('Fake Title', $post->title);
});