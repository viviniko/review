<?php

namespace Viviniko\Review\Console\Commands;

use Viviniko\Support\Console\CreateMigrationCommand;

class ReviewTableCommand extends CreateMigrationCommand
{
    /**
     * @var string
     */
    protected $name = 'review:table';

    /**
     * @var string
     */
    protected $description = 'Create a migration for the review service table';

    /**
     * @var string
     */
    protected $stub = __DIR__.'/stubs/review.stub';

    /**
     * @var string
     */
    protected $migration = 'create_review_table';
}
