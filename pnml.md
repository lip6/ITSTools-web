---
title: (Colored) PNML
keywords: petri
tags: []
sidebar: home_sidebar
permalink: pnml.html
summary: How to work with Petri nets in PNML format.
---

# Using ITS to analyze PNML specifications.

ITS-tools is happy to offer support for Petri nets expressed in PNML : we support both P/T nets (iso-15909-1) and high level Petri nets (iso-15909-2). 
This ISO standard defines a standard exchange format for Petri nets. We provide transformation(s) to GAL for analysis.

## Install

Please follow [these guidelines](eclipsestart.md) to install ITS modeler.

You should now be able to right-click .pnml files and select "PNML to GAL->Import to GAL".
Make sure you refresh (F5) the containing folder so that the new file appears in eclipse.

## PNML to GAL conversion

### Description of the transformation

The conversion of P/T nets to GAL is quite direct.

1.  Each place produces a GAL variable.
2.  Each transition produces a GAL transition.
    1.  The guard of the transition is a conjunction of the transition firing conditions, as captured by the arcs connecting to the transition.
    2.  Similarly, the GAL transition body updates place markings according to the arc definitions.

The conversion of HLPN follows the same structure, but due to annotations is a bit more involved.

1.  All elementary domains D (also called colors) defined in an HLPN specification are finite (they can be enumerated or defined through ranges etc...). We map each domain declaration to a GAL typedef declaration, containing `|D|` elements (0 to `|D|`-1).
2.  Each place produces an array, of size consistent with number of different tokens it can contain (i.e. the size of the cross-product of the domain).  
    For instance, if color A is `[1,2]` and color B is `[3,4]`, a place with domain the cross product AxB will produce an array of size 4 (the cells giving the number of occurrences of (1,3), (1,4), (2,3), (2,4) respectively).
3.  The various expressions corresponding to token references (arc annotations, initial marking definition) are appropriately translated to references in the appropriate array cell. 
For successor/predecessor operations on circular type D, we use __succ($p,x) = ($p+x)% &#124;D&#124;__ and __pred($p,x) = ($p + &#124;D&#124; -x )% &#124;D&#124;__.
4.  Each transition produces a GAL transition. The transition is analyzed to find all the formal parameters it has on both guard and connected arcs. 
HLPN parameters are defined over given elementary color domain, so corresponding GAL parameters referring to the appropriate _typedef_ are introduced.
    1.  The guard is a conjunction of the HLPN guard expression with constraints deriving from arcs that touch the transition. These constraints can use formal parameters as necessary.
    2.  The body of the transition reflects the effects of the arcs touching the transition, and can use formal parameters as needed.


### Invoking the tool

Analysis is performed by first translating the model to [GAL](gal.md).

1.  Right click the pnml file in Eclipse, then select action "PNML to GAL -> Import to GAL". You can also select a set of files or a folder it will recursively find .pnml files.
2.  You will obtain two GAL image files for each input pnml file. One of them contains the translation result, with extension .gal, the other is the simplified model .flat.gal you should actually use for verification.

The parametric model is not significantly larger than the input PNML, and is commented so one can trace the transformation. 
The flat model in a way is equivalent to a P/T net obtained by unfolding color (i.e. degeneralizing the HLPN net to a P/T net, not to be confused with McMillan style prefix unfoldings). 

However, the flat model includes many rewritings some of which are subtle or not immediately obvious. 
In many cases (over the [models of Petri nets model-checking contest](http://mcc.lip6.fr)) the flat gal has reasonable size while no P/T net equivalent can be produced due to polynomial
 size explosion of degeneralizing the net. This allows to analyze some HLPN with its-tools that pure P/T tools cannot even parse, since no low-level P/T net representation is available.

1.  If the initial model had colors, the .gal model will contain parameters, which are simplified away (degeneralized) in the flat model. 
We heavily use the [parameter separation mechanism](pgal.md#separate) to avoid explosion in number of transitions. 
The parameter separation algorithm embeds a parameter identification procedure, that fuses parameters __$x__ and __$y__ in presence of a guard __$x==$y__ (this rule is activated on some mcc@ICATPN examples).
2.  Simplifying parameters away through instantiation also includes removing (on-the fly during degeneralization) any transition whose guard is false. 
This happens most often due to HLPN transition guard. This may entirely discard all transitions bearing a given label l ; by propagation calls to l are replaced by abort instructions. 
Any sequence of statements containing an abort is equivalent to a single abort. 
Any transition whose body is abort can be discarded. 
The process is iterated to convergence. The presence of calls in the specification is due to parameter separation.
3.  An analysis (based on read and write sets of GAL statements) allows to reorder commutative statements of a transition body. 
In HLPN case, we are ensured that body effects are indeed commutative, each one corresponds to an arc (they are independent up to choice of parameter values). 
Consecutive updates on the same variable are merged (x=x+1 and x=x-1 give x=x+0 which is simplified to x=x). 
Empty effects ("x=x") are removed. 
As an immediate side-effect, this rule virtually replaces any pair of input/output arcs to a given place by a test arc, since we end up with only a clause in the guard, and no effects in the transition body.
4.  An analysis tries to find constants, i.e. places whose marking is structurally fixed. 
Any GAL variable that is never assigned to in any transition body is a constant obviously. 
In the simple case, we replace the variable by its value everywhere it occurs and discard the variable. 
In the array case we perform this analysis for each cell of the array, but the array itself is only discarded if all its cells are constants, to avoid messing up index expressions. 
Note that the previous rewriting of statement merging makes constant identification an easier job.

Other rewriting optimizations also occur, but the four mentioned above have the strongest (beneficial) effects for HLPN in our experiments.

Mail us ddd@lip6.fr if you have any feature requests or bugs to report on this PNML module.

## Experiments with PNML models

We have run some benchmark experiments to measure how its-tools handles models from the [Model Checking contest at Petri nets conference](http://mcc.lip6.fr) benchmarks. 
ITS-tools won several categories of the contest in past editions, and significantly enough was sole competitor for some of the larger HLPN examples, unavailable as P/T nets.

In 2017, ITS-tools was on the podium for all examinations, though we didn't get gold (for the first time).
In 2018 we will improve our results.

## Acknowledgements

The PNML translation, the rewriting rules and associated plugins were developed by Yann Thierry-Mieg, mostly to participate in mcc@PetriNets :D
