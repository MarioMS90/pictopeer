<?php

use App\Models\Hashtag;
use App\Models\Friends;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

//Creación de datos de prueba para la aplicación.
class DatabaseSeeder extends Seeder
{

    public function __construct()
    {

    }

    public function run()
    {
        $this->seedUsers();
        $this->seedHashtags();
        $this->seedPosts();
        $this->seedFriends();
    }

    private function seedUsers()
    {
        $user = new User([
            'alias' => "Admin",
            'email' => "admin@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => 'https://i.imgur.com/mW8pFdX.jpg'
        ]);
        $user->save();

        $user = new User([
            'alias' => "Shrek",
            'email' => "shrek@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([
            'alias' => "Loren",
            'email' => "loren@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([
            'alias' => "Arya",
            'email' => "arya@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([
            'alias' => "PaskiwG",
            'email' => "paskiwG@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([
            'alias' => "Phosky",
            'email' => "phosky@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([
            'alias' => "Pau",
            'email' => "pau@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([
            'alias' => "Marc",
            'email' => "marc@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([
            'alias' => "Kelly",
            'email' => "kelly@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([
            'alias' => "Harry",
            'email' => "harry@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([
            'alias' => "Lau",
            'email' => "lau@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([
            'alias' => "Freud",
            'email' => "freud@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([
            'alias' => "Kvothe",
            'email' => "kvothe@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();
    }

    private function seedHashtags()
    {
        $hashtag = new Hashtag([
            'hashtag' => "#playa",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'hashtag' => "#paisaje",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'hashtag' => "#monumento",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'hashtag' => "#montaña",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'hashtag' => "#animales",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'hashtag' => "#naturaleza",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'hashtag' => "#atardecer",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'hashtag' => "#flores",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'hashtag' => "#arboles",
        ]);
        $hashtag->save();
    }

    private function seedPosts()
    {
        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/qBh8J3E.jpg",
            'date' => '2020-09-17'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#animales')->first();
        $post->hashtags()->attach($hashtag);
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 2,
        ]);
        $like->save();
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 3,
        ]);
        $like->save();
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 4,
        ]);
        $like->save();

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/bD88Ux7.jpg",
            'date' => '2020-09-14'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=', '#paisaje')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#playa')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/kdZ3nKF.jpg",
            'date' => '2020-09-11'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=', '#paisaje')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#playa')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/TW5MLEq.jpg",
            'date' => '2020-09-4'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#atardecer')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#playa')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/skyhDBc.jpg",
            'date' => '2020-09-6'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#naturaleza')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#flores')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/rmj9PA9.jpg",
            'date' => '2020-09-7'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#animales')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#naturaleza')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/6kaeDSw.jpg",
            'date' => '2020-06-12'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#animales')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#naturaleza')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/xwIzXK5.jpg",
            'date' => '2020-05-14'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#naturaleza')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#flores')->first();
        $post->hashtags()->attach($hashtag);
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 5,
        ]);
        $like->save();
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 6,
        ]);
        $like->save();
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 7,
        ]);
        $like->save();
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 8,
        ]);
        $like->save();

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/1G8yCrI.jpg",
            'date' => '2020-03-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#naturaleza')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#paisaje')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#arboles')->first();
        $post->hashtags()->attach($hashtag);
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 7,
        ]);
        $like->save();
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 8,
        ]);
        $like->save();

        $post = new Post([
            'user_id' => "2",
            'photo_url' => "https://i.imgur.com/IldSVJb.jpg",
            'date' => '2020-01-21'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#naturaleza')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#flores')->first();
        $post->hashtags()->attach($hashtag);
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 9,
        ]);
        $like->save();
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 9,
        ]);
        $like->save();

        $post = new Post([
            'user_id' => "2",
            'photo_url' => "https://i.imgur.com/JJENLOt.jpg",
            'date' => '2020-01-22'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#naturaleza')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#paisaje')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#arboles')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "2",
            'photo_url' => "https://i.imgur.com/x2oS4nh.jpg",
            'date' => '2020-01-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#naturaleza')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#paisaje')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "2",
            'photo_url' => "https://i.imgur.com/jQMGass.jpg",
            'date' => '2020-02-24'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=', '#paisaje')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#playa')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "3",
            'photo_url' => "https://i.imgur.com/2JeW8hB.jpg",
            'date' => '2020-03-24'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=', '#paisaje')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#playa')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "3",
            'photo_url' => "https://i.imgur.com/7UnKBwP.jpg",
            'date' => '2020-01-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=', '#playa')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "3",
            'photo_url' => "https://i.imgur.com/I8zSJ7u.jpg",
            'date' => '2020-01-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#naturaleza')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#arboles')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "4",
            'photo_url' => "https://i.imgur.com/TpLVJtI.jpg",
            'date' => '2020-01-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#monumento')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "4",
            'photo_url' => "https://i.imgur.com/JYx7PmF.jpg",
            'date' => '2020-01-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=', '#montaña')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "5",
            'photo_url' => "https://i.imgur.com/7NAoi6s.jpg",
            'date' => '2020-01-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=', '#montaña')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "5",
            'photo_url' => "https://i.imgur.com/EyKy7Yk.jpg",
            'date' => '2020-01-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=', '#playa')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#arboles')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "6",
            'photo_url' => "https://i.imgur.com/5KqvN0C.jpg",
            'date' => '2020-01-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#monumento')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "6",
            'photo_url' => "https://i.imgur.com/tXXEQyE.jpg",
            'date' => '2020-01-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=', '#playa')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#arboles')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "7",
            'photo_url' => "https://i.imgur.com/AmKGVvd.jpg",
            'date' => '2020-01-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('hashtag', '=',
            '#naturaleza')->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('hashtag', '=', '#arboles')->first();
        $post->hashtags()->attach($hashtag);
    }

    private function seedFriends()
    {
        $friends = new Friends([
            'user_sender' => "1",
            'user_receiver' => "2",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "1",
            'user_receiver' => "3",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "4",
            'user_receiver' => "1",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "5",
            'user_receiver' => "1",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "6",
            'user_receiver' => "1",
            'status' => Config::get('enums.FRIEND_STATUS.PENDING')
        ]);
        $friends->save();
        $notification = new Notification([
            'type' => Config::get('enums.NOTIFICATION_TYPE.FRIEND_REQUEST'),
            'event_id' => $friends->id,
            'user_id' => $friends->user_receiver
        ]);
        $notification->save();


        $friends = new Friends([
            'user_sender' => "7",
            'user_receiver' => "1",
            'status' => Config::get('enums.FRIEND_STATUS.PENDING')
        ]);
        $friends->save();
        $notification = new Notification([
            'type' => Config::get('enums.NOTIFICATION_TYPE.FRIEND_REQUEST'),
            'event_id' => $friends->id,
            'user_id' => $friends->user_receiver
        ]);
        $notification->save();

        $friends = new Friends([
            'user_sender' => "8",
            'user_receiver' => "1",
            'status' => Config::get('enums.FRIEND_STATUS.PENDING')
        ]);
        $friends->save();
        $notification = new Notification([
            'type' => Config::get('enums.NOTIFICATION_TYPE.FRIEND_REQUEST'),
            'event_id' => $friends->id,
            'user_id' => $friends->user_receiver
        ]);
        $notification->save();

        $friends = new Friends([
            'user_sender' => "5",
            'user_receiver' => "6",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "9",
            'user_receiver' => "2",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "3",
            'user_receiver' => "9",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "9",
            'user_receiver' => "4",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "10",
            'user_receiver' => "4",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "5",
            'user_receiver' => "10",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "4",
            'user_receiver' => "11",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "11",
            'user_receiver' => "3",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "4",
            'user_receiver' => "12",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "12",
            'user_receiver' => "3",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "5",
            'user_receiver' => "12",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "12",
            'user_receiver' => "2",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "2",
            'user_receiver' => "5",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "5",
            'user_receiver' => "3",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friends([
            'user_sender' => "4",
            'user_receiver' => "5",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();
    }
}
