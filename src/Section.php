<?php

declare(strict_types=1);

namespace DaveKok\Elf;

use InvalidArgumentException;

class Section
{
	const TYPE_NULL = 0;
	const TYPE_PROGBITS = 1;
	const TYPE_SYMTAB = 2;
	const TYPE_STRTAB = 3;
	const TYPE_RELA = 4;
	const TYPE_HASH = 5;
	const TYPE_DYNAMIC = 6;
	const TYPE_NOTE = 7;
	const TYPE_NOBITS = 8;
	const TYPE_REL = 9;
	const TYPE_SHLIB = 10;
	const TYPE_DYNSYM = 11;
	const SHF_WRITE = 1;
	const SHF_ALLOC = 2;
	const SHF_EXECINSTR = 4;

	private string|null $name;
	private int $type;
	private int $flags;
	private int $address;
	private int $offset;
	private int $size;
	private int $link;
	private int $info;
	private int $alignment;
	private int $entsize;
	private int $content;
	private int $sharedStringTableIndex;

	public function __construct(?string $name)
	{
		if ($name === "") {
			throw new InvalidArgumentException("The name of a section should not be empty.");
		}
		if (is_numeric($name)) {
			throw new InvalidArgumentException("The name of a section should not be numeric.");
		}

		$this->name = $name;
		$this->type = self::TYPE_NULL;
		$this->flags = 0;
		$this->address = 0;
		$this->offset = 0;
		$this->size = 0;
		$this->link = 0;
		$this->info = 0;
		$this->alignment = 0;
		$this->entsize = 0;
		$this->content = "";
		$this->sharedStringTableIndex = 0;

		switch ($name) {
			case ".text":
				$this->type = self::TYPE_PROGBITS;
				$this->flags = self::SHF_ALLOC | self::SHF_EXECINSTR;
				$this->alignment = 0x10;
				return;

			case ".shstrtab":
				$this->type = self::TYPE_STRTAB;
				$this->alignment = 1;
				return;
		}
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setType(int $type): self
	{
		$this->type = $type;
		return $this;
	}

	public function getType(): int
	{
		return $this->type;
	}

	public function setFlags(int $flags): self
	{
		$this->flags = $flags;
		return $this;
	}

	public function getFlags(): self
	{
		return $this->flags;
	}

	public function setWrite(bool $write): self
	{
		if ($write) {
			$this->flags |= self::SHF_WRITE;
		} else {
			$this->flags &= ~self::SHF_WRITE;
		}
		return $this;
	}

	public function isWrite(): bool
	{
		return self::SHF_WRITE === ($this->flags & self::SHF_WRITE);
	}

	public function setAlloc(bool $alloc): self
	{
		if ($alloc) {
			$this->flags |= self::SHF_ALLOC;
		} else {
			$this->flags &= ~self::SHF_ALLOC;
		}
		return $this;
	}

	public function isAlloc(): bool
	{
		return self::SHF_ALLOC === ($this->flags & self::SHF_ALLOC);
	}

	public function setExecInstr(bool $execInstr): self
	{
		if ($execInstr) {
			$this->flags |= self::SHF_EXECINSTR;
		} else {
			$this->flags &= ~self::SHF_EXECINSTR;
		}
		return $this;
	}

	public function isExecInstr(): bool
	{
		return self::SHF_EXECINSTR === ($this->flags & self::SHF_EXECINSTR);
	}

	public function setAddress(int $address): self
	{
		$this->address = $address;
		return $this;
	}

	public function getAddress(): int
	{
		return $this->address;
	}

	public function setOffset(int $offset): self
	{
		$this->offset = $offset;
		return $this;
	}

	public function getOffset(): int
	{
		return $this->offset;
	}

	public function getSize(): int
	{
		return $this->size;
	}

	public function setLink(int $link): self
	{
		$this->link = $link;
		return $this;
	}

	public function getLink(): int
	{
		return $this->link;
	}

	public function setInfo(int $info): self
	{
		$this->info = $info;
		return $this;
	}

	public function getInfo(): int
	{
		return $this->info;
	}

	public function setAlignment(int $alignment): self
	{
		$this->alignment = $alignment;
		return $this;
	}

	public function getAlignment(): int
	{
		return $this->alignment;
	}

	public function setEntSize(int $entSize): self
	{
		$this->entSize = $entSize;
		return $this;
	}

	public function getEntSize(): int
	{
		return $this->entSize;
	}

	public function addContent(string $content): self
	{
		$this->content.= $content;
		$this->size+= strlen($content);
		return $this;
	}

	public function setContent(string $content): self
	{
		$this->content = $content;
		$this->size = strlen($content);
		return $this;
	}

	public function getContent(): string
	{
		return $this->content;
	}

	public function setSharedStringTableIndex(int $index): self
	{
		$this->sharedStringTableIndex = $index;
		return $this;
	}

	public function getSharedStringTableIndex(): int
	{
		return $this->sharedStringTableIndex;
	}
}
