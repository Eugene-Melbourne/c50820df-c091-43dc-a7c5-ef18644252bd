<?php

declare(strict_types=1);

namespace Tests\Feature\Models\NoDataBaseModels\Collections;

use App\Models\NoDataBaseModels\Collections\AssessmentCollection;
use Tests\TestCase;

class AssessmentCollectionTest extends TestCase
{


    public function test_collection_is_singleton(): void
    {
        $collection = AssessmentCollection::makeCollection()->getCollection();

        $this->assertSame(1, $collection->count());

        $collection2 = AssessmentCollection::makeCollection()->getCollection();
        $this->assertSame($collection, $collection2);
    }
}
