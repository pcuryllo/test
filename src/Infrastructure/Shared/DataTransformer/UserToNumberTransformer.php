<?php

namespace App\Infrastructure\Shared\DataTransformer;

use App\Domain\User\Model\User;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * TYLKO DO TESTÓW!
 *
 * Class UserToNumberTransformer
 */
class UserToNumberTransformer implements DataTransformerInterface
{
    /**
     * @param User|null $user
     * @return int|string
     */
    public function transform($user)
    {
        if (null === $user) {
            return '';
        }

        return $user->getId();
    }

    /**
     * @param int $userId
     * @return \App\Model\User|mixed|void
     */
    public function reverseTransform($userId)
    {
        if (!$userId) {
            return;
        }

        $user = new User("AUTO", 'auto@fixme');

        if (null === $user) {
            throw new TransformationFailedException(sprintf(
                'An user with number "%s" does not exist!',
                $userId
            ));
        }

        return $user;
    }
}