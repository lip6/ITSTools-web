---
title: Homepage of ITS-tools
---

Welcome to [ITS-tools](itstools.md) Homepage
============================================

WARNING : these pages are work in progress, we are still migrating from [our older homepage](http://ddd.lip6.fr)

ITS-tools is an easy to use and powerful [award-winning](http://mcc.lip6.fr/) [model-checker](https://en.wikipedia.org/wiki/Model_checking) supporting Safety, 
[CTL](https://en.wikipedia.org/wiki/Computation_tree_logic) and [LTL](https://en.wikipedia.org/wiki/Linear_temporal_logic) 
properties for a variety of formalisms. It formally proves system correctness using exhaustive state space exploration.

Insert Pic : screenshot : model + eclipse + trace

It's architecture relies on an abstract contract for formalisms called Instantiable Transition Systems ITS that enables their semantic composition. An ITS is basically a [labeled Kripke Structure](https://en.wikipedia.org/wiki/Kripke_structure) but they can be _instantiated_ and composed (think [Composite DP](https://en.wikipedia.org/wiki/Composite_pattern)).

Insert pic: GAL, PTNET, ETF, Composite are ITS.

Our main concrete formalism is the [Guarded Action Language](gal.md) (GAL), featuring a simple yet user friendly C-like syntax.
It is very expressive and has simple interleaving semantics suitable for modeling concurrent systems of practically any kind.

Insert pic: M2M leading to GAL

Thanks to this central pivot and [model to model transformations](https://en.wikipedia.org/wiki/Model_transformation) that leverage [EMF](https://www.eclipse.org/modeling/emf/), we can support many commonly used [formalisms](formalisms.md) in other tools such as [Spin](http://spinroot.com) or [Uppaal](http://www.uppaal.org/). 

Our eclipse front-end offers rich textual editor (or graphical for Petri nets) for these formalisms.

If you'd prefer to use a command line tool, that is also possible using our
[pre-packaged ITS-tools for Windows, Linux or MacOS](https://yanntm.github.io/ITS-commandline/index.html).   

ITS-tools includes its own symbolic model-checker powered by [Hierarchical Set Decision Diagrams](libddd.md), but can also use an SMT solver such as [Yices](http://yices.csl.sri.com/) or [Z3](https://github.com/Z3Prover/z3) to perform 
[BMC](https://www.google.com/search?q=An+Analysis+of+SAT-based+Model+Checking+Techniques+in+an+industrial)/
[K-Induction](https://www.google.com/search?q=Checking+safety+properties+using+induction+and+a+SAT-solver), and export models with fine grain [partial order](https://en.wikipedia.org/wiki/Partial_order_reduction) analysis for use in the excellent multi-core  model-checker [LTSmin](http://fmt.cs.utwente.nl/tools/ltsmin/) that offers its own solution engines.

These varied solution engines, GAL simple syntax, and EMF support make GAL an attractive target in a process targeting verification of a [DSL](https://en.wikipedia.org/wiki/Domain-specific_language). 

Because we are dedicated to [FOSS](https://www.gnu.org/philosophy/open-source-misses-the-point.en.html) we use only free open-source  licenses, 
depending on files we use [EPL](https://www.eclipse.org/legal/epl-v10.html) and [APL](https://www.apache.org/licenses/LICENSE-2.0) for Java front-end,[GPL](https://www.gnu.org/licenses/gpl-3.0.en.html) for C++ tools using the kernel, [LGPL](https://www.gnu.org/licenses/lgpl-3.0.en.html) for the symbolic kernel libDDD.


Getting started 
---------------

We cover a few different scenarios here, if you're unsure just try the eclipse front-end.

[I want to use the eclipse front-end](eclipsestart.md)

[I want to use the command line only](itscl.md)

[I'm interested in contributing](devstart.md)

Documentation
-------------

GAL presentation and syntax, see also GAL meta-model for more technical details.

Using the composite formalism in GAL files.

Using parameters in GAL.

Property Syntax in GAL 

Running the tools, see also Options and Flags

[Using the (Time) Petri net editor.](tpn.md)

Working with Time Petri nets ([Tina](http://projects.laas.fr/tina/), [Romeo](http://romeo.rts-software.org/))

Working with Timed Automata.

Working with DVE models.

Working with Promela(Spin) models.

Working with LTSmin.

LibDDD our C++ library for Hierarchical Set Decision Diagrams.

LibITS our C++ library for symbolic model-checking of ITS and related tools.

Choosing an LTL algorithm

Scientific papers on the tool and its algorithms.

Citing
------

Please cite our [_Symbolic Model-Checking Using ITS-Tools_](https://link.springer.com/chapter/10.1007/978-3-662-46681-0_20) TACAS'15 paper if you are using the tool currently in your research, or a [more specific paper](bib.md) if you are referring to a specific technique we use. 

Reporting Issues
----------------

Please use the [Github integrated issues page](https://github.com/lip6/ITSTools/issues) to report issues you might encounter or [mail me](yann.thierry-mieg@lip6.fr) if you don't have a GitHub account.

Acknowledgments
---------------

Yann Thierry-Mieg is the main author of these tools, but many contributors have brought important contributions.
Maximilien Colange and Alexandre Hamez contributed to the symbolic kernel, as well as Jean-Michel Couvreur and Denis Poitrenaud who wrote the original libDDD. 
Much code was borrowed and adapted (hacked !) from open-source model-checking projects with friendly licenses, such as
 [LTSmin](http://fmt.cs.utwente.nl/tools/ltsmin/) and [VIS](http://vlsi.colorado.edu/~vis/), to which we are grateful.

We owe a lot also to the Eclipse project and its dedication to open source, we use a large number of FOSS plugins in our code base, notably EMF and XText.  

Much of the Eclipse front-end was prototyped during internships of students at Paris 6 University.

See acknowledgement sections at bottom of the various pages of this site for more detailed acknowledgements, as well as source history publicly visible on GitHub. 



       <h2><a name="sec:what"></a>What is libDDD ?</h2>
        <p><span style="font-weight: bold">libDDD</span> is a C++ library for manipulation of decision diagrams.</p>
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
      
        <h2>What are ITS tools</h2>
        <p><span style="font-weight: bold">libITS</span> is a C++ library for model-checking of various formalisms using libDDD. 
        It defines instantiable transition systems (ITS), a simple labeled transition system semantics, in a symbolic way. The <span style="font-weight: bold">its-tools</span> are built on top
        of libITS and support model-checking of ITS models.</p>
        <p>Main features include:</p>
        <ul>
          <li>Instantiable Transition System as a framework, allow hierarchical composition of components specified in diverse formalisms.
          </li>
          <li>Optimized implementation taking full advantage of the features of libDDD, notably automatic saturation and hierarchy.</li>
          <li>Support for Petri nets and some of their extensions</li>
          <li>Support for discrete time in models such as Time Petri nets and their compositions</li>
          <li>Support for GAL format input which offers rich data manipulation. </li>
          <li>Support for ETF format input which is produced by the tool LTSmin from diverse formalisms. </li>
          <li>Support for Divine format input which is native to the tool Divine and used in BEEM models. </li>
          <li>Support for CTL model checking using forward transition relation.</li>
          <li>Support for LTL model checking using some classic and some original algorithms that exploit saturation.</li>
        </ul>
        <p>The ITS tools are distributed under the terms of [GPL](http://www.gnu.org/licenses/gpl.html).</p>

        <h2>What is ITS modeler</h2>
        <p><span style="font-weight: bold">ITS modeler</span> is a set of Eclipse plugins, offering access to ITS-tools in a convenient manner for end-users.</p>
        <p>Main features include:</p>
        <ul>
          <li>Guarded Action Language support : rich editor, code completions,...</li>
          <li>One click install from update site</li>
          <li>Embedded ITS-tools binary distribution, for most platforms. Reachability and CTL can be invoked from Eclipse.</li> 
          <li>Graphical modeling support for Petri net variants, using components of [Coloane](http://coloane.lip6.fr).</li>
          <li>Import/Export to Romeo and Tina formats for Time Petri Nets (discrete time assumptions)</li>
          <li>Uppaal XTA format editor and translation to GAL, supporting analysis of Timed automata (discrete time).</li>
          <li>Divine DVE format editor and translation to GAL, supporting analysis of DVE models. </li>
          <li>Spin Promela format editor and translation to GAL, supporting analysis of Promela models. </li>
          <li>Analysis and rewriting of GAL specifications : static simplifications, variable domain analysis, control flow analyis, parameter analysis...</li>
        </ul>
        <p>The ITS modeling front-end tools are distributed under the terms of [EPL](http://www.eclipse.org/org/documents/epl-v10.md).</p>
        <p>&nbsp;</p>
        
        
 <?php include 'footer.md'; ?>
</html>