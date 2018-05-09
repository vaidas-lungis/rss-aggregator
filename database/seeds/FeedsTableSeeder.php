<?php

use Illuminate\Database\Seeder;

class FeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $providedUrls = [
            'http://feeds.feedburner.com/technologijos-visos-publikacijos?format=xml',
            'https://www.alfa.lt/rss',
        ];

        foreach ($providedUrls as $feedUrl){
            factory(\App\Feed::class)->create([
                'url' => $feedUrl
            ]);
        }
    }
}
