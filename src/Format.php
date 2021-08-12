<?php

declare(strict_types=1);

namespace DaveKok\Elf;

use InvalidArgumentException;

class Format
{
	public const MAGIC_NUMBER           = "\x7FELF";
	public const AUTO_DETECT_BITS       = 0; // auto detect bits from selected machine
	public const BITS_32                = 1;
	public const BITS_64                = 2;
	public const AUTO_DETECT_ENDIANNESS = 0; // auto detect endianness from current environment
	public const LITTLE_ENDIANNESS      = 1;
	public const BIG_ENDIANNESS         = 2;
	public const VERSION                = 1; // the ELF-format version
	public const FILE_VERSION           = 1; // ??
	public const FLAGS                  = 0; // ??

	public const ABI_NONE               = 0;       // UNIX System V ABI
	public const ABI_HPUX               = 1;       // HP-UX
	public const ABI_NETBSD             = 2;       // NetBSD
	public const ABI_GNU                = 3;       // Object uses GNU ELF extensions
	public const ABI_SOLARIS            = 6;       // Sun Solaris
	public const ABI_AIX                = 7;       // IBM AIX
	public const ABI_IRIX               = 8;       // SGI Irix
	public const ABI_FREEBSD            = 9;       // FreeBSD
	public const ABI_TRU64              = 10;      // Compaq TRU64 UNIX
	public const ABI_MODESTO            = 11;      // Novell Modesto
	public const ABI_OPENBSD            = 12;      // OpenBSD
	public const ABI_ARM_AEABI          = 64;      // ARM EABI
	public const ABI_ARM                = 97;      // ARM
	public const ABI_STANDALONE         = 255;     // Standalone (embedded) application

	public const ABIS = [
		self::ABI_NONE           => "UNIX System V ABI",
		self::ABI_HPUX           => "HP-UX",
		self::ABI_NETBSD         => "NetBSD",
		self::ABI_GNU            => "Object uses GNU ELF extensions",
		self::ABI_SOLARIS        => "Sun Solaris",
		self::ABI_AIX            => "IBM AIX",
		self::ABI_IRIX           => "SGI Irix",
		self::ABI_FREEBSD        => "FreeBSD",
		self::ABI_TRU64          => "Compaq TRU64 UNIX",
		self::ABI_MODESTO        => "Novell Modesto",
		self::ABI_OPENBSD        => "OpenBSD",
		self::ABI_ARM_AEABI      => "ARM EABI",
		self::ABI_ARM            => "ARM",
		self::ABI_STANDALONE     => "Standalone (embedded) application",
	];

	public const TYPE_NONE              = 0;      // No file type
	public const TYPE_REL               = 1;      // Relocatable file
	public const TYPE_EXEC              = 2;      // Executable file
	public const TYPE_DYN               = 3;      // Shared object file
	public const TYPE_CORE              = 4;      // Core file
	public const TYPE_NUM               = 5;      // Number of defined types
	public const TYPE_LOOS              = 0xfe00; // OS-specific range start
	public const TYPE_HIOS              = 0xfeff; // OS-specific range end
	public const TYPE_LOPROC            = 0xff00; // Processor-specific range start
	public const TYPE_HIPROC            = 0xffff; // Processor-specific range end

	public const TYPES = [
		self::TYPE_NONE          => "No file type",
		self::TYPE_REL           => "Relocatable file",
		self::TYPE_EXEC          => "Executable file",
		self::TYPE_DYN           => "Shared object file",
		self::TYPE_CORE          => "Core file",
		self::TYPE_NUM           => "Number of defined types",
		self::TYPE_LOOS          => "OS-specific range start",
		self::TYPE_HIOS          => "OS-specific range end",
		self::TYPE_LOPROC        => "Processor-specific range start",
		self::TYPE_HIPROC        => "Processor-specific range end",
	];

