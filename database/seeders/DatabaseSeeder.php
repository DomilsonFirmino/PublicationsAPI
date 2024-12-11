<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Publication;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $coments = [
            [
                'id'=>1,
                'publication_id'=>1,
                'comment_id'=>null,
                'content' => 'Impressive! Though it seems the drag feature could be improved. But overall it looks incredible. You\'ve nailed the design and the responsiveness at various breakpoints works really well.',
                'score'=> 12,
                "username" => "amyrobson"
            ],
            [
                'id'=>2,
                'publication_id'=>1,
                'comment_id'=>null,
                'content' => "Woah, your project looks awesome! How long have you been coding for? I'm still new, but think I want to dive into React as well soon. Perhaps you can give me an insight on where I can learn React? Thanks!",
                'score'=> 5,
                "username" => "maxblagun"
            ],
            [
                'id'=>3,
                'publication_id'=>1,
                'comment_id'=>2,
                'content' => "If you're still new, I'd recommend focusing on the fundamentals of HTML, CSS, and JS before considering React. It's very tempting to jump ahead but lay a solid foundation first.",
                'score'=> 4,
                "username" => "ramsesmiron"
            ],
            [
                'id'=>4,
                'publication_id'=>1,
                'comment_id'=>2,
                'content' => "I couldn't agree more with this. Everything moves so fast and it always seems like everyone knows the newest library/framework. But the fundamentals are what stay constant.",
                'score'=> 4,
                "username" => "augusto"
            ]
        ];

        Publication::factory()->create([
            'id'=>'1',
            'title'=>'First publication',
            'user_id' => User::factory()->create([
                'username'=>'juliusomo'
            ])
        ]);
        foreach ($coments as $coment) {
            Comment::factory()->create([
                'publication_id'=>$coment['publication_id'],
                'content'=>$coment['content'],
                'score'=>$coment['score'],
                'user_id'=>User::factory()->create([
                    'username'=>$coment['username']
                ]),
                'comment_id'=>$coment['comment_id']
            ]);
        }

    }
}
