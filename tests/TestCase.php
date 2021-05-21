<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function throughTenProvider()
    {
        return $this->genArray(0, 10, 1);
    }

    private function genArray(int $start, int $end, int $inc)
    {
        $results = [];
        for ($i=$start;$i<$end;$i+=$inc) {
            $results[] = [$i];
        }
        return $results;
    }
}