	public const MACHINE_NONE           =   0     // No machine
	public const MACHINE_M32            =   1     // AT&T WE 32100
	public const MACHINE_SPARC          =   2     // SUN SPARC
	public const MACHINE_386            =   3     // Intel 80386
	public const MACHINE_68K            =   4     // Motorola m68k family
	public const MACHINE_88K            =   5     // Motorola m88k family
	public const MACHINE_IAMCU          =   6     // Intel MCU
	public const MACHINE_860            =   7     // Intel 80860
	public const MACHINE_MIPS           =   8     // MIPS R3000 big-endian
	public const MACHINE_S370           =   9     // IBM System/370
	public const MACHINE_MIPS_RS3_LE    =  10     // MIPS R3000 little-endian
	public const MACHINE_PARISC         =  15     // HPPA
	public const MACHINE_VPP500         =  17     // Fujitsu VPP500
	public const MACHINE_SPARC32PLUS    =  18     // Sun's "v8plus"
	public const MACHINE_960            =  19     // Intel 80960
	public const MACHINE_PPC            =  20     // PowerPC
	public const MACHINE_PPC64          =  21     // PowerPC 64-bit
	public const MACHINE_S390           =  22     // IBM S390
	public const MACHINE_SPU            =  23     // IBM SPU/SPC
	public const MACHINE_V800           =  36     // NEC V800 series
	public const MACHINE_FR20           =  37     // Fujitsu FR20
	public const MACHINE_RH32           =  38     // TRW RH-32
	public const MACHINE_RCE            =  39     // Motorola RCE
	public const MACHINE_ARM            =  40     // ARM
	public const MACHINE_FAKE_ALPHA     =  41     // Digital Alpha
	public const MACHINE_SH             =  42     // Hitachi SH
	public const MACHINE_SPARCV9        =  43     // SPARC v9 64-bit
	public const MACHINE_TRICORE        =  44     // Siemens Tricore
	public const MACHINE_ARC            =  45     // Argonaut RISC Core
	public const MACHINE_H8_300         =  46     // Hitachi H8/300
	public const MACHINE_H8_300H        =  47     // Hitachi H8/300H
	public const MACHINE_H8S            =  48     // Hitachi H8S
	public const MACHINE_H8_500         =  49     // Hitachi H8/500
	public const MACHINE_IA_64          =  50     // Intel Merced
	public const MACHINE_MIPS_X         =  51     // Stanford MIPS-X
	public const MACHINE_COLDFIRE       =  52     // Motorola Coldfire
	public const MACHINE_68HC12         =  53     // Motorola M68HC12
	public const MACHINE_MMA            =  54     // Fujitsu MMA Multimedia Accelerator
	public const MACHINE_PCP            =  55     // Siemens PCP
	public const MACHINE_NCPU           =  56     // Sony nCPU embeeded RISC
	public const MACHINE_NDR1           =  57     // Denso NDR1 microprocessor
	public const MACHINE_STARCORE       =  58     // Motorola Start*Core processor
	public const MACHINE_ME16           =  59     // Toyota ME16 processor
	public const MACHINE_ST100          =  60     // STMicroelectronic ST100 processor
	public const MACHINE_TINYJ          =  61     // Advanced Logic Corp. Tinyj emb.fam
	public const MACHINE_X86_64         =  62     // AMD x86-64 architecture
	public const MACHINE_PDSP           =  63     // Sony DSP Processor
	public const MACHINE_PDP10          =  64     // Digital PDP-10
	public const MACHINE_PDP11          =  65     // Digital PDP-11
	public const MACHINE_FX66           =  66     // Siemens FX66 microcontroller
	public const MACHINE_ST9PLUS        =  67     // STMicroelectronics ST9+ 8/16 mc
	public const MACHINE_ST7            =  68     // STmicroelectronics ST7 8 bit mc
	public const MACHINE_68HC16         =  69     // Motorola MC68HC16 microcontroller
	public const MACHINE_68HC11         =  70     // Motorola MC68HC11 microcontroller
	public const MACHINE_68HC08         =  71     // Motorola MC68HC08 microcontroller
	public const MACHINE_68HC05         =  72     // Motorola MC68HC05 microcontroller
	public const MACHINE_SVX            =  73     // Silicon Graphics SVx
	public const MACHINE_ST19           =  74     // STMicroelectronics ST19 8 bit mc
	public const MACHINE_VAX            =  75     // Digital VAX
	public const MACHINE_CRIS           =  76     // Axis Communications 32-bit emb.proc
	public const MACHINE_JAVELIN        =  77     // Infineon Technologies 32-bit emb.proc
	public const MACHINE_FIREPATH       =  78     // Element 14 64-bit DSP Processor
	public const MACHINE_ZSP            =  79     // LSI Logic 16-bit DSP Processor
	public const MACHINE_MMIX           =  80     // Donald Knuth's educational 64-bit proc
	public const MACHINE_HUANY          =  81     // Harvard University machine-independent object files
	public const MACHINE_PRISM          =  82     // SiTera Prism
	public const MACHINE_AVR            =  83     // Atmel AVR 8-bit microcontroller
	public const MACHINE_FR30           =  84     // Fujitsu FR30
	public const MACHINE_D10V           =  85     // Mitsubishi D10V
	public const MACHINE_D30V           =  86     // Mitsubishi D30V
	public const MACHINE_V850           =  87     // NEC v850
	public const MACHINE_M32R           =  88     // Mitsubishi M32R
	public const MACHINE_MN10300        =  89     // Matsushita MN10300
	public const MACHINE_MN10200        =  90     // Matsushita MN10200
	public const MACHINE_PJ             =  91     // picoJava
	public const MACHINE_OPENRISC       =  92     // OpenRISC 32-bit embedded processor
	public const MACHINE_ARC_COMPACT    =  93     // ARC International ARCompact
	public const MACHINE_XTENSA         =  94     // Tensilica Xtensa Architecture
	public const MACHINE_VIDEOCORE      =  95     // Alphamosaic VideoCore
	public const MACHINE_TMM_GPP        =  96     // Thompson Multimedia General Purpose Proc
	public const MACHINE_NS32K          =  97     // National Semi. 32000
	public const MACHINE_TPC            =  98     // Tenor Network TPC
	public const MACHINE_SNP1K          =  99     // Trebia SNP 1000
	public const MACHINE_ST200          = 100     // STMicroelectronics ST200
	public const MACHINE_IP2K           = 101     // Ubicom IP2xxx
	public const MACHINE_MAX            = 102     // MAX processor
	public const MACHINE_CR             = 103     // National Semi. CompactRISC
	public const MACHINE_F2MC16         = 104     // Fujitsu F2MC16
	public const MACHINE_MSP430         = 105     // Texas Instruments msp430
	public const MACHINE_BLACKFIN       = 106     // Analog Devices Blackfin DSP
	public const MACHINE_SE_C33         = 107     // Seiko Epson S1C33 family
	public const MACHINE_SEP            = 108     // Sharp embedded microprocessor
	public const MACHINE_ARCA           = 109     // Arca RISC
	public const MACHINE_UNICORE        = 110     // PKU-Unity & MPRC Peking Uni. mc series
	public const MACHINE_EXCESS         = 111     // eXcess configurable cpu
	public const MACHINE_DXP            = 112     // Icera Semi. Deep Execution Processor
	public const MACHINE_ALTERA_NIOS2   = 113     // Altera Nios II
	public const MACHINE_CRX            = 114     // National Semi. CompactRISC CRX
	public const MACHINE_XGATE          = 115     // Motorola XGATE
	public const MACHINE_C166           = 116     // Infineon C16x/XC16x
	public const MACHINE_M16C           = 117     // Renesas M16C
	public const MACHINE_DSPIC30F       = 118     // Microchip Technology dsPIC30F
	public const MACHINE_CE             = 119     // Freescale Communication Engine RISC
	public const MACHINE_M32C           = 120     // Renesas M32C
	public const MACHINE_TSK3000        = 131     // Altium TSK3000
	public const MACHINE_RS08           = 132     // Freescale RS08
	public const MACHINE_SHARC          = 133     // Analog Devices SHARC family
	public const MACHINE_ECOG2          = 134     // Cyan Technology eCOG2
	public const MACHINE_SCORE7         = 135     // Sunplus S+core7 RISC
	public const MACHINE_DSP24          = 136     // New Japan Radio (NJR) 24-bit DSP
	public const MACHINE_VIDEOCORE3     = 137     // Broadcom VideoCore III
	public const MACHINE_LATTICEMICO32  = 138     // RISC for Lattice FPGA
	public const MACHINE_SE_C17         = 139     // Seiko Epson C17
	public const MACHINE_TI_C6000       = 140     // Texas Instruments TMS320C6000 DSP
	public const MACHINE_TI_C2000       = 141     // Texas Instruments TMS320C2000 DSP
	public const MACHINE_TI_C5500       = 142     // Texas Instruments TMS320C55x DSP
	public const MACHINE_TI_ARP32       = 143     // Texas Instruments App. Specific RISC
	public const MACHINE_TI_PRU         = 144     // Texas Instruments Prog. Realtime Unit
	public const MACHINE_MMDSP_PLUS     = 160     // STMicroelectronics 64bit VLIW DSP
	public const MACHINE_CYPRESS_M8C    = 161     // Cypress M8C
	public const MACHINE_R32C           = 162     // Renesas R32C
	public const MACHINE_TRIMEDIA       = 163     // NXP Semi. TriMedia
	public const MACHINE_QDSP6          = 164     // QUALCOMM DSP6
	public const MACHINE_8051           = 165     // Intel 8051 and variants
	public const MACHINE_STXP7X         = 166     // STMicroelectronics STxP7x
	public const MACHINE_NDS32          = 167     // Andes Tech. compact code emb. RISC
	public const MACHINE_ECOG1X         = 168     // Cyan Technology eCOG1X
	public const MACHINE_MAXQ30         = 169     // Dallas Semi. MAXQ30 mc
	public const MACHINE_XIMO16         = 170     // New Japan Radio (NJR) 16-bit DSP
	public const MACHINE_MANIK          = 171     // M2000 Reconfigurable RISC
	public const MACHINE_CRAYNV2        = 172     // Cray NV2 vector architecture
	public const MACHINE_RX             = 173     // Renesas RX
	public const MACHINE_METAG          = 174     // Imagination Tech. META
	public const MACHINE_MCST_ELBRUS    = 175     // MCST Elbrus
	public const MACHINE_ECOG16         = 176     // Cyan Technology eCOG16
	public const MACHINE_CR16           = 177     // National Semi. CompactRISC CR16
	public const MACHINE_ETPU           = 178     // Freescale Extended Time Processing Unit
	public const MACHINE_SLE9X          = 179     // Infineon Tech. SLE9X
	public const MACHINE_L10M           = 180     // Intel L10M
	public const MACHINE_K10M           = 181     // Intel K10M
	public const MACHINE_AARCH64        = 183     // ARM AARCH64
	public const MACHINE_AVR32          = 185     // Amtel 32-bit microprocessor
	public const MACHINE_STM8           = 186     // STMicroelectronics STM8
	public const MACHINE_TILE64         = 187     // Tileta TILE64
	public const MACHINE_TILEPRO        = 188     // Tilera TILEPro
	public const MACHINE_MICROBLAZE     = 189     // Xilinx MicroBlaze
	public const MACHINE_CUDA           = 190     // NVIDIA CUDA
	public const MACHINE_TILEGX         = 191     // Tilera TILE-Gx
	public const MACHINE_CLOUDSHIELD    = 192     // CloudShield
	public const MACHINE_COREA_1ST      = 193     // KIPO-KAIST Core-A 1st gen.
	public const MACHINE_COREA_2ND      = 194     // KIPO-KAIST Core-A 2nd gen.
	public const MACHINE_ARC_COMPACT2   = 195     // Synopsys ARCompact V2
	public const MACHINE_OPEN8          = 196     // Open8 RISC
	public const MACHINE_RL78           = 197     // Renesas RL78
	public const MACHINE_VIDEOCORE5     = 198     // Broadcom VideoCore V
	public const MACHINE_78KOR          = 199     // Renesas 78KOR
	public const MACHINE_56800EX        = 200     // Freescale 56800EX DSC
	public const MACHINE_BA1            = 201     // Beyond BA1
	public const MACHINE_BA2            = 202     // Beyond BA2
	public const MACHINE_XCORE          = 203     // XMOS xCORE
	public const MACHINE_MCHP_PIC       = 204     // Microchip 8-bit PIC(r)
	public const MACHINE_KM32           = 210     // KM211 KM32
	public const MACHINE_KMX32          = 211     // KM211 KMX32
	public const MACHINE_EMX16          = 212     // KM211 KMX16
	public const MACHINE_EMX8           = 213     // KM211 KMX8
	public const MACHINE_KVARC          = 214     // KM211 KVARC
	public const MACHINE_CDP            = 215     // Paneve CDP
	public const MACHINE_COGE           = 216     // Cognitive Smart Memory Processor
	public const MACHINE_COOL           = 217     // Bluechip CoolEngine
	public const MACHINE_NORC           = 218     // Nanoradio Optimized RISC
	public const MACHINE_CSR_KALIMBA    = 219     // CSR Kalimba
	public const MACHINE_Z80            = 220     // Zilog Z80
	public const MACHINE_VISIUM         = 221     // Controls and Data Services VISIUMcore
	public const MACHINE_FT32           = 222     // FTDI Chip FT32
	public const MACHINE_MOXIE          = 223     // Moxie processor
	public const MACHINE_AMDGPU         = 224     // AMD GPU
	public const MACHINE_RISCV          = 243     // RISC-V
	public const MACHINE_BPF            = 247     // Linux BPF -- in-kernel virtual machine
	public const MACHINE_ARC_A5         = self::MACHINE_ARC_COMPACT

