<?php

namespace App\Security\Voter;

use App\Entity\Partido;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class PartidoVoter extends Voter
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public const VIEW = 'PARTIDO_VIEW';

    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        if (!in_array($attribute, [
            self::VIEW
        ], true)){
            return false;
        }

        if (!$subject instanceof Partido){
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        assert($subject instanceof Partido);

        switch ($attribute) {
            case self::VIEW:
                return ($this->security->isGranted('ROLE_INSCRIPTOR') || ($subject->getJuez() === $user || $subject->getJugador1() === $user ||$subject->getJugador2() === $user));
                break;
        }

        return false;
    }
}
