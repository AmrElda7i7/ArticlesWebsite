<?php

namespace Database\Seeders;

use App\Models\Permission;
use Database\Factories\PermissionFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions=[
            'create_user' ,
            'delete_user' ,
            'update_user' ,
            'read_users' ,
            'create_role' ,
            'delete_role' ,
            'update_role' ,
            'read_roles' ,
            'delete_comment' ,
            'update_comment' ,
            'read_comments' ,
            'create_article' ,
            'delete_article' ,
            'update_article' ,
            'read_articles' ,
            'create_category' ,
            'delete_category' ,
            'update_category' ,
            'read_categories' ,
            'accept_article', 
            'accept_user_as_a_writer'
            
        ] ;
        foreach($permissions as $permission) 
        {
            Permission::create(
                [
                    'name'=> $permission ,
                    'guard_name'=>'web'
                ]
            ) ;
        }
    }
}