	public const MACHINES = [
		self::MACHINE_NONE          => "No machine",
		self::MACHINE_M32           => "AT&T WE 32100",
		self::MACHINE_SPARC         => "SUN SPARC",
		self::MACHINE_386           => "Intel 80386",
		self::MACHINE_68K           => "Motorola m68k family",
		self::MACHINE_88K           => "Motorola m88k family",
		self::MACHINE_IAMCU         => "Intel MCU",
		self::MACHINE_860           => "Intel 80860",
		self::MACHINE_MIPS          => "MIPS R3000 big-endian",
		self::MACHINE_S370          => "IBM System/370",
		self::MACHINE_MIPS_RS3_LE   => "MIPS R3000 little-endian",
		self::MACHINE_PARISC        => "HPPA",
		self::MACHINE_VPP500        => "Fujitsu VPP500",
		self::MACHINE_SPARC32PLUS   => "Sun's \"v8plus\"",
		self::MACHINE_960           => "Intel 80960",
		self::MACHINE_PPC           => "PowerPC",
		self::MACHINE_PPC64         => "PowerPC 64-bit",
		self::MACHINE_S390          => "IBM S390",
		self::MACHINE_SPU           => "IBM SPU/SPC",
		self::MACHINE_V800          => "NEC V800 series",
		self::MACHINE_FR20          => "Fujitsu FR20",
		self::MACHINE_RH32          => "TRW RH-32",
		self::MACHINE_RCE           => "Motorola RCE",
		self::MACHINE_ARM           => "ARM",
		self::MACHINE_FAKE_ALPHA    => "Digital Alpha",
		self::MACHINE_SH            => "Hitachi SH",
		self::MACHINE_SPARCV9       => "SPARC v9 64-bit",
		self::MACHINE_TRICORE       => "Siemens Tricore",
		self::MACHINE_ARC           => "Argonaut RISC Core",
		self::MACHINE_H8_300        => "Hitachi H8/300",
		self::MACHINE_H8_300H       => "Hitachi H8/300H",
		self::MACHINE_H8S           => "Hitachi H8S",
		self::MACHINE_H8_500        => "Hitachi H8/500",
		self::MACHINE_IA_64         => "Intel Merced",
		self::MACHINE_MIPS_X        => "Stanford MIPS-X",
		self::MACHINE_COLDFIRE      => "Motorola Coldfire",
		self::MACHINE_68HC12        => "Motorola M68HC12",
		self::MACHINE_MMA           => "Fujitsu MMA Multimedia Accelerator",
		self::MACHINE_PCP           => "Siemens PCP",
		self::MACHINE_NCPU          => "Sony nCPU embeeded RISC",
		self::MACHINE_NDR1          => "Denso NDR1 microprocessor",
		self::MACHINE_STARCORE      => "Motorola Start*Core processor",
		self::MACHINE_ME16          => "Toyota ME16 processor",
		self::MACHINE_ST100         => "STMicroelectronic ST100 processor",
		self::MACHINE_TINYJ         => "Advanced Logic Corp. Tinyj emb.fam",
		self::MACHINE_X86_64        => "AMD x86-64 architecture",
		self::MACHINE_PDSP          => "Sony DSP Processor",
		self::MACHINE_PDP10         => "Digital PDP-10",
		self::MACHINE_PDP11         => "Digital PDP-11",
		self::MACHINE_FX66          => "Siemens FX66 microcontroller",
		self::MACHINE_ST9PLUS       => "STMicroelectronics ST9+ 8/16 mc",
		self::MACHINE_ST7           => "STmicroelectronics ST7 8 bit mc",
		self::MACHINE_68HC16        => "Motorola MC68HC16 microcontroller",
		self::MACHINE_68HC11        => "Motorola MC68HC11 microcontroller",
		self::MACHINE_68HC08        => "Motorola MC68HC08 microcontroller",
		self::MACHINE_68HC05        => "Motorola MC68HC05 microcontroller",
		self::MACHINE_SVX           => "Silicon Graphics SVx",
		self::MACHINE_ST19          => "STMicroelectronics ST19 8 bit mc",
		self::MACHINE_VAX           => "Digital VAX",
		self::MACHINE_CRIS          => "Axis Communications 32-bit emb.proc",
		self::MACHINE_JAVELIN       => "Infineon Technologies 32-bit emb.proc",
		self::MACHINE_FIREPATH      => "Element 14 64-bit DSP Processor",
		self::MACHINE_ZSP           => "LSI Logic 16-bit DSP Processor",
		self::MACHINE_MMIX          => "Donald Knuth's educational 64-bit proc",
		self::MACHINE_HUANY         => "Harvard University machine-independent object files",
		self::MACHINE_PRISM         => "SiTera Prism",
		self::MACHINE_AVR           => "Atmel AVR 8-bit microcontroller",
		self::MACHINE_FR30          => "Fujitsu FR30",
		self::MACHINE_D10V          => "Mitsubishi D10V",
		self::MACHINE_D30V          => "Mitsubishi D30V",
		self::MACHINE_V850          => "NEC v850",
		self::MACHINE_M32R          => "Mitsubishi M32R",
		self::MACHINE_MN10300       => "Matsushita MN10300",
		self::MACHINE_MN10200       => "Matsushita MN10200",
		self::MACHINE_PJ            => "picoJava",
		self::MACHINE_OPENRISC      => "OpenRISC 32-bit embedded processor",
		self::MACHINE_ARC_COMPACT   => "ARC International ARCompact",
		self::MACHINE_XTENSA        => "Tensilica Xtensa Architecture",
		self::MACHINE_VIDEOCORE     => "Alphamosaic VideoCore",
		self::MACHINE_TMM_GPP       => "Thompson Multimedia General Purpose Proc",
		self::MACHINE_NS32K         => "National Semi. 32000",
		self::MACHINE_TPC           => "Tenor Network TPC",
		self::MACHINE_SNP1K         => "Trebia SNP 1000",
		self::MACHINE_ST200         => "STMicroelectronics ST200",
		self::MACHINE_IP2K          => "Ubicom IP2xxx",
		self::MACHINE_MAX           => "MAX processor",
		self::MACHINE_CR            => "National Semi. CompactRISC",
		self::MACHINE_F2MC16        => "Fujitsu F2MC16",
		self::MACHINE_MSP430        => "Texas Instruments msp430",
		self::MACHINE_BLACKFIN      => "Analog Devices Blackfin DSP",
		self::MACHINE_SE_C33        => "Seiko Epson S1C33 family",
		self::MACHINE_SEP           => "Sharp embedded microprocessor",
		self::MACHINE_ARCA          => "Arca RISC",
		self::MACHINE_UNICORE       => "PKU-Unity & MPRC Peking Uni. mc series",
		self::MACHINE_EXCESS        => "eXcess configurable cpu",
		self::MACHINE_DXP           => "Icera Semi. Deep Execution Processor",
		self::MACHINE_ALTERA_NIOS2  => "Altera Nios II",
		self::MACHINE_CRX           => "National Semi. CompactRISC CRX",
		self::MACHINE_XGATE         => "Motorola XGATE",
		self::MACHINE_C166          => "Infineon C16x/XC16x",
		self::MACHINE_M16C          => "Renesas M16C",
		self::MACHINE_DSPIC30F      => "Microchip Technology dsPIC30F",
		self::MACHINE_CE            => "Freescale Communication Engine RISC",
		self::MACHINE_M32C          => "Renesas M32C",
		self::MACHINE_TSK3000       => "Altium TSK3000",
		self::MACHINE_RS08          => "Freescale RS08",
		self::MACHINE_SHARC         => "Analog Devices SHARC family",
		self::MACHINE_ECOG2         => "Cyan Technology eCOG2",
		self::MACHINE_SCORE7        => "Sunplus S+core7 RISC",
		self::MACHINE_DSP24         => "New Japan Radio (NJR) 24-bit DSP",
		self::MACHINE_VIDEOCORE3    => "Broadcom VideoCore III",
		self::MACHINE_LATTICEMICO32 => "RISC for Lattice FPGA",
		self::MACHINE_SE_C17        => "Seiko Epson C17",
		self::MACHINE_TI_C6000      => "Texas Instruments TMS320C6000 DSP",
		self::MACHINE_TI_C2000      => "Texas Instruments TMS320C2000 DSP",
		self::MACHINE_TI_C5500      => "Texas Instruments TMS320C55x DSP",
		self::MACHINE_TI_ARP32      => "Texas Instruments App. Specific RISC",
		self::MACHINE_TI_PRU        => "Texas Instruments Prog. Realtime Unit",
		self::MACHINE_MMDSP_PLUS    => "STMicroelectronics 64bit VLIW DSP",
		self::MACHINE_CYPRESS_M8C   => "Cypress M8C",
		self::MACHINE_R32C          => "Renesas R32C",
		self::MACHINE_TRIMEDIA      => "NXP Semi. TriMedia",
		self::MACHINE_QDSP6         => "QUALCOMM DSP6",
		self::MACHINE_8051          => "Intel 8051 and variants",
		self::MACHINE_STXP7X        => "STMicroelectronics STxP7x",
		self::MACHINE_NDS32         => "Andes Tech. compact code emb. RISC",
		self::MACHINE_ECOG1X        => "Cyan Technology eCOG1X",
		self::MACHINE_MAXQ30        => "Dallas Semi. MAXQ30 mc",
		self::MACHINE_XIMO16        => "New Japan Radio (NJR) 16-bit DSP",
		self::MACHINE_MANIK         => "M2000 Reconfigurable RISC",
		self::MACHINE_CRAYNV2       => "Cray NV2 vector architecture",
		self::MACHINE_RX            => "Renesas RX",
		self::MACHINE_METAG         => "Imagination Tech. META",
		self::MACHINE_MCST_ELBRUS   => "MCST Elbrus",
		self::MACHINE_ECOG16        => "Cyan Technology eCOG16",
		self::MACHINE_CR16          => "National Semi. CompactRISC CR16",
		self::MACHINE_ETPU          => "Freescale Extended Time Processing Unit",
		self::MACHINE_SLE9X         => "Infineon Tech. SLE9X",
		self::MACHINE_L10M          => "Intel L10M",
		self::MACHINE_K10M          => "Intel K10M",
		self::MACHINE_AARCH64       => "ARM AARCH64",
		self::MACHINE_AVR32         => "Amtel 32-bit microprocessor",
		self::MACHINE_STM8          => "STMicroelectronics STM8",
		self::MACHINE_TILE64        => "Tileta TILE64",
		self::MACHINE_TILEPRO       => "Tilera TILEPro",
		self::MACHINE_MICROBLAZE    => "Xilinx MicroBlaze",
		self::MACHINE_CUDA          => "NVIDIA CUDA",
		self::MACHINE_TILEGX        => "Tilera TILE-Gx",
		self::MACHINE_CLOUDSHIELD   => "CloudShield",
		self::MACHINE_COREA_1ST     => "KIPO-KAIST Core-A 1st gen.",
		self::MACHINE_COREA_2ND     => "KIPO-KAIST Core-A 2nd gen.",
		self::MACHINE_ARC_COMPACT2  => "Synopsys ARCompact V2",
		self::MACHINE_OPEN8         => "Open8 RISC",
		self::MACHINE_RL78          => "Renesas RL78",
		self::MACHINE_VIDEOCORE5    => "Broadcom VideoCore V",
		self::MACHINE_78KOR         => "Renesas 78KOR",
		self::MACHINE_56800EX       => "Freescale 56800EX DSC",
		self::MACHINE_BA1           => "Beyond BA1",
		self::MACHINE_BA2           => "Beyond BA2",
		self::MACHINE_XCORE         => "XMOS xCORE",
		self::MACHINE_MCHP_PIC      => "Microchip 8-bit PIC(r)",
		self::MACHINE_KM32          => "KM211 KM32",
		self::MACHINE_KMX32         => "KM211 KMX32",
		self::MACHINE_EMX16         => "KM211 KMX16",
		self::MACHINE_EMX8          => "KM211 KMX8",
		self::MACHINE_KVARC         => "KM211 KVARC",
		self::MACHINE_CDP           => "Paneve CDP",
		self::MACHINE_COGE          => "Cognitive Smart Memory Processor",
		self::MACHINE_COOL          => "Bluechip CoolEngine",
		self::MACHINE_NORC          => "Nanoradio Optimized RISC",
		self::MACHINE_CSR_KALIMBA   => "CSR Kalimba",
		self::MACHINE_Z80           => "Zilog Z80",
		self::MACHINE_VISIUM        => "Controls and Data Services VISIUMcore",
		self::MACHINE_FT32          => "FTDI Chip FT32",
		self::MACHINE_MOXIE         => "Moxie processor",
		self::MACHINE_AMDGPU        => "AMD GPU",
		self::MACHINE_RISCV         => "RISC-V",
		self::MACHINE_BPF           => "Linux BPF -- in-kernel virtual machine",
	];

