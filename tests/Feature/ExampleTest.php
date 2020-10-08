<?php

namespace Tests\Feature;

use App\Comment;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;



class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $c=Comment::where('id','36dde2d8-ff19-46c8-ba2d-002976f25e92')->get();
        $user=User::where('id','2e49313a-23ab-475d-8d5d-5cd8518f89a0')->get();
        assertEquals($user,$c->user());
    }
}
