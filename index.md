---
title: Homepage of ITS-tools
---

Welcome to [its-tools](itstools.md) and [libddd](libddd.md)
=============================================================

WARNING : these pages are work in progress, we are still migrating from [our older homepage](http://ddd.lip6.fr)

ITS-tools is an easy to use and powerful model-checker supporting Safety, CTL and LTL for a variety of formalisms.

It's architecture relies on an abstract contract for formalisms called Instantiable Transition Systems ITS that enables their semantic composition.

Our main concrete formalism is the Guarded Action Language, featuring a simple yet user friendly C-like syntax.
It's semantics are very expressive use the interleaving semantics common to concurrent systems.

Thanks to this powerful pivot, we can support many commonly used [formalisms](formalisms.md).

An eclipse front-end offers rich textual editor (or graphical for Petri nets) for these formalisms.

If you'd prefer to use a command line tool, that is also possible using pre-packaged ITS-tools for Windows, Linux or MacOS.   

Getting started 
---------------

We cover a couple of different scenarios here.

[I want to try the graphical tool right now](eclipsestart.md)

[I want to use the command line only](itscl.md)

[I'm interested in contributing](devstart.md)



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