	public const HEADER_SIZE = [
		self::BITS_32 => 64,
		self::BITS_64 => 64,
	];
	public const PROGRAM_HEADER_SIZE = [
		self::BITS_32 => 48,
		self::BITS_64 => 56,
	];
	public const SECTION_HEADER_SIZE = [
		self::BITS_32 => 64,
		self::BITS_64 => 64,
	];
	public const HEADER_PACK_FORMAT = [
		self::BITS_32 => "C4CCCCCx7vvVVPPPVvvvvvv",
		self::BITS_64 => "C4CCCCCx7vvVVPPPVvvvvvv",
	];
	public const PROGRAM_HEADER_PACK_FORMAT = [
		self::BITS_32 => "VVPPPPPP",
		self::BITS_64 => "VVPPPPPP",
	];
	public const SECTION_HEADER_PACK_FORMAT = [
		self::BITS_32 => "VVPPPPVVPP",
		self::BITS_64 => "VVPPPPVVPP",
	];
	public const SHARED_STRING_TABLE_NAME = ".shstrtab";

	private int $bits                   = self::AUTO_DETECT_BITS;
	private int $endianness             = self::AUTO_DETECT_ENDIANNESS;
	private int $version                = self::VERSION; // elf version
	private int $abi                    = self::ABI_NONE; // OS specific extentions
	private int $abiVersion             = 0; // a possible version
	private int $type                   = self::TYPE_EXEC;
	private int $machine                = self::MACHINE_X86_64;
	private int $fileVersion            = self::FILE_VERSION;
	private int $startAddress           = 0;
	private int $programTableFileOffset = 0;
	private int $sectionTableFileOffset = 0;
	private int $flags                  = self::FLAGS;
	private int $prgCount               = 0;
	private int $sectCount              = 0;
	private array $programHeaders       = [];
	private array $sections             = [];
	private int $sharedStringTableSectionIndex;

