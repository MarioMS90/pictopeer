<?php

use App\Models\Hashtag;
use App\Models\Friend;
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
            'alias' => "user",
            'email' => "user@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => 'https://i.imgur.com/mW8pFdX.jpg'
        ]);
        $user->save();

        $user = new User([ //ID: 2
            'alias' => "Amigo_admin_1",
            'email' => "Amigo_admin_1@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 3
            'alias' => "Amigo_admin_2",
            'email' => "Amigo_admin_2@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 4
            'alias' => "Amigo_admin_3",
            'email' => "Amigo_admin_3@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 5
            'alias' => "usuario_flores_2",
            'email' => "usuario_flores_2@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 6
            'alias' => "usuario_flores_1",
            'email' => "usuario_flores_1@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 7
            'alias' => "usuario_playas_2",
            'email' => "usuario_playas_2@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 8
            'alias' => "usuario_playas_1",
            'email' => "usuario_playas_1@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 9
            'alias' => "usuario_recetas_2",
            'email' => "usuario_recetas_2@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 10
            'alias' => "usuario_recetas_1",
            'email' => "usuario_recetas_1@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 11
            'alias' => "usuario_paisajes_2",
            'email' => "usuario_paisajes_2@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 12
            'alias' => "usuario_paisajes_1",
            'email' => "usuario_paisajes_1@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 13
            'alias' => "usuario_animales_2",
            'email' => "usuario_animales@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 14
            'alias' => "usuario_animales_1",
            'email' => "usuario_popular_1@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 15
            'alias' => "usuario_popular_3",
            'email' => "usuario_popular_3",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 16
            'alias' => "usuario_popular_2",
            'email' => "usuario_popular_2",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 17
            'alias' => "usuario_popular_1",
            'email' => "usuario_popular_1",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 18
            'alias' => "amigos_mutuos_3",
            'email' => "amigos_mutuos_3@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 19
            'alias' => "amigos_mutuos_2",
            'email' => "amigos_mutuos_2@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();

        $user = new User([ //ID: 20
            'alias' => "amigos_mutuos_1",
            'email' => "amigos_mutuos_1@gmail.com",
            'password' => bcrypt('1234'),
            'photo_profile_url' => Config::get('constants.DEFAULT_PROFILE_PHOTO')
        ]);
        $user->save();
    }

    private function seedHashtags()
    {
        $hashtag = new Hashtag([
            'name' => "#playas",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'name' => "#recetas",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'name' => "#flores",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'name' => "#animales",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'name' => "#naturaleza",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'name' => "#paisajes",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'name' => "#dibujos",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'name' => "#arte",
        ]);
        $hashtag->save();

        $hashtag = new Hashtag([
            'name' => "#render",
        ]);
        $hashtag->save();
    }

    private function seedPosts()
    {
        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/wc8UqTm.jpg",
            'date' => '2020-09-17'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 6,
        ]);
        $like->save();

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/bD88Ux7.jpg",
            'date' => '2020-09-14'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 7,
        ]);
        $like->save();

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/kdZ3nKF.jpg",
            'date' => '2020-09-11'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/TW5MLEq.jpg",
            'date' => '2020-09-4'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/6kaeDSw.jpg",
            'date' => '2020-09-6'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/rmj9PA9.jpg",
            'date' => '2020-09-7'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/6kaeDSw.jpg",
            'date' => '2020-06-12'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/4FoDVTa.jpeg",
            'date' => '2020-05-14'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "1",
            'photo_url' => "https://i.imgur.com/4FoDVTa.jpeg",
            'date' => '2020-05-20'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "2",
            'photo_url' => "https://i.imgur.com/VG2C87h.jpg",
            'date' => '2020-03-21'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "2",
            'photo_url' => "https://i.imgur.com/l56CCjJ.jpg",
            'date' => '2020-03-22'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "2",
            'photo_url' => "https://i.imgur.com/JLd8bih.jpg",
            'date' => '2020-03-24'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "2",
            'photo_url' => "https://i.imgur.com/qUVMqqg.jpg",
            'date' => '2020-03-25'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "2",
            'photo_url' => "https://i.imgur.com/jJJcjgn.jpg",
            'date' => '2021-03-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "3",
            'photo_url' => "https://i.imgur.com/vA98RrQ.jpg",
            'date' => '2021-03-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "3",
            'photo_url' => "https://i.imgur.com/ij0WWxD.jpg",
            'date' => '2020-03-14'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "3",
            'photo_url' => "https://i.imgur.com/IU0TsjO.jpg",
            'date' => '2020-03-15'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "3",
            'photo_url' => "https://i.imgur.com/3CgfAhe.jpg",
            'date' => '2021-03-17'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "3",
            'photo_url' => "https://i.imgur.com/NfK4uab.jpg",
            'date' => '2020-03-22'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "4",
            'photo_url' => "https://i.imgur.com/02NQoWX.jpg",
            'date' => '2021-03-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "4",
            'photo_url' => "https://i.imgur.com/0f0HOmk.jpg",
            'date' => '2021-03-12'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "4",
            'photo_url' => "https://i.imgur.com/azHkuDi.png",
            'date' => '2021-03-22'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "4",
            'photo_url' => "https://i.imgur.com/EHb7RRX.jpg",
            'date' => '2021-03-08'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "4",
            'photo_url' => "https://i.imgur.com/YeTzjqZ.jpg",
            'date' => '2021-03-09'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#dibujos'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#arte'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#render'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "5",
            'photo_url' => "https://i.imgur.com/skyhDBc.jpg",
            'date' => '2021-03-11'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#naturaleza'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#flores'
        )->first();
        $post->hashtags()->attach($hashtag);
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 1,
        ]);
        $like->save();

        $post = new Post([
            'user_id' => "5",
            'photo_url' => "https://i.imgur.com/xwIzXK5.jpg",
            'date' => '2021-04-14'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#naturaleza'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('name', '=', '#flores')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "6",
            'photo_url' => "https://i.imgur.com/IldSVJb.jpg",
            'date' => '2021-05-21'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#naturaleza'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('name', '=', '#flores')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "7",
            'photo_url' => "https://i.imgur.com/jQMGass.jpg",
            'date' => '2021-05-14'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#playas')->first();
        $post->hashtags()->attach($hashtag);
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 1,
        ]);
        $like->save();

        $post = new Post([
            'user_id' => "7",
            'photo_url' => "https://i.imgur.com/2JeW8hB.jpg",
            'date' => '2021-05-24'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#paisajes'
        )->first();
        $post->hashtags()->attach($hashtag);
        $hashtag = Hashtag::query()->where('name', '=', '#playas')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "8",
            'photo_url' => "https://i.imgur.com/7UnKBwP.jpg",
            'date' => '2021-02-17'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#playas')->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "9",
            'photo_url' => "https://i.imgur.com/Zuv9Ok6.jpeg",
            'date' => '2020-02-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#recetas'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "9",
            'photo_url' => "https://i.imgur.com/oS8iw5q.jpeg",
            'date' => '2020-03-24'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#recetas'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "10",
            'photo_url' => "https://i.imgur.com/M23UEUT.jpeg",
            'date' => '2020-02-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#recetas'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "11",
            'photo_url' => "https://i.imgur.com/9ncYySC.jpeg",
            'date' => '2020-02-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#paisajes'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "11",
            'photo_url' => "https://i.imgur.com/VIevFSY.jpg",
            'date' => '2020-02-24'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#paisajes'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "12",
            'photo_url' => "https://i.imgur.com/6zDqjm8.jpeg",
            'date' => '2020-02-25'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#paisajes'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "13",
            'photo_url' => "https://i.imgur.com/MU2dD8E.jpg",
            'date' => '2020-02-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#animales'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "13",
            'photo_url' => "https://i.imgur.com/RpikbHf.jpg",
            'date' => '2020-02-24'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#animales'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "14",
            'photo_url' => "https://i.imgur.com/8jqYvFL.jpg",
            'date' => '2020-02-25'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where(
            'name',
            '=',
            '#animales'
        )->first();
        $post->hashtags()->attach($hashtag);

        $post = new Post([
            'user_id' => "15",
            'photo_url' => "https://i.imgur.com/sKzg9d9.jpg",
            'date' => '2020-02-25'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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

        $post = new Post([
            'user_id' => "15",
            'photo_url' => "https://i.imgur.com/LLjBI6B.jpg",
            'date' => '2020-02-23'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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

        $post = new Post([
            'user_id' => "15",
            'photo_url' => "https://i.imgur.com/elblmgN.jpg",
            'date' => '2020-02-24'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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
        $like = new PostLike([
            'post_id' => $post->id,
            'user_id' => 5,
        ]);
        $like->save();

        $post = new Post([
            'user_id' => "16",
            'photo_url' => "https://i.imgur.com/5O3YY1F.jpg",
            'date' => '2020-02-11'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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
            'user_id' => "16",
            'photo_url' => "https://i.imgur.com/LkMrJi2.jpg",
            'date' => '2020-02-15'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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
            'user_id' => "16",
            'photo_url' => "https://i.imgur.com/44DEPPm.jpg",
            'date' => '2020-02-14'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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
            'user_id' => "16",
            'photo_url' => "https://i.imgur.com/R1bQCPs.jpg",
            'date' => '2020-02-20'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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
            'user_id' => "16",
            'photo_url' => "https://i.imgur.com/J4SsdW2.jpg",
            'date' => '2020-02-21'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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
            'user_id' => "16",
            'photo_url' => "https://i.imgur.com/x5yw4eh.jpg",
            'date' => '2020-02-22'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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
            'user_id' => "17",
            'photo_url' => "https://i.imgur.com/RqP4OFY.jpg",
            'date' => '2020-02-22'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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
            'user_id' => "17",
            'photo_url' => "https://i.imgur.com/Jtv8Ee8.jpg",
            'date' => '2020-01-22'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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
            'user_id' => "17",
            'photo_url' => "https://i.imgur.com/lE5Xkfn.jpg",
            'date' => '2020-02-22'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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
            'user_id' => "17",
            'photo_url' => "https://i.imgur.com/6DzlCOG.jpg",
            'date' => '2020-02-12'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
        $post->hashtags()->attach($hashtag);
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
            'user_id' => "17",
            'photo_url' => "https://i.imgur.com/WKhSnW2.jpg",
            'date' => '2020-04-22'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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
            'user_id' => "17",
            'photo_url' => "https://i.imgur.com/MkcmB2o.jpg",
            'date' => '2020-01-22'
        ]);
        $post->save();
        $hashtag = Hashtag::query()->where('name', '=', '#dibujos')->first();
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
    }

    private function seedFriends()
    {
        $friends = new Friend([
            'user_sender' => "1",
            'user_receiver' => "2",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "1",
            'user_receiver' => "3",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "4",
            'user_receiver' => "1",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "18",
            'user_receiver' => "2",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "18",
            'user_receiver' => "3",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "18",
            'user_receiver' => "4",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "19",
            'user_receiver' => "2",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "19",
            'user_receiver' => "3",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "20",
            'user_receiver' => "2",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "20",
            'user_receiver' => "3",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "6",
            'user_receiver' => "1",
            'status' => Config::get('enums.FRIEND_STATUS.PENDING')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "7",
            'user_receiver' => "1",
            'status' => Config::get('enums.FRIEND_STATUS.PENDING')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "8",
            'user_receiver' => "1",
            'status' => Config::get('enums.FRIEND_STATUS.PENDING')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "5",
            'user_receiver' => "15",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "6",
            'user_receiver' => "15",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "7",
            'user_receiver' => "15",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "8",
            'user_receiver' => "15",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "9",
            'user_receiver' => "15",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "10",
            'user_receiver' => "15",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "11",
            'user_receiver' => "15",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "6",
            'user_receiver' => "16",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "7",
            'user_receiver' => "16",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "8",
            'user_receiver' => "16",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "9",
            'user_receiver' => "16",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "10",
            'user_receiver' => "16",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "11",
            'user_receiver' => "16",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "7",
            'user_receiver' => "17",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "8",
            'user_receiver' => "17",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "9",
            'user_receiver' => "17",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "10",
            'user_receiver' => "17",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();

        $friends = new Friend([
            'user_sender' => "11",
            'user_receiver' => "17",
            'status' => Config::get('enums.FRIEND_STATUS.ACCEPTED')
        ]);
        $friends->save();
    }
}
