<?php

namespace App\Domain\Entities;

class Client
{
    private ?int $id = null;
    private string $huggy_id = '';
    private string $name = '';
    private string $email = '';
    private ?string $phone = null;
    private ?string $mobile = null;
    private ?string $address = null;
    private ?string $state = null;
    private ?string $district = null;
    private ?string $city = null;
    private ?string $zip_code = null;
    private ?string $photo = null;
    private ?string $birth_date = null;
    private ?string $last_seen = null;
    private bool $status = true;

    public function getId(): ?int { return $this->id; }
    public function getHuggyId(): string { return $this->huggy_id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
    public function getPhone(): ?string { return $this->phone; }
    public function getMobile(): ?string { return $this->mobile; }
    public function getAddress(): ?string { return $this->address; }
    public function getState(): ?string { return $this->state; }
    public function getDistrict(): ?string { return $this->district; }
    public function getCity(): ?string { return $this->city; }
    public function getZipCode(): ?string { return $this->zip_code; }
    public function getPhoto(): ?string { return $this->photo; }
    public function getBirthDate(): ?string { return $this->birth_date; }
    public function getLastSeen(): ?string { return $this->last_seen; }
    public function getStatus(): bool { return $this->status; }

    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function setHuggyId(string $huggy_id): self { $this->huggy_id = $huggy_id; return $this; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }
    public function setPhone(?string $phone): self { $this->phone = $phone; return $this; }
    public function setMobile(?string $mobile): self { $this->mobile = $mobile; return $this; }
    public function setAddress(?string $address): self { $this->address = $address; return $this; }
    public function setState(?string $state): self { $this->state = $state; return $this; }
    public function setDistrict(?string $district): self { $this->district = $district; return $this; }
    public function setCity(?string $city): self { $this->city = $city; return $this; }
    public function setZipCode(?string $zip_code): self { $this->zip_code = $zip_code; return $this; }
    public function setPhoto(?string $photo): self { $this->photo = $photo; return $this; }
    public function setBirthDate(?string $birth_date): self { $this->birth_date = $birth_date; return $this; }
    public function setLastSeen(?string $last_seen): self { $this->last_seen = $last_seen; return $this; }
    public function setStatus(bool $status): self { $this->status = $status; return $this; }
}
