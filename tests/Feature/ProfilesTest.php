<?php	
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
class ProfilesTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function a_user_should_have_profile (){

        $user = create('App\User');

        $this->get('/profile/'.$user->name)
            ->assertSee($user->name);
        
    }

     /** @test */
    public function profile_display_all_threads_by_associated_user (){
        $user = create('App\User');

        $thread = create('App\Thread', ['user_id'=>$user->id]);

        $this->get('/profile/'.$user->name)
            ->assertSee($thread->title);
        
    }

}
