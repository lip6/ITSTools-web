---
title: LTSmin Interaction
keywords: gal
tags: [gal]
sidebar: home_sidebar
permalink: ltsmin.html
summary: Exchanging models with LTSmin.
---

# LTSmin

[LTSmin](http://fmt.cs.utwente.nl/tools/ltsmin/) is multi-solution model-checker for a variety of formalisms developped by the Formal Methods and Tools group of Twente University.
They define an intermediate API called PINS that puts a pivot interface between solution engines and (explicit) transition relations. 

We offer two bridges to LTSmin :
* From GAL to LTSmin : **(NEW)** we can build a shared object that LTSmin can load to model-check GAL using LTSmin. 
This transformation includes the usual GAL simplifications as well as fine grain partial order analysis relying on SMT.
* From LTSmin to its-tools : the command line its-tools accept an ETF as input, which can be produced by LTSmin as a side
 effect of reachability analysis. This enables LTL or CTL model-checking of these specifications.  
 
## GAL to PINS

The PINS interface is directly compatible with the concepts offered in GAL :
* A fixed size set of integer variables
* A set of independent transitions with effect over a subset of variables

The transformation is thus relatively straightforward, and produces a C file that complies 
to the PINS interface.

The semantics of GAL reduce to four basic building blocks :
* Sequence of actions : the steps within a GAL transition body are sequentially composed
* Alternative of actions : corresponding to the non deterministic call semantics
* Assignment : update one variable based on the current state of variables
* Predicate : a filtering, as introduced by if-then-else or guards of transitions

We adapt to the PINS contract by using a linked list of states for calls to each action, since an action can
return a set of states (because of non determinism, or the empty set for unmatched predicates).

Composite models are first expanded so that each variable has a unique index, then the translation proceeds
similarly to GAL modules, since the semantic bricks are ultimately the same. 
There may be a lot of duplicated code in the C file, e.g. due to multiple instances of a type in the GAL specification
that will produce the same transition code on different variable indexes.

To activate partial-order reduction, LTSmin asks that the language module (i.e. the GAL language module) provide a set of dependency matrices.
To compute these matrices, we rely on an SMT solver, and on building a deterministic transition relation.

To make a GAL specification deterministic, each alternative is isolated into its own transition.
This operation may be explosive if the specification features sequences of calls.  

The SMT queries are generally fast, but we have to build several matrices with dimension **V x T** or **T x T**, where **V** is the number
 of variables and **T** is the number of deterministic transitions. 
 So this can add up to a lot of SMT calls, particularly when the transition relation is dense (transition supports overlap a lot).


### How to build a PINS model

### PINS translation

### Activating POR analysis

## ETF to its-tools

### Producing ETF files

### Using ETF files

### TGTA for LTL
