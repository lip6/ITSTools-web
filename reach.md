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

With option -reachable, the user can ask whether a state satisfying a given boolean predicate over variables is reachable. A predicate is a boolean composition using AND &&, OR ||, NOT ! and parenthesis () of comparisons of variables to constants. The predicate is tested on the states reached at the final iteration if -bmc was enabled, otherwise on the full reachable state space. Whitespace are semantic as they are included in variable names if present, so avoid any superfluous whitespace in the predicate expression. A shortest trace from initial state to a target state will be supplied if the state is reachable.

*   -reachable XXXX : test if there are reachable states that verify the provided boolean expression over variables

## Examples

See [this page](https://github.com/lip6/libITS/blob/master/tests/tests.def) for invocation examples.

You can also use the [eclipse front-end](running.md) to produce valid command line invocations of its-reach.