<?php

declare(strict_types=1);

namespace Xvilo\CrtShApi\Model;

final class SearchResult
{
    public function __construct(
        readonly private int $id,
        readonly private int $issuerCaId,
        readonly private string $issuerName,
        readonly private string $commonName,
        readonly private string $name,
        readonly private \DateTimeInterface $entry,
        readonly private \DateTimeInterface $notBefore,
        readonly private \DateTimeInterface $notAfter,
        readonly private string $serialNumber
    ) {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIssuerCaId(): int
    {
        return $this->issuerCaId;
    }

    /**
     * @return string
     */
    public function getIssuerName(): string
    {
        return $this->issuerName;
    }

    /**
     * @return string
     */
    public function getCommonName(): string
    {
        return $this->commonName;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getEntry(): \DateTimeInterface
    {
        return $this->entry;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getNotBefore(): \DateTimeInterface
    {
        return $this->notBefore;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getNotAfter(): \DateTimeInterface
    {
        return $this->notAfter;
    }

    /**
     * @return string
     */
    public function getSerialNumber(): string
    {
        return $this->serialNumber;
    }
}
