<?php

namespace Fakers;

use Stub\User;
require_once './Stub/User.php';

class UserFactory {
    private int $count = 1;
    public static function fake(): self {
        return new self();
    }
    public function count(int $count): self {
        $this->count = $count;
        return $this;
    }
    public function make(): array {
        $users = [];
        for ($i = 0; $i < $this->count; $i++) {
            $user = new User();
            $user->id = $i + 1;
            $user->name = $this->generateRandomName();
            $user->surname = $this->generateRandomSurname();
            $user->position = $this->generateRandomPosition();
            $users[] = $user;
        }
        return $users;
    }

    private function generateRandomName(): string {
        $names = ['John', 'Alice', 'Bob', 'Jane', 'Michael', 'Emma', 'David', 'Sarah', 'Daniel'];
        return $names[array_rand($names)];
    }

    private function generateRandomSurname(): string {
        $surnames = ['Smith', 'Johnson', 'Williams', 'Jones', 'Brown', 'Davis', 'Miller', 'Wilson', 'Taylor'];
        return $surnames[array_rand($surnames)];
    }

    private function generateRandomPosition(): string {
        $positions = ['Manager', 'Developer', 'Designer', 'Sales Manager', 'Accountant', 'Marketing Specialist'];
        return $positions[array_rand($positions)];
    }
}