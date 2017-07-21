---
title: its-reach
keywords: gal composite
tags: [gal]
sidebar: home_sidebar
permalink: reach.html
summary: A model-checker for Safety properties built using libITS.
---

# its-reach 

## What is its-reach

its-reach is our model-checker for safety properties, built upon [libITS](libits.md).
It can compute answer queries based on the set of reachable states, but not 
really any query involving the state _graph_, since there is no support for 
temporal logic.

## Obtaining its-reach

You can download the current release as well as binaries from here: [LibITS download page](https://lip6.github.io/libITS/)

To build from source, follow the [instructions for libits](libits.html#obtaining-the-latest-development-version), since _its-reach_ is packaged with it.
 
## Options specific to its-reach

its-reach is a small tool that mostly showcases the [options available to configure libits](libits.md#common-options-of-its-tools). It allows

*   To compute statistics on the number of reachable states of a system using full or bounded depth exploration
*   To test a system for presence of deadlocks
*   To test reachability of a given predicate on state variables

Call "its-reach --help" to get a full description of the options available.

### Options controlling the reachable set computation

The default behavior of its-reach is to build the full state space (which is hopefully finite), using saturation. This behavior can be changed to force a bounded BFS exploration (i.e. bounded model-checking or bmc) of the state space over a given number of steps.

*   -bmc XXX : use limited depth BFS exploration, up to XXX (an integer) steps from initial state.

With option -reachable, the user can ask whether a state satisfying a given boolean predicate over variables is reachable. 
A predicate is a boolean composition using AND `&&`, OR `||`, NOT `!` and parenthesis `()` of comparisons of variables to constants. 
The predicate is tested on the states reached at the final iteration if -bmc was enabled, otherwise on the full reachable state space. 
Whitespace are semantic as they are included in variable names if present, so avoid any superfluous whitespace in the predicate expression. 

A shortest trace from initial state to a target state will be supplied if the state is reachable.

*   -reachable XXXX : test if there are reachable states that verify the provided boolean expression over variables
*   -reachable-file FILE : read in a set of reachability and or bounds properties 

## Examples

See [this page](https://github.com/lip6/libITS/blob/master/tests/tests.def) for invocation examples.

You can also use the [eclipse front-end](running.md) to produce valid command line invocations of its-reach.

## its-reach --help

 Instantiable Transition Systems SDD/DDD Analyzer; package ITSREACH 0.2

 This tool performs state-space analysis of Instantiable Transition Systems a.k.a. ITS 

 The reachability set is computed using SDD/DDD of libDDD, the Hierarchical Set Decision Diagram library, 
 
MANDATORY Options :
*    -i path : specifies the path to input model file
*    -t {CAMI,PROD,ROMEO,ITSXML,ETF,DLL,NDLL,DVE,GAL,CGAL} : specifies format of the input model file : 
	* CAMI : CAMI format (for P/T nets) is the native Petri net format of CPN-AMI
	* PROD : PROD format (for P/T nets) is the native format of PROD
	* ROMEO : an XML format (for Time Petri nets) that is the native format of Romeo
	* UROMEO : Romeo format with additional constraints: all places named, with different names.
	* ITSXML : a native XML format (for ANY kind of ITS) for this tool. These files allow to point to other files.
	* ETF : Extended Table Format is the native format used by LTSmin, built from many front-ends.
	* DLL : use a dynamic library that provides a function "void loadModel (Model &,int)" typically written using the manipulation APIs. See demo/ folder.
	* NDLL : same as DLL, but expect input formatted as size:lib.so. See demo/ folder.
	* DVE : Divine is a modelling language similar to Promela.
	* GAL : Guarded Action Language.
	* CGAL : Guarded Action Language + Composite/ITS textual syntax. File must contain a main declaration.

Additional Options and Settings:
*     --trace-states : if set, this option will force to print intermediate states (up to print limit) when showing traces. 
*     --print-limit INT : set the threshold for full printout of states in traces. DD holding more states than threshold will not be printed. [DEFAULT:10 states]
*     --load-order path : load the variable order from the file designated by path. This order file can be produced with --dump-order. Note this option is not exclusive of --json-order; the model is loaded as usual, then the provided order is applied a posteriori. 

Petri net specific options :
*     --json-order path : use a JSON encoded hierarchy description file for a Petri net model (CAMI, PROD or ROMEO), such as produced using Neoppod heuristic ordering tools. Note that this option modifies the way the model is loaded. 
 
*     --sdd : privilege SDD storage (Petri net models only).(DEFAULT)
*     --ddd : privilege DDD (no hierarchy) encoding (Petri net models only).

Scalar and Circular symmetric composite types options:
*    -ssD2 INT : (depth 2 levels) use 2 level depth for scalar sets. Integer provided defines level 2 block size. [DEFAULT: -ssD2 1]
*    -ssDR INT : (depth recursive) use recursive encoding for scalar sets. Integer provided defines number of blocks at highest levels.
*    -ssDS INT : (depth shallow recursive) use alternative recursive encoding for scalar sets. Integer provided defines number of blocks at lowest level.


GAL-based specific options (DVE and GAL):
* --gen-order STRAT :  Invoke ordering heuristic to compute a static ordering. STRAT should be one of the following `[default DEFAULT]`:
	* DEFAULT         : historical strategy, does not follow labels of 'call' statements
	* FOLLOW          : follows the labels of 'call' statements
	* FOLLOW_HALF     : follows the labels of 'call' statements, but with halved weight
	* FOLLOW_DOUBLE   : follows the labels of 'call' statements, but with doubled weight
	* FOLLOW_SQUARE   : same as FOLLOW, but uses energy-based costs
	* FOLLOW_DYN      : follows the labels of 'call' statements, with a cost related to constraint' size
	* FOLLOW_DYN_SQ   : same as FOLLOW_DYN, but uses energy-based costs
	* FOLLOW_FDYN     : same as FOLLOW_DYN, but the cost is related to the size for all constraints (even with no 'call')
	* FOLLOW_FDYN_SQ  : same as FOLLOW_FDYN, but uses energy-based costs
	* LEXICO          : use the old strategy, based on lexicographical ordering of the variable
 
SDD specific options : 
* --no-garbage : disable garbage collection (may be faster, more memory)
* --gc-threshold INT : set the threshold for first starting to do gc [DEFAULT:13000 kB=1.3GB]
* --fixpoint {BFS,DFS} : this options controls which kind of saturation algorithm is applied. Both are variants of saturation not really full DFS or BFS. [default: BFS]

its-reach specific options for ITSREACH 0.2
*     --dump-order path : dump the currently used variable order to file designated by path and exit. 
*     -d path : specifies the path prefix to construct dot state-space graph
*     -bmc XXX : use limited depth BFS exploration, up to XXX steps from initial state.
*     -trace XXX : try to replay a trace, XXX is given as a space separated list of transition names, as used in path outputs.
*     --quiet : limit output verbosity useful in conjunction with tex output --texline for batch performance runs
*     --stats : produce stats on max sum of variables (i.e. maximum tokens in a marking for a Petri net), maximum variable value (bound for a Petri net)
*     --edgeCount : produce stats on the size of the transition relation, i.e. the number of unique source to target state pairs it contains.
*     -maxbound XXXX,YYYY : return the maximum value for each variable in the list (comma separated)
*     -reachable XXXX : test if there are reachable states that verify the provided boolean expression over variables
*     -reachable-file XXXX.prop : evaluate reachability properties specified by XXX.prop.
*     --nowitness : disable trace computation and just return a yes/no answer (faster).
*     -manywitness XXX : compute several traces (up to integer XXX) and print them.
*     --fixpass XXX : test for reachable states after XXX passes of fixpoint (default: 5000), use 0 to build full state space before testing
*     --help,-h : display this (very helpful) helping help text

Problems ? Comments ? contact Yann.Thierry-mieg@lip6.fr
