<?php

class UserManager extends AbstractManager
{

    public function create(User $user) : User
    {
        $sql = "INSERT INTO users (firstName, lastName, email, password, created_at)
                VALUES (:firstName, :lastName, :email, :password, :created_at)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            "firstName" => $user->getFirstName(),
            "lastName" => $user->getLastName(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "created_at" => $user->getCreatedAt()
        ]);

        $user->setId((int)$this->db->lastInsertId());

        return $user;
    }


    public function update(User $user) : User
    {
        $sql = "UPDATE users 
                SET firstName = :firstName,
                    lastName = :lastName,
                    email = :email,
                    password = :password
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            "firstName" => $user->getFirstName(),
            "lastName" => $user->getLastName(),
            "email" => $user->getEmail(),
            "password" => $user->getPassword(),
            "id" => $user->getId()
        ]);

        return $user;
    }


    public function delete(User $user) : void
    {
        $sql = "DELETE FROM users WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            "id" => $user->getId()
        ]);
    }


    public function findOne(int $id) : ?User
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            "id" => $id
        ]);

        $data = $stmt->fetch();

        if(!$data)
        {
            return null;
        }

        return new User(
            $data["firstName"],
            $data["lastName"],
            $data["email"],
            $data["password"],
            (int)$data["id"],
            $data["created_at"]
        );
    }


    public function findAll() : array
    {
        $sql = "SELECT * FROM users";

        $stmt = $this->db->query($sql);

        $users = [];

        while($data = $stmt->fetch())
        {
            $users[] = new User(
                $data["firstName"],
                $data["lastName"],
                $data["email"],
                $data["password"],
                (int)$data["id"],
                $data["created_at"]
            );
        }

        return $users;
    }

}

?>
