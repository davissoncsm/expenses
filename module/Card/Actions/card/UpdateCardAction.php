<?php

declare(strict_types=1);

namespace Module\Card\Actions\card;

use Exception;
use Illuminate\Support\Facades\DB;
use Module\Abstracts\Action;
use Module\Card\DTOs\card\CardDto;
use Module\Card\Exceptions\card\UpdateCardException;
use Module\Card\Repositories\Contracts\ICardRepository;

class UpdateCardAction extends Action
{
    /**
     * @var CardDto
     */
    private CardDto $dto;

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
     * @param CardDto $dto
     * @return $this
     */
    public function setDto(CardDto $dto): static
    {
        $this->dto = $dto;
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

            $this->repository->update($this->dto);

            DB::commit();
        }catch (Exception $e){
            DB::rollBack();
            throw new UpdateCardException($e->getMessage());
        }
    }
}
