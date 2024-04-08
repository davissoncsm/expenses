<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Exceptions\NotEntityDefinedException;
use App\Repositories\Contracts\IBaseRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection;
use Module\Abstracts\Dto;

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
     * @return object
     * @throws Exception
     */
    public function getById(int $id): object
    {
        return $this->run(fn() => $this->entity->findOrFail($id));
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
        return call_user_func($closure);
    }
}
