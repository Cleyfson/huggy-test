<?php

namespace App\Domain\Entities;

class Client
{
    public function __construct(
        public ?int $id,
        public string $huggy_id,
        public string $name,
        public string $email,
        public ?string $phone,
        public ?string $mobile,
        public ?string $address,
        public ?string $state,
        public ?string $district,
        public ?string $city,
        public ?string $zip_code,
        public ?string $photo,
        public ?string $birth_date,
        public ?string $last_seen,
        public bool $status = true,
    ) {}
}
