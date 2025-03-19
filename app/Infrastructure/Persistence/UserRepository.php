<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entities\User as UserEntity;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Models\User as UserModel;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Encuentra un User por su ID.
     *
     * @param int $id
     * @return UserEntity|null
     */
    public function findById(int $id): ?UserEntity
    {
        $userModel = UserModel::find($id);

        return $userModel ? $this->mapToEntity($userModel) : null;
    }

    /**
     * Encuentra un User por su email.
     *
     * @param string $email
     * @return UserEntity|null
     */
    public function findByEmail(string $email): ?UserEntity
    {
        $userModel = UserModel::where('email', $email)->first();

        return $userModel ? $this->mapToEntity($userModel) : null;
    }

    /**
     * Guarda un User en la base de datos.
     *
     * @param UserEntity $user
     * @return UserEntity
     */
    public function save(UserEntity $user): UserEntity
    {
        $userModel = $this->mapToModel($user);
        $userModel->save();

        return $this->mapToEntity($userModel);
    }

    /**
     * Actualiza un User en la base de datos.
     *
     * @param UserEntity $user
     * @return void
     */
    public function update(UserEntity $user): void
    {
        $userModel = $this->mapToModel($user);
        $userModel->save();
    }

     /**
     * Mapea un modelo User (Eloquent) a una entidad User (dominio).
     *
     * @param UserModel $userModel
     * @return UserEntity
     */
    private function mapToEntity(UserModel $userModel): UserEntity
    {
        return new UserEntity(
            $userModel->id,
            $userModel->name,
            $userModel->email,
            $userModel->password
        );
    }

    /**
     * Mapea una entidad User (dominio) a un modelo User (Eloquent).
     *
     * @param UserEntity $user
     * @return UserModel
     */
    private function mapToModel(UserEntity $user): UserModel
    {
        $userModel = new UserModel();
        $userModel->id = $user->getId();
        $userModel->name = $user->getName();
        $userModel->email = $user->getEmail();
        $userModel->password = $user->getPassword();

        return $userModel;
    }
}