	public function getHeaderSize(): int
	{
		return self::HEADER_SIZE[$this->bits];
	}

	public function getProgramHeaderSize(): int
	{
		return self::PROGRAM_HEADER_SIZE[$this->bits];
	}

	public function getSectionHeaderSize(): int
	{
		return self::SECTION_HEADER_SIZE[$this->bits];
	}

	public function setBits(int $bits): self
	{
		if (!in_array($bits, [self::AUTO_DETECT_BITS, self::BITS_64, self::BITS_32])) {
			throw new InvalidArgumentException("invalid value for argument");
		}
		$this->bits = $bits;
		return $this;
	}

	public function getBits(): int
	{
		if ($this->bits === self::AUTO_DETECT_BITS) {
			return (PHP_INT_SIZE === 4 ? self::BITS_32 : self::BITS_64);
		} else {
			return $this->bits;
		}
	}

	public function setType(int $type): self
	{
		switch ($type) {
			case self::TYPE_NONE:
			case self::TYPE_REL:
			case self::TYPE_EXEC:
			case self::TYPE_DYN:
			case self::TYPE_COR:
				$this->type = $type;
				return $this;

			default:
				throw new InvalidArgumentException("invalid value for argument type");
		}
	}

	public function getType(): int
	{
		return $this->type;
	}

