<?php

declare(strict_types=1);

namespace Tests\Feature\Models\NoDataBaseModels;

use App\Models\NoDataBaseModels\Collections\StudentAssessmentCollection;
use Tests\TestCase;

class StudentAssessmentCollectionTest extends TestCase
{


    public function test_collection_is_singleton(): void
    {
        $collection = StudentAssessmentCollection::makeCollection()->getCollection();

        $this->assertSame(10, $collection->count());

        $collection2 = StudentAssessmentCollection::makeCollection()->getCollection();
        $this->assertSame($collection, $collection2);
    }
}
