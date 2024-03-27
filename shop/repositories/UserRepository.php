<?php

namespace shop\repositories;

use shop\entities\User\User;

class UserRepository
{
    public function getByEmailConfirmToken(string $token): User
    {
        return $this->getBy(['email_confirm_token' => $token]);
    }


    public function save(User $user): void
    {
        if (!$user->save()) {
            throw new \RuntimeException('Saving error');
        }
    }

    public function getByEmail($email): User
    {
        return $this->getBy([
            'status' => User::STATUS_ACTIVE,
            'email' => $email,
        ]);
    }

    public function getByPasswordResetToken($token): User
    {
        return $this->getBy(['password_reset_token' => $token]);
    }

    public function existByPasswordResetToken(string $token): bool
    {
        return (bool)User::findByPasswordResetToken($token);
    }

    private function getBy(array $condition): User
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundException('User not found');
        }
        return $user;
    }

    public function findByUsernameOrEmail($value): ?User
    {
        return User::find()->andWhere(['or', ['username' => $value], ['email' => $value]])->one();
    }

    public function findByNetworkIdentity($network, $identity): ?User
    {
        return User::find()->joinWith('networks n')->andWhere(['n.network' => $network, 'n.identity' => $identity])->one();
    }

    public function getById($id): User
    {
        return $this->getBy(['id' => $id]);
    }
}