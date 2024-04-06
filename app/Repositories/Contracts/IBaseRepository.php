<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;



use Module\Abstracts\Dto;

interface IBaseRepository
{

    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id): array;

    /**
     * @param Dto $dto
     * @return object
     */
    public function store(Dto $dto) : object;

    /**
     * @param Dto $dto
     * @return void
     */
    public function update(Dto $dto) : void;

    /**
     * @param int $id
     */
    public function delete(int $id) : void;
}

