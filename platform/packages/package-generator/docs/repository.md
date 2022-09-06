# Tạo class Repository
Để tạo một class `Repository` thì chúng ta sử dụng.

```
php artisan package-make:repository ContactUser --package=contact --platform=plugins
```

**Ghi chú:**
- `--package`: Chỉ ra rằng class `ContactUser` sẽ được tạo trong package `contact`.
- `--platform`: Chỉ ra rằng sẽ được tạo trong thư mục nào. Hiện tại đang ở thư mục `platform/plugins`

**Kết quả nhận được**
```
# ContactUserRepository
<?php
namespace Workable\Contact\Repository\ContactUser;
use Workable\Support\Repositories\Eloquent\BaseRepository;
use Workable\Contact\Models\ContactUser;
class ContactUserRepository extends BaseRepository implements ContactUserRepositoryInterface
{
    protected $model;
    protected $param=[];

    public function __construct(ContactUser $model)
    {
        $this->model = $model;
    }

    /**
    * Set params
    * @param array $param
    * @return void;
    */
    public function setParam($param =[])
    {
        $this->param = $param;
    }

    /**
    * Get list
    * @param array $filter
    * @param array $field
    * @param int $paginate
    * @return mix;
    */
    public function list($filter=[], $field=["*"], $paginate=20)
    {
        $query = $this->model->with('admin:id,name');
        if ($filter) {
            $query = $this->scopeFilter($query, $filter);
        }

        $order = $this->param['order'] ?? [];
        if ($order)
        {
            $query = $this->scopeSort($query, $order);
        }
        else
        {
            list($column, $direction) = ['id', 'desc'];
            $query = $query->orderBy($column, $direction);
        }
        $items = $query->paginate($paginate);
        return $items;
    }
}

# ContactUserRepositoryInterface
<?php
namespace Workable\Contact\Repository\ContactUser;

interface ContactUserRepositoryInterface
{
    public function setParam($params);

    public function list($filter=[], $field=["*"], $paginate=20);
}


# Model ContactUser
<?php

namespace Workable\Contact\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Modules\Company\Models\Admin;

class ContactUser extends Model
{
    protected $table='contact_users';
    protected $guarded = ['id'];
    protected $fillable = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}

```
