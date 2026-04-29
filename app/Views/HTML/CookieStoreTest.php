<?php

namespace CodeIgniter\Cookie;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\Cookie\CookieStore;
use CodeIgniter\Cookie\Exceptions\CookieException;

class CookieStoreTest extends CIUnitTestCase
{
    public function testConstructorValidatesCookies()
    {
        $this->expectException(CookieException::class);
        new CookieStore(['invalid_cookie_string']);
    }

    public function testHasChecksForCookiePresence()
    {
        $cookie = new Cookie('user_id', '12345');
        $store  = new CookieStore([$cookie]);

        $this->assertTrue($store->has('user_id'));
        $this->assertFalse($store->has('session_id'));
    }

    public function testGetRetrievesCookie()
    {
        $cookie = new Cookie('theme', 'dark');
        $store  = new CookieStore([$cookie]);

        $retrieved = $store->get('theme');

        $this->assertInstanceOf(Cookie::class, $retrieved);
        $this->assertEquals('dark', $retrieved->getValue());
    }

    public function testGetThrowsExceptionIfNotFound()
    {
        $store = new CookieStore([]);

        $this->expectException(CookieException::class);
        $store->get('non_existent');
    }

    public function testPutAddsCookieImmutably()
    {
        $store1 = new CookieStore([]);
        $cookie = new Cookie('token', 'abc-123');
        
        // put() should return a NEW instance
        $store2 = $store1->put($cookie);

        $this->assertNotSame($store1, $store2);
        $this->assertFalse($store1->has('token'));
        $this->assertTrue($store2->has('token'));
    }

    public function testRemoveDeletesCookieImmutably()
    {
        $cookie = new Cookie('preferences', 'json_data');
        $store1 = new CookieStore([$cookie]);

        $store2 = $store1->remove('preferences');

        $this->assertNotSame($store1, $store2);
        $this->assertTrue($store1->has('preferences'));
        $this->assertFalse($store2->has('preferences'));
    }

    public function testCountReturnsSize()
    {
        $cookies = [new Cookie('a', '1'), new Cookie('b', '2')];
        $store = new CookieStore($cookies);
        $this->assertCount(2, $store);
    }
}