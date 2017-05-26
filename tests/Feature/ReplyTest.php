<?php	
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
class RelyTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function authorized_user_can_delete_reply(){
        $this->signIn();

        $reply = create('App\Reply',['user_id'=>auth()->id()]);

        $this->delete('/reply/'.$reply->id);
        $this->assertDatabaseMissing('replies',['id'=>$reply->id]);
    }
    /** @test */
    public function unautenticate_user_cannot_delete_reply(){
       $this->withExceptionHandling()->delete('/reply/1')
            ->assertRedirect('/login');
    }

    /** @test */
    public function autenticate_user_can_update_reply(){
        $this->signIn();
        $reply = create('App\Reply',['user_id'=>auth()->id()]);

        $updated = 'updated reply';

        $this->patch('/reply/'.$reply->id, ['body'=>$updated]);
        $this->assertDatabaseHas('replies',['id'=>$reply->id,'body'=>$updated]);

    }

}
