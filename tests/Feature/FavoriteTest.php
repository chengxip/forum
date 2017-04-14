<?php	
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
class FavoriteTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function unautenticate_user_cannot_favorite_reply (){

       $this->withExceptionHandling()->post('/reply/1/favorite')
            ->assertRedirect('/login');

    }

    /** @test */
    public function autenticate_user_can_favorite_reply (){
       $this->signIn();

       $reply = create('App\Reply'); 

       $this->post('/reply/'.$reply->id.'/favorite');

       $this->assertCount(1,$reply->favorite);

    }
    /** @test */
    public function autenticate_user_can_favorite_once_a_reply (){
       $this->signIn();

       $reply = create('App\Reply'); 

       $this->post('/reply/'.$reply->id.'/favorite');
       $this->post('/reply/'.$reply->id.'/favorite');

       $this->assertCount(1,$reply->favorite);

    }

}
