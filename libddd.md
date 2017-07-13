# Home of the SDD/DDD C++ library LibDDD.

## <a name="sec:what"></a>What is libDDD ?

<span style="font-weight: bold">libDDD</span> is C++ library for manipulation of decision diagrams.

Main features include:

*   Flexible and powerful encoding of operations using inductive homomorphisms  

*   Support for hierarchy of the description with SDD
*   Automatic support for saturation style algorithms
*   A priori unbounded integer domain variables
*   Rich expressivity with equiv-split mechanism
*   Weak ordering constraint allowing to store variable length decision paths
*   Supports both Data Decision Diagrams which are integer valued and Hierarchical Set Decision Diagrams.

libDDD is distributed under the terms of [LGPL](http://www.gnu.org/licenses/lgpl.html).

## <a name="sec:start">I. Getting started</a>

<a name="sec:start">libDDD is a library for manipulation of shared decision diagrams. If you are not familiar with these symbolic techniques, these slides explain the basics. [[slides.pdf](http://www.lip6.fr/ddd-download/ICTAC2006.pdf) ] They are taken from a presentation at ICTAC in 2006\. The part relevant to decision diagrams stops at page 22\.  
SDD inherit their operation framework called Homomorphisms from DDD. The ATPN2002 [[Presentation slides (ppt)](http://www.lip6.fr/ddd-download/PN2002.zip) ] are a good starting material to get familiar with homomorphisms, without hierarchy.  
For some presentation slides more focused on SDD, the [[ATPN08 slides](http://www.lip6.fr/ddd-download/PN2008.zip) ] give a good overview.  

A version of the [Technical User Documentation is provided online here](http://ddd.lip6.fr/libddd.html/index.html), though it could be a bit out of date (last generated June 2010).  

The best way to get started is to browse the examples of the [[demo folder](https://github.com/lip6/libDDD/tree/master/demo) ].  
It contains several simple examples designed to get a new user familiar with the main aspects of the library.  
Tst1 to Tst12 are small examples that show basic library features. The folder hanoi/ contains a solution to Hanoi towers puzzle using several alternative variants to define both states and transition relation.

The distribution also includes a documentation folder doc/ in which a detailed developer documentation can be generated (requires [doxygen](www.doxygen.org)). The doc folder also contains a reference sheet giving correspondence between the notations used in papers and the overloaded C++ operators used in the library

The [Documents](manual.md) page holds many related papers which give a formal definition to all the concepts of the library.

</a>

## <a name="sec:start"></a><a name="sec:libddd"></a>II. Obtaining LibDDD

LibDDD is free software distributed under the terms of Lesser Gnu Public License LGPL. It is a C++ library to manipulate SDD and DDD.

If your ultimate goal is model-checking, you might consider using libits, which is our model-checking library built on top of libddd and offering support specific to transition relations and their manipulation using SDD and homomorphisms. libits is distributed under a more restrictive full GPL license.

LibDDD is packaged using gnu autotools.

You can download the current release (v. 1.9) from here: [LibDDD download page](https://lip6.github.io/libDDD/)

The package distribution uses GNU autotools, simply extract then in the root installation folder type.

> <tt>./configure  
> make</tt>

Build has been tested on Linux (32 and 64 bit), MacOS X on PPC and intel, and Cygwin/MinGW 32 and 64 environments. If you encounter any problems please mail me (mailto:ddd@lip6.fr)  

In fact, even if you don't encounter problems, we are always interested in feedback and simply knowing about our users so please mail us (mailto:ddd@lip6.fr) if you are using the library in your project.

## <a name="sec:svn"></a>II. Obtaining the latest version using Git

### <a name="sec:prereq"></a>1\. Git, Prerequisites

The latest version of libDDD can be obtained from GitHub at _https://github.com/lip6/libDDD_. 

Note that to build from the git, you need autotools and to invoke "autoreconf -vfi" to create the "configure" script. 
Due to various dependencies, building from svn requires some configuration settings. 

Remember, configure --help is your friend, and you can also have a look at the configuration settings of our [Travis continuous integration server](https://github.com/lip6/libDDD/blob/master/.travis.yml) or [AppVeyor for Windows](https://github.com/lip6/libDDD/blob/master/appveyor.yml) for inspiration on how to invoke configure.

This is the recommended approach for developers to download the ITS related tools.

Full installation follows these guidelines:

### Prerequisites

*   Autotools in relatively recent versions (autoconf >= 2.19, automake >= 2.61), packaged on most distributions.
*   C++ build tools (GNU toolchain recommended g++, sh, make and dependencies)
*   A git client, command line or graphical (eGit provided in Eclipse for instance).

### Install of libDDD

Follow the usual <code> ./configure ; make ; make install </code> mojo.
Pass <code>--prefix=/home/me/alocalpath/</code> to __configure__ to install in a non standard location (or if you are not root).

The code base for libDDD is based on the DDD library by Jean-Michel Couvreur and Denis Poitrenaud. 
The code for SDD manipulation is due to Yann Thierry-Mieg and Alexandre Hamez. 
Maximilien Colange has also actively contributed to the core homomomorphism evaluation mechanism.

## <a name="sec:ack"></a>III. Authors, History

### <a name="sec:author"></a>1\. Authors

#### Main Authors of LibDDD

Yann Thierry-Mieg (LIP6, Yann.Thierry-Mieg@lip6.fr, 2003-), Jean-Michel Couvreur (LaBRi, 2001), and Denis Poitrenaud (LIP6, 2001)

#### Contributors

*   Maximilien Colange < LIP6, Maximilien.Colange@lip6.fr > (2010-present): split-equiv, ordering heuristics, symmetries, google hash support, maintenance and performance upgrades
*   Alexandre Hamez < LIP6 and LRDE (EPITA), Alexandre.Hamez@lip6.fr > (2006-2009): maintenance, multi-threading, rewrite rules
*   Vincent Beaudenon < LIP6 > (2004-2005) : serialisation, user (not strong) homomorphisms
*   François Bréant < LIP6 > (2004) : INST_STL, multi-target build
*   Samuel Charron < LRDE (EPITA) > (2005-2006) : tests

#### Code base

*   We borrowed [google's sparse hash table](http://googlecode.com/sparsehash) implementation in C++, which gives low memory footprints with limited time overhead. This (almost) drop-in replacement for standard STL hash tables gives up to 40% memory gain on some experiments.
*   We borrowed several utility functions (process monitoring, hash functions...) from Spot's code base, due to Alexandre duret-Lutz, Denis Poitrenaud et al.

### Version History

#### version 1.9 : January 2017\. Release includes new rewritings, faster constrained saturation, C++11

*   Refactor paths and includes to honor standards : all header files are now installed under ddd/
*   Switch to C++11 compatibility, enable Link-time-optimizations, maintenance of code base for recent compilers
*   Switch to Git, add online CI scripts for easy and transparently reproducible builds 
*   New has_image() API for faster emptiness checks and more efficient evaluation of complex boolean predicates
*   Reordered evaluation mechanism using Selector markers
*   Added some generally useful homomorphisms to Basic homomorphisms
*   Added some additional rewriting rules for DDD homomorphisms : saturation under a constraint useful in both CTL and LTL

#### version 1.8 : January 2012\. Release includes the new equiv-split mechanism and several significant performance improvements.

*   New hash table implementation based on google's hash tables. Yields significantly (10 to 40%) lower memory foortprint.
*   Reimplementation of low-level encoding and storage of DDD. Lowers memory footprint significantly (up to 30%) on 64bit architectures.
*   Split-equiv functionality to evaluate complex expressions
*   Added some additional rewriting rules for DDD homomorphisms

#### version 1.7 : February 2011\. Release includes some "standard" homomorphisms to reason with integers, and a new way of defining operations as 2k level DD.

*   New homomorphisms Select and Set pushed into libDDD (were duplicated in quite a few tools)
*   New Apply2k operation to specify a transition relation as a decision diagram. Use case related to use of ETF files.
*   Improved stats and dot export functionality
*   Improved memory footprint by up to 30% on some examples (privilege use of std::vector over use of std::set wherever possible)

#### version 1.6 : May 2010\. Release includes a few new rewriting rules and upgrades compatibility with newer compilers.

*   More rules related to selector homomorphisms added
*   Added an "invert" member function to homomorphisms allowing to compute the pre-image given a potential state space.
*   Use evil macros and suchlike to support tr1 standard where available

#### version 1.5 : June 2009\. Release includes enhanced auto-saturation, selector homomorphisms, and commutative rewriting rules.

*   homomorphisms Range added as a simple commutativity criterion
*   More rewriting rules implemented to enhance dynamic saturation effect
*   Selector predicate introduced, allows use of not, ITE, ... To ease manipulation of atomic properties
*   morpion (TicTacToe) tutorial example added to repository
*   MT-SAFE version can be built for multi-threaded applications (although efficiency is badly impacted)

#### version 1.4 : January 2008\. Release includes auto-saturation mechanisms and homomorphism rewrite rules.

*   homomorphisms Skip predicate added
*   rewriting rules implmented to produce dynamic saturation effect
*   local apply mechanisms and related rules
*   hanoi example added to repository
*   INST_STL removed from build (was broken with gcc > 3.3 anyway)

#### version 1.3 : May 2007\. Release includes support for additive Edge valued DDD and SDD

*   various cleanups and rewrites for compliance with gcc >= 4.1
*   minor updates to allow build on 64 bit architectures
*   added tests using uttk
*   include a dot export example

#### Version 1.2 : January 2006\. Release includes the fixpoint construction for homomorphisms.

*   include serialization and user homomorphisms
*   Cleaned up includes
*   Added doxygen documentation
*   Changed hash functions
*   Some efficiency speedup

#### Version 1.1 : November 2004\. First semi-public release of the libDDD. Release includes SDD.

*   Uses autotools for build procedure, tested on Mac, linux, cygwin.
*   Compiles in three variants :
    *   libddd.a, the optimized version,
    *   libddd_d.a version with debugging symbols activated,
    *   libddd_otfg.a a version with experimental on the fly garbage collection
*   Optionally, using gcc in versions 3.1, 3.2 or 3.3, it is possible to activate build of INST_STL version, modify src/Makefile.am for this.

#### Pre 1.0 : 2001-2003\. Beta versions of the pure DDD library. Version 0.99 was version number for some time.

### <a name="sec:old"></a>3\. Older releases of libDDD

You can download release (v. 1.8.1) from here: [ddd-1.8.1.tar.gz](./download/ddd-1.8.1.tar.gz). 

You can download release (v. 1.8.0) from here: [ddd-1.8.tar.gz](./download/ddd-1.8.0.tar.gz). This version does not correctly package third party headers from Google, you should probably use 1.8.1 instead.

You can download release (v. 1.7) from here: [ddd-1.7.tar.gz](./download/ddd-1.7.0.tar.gz)

You can download release (v. 1.6) from here: [ddd-1.6.tar.gz](./download/ddd-1.6.0.tar.gz)

You can download another stable release (v. 1.5) from here: [ddd-1.5.tar.tgz](http://www.lip6.fr/ddd-download/ddd-1.5.tar.gz)

You can download older release (v. 1.4) from here: [ddd-1.4.tar.gz](http://www.lip6.fr/ddd-download/ddd-1.4.tar.gz)

<div class="toplink" align="right">[Start of page ![](images/up.gif)](#toc)</div>