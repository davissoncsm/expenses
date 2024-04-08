<?php

declare(strict_types=1);

namespace Module\Card\Actions\card;

use Exception;
use Illuminate\Support\Facades\DB;
use Module\Abstracts\Action;
use Module\Card\Exceptions\card\DeleteCardException;
use Module\Card\Repositories\Contracts\ICardRepository;

class DeleteCardAction extends Action
{
    /**
     * @var int
     */
    private int $id;

    /**
     * Class instance
     *
     * @param ICardRepository $repository
     */
    public function __construct(
        protected ICardRepository $repository,
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
        try {
            DB::beginTransaction();

            $this->repository->delete($this->id);

            DB::commit();
        }catch (Exception $e){
            DB::rollBack();
            throw new DeleteCardException($e->getMessage());
        }
    }
}
