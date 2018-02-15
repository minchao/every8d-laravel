<?php

namespace Every8d\Laravel\Tests;

use Every8d\Client;

class Every8dServiceProviderTest extends AbstractTestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('every8d.username', 'username');
        $app['config']->set('every8d.password', 'password');
    }

    public function testCreateEvery8dService()
    {
        $actual = app(Client::class);

        $this->assertInstanceOf(Client::class, $actual);
    }

    public function testClientCreatedWithUsernameAndPassword()
    {
        $client = app(Client::class);
        $actualUsername = $this->getClassProperty(Client::class, 'username', $client);
        $actualPassword = $this->getClassProperty(Client::class, 'password', $client);

        $this->assertEquals('username', $actualUsername);
        $this->assertEquals('password', $actualPassword);
    }
}
