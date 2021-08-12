<?php

declare(strict_types=1);

namespace DaveKok\Elf;

use InvalidArgumentException;

class ProgramHeader
{
	const TYPE_NULL = 0;
	const TYPE_LOAD = 1;
	const TYPE_DYNAMIC = 2;
	const EXEC = 1;
	const WRITE = 2;
	const READ = 4;

	private $type;
	private $flags;
	private $offset; // may include elf header and program headers
	private $virtualAddress;
	private $physicalAddress;
	private $fileSize; // may include elf header and program header
	private $memorySize; // may be larger than file size to allocate additional memory
	private $align;

	public function setType(int $type): self
	{
		$this->type = $type;
		return $this->type;
	}

	public function getType(): int
	{
		return $this->type;
	}

	public function setFlags(int $flags): self
	{
		$this->flags = $flags;
		return $this->flags;
	}

	public function getFlags(): int
	{
		return $this->flags;
	}

	public function setOffset(int $offset): self
	{
		$this->offset = $offset;
		return $this->offset;
	}

	public function getOffset(): int
	{
		return $this->offset;
	}

	public function setVirtualAddress(int $virtualAddress): self
	{
		$this->virtualAddress = $virtualAddress;
		return $this->virtualAddress;
	}

	public function getVirtualAddress(): int
	{
		return $this->virtualAddress;
	}

	public function setPhysicalAddress(int $physicalAddress): self
	{
		$this->physicalAddress = $physicalAddress;
		return $this->physicalAddress;
	}

	public function getPhysicalAddress(): int
	{
		return $this->physicalAddress;
	}

	public function setFileSize(int $fileSize): self
	{
		$this->fileSize = $fileSize;
		return $this->fileSize;
	}

	public function getFileSize(): int
	{
		return $this->fileSize;
	}

	public function setMemorySize(int $memorySize): self
	{
		$this->memorySize = $memorySize;
		return $this->memorySize;
	}

	public function getMemorySize(): int
	{
		return $this->memorySize;
	}

	public function setAlign(int $align): self
	{
		$this->align = $align;
	}

	public function getAlign(): int
	{
		return $this->align;
	}
}
