<?php

declare(strict_types=1);

namespace Tests\Feature\Models\NoDataBaseModels\Collections;

use App\Models\NoDataBaseModels\Collections\StudentCollection;
use Tests\TestCase;

class StudentCollectionTest extends TestCase
{


    public function test_collection_is_singleton(): void
    {
        $collection = StudentCollection::makeCollection()->getCollection();

        $this->assertSame(3, $collection->count());

        $collection2 = StudentCollection::makeCollection()->getCollection();
        $this->assertSame($collection, $collection2);
    }
}
