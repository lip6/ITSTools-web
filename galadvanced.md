---
title: Guarded Action Language Advanced Concepts
keywords: gal
tags: [gal]
sidebar: home_sidebar
permalink: galadvanced.html
summary: GAL Advanced Concepts.
---

# Advanced GAL Features

This page presents some advanced features of GAL, which have been introduced in the language but are not supported 
by all verification toolchains. While they still currently are functional, they might be removed in future iterations
of the tool unless more use cases are found for them.

These features are also less well maintained and tested than the main set of features, please report any difficulties you might encounter
using these features, but you might indeed encounter some.

We have three features in this "advanced category"
1. Hotbit encoding : this is a GAL to GAL rewriting that takes certain tagged variables with domain __0..n-1__ and rewrites them
to __n__ Boolean variables. This might favor locality in a symbolic encoding hence help the symbolic solvers.

The next two features are only available when working with the symbolic solver (its-reach,...) and generally
do not mix well with Composite nor are they heavily tested. 

2. Fixpoint statement : enables to perform a fixpoint computation over a set of states. 
3. Transient predicate : this optional abstraction predicate designates states that are transient, 
they are not reported as reachable states though they may be traversed. 


## Hotbit transformation

When the specification contains hotbit variables or arrays they are rewritten as plain variables.

GAL supports the so-called hotbit encoding of variables with finite domain. It consists of an unfolding of the variable into one Boolean variable per value in the domain of the variable. This encoding is recommended for relatively small, and a priori known, domains, as it may increase locality.

It is a known features of BDD and DD in general: the classical binary encoding of a variable with _log(n)_ 
bits creates strong (and somewhat artificial) dependencies between those bits, 
strongly hindering locality (think of the carry propagation after an increment). 
Although it implies more boolean variables, the hotbit encoding with _n_ bits can be much more effective, especially when _n_ is small,
 and the use of the variable not related of arithmetic. 
 
We have identified two main use cases: when an integer variable represents the state of a process, or some kind of process identifier.

In the former case, the variable is only assigned constant values. 
With a hotbit encoding, it means a reset of the current _1_ bit to _0_, and setting to _1_ the bit corresponding to the assigned value. 
If the process manipulates different sets of variables when in different states, this encoding can strongly increase locality: 
the bit corresponding to a given state can be put closer to the corresponding set of variables. 
This can yield much more compact DD encodings in some cases. 

This participated in the success story of DD applied to Petri nets, since the hotbit encoding is the natural candidate for markings of safe Petri nets.

In the latter case, we typically have a variable shared between process from which they read or into which they read their ID. 
Using a hotbit encoding allows to place the variable representing "value is _i_" close to the variables manipulated by process _i_. 

It increases locality as previously, and can again yield much more efficient DD solutions. 
It increases the symmetry in the DD encoding of the state space and again can yield much more efficient DD solutions.

We further automatically identify and tag variables that could benefit from one-hot encoding: any variable that is only assigned constants (this allows to statically compute the range) and whose domain size is greater than a threshold (we use 8) is set by default to one-hot encoding.

The main difficulty to keep good locality properties is the reset of the current _1_-bit to _0_. 
If the position of the _1_-bit is unknown, all the bits must be tested, which should incur a strong synchronization between all the bits of the encoding. 

This issue can fortunately be avoided by the use of labeled transitions (one per bit) that are called from the resetting transition.

Such a variable, or array, is prefixed by the _hotbit(range)_ keyword. This example shows a simple hotbit variable.

<figure class="highlight"><pre><code class="language-c" data-lang="c">
{% include_relative galfiles/hotbit.gal.html %}
</code></pre></figure>

This is the model resulting from the transformation.

<figure class="highlight"><pre><code class="language-c" data-lang="c">
{% include_relative galfiles/hotbit.int.gal.html %}
</code></pre></figure>

Note that due to parameter separation and instantiation, the final specification is still quite small. This is the fully instantiated model, after parameter separation and instantiation.

<figure class="highlight"><pre><code class="language-c" data-lang="c">
{% include_relative galfiles/hotbit.flat.gal.html %}
</code></pre></figure>

In more details, this is the algorithm applied. 
We suppose here a hotbit array, the simpler integer variable case can be deduced by considering __i=0__. 

To replace an variable __tab__ by its __hotbit(r)__ encoding, for each transition __t__, we first find all accesses to the variable __tab[i]__.

For each unique __i__ index expression found,

