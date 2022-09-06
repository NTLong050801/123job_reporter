# Make controller
Create a HomeController for package: `file-uploader` in folder platform: `packages`
```
php artisan package-make:controller HomeController --package=file-uploader --platform=packages --namespace=Workable
```

Now, Notice I have used some flag like
- `--package` : The name package like: file-uploader, helper ...
- `--platform`: The name folder contain your package
- `--namespace`: The namespace load package like in schema composer.json of your package

This will give you:
```
    <?php
    
    namespace Workable\FileUploader\Http\Controllers;
    
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Illuminate\Foundation\Validation\ValidatesRequests;
    use Illuminate\Routing\Controller;
    
    class HomeController extends Controller
    {
        use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    }
```
