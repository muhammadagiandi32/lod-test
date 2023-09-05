<?php

namespace Tests;

// use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\CIUnitTestCase;

class ArticleControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;
    public function setUp(): void
    {
        parent::setUp();
        $result = $this->withURI('http://localhost:8080/api/article/getAll')
            ->controller(\App\Controllers\ForumController::class)
            ->execute('getAll');

        $this->assertTrue($result->isOK());
    }

    public function tearDown(): void
    {
        // Kode pembersihan Anda di sini
        parent::tearDown();
    }

    // Metode-metode uji Anda di sini
}
