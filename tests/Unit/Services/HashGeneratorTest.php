<?php

namespace Tests\Unit\Services;

use App\Services\HashGenerator;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class HashGeneratorTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @return void
     */
    public function test_id_generate_hash_is_valid()
    {
        $hash = HashGenerator::generate();
        $this->assertEquals(8, strlen($hash));

        $hash = HashGenerator::generate(10);
        $this->assertEquals(10, strlen($hash));
    }
}
