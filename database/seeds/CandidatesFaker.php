<?php

use App\Models\Candidate;
use Illuminate\Database\Seeder;

class CandidatesFaker extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Candidate::class)->times(20)->create();
    }
}