	public function setMachine(int $machine): self
	{
		if (!in_array($this->machine, array_keys(self::MACHINES))) {
			throw new InvalidArgumentException("invalid value for argument machine");
		}
		$this->machine = $machine;
		return $this;
	}

	public function getMachine(): int
	{
		return $this->machine;
	}

	public function setEndianness(int $endianness): self
	{
		switch ($type) {
			case self::AUTO_DETECT_ENDIANNESS:
			case self::LITTLE_ENDIANNESS:
			case self::BIG_ENDIANNESS:
				$this->endianness = $endianness;
				return $this;

			default:
				throw new InvalidArgumentException("invalid value for argument type");
		}
	}

	public function getEndianness(): int
	{
		if ($this->endianness === self::AUTO_DETECT_ENDIANNESS) {
			return (unpack('S',"\x01\x00")[1] === 1 ? self::LITTLE_ENDIANNESS : self::BIG_ENDIANNESS);
		}
		return $this->endianness;
	}

	public function setVersion(int $version): self
	{
		$this->version = $version;
		return $this;
	}

	public function getVersion(): int
	{
		return $this->version;
	}

	public function setAbi(int $abi): self
	{
		$this->abi = $abi;
		return $this;
	}

	public function getAbi(): int
	{
		return $this->abi;
	}

