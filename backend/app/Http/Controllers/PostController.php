<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SuggestionStrategy\Suggester;
use App\Http\Controllers\SuggestionStrategy\SuggesterFactory;
use App\Models\Hashtag;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class PostController extends Controller
{
    const POSTS_PER_PAGE = 6;

    /*
    * Endpoint para retornar posts paginados, mezclo tanto los posts de
    * los amigos del usuario como los posts recomendados y los ordeno
    * por fecha, de esta forma voy creando una lista fluida de posts que
    * al usuario le gustaría ver.
    *
    * Para realizar la paginación he usado cursores utilizando la
    * biblioteca cursor-pagination que gestiona las colas de paginación
    * calculando en cada consulta el siguiente cursor, al frontend le devuelvo
    * la lista de posts y el cursor con el que debe de hacer la siguiente
    * petición.
    */
    public function getHomePosts()
    {
        $user = $this->getAuthUser();
        $user->friends = $user->getFriends();

        $suggester = $this->getPostSuggesterByUserState($user);
        $postSuggestions = $suggester->getPostsSuggestion($user);
        $friendPosts = Post::getPostsByUserIds($user->friends->pluck('id'));

        $subquery = $postSuggestions->union($friendPosts);

        $paginateResult = DB::query()->fromSub($subquery, 'subquery')
            ->orderBy('date', 'desc')
            ->cursorPaginate(self::POSTS_PER_PAGE)->toArray();

        $posts = Post::setHashtagsAndUserLikes(
            $paginateResult['data'],
            $user->postsLiked
        );

        return response()->json([
            'posts' => $posts,
            'nextCursor' => $paginateResult['nextCursor']
        ]);
    }

    public function createLike(Request $request)
    {
        $user = $this->getAuthUser();

        $like = new PostLike([
            'post_id' => $request->postId,
            'user_id' => $user->id,
        ]);
        $like->save();

        return response()->json([
            'success' => true,
        ]);
    }

    public function deleteLike($postId)
    {
        $user = $this->getAuthUser();
        $like = PostLike::where('post_id', $postId)
            ->where('user_id', $user->id)
            ->first();
        $like->delete();

        return response()->json([
            'success' => true,
        ]);
    }

    public function createPost(Request $request)
    {
        $image = $request->file('image');
        $hashtags = collect(json_decode($request->hashtags));

        $uploadResponse = ImageController::uploadImage($image);
        $user = $this->getAuthUser();

        if ($uploadResponse['success']) {
            $photoUrl = $uploadResponse['data']['link'];

            $post = new Post([
                'user_id' => $user->id,
                'photo_url' => $photoUrl,
                'date' => date('Y-m-d')
            ]);
            $post->save();

            $hashtags->each(function ($hashtag) use ($post) {
                if (substr($hashtag, 0, 1) != '#') {
                    $hashtag = "#".$hashtag;
                };

                $hashtagFromDB = Hashtag::query()->where(
                    'name',
                    '=',
                    $hashtag
                )->first();

                if ($hashtagFromDB == null) {
                    $hashtagFromDB = new Hashtag([
                        'name' => $hashtag,
                    ]);
                    $hashtagFromDB->save();
                }

                $post->hashtags()->attach($hashtagFromDB);
            });
        }

        return response()->json([
            'success' => true
        ]);
    }

    /*
     * Con esta función compruebo el estado del usuario para las sugerencias
     * de publicaciones, si ha dado algún like se retorna un suggester del
     * tipo hashtag, si no ha dado ningun like pero tiene amigos se retorna
     * uno del tipo amigos comunes, si ninguna condición se cumple se
     * retorna uno por defecto basado en popularidad.
     */
    private function getPostSuggesterByUserState($user): Suggester
    {
        switch ($user) {
            case $user->hasPostsLiked():
                return SuggesterFactory::getSuggester(SuggesterFactory::HASHTAGS_SUGGESTER);
            case $user->hasFriends():
                return SuggesterFactory::getSuggester(SuggesterFactory::MUTUAL_FRIENDS_SUGGESTER);
            default:
                return SuggesterFactory::getSuggester(SuggesterFactory::DEFAULT_SUGGESTER);
        }
    }

    private function getAuthUser()
    {
        $user = JWTAuth::parseToken()->authenticate();
        return $user;
    }
}
