<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTOs\Dto;
use App\Exceptions\NotEntityDefinedException;
use App\Repositories\Contracts\IBaseRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BaseRepository implements IBaseRepository
{
    protected $entity;

    /**
     * Instance class
     * @throws NotEntityDefinedException
     */
    public function __construct()
    {
        $this->entity = $this->resolvEntity();
    }

    /**
     * @return Application|mixed
     * @throws NotEntityDefinedException
     */
    public function resolvEntity()
    {
        if (!method_exists($this, 'entity')) {
            throw new NotEntityDefinedException();
        }

        return app($this->entity());
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getAll(): array
    {
        return $this->run(fn() => $this->entity->get())->toArray();
    }

    /**
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function getById(int $id): array
    {
        return $this->run(fn() => $this->entity->find($id))?->toArray() ?? [];
    }

    /**
     * @param Dto $dto
     * @return object
     * @throws Exception
     */
    public function store(Dto $dto): object
    {
        return $this->run(fn() => $this->entity->create($dto->create()));
    }

    /**
     * @param Dto $dto
     * @return void
     * @throws Exception
     */
    public function update(Dto $dto): void
    {
         $this->run(
            fn() => $this->entity
                ->findOrfail($dto->id)
                ->update($dto->update())
        );
    }

    /**
     * @param int $id
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $this->run(
            fn() => $this->entity
                ->findOrfail($id)
                ->delete()
        );
    }

    /**
     * Run commands
     *
     * @param $closure
     * @return object|bool|Collection
     * @throws Exception
     */
    public function run($closure): mixed
    {
        try {
            DB::beginTransaction();

            $execute = call_user_func($closure);

            DB::commit();

            return $execute;

        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }
}
