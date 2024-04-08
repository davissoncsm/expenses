<?php
declare(strict_types=1);

namespace Module\User\Actions;

use Exception;
use Module\Abstracts\Action;
use Module\User\Repositories\Contracts\IUserRepository;

class DeleteUserAction extends  Action
{

    /**
     * @var int
     */
    private int $id;

    /**
     * Class instance
     *
     * @param IUserRepository $userRepository
     */
    public function __construct(
        protected IUserRepository $userRepository,
    ){
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function execute(): void
    {
        $this->userRepository->delete(id: $this->id);
    }
}
