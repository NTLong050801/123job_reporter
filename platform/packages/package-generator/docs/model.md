# Make Model
Create a model Authenticate for package: `file-uploader` in folder platform: `packages`
```
php artisan package-make:model Authenticate --package=file-uploader --platform=packages --namespace=Workable
```

Now, Notice I have used some flag like
- `--package` : The name package like: file-uploader, helper ...
- `--platform`: The name folder contain your package
- `--namespace`: The namespace load package like in schema composer.json of your package
- `-m`: Flag to create associated migrations in package

This will give you:
```
   <?php
   namespace Workable\FileUploader\Models;
   
   use Illuminate\Database\Eloquent\Model;
   use Carbon\Carbon;
   
   class Authenticate extends Model
   {
       protected $table='';
       protected $guarded = ['id'];
       protected $fillable = [];
   }
```
