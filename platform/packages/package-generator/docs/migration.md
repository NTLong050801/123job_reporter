# Migrations
Quick Start
```
    php artisan package-make:migration create_users_table --package=file-uploader --platform=packages
```
Now, Notice we are using some flag like: 
- `--package`  : The name of package will create migration file
- `--platform` : The name of parent folder that contain package create migration


## Migrations With Schema
```
php artisan package-make:migration create_users_table --schema="username:string(199), email:string:unique"
```

Notice the format that we use, when declaring any applicable schema: a comma-separated list...
```
COLUMN_NAME:COLUMN_TYPE
```
So any of these will do:
```
username:string(200)
body:text
age:integer
published_at:date
excerpt:text:nullable
email:string:unique:default('foo@example.com')
````
Using the schema from earlier...

```
--schema="username:string, email:string:unique"
```
...this will give you:

```
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('username');
			$table->string('email')->unique();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
```

When generating migrations with schema, the name of your migration (like, "create_users_table") matters. We use it to figure out what you're trying to accomplish. In this case, we began with the "create" keyword, which signals that we want to create a new table.

Alternatively, we can use the "remove" or "add" keywords, and the generated boilerplate will adapt, as needed. Let's create a migration to remove a column.

```
php artisan package-make:migration remove_user_id_from_posts_table --schema="user_id:integer"
```

Now, notice that we're using the correct Schema methods.

```
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUserIdFromPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('posts', function(Blueprint $table) {
			$table->dropColumn('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function(Blueprint $table) {
			$table->integer('user_id');
		});
	}

}
```

Here's a few other examples of commands that you might write:

- `php artisan package-make:migration create_posts_table`
- `php artisan package-make:migration create_posts_table --schema="title:string, body:text, excerpt:string:nullable"`
- `php artisan package-make:migration remove_excerpt_from_posts_table --schema="excerpt:string:nullable"`


Now, when you create a migration, you typically want a model to go with it, right? By default, we'll go ahead and create an Eloquent model to go with your migration. This means, if you run, say:
```
php artisan package-make:migration create_dogs_table --schema="name:string"
```

You'll get a migration, populated with the schema...but you'll also get an Eloquent model at app/Dog.php. Naturally, you can opt out of this by adding the --model=0 flag/option.

## Foreign Constraints
There's also a secret bit of sugar for when you need to generate foreign constraints. Imagine that you have a posts table, where each post belongs to a user. Let's try:

```
php artisan package-make:migration create_posts_table --schema="user_id:unsignedInteger:foreign, title:string, body:text"
```

Notice that "foreign" option (user_id:unsignedInteger:foreign)? That's special. It signals that user_id should receive a foreign constraint. Following conventions, this will give us:

```
$table->unsignedInteger('user_id');
$table->foreign('user_id')->references('id')->on('users');
```

As such, for that full command, our schema should look like so:

```
Schema::create('posts', function(Blueprint $table) {
	$table->increments('id');
	$table->unsignedInteger('user_id');
	$table->foreign('user_id')->references('id')->on('users');
	$table->string('title');
	$table->text('body');
	$table->timestamps();
);
```

## Pivot Tables
So you need a migration to setup a pivot table in your database? Easy. We can scaffold the whole class with a single command.

```
php artisan package-make:migration:pivot tags posts
```

Here we pass, in any order, the names of the two tables that we need a joining/pivot table for. This will give you:

```
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagPivotTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_tag', function(Blueprint $table) {
			$table->integer('post_id')->unsigned()->index();
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
			$table->integer('tag_id')->unsigned()->index();
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_tag');
	}

}
```

> Notice that the naming conventions are being followed here, regardless of what order you pass the table names.
  
  
  
## Database Seeders
```
php artisan package-make:seed SkillDatabaseSeeder1 --package=skill --platform=plugins

```
This one is fairly basic. It just gives you a quick seeder class in the "plugins/skill/src/Database/Seeders" folder.

```
<?php
namespace Workable\Skill\Database\Seeders;
use Modules\Company\Database\Seeders\PermissionTableSeeder;

class SkillDatabaseSeeder extends PermissionTableSeeder
{
    protected $path_config = 'plugins/skill/config/permission.php';
    public function run()
    {
        parent::run();
    }
}
```
