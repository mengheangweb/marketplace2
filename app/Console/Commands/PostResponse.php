<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class PostResponse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'approve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'use for approve all post more than 3 day';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       
        $posts = Post::where('created_at', '<=', '2022-10-18')->where('status', 'waiting_approval')->update(['status' => 'approve']);


        return 0;
    }
}
