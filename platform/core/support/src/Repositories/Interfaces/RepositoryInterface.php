<?php

namespace Workable\Support\Repositories\Interfaces;

use Workable\Support\Criteria\AbstractCriteria;
use Workable\Support\Criteria\Contracts\CriteriaContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

interface RepositoryInterface
{
    /**
     * @return string
     * @author HungNguyen
     */
    public function getScreen(): string;

    /**
     * @param $data
     * @param $screen
     * @param bool $is_single
     * @return Builder
     * @author HungNguyen
     */
    public function applyBeforeExecuteQuery($data, $screen, $is_single = false);

    /**
     * @return array
     * @author Tedozi Manson
     */
    public function getCriteria();

    /**
     * @param CriteriaContract $criteria
     * @return $this
     * @author Tedozi Manson
     */
    public function pushCriteria(CriteriaContract $criteria);

    /**
     * @param AbstractCriteria|string $criteria
     * @return $this
     * @author Tedozi Manson
     */
    public function dropCriteria($criteria);

    /**
     * @param bool $bool
     * @return $this
     * @author Tedozi Manson
     */
    public function skipCriteria($bool = true);

    /**
     * @return $this
     * @author Tedozi Manson
     */
    public function applyCriteria();

    /**
     * @param CriteriaContract $criteria
     * @return mixed
     * @author Tedozi Manson
     */
    public function getByCriteria(CriteriaContract $criteria);

    /**
     * Runtime override of the model.
     *
     * @param  string $model
     * @return $this
     */
    public function setModel($model);

    /**
     * Get empty model.
     * @return mixed
     * @author HungNguyen
     */
    public function getModel();

    /**
     * Get table name.
     *
     * @return string
     * @author HungNguyen
     */
    public function getTable();

    /**
     * Make a new instance of the entity to query on.
     *
     * @param array $with
     * @author HungNguyen
     */
    public function make(array $with = []);

    /**
     * Find a single entity by key value.
     *
     * @param array $condition
     * @param array $select
     * @param array $with
     * @return mixed
     * @author HungNguyen
     */
    public function findOneBy(array $condition = [], array $select = [], array $with = []);

    /**
     * Retrieve model by id regardless of status.
     *
     * @param $id
     * @param array $with
     * @return mixed
     * @author HungNguyen
     */
    public function findById($id, array $with = []);

    /**
     * @param $id
     * @param array $with
     * @return mixed
     * @author HungNguyen
     */
    public function findOrFail($id, array $with = []);

    /**
     * @param string $column
     * @param string $key
     * @return mixed
     * @author HungNguyen
     */
    public function pluck($column, $key = null);

    /**
     * Get all models.
     *
     * @param array $with Eager load related models
     * @return mixed
     * @author HungNguyen
     */
    public function all(array $with = []);

    /**
     * Get all models by key/value.
     *
     * @param array $condition
     * @param array $with
     * @param array $select
     * @author HungNguyen
     * @return Collection
     */
    public function allBy(array $condition, array $with = [], array $select = ['*']);

    /**
     * @param array $data
     * @return mixed
     * @author HungNguyen
     */
    public function create(array $data);

    /**
     * Create a new model.
     *
     * @param Model|array $data
     * @param array $condition
     * @return false|Model
     * @author HungNguyen
     */
    public function createOrUpdate($data, $condition = []);

    /**
     * Delete model.
     *
     * @param Model $model
     * @return bool
     * @throws \Exception
     * @author HungNguyen
     */
    public function delete(Model $model);

    /**
     * @param array $data
     * @param array $with
     * @return mixed
     * @author HungNguyen
     */
    public function firstOrCreate(array $data, array $with = []);

    /**
     * @param array $condition
     * @param array $data
     * @return mixed
     * @author HungNguyen
     */
    public function update(array $condition, array $data);

    /**
     * @param array $select
     * @param array $condition
     * @return mixed
     * @author HungNguyen
     */
    public function select(array $select = ['*'], array $condition = []);

    /**
     * @param array $condition
     * @return mixed
     * @author HungNguyen
     */
    public function deleteBy(array $condition = []);

    /**
     * @param array $condition
     * @return mixed
     * @author HungNguyen
     */
    public function count(array $condition = []);

    /**
     * @param $column
     * @param array $value
     * @param array $args
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     * @author HungNguyen
     */
    public function getByWhereIn($column, array $value = [], array $args = []);

    /**
     * @param array $params
     * @return LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|Collection|mixed
     */
    public function advancedGet(array $params = []);

    /**
     * @param array $condition
     */
    public function forceDelete(array $condition = []);

    /**
     * @param array $condition
     * @return mixed
     * @author HungNguyen
     */
    public function restoreBy(array $condition = []);

    /**
     * Find a single entity by key value.
     *
     * @param array $condition
     * @param array $select
     * @return mixed
     * @author HungNguyen
     */
    public function getFirstByWithTrash(array $condition = [], array $select = []);

    /**
     * @param array $data
     * @return bool
     * @author HungNguyen
     */
    public function insert(array $data);

    /**
     * @param array $condition
     * @return mixed
     */
    public function firstOrNew(array $condition);
}