*   for each read before a write of the form **tab[i]**, if it is the first read encountered, add a parameter _ptabi_ with range _r_ to _t_ and add a disjunction to the guard _tab[i * &#124;r&#124; + ptabi]==1_. In any case replace _tab[i]_ by _ptabi_ where it occurs.
*   for each write after a read replace the statement _tab[i] = e_ by the sequence _tab[i * |r| + ptabi]=0 ; tab[ i*|r| + e ] = 1_. This action is correct in this case and modifies only two bits of the representation.
*   for a write before (hence without) a read, replace _tab[i] = e_ by the sequence _call(reset.tabi) ; tab[i*|r| + e] = 1;_. Hence reset all bits representing _tab[i]_ then assign a single one. We add a transition with label _reset.tabi_, with a parameter _p_ of range _r_ and with body _tab[i*|r| + p]=0;_. This encoding of the reset affects all variables encoding tab[i] (since we don't know its current value), but the reset part of the action is likely to be shared between different transitions, and it is expressed as a sum of effects due to the parametric transition and label introduced.
*   reads after writes and successive writes to a hotbit variable within a single transition are currently not supported. We place a syntactic restriction on the specification to enforce this rule. Handling these cases would be possible but requires a lot of care in the general case (tracking values across assignments) and does not correspond to the usage patterns encountered for good hotbit variable candidates.


## Fixpoint action

The fixpoint action allows to apply a given sequence of statements until convergence is obtained. Note that this is convergence of the set of successor states, i.e. fixpoint returns a set of states such that applying the body of the fixpoint statement to this set yields the set itself. This operator is similar to Kleene-star closure of langage theory. It can be used to simulate mu (least fixpoint) and nu (greatest fixpoint) operators of [modal mu-calculi](https://en.wikipedia.org/wiki/Modal_%CE%BC-calculus).

The fixpoint statement is a powerfult tool to create abstractions of a state-space while preserving some target properties. The effects can be similar to the transient predicate, of which it is a kind of dual since Transient is expressed over states rather than over statements. It can be used to accelerate over "uninteresting" states for instance.

The following example shows use of a fixpoint to model the transition relation of a Time Petri net with two places a and b, and a transition t that moves tokens from a to b, with earliest firing time _eft_ and latest firing time _lft_. In this version of the example, we wish to use as successor relation : from a source state s, find all states that can be reached from s by letting time elapse, then fire any enabled discrete transition of the TPN from these states. This abstraction originally proposed by Popova is called "essential states" and preserves marking reachability and branching time temporal properties. It is based on the fact that a transition cannot be disabled in a TPN by letting time elapse.

The example implements a least fixpoint using elapse. The transition "id" allows to keep currently reached states in the fixpoint. if it were removed, the transition relation would become : from a source state s, let time elapse as much as possible, then fire any enabled discrete transition of the TPN from this state. This definition of the transition relation would not preserve many properties of the original system. If we had other transitions in the system, they would all bear label "succ". This example system has only two states : the initial one (a=1,b=0,clock=0) and the state just after firing t (a=0,b=1,t=0).

<figure class="highlight"><pre><code class="language-c" data-lang="c">
{% include_relative galfiles/fixpoint.gal.html %}
</code></pre></figure>

## Transient predicate

<span class="galElement">TRANSIENT</span> is a keyword that modifies the semantics of a GAL system to accelerate over states satisfying the Transient predicate. When the transient predicate is false (which is the default assumption if no transient predicate is provided), the basic semantics where transitions produce successors in one step is used. However, any state that satisfies the transient predicate will be abstracted away and replaced by its successors by any enabled transition. The transition relation succ becomes : ( notTransient + succ o transient ) * . In other words, states satisfying the transient predicate are not considered part of the final state space, they are simply intermediate steps where another transition should be fired immediately. A limitation of this mechanism is that cycles of transient states (zeno style behavior) are considered ill-formed, and typically may cause the model-checking procedure to livelock. It is also an error if the initial state satisfies the transient predicate.

Transient is a kind of dual of the fixpoint below; supposing that all transitions of the system bear the label "succ", the statement:
fixpoint { if (transient) { self."succ" ; } }
reflects the semantics of the Transient predicate.

The transient predicate is declared with the keyword <span class="galElement">TRANSIENT</span>, followed by the assignment sign =, followed by a Boolean expression.

This system only has two states, the initial one and the state where i=0 and tab = (0,1,2,3). Intermediate steps of this initialization loop are abstracted away in the semantics of the underlying transition system.

<figure class="highlight"><pre><code class="language-c" data-lang="c">
{% include_relative galfiles/sample-8.gal.html %}
</code></pre></figure>


