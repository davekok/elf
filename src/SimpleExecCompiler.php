<?php

declare(strict_types=1);

namespace DaveKok\Elf;

use InvalidArgumentException;

class SimpleProgramWriter
{
	const DEFAULT_BASE_ADDRESS = 0x400000; // don't know exactly what it means

	private $baseAddress = self::DEFAULT_BASE_ADDRESS;
	private $program;
	private $writer;

	public function __construct(Writer $writer)
	{
		$this->writer = $writer;
	}

	public function setBaseAddress(int $baseAddress): self
	{
		$this->baseAddress = $baseAddress;
		return $this;
	}

	public function getBaseAddress(): int
	{
		return $this->baseAddress;
	}

	public function setProgram(string $program)
	{
		$this->program = $program;
	}

	public function getProgram()
	{
		return $this->program;
	}

	public function write()
	{
		$format = new Format();
		$programHeader = $format->createProgramHeader();
		$programHeader = $format->createNullSection();

		// create shared string table section
		$sharedStringTable = new Section(Format::SHARED_STRING_TABLE_NAME);

		$prgs = [];
		$data = [];
		$other = [];
		foreach ($sections as $section) {
			if ($section->getName() === null || $section->getName() === Format::SHARED_STRING_TABLE_NAME) {
				continue;
			} else if ($section->getType() === Section::TYPE_PROGBITS && $section->isExecInstr()) { // is section executable?
				$prgs[] = $section;
			} else if ($section->getType() === Section::TYPE_PROGBITS) { // should section be loaded?
				$load[] = $section;
			} else {
				$other[] = $section;
			}
		}

		// reorder sections
		$sections = array_merge(
			[0 => new Section(null)], // null section must come first
			$prgs,
			$load,
			$other,
			[File::SHARED_STRING_TABLE_NAME => $sharedStringTable]
		);

		$prgCount = count($prgs);
		$sectCount = count($sections);

		$progoffset = $this->file->getProgramHeaderSize() * $prgCount + $this->file->getHeaderSize();
		$progoffset += 16 - ($progoffset % 16);

		$startAddress = $this->baseAddress + $progoffset;

		$contentSize = 0;
		$loadSize = 0;
		foreach ($this->sections as $section) {
			$section->setSharedStringTableIndex($sharedStringTable->getSize());
			$sharedStringTable->addContent($section->getName() . "\0");
			$section->setOffset($contentSize + $progoffset);
			$contentSize += $section->getSize();
			if ($section->getType() === Section::TYPE_PROGBITS) {
				$section->setAddress($loadSize + $startAddress); // should this be aligned?
				$loadSize += $section->getSize();
			}
		}

		// generate one program header for all progbits sections
		if ($prgCount) {
			$this->type = $this->file::TYPE_EXEC;
			$ph = new ProgramHeader();
			$ph->setType(ProgramHeader::TYPE_LOAD);
			$ph->setFlags(ProgramHeader::EXEC | ProgramHeader::READ);
			$ph->setOffset(0); // include Elf header and program headers
			$ph->setVirtualAddress($this->baseAddress);
			$ph->setPhysicalAddress($this->baseAddress);
			$ph->setFileSize($loadSize);
			$ph->setMemorySize($loadSize);
			$ph->setAlign($this->baseAddress / 2);
			$this->file programHeaders = [$ph];
		}

		$contentPaddingSize = 8 - ($contentSize % 8);
		$this->file->setProgramTableFileOffset($progoffset);
		$this->file->setSectionTableFileOffset($progoffset + $contentSize + $contentPaddingSize);
		$this->file->setProgramHeaderCount($prgCount);
		$this->file->setSectionHeaderCount($sectCount);
		$this->file->setSharedStringTableSectionIndex($sectCount - 1);
	}
}
