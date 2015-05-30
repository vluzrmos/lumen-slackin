<?php

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testBasicExample()
    {
        $response = $this->call('GET', '/');

        $this->assertResponseOk();
    }
}
