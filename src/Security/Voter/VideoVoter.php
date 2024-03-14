<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use Psr\Log\LoggerInterface;
use App\Entity\Video;
use App\Entity\User;

class VideoVoter extends Voter
{
    public const EDIT = 'POST_EDIT';
    public const VIEW = 'VIDEO_VIEW';
    public const DELETE = 'VIDEO_DELETE';

    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::DELETE, self::VIEW])
            && $subject instanceof \App\Entity\Video;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        $video = $subject;

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::DELETE:
                return $user === $video->getSecurityUser();
                break;

            case self::VIEW:
                return $user === $video->getSecurityUser();
                break;
        }

        return false;
    }
}
