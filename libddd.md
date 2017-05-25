<html>
<?php include 'header.md'; ?>

<h1>Home of the SDD/DDD C++ library LibDDD.</h1>
<a name="toc"></a>

<?php TableOfContents(__FILE__, 3); ?>


      <h2><a name="sec:what"></a>What is libDDD ?</h2>
        <p><span style="font-weight: bold">libDDD</span> is C++ library for manipulation of decision diagrams.</p>
        <p>Main features include:</p>
        <ul>
          <li>Flexible and powerful encoding of operations using inductive homomorphisms<br />
          </li>
          <li>Support for hierarchy of the description with SDD</li>
          <li>Automatic support for saturation style algorithms</li>
          <li>A priori unbounded integer domain variables</li>
          <li>Rich expressivity with equiv-split mechanism</li>
          <li>Weak ordering constraint allowing to store variable length decision paths</li>
          <li>Supports both Data Decision Diagrams which are integer valued and Hierarchical Set Decision Diagrams.</li>
        </ul>
        <p>libDDD is distributed under the terms of [LGPL](http://www.gnu.org/licenses/lgpl.html).</p>
        <p>&nbsp;</p>



      <h2><a name="sec:start">I. Getting started </h2>
		libDDD is a library for manipulation of shared decision diagrams.
		If you are not familiar with these symbolic techniques, these slides explain the basics.
	[[slides.pdf](http://www.lip6.fr/ddd-download/ICTAC2006.pdf) ]
	They are taken from a presentation at ICTAC in 2006. The part relevant to decision diagrams stops at page 22.  <br/>
	SDD inherit their operation framework called Homomorphisms from DDD. 
	The ATPN2002 [[Presentation slides (ppt)](http://www.lip6.fr/ddd-download/PN2002.zip) ] are a good starting material to get familiar with homomorphisms, without hierarchy. <br/>
	For some presentation slides more focused on SDD, the [[ATPN08 slides](http://www.lip6.fr/ddd-download/PN2008.zip) ] 
	give a good overview. <br/>
        <p> A version of the [Technical User Documentation is provided online here](./libddd.html/index.html), though it could be a bit out of date (last generated June 2010). <br/>
        </p>
		<p>The best way to get started is to browse the examples of the [[demo folder](https://projets-systeme.lip6.fr/trac/research/libddd/browser/libddd/trunk/demo) ].  <br /> 
		    It contains several simple examples designed to get a new user familiar with the main aspects of the library. <br />
		    Tst1 to Tst12 are small examples that show basic library features. The folder hanoi/ contains a solution to Hanoi towers puzzle using several alternative variants to define both states and transition relation.</p>
        <p>The distribution also includes a documentation folder doc/ in which a detailed developer documentation can be generated (requires [doxygen](www.doxygen.org)). 
		  The doc folder also contains a reference sheet giving correspondence between the notations used in papers and the overloaded C++ operators used in the library</p>
	<p>
		The [Documents](manual.md) page holds many related papers which give a formal definition to all the concepts of the library.
		</p>  


<h2><a name="sec:libddd"></a>II. Obtaining LibDDD</h3>
<p>LibDDD is free software distributed under the terms of Lesser Gnu
	Public License LGPL. It is a C++ library to manipulate SDD and DDD.</p>
<p>
	If your ultimate goal is model-checking, you might consider using libits, which is our model-checking library built on top of libddd and offering 
support specific to transition relations and their manipulation using SDD and homomorphisms. libits is distributed under a more restrictive full GPL license.	
</p>

<p>LibDDD is packaged using gnu autotools.</p>
<p>
	You can download the current release (v. 1.8) from here: <a
		href="./download/ddd-1.8.1.tar.gz">ddd-1.8.1.tar.gz</a>
</p>
The package distribution uses GNU autotools, simply extract then in the
root installation folder type.
</p>
<blockquote>
	<p>
		<tt>
			./configure<br /> make
		</tt>
	</p>
</blockquote>
<p>
	Build has been tested on Linux (32 and 64 bit), MacOS X on PPC and
	intel, and Cygwin/MinGW 32 and 64 environments. If you encounter any problems please
	mail me (mailto:ddd@lip6.fr)<br /> <br /> In fact, even if you don't
	encounter problems, we are always interested in feedback and simply
	knowing about our users so please mail us (mailto:ddd@lip6.fr) if you
	are using the library in your project.
</p>


<h2><a name="sec:svn"></a>II. Obtaining the latest version using svn</h2>
<h3><a name="sec:prereq"></a>1. SVN, Prerequisites</h3>

<p>
	The latest version of libDDD can be obtained from the (anonymous) svn at <em>https://projets-systeme.lip6.fr/svn/research/libddd/</em>.
	All the sources for libddd are placed in the libddd folder of the depot.
	or just browse the sources on <a
		href="https://projets-systeme.lip6.fr/trac/research/libddd/browser">TracSVN</a>. (just ignore certificate warnings if you get any).
</p>
<p>Note that to build from the svn, you need autotools and to invoke
	"autoreconf -vfi" to create the "configure" script. 
	Due to various dependencies, building from svn requires some configuration settings.
	Remember, configure --help is your friend, and you can also have a look at the configuration settings of our [continuous integration server](https://teamcity.rsr.lip6.fr/)
	for inspiration on how to invoke configure.</p>
<p>This is the recommended approach for developers to download the
	ITS related tools.</p>
<p>Full installation follows these guidelines:</p>
<h3><a name="sec:prereq"></a>1. Prerequisites</h3>
<ul>
	<li>Autotools in relatively recent versions (autoconf &gt;= 2.19,
		automake &gt;= 2.61), packaged on most distributions.</li>
	<li>C++ build tools (GNU toolchain recommended g++, sh, make and
		dependencies)</li>
	<li>An svn client, command line or graphical (try kdesvn for linux,
		TortoiseSVN for windows, Subclipse for eclipse for example).</li>
</ul>

<h3><a name="sec:d3svn"></a>2. Install of libDDD</h3>

<p>
	In the following, I will use /data/thierry/SDD/ as a root of my
	install. Feel free to replace this with whatever is appropriate for
	you. <br /> [Download as a shell script](files/libddd.sh)
</p>
<?php highlight_file("files/libddd.sh"); ?>

<p>The code base for libDDD is based on the DDD library by Jean-Michel
	Couvreur and Denis Poitrenaud. The code for SDD manipulation is due to
	Yann Thierry-Mieg and Alexandre Hamez. Maximilien Colange has also actively
	contributed to the core homomomorphism evaluation mechanism.</p>


<h2><a name="sec:ack"></a>III. Authors, History</h2>
	
<h3><a name="sec:author"></a> 1. Authors </h3>
<h4>Main Authors of LibDDD</h4>
Yann Thierry-Mieg (LIP6, Yann.Thierry-Mieg@lip6.fr, 2003-), Jean-Michel Couvreur (LaBRi, 2001), and Denis Poitrenaud (LIP6, 2001)
<h4> Contributors</h4>
<ul>
<li>Maximilien Colange < LIP6, Maximilien.Colange@lip6.fr > (2010-present): split-equiv, ordering heuristics, symmetries, google hash support, maintenance and performance upgrades</li>
<li>Alexandre Hamez < LIP6 and LRDE (EPITA), Alexandre.Hamez@lip6.fr > (2006-2009): maintenance, multi-threading, rewrite rules</li>
<li>Vincent Beaudenon < LIP6 > (2004-2005) : serialisation, user (not strong) homomorphisms</li>
<li>François Bréant < LIP6 > (2004) : INST_STL, multi-target build</li>
<li>Samuel Charron < LRDE (EPITA) > (2005-2006) : tests</li>
</ul>
<h4> Code base </h4>
<ul>
<li> We borrowed [google's sparse hash table](http://googlecode.com/sparsehash) implementation in C++, which gives low memory footprints with limited time overhead. 
This (almost) drop-in replacement for standard STL hash tables gives up to 40% memory gain on some experiments.  </li>
<li> We borrowed several utility functions (process monitoring, hash functions...) from Spot's code base, due to Alexandre duret-Lutz, Denis Poitrenaud et al. </li>
</ul>


<h3><a name="sec:histo"></a> 2. Version History </h3>

<h4>version 1.8 : January 2012. Release includes the new equiv-split mechanism and several significant performance improvements.</h4>
<ul>
	<li> New hash table implementation based on google's hash tables. Yields significantly (10 to 40%) lower memory foortprint.
	</li><li> Reimplementation of low-level encoding and storage of DDD. Lowers memory footprint significantly (up to 30%) on 64bit architectures. 
	</li><li> Split-equiv functionality to evaluate complex expressions
	</li>
	<li> Added some additional rewriting rules for DDD homomorphisms
	</li>
</ul>

<h4>version 1.7 : February 2011. Release includes some "standard" homomorphisms to reason with integers, and a new way of defining operations as 2k level DD.</h4>
<ul>
	<li> New homomorphisms Select and Set pushed into libDDD (were duplicated in quite a few tools)
	</li><li> New Apply2k operation to specify a transition relation as a decision diagram. Use case related to use of ETF files.
	</li><li> Improved stats and dot export functionality
	</li><li> Improved memory footprint by up to 30% on some examples (privilege use of std::vector over use of std::set wherever possible) </li>
</ul>
<h4>version 1.6 : May 2010. Release includes a few new rewriting rules and upgrades compatibility with newer compilers.</h4>
<ul>
	<li> More rules related to selector homomorphisms added
	</li><li> Added an "invert" member function to homomorphisms allowing to compute the pre-image given a potential state space.
	</li><li> Use evil macros and suchlike to support tr1 standard where available </li>
</ul>
<h4>version 1.5 : June 2009. Release includes enhanced auto-saturation, selector homomorphisms, and commutative rewriting rules.</h4>
<ul>
	<li> homomorphisms Range added as a simple commutativity criterion
	</li><li> More rewriting rules implemented to enhance dynamic saturation effect
	</li><li> Selector predicate introduced, allows use of not, ITE, ... To ease manipulation of atomic properties
	</li><li> morpion (TicTacToe) tutorial example added to repository
	</li><li> MT-SAFE version can be built for multi-threaded applications (although efficiency is badly impacted) </li>
</ul>
<h4>version 1.4 : January 2008. Release includes auto-saturation mechanisms and homomorphism rewrite rules.</h4>
<ul>
	<li> homomorphisms Skip predicate added
	</li><li> rewriting rules implmented to produce dynamic saturation effect
	</li><li> local apply mechanisms and related rules
	</li><li> hanoi example added to repository
	</li><li> INST_STL removed from build (was broken with gcc > 3.3 anyway)</li>
</ul>
<h4>version 1.3 : May 2007. Release includes support for additive Edge valued DDD and SDD</h4>
<ul>
	<li> various cleanups and rewrites for compliance with gcc >= 4.1
	</li><li> minor updates to allow build on 64 bit architectures
	</li><li> added tests using uttk
	</li><li> include a dot export example</li>
</ul>	
<h4>Version 1.2 : January 2006. Release includes the fixpoint construction for homomorphisms.</h4>
<ul>
	</li><li> include serialization and user homomorphisms
	</li><li> Cleaned up includes
	</li><li> Added doxygen documentation
	</li><li> Changed hash functions
	</li><li> Some efficiency speedup</li>
</ul>
<h4>Version 1.1 : November 2004. First semi-public release of the libDDD. Release includes SDD.</h4>
<ul>
	<li> Uses autotools for build procedure, tested on Mac, linux, cygwin.
	</li><li> Compiles in three variants : 
	<ul>
<li> libddd.a, the optimized version, 
</li><li> libddd_d.a version with debugging symbols activated, 
</li><li> libddd_otfg.a a version with experimental on the fly garbage collection</li>
		</ul>
	</li><li> Optionally, using gcc in versions 3.1, 3.2 or 3.3, it is possible to activate build of INST_STL version, modify src/Makefile.am for this.</li>
</ul>

<h4>Pre 1.0 : 2001-2003. Beta versions of the pure DDD library. Version 0.99 was version number for some time. </h4>
        <p>&nbsp;</p>

	
	
<h3><a name="sec:old"></a>3. Older releases of libDDD</h3>
<p>
	You can download release (v. 1.8.0) from here: <a
		href="./download/ddd-1.8.0.tar.gz">ddd-1.8.tar.gz</a>. This version does not
		correctly package third party headers from Google, you should probably use 1.8.1 instead.
</p>
<p>
	You can download release (v. 1.7) from here: <a
		href="./download/ddd-1.7.0.tar.gz">ddd-1.7.tar.gz</a>
</p>
<p>
	You can download release (v. 1.6) from here: <a
		href="./download/ddd-1.6.0.tar.gz">ddd-1.6.tar.gz</a>
</p>
<p>
	You can download another stable release (v. 1.5) from here: <a
		href="http://www.lip6.fr/ddd-download/ddd-1.5.tar.gz">ddd-1.5.tar.tgz</a>
</p>
<p>
	You can download older release (v. 1.4) from here: <a
		href="http://www.lip6.fr/ddd-download/ddd-1.4.tar.gz">ddd-1.4.tar.gz</a>
</p>



<div class="toplink" align="right">[Start of page <img alt="" src="images/up.gif" width="13" height="12" border="0">](#toc)</div>

<!-- #EndEditable -->
<?php include 'footer.md'; ?>
</html>
