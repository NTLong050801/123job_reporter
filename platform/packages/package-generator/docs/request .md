# Tạo class Request
Để tạo một class `Request` thì chúng ta sử dụng.

```
php artisan package-make:request ContactRequest --package=contact --platform=plugins
```

**Ghi chú:**
- `--package`: Chỉ ra rằng class `ContactRequest` sẽ được tạo trong package `contact`.
- `--platform`: Chỉ ra rằng sẽ được tạo trong thư mục nào. Hiện tại đang ở thư mục `platform/plugins`


**Kết quả nhận được**
```
<?php
namespace Workable\Contact\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ContactRequest extends FormRequest
{
     /**
      * Get the validation rules that apply to the request.
      *
      * @return array
      */
     public function rules(Request $request)
     {
         return [
             'name' => 'required',
             'phone' => 'required',
             'email' => 'required',
         ];
     }


     public function messages()
     {
         return [
             'name.required'=> 'Không được để trống',
             'phone.required'=> 'Không được để trống',
             'email.required'=> 'Không được để trống',
         ];
     }

     public function authorize()
     {
         return true;
     }
}
```
