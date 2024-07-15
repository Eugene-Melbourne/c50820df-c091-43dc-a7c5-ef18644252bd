<?php

declare(strict_types=1);

namespace Tests\Feature\Models\NoDataBaseModels\Collections;

use App\Models\NoDataBaseModels\Collections\QuestionCollection;
use Tests\TestCase;

class QuestionCollectionTest extends TestCase
{


    public function test_collection_is_singleton(): void
    {
        $collection = QuestionCollection::makeCollection()->getCollection();

        $this->assertSame(16, $collection->count());

        $collection2 = QuestionCollection::makeCollection()->getCollection();
        $this->assertSame($collection, $collection2);
    }
}
