# Make middleware
Create a AuthenApi for package: `file-uploader` in folder platform: `packages`
```
php artisan package-make:middleware AuthenApi --package=file-uploader --platform=packages --namespace=Workable
```

Now, Notice I have used some flag like
- `--package` : The name package like: file-uploader, helper ...
- `--platform`: The name folder contain your package
- `--namespace`: The namespace load package like in schema composer.json of your package

This will give you:
```
    <?php
    namespace Workable\FileUploader\Http\Middleware;
    
    use Closure;
    use Illuminate\Http\Request;
    
    class AuthenApi
    {
        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle(Request $request, Closure $next)
        {
            return $next($request);
        }
    }
```