	public function setAbiVersion(int $abiVersion): self
	{
		$this->abiVersion = $abiVersion;
		return $this;
	}

	public function getAbiVersion(): int
	{
		return $this->abiVersion;
	}

	public function setFileVersion(int $fileVersion): self
	{
		$this->fileVersion = $fileVersion;
		return $this;
	}

	public function getFileVersion(): int
	{
		return $this->fileVersion;
	}

	public function setFlags(int $flags): self
	{
		$this->flags = $flags;
		return $this;
	}

	public function getFlags(): int
	{
		return $this->flags;
	}

	public function setProgramHeaderCount(int $prgCount): self
	{
		$this->prgCount = $prgCount;
	}

	public function getProgramHeaderCount(): int
	{
		return $this->prgCount;
	}

	public function setSectionHeaderCount(int $sectCount): self
	{
		$this->sectCount = $sectCount;
	}

	public function getSectionHeaderCount(): int
	{
		return $this->sectCount;
	}

	public function setStartAddress(int $startAddress): self
	{
		$this->startAddress = $startAddress;
		return $this;
	}

	public function getStartAddress(): int
	{
		return $this->startAddress;
	}

	public function setProgramTableFileOffset(int $programTableFileOffset): self
	{
		$this->programTableFileOffset = $programTableFileOffset;
		return $this;
	}

	public function getProgramTableFileOffset(): int
	{
		return $this->programTableFileOffset;
	}

	public function setSectionTableFileOffset(int $sectionTableFileOffset): self
	{
		$this->sectionTableFileOffset = $sectionTableFileOffset;
		return $this;
	}

	public function getSectionTableFileOffset(): int
	{
		return $this->sectionTableFileOffset;
	}

	public function setSharedStringTableSectionIndex(int $sharedStringTableSectionIndex): self
	{
		$this->sharedStringTableSectionIndex = $sharedStringTableSectionIndex;
		return $this;
	}

	public function getSharedStringTableSectionIndex(): int
	{
		return $this->sharedStringTableSectionIndex;
	}

	public function createProgramHeader(): ProgramHeader
	{
		return $this->programHeaders[] = new ProgramHeader();
	}

	public function removeProgramHeader(ProgramHeader $ph): self
	{
		foreach ($this->programHeaders as $i => $entry) {
			if ($entry === $ph) {
				unset($this->programHeaders[$i]);
			}
		}
		return $this;
	}

	public function getProgramHeaders(): array
	{
		return $this->programHeaders;
	}

