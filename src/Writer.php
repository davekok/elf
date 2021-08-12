<?php

declare(strict_types=1);

namespace DaveKok\Elf;

use InvalidArgumentException;
use DaveKok\Stream\StreamInterface

class Writer
{
	public function __construct(private StreamInterface $stream) {}

	public function write(Format $format): void
	{
		$elfheader = $format->packHeader();
		$prgheaders = $format->packProgramHeaders();
		$sctheaders = $format->packSectionHeaders();

		$this->stream->truncate();

		$this->stream->write($elfheader);
		$this->stream->seek($format->getProgramTableFileOffset());
		$this->stream->write($prgheaders);
		$this->stream->seek($format->getSectionTableFileOffset());
		$this->stream->write($sctheaders);
		foreach ($format->getSections() as $s) {
			if ($s->getSize()) {
				$this->stream->seek($s->getOffset());
				$this->stream->write($s->getContent());
			}
		}
	}
}
