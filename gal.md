---
title: Guarded Action Language
keywords: gal
tags: [gal]
sidebar: home_sidebar
permalink: gal.html
summary: Syntax of GAL.
---


# GAL : Guarded Action Language

You will find here documentation for the Guarded Action Language, including its syntax.

GAL is a language providing a C-like syntax to describe concurrent systems. 

We provide a feature-rich editor and full CTL and LTL model-checking of GAL using the ITS-tools.


## Install

Please follow [these guidelines](eclipsestart.md) to install ITS modeler.

Once ITS Modeler is installed, create a new GAL model like this:
File → New → File → Coloane → Gal file...

Or simply "New → File" and give it a .gal extension, in any existing project.

These [GAL examples](files/gal.zip) translated from the BEEM distribution can help get started as well.

## GAL overview

This page presents the concrete syntax of GAL, please read [this document](./files/gal.pdf) for a more formal overview of GAL semantics and some of their applications, or my [habilitation thesis](https://pages.lip6.fr/Yann.Thierry-Mieg/hdr-ytm.pdf) for a formal but less technical overview.

### What is GAL ?

GAL is an acronym for **Guarded Action Language,** a modeling language dedicated to the description of data manipulation for formal verification of concurrent systems. 
Although GAL can be used to directly model systems, it is a quite low-level modeling language, there are no explicit notions of process, struct, channels... 
However the semantics of these features can be expressed using GAL (although channels will need to have a maximum size), since the language is quite expressive in spite of its simplicity. 

GAL are meant to be a back-end language for more comfortable notations (Divine, Promela, Petri nets...) adapted to a given domain, or alternatively they can be seen as a
 high-level front-end to symbolically express transition relations for the ITS-tools symbolic engine.


### An example GAL system

Here is an example of a system written in GAL:

<figure class="highlight"><pre><code class="language-c" data-lang="c">
{% include_relative galfiles/sample-1.gal.html %}
</code></pre></figure>

This code shows the main syntactic elements of the GAL language, it does not really model anything useful. 
A GAL system contains variable declarations and (possibly labeled)transitions that have a guard and an action that is a sequence of assignments.

GAL have a simple concurrent semantic adapted to modeling of concurrent systems. 
It is given as a labeled Kripke structure where  
 * A state is defined as a valuation of the variables. 
 * Any transition whose guard is true in the current state can be fired yielding a (set of) successor(s) obtained by executing each assignment of the transition in sequence. 

The effect of each transition is atomic, i.e. reachable states are those obtained after each computing all effects of the transition.
Semantics for interleaving of GAL transitions are similar to semantics of Petri nets. 


### What is the purpose of GAL ?

GAL is a semantic assembly language suited to formal verification, using symbolic methods (such as Data Decision Diagrams).
GAL offer a high level of expressivity (manipulation of integer expressions, integers, etc...) but have simple semantics and an intuitive syntax.
 
GAL are meant to be used as an intermediate language for modeling concurrent systems for verification by model-checking, and can be manipulated symbolically with good efficiency using decision diagrams and more specifically the ITS tools.

The typical use case involves defining a model transformation from your own notation to GAL to obtain a semantic definition of your system. This transformation can be implemented in several ways, but EMF artifacts are provided for GAL so Java/Eclipse users that have a metamodel of their DSL can leverage existing model transformation frameworks such as ATL or Epsilon. Alternatively, since the syntax is not too complex (e.g. not XML based!), a direct model to text translation can produce GAL models relatively easily.

**Next Section : [GAL Basic Concepts](galbasics.md)**

## Acknowledgements

The GAL editor plug-in was initially developed as part of the M1 student project and subsequent internship of KOUADIO Yao Louis Stephane Armel, SELLOU Hakim and ABKA Faycal, made in the MoVe team (Modeling and Verification) of Laboratory of Computer Science at the University Pierre et Marie Curie (LIP6), in the year 2012, under the supervision of Yann Thierry-Mieg. The aim of the internship was to implement an Eclipse plugin that allows editing of GAL files. This plugin harnesses all the power of Eclipse, including auto-completion, or quick-fix.

To achieve the goals, we used Eclipse and Xtext ([http://www.eclipse.org/Xtext/](http://www.eclipse.org/Xtext/)), an Eclipse plug-in that allows you to define grammars for languages dedicated to a specific domain (**D**omain **S**pecific **L**anguage) in all its aspects, and this in a comprehensive manner.

The GAL plug-in was developed using collaborative development tools, such as SVN for version control (public depot available with login/pass "anonymous/anonymous" at [svn co https://projets-systeme.lip6.fr/svn/research/thierry/PSTL/GAL](https://projets-systeme.lip6.fr/svn/research/thierry/PSTL/GAL)), as well as a server for continuous integration ([TeamCity](http://teamcity-systeme.lip6.fr/)).

Essentially all developments since 2012 (meta-model updates, enhancements, rewritings...) are the work of Yann Thierry-Mieg.