	public function createSection(?string $name): Section
	{
		return $this->sections[$name ?? 0] = new Section($name);
	}

	public function removeSection(?string $name): self
	{
		unset($this->sections[$name ?? 0]);
	}

	public function getSection(?string $name): Section
	{
		return $this->sections[$name ?? 0];
	}

	public function getSections(): array
	{
		return $this->sections;
	}

	public function getHeaderPackFormat()
	{
		return $this->getEndianness() === self::BIG_ENDIANNESS
			? strtr(self::HEADER_PACK_FORMAT[$this->getBits()], "vVP", "nNJ")
			: self::HEADER_PACK_FORMAT[$this->getBits()];
	}

	public function getProgramPackFormat()
	{
		return $this->getEndianness() === self::BIG_ENDIANNESS
			? strtr(self::PROGRAM_HEADER_PACK_FORMAT[$this->getBits()], "vVP", "nNJ")
			: self::PROGRAM_HEADER_PACK_FORMAT[$this->getBits()];
	}

	public function getSectionPackFormat()
	{
		return $this->getEndianness() === self::BIG_ENDIANNESS
			? strtr(self::SECTION_HEADER_PACK_FORMAT[$this->getBits()], "vVP", "nNJ")
			: self::SECTION_HEADER_PACK_FORMAT[$this->getBits()];
	}

	public function packHeader(): string
	{
		$header = pack($this->getHeaderPackFormat(),
			self::MAGIC_NUMBER,
			$this->getBits(),
			$this->getEndianness(),
			$this->getVersion(),
			$this->getAbi(),
			$this->getAbiVersion(),
			$this->getType(),
			$this->getMachine(),
			$this->getFileVersion(),
			$this->getStartAddress(),
			$this->getProgramTableFileOffset(),
			$this->getSectionTableFileOffset(),
			$this->getFlags(),
			$this->getHeaderSize(),
			$this->getProgramHeaderSize(),
			$this->getProgramHeaderCount(),
			$this->getSectionHeaderSize(),
			$this->getSectionCount(),
			$this->getSharedStringTableSectionIndex()
		);
		if ($header === false) {
			throw new \Exception("formatting elf header failed");
		}
		return $header;
	}

	public function packProgramHeaders(): string
	{
		$programPackFormat = $this->getProgramPackFormat();
		$prgheaders = "";
		foreach ($this->programHeaders as $ph) {
			$prgheader = pack($programPackFormat,
				$ph->getType(),
				$ph->getFlags(),
				$ph->getOffset(),
				$ph->getVirtualAddress(),
				$ph->getPhysicalAddress(),
				$ph->getFileSize(),
				$ph->getMemorySize(),
				$ph->getAlignment()
			);
			if ($prgheader === false) {
				throw new \Exception("formatting elf program header failed");
			}
			$prgheaders.= $prgheader;
		}
		return $prgheaders;
	}

	public function packSectionHeaders(): string
	{
		$sectionPackFormat = $this->getSectionPackFormat();
		$sctheaders = "";
		foreach ($this->sections as $s) {
			$sctheader = pack($sectionPackFormat,
				$s->getSharedStringTableIndex(),
				$s->getType(),
				$s->getFlags(),
				$s->getAddress(),
				$s->getOffset(),
				$s->getSize(),
				$s->getLink(),
				$s->getInfo(),
				$s->getAlignment(),
				$s->getEntSize()
			);
			if ($sctheader === false) {
				throw new \Exception("formatting elf section header failed");
			}
			$sctheaders.= $sctheader;
		}
		return $sctheaders;
	}

	public function pack(): string
	{
		$program_size = strlen($program);

		$header_size = ELF_HEADER_SIZE + ELF_PROGRAM_HEADER_SIZE;
		$header_padding = str_repeat("\0", 16 - ($header_size % 16)); // pad for alignment
		$header_size+= strlen($header_padding);

		$content = $program;
		$content.= $shstrtab;
		$content.= str_repeat("\0", 8 - (strlen($content) % 8)); // pad for alignment
		$content_size = strlen($content);

		$load_size = $header_size + $program_size;

		$baseAddress = 0x400000;
		$programOffset = 0x80;
		$startAddress = $baseAddress + $programOffset;
		$programTableFileOffset = ELF_HEADER_SIZE;
		$sectionTableFileOffset = $header_size + $content_size;
		$programEntryCount = 1;
		$sectionCount = 3;
		$sectionIndex = 2;
		$flags = ELF_HEADER_TYPE_EXEC;


		$elf = formatElfHeader($startAddress, $programTableFileOffset, $sectionTableFileOffset, $programEntryCount, $sectionCount, $sectionIndex, $flags);
		$elf.= formatElfProgramHeader(ELF_PRHEADER_TYPE_LOAD, ELF_PRHEADER_EXEC|ELF_PRHEADER_READ, 0, $baseAddress, $baseAddress, $load_size, $load_size, 0x200000);
		$elf.= $header_padding;
		$elf.= $content;
		$elf.= formatElfSectionHeader(0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
		$elf.= formatElfSectionHeader($shstrtab->getIndex(".text"), 1, 6, $startAddress, $programOffset, $program_size, 0, 0, 0x10, 0);
		$elf.= formatElfSectionHeader($shstrtab->getIndex(".shstrtab"), 3, 0, 0, $load_size, $shstrtab->getSize(), 0, 0, 0x1, 0);

		return $elf;
	}
}
