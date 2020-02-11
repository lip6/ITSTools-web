---
title: Composite Type
keywords: gal composite
tags: [gal]
sidebar: home_sidebar
permalink: cgal.html
summary: Syntax of Composite in GAL.
---

# Composite Type Declarations

A GAL specification can contain one or more __composite type__ declarations.

Our architecture relies on an abstract contract for formalisms called Instantiable Transition Systems ITS that enables semantic composition of GAL, and inductively of hierarchically nested components.

An ITS is basically a [labeled Kripke Structure](https://en.wikipedia.org/wiki/Kripke_structure) but they can be _instantiated_ and composed (think [Composite DP](https://en.wikipedia.org/wiki/Composite_pattern)).

![composite DP](images/dpcomp.png)

## Composite overview

This page presents the concrete syntax of composite GAL, please read [this document](https://media.githubusercontent.com/media/lip6/ITSTools-web/master/files/gal.pdf) for a more formal overview of GAL semantics and some of their applications, or my [habilitation thesis](https://pages.lip6.fr/Yann.Thierry-Mieg/hdr-ytm.pdf) for a formal but less technical overview.

### What is a Composite ?

A composite contains __instances__ that are __synchronized__ using labels.
There are no variables in a composite, only instances ; the state of a composite assigns a state to each of the nested instances.

The composite progresses by firing __synchronizations__ that are similar to GAL __transitions__ except they can only
contain __call__ statements (no assignments).

This communication model inspired by CCS/CSP and Arnold-Nivat style synchronization vectors offers pure __event-based__ communication
over a finite set of labels.   

The definition of a system as an assembly of components in a specific configuration allows from the modeling side 
to reuse parts of the models in different use-cases, and helps analyze and detect problems more easily in smaller sub components.

From the model-checking point of view, decomposition is matched in the symbolic engine by hierarchy in the SDD encoding of the state,
and can yield orders of magnitude better performance in favorable cases.
 

### An example Composite

Here is an example of a Composite :

<figure class="highlight"><pre><code class="language-c" data-lang="c">
{% include_relative galfiles/sample-9.gal.html %}
</code></pre></figure>

This small example instantiates two GAL type declarations **Ping** and **Pong** as player one _p1_ and player two _p2_.
_p1_ has the ball initially; the initial state of the _game_ (which is the **main** instance) is thus
__p1:ball=1; p2:ball=0__. 

Only one synchronization is defined, it passes the ball from _p1_ to _p2_, leading to a state where
__p1:ball=0; p2:ball=1__. 

The CTL property stating that __p2__ always ends up with the ball is thus satisfied. 

When using a call **callee."a"** the __callee__ instance that is targeted 
 must progress to one a successor state reached by firing a transition with label __"a"__.

The overall effect of a synchronization is atomic.
If the callee instance cannot fire any transition with the label __"a"__ (i.e. the set of successors by label "a" is the empty set),
 the whole synchronization is aborted.

The semi-column gives us  sequential composition semantics. 
So calling several labels on the same instance can make it progress by more than one transition.
This feature makes the composite type very expressive. 

Semantics for interleaving of synchronizations are similar to semantics of Petri nets or GAL. 

### What is the purpose of Composite ?

The purpose of Composite type are two-fold :

* From the modeling point of view : It gives us the essential features of an [Architectural Description Language](http://sunset.usc.edu/~neno/papers/TSE-ADL.pdf). 
We can model in separately each of the components __i.e. GAL or Composite type__, they interact through well defined connectors __i.e. the finite set of labels__,
and we can assemble the parts in various configurations for proper model reuse __i.e. by changing **main**__.

Use cases include testing of different configurations (typically slowly scaling up the size), reuse of template models (library of model components), easier 
translations from languages featuring instantiation (e.g. UML), better structure preservation during a translation, easy introduction of "mock" components 
to analyze parts of the system more easily, ...

* From the model-checking point of view : It gives us structure in the specification, which is exploited to produce more efficient symbolic state encodings,
it helps distinguish parts of the system and favors abstraction and abstract reasoning for compositional model-checking, it helps identify similar 
behaviors  (e.g. as represented by several instances of a given type).

There are many convincing examples showing that decompositions can be good for verification efficiency, the NUPN format used in the [MCC@ICATPN](http://mcc.lip6.fr)
 is a good example of this.


**Next Section : [Composite Basic Concepts](cgalbasics.md)**

