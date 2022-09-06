<?php


namespace Workable\Acl\Services;


use Illuminate\Support\Str;
use Workable\Acl\Repository\Role\RoleRepositoryInterface;

class RoleService
{
    private $roleRepository;
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function list($filter)
    {
        return $this->roleRepository->getList($filter);
    }

    public function findById($id)
    {
        return $this->roleRepository->findById($id);
    }

    public function update($id, $data=[])
    {
        $data['slug'] = Str::slug($data['name']);
        $data['updated_at'] = now();
        return $this->roleRepository->update($id, $data);
    }

    public function insert($data=[])
    {
        $data['slug']       = Str::slug($data['name']);
        $data['created_at'] = now();
        $data['updated_at'] = now();
        return $this->roleRepository->insert($data);
    }

    public function getUser($id){
        return $this->roleRepository->getUser($id);
    }

    public function getPermission($id){
        return $this->roleRepository->getPermission($id);
    }

    public function roleAdminUpdate($role, $user){
        $this->roleRepository->roleAdminUpdate($role, $user);
    }
}
