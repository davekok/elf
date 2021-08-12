<?php

declare(strict_types=1);

namespace DaveKok\Elf;

use Exception;
use InvalidArgumentException;
use DaveKok\Stream\StreamInterface

class Reader
{
	public function __construct(private StreamInterface $stream) {}

	public function read(): Format
	{
		$this->stream->seek(0);

		$magicNumber = $this->stream->read(strlen(Format::MAGIC_NUMBER));
		if ($magicNumber !== Format::MAGIC_NUMBER) {
			throw new Exception("not a elf file");
		}

		$bits = $this->stream->read(1);
		if ($bits === false) {
			throw new Exception("not a elf file");
		}
		$bits = ord($bits);
		if ($bits === Format::BITS_32 || $bits === Format::BITS_64) {
			throw new Exception("only 32 and 64 bits elf files are supported");
		}
		if ($bits === Format::BITS_32) {
			$format = new Format;
		} else {
			$format = new Format64;
		}

		$endianness = $this->stream->read(1);
		if ($endianness === false) {
			throw new Exception("not a elf file");
		}
		$format->setEndianness(ord($endianness));

		$version = $this->stream->read(1);
		if ($version === false) {
			throw new Exception("not a elf file");
		}
		if ($version !== Format::VERSION) {
			throw new Exception("unsupported elf version: $version");
		}

		$abi = $this->stream->read(1);
		if ($abi === false) {
			throw new Exception("not a elf file");
		}
		$format->setAbi(ord($abi));

		// TODO: read in the rest
	}
}
