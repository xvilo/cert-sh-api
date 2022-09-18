<?php

declare(strict_types=1);

namespace Xvilo\CrtShApi\Model;

final class SearchResult
{
    public function __construct(
        readonly private int                $id,
        readonly private int                $issuerCaId,
        readonly private string             $issuerName,
        readonly private string             $commonName,
        readonly private string             $name,
        readonly private \DateTimeInterface $createdAt,
        readonly private \DateTimeInterface $notBefore,
        readonly private \DateTimeInterface $notAfter,
        readonly private string             $serialNumber
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIssuerCaId(): int
    {
        return $this->issuerCaId;
    }

    public function getIssuerName(): string
    {
        return $this->issuerName;
    }

    public function getCommonName(): string
    {
        return $this->commonName;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getNotBefore(): \DateTimeInterface
    {
        return $this->notBefore;
    }

    public function getNotAfter(): \DateTimeInterface
    {
        return $this->notAfter;
    }

    public function getSerialNumber(): string
    {
        return $this->serialNumber;
    }
}
