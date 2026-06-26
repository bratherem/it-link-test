<?php

declare(strict_types=1);

namespace app\Entity;

final class Car
{
    public function __construct(
        private ?int $id,
        private string $title,
        private string $description,
        private string $price,
        private string $photoUrl,
        private string $contacts,
        private ?string $createdAt = null,
        private ?CarOption $option = null,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getPhotoUrl(): string
    {
        return $this->photoUrl;
    }

    public function getContacts(): string
    {
        return $this->contacts;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getOption(): ?CarOption
    {
        return $this->option;
    }

    public function withId(int $id): self
    {
        return new self(
            $id,
            $this->title,
            $this->description,
            $this->price,
            $this->photoUrl,
            $this->contacts,
            $this->createdAt,
            $this->option,
        );
    }

    public function withCreatedAt(string $createdAt): self
    {
        return new self(
            $this->id,
            $this->title,
            $this->description,
            $this->price,
            $this->photoUrl,
            $this->contacts,
            $createdAt,
            $this->option,
        );
    }

    public function withOption(?CarOption $option): self
    {
        return new self(
            $this->id,
            $this->title,
            $this->description,
            $this->price,
            $this->photoUrl,
            $this->contacts,
            $this->createdAt,
            $option,
        );
    }

    public function toArray(): array
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => (float) $this->price,
            'photo_url' => $this->photoUrl,
            'contacts' => $this->contacts,
            'created_at' => $this->createdAt,
        ];

        if ($this->option !== null) {
            $data['options'] = $this->option->toArray();
        }

        return $data;
    }
}
