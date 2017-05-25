<html>
 <?php include 'header.md'; ?>

<h2> Main Authors of LibDDD : Yann Thierry-Mieg (LIP6, Yann.Thierry-Mieg@lip6.fr, 2003-), Jean-Michel Couvreur (LaBRi, 2001), and Denis Poitrenaud (LIP6, 2001)</h2>
<h3> Contributors :</h3>
<ul>
<li>Maximilien Colange < LIP6, Maximilien.Colange@lip6.fr > (2010-present): split-equiv, ordering heuristics, symmetries, google hash support, maintenance and performance upgrades</li>
<li>Alexandre Hamez < LIP6 and LRDE (EPITA), Alexandre.Hamez@lip6.fr > (2006-2009): maintenance, multi-threading, rewrite rules</li>
<li>Vincent Beaudenon < LIP6 > (2004-2005) : serialisation, user (not strong) homomorphisms</li>
<li>François Bréant < LIP6 > (2004) : INST_STL, multi-target build</li>
<li>Samuel Charron < LRDE (EPITA) > (2005-2006) : tests</li>
</ul>
<h3> Code base : </h3>
<ul>
<li> We borrowed google's sparse hash table implementation in C++, which gives low memory footprints with limited time overhead. 
This (almost) drop-in replacement for standard STL hash tables gives up to 40% memory gain on some experiments. See : </li>
<li> We borrowed several utility functions (process monitoring, hash functions...) from Spot's code base, due to Alexandre duret-Lutz, Denis Poitrenaud et al. </li>
</ul>

<h2> Main Author of LibITS and ITS-CTL: Yann Thierry-Mieg (LIP6, Yann.Thierry-Mieg@lip6.fr, 2003-).<br/>
Main Authors of ITS-LTL: Yann Thierry-Mieg, Denis Poitrenaud, Alexandre Duret-Lutz (EPITA) and Kais Klai (LIPN).
</h2>
<h3> Contributors :</h3>
<ul>
<li>Maximilien Colange < LIP6, Maximilien.Colange@lip6.fr > (2010-present): GAL, Split-Equiv, Expressions, symmetries, maintenance and improvements</li>
<li>Silien Hong < LIP6 > (2008-2011): CTL, parsers for JSON format.</li>
<li>Didier Lime <Didier.Lime@irccyn.ec-nantes.fr> (2011): Romeo parser</li>
</ul>
<h3> Code base : </h3>
<p>The code base for libITS borrows from many open-source projects of other universities. In particular it builds on code from :</p>
<ul>
<li>VIS from Boulder University, Colorado. The CTL model-checker its-ctl reuses many packages of VIS (parsers and CTL forward model-checking).See VIS: A system for
	Verification and Synthesis, <a href="http://vlsi.colorado.edu/~vis/">VIS
		homepage</a>. The ctlp package is due to Gary York, Ramin Hojati, Tom
	Shiple, Adnan Aziz, Yuji Kukimoto, Jae-Young Jang, In-Ho Moon. The mc
	package is due to Adnan Aziz, Tom Shiple, In-Ho Moon.</li>
<li>LTSmin, Univerity of Twente, Netherlands. Support of ETF files relies on parsers taken from their code base. The Divine to GAL translation was originally based on a patch to Divine by LTSmin's team. by Stefan
	Blom, Alfons Laarman, Elwin Pater, Jaco van de Pol, Michael Weber et
	al. of the Formal Methods and Tools group of the University of Twente
	(NL). Additional prototype code was provided by Jeroen Ketema of the same team.</li>
<li>Divine, University of Brno, Poland. Rather than provide a patch for Divine, parsers and internal representations for Divine models were directly extracted from their code base. See </li> 
</ul>

<h2>version 1.8 : January 2012. Release includes the new equiv-split mechanism and several significant performance improvements.</h2>
<ul>
	<li> New hash table implementation based on google's hash tables. Yields significantly (10 to 40%) lower memory foortprint.
	</li><li> Reimplementation of low-level encoding and storage of DDD. Lowers memory footprint significantly (up to 30%) on 64bit architectures. 
	</li><li> Split-equiv functionality to evaluate complex expressions
	</li>
	<li> Added some additional rewriting rules for DDD homomorphisms
	</li>
</ul>

<h2>version 1.7 : February 2011. Release includes some "standard" homomorphisms to reason with integers, and a new way of defining operations as 2k level DD.</h2>
<ul>
	<li> New homomorphisms Select and Set pushed into libDDD (were duplicated in quite a few tools)
	</li><li> New Apply2k operation to specify a transition relation as a decision diagram. Use case related to use of ETF files.
	</li><li> Improved stats and dot export functionality
	</li><li> Improved memory footprint by up to 30% on some examples (privilege use of std::vector over use of std::set wherever possible) </li>
</ul>
<h2>version 1.6 : May 2010. Release includes a few new rewriting rules and upgrades compatibility with newer compilers.</h2>
<ul>
	<li> More rules related to selector homomorphisms added
	</li><li> Added an "invert" member function to homomorphisms allowing to compute the pre-image given a potential state space.
	</li><li> Use evil macros and suchlike to support tr1 standard where available </li>
</ul>
<h2>version 1.5 : June 2009. Release includes enhanced auto-saturation, selector homomorphisms, and commutative rewriting rules.</h2>
<ul>
	<li> homomorphisms Range added as a simple commutativity criterion
	</li><li> More rewriting rules implemented to enhance dynamic saturation effect
	</li><li> Selector predicate introduced, allows use of not, ITE, ... To ease manipulation of atomic properties
	</li><li> morpion (TicTacToe) tutorial example added to repository
	</li><li> MT-SAFE version can be built for multi-threaded applications (although efficiency is badly impacted) </li>
</ul>
<h2>version 1.4 : January 2008. Release includes auto-saturation mechanisms and homomorphism rewrite rules.</h2>
<ul>
	<li> homomorphisms Skip predicate added
	</li><li> rewriting rules implmented to produce dynamic saturation effect
	</li><li> local apply mechanisms and related rules
	</li><li> hanoi example added to repository
	</li><li> INST_STL removed from build (was broken with gcc > 3.3 anyway)</li>
</ul>
<h2>version 1.3 : May 2007. Release includes support for additive Edge valued DDD and SDD</h2>
<ul>
	<li> various cleanups and rewrites for compliance with gcc >= 4.1
	</li><li> minor updates to allow build on 64 bit architectures
	</li><li> added tests using uttk
	</li><li> include a dot export example</li>
</ul>	
<h2>Version 1.2 : January 2006. Release includes the fixpoint construction for homomorphisms.</h2>
<ul>
	</li><li> include serialization and user homomorphisms
	</li><li> Cleaned up includes
	</li><li> Added doxygen documentation
	</li><li> Changed hash functions
	</li><li> Some efficiency speedup</li>
</ul>
<h2>Version 1.1 : November 2004. First semi-public release of the libDDD. Release includes SDD.</h2>
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

<h2>Pre 1.0 : 2001-2003. Beta versions of the pure DDD library. Version 0.99 was version number for some time. </h2>
        <p>&nbsp;</p>
        <!-- #EndEditable -->
 <?php include 'footer.md'; ?>
</html>
